import * as d3 from "d3";
import { calculateDimensions } from "./utils.js";
import { renderSystemMap } from "./system-map.js";

// Render the Galaxy Map
export const renderGalaxyMap = (initialCenter = { gridX: 0, gridY: 0 }) => {
    console.log('Starting renderGalaxyMap with initialCenter:', initialCenter);

    const dimensions = calculateDimensions();

    // Clear any existing SVG content
    const galaxyMapContainer = d3.select("#galaxy-map");
    if (!galaxyMapContainer.node()) {
        console.error('Galaxy Map container (#galaxy-map) not found in DOM');
        return;
    }
    galaxyMapContainer.selectAll("*").remove();

    // Ensure the container is visible
    galaxyMapContainer.style("visibility", "visible");

    // Create SVG container
    const svg = galaxyMapContainer
        .append("svg")
        .attr("width", dimensions.width)
        .attr("height", dimensions.height);

    // Add background
    svg.append("rect")
        .attr("width", dimensions.width)
        .attr("height", dimensions.height)
        .attr("fill", "#1a1a24");

    // Add CRT scanlines overlay
    svg.append("rect")
        .attr("width", dimensions.width)
        .attr("height", dimensions.height)
        .attr("fill", "url(#scanlines)")
        .attr("opacity", 0.2)
        .classed("animate-crt-flicker", true);

    const container = svg.append("g");

    // Use the global window.mapData.systems variable
    const systemData = window.mapData.systems || [];
    console.log('System Data for Galaxy Map:', systemData);

    // Player's position and fleets
    let playerSystem = null;
    if (window.mapData.playerLocation.type === 'system') {
        playerSystem = systemData.find(system => system.id === window.mapData.playerLocation.id);
    } else if (window.mapData.playerLocation.type === 'planet' || window.mapData.playerLocation.type === 'moon') {
        playerSystem = systemData.find(system => {
            const planets = window.mapData.systemMapData.planets || [];
            return planets.some(planet => planet.id === window.mapData.playerLocation.id && planet.system_id === system.id);
        });
    }
    const playerFleets = window.mapData.systemMapData.fleets || [];

    console.log('Player Location:', window.mapData.playerLocation);
    console.log('Player System:', playerSystem);
    console.log('Player Fleets:', playerFleets);

    // Calculate the bounding box of all systems in their original coordinates
    const bounds = {
        minX: Infinity,
        maxX: -Infinity,
        minY: Infinity,
        maxY: -Infinity
    };

    systemData.forEach(system => {
        bounds.minX = Math.min(bounds.minX, system.gridX);
        bounds.maxX = Math.max(bounds.maxX, system.gridX);
        bounds.minY = Math.min(bounds.minY, system.gridY);
        bounds.maxY = Math.max(bounds.maxY, system.gridY);
    });

    console.log('Original Bounds:', bounds);

    // Normalize coordinates to fit within a 200x200 unit extent
    const originalExtentX = bounds.maxX - bounds.minX || 1; // Avoid division by zero
    const originalExtentY = bounds.maxY - bounds.minY || 1;
    const desiredExtent = 200; // Desired extent (200x200 units)

    // Calculate scaling factors to normalize to 200x200
    const scaleX = desiredExtent / originalExtentX;
    const scaleY = desiredExtent / originalExtentY;
    const normalizeScale = Math.min(scaleX, scaleY);

    // Normalize the coordinates
    const normalizedSystems = systemData.map(system => ({
        ...system,
        scaledX: (system.gridX - bounds.minX) * normalizeScale,
        scaledY: (system.gridY - bounds.minY) * normalizeScale
    }));

    // Recalculate the bounding box of the normalized coordinates
    const normalizedBounds = {
        minX: 0, // After normalization, min should be 0
        maxX: 0,
        minY: 0,
        maxY: 0
    };

    normalizedSystems.forEach(system => {
        normalizedBounds.maxX = Math.max(normalizedBounds.maxX, system.scaledX);
        normalizedBounds.maxY = Math.max(normalizedBounds.maxY, system.scaledY);
    });

    // Add padding for labels and fleets
    const padding = 50; // Padding to account for labels and fleets
    normalizedBounds.minX -= padding;
    normalizedBounds.maxX += padding;
    normalizedBounds.minY -= padding;
    normalizedBounds.maxY += padding;

    console.log('Normalized Bounds:', normalizedBounds);

    // Find the player's normalized position
    const playerNormalizedPosition = playerSystem ? {
        x: (playerSystem.gridX - bounds.minX) * normalizeScale,
        y: (playerSystem.gridY - bounds.minY) * normalizeScale
    } : { x: 0, y: 0 };

    console.log('Player Normalized Position:', playerNormalizedPosition);

    // Calculate the zoom scale to fit the entire extent within the viewport
    const extentWidth = normalizedBounds.maxX - normalizedBounds.minX;
    const extentHeight = normalizedBounds.maxY - normalizedBounds.minY;
    const zoomScaleX = dimensions.width / extentWidth;
    const extentScaleY = dimensions.height / extentHeight;
    const zoomScale = Math.min(zoomScaleX, extentScaleY);

    // Calculate the initial translation to center the player's system
    const translateX = dimensions.width / 2 - playerNormalizedPosition.x * zoomScale;
    const translateY = dimensions.height / 2 - playerNormalizedPosition.y * zoomScale;

    console.log('Initial Transform - Zoom Scale:', zoomScale, 'Translate X:', translateX, 'Translate Y:', translateY);

    // Set up the zoom behavior
    const zoom = d3.zoom()
        .scaleExtent([0.5, 3])
        .on("zoom", zoomed);

    svg.call(zoom);

    // Apply the initial transform using d3.zoom().transform to ensure smooth zooming
    svg.call(zoom.transform, d3.zoomIdentity.translate(translateX, translateY).scale(zoomScale));

    // Draw systems as stars
    let renderedSystems = 0;
    normalizedSystems.forEach(system => {
        const x = system.scaledX;
        const y = system.scaledY;
        console.log(`Drawing system ${system.name} at (${x}, ${y}) with ID: ${system.id}`);

        // System dot (star)
        container.append("circle")
            .attr("cx", x)
            .attr("cy", y)
            .attr("r", 3)
            .attr("fill", "#FFFFFF")
            .on("click", function() {
                console.log(`Clicked system ${system.name} with ID: ${system.id}`);
                // Add a delay to ensure Livewire is ready
                setTimeout(() => {
                    window.Livewire.dispatch('switchToSystem', { systemId: system.id });
                    document.dispatchEvent(new CustomEvent('switch-to-system', { detail: { systemId: system.id } }));
                }, 500);
            });

        // System label with increased font size
        container.append("text")
            .attr("x", x)
            .attr("y", y + 20) // Adjusted to account for larger font size
            .attr("fill", "#00FFFF")
            .attr("font-family", "monospace")
            .attr("font-size", "16px") // Increased font size
            .style("filter", "url(#glow)")
            .text(`[${system.name}]`)
            .attr("text-anchor", "middle")
            .classed("animate-crt-flicker", true);

        // Highlight player's system
        if (playerSystem && system.id === playerSystem.id) {
            container.append("circle")
                .attr("cx", x)
                .attr("cy", y)
                .attr("r", 6)
                .attr("fill", "none")
                .attr("stroke", "#00FFFF")
                .attr("stroke-width", 2)
                .classed("animate-crt-flicker", true);
        }

        // Draw player fleets
        const fleetsInSystem = playerFleets.filter(fleet => fleet.system_id === system.id);
        fleetsInSystem.forEach((fleet, index) => {
            const fleetX = x + (index * 25 - (fleetsInSystem.length - 1) * 12.5); // Adjusted spacing for larger labels
            const fleetY = y + 40; // Adjusted to account for larger font size
            container.append("polygon")
                .attr("points", "-5,5 5,5 0,-5")
                .attr("transform", `translate(${fleetX},${fleetY})`)
                .attr("fill", fleet.isFriendly ? "#00FFFF" : "#FF00FF")
                .classed("animate-pulse", fleet.isFriendly)
                .classed("animate-crt-flicker", true);
            container.append("text")
                .attr("x", fleetX)
                .attr("y", fleetY + 15)
                .attr("fill", "#00FFFF")
                .attr("font-family", "monospace")
                .attr("font-size", "12px")
                .attr("text-anchor", "middle")
                .text(`[F${fleet.id}]`);
        });

        renderedSystems++;
    });

    console.log(`Rendered ${renderedSystems} systems`);

    function zoomed(event) {
        container.attr("transform", event.transform);
    }
};

// Attach functions to the window object for global access
window.renderGalaxyMap = renderGalaxyMap;
window.renderSystemMap = renderSystemMap;
