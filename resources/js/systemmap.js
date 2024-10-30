import * as d3 from 'd3';

const renderSystemMap = (system, sectors, planets, moons, fleets) => {

    const dimensions = calculateDimensions();
    const baseOrbitRadius = 100;
    const orbitSpacing = 100;

    const svg = initializeSvg(dimensions.width, dimensions.height);

    // Hintergrundbild mit Parallax-Effekt einfügen, zuerst im SVG hinzufügen, damit es im Hintergrund ist
    const backgroundContainer = svg.append("g");
    addParallaxBackground(backgroundContainer, dimensions, backgroundContainer);

    const container = svg.append("g");

    const centerX = dimensions.width / 2;
    const centerY = dimensions.height / 2;


    // const planets = [
    //     { id: 1, name: 'Planet A', size: 10, color: "#B0BEC5", orbitRadius: baseOrbitRadius + orbitSpacing, angle: 0 },
    //     { id: 2, name: 'Planet B', size: 15, color: "#ECEFF1", orbitRadius: baseOrbitRadius + orbitSpacing * 2, angle: 45 },
    //     { id: 3, name: 'Planet C', size: 12, color: "#FFB6C1", orbitRadius: baseOrbitRadius + orbitSpacing * 3, angle: 90 }
    // ];

    // const moons = [
    //     { id: 1, planet_id: 1, name: 'Moon A1', size: 4, color: "#A4A4A4", orbitRadius: 20, angle: 90 },
    //     { id: 2, planet_id: 2, name: 'Moon B1', size: 3, color: "#CCCCCC", orbitRadius: 25, angle: 180 },
    //     { id: 3, planet_id: 3, name: 'Moon C1', size: 5, color: "#AAAAAA", orbitRadius: 30, angle: 270 }
    // ];

    // const zones = [
    //     { innerRadius: baseOrbitRadius + 50, outerRadius: baseOrbitRadius + orbitSpacing + 50, segments: 18 },
    //     { innerRadius: baseOrbitRadius + orbitSpacing + 50, outerRadius: baseOrbitRadius + orbitSpacing * 2 + 50, segments: 18 },
    //     { innerRadius: baseOrbitRadius + orbitSpacing * 2 + 50, outerRadius: baseOrbitRadius + orbitSpacing * 3 + 50, segments: 18 }
    // ];



// Beispiel-Aufruf
//     const fleets = [
        // { id: 1, zoneId: 0, segmentIndex: 0, size: 5, isFriendly: true },
        // { id: 2, zoneId: 1, segmentIndex: 4, size: 10, isFriendly: false },
        // { id: 3, zoneId: 2, segmentIndex: 8, size: 15, isFriendly: true }
    // ];


// Beispiel-Flotten, die in verschiedenen Zonen und Segmenten starten
//     const fleets = [
//         { id: 1, zoneId: 'Z1S15', size: 10, isFriendly: true },
//         { id: 2, zoneId: 'Z2S10', size: 20, isFriendly: false },
//         { id: 3, zoneId: 'Z3S5', size: 15, isFriendly: true }
//     ];

    addSun(container, centerX, centerY);
    addGlowEffect(svg);
    // drawZones(container, zones, centerX, centerY);
    drawSectors(container, sectors, centerX, centerY);
    drawOrbits(container, planets, centerX, centerY);
    drawPlanets(container, planets, moons, centerX, centerY);
    // drawFleets(container, fleets, zones, centerX, centerY);
    drawFleets(container, fleets, sectors, centerX, centerY);

};

const initializeSvg = (width, height) => {
    return d3.select("#system-map")
        .append("svg")
        .attr("width", width)
        .attr("height", height);
};
const addParallaxBackground = (backgroundContainer, dimensions) => {

    // cover
    backgroundContainer.append("image")
        .attr("href", "/images/bg-stars.jpg")
        .attr("width", dimensions.width)
        // .attr("height", dimensions.height)
        .attr("x", 0)
        .attr("y", 0);
};


const calculateDimensions = () => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    return { width, height, centerX: width / 2, centerY: height / 2 };
};

const adjustZoneSegments = (zones) => {
    const baseArea = Math.PI * (zones[0].outerRadius ** 2 - zones[0].innerRadius ** 2);
    zones.forEach((zone, index) => {
        if (index === 0) return;
        const zoneArea = Math.PI * (zone.outerRadius ** 2 - zone.innerRadius ** 2);
        zone.segments = Math.round(zones[0].segments * (zoneArea / baseArea));
    });
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

// Anpassungen für die `drawZones` Methode, um das Hover-Verhalten korrekt zu steuern
const drawZones = (container, zones, centerX, centerY) => {
    adjustZoneSegments(zones);

    zones.forEach((zone, zoneIndex) => {
        const segmentAngle = 360 / zone.segments;

        // Berechne den Radius-Mittelpunkt des Zonenrings für die Flottenpositionen
        const radius = (zone.innerRadius + zone.outerRadius) / 2;

        for (let i = 0; i < zone.segments; i++) {
            const startAngle = i * segmentAngle;
            const midAngle = startAngle + segmentAngle / 2; // Berechne den Mittelwinkel des Segments
            const endAngle = startAngle + segmentAngle;

            // Positioniere das Text-Label in der Mitte des Segments
            const textX = centerX + radius * Math.cos((midAngle - 90) * (Math.PI / 180));
            const textY = centerY + radius * Math.sin((midAngle - 90) * (Math.PI / 180));

            // Erstelle den Segmentpfad für das aktuelle Segment
            const arcPath = d3.arc()
                .innerRadius(zone.innerRadius)
                .outerRadius(zone.outerRadius)
                .startAngle((startAngle * Math.PI) / 180)
                .endAngle((endAngle * Math.PI) / 180);

            // Definiere den eindeutigen Segmentbezeichner `Z{zoneIndex + 1}S{i + 1}`
            const segmentLabel = `Z${zoneIndex + 1}S${i + 1}`;

            // Füge den Segmentbogen zum SVG hinzu
            container.append("path")
                .attr("d", arcPath)
                .attr("fill", "rgba(60, 60, 60, 0.2)")
                .attr("stroke", "rgba(60, 60, 60, 0.3)")
                .attr("transform", `translate(${centerX}, ${centerY})`)
                .attr("class", `zone-segment ${segmentLabel}`)
                .on("mouseover", function() {
                    d3.select(this).attr("fill", "rgba(60, 60, 60, 0.4)");
                    d3.select(`.zone-label-${segmentLabel}`).attr("opacity", 1); // Zeige das Label beim Hover
                })
                .on("mouseout", function() {
                    d3.select(this).attr("fill", "rgba(60, 60, 60, 0.2)");
                    if (d3.select(`.zone-label-${segmentLabel}`).attr("data-has-fleet") != 1) {
                        d3.select(`.zone-label-${segmentLabel}`).attr("opacity", 0); // Verberge das Label, wenn keine Flotte vorhanden
                    }
                });

            // Füge den Text in die Mitte des Segmentbogens hinzu, zunächst unsichtbar
            container.append("text")
                .attr("x", textX)
                .attr("y", textY - 15) // Platzierung oberhalb der Flotte
                .attr("text-anchor", "middle")
                .attr("dominant-baseline", "middle")
                .attr("fill", "#FFFFFF")
                .attr("font-size", "10px")
                .attr("class", `zone-label zone-label-${segmentLabel}`)
                .attr("opacity", 0) // Start mit unsichtbarem Text
                .attr("data-has-fleet", 0) // Daten-Attribut zum Überprüfen, ob eine Flotte vorhanden ist
                .text(segmentLabel);
        }
    });
};

const drawSectors = (container, sectors, centerX, centerY) => {
    sectors.forEach(sector => {
        const { ring_index, segment_index, inner_radius, outer_radius } = sector;

        const segmentCount = 18 + ring_index * 2; // Anzahl der Segmente für diesen Ring
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
        group.append("circle").attr("cx", moonX).attr("cy", moonY).attr("r", moon.size).attr("fill", moon.color);
    });
};

const drawFleets = (container, fleets, sectors, centerX, centerY) => {
    fleets.forEach(fleet => {
        let startX, startY, targetX, targetY;

        if (fleet.status === "moving" && fleet.current_sector_id && fleet.destination_sector_id) {
            const currentSector = sectors.find(s => s.id === fleet.current_sector_id);
            const destinationSector = sectors.find(s => s.id === fleet.destination_sector_id);

            if (currentSector && destinationSector) {
                const { x: currentX, y: currentY } = calculateSectorPosition(currentSector, centerX, centerY);
                const { x: destinationX, y: destinationY } = calculateSectorPosition(destinationSector, centerX, centerY);

                startX = currentX;
                startY = currentY;
                targetX = destinationX;
                targetY = destinationY;
            } else {
                console.warn(`Error finding sectors for Fleet ${fleet.id}`);
            }
        } else if (fleet.current_sector_id) {
            const sector = sectors.find(s => s.id === fleet.current_sector_id);

            if (sector) {

                const { x, y } = calculateSectorPosition(sector, centerX, centerY);

                const fleetGroup = container.append("g").attr("transform", `translate(${x}, ${y})`);

                fleetGroup.append("polygon").attr("points", "-10,10 10,10 0,-10").attr("fill", fleet.isFriendly ? "green" : "red");

                fleetGroup.append("text")
                    .attr("x", 0)
                    .attr("y", 20)
                    .attr("text-anchor", "middle")
                    .attr("font-size", "10px")
                    .attr("fill", "#FFFFFF")
                    .text(fleet.size);
            } else {
                console.warn(`Sector not found for Fleet ${fleet.id} with Sector ID ${fleet.current_sector_id}`);
            }
        }
    });
};


const calculateSectorPosition = (sector, centerX, centerY) => {

    const segmentCount = 18 + sector.ring_index * 2; // Anzahl der Segmente im Ring
    const segmentAngle = 360 / segmentCount;
    const startAngle = sector.segment_index * segmentAngle;
    const midAngleRad = (startAngle + segmentAngle / 2);
    const radius = (sector.inner_radius + sector.outer_radius) / 2;

    const x = centerX + radius * Math.cos((midAngleRad - 90) * (Math.PI / 180));
    const y = centerY + radius * Math.sin((midAngleRad - 90) * (Math.PI / 180));

    return { x, y };
};

const calculateProgress = (departureTime, arrivalTime) => {
    const now = Date.now();
    const departure = new Date(departureTime).getTime();
    const arrival = new Date(arrivalTime).getTime();

    return Math.min(1, Math.max(0, (now - departure) / (arrival - departure)));
};

window.renderSystemMap = renderSystemMap;
