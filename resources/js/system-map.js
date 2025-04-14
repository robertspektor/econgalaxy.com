import * as d3 from "d3";
import { calculateDimensions, deg2rad, calculateSectorPosition } from "./utils.js";

// Render the System Map
export const renderSystemMap = () => {
    console.log('Starting renderSystemMap with system:', window.mapData.systemMapData.system);

    const systemMapContainer = d3.select("#system-map");
    if (!systemMapContainer.node()) {
        console.error('System Map container (#system-map) not found in DOM');
        return;
    }
    systemMapContainer.selectAll("*").remove();

    const dimensions = calculateDimensions();
    const baseOrbitRadius = 100;
    const orbitSpacing = 100;

    const svg = initializeSvg(dimensions.width, dimensions.height);

    svg.append("rect")
        .attr("width", dimensions.width)
        .attr("height", dimensions.height)
        .attr("fill", "url(#scanlines)")
        .attr("opacity", 0.2)
        .classed("animate-crt-flicker", true);

    const backgroundContainer = svg.append("g");
    addParallaxBackground(backgroundContainer, dimensions, window.mapData.systemMapData.system);

    const container = svg.append("g");

    const centerX = dimensions.width / 2;
    const centerY = dimensions.height / 2;

    const sectorPositions = window.mapData.systemMapData.sectors.map(sector => ({
        ...sector,
        position: calculateSectorPosition(sector, centerX, centerY),
    }));

    const planetGroupsData = window.mapData.systemMapData.planets.map(planet => {
        const angleRad = deg2rad(planet.angle);
        const x = centerX + planet.orbitRadius * Math.cos(angleRad);
        const y = centerY + planet.orbitRadius * Math.sin(angleRad);
        return {
            ...planet,
            x,
            y,
            moons: window.mapData.systemMapData.moons.filter(moon => moon.planet_id === planet.id).map(moon => {
                const moonAngleRad = deg2rad(moon.angle);
                const moonX = moon.orbitRadius * Math.cos(moonAngleRad);
                const moonY = moon.orbitRadius * Math.sin(moonAngleRad);
                return { ...moon, x: moonX, y: moonY };
            }),
            isPlayerLocation: window.mapData.playerLocation && window.mapData.playerLocation.type === 'planet' && window.mapData.playerLocation.id === planet.id,
        };
    });

    const fleetPositions = window.mapData.systemMapData.fleets.map(fleet => {
        let x, y;
        if (fleet.current_sector_id) {
            const sector = window.mapData.systemMapData.sectors.find(s => s.id === fleet.current_sector_id);
            if (sector) {
                ({ x, y } = calculateSectorPosition(sector, centerX, centerY));
            } else {
                console.warn(`Sector not found for Fleet ${fleet.id} with Sector ID ${fleet.current_sector_id}`);
            }
        }
        if (!x || !y) {
            const planet = window.mapData.systemMapData.planets[Math.floor(Math.random() * window.mapData.systemMapData.planets.length)] || { orbitRadius: 100, angle: 0 };
            const angle = deg2rad(planet.angle + Math.random() * 360);
            x = centerX + (planet.orbitRadius + 30) * Math.cos(angle);
            y = centerY + (planet.orbitRadius + 30) * Math.sin(angle);
        }
        return { ...fleet, x, y };
    });

    addSun(container, centerX, centerY);
    addGlowEffect(svg);
    drawSectors(container, sectorPositions, centerX, centerY);
    drawOrbits(container, window.mapData.systemMapData.planets, centerX, centerY);
    drawPlanets(container, planetGroupsData, centerX, centerY);
    drawFleets(container, fleetPositions, centerX, centerY);

    svg.call(d3.zoom().scaleExtent([0.5, 3]).on("zoom", zoomed));

    function zoomed(event) {
        container.attr("transform", event.transform);
    }
};

const initializeSvg = (width, height) => {
    const svg = d3.select("#system-map")
        .append("svg")
        .attr("width", width)
        .attr("height", height);

    const defs = svg.append("defs");
    const pattern = defs.append("pattern")
        .attr("id", "scanlines")
        .attr("patternUnits", "userSpaceOnUse")
        .attr("width", 4)
        .attr("height", 4);
    pattern.append("line")
        .attr("x1", 0)
        .attr("y1", 0)
        .attr("x2", 0)
        .attr("y2", 4)
        .attr("stroke", "#00FFFF")
        .attr("stroke-width", 1)
        .attr("opacity", 0.3);

    return svg;
};

const addParallaxBackground = (backgroundContainer, dimensions, system) => {
    backgroundContainer.append("rect")
        .attr("width", dimensions.width)
        .attr("height", dimensions.height)
        .attr("x", 0)
        .attr("y", 0)
        .attr("fill", "#1a1a24");

    const backgroundImage = system.background_image || "/images/bg-stars.jpg";
    backgroundContainer.append("image")
        .attr("href", backgroundImage)
        .attr("width", dimensions.width)
        .attr("x", 0)
        .attr("y", 0);
};

const addSun = (container, x, y) => {
    container.append("circle")
        .attr("cx", x)
        .attr("cy", y)
        .attr("r", 40)
        .attr("fill", "#FFD700")
        .style("filter", "url(#glow)")
        .classed("animate-crt-flicker", true);
};

const addGlowEffect = (svg) => {
    const filter = svg.append("defs").append("filter")
        .attr("id", "glow")
        .attr("x", "-50%")
        .attr("y", "-50%")
        .attr("width", "200%")
        .attr("height", "200%");
    filter.append("feGaussianBlur").attr("stdDeviation", "20").attr("result", "blur");
    filter.append("feMerge").selectAll("feMergeNode")
        .data(["blur", "SourceGraphic"])
        .enter()
        .append("feMergeNode")
        .attr("in", d => d);
};

const drawSectors = (container, sectors, centerX, centerY) => {
    const sectorGroup = container.append("g").attr("class", "sectors");

    sectorGroup.selectAll("path")
        .data(sectors)
        .enter()
        .append("path")
        .attr("d", sector => {
            const segmentCount = 18 + sector.ring_index * 2;
            const segmentAngle = 360 / segmentCount;
            const startAngle = sector.segment_index * segmentAngle;
            const endAngle = startAngle + segmentAngle;
            return d3.arc()
                .innerRadius(sector.inner_radius)
                .outerRadius(sector.outer_radius)
                .startAngle((startAngle * Math.PI) / 180)
                .endAngle((endAngle * Math.PI) / 180)();
        })
        .attr("fill", "rgba(60, 60, 60, 0.2)")
        .attr("stroke", "rgba(60, 60, 60, 0.5)")
        .attr("transform", `translate(${centerX}, ${centerY})`)
        .attr("class", sector => `sector-segment Z${sector.ring_index}S${sector.segment_index}`);

    sectorGroup.selectAll("text")
        .data(sectors)
        .enter()
        .append("text")
        .attr("x", sector => sector.position.x)
        .attr("y", sector => sector.position.y - 15)
        .attr("text-anchor", "middle")
        .attr("dominant-baseline", "middle")
        .attr("fill", "#00FFFF")
        .attr("font-family", "monospace")
        .attr("font-size", "10px")
        .attr("class", sector => `sector-label sector-label-Z${sector.ring_index}S${sector.segment_index}`)
        .attr("opacity", 0)
        .attr("data-has-fleet", 0)
        .text(sector => `[Z${sector.ring_index}S${sector.segment_index}]`)
        .on("click", function(event, sector) {
            alert(`Sector Z${sector.ring_index}S${sector.segment_index}`);
        });

    sectorGroup.on("mouseover", function(event) {
        const target = d3.select(event.target);
        if (target.classed("sector-segment")) {
            target.attr("fill", "rgba(60, 60, 60, 0.4)");
            const sectorLabel = target.attr("class").split(" ")[1];
            d3.select(`.sector-label-${sectorLabel}`).attr("opacity", 1);
        }
    }).on("mouseout", function(event) {
        const target = d3.select(event.target);
        if (target.classed("sector-segment")) {
            target.attr("fill", "rgba(60, 60, 60, 0.2)");
            const sectorLabel = target.attr("class").split(" ")[1];
            if (d3.select(`.sector-label-${sectorLabel}`).attr("data-has-fleet") != 1) {
                d3.select(`.sector-label-${sectorLabel}`).attr("opacity", 0);
            }
        }
    });
};

const drawOrbits = (container, planets, centerX, centerY) => {
    const orbitGroup = container.append("g").attr("class", "orbits");

    orbitGroup.selectAll("circle")
        .data(planets)
        .enter()
        .append("circle")
        .attr("cx", centerX)
        .attr("cy", centerY)
        .attr("r", d => d.orbitRadius)
        .attr("fill", "none")
        .attr("stroke", "#00FFFF")
        .attr("stroke-dasharray", "4, 4")
        .attr("opacity", 0.3);
};

const drawPlanets = (container, planetGroupsData, centerX, centerY) => {


    console.log('Drawing planets with data:', planetGroupsData);

    const hoverZoneGroup = container.append("g").attr("class", "hover-zones");

    hoverZoneGroup.selectAll("circle")
        .data(planetGroupsData)
        .enter()
        .append("circle")
        .attr("cx", centerX)
        .attr("cy", centerY)
        .attr("r", d => d.orbitRadius)
        .attr("fill", "none")
        .attr("stroke", "rgba(55, 55, 55, 0.5)")
        .attr("stroke-width", 50)
        .attr("opacity", 0)
        .attr("class", d => `hover-zone-${d.id}`);

    const planetGroup = container.append("g").attr("class", "planets");

    const planetGroups = planetGroup.selectAll("g.planet")
        .data(planetGroupsData)
        .enter()
        .append("g")
        .attr("class", "planet")
        .attr("transform", d => `translate(${d.x}, ${d.y})`);

    planetGroups.each(function (planet) {
        const group = d3.select(this);

        group.append("circle")
            .attr("r", planet.size)
            .attr("fill", planet.color)
            .attr("class", `planet-circle-${planet.id}`);

        group.append("text")
            .attr("x", 0)
            .attr("y", planet.size + 15)
            .attr("text-anchor", "middle")
            .attr("fill", "#00FFFF")
            .attr("font-family", "monospace")
            .attr("font-size", "12px")
            .style("filter", "url(#glow)")
            .text(`[${planet.name}]`);

        if (planet.isPlayerLocation) {
            group.append("circle")
                .attr("r", planet.size + 5)
                .attr("fill", "none")
                .attr("stroke", "#00FFFF")
                .attr("stroke-width", 2);
        }

        drawPlanetShadow(group, planet.size);
        drawMoons(group, planet.moons);
    });

    planetGroup.on("mouseover", function(event) {
        const target = d3.select(event.target);
        if (target.classed("planet-circle")) {
            target.attr("stroke", "#FF00FF").attr("stroke-width", 2);
            const planetId = target.attr("class").split("-")[2];
            d3.select(`.hover-zone-${planetId}`).attr("opacity", 0.5);
        }
    }).on("mouseout", function(event) {
        const target = d3.select(event.target);
        if (target.classed("planet-circle")) {
            target.attr("stroke", null).attr("stroke-width", 0);
            const planetId = target.attr("class").split("-")[2];
            d3.select(`.hover-zone-${planetId}`).attr("opacity", 0);
        }
    }).on("click", function(event, planet) {
        if (d3.select(event.target).classed("planet-circle")) {
            alert(`Planet: ${planet.name}`);
        }
    });
};

const drawPlanetShadow = (group, size) => {
    const shadowAngle = -45;
    const x1 = size * Math.cos(shadowAngle * Math.PI / 180);
    const y1 = size * Math.sin(shadowAngle * Math.PI / 180);
    const x2 = size * Math.cos((shadowAngle + 180) * Math.PI / 180);
    const y2 = size * Math.sin((shadowAngle + 180) * Math.PI / 180);

    group.append("path")
        .attr("d", `M ${x1},${y1} A ${size},${size} 0 0,1 ${x2},${y2} L 0,0 Z`)
        .attr("fill", "rgba(0, 0, 0, 0.5)");
};

const drawMoons = (group, moons) => {
    const moonGroup = group.append("g").attr("class", "moons");

    moonGroup.selectAll("circle")
        .data(moons)
        .enter()
        .append("circle")
        .attr("cx", d => d.x)
        .attr("cy", d => d.y)
        .attr("r", d => d.size)
        .attr("fill", d => d.color)
        .classed("animate-crt-flicker", true);
};

const drawFleets = (container, fleetPositions, centerX, centerY) => {
    const fleetGroup = container.append("g").attr("class", "fleets");

    fleetGroup.selectAll("g.fleet")
        .data(fleetPositions)
        .enter()
        .append("g")
        .attr("class", "fleet")
        .attr("transform", d => `translate(${d.x}, ${d.y})`)
        .each(function (fleet) {
            const group = d3.select(this);

            group.append("polygon")
                .attr("points", "-10,10 10,10 0,-10")
                .attr("fill", fleet.isFriendly ? "#00FFFF" : "#FF00FF")
                .classed("animate-pulse", fleet.isFriendly)
                .classed("animate-crt-flicker", true);

            group.append("text")
                .attr("x", 0)
                .attr("y", 20)
                .attr("text-anchor", "middle")
                .attr("font-family", "monospace")
                .attr("font-size", "10px")
                .attr("fill", "#00FFFF")
                .text(`[${fleet.size}]`);
        });
};
