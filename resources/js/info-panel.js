import * as d3 from "d3";

// Draw the info panel for the Galaxy Map
export const drawInfoPanel = (svg, width, height) => {
    const panelWidth = 300;
    const panelHeight = height - 40;
    const panel = svg.append("g")
        .attr("class", "info-panel")
        .attr("transform", `translate(-${panelWidth}, 20)`)
        .style("visibility", "hidden");

    // Panel background
    panel.append("rect")
        .attr("width", panelWidth)
        .attr("height", panelHeight)
        .attr("fill", "#23232f")
        .attr("stroke", "#00FFFF")
        .attr("stroke-width", 2)
        .classed("animate-crt-flicker", true);

    // Close button
    panel.append("text")
        .attr("x", panelWidth - 20)
        .attr("y", 30)
        .attr("fill", "#FF00FF")
        .attr("font-family", "monospace")
        .attr("font-size", "16px")
        .attr("text-anchor", "middle")
        .text("X")
        .on("click", () => {
            panel.transition()
                .duration(500)
                .attr("transform", `translate(-${panelWidth}, 20)`)
                .style("visibility", "hidden");
        });

    // Placeholder for system info
    panel.append("text")
        .attr("class", "info-title")
        .attr("x", 20)
        .attr("y", 50)
        .attr("fill", "#00FFFF")
        .attr("font-family", "monospace")
        .attr("font-size", "18px");

    panel.append("text")
        .attr("class", "info-coords")
        .attr("x", 20)
        .attr("y", 80)
        .attr("fill", "#00FFFF")
        .attr("font-family", "monospace")
        .attr("font-size", "14px");

    panel.append("text")
        .attr("class", "info-planets")
        .attr("x", 20)
        .attr("y", 110)
        .attr("fill", "#00FFFF")
        .attr("font-family", "monospace")
        .attr("font-size", "14px");

    panel.append("text")
        .attr("class", "info-faction")
        .attr("x", 20)
        .attr("y", 140)
        .attr("fill", "#00FFFF")
        .attr("font-family", "monospace")
        .attr("font-size", "14px");

    // Links
    panel.append("text")
        .attr("class", "link-market")
        .attr("x", 20)
        .attr("y", 180)
        .attr("fill", "#00FFFF")
        .attr("font-family", "monospace")
        .attr("font-size", "14px")
        .text("[MarketView]")
        .on("click", function() {
            alert("Navigate to MarketView");
        });

    panel.append("text")
        .attr("class", "link-system")
        .attr("x", 20)
        .attr("y", 210)
        .attr("fill", "#00FFFF")
        .attr("font-family", "monospace")
        .attr("font-size", "14px")
        .text("[SystemView]")
        .on("click", function() {
            alert("Navigate to SystemView");
        });
};

// Show the info panel with system details
export const showInfoPanel = (system) => {
    const panel = d3.select(".info-panel");
    panel.transition()
        .duration(500)
        .attr("transform", "translate(20, 20)")
        .style("visibility", "visible");

    panel.select(".info-title").text(`[System: ${system.name}]`);
    panel.select(".info-coords").text(`Coordinates: (${system.gridX}, ${system.gridY})`);
    panel.select(".info-planets").text(`Planets: ${system.num_planets || 0}`);
    panel.select(".info-faction").text(`Faction: ${system.faction ? system.faction.name : 'None'}`);
};
