import * as d3 from "d3";

var renderGalaxyMap = function (sectors, jumpGates) {

    // Größe der SVG-Karte
    const width = 1024;
    const height = 768;

    // Erstelle das SVG-Element mit dunklem Hintergrund
    const svg = d3.select("#galaxy-map")
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

window.renderGalaxyMap = renderGalaxyMap;
