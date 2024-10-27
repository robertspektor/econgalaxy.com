<?php

namespace Database\Seeders;

use App\Models\Faction;
use App\Models\PlayerOrigin;
use Illuminate\Database\Seeder;

class PlayerOriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $origins = [
            [
                'name' => 'Federation Core Worlder',
                'image' => 'federation_core_worlder.jpeg',
                'region' => 'Core sectors of the Galactic Federation',
                'description' => 'Born and raised on one of the Federation\'s secure, resource-rich core planets, Federation Core Worlders enjoy stability and robust infrastructure.',
                'starting_ship' => 'Federation Transporter',
                'manufacturer' => 'Galactic Federation Shipyards',
                'ship_description' => 'A versatile, medium-sized vessel designed for safe trade and transport within well-patrolled regions.',
                'benefits' => ['Increased economic stability', 'Access to Federation trade routes', 'Reduced travel restrictions'],
                'drawbacks' => ['Strict adherence to Federation laws', 'Higher taxes on trade'],
                'faction_id' => Faction::where('name', 'Galactic Federation')->value('id'),
            ],
            [
                'name' => 'Independent Trader',
                'image' => 'independent_trader.jpeg',
                'region' => 'Trade Syndicate-controlled trade hubs in the mid-systems',
                'description' => 'As an Independent Trader, you’re a product of the bustling Syndicate trade hubs, where market connections are everything.',
                'starting_ship' => 'Syndicate Freighter',
                'manufacturer' => 'Nova Transport Corp',
                'ship_description' => 'A fast, medium-capacity cargo vessel optimized for quick trades and short-range hauls, with limited defense capabilities.',
                'benefits' => ['Access to valuable trade routes', 'Reduced trade tariffs', 'Higher success rate in negotiations'],
                'drawbacks' => ['Increased risk of piracy', 'Subject to Syndicate trade oversight'],
                'faction_id' => Faction::where('name', 'Trade Syndicate')->value('id'),
            ],
            [
                'name' => 'Outer Rim Colonist',
                'image' => 'outer_rim_colonist.jpeg',
                'region' => 'Border regions governed loosely by the Rebel Alliance',
                'description' => 'Growing up on the edge of the Federation’s reach, you’re accustomed to life in the rugged, independent territories of the Outer Rim.',
                'starting_ship' => 'Frontier Scout',
                'manufacturer' => 'Orion Shipbuilders',
                'ship_description' => 'A light, agile vessel designed for exploration, resource gathering, and rapid escape from potential threats.',
                'benefits' => ['Increased adaptability', 'Access to remote resources', 'Fewer legal restrictions'],
                'drawbacks' => ['Limited access to core markets', 'Reduced governmental support'],
                'faction_id' => Faction::where('name', 'Rebel Alliance')->value('id'),
            ],
            [
                'name' => 'Explorer’s Guild Apprentice',
                'image' => 'explorers_guild_apprentice.jpeg',
                'region' => 'Guild Outposts in uncharted regions',
                'description' => 'Trained by the Explorers Guild, you come from a long line of adventurers and scientists dedicated to uncovering the galaxy’s secrets.',
                'starting_ship' => 'Surveyor',
                'manufacturer' => 'Starfinder Systems',
                'ship_description' => 'A small exploration vessel equipped with advanced sensors and storage for collected samples, ideal for surveying new territories.',
                'benefits' => ['Enhanced exploration capabilities', 'Access to unique Guild technologies', 'Reduced research costs'],
                'drawbacks' => ['Limited combat skills', 'Higher equipment maintenance costs'],
                'faction_id' => Faction::where('name', 'Explorers Guild')->value('id'),
            ],
            [
                'name' => 'Frontier Nomad',
                'image' => 'frontier_nomad.jpeg',
                'region' => 'Far reaches controlled by the Rimward Nomads',
                'description' => 'Raised on the frontier with minimal oversight from the core powers, you value self-sufficiency and freedom.',
                'starting_ship' => 'Ranger Class',
                'manufacturer' => 'Iron Star Foundries',
                'ship_description' => 'A durable, all-purpose vessel designed for long-range patrols and self-sustained operations, equipped for minimal resource gathering and basic defenses.',
                'benefits' => ['Increased survival skills', 'Self-sufficiency', 'Reduced resource consumption'],
                'drawbacks' => ['Limited access to advanced technologies', 'Higher risk of piracy'],
                'faction_id' => Faction::where('name', 'Rebel Alliance')->value('id'),
            ],
            [
                'name' => 'Cartel Affiliate',
                'image' => 'cartel_affiliate.jpeg',
                'region' => 'Black-market routes under Valtor Cartel influence',
                'description' => 'Growing up on the edge of the law, you have a history with the underworld, particularly with smuggling and high-risk ventures.',
                'starting_ship' => 'Smuggler’s Vessel',
                'manufacturer' => 'Echo Covert Operations',
                'ship_description' => 'A small, nimble ship with hidden cargo compartments, designed for swift escapes and evading detection.',
                'benefits' => ['Access to black-market goods', 'Evasion from authorities', 'Reduced detection risk'],
                'drawbacks' => ['Constant threat from law enforcement', 'Limited access to legal markets'],
                'faction_id' => Faction::where('name', 'Valtor Cartel')->value('id'),
            ],
            [
                'name' => 'Industrial Technician',
                'image' => 'industrial_technician.jpeg',
                'region' => 'Industrial hubs managed by Astral Heavy Industries',
                'description' => 'Coming from one of the massive industrial complexes, you’re experienced in resource extraction and logistics.',
                'starting_ship' => 'Mineral Hauler',
                'manufacturer' => 'Astral Heavy Industries',
                'ship_description' => 'A high-capacity ship suited for resource gathering, equipped with basic mining lasers and storage for extracted materials.',
                'benefits' => ['Increased cargo capacity', 'Access to industrial equipment', 'Reduced maintenance costs'],
                'drawbacks' => ['Reduced combat readiness', 'Lower speed and maneuverability'],
                'faction_id' => Faction::where('name', 'Astral Heavy Industries')->value('id'),
            ],
        ];


        foreach ($origins as $origin) {
            PlayerOrigin::create($origin);
        }
    }
}
