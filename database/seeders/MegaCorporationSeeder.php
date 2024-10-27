<?php

namespace Database\Seeders;

use App\Models\MegaCorporation;
use Illuminate\Database\Seeder;

class MegaCorporationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $megacorporations = [
            [
                'name' => 'Galactic Federation Shipyards',
                'description' => 'The backbone of the Galactic Federation\'s fleet, specializing in robust and reliable ships for commerce, defense, and political stability.',
                'faction_id' => \App\Models\Faction::where('name', 'Galactic Federation')->first()->id,
                'specialization' => 'Stable, resilient construction',
                'color' => '#1E90FF',
                'logo' => 'images/logos/galactic_federation_shipyards.png',
            ],
            [
                'name' => 'Astral Heavy Industries',
                'description' => 'Known for large-scale ships designed for resource extraction, production, and logistics, making them essential for industrial and military purposes.',
                'faction_id' => \App\Models\Faction::where('name', 'Galactic Federation')->first()->id,
                'specialization' => 'Heavy duty industrial ships',
                'color' => '#DAA520',
                'logo' => 'images/logos/astral_heavy_industries.png',
            ],
            [
                'name' => 'Stellar Dynamics',
                'description' => 'A pioneer in agile, adaptable ship designs suited for quick transportation and high-stakes operations, favored by the Trade Syndicate.',
                'faction_id' => \App\Models\Faction::where('name', 'Trade Syndicate')->first()->id,
                'specialization' => 'High-mobility and trade',
                'color' => '#FF8C00',
                'logo' => 'images/logos/stellar_dynamics.png',
            ],
            [
                'name' => 'Peregrine Robotics',
                'description' => 'Specializing in cutting-edge ship technologies, Peregrine Robotics provides ships with modularity and high maneuverability, often tailored for tactical operations.',
                'faction_id' => \App\Models\Faction::where('name', 'Trade Syndicate')->first()->id,
                'specialization' => 'Stealth and tactical agility',
                'color' => '#32CD32',
                'logo' => 'images/logos/peregrine_robotics.png',
            ],
            [
                'name' => 'Orion Shipbuilders',
                'description' => 'Builders of versatile, cost-effective ships that are easily modified, ideal for factions like the Rebel Alliance that value flexibility.',
                'faction_id' => \App\Models\Faction::where('name', 'Rebel Alliance')->first()->id,
                'specialization' => 'Customizability and flexibility',
                'color' => '#DC143C',
                'logo' => 'images/logos/orion_shipbuilders.png',
            ],
            [
                'name' => 'Hammerhead Industries',
                'description' => 'Known for their rugged and budget-friendly ship designs, Hammerhead Industries supplies the Rebel Alliance with combat-ready and modifiable vessels.',
                'faction_id' => \App\Models\Faction::where('name', 'Rebel Alliance')->first()->id,
                'specialization' => 'Rugged, affordable combat vessels',
                'color' => '#8B4513',
                'logo' => 'images/logos/hammerhead_industries.png',
            ],
            [
                'name' => 'Starfinder Systems',
                'description' => 'Innovators in exploration technology, Starfinder Systems creates advanced research vessels, scanners, and survey ships, perfect for long-term space exploration.',
                'faction_id' => \App\Models\Faction::where('name', 'Explorers Guild')->first()->id,
                'specialization' => 'Exploration and research technology',
                'color' => '#2E8B57',
                'logo' => 'images/logos/starfinder_systems.png',
            ],
            [
                'name' => 'Nova Transport Corp.',
                'description' => 'An essential partner for the Trade Syndicate, Nova Transport Corp. develops high-speed cargo ships optimized for exclusive trade routes and safe transport of valuable goods.',
                'faction_id' => \App\Models\Faction::where('name', 'Trade Syndicate')->first()->id,
                'specialization' => 'Fast, secure transport ships',
                'color' => '#4682B4',
                'logo' => 'images/logos/nova_transport_corp.png',
            ],
            [
                'name' => 'Union Defense Corp.',
                'description' => 'Specialists in defensive technology, providing the Galactic Federation with well-armored ships designed for escort and protection.',
                'faction_id' => \App\Models\Faction::where('name', 'Galactic Federation')->first()->id,
                'specialization' => 'Defensive armoring and escort vessels',
                'color' => '#4169E1',
                'logo' => 'images/logos/union_defense_corp.png',
            ],
            [
                'name' => 'Echo Covert Operations',
                'description' => 'A secretive manufacturer focusing on stealth-capable and surveillance-equipped ships, ideal for covert operations and high-risk trade routes.',
                'faction_id' => \App\Models\Faction::where('name', 'Trade Syndicate')->first()->id,
                'specialization' => 'Stealth and covert surveillance',
                'color' => '#696969',
                'logo' => 'images/logos/echo_covert_operations.png',
            ],
            [
                'name' => 'Iron Star Foundries',
                'description' => 'Known for building adaptable, modular ships, Iron Star Foundries\' designs are popular with the Rebel Alliance due to their customizability and resilience.',
                'faction_id' => \App\Models\Faction::where('name', 'Rebel Alliance')->first()->id,
                'specialization' => 'Customizable combat vessels',
                'color' => '#B22222',
                'logo' => 'images/logos/iron_star_foundries.png',
            ],
            [
                'name' => 'Deep Space Discoveries Ltd.',
                'description' => 'Focused on the needs of deep-space explorers, producing long-range ships equipped for resource discovery and system surveying.',
                'faction_id' => \App\Models\Faction::where('name', 'Explorers Guild')->first()->id,
                'specialization' => 'Long-range, deep-space exploration ships',
                'color' => '#556B2F',
                'logo' => 'images/logos/deep_space_discoveries.png',
            ],
        ];

        foreach ($megacorporations as $corp) {
            MegaCorporation::create($corp);
        }
    }
}
