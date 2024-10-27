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
    const gridSize = 50;

    // Beispiel für Daten der Planeten, Raumstationen, Asteroiden, etc.
    const planets = [
        { id: 1, name: 'Planet A', x: 200, y: 150, image: '133606071_10145164.png' },
        { id: 2, name: 'Planet B', x: 400, y: 350, image: '133606071_10145164.png' },
    ];

    const stations = [
        { id: 1, name: 'Station Alpha', x: 500, y: 100 },
    ];

    const asteroids = [
        { id: 1, name: 'Asteroid Belt', x: 700, y: 600 },
    ];

    const jumpGates = [
        { from: { x: 100, y: 100 }, to: { x: 800, y: 700 } },
    ];

    const ships = [
        { id: 1, name: 'Ship 1', x: 300, y: 500, owner: 'player' },
        { id: 2, name: 'Ship 2', x: 600, y: 400, owner: 'other' },
    ];

    // Erstelle das SVG-Element und füge Zoom- und Pan-Funktionalität hinzu
    const svg = d3.select("#system-map")
        .append("svg")
        // full width and height
        .attr("width", window.innerWidth)
        .attr("height", window.innerHeight)
        .call(d3.zoom()
            .scaleExtent([0.5, 5])  // Begrenze den Zoom-Faktor zwischen 50% und 500%
            .on("zoom", zoomed));

    // Gruppe, in der alle Elemente enthalten sind, um sie gemeinsam zu verschieben und zu skalieren
    const container = svg.append("g");

    // Funktion für das Zoomen und Panning mit Begrenzung
    function zoomed(event) {
        const transform = event.transform;

        // Grenzen setzen: Innerhalb des Bereichs (0, 0) bis (width, height)
        const scale = transform.k;  // Der aktuelle Zoom-Faktor

        // Berechne die Maximalen und Minimalen Translationen
        const maxX = Math.max(0, width * scale - 1024);  // width * scale - sichtbarer Bereich (1024)
        const maxY = Math.max(0, height * scale - 768);  // height * scale - sichtbarer Bereich (768)

        // Begrenze die Transformationen auf die Grid-Bounds
        const boundedX = Math.min(0, Math.max(transform.x, -maxX));
        const boundedY = Math.min(0, Math.max(transform.y, -maxY));

        container.attr("transform", `translate(${boundedX},${boundedY}) scale(${scale})`);
    }

    // 1. Gitternetz erstellen
    for (let x = 0; x < width; x += gridSize) {
        for (let y = 0; y < height; y += gridSize) {
            container.append("rect")
                .attr("x", x)
                .attr("y", y)
                .attr("width", gridSize)
                .attr("height", gridSize)
                .attr("fill", "rgba(55, 55, 55, 0.1)")
                .attr("stroke", "rgba(55, 55, 55, 1)")
                .attr("stroke-width", 0.2)
                .on("mouseover", function() {
                    d3.select(this)
                        .attr("fill", "rgba(55, 55, 55, 0.5)");
                })
                .on("mouseout", function() {
                    d3.select(this)
                        .attr("fill", "rgba(55, 55, 55, 0.1)");
                });
        }
    }

    // 2. Planeten, Raumstationen und Asteroiden platzieren

    // Planeten
    container.selectAll("circle.planet")
        .data(planets)
        .enter()
        .append("svg:image")
        .attr("class", "planet")
        .attr("x", d => d.x)
        .attr("y", d => d.y)
        .attr("width", 50)
        .attr("height", 50)
        .attr("xlink:href", d => `/images/planets/${d.image}`)

    // Raumstationen
    container.selectAll("rect.station")
        .data(stations)
        .enter()
        .append("rect")
        .attr("class", "station")
        .attr("x", d => d.x - 15)
        .attr("y", d => d.y - 15)
        .attr("width", 30)
        .attr("height", 30)
        .attr("fill", "gray");

    // Asteroidengürtel
    container.selectAll("circle.asteroid")
        .data(asteroids)
        .enter()
        .append("circle")
        .attr("class", "asteroid")
        .attr("cx", d => d.x)
        .attr("cy", d => d.y)
        .attr("r", 40)
        .attr("fill", "brown")
        .attr("opacity", 0.7);

    // 3. JumpGates als Linien zeichnen
    // container.selectAll("line.jumpgate")
    //     .data(jumpGates)
    //     .enter()
    //     .append("line")
    //     .attr("class", "jumpgate")
    //     .attr("x1", d => d.from.x)
    //     .attr("y1", d => d.from.y)
    //     .attr("x2", d => d.to.x)
    //     .attr("y2", d => d.to.y)
    //     .attr("stroke", "cyan")
    //     .attr("stroke-width", 2);

    // 4. Raumschiffe anzeigen
    container.selectAll("circle.ship")
        .data(ships)
        .enter()
        .append("circle")
        .attr("class", "ship")
        .attr("cx", d => d.x)
        .attr("cy", d => d.y)
        .attr("r", 10)
        .attr("fill", d => d.owner === 'player' ? 'green' : 'red');
}


// make function available to other scripts
window.renderGalaxyMap = renderGalaxyMap;
window.renderSystemMap = renderSystemMap;
