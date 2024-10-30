import * as d3 from 'd3';

var renderGalaxyMap = function (sectors, jumpGates) {

    // Größe der SVG-Karte
    const width = 1024;
    const height = 768;

    // Erstelle das SVG-Element mit dunklem Hintergrund
    const svg = d3.select("#graph-container")
        .append("svg")
        .attr("width", width)
        .attr("height", height);

    // Zeichne die Sprungtore als Linien
    svg.selectAll("line")
        .data(jumpGates)
        .enter()
        .append("line")
        .attr("x1", d => sectors.find(sector => sector.id === d.sector_id).x)
        .attr("y1", d => sectors.find(sector => sector.id === d.sector_id).y)
        .attr("x2", d => sectors.find(sector => sector.id === d.target_sector_id).x)
        .attr("y2", d => sectors.find(sector => sector.id === d.target_sector_id).y)
        .attr("stroke", "cyan")  // Leuchtende Linien
        .attr("stroke-width", 2)
        .attr("stroke-opacity", 0.7);

    // Zeichne die Knotenpunkte (Sektoren) mit weißem Rand und füge Klick-Event hinzu
    svg.selectAll("rect")
        .data(sectors)
        .enter()
        .append("rect")
        .attr("x", d => d.x - 50)         // X-Koordinate
        .attr("y", d => d.y - 25)         // Y-Koordinate
        .attr("width", 100)               // Breite des Rechtecks
        .attr("height", 50)               // Höhe des Rechtecks
        .attr("rx", 20)                   // Horizontale Abrundung der Ecken
        .attr("ry", 20)                   // Vertikale Abrundung der Ecken
        .attr("fill", d => d.faction.color)
        .attr("stroke", "white")          // Weißer Rand um die Rechtecke
        .attr("stroke-width", 2)          // Breite des weißen Randes
        .on("click", function (event, d) {  // Klick-Event-Handler

            Livewire.navigate(`/sectors/${d.id}`);
        });

    // Beschriftung der Sektoren, mittig in den Rechtecken
    svg.selectAll("text")
        .data(sectors)
        .enter()
        .append("text")
        .attr("x", d => d.x)  // Horizontal in der Mitte des Rechtecks
        .attr("y", d => d.y)  // Vertikal zentrieren, mit leichtem Versatz nach unten
        .attr("text-anchor", "middle")  // Text in der Mitte ausrichten
        .text(d => d.name)
        .attr("fill", "white")
        .attr("font-size", "12px")
        .attr("alignment-baseline", "middle");  // Text vertikal in der Mitte ausrichten

    // Füge zusätzliche Infos wie die Fraktion hinzu
    svg.selectAll(".info")
        .data(sectors)
        .enter()
        .append("text")
        .attr("x", d => d.x)  // Gleiche X-Koordinate
        .attr("y", d => d.y + 15)  // Etwas unter dem Namen
        .attr("text-anchor", "middle")
        .text(d => d.faction.name)
        .attr("fill", "white")
        .attr("font-weight", "bold")
        .attr("font-size", "10px")
        .attr("alignment-baseline", "middle");

}

var renderSystemMap = function () {
    const width = window.innerWidth;
    const height = window.innerHeight;

    // Zentrum des Sonnensystems basierend auf Bildschirmgröße
    const centerX = width / 2;
    const centerY = height / 2;

    // Festlegung der Abstände zwischen Umlaufbahnen und Zonen
    const baseOrbitRadius = 100; // Basisradius für die erste Umlaufbahn
    const orbitSpacing = 100;    // Gleicher Abstand für jede weitere Umlaufbahn und Zone

    // Beispiel-Daten für Planeten mit festen Koordinaten und unterschiedlichen Umlaufbahnen
    const planets = [
        { id: 1, name: 'Planet A', size: 10, color: "#B0BEC5", orbitRadius: baseOrbitRadius + orbitSpacing * 1, angle: 0 },
        { id: 2, name: 'Planet B', size: 15, color: "#ECEFF1", orbitRadius: baseOrbitRadius + orbitSpacing * 2, angle: 45 },
        { id: 3, name: 'Planet C', size: 12, color: "#FFB6C1", orbitRadius: baseOrbitRadius + orbitSpacing * 3, angle: 90 }
    ];

    // Beispiel-Daten für Monde mit festen Umlaufbahnen um die Planeten
    const moons = [
        { id: 1, planetId: 1, name: 'Moon A1', size: 4, color: "#A4A4A4", orbitRadius: 20, angle: 90 },
        { id: 2, planetId: 2, name: 'Moon B1', size: 3, color: "#CCCCCC", orbitRadius: 25, angle: 180 },
        { id: 3, planetId: 3, name: 'Moon C1', size: 5, color: "#AAAAAA", orbitRadius: 30, angle: 270 }
    ];

    // Zonen, die zwischen den Umlaufbahnen versetzt sind
    const zones = [
        { id: 1, centerX: centerX, centerY: centerY, innerRadius: baseOrbitRadius + 50, outerRadius: baseOrbitRadius + orbitSpacing + 50, segments: 18 },
        { id: 2, centerX: centerX, centerY: centerY, innerRadius: baseOrbitRadius + orbitSpacing + 50, outerRadius: baseOrbitRadius + 2 * orbitSpacing + 50, segments: 26 },
        { id: 3, centerX: centerX, centerY: centerY, innerRadius: baseOrbitRadius + 2 * orbitSpacing + 50, outerRadius: baseOrbitRadius + 3 * orbitSpacing + 50, segments: 34 }
    ];

    const svg = d3.select("#system-map")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .call(d3.zoom()
            .scaleExtent([0.5, 5])
            .on("zoom", zoomed));

    const container = svg.append("g");

    function zoomed(event) {
        const transform = event.transform;
        container.attr("transform", `translate(${transform.x},${transform.y}) scale(${transform.k})`);
    }

    // Zeichne die Sonne zentriert im Bildschirm
    container.append("circle")
        .attr("cx", centerX)
        .attr("cy", centerY)
        .attr("r", 40)
        .attr("fill", "#FFD700")
        .style("filter", "url(#glow)");

    // Hinzufügen des Glow-Effekts für die Sonne
    const defs = svg.append("defs");
    const filter = defs.append("filter")
        .attr("id", "glow")
        .attr("x", "-50%")
        .attr("y", "-50%")
        .attr("width", "200%")
        .attr("height", "200%");

    filter.append("feGaussianBlur")
        .attr("in", "SourceGraphic")
        .attr("stdDeviation", "20")
        .attr("result", "blur");

    filter.append("feMerge")
        .selectAll("feMergeNode")
        .data(["blur", "SourceGraphic"])
        .enter()
        .append("feMergeNode")
        .attr("in", d => d);

    // Erstelle die versetzten Zonen zwischen den Umlaufbahnen
    zones.forEach(zone => {
        const segmentAngle = 360 / zone.segments;

        for (let i = 0; i < zone.segments; i++) {
            const startAngle = i * segmentAngle;
            const endAngle = startAngle + segmentAngle;

            const zonePath = d3.arc()
                .innerRadius(zone.innerRadius)
                .outerRadius(zone.outerRadius)
                .startAngle((startAngle * Math.PI) / 180)
                .endAngle((endAngle * Math.PI) / 180);

            container.append("path")
                .attr("d", zonePath)
                .attr("fill", "rgba(60, 60, 60, 0.1)")
                .attr("stroke", "rgba(60, 60, 60, 0.2)")
                .attr("transform", `translate(${centerX}, ${centerY})`);
        }
    });

    // Zeichne die Umlaufbahnen für die Planeten und füge den Hover-Effekt hinzu
    planets.forEach(planet => {
        const orbitGroup = container.append("g");

        // Erstellen des Hover-Highlights um die Umlaufbahn
        // const orbitHighlight = orbitGroup.append("circle")
        //     .attr("cx", centerX)
        //     .attr("cy", centerY)
        //     .attr("r", planet.orbitRadius)
        //     .attr("fill", "rgba(255, 255, 255, 0.1)")
        //     .attr("stroke", "rgba(255, 255, 255, 0.3)")
        //     .attr("opacity", 50)
        //     .on("mouseover", function() {
        //         d3.select(this).attr("opacity", 0.3);
        //     })
        //     .on("mouseout", function() {
        //         d3.select(this).attr("opacity", 0);
        //     });

        // Hover-Zone für Planetenumlaufbahn
        const hoverZone = container.append("circle")
            .attr("cx", centerX)
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

        planet.hoverZone = hoverZone;

        // Umlaufbahn des Planeten mit Hover-Effekt
        orbitGroup.append("circle")
            .attr("cx", centerX)
            .attr("cy", centerY)
            .attr("r", planet.orbitRadius)
            .attr("fill", "none")
            .attr("stroke", "#666")
            .attr("stroke-dasharray", "4, 4")
            .attr("opacity", 0.8)
            .on("mouseover", function() {
                // d3.select(this).attr("stroke", "#fff").attr("stroke-width", 2);
                // planet.hoverZone.attr("opacity", 0.5);
            })
            .on("mouseout", function() {
                // d3.select(this).attr("stroke", "#666").attr("stroke-width", 1);
                // planet.hoverZone.attr("opacity", 0);
            });
    });

    // Planeten zeichnen an festen Positionen auf den jeweiligen Umlaufbahnen
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

        // Zeichne den Planeten mit Hover-Effekt
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

        // Zeichne den Schatten für die Tag- und Nachtseite
        const shadowAngle = -45;
        const x1 = planet.size * Math.cos(shadowAngle * Math.PI / 180);
        const y1 = planet.size * Math.sin(shadowAngle * Math.PI / 180);
        const x2 = planet.size * Math.cos((shadowAngle + 180) * Math.PI / 180);
        const y2 = planet.size * Math.sin((shadowAngle + 180) * Math.PI / 180);

        group.append("path")
            .attr("d", `M ${x1},${y1} A ${planet.size},${planet.size} 0 0,1 ${x2},${y2} L 0,0 Z`)
            .attr("fill", "rgba(0, 0, 0, 0.5)");

        // Monde hinzufügen
        moons.filter(moon => moon.planetId === planet.id).forEach(moon => {
            const moonX = moon.orbitRadius * Math.cos(moon.angle * Math.PI / 180);
            const moonY = moon.orbitRadius * Math.sin(moon.angle * Math.PI / 180);

            group.append("circle")
                .attr("cx", moonX)
                .attr("cy", moonY)
                .attr("r", moon.size)
                .attr("fill", moon.color);
        });
    });
};


// window.renderSystemMap = renderSystemMap;


// make function available to other scripts
// window.renderGalaxyMap = renderGalaxyMap;

