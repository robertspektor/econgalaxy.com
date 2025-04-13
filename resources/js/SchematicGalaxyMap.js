import * as d3 from "d3";

const renderSchematicGalaxyMap = (systems, fleets, spaceports) => {
    const svg = d3.select("#galaxy-map")
        .append("svg")
        .attr("width", window.innerWidth)
        .attr("height", window.innerHeight);

    const centerX = window.innerWidth / 2;
    const centerY = window.innerHeight / 2;
    const ringSpacing = 150; // Abstand zwischen den Ringen
    const systemsPerRing = 8; // Anzahl der Systeme pro Ring

    // Container für die Hauptkarte
    const container = svg.append("g");

    // Darstellung der Ringe und Systeme
    drawSchematicSystems(container, systems, centerX, centerY, ringSpacing, systemsPerRing);
    drawFleets(container, fleets, systems);
    // drawSpaceports(container, spaceports);
};

const drawSchematicSystems = (container, systems, centerX, centerY, ringSpacing, systemsPerRing) => {
    systems.forEach((system, index) => {
        const ringIndex = Math.floor(index / systemsPerRing);
        const angle = (index % systemsPerRing) * (360 / systemsPerRing);
        const radius = ringSpacing * (ringIndex + 1);

        const x = centerX + radius * Math.cos((angle - 90) * (Math.PI / 180));
        const y = centerY + radius * Math.sin((angle - 90) * (Math.PI / 180));

        // System Punkt mit "Glow" Effekt
        container.append("circle")
            .attr("cx", x)
            .attr("cy", y)
            .attr("r", 3)
            .attr("fill", "orange")
            .style("filter", "url(#glow)");

        // Systemname neben dem Punkt
        container.append("text")
            .attr("x", x + 8) // Position rechts des Systems
            .attr("y", y + 4)
            .attr("fill", "blue")
            .attr("font-size", "10px")
            .text(system.name);
    });
};

const drawFleets = (container, fleets, systems) => {
    fleets.forEach(fleet => {
        if (fleet.status === "moving") {
            const startSystem = systems.find(s => s.id === fleet.start_system_id);
            const endSystem = systems.find(s => s.id === fleet.end_system_id);

            if (startSystem && endSystem) {
                // Berechnung des Start- und Endpunkts für die Flotte
                const startX = startSystem.x;
                const startY = startSystem.y;
                const endX = endSystem.x;
                const endY = endSystem.y;

                // Linie für die Route zwischen Start und Ziel
                container.append("line")
                    .attr("x1", startX)
                    .attr("y1", startY)
                    .attr("x2", endX)
                    .attr("y2", endY)
                    .attr("stroke", "blue")
                    .attr("stroke-width", 1)
                    .attr("stroke-dasharray", "4,4");

                // Dreieck für die Flotte, das sich entlang der Linie bewegt
                const fleetGroup = container.append("g")
                    .attr("transform", `translate(${startX}, ${startY})`);

                fleetGroup.append("polygon")
                    .attr("points", "-5,5 5,5 0,-5")
                    .attr("fill", "green");

                animateFleet(fleetGroup, startX, startY, endX, endY, fleet);
            }
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

// Funktion zum Hinzufügen des Glow-Effekts
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

// Progress-Funktion für Flottenbewegung
const calculateProgress = (departureTime, arrivalTime) => {
    const now = Date.now();
    const departure = new Date(departureTime).getTime();
    const arrival = new Date(arrivalTime).getTime();

    return Math.min(1, Math.max(0, (now - departure) / (arrival - departure)));
};

window.renderSchematicGalaxyMap = renderSchematicGalaxyMap;
