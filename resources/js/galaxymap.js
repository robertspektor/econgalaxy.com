import * as d3 from "d3";

const renderGalaxyMap = (systems, fleets, spaceports) => {
    const svg = d3.select("#galaxy-map")
        .append("svg")
        .attr("width", window.innerWidth)
        .attr("height", window.innerHeight);

    addGlowEffect(svg);

    // Container für die Hauptkarte
    const container = svg.append("g");

    // Darstellung der Systeme, Flotten und Spaceports
    drawSystems(container, systems);
    drawFleets(container, fleets, systems);
    drawSpaceports(container, spaceports);
};

const drawSystems = (container, systems) => {
    systems.forEach(system => {
        // Hintergrundkreis für den "Stern-Effekt" und Glow
        container.append("circle")
            .attr("cx", system.x)
            .attr("cy", system.y)
            .attr("r", 6) // Kleinere Darstellung für den "Stern-Effekt"
            .attr("fill", "orange")
            .style("filter", "url(#glow)");

        // Heller Punkt im Inneren für den Sternen-Effekt
        container.append("circle")
            .attr("cx", system.x)
            .attr("cy", system.y)
            .attr("r", 1.5)
            .attr("fill", "white");

        // Systemname neben dem Punkt
        container.append("text")
            .attr("x", system.x + 16) // Position leicht rechts des Systems
            .attr("y", system.y + 4)  // Anpassung für vertikales zentrieren
            .attr("fill", "white")
            .attr("font-size", "13px")
            .text(system.name);

        // Hover-Zone für das System
        container.append("circle")
            .attr("cx", system.x)
            .attr("cy", system.y)
            .attr("r", 20) // Größere Zone für das Hover
            .attr("fill", "rgba(100, 100, 100, 0)")
            .attr("class", `hover-zone-${system.id}`)
            .on("mouseover", () => highlightSystem(system.id))
            .on("mouseout", () => resetSystemHighlight(system.id));
    });
};

// Funktion für den Glow-Effekt
const addGlowEffect = svg => {
    const filter = svg.append("defs").append("filter")
        .attr("id", "glow");

    filter.append("feGaussianBlur")
        .attr("stdDeviation", "3.5")
        .attr("result", "coloredBlur");

    filter.append("feMerge").selectAll("feMergeNode")
        .data(["coloredBlur", "SourceGraphic"])
        .enter()
        .append("feMergeNode")
        .attr("in", d => d);
};

const highlightSystem = (systemId) => {
    d3.select(`.hover-zone-${systemId}`)
        .attr("fill", "rgba(255, 255, 255, 0.3)");
};

const resetSystemHighlight = (systemId) => {
    d3.select(`.hover-zone-${systemId}`)
        .attr("fill", "rgba(100, 100, 100, 0)");
};

const calculateProgress = (departureTime, arrivalTime) => {
    const now = Date.now();
    const departure = new Date(departureTime).getTime();
    const arrival = new Date(arrivalTime).getTime();

    return Math.min(1, Math.max(0, (now - departure) / (arrival - departure)));
};

const drawFleets = (container, fleets, systems) => {
    fleets.forEach(fleet => {
        if (fleet.status === "moving") {
            const system = systems.find(system => system.id === fleet.system_id);
            const { x: startX, y: startY } = system;
            const { x: endX, y: endY } = system;

            // Linie für die Route
            container.append("line")
                .attr("x1", startX)
                .attr("y1", startY)
                .attr("x2", endX)
                .attr("y2", endY)
                .attr("stroke", "blue")
                .attr("stroke-width", 1)
                .attr("stroke-dasharray", "4,4");

            // Dreieck für die Flotte
            const fleetGroup = container.append("g")
                .attr("transform", `translate(${startX}, ${startY})`);

            fleetGroup.append("polygon")
                .attr("points", "-5,5 5,5 0,-5")
                .attr("fill", "green");

            // Animation zur Bewegung des Dreiecks entlang der Route
            animateFleet(fleetGroup, startX, startY, endX, endY, fleet);
        }
    });
};

// Animationsfunktion für die Flotte
const animateFleet = (fleetGroup, startX, startY, endX, endY, fleet) => {
    const totalDistance = Math.sqrt(Math.pow(endX - startX, 2) + Math.pow(endY - startY, 2));
    d3.timer(function(elapsed) {
        const progress = calculateProgress(fleet.departure_time, fleet.arrival_time);
        const x = startX + (endX - startX) * progress;
        const y = startY + (endY - startY) * progress;

        fleetGroup.attr("transform", `translate(${x}, ${y})`);

        if (progress >= 1) return true; // Stop animation
    });
};

const drawSpaceports = (container, spaceports) => {
    spaceports.forEach(port => {
        container.append("rect")
            .attr("x", port.system.x - 8) // Links des Systems
            .attr("y", port.system.y - 5) // Vertikal zentriert zum System
            .attr("width", 5)
            .attr("height", 5)
            .attr("fill", "blue");
    });
};

window.renderGalaxyMap = renderGalaxyMap;
