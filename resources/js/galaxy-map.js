import * as d3 from 'd3';
import { calculateDimensions, deg2rad } from "./utils.js";


window.renderGalaxyMap = function(mapData, container) {
    console.log('Starting renderGalaxyMap with data:', mapData);

    // Container-Dimensionen ermitteln und sicherstellen
    const containerElement = container;
    containerElement.style.width = '100%';
    containerElement.style.height = '100%';

    const dimensions = {
        width: containerElement.clientWidth || 800,
        height: containerElement.clientHeight || 600
    };

    // SVG mit festen Dimensionen erstellen
    const svg = d3.select(container)
        .append("svg")
        .attr("width", dimensions.width)
        .attr("height", dimensions.height)
        .style("background-color", "#1a1a24");

    // Hauptcontainer für die Karte
    const mainGroup = svg.append("g")
        .attr("transform", `translate(${dimensions.width/2}, ${dimensions.height/2})`);

    // Systeme verarbeiten und skalieren
    const systems = mapData.systems.map(system => ({
        ...system,
        x: system.gridX,
        y: system.gridY
    }));

    // Skalierung berechnen
    const xExtent = d3.extent(systems, d => d.x);
    const yExtent = d3.extent(systems, d => d.y);
    const xScale = d3.scaleLinear()
        .domain([xExtent[0], xExtent[1]])
        .range([-dimensions.width/3, dimensions.width/3]);
    const yScale = d3.scaleLinear()
        .domain([yExtent[0], yExtent[1]])
        .range([-dimensions.height/3, dimensions.height/3]);

    // Systeme zeichnen
    systems.forEach(system => {
        const x = xScale(system.x);
        const y = yScale(system.y);

        // System-Punkt
        mainGroup.append("circle")
            .attr("cx", x)
            .attr("cy", y)
            .attr("r", 5)
            .attr("fill", "#FFFFFF");

        // System-Name
        mainGroup.append("text")
            .attr("x", x)
            .attr("y", y + 15)
            .attr("text-anchor", "middle")
            .attr("fill", "#00FFFF")
            .attr("font-size", "12px")
            .text(system.name);
    });

    // Zoom-Verhalten
    const zoom = d3.zoom()
        .scaleExtent([0.1, 5])
        .on("zoom", (event) => {
            mainGroup.attr("transform", event.transform);
        });

    svg.call(zoom);

    // Initiale Zentrierung
    if (mapData.initialCenter) {
        const centerX = xScale(mapData.initialCenter.gridX);
        const centerY = yScale(mapData.initialCenter.gridY);
        svg.call(zoom.transform,
            d3.zoomIdentity
                .translate(dimensions.width/2 - centerX, dimensions.height/2 - centerY)
                .scale(0.5)
        );
    }
};
