import * as d3 from 'd3';
import { calculateDimensions, deg2rad } from "./utils.js";

window.renderSystemMap = () => {
    console.log('Starting renderSystemMap with system:', window.mapData.systemMapData.system);

    // Holen Sie sich die Container-Dimensionen
    const containerElement = document.getElementById(`system-map-${window.mapData.systemMapData.system.id}`);
    const dimensions = {
        width: containerElement.clientWidth,
        height: containerElement.clientHeight
    };

    console.log('Container dimensions:', dimensions);

    // Wählen Sie den Container und löschen Sie vorhandene Inhalte
    const systemMapContainer = d3.select(`#system-map-${window.mapData.systemMapData.system.id}`);
    systemMapContainer.selectAll("*").remove();

    // Erstellen Sie das SVG mit expliziten Dimensionen
    const svg = systemMapContainer
        .append("svg")
        .attr("width", "100%")
        .attr("height", "100%")
        .attr("viewBox", `0 0 ${dimensions.width} ${dimensions.height}`)
        .style("background-color", "#1a1a24");

    const mapContainer = svg.append("g")
        .attr("transform", `translate(${dimensions.width / 2}, ${dimensions.height / 2})`);

    // Rest des Codes bleibt gleich, aber ersetzen Sie 'container' durch 'mapContainer'
    mapContainer.append("rect")
        .attr("x", -dimensions.width / 2)
        .attr("y", -dimensions.height / 2)
        .attr("width", dimensions.width)
        .attr("height", dimensions.height)
        .attr("fill", "#1a1a24");

    mapContainer.append("circle")
        .attr("cx", 0)
        .attr("cy", 0)
        .attr("r", 5)
        .attr("fill", "red");

    mapContainer.append("circle")
        .attr("cx", 0)
        .attr("cy", 0)
        .attr("r", 40)
        .attr("fill", "#FFD700");

    const planets = window.mapData.systemMapData.planets;
    planets.forEach(planet => {
        const angle = deg2rad(planet.angle);
        const x = planet.orbitRadius * Math.cos(angle);
        const y = planet.orbitRadius * Math.sin(angle);

        mapContainer.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", planet.orbitRadius)
            .attr("fill", "none")
            .attr("stroke", "#444")
            .attr("stroke-width", 1);

        const planetGroup = mapContainer.append("g")
            .attr("transform", `translate(${x},${y})`);

        planetGroup.append("circle")
            .attr("r", planet.size)
            .attr("fill", planet.color);

        planetGroup.append("text")
            .attr("y", planet.size + 15)
            .attr("text-anchor", "middle")
            .attr("fill", "#fff")
            .text(planet.name);
    });

    // Verbessertes Zoom-Verhalten
    const zoom = d3.zoom()
        .scaleExtent([0.5, 5])
        .on("zoom", (event) => {
            mapContainer.attr("transform", event.transform);
        });

    svg.call(zoom);

    // Initiale Zentrierung
    svg.call(zoom.transform,
        d3.zoomIdentity
            .translate(dimensions.width / 2, dimensions.height / 2)
            .scale(1)
    );
};

document.addEventListener('DOMContentLoaded', () => {
    if (window.mapData && window.mapData.systemMapData) {
        window.renderSystemMap();
    }
});
