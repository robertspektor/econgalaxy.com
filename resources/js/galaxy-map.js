import * as d3 from 'd3';
import { calculateDimensions } from "./utils.js";

window.renderGalaxyMap = function(mapData, container) {
    console.log('Starting renderGalaxyMap with data:', mapData);

    // Container leeren und neu initialisieren
    const containerElement = container;
    containerElement.style.width = '100%';
    containerElement.style.height = '100%';
    d3.select(container).selectAll("*").remove();

    const dimensions = {
        width: containerElement.clientWidth || 800,
        height: containerElement.clientHeight || 600
    };

    // SVG erstellen
    const svg = d3.select(container)
        .append("svg")
        .attr("width", dimensions.width)
        .attr("height", dimensions.height)
        .style("background-color", "#1a1a24");

    // Hauptcontainer für die Karte
    const mainGroup = svg.append("g")
        .attr("transform", `translate(${dimensions.width/2}, ${dimensions.height/2})`);

    // Systeme verarbeiten
    const systems = mapData.systems.map(system => ({
        ...system,
        x: system.gridX,
        y: system.gridY,
        isCurrentSystem: system.gridX === mapData.initialCenter.gridX &&
                        system.gridY === mapData.initialCenter.gridY
    }));

    // Skalierung
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

        // System-Gruppe
        const systemGroup = mainGroup.append("g")
            .attr("transform", `translate(${x},${y})`);

        if (system.isCurrentSystem) {
            // Äußerer Highlight-Ring
            systemGroup.append("circle")
                .attr("r", 12)
                .attr("fill", "none")
                .attr("stroke", "#00FFFF")
                .attr("stroke-width", 2)
                .attr("opacity", 0.5);

            // Pulsierende Animation
            systemGroup.append("circle")
                .attr("r", 8)
                .attr("fill", "none")
                .attr("stroke", "#00FFFF")
                .attr("stroke-width", 1)
                .attr("opacity", 0.3)
                .style("animation", "pulse 2s infinite");
        }

        // System-Punkt
        systemGroup.append("circle")
            .attr("r", system.isCurrentSystem ? 7 : 5)
            .attr("fill", system.isCurrentSystem ? "#00FFFF" : "#FFFFFF");

        // System-Name
        systemGroup.append("text")
            .attr("y", 15)
            .attr("text-anchor", "middle")
            .attr("fill", system.isCurrentSystem ? "#00FFFF" : "#FFFFFF")
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

    // Initiale Zentrierung auf das aktuelle System
    const centerX = xScale(mapData.initialCenter.gridX);
    const centerY = yScale(mapData.initialCenter.gridY);

    // Diminsion anpassen


    svg.call(zoom.transform,
        d3.zoomIdentity
            .translate(-centerX, -centerY)
            .translate(
                dimensions.width,
                dimensions.height / 2
            )

            .scale(1)
    );



    // CSS für die pulsierende Animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.5); opacity: 0.1; }
            100% { transform: scale(1); opacity: 0.3; }
        }
    `;
    document.head.appendChild(style);
};
