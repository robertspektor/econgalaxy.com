// Utility functions used by both Galaxy Map and System Map

// Convert degrees to radians
export const deg2rad = (degrees) => {
    return degrees * (Math.PI / 180);
};

// Calculate dimensions of the map
export const calculateDimensions = () => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    return { width, height, centerX: width / 2, centerY: height / 2 };
};

// Calculate sector position for System Map
export const calculateSectorPosition = (sector, centerX, centerY) => {
    const segmentCount = 18 + sector.ring_index * 2;
    const segmentAngle = 360 / segmentCount;
    const startAngle = sector.segment_index * segmentAngle;
    const midAngleRad = (startAngle + segmentAngle / 2);
    const radius = (sector.inner_radius + sector.outer_radius) / 2;

    const x = centerX + radius * Math.cos((midAngleRad - 90) * (Math.PI / 180));
    const y = centerY + radius * Math.sin((midAngleRad - 90) * (Math.PI / 180));

    return { x, y };
};
