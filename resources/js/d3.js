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
    const width = 2000;
    const height = 2000;

    const timeScaleFactor = 3600;

    const planets = [
        {
            id: 1, name: 'Planet A', orbitRadius: 150, size: 10, color: "#B0BEC5",
            realOrbitPeriod: 1,
            moons: [
                { orbitRadius: 20, size: 3, color: "#A4A4A4", realOrbitPeriod: 0.1 }
            ]
        },
        {
            id: 2, name: 'Planet B', orbitRadius: 300, size: 15, color: "#ECEFF1",
            realOrbitPeriod: 1.88,
            moons: [
                { orbitRadius: 30, size: 4, color: "#CCCCCC", realOrbitPeriod: 0.1 },
                { orbitRadius: 40, size: 2, color: "#AAAAAA", realOrbitPeriod: 0.2 }
            ]
        }
    ];

    const fleets = [
        { x: 300, y: 300, ships: 4, allegiance: 'player' },
        { x: 500, y: 500, ships: 2, allegiance: 'neutral' },
        { x: 700, y: 400, ships: 6, allegiance: 'enemy' }
    ];

    planets.forEach(planet => {
        planet.speed = 360 / (planet.realOrbitPeriod * timeScaleFactor);
        planet.moons.forEach(moon => {
            moon.speed = 360 / (moon.realOrbitPeriod * timeScaleFactor);
        });
    });

    const screenWidth = window.innerWidth;
    const screenHeight = window.innerHeight;
    const centerX = width / 2;
    const centerY = height / 2;
    const offsetX = screenWidth / 2 - centerX;
    const offsetY = screenHeight / 2 - centerY;

    const svg = d3.select("#system-map")
        .append("svg")
        .attr("width", screenWidth)
        .attr("height", screenHeight)
        .call(d3.zoom()
            .scaleExtent([0.5, 5])
            .on("zoom", zoomed));

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

    const container = svg.append("g")
        .attr("transform", `translate(${offsetX},${offsetY})`);

    function zoomed(event) {
        const transform = event.transform;
        container.attr("transform", `translate(${transform.x + offsetX},${transform.y + offsetY}) scale(${transform.k})`);
    }

    // Zeichne die Sonne
    container.append("circle")
        .attr("cx", centerX)
        .attr("cy", centerY)
        .attr("r", 40)
        .attr("fill", "#FFD700")
        .attr("filter", "url(#glow)");

    // Erstelle eine Gruppe für Planeten
    const planetGroups = container.selectAll("g.planet")
        .data(planets)
        .enter()
        .append("g")
        .attr("class", "planet");

    planetGroups.each(function(planet) {
        planet.trail = [];

        const planetGroup = d3.select(this);

        // Zeichne die Umlaufbahn des Planeten
        container.append("circle")
            .attr("cx", centerX)
            .attr("cy", centerY)
            .attr("r", planet.orbitRadius)
            .attr("fill", "none")
            .attr("stroke", "#666")
            .attr("stroke-dasharray", "2, 2")
            .attr("opacity", 0.5)
            .attr("class", "planet-orbit");

        // Hover-Zone für Planetenumlaufbahn
        const hoverZone = container.append("circle")
            .attr("cx", centerX)
            .attr("cy", centerY)
            .attr("r", planet.orbitRadius)
            .attr("fill", "none")
            .attr("stroke", "rgba(255, 255, 0, 0.2)")
            .attr("stroke-width", 20)
            .attr("opacity", 0)
            .on("mouseover", function() {
                d3.select(this).attr("opacity", 0.5);
            })
            .on("mouseout", function() {
                d3.select(this).attr("opacity", 0);
            });

        planet.hoverZone = hoverZone;

        // Zeichne den Planeten
        planetGroup.append("circle")
            .attr("class", "planet-body")
            .attr("r", planet.size)
            .attr("fill", planet.color)
            .on("mouseover", function() {
                planet.hoverZone.attr("opacity", 0.5); // Hover-Zone bei Hover auf Planeten anzeigen
            })
            .on("mouseout", function() {
                planet.hoverZone.attr("opacity", 0); // Hover-Zone bei Verlassen des Planeten ausblenden
            });

        // Schatten für Tag- und Nachtseite des Planeten
        planetGroup.append("path")
            .attr("class", "planet-shadow")
            .attr("fill", "rgba(0, 0, 0, 0.5)");

        // Erstelle Umlaufbahnen für die Monde relativ zum Planeten
        const moonOrbits = planetGroup.selectAll("circle.moon-orbit")
            .data(planet.moons)
            .enter()
            .append("circle")
            .attr("class", "moon-orbit")
            .attr("fill", "none")
            .attr("stroke", "#666")
            .attr("stroke-dasharray", "2, 2")
            .attr("opacity", 0.5);

        // Hover-Zone für Mondumlaufbahnen
        const moonHoverZones = planetGroup.selectAll("circle.moon-hover")
            .data(planet.moons)
            .enter()
            .append("circle")
            .attr("class", "moon-hover")
            .attr("fill", "none")
            .attr("stroke", "rgba(0, 0, 255, 0.2)")
            .attr("stroke-width", 10)
            .attr("opacity", 0)
            .on("mouseover", function(event, d) {
                d3.select(this).attr("opacity", 0.5);
            })
            .on("mouseout", function(event, d) {
                d3.select(this).attr("opacity", 0);
            });

        // Zeichne die Monde
        planetGroup.selectAll("circle.moon")
            .data(planet.moons)
            .enter()
            .append("circle")
            .attr("class", "moon")
            .attr("r", d => d.size)
            .attr("fill", d => d.color)
            .on("mouseover", function(event, moon) {
                d3.select(this.parentNode).selectAll(".moon-hover")
                    .filter(d => d === moon)
                    .attr("opacity", 0.5);
            })
            .on("mouseout", function(event, moon) {
                d3.select(this.parentNode).selectAll(".moon-hover")
                    .filter(d => d === moon)
                    .attr("opacity", 0);
            });
    });

    // Erstelle eine Gruppe für die Flottenanzeige
    const fleetGroup = container.selectAll("g.fleet")
        .data(fleets)
        .enter()
        .append("g")
        .attr("class", "fleet")
        .attr("transform", d => `translate(${d.x}, ${d.y})`);

    fleetGroup.each(function(fleet) {
        const colorMap = {
            player: "green",
            neutral: "gray",
            enemy: "red"
        };

        const group = d3.select(this);

        // Hintergrund und Rahmen der Flottenanzeige
        group.append("rect")
            .attr("x", -15)
            .attr("y", -10)
            .attr("width", 30)
            .attr("height", 20)
            .attr("fill", colorMap[fleet.allegiance])
            .attr("rx", 3)
            .attr("ry", 3)
            .attr("opacity", 0.2);

        // Symbol und Anzahl der Schiffe
        group.append("text")
            .attr("x", 0)
            .attr("y", 0)
            .attr("dy", "0.35em")
            .attr("fill", "white")
            .attr("text-anchor", "middle")
            .style("font-size", "12px")
            .style("font-weight", "bold")
            .text(fleet.ships);
    });

    // Funktion für die Umlaufbewegung von Planeten und Monden
    function rotatePlanets() {
        planetGroups.each(function(planet) {
            planet.angle = (planet.angle || 0) + planet.speed;
            const planetX = centerX + planet.orbitRadius * Math.cos(planet.angle * Math.PI / 180);
            const planetY = centerY + planet.orbitRadius * Math.sin(planet.angle * Math.PI / 180);

            // Aktualisiere Position des Planeten
            d3.select(this).select(".planet-body")
                .attr("cx", planetX)
                .attr("cy", planetY);

            // Aktualisiere die Mondumlaufbahnen relativ zum Planeten
            d3.select(this).selectAll(".moon-orbit, .moon-hover")
                .attr("cx", planetX)
                .attr("cy", planetY)
                .attr("r", d => d.orbitRadius);

            // Aktualisiere die Schattenposition des Planeten
            const shadowAngle = planet.angle - 90;
            const x1 = planetX + planet.size * Math.cos(shadowAngle * Math.PI / 180);
            const y1 = planetY + planet.size * Math.sin(shadowAngle * Math.PI / 180);
            const x2 = planetX + planet.size * Math.cos((shadowAngle + 180) * Math.PI / 180);
            const y2 = planetY + planet.size * Math.sin((shadowAngle + 180) * Math.PI / 180);

            d3.select(this).select(".planet-shadow")
                .attr("d", `M ${x1},${y1} A ${planet.size},${planet.size} 0 0,1 ${x2},${y2} L ${planetX},${planetY} Z`);

            // Aktualisiere Position der Monde um den Planeten
            d3.select(this).selectAll("circle.moon")
                .data(planet.moons)
                .attr("cx", d => planetX + d.orbitRadius * Math.cos((d.angle = (d.angle || 0) + d.speed) * Math.PI / 180))
                .attr("cy", d => planetY + d.orbitRadius * Math.sin(d.angle * Math.PI / 180));
        });

        requestAnimationFrame(rotatePlanets);
    }

    rotatePlanets();
}

// make function available to other scripts
window.renderGalaxyMap = renderGalaxyMap;
window.renderSystemMap = renderSystemMap;
