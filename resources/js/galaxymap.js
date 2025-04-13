import * as d3 from "d3";

const renderGalaxyMap = (initialCenter = { gridX: 0, gridY: 0 }) => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    const hexRadius = 35;
    const outerMargin = 2;
    const gridSize = 4;

    const svg = d3.select("#galaxy-map")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .call(d3.zoom().scaleExtent([0.5, 3]).on("zoom", zoomed))
        .append("g");

    const container = svg.append("g");

    const factionData = [
        { gridX: 0, gridY: 0, bgColor: "132320", borderColor: "598578" },
        { gridX: 1, gridY: 1, bgColor: "3c1361", borderColor: "5e60ce" },
        { gridX: -1, gridY: -1, bgColor: "452c2c", borderColor: "a33f1f" }
    ];

    const systemData = [
        { id: 1, name: "System A", gridX: 0, gridY: 0 },
        { id: 2, name: "System B", gridX: 1, gridY: 1 },
        { id: 3, name: "System C", gridX: -1, gridY: -1 }
    ];

    const hexGridData = generateHexGridData(gridSize, hexRadius, outerMargin, factionData, systemData, initialCenter);
    drawHexGrid(container, hexGridData, hexRadius, outerMargin, { x: width / 2, y: height / 2 });

    function zoomed(event) {
        container.attr("transform", event.transform);
    }
};

// Generiere Hexagon-Grid-Daten mit einer zentralen hexagonalen Struktur
const generateHexGridData = (gridSize, hexRadius, outerMargin, factions, systems, center) => {
    const hexGridData = [];
    const factionMap = new Map(factions.map(f => [`${f.gridX},${f.gridY}`, f]));
    const systemMap = new Map(systems.map(s => [`${s.gridX},${s.gridY}`, s]));

    for (let q = -gridSize; q <= gridSize; q++) {
        for (let r = Math.max(-gridSize, -q - gridSize); r <= Math.min(gridSize, -q + gridSize); r++) {
            const gridX = q + center.gridX;
            const gridY = r + center.gridY;

            const faction = factionMap.get(`${gridX},${gridY}`);
            const system = systemMap.get(`${gridX},${gridY}`);

            hexGridData.push({
                gridX,
                gridY,
                bgColor: faction ? `#${faction.bgColor}` : "#222",
                borderColor: faction ? `#${faction.borderColor}` : "#333",
                system: system || null
            });

            console.log(`Adding tile at grid position (${gridX}, ${gridY})`);
        }
    }
    return hexGridData;
};

// Hexagon-Grid mit Außenabstand und Rand zeichnen
const drawHexGrid = (container, hexGridData, hexRadius, outerMargin, centerPosition) => {
    hexGridData.forEach(cell => {
        const { x, y } = calculateHexPosition(cell.gridX, cell.gridY, hexRadius + outerMargin, centerPosition);

        console.log(`Drawing tile at screen position (${x}, ${y}) for grid position (${cell.gridX}, ${cell.gridY})`);

        container.append("path")
            .attr("d", hexagonPath(hexRadius))
            .attr("transform", `translate(${x},${y})`)
            .attr("stroke", cell.borderColor)
            .attr("stroke-width", 1.5)
            .attr("fill", cell.bgColor)
            .on("mouseover", function() {
                const hoverColor = d3.color(cell.bgColor).darker(0.5);
                d3.select(this).attr("fill", hoverColor);
            })
            .on("mouseout", function() {
                d3.select(this).attr("fill", cell.bgColor);
            });

        if (cell.system) {
            container.append("circle")
                .attr("cx", x)
                .attr("cy", y - 5)
                .attr("r", 5)
                .attr("fill", cell.borderColor);

            container.append("text")
                .attr("x", x)
                .attr("y", y + 10)
                .attr("fill", cell.borderColor)
                .attr("font-size", "10px")
                .attr("text-anchor", "middle")
                .attr("font-weight", "bold")
                .text(cell.system.name);
        }

        container.append("text")
            .attr("x", x)
            .attr("y", y + 20)
            .attr("fill", "white")
            .attr("font-size", "8px")
            .attr("text-anchor", "middle")
            .text(`(${cell.gridX}, ${cell.gridY})`);
    });
};

// Berechnung der Hexagon-Position unter Berücksichtigung des Außenabstands
const calculateHexPosition = (gridX, gridY, hexRadiusWithMargin, centerPosition) => {
    console.log(`Calculating position for grid (${gridX}, ${gridY})`);

    const x = centerPosition.x + gridX * (hexRadiusWithMargin * 1.5);
    const y = centerPosition.y + gridY * (hexRadiusWithMargin * Math.sqrt(3)) + (gridX % 2 === 0 ? 0 : hexRadiusWithMargin * Math.sqrt(3) / 2);

    console.log(`Screen Position: (${x}, ${y}) for Grid Position: (${gridX}, ${gridY})`);
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

window.renderGalaxyMap = renderGalaxyMap;
