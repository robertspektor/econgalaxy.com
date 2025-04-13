import * as d3 from "d3";

const renderDynamicGalaxyMap = (initialCenter) => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    const hexRadius = 35;
    const outerMargin = 2;
    const visibilityRadius = 5;

    let center = initialCenter;

    const svg = d3.select("#galaxy-map")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .call(d3.zoom().scaleExtent([0.5, 3]).on("zoom", zoomed))
        .append("g");

    const container = svg.append("g");

    drawHexGrid(container, center, hexRadius, visibilityRadius);

    function zoomed(event) {
        const { x, y } = event.transform;
        const newCenter = calculateCenterFromPixel(x, y, hexRadius + outerMargin);

        // Log the central position and changes in grid position
        console.log(`Central position updated to: (${newCenter.x}, ${newCenter.y})`);

        // Update only if the central position changed
        if (newCenter.x !== center.x || newCenter.y !== center.y) {
            center = newCenter;
            drawHexGrid(container, center, hexRadius, visibilityRadius);
        }
    }
};

// Berechnung der zentralen Position in Hex-Koordinaten
const calculateCenterFromPixel = (pixelX, pixelY, hexRadiusWithMargin) => {
    const q = (2 / 3 * pixelX) / hexRadiusWithMargin;
    const r = (-1 / 3 * pixelX + Math.sqrt(3) / 3 * pixelY) / hexRadiusWithMargin;

    // Runde die Hex-Koordinaten auf ganze Zahlen
    const roundedQ = Math.round(q);
    const roundedR = Math.round(r);
    return { x: roundedQ, y: roundedR };
};

// Zeichnet das Hex-Grid um den zentralen Punkt
const drawHexGrid = (container, center, hexRadius, visibilityRadius) => {
    container.selectAll("*").remove();

    for (let x = -visibilityRadius; x <= visibilityRadius; x++) {
        for (let y = -visibilityRadius; y <= visibilityRadius; y++) {
            const gridX = center.x + x;
            const gridY = center.y + y;
            const { x: pixelX, y: pixelY } = calculateHexPosition(gridX, gridY, hexRadius);

            // Log the creation of each new tile
            console.log(`Creating new tile at (${gridX}, ${gridY})`);

            container.append("path")
                .attr("d", hexagonPath(hexRadius))
                .attr("transform", `translate(${pixelX}, ${pixelY})`)
                .attr("stroke", "#333")
                .attr("stroke-width", 1.5)
                .attr("fill", "#222")
                .on("mouseover", function() {
                    d3.select(this).attr("fill", d3.color("#444").darker(0.5));
                })
                .on("mouseout", function() {
                    d3.select(this).attr("fill", "#222");
                });

            // Zentrale Punktanzeige für das Debuggen
            if (gridX === center.x && gridY === center.y) {
                container.append("circle")
                    .attr("cx", pixelX)
                    .attr("cy", pixelY)
                    .attr("r", 5)
                    .attr("fill", "yellow");
                container.append("text")
                    .attr("x", pixelX + 10)
                    .attr("y", pixelY + 5)
                    .attr("fill", "white")
                    .attr("font-size", "10px")
                    .text(`(${center.x}, ${center.y})`);
            }

            // Koordinaten in jedem Tile für das Debuggen anzeigen
            container.append("text")
                .attr("x", pixelX)
                .attr("y", pixelY + 5)
                .attr("fill", "white")
                .attr("font-size", "8px")
                .attr("text-anchor", "middle")
                .text(`(${gridX}, ${gridY})`);
        }
    }
};

// Berechnung der Pixelposition eines Hexagons basierend auf Grid-Koordinaten
const calculateHexPosition = (gridX, gridY, hexRadiusWithMargin) => {
    const x = hexRadiusWithMargin * (3 / 2 * gridX);
    const y = hexRadiusWithMargin * (Math.sqrt(3) * (gridY + 0.5 * (gridX & 1)));
    return { x, y };
};

// Hexagon-Pfad für ein regelmäßiges Sechseck
const hexagonPath = radius => {
    const angle = Math.PI / 3;
    let path = "";
    for (let i = 0; i < 6; i++) {
        const x = radius * Math.cos(angle * i);
        const y = radius * Math.sin(angle * i);
        path += `${i === 0 ? "M" : "L"}${x},${y}`;
    }
    return path + "Z";
};

// Startet das Rendering der dynamischen Galaxy Map
window.renderDynamicGalaxyMap = renderDynamicGalaxyMap;
