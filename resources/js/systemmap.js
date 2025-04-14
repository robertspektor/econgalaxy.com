import * as d3 from "d3";

// Generiere Hexagon-Grid-Daten mit einer zentralen hexagonalen Struktur (for Galaxy Map)
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

// Render the Galaxy Map
export const renderGalaxyMap = (initialCenter = { gridX: 0, gridY: 0 }) => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    const hexRadius = 35;
    const outerMargin = 2;
    const gridSize = 4;

    // Clear any existing SVG content
    d3.select("#galaxy-map").selectAll("*").remove();

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

    // Use the global window.systems variable set by the Livewire component
    const systemData = window.systems || [];

    const hexGridData = generateHexGridData(gridSize, hexRadius, outerMargin, factionData, systemData, initialCenter);
    drawHexGrid(container, hexGridData, hexRadius, outerMargin, { x: width / 2, y: height / 2 });

    function zoomed(event) {
        container.attr("transform", event.transform);
    }
};

// Draw the Hex Grid (for Galaxy Map)
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
                .attr("fill", cell.borderColor)
                .on("click", function() {
                    // Dispatch a Livewire event to switch to the system view
                    window.Livewire.dispatch('switchToSystem', { systemId: cell.system.id });
                });

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

// Render the System Map
export const renderSystemMap = (system, sectors, planets, moons, fleets) => {
    // Clear any existing SVG content
    d3.select("#system-map").selectAll("*").remove();

    const dimensions = calculateDimensions();
    const baseOrbitRadius = 100;
    const orbitSpacing = 100;

    const svg = initializeSvg(dimensions.width, dimensions.height);

    // Hintergrundbild mit Parallax-Effekt einfügen
    const backgroundContainer = svg.append("g");
    addParallaxBackground(backgroundContainer, dimensions);

    const container = svg.append("g");

    const centerX = dimensions.width / 2;
    const centerY = dimensions.height / 2;

    addSun(container, centerX, centerY);
    addGlowEffect(svg);
    drawSectors(container, sectors, centerX, centerY);
    drawOrbits(container, planets, centerX, centerY);
    drawPlanets(container, planets, moons, centerX, centerY);
    drawFleets(container, fleets, sectors, centerX, centerY);

    // Add zoom and pan functionality
    svg.call(d3.zoom().scaleExtent([0.5, 3]).on("zoom", zoomed));

    function zoomed(event) {
        container.attr("transform", event.transform);
    }
};

const initializeSvg = (width, height) => {
    return d3.select("#system-map")
        .append("svg")
        .attr("width", width)
        .attr("height", height);
};

const addParallaxBackground = (backgroundContainer, dimensions) => {
    backgroundContainer.append("image")
        .attr("href", "/images/bg-stars.jpg")
        .attr("width", dimensions.width)
        .attr("x", 0)
        .attr("y", 0);
};

const calculateDimensions = () => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    return { width, height, centerX: width / 2, centerY: height / 2 };
};

const addSun = (container, x, y) => {
    container.append("circle")
        .attr("cx", x)
        .attr("cy", y)
        .attr("r", 40)
        .attr("fill", "#FFD700")
        .style("filter", "url(#glow)");
};

const addGlowEffect = (svg) => {
    const filter = svg.append("defs").append("filter")
        .attr("id", "glow")
        .attr("x", "-50%")
        .attr("y", "-50%")
        .attr("width", "200%")
        .attr("height", "200%");
    filter.append("feGaussianBlur").attr("stdDeviation", "20").attr("result", "blur");
    filter.append("feMerge").selectAll("feMergeNode")
        .data(["blur", "SourceGraphic"])
        .enter()
        .append("feMergeNode")
        .attr("in", d => d);
};

const drawSectors = (container, sectors, centerX, centerY) => {
    sectors.forEach(sector => {
        const { ring_index, segment_index, inner_radius, outer_radius } = sector;

        const segmentCount = 18 + ring_index * 2; // Anzahl der Segmente im Ring
        const segmentAngle = 360 / segmentCount;
        const startAngle = segment_index * segmentAngle;
        const endAngle = startAngle + segmentAngle;

        // Berechne die Mitte des Segmentbogens für Textplatzierung
        const midAngle = startAngle + segmentAngle / 2;
        const radius = (inner_radius + outer_radius) / 2;
        const textX = centerX + radius * Math.cos((midAngle - 90) * (Math.PI / 180));
        const textY = centerY + radius * Math.sin((midAngle - 90) * (Math.PI / 180));

        // Erstelle den Segmentpfad für das aktuelle Segment
        const arcPath = d3.arc()
            .innerRadius(inner_radius)
            .outerRadius(outer_radius)
            .startAngle((startAngle * Math.PI) / 180)
            .endAngle((endAngle * Math.PI) / 180);

        const sectorLabel = `Z${ring_index}S${segment_index}`;

        // Zeichne den Sektor
        container.append("path")
            .attr("d", arcPath)
            .attr("fill", "rgba(60, 60, 60, 0.2)")
            .attr("stroke", "rgba(60, 60, 60, 0.3)")
            .attr("transform", `translate(${centerX}, ${centerY})`)
            .attr("class", `sector-segment ${sectorLabel}`)
            .on("mouseover", function() {
                d3.select(this).attr("fill", "rgba(60, 60, 60, 0.4)");
                d3.select(`.sector-label-${sectorLabel}`).attr("opacity", 1);
            })
            .on("mouseout", function() {
                d3.select(this).attr("fill", "rgba(60, 60, 60, 0.2)");
                if (d3.select(`.sector-label-${sectorLabel}`).attr("data-has-fleet") != 1) {
                    d3.select(`.sector-label-${sectorLabel}`).attr("opacity", 0);
                }
            });

        // Füge das Label hinzu
        container.append("text")
            .attr("x", textX)
            .attr("y", textY - 15)
            .attr("text-anchor", "middle")
            .attr("dominant-baseline", "middle")
            .attr("fill", "#FFFFFF")
            .attr("font-size", "10px")
            .attr("class", `sector-label sector-label-${sectorLabel}`)
            .attr("opacity", 0)
            .attr("data-has-fleet", 0)
            .text(sectorLabel);
    });
};

const drawOrbits = (container, planets, centerX, centerY) => {
    planets.forEach(planet => {
        container.append("circle")
            .attr("cx", centerX)
            .attr("cy", centerY)
            .attr("r", planet.orbitRadius)
            .attr("fill", "none")
            .attr("stroke", "rgba(255, 255, 255, 0.8)")
            .attr("stroke-dasharray", "4, 4")
            .attr("opacity", 0.8);
    });
};

const drawPlanets = (container, planets, moons, centerX, centerY) => {
    // Erstelle die Hover-Zonen im Container, damit sie an der richtigen Umlaufbahn-Position zentriert sind
    planets.forEach(planet => {
        const hoverZone = container.append("circle")
            .attr("cx", centerX) // Mittelpunkt des Sonnensystems
            .attr("cy", centerY)
            .attr("r", planet.orbitRadius)
            .attr("fill", "none")
            .attr("stroke", "rgba(55, 55, 55, 0.5)")
            .attr("stroke-width", 50)
            .attr("opacity", 0)
            .on("mouseover", function() {
                d3.select(this).attr("opacity", 0.5);
            })
            .on("mouseout", function() {
                d3.select(this).attr("opacity", 0);
            });

        // Speichern der Hover-Zone als Referenz für spätere Verwendung
        planet.hoverZone = hoverZone;
    });

    const planetGroups = container.selectAll("g.planet")
        .data(planets)
        .enter()
        .append("g")
        .attr("class", "planet")
        .attr("transform", d => {
            const x = centerX + d.orbitRadius * Math.cos(d.angle * Math.PI / 180);
            const y = centerY + d.orbitRadius * Math.sin(d.angle * Math.PI / 180);
            return `translate(${x}, ${y})`;
        });

    planetGroups.each(function (planet) {
        const group = d3.select(this);

        // Zeichne den Planeten und setze Hover-Effekte
        group.append("circle")
            .attr("r", planet.size)
            .attr("fill", planet.color)
            .on("mouseover", function() {
                d3.select(this).attr("stroke", "#fff").attr("stroke-width", 2);
                planet.hoverZone.attr("opacity", 0.5);
            })
            .on("mouseout", function() {
                d3.select(this).attr("stroke", null).attr("stroke-width", 0);
                planet.hoverZone.attr("opacity", 0);
            });

        drawPlanetShadow(group, planet.size);
        drawMoons(group, moons.filter(moon => moon.planet_id === planet.id));
    });
};

const drawPlanetShadow = (group, size) => {
    const shadowAngle = -45;
    const x1 = size * Math.cos(shadowAngle * Math.PI / 180);
    const y1 = size * Math.sin(shadowAngle * Math.PI / 180);
    const x2 = size * Math.cos((shadowAngle + 180) * Math.PI / 180);
    const y2 = size * Math.sin((shadowAngle + 180) * Math.PI / 180);

    group.append("path")
        .attr("d", `M ${x1},${y1} A ${size},${size} 0 0,1 ${x2},${y2} L 0,0 Z`)
        .attr("fill", "rgba(0, 0, 0, 0.5)");
};

const drawMoons = (group, moons) => {
    moons.forEach(moon => {
        const moonX = moon.orbitRadius * Math.cos(moon.angle * Math.PI / 180);
        const moonY = moon.orbitRadius * Math.sin(moon.angle * Math.PI / 180);
        group.append("circle")
            .attr("cx", moonX)
            .attr("cy", moonY)
            .attr("r", moon.size)
            .attr("fill", moon.color);
    });
};

const drawFleets = (container, fleets, sectors, centerX, centerY) => {
    fleets.forEach(fleet => {
        // Since current_sector_id is not available, place fleets near a random planet or system center
        const planet = planets[Math.floor(Math.random() * planets.length)] || { orbitRadius: 100, angle: 0 };
        const angle = deg2rad(planet.angle + Math.random() * 360);
        const x = centerX + (planet.orbitRadius + 30) * Math.cos(angle);
        const y = centerY + (planet.orbitRadius + 30) * Math.sin(angle);

        const fleetGroup = container.append("g").attr("transform", `translate(${x}, ${y})`);

        fleetGroup.append("polygon")
            .attr("points", "-10,10 10,10 0,-10")
            .attr("fill", fleet.isFriendly ? "green" : "red");

        fleetGroup.append("text")
            .attr("x", 0)
            .attr("y", 20)
            .attr("text-anchor", "middle")
            .attr("font-size", "10px")
            .attr("fill", "#FFFFFF")
            .text(fleet.size);
    });
};

// Helper function to convert degrees to radians
const deg2rad = (degrees) => {
    return degrees * (Math.PI / 180);
};

// Attach functions to the window object for global access
window.renderGalaxyMap = renderGalaxyMap;
window.renderSystemMap = renderSystemMap;
