<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactionSeeder extends Seeder
{
    public function run(): void
    {
        // Define factions
        $factions = [
            [
                'name' => 'Galactic Federation',
                'description' => 'The largest political and economic organization in the galaxy. Known for stability and access to the biggest markets.',
                'color' => '#1E90FF',
                'benefits' => json_encode(['Lower taxes', 'Access to large and stable markets', 'Stable political environment']),
                'drawbacks' => json_encode(['Slower to adapt to changes', 'Strict regulations']),
                'leader' => 'Chancellor Amelia Ryker',
                'leader_bio' => 'A firm, pragmatic leader known for diplomacy and careful governance, emphasizing unity and market stability.',
                'lore' => 'The Galactic Federation was established centuries ago to unite disparate regions, fostering peace and commerce.',
                'preferred_ship_types' => json_encode(['Cruisers', 'Battlecruisers', 'Logistics Ships']),
                'allies' => json_encode(['Trade Syndicate']),
                'rivals' => json_encode(['Rebel Alliance', 'Rimward Nomads']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trade Syndicate',
                'description' => 'A powerful network of trading organizations, commanding exclusive trade routes and rare resources across the galaxy.',
                'color' => '#FF8C00',
                'benefits' => json_encode(['Enhanced access to rare resources', 'Lower transportation costs', 'Exclusive trade routes']),
                'drawbacks' => json_encode(['Higher risk of legal scrutiny', 'Limited political support']),
                'leader' => 'Lord Tyrell Marik',
                'leader_bio' => 'Known as “The Merchant Prince,” Marik is both respected and feared for his market influence.',
                'lore' => 'The Trade Syndicate grew from a coalition of independent traders into a galaxy-spanning economic powerhouse.',
                'preferred_ship_types' => json_encode(['Freighters', 'Blockade Runners', 'Light Escorts']),
                'allies' => json_encode(['Galactic Federation']),
                'rivals' => json_encode(['Rebel Alliance', 'Valtor Cartel']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rebel Alliance',
                'description' => 'A faction fighting for independence and freedom from centralized control, valuing self-governance.',
                'color' => '#DC143C',
                'benefits' => json_encode(['Increased production capacity', 'Access to remote resources', 'Flexible trade agreements']),
                'drawbacks' => json_encode(['Riskier trade relations', 'Limited protection from authorities']),
                'leader' => 'Commander Zara Delphine',
                'leader_bio' => 'A former Federation officer, Delphine leads the Alliance with tactical expertise and a focus on independence.',
                'lore' => 'What began as a resistance movement has evolved into a structured rebellion.',
                'preferred_ship_types' => json_encode(['Corvettes', 'Gunships', 'Bombers']),
                'allies' => json_encode(['Explorers Guild', 'Rimward Nomads']),
                'rivals' => json_encode(['Galactic Federation']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Explorers Guild',
                'description' => 'A faction of adventurers, scientists, and explorers dedicated to discovery and knowledge.',
                'color' => '#32CD32',
                'benefits' => json_encode(['Reduced research costs', 'Access to unique technologies', 'Faster exploration of new territories']),
                'drawbacks' => json_encode(['Limited military presence', 'High initial costs for exploration']),
                'leader' => 'Archon Lirien Sorva',
                'leader_bio' => 'A respected scientist committed to uncovering the galaxy’s secrets while encouraging cooperation.',
                'lore' => 'Founded by scholars, the Guild focuses on scientific progress and exploration.',
                'preferred_ship_types' => json_encode(['Exploration Vessels', 'Scouts', 'Science Vessels']),
                'allies' => json_encode(['Rebel Alliance']),
                'rivals' => json_encode(['Galactic Federation']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rimward Nomads',
                'description' => 'A loose confederation of frontier clans valuing independence, known for their resilience in uncharted regions.',
                'color' => '#A52A2A',
                'benefits' => json_encode(['High adaptability', 'Strong survival skills', 'Self-sufficient economies']),
                'drawbacks' => json_encode(['Limited access to core markets', 'Occasional conflicts with Federation']),
                'leader' => 'Chief Kael Marak',
                'leader_bio' => 'A hardened leader who prioritizes the independence of his people above all.',
                'lore' => 'The Rimward Nomads are a confederation of frontier clans who live outside the core worlds.',
                'preferred_ship_types' => json_encode(['Raider Ships', 'Scouts', 'Resource Gatherers']),
                'allies' => json_encode(['Rebel Alliance']),
                'rivals' => json_encode(['Galactic Federation']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Valtor Cartel',
                'description' => 'A criminal organization specializing in smuggling, black-market trade, and covert operations.',
                'color' => '#8B0000',
                'benefits' => json_encode(['Access to black-market goods', 'Stealth technology', 'Advanced evasion tactics']),
                'drawbacks' => json_encode(['Hostile relations with major factions', 'Reliance on secrecy']),
                'leader' => 'Don Miguel Alvara',
                'leader_bio' => 'A cunning leader known for his ruthless business acumen in the criminal underworld.',
                'lore' => 'The Valtor Cartel dominates black-market routes and is involved in smuggling and piracy.',
                'preferred_ship_types' => json_encode(['Smugglers', 'Blockade Runners', 'Stealth Ships']),
                'allies' => json_encode([]),
                'rivals' => json_encode(['Galactic Federation', 'Trade Syndicate']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Iron Star Foundries',
                'description' => 'A manufacturer of rugged, adaptable ships popular with the Rebel Alliance and frontier settlers.',
                'color' => '#708090',
                'benefits' => json_encode(['Durable and customizable ships', 'High adaptability']),
                'drawbacks' => json_encode(['Limited access to advanced technologies', 'Long production times']),
                'leader' => 'CEO Miranda Thorn',
                'leader_bio' => 'An experienced industrialist with a focus on quality and resilience.',
                'lore' => 'Iron Star Foundries crafts rugged, reliable ships and is a favored supplier for the outer territories.',
                'preferred_ship_types' => json_encode(['Modular Combat Ships', 'Rugged Transports']),
                'allies' => json_encode(['Rebel Alliance']),
                'rivals' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Starfinder Systems',
                'description' => 'Specialists in exploration technology, focused on advanced research vessels and deep-space navigation systems.',
                'color' => '#4682B4',
                'benefits' => json_encode(['High-end exploration ships', 'Enhanced sensor technologies']),
                'drawbacks' => json_encode(['Lower military capabilities']),
                'leader' => 'Director Ava Lin',
                'leader_bio' => 'An explorer and scientist with a passion for uncovering galactic mysteries.',
                'lore' => 'Dedicated to science and exploration, Starfinder Systems builds some of the most advanced exploration vessels.',
                'preferred_ship_types' => json_encode(['Exploration Vessels', 'Survey Ships']),
                'allies' => json_encode(['Explorers Guild']),
                'rivals' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Astral Heavy Industries',
                'description' => 'Builders of large-scale industrial and military vessels for resource extraction and logistics.',
                'color' => '#2E8B57',
                'benefits' => json_encode(['Heavy-duty industrial ships', 'High durability']),
                'drawbacks' => json_encode(['Limited maneuverability', 'Higher costs']),
                'leader' => 'President Samuel Trent',
                'leader_bio' => 'A no-nonsense industrialist, Trent is focused on maximizing productivity.',
                'lore' => 'Astral Heavy Industries provides large-scale, durable ships for industrial and military uses.',
                'preferred_ship_types' => json_encode(['Industrial Ships', 'Mining Vessels']),
                'allies' => json_encode([]),
                'rivals' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Echo Covert Operations',
                'description' => 'A secretive faction producing stealth and surveillance equipment for covert missions.',
                'color' => '#4B0082',
                'benefits' => json_encode(['Advanced stealth tech', 'Covert operations capabilities']),
                'drawbacks' => json_encode(['High maintenance', 'Limited durability']),
                'leader' => 'Shadow Admiral Nyra Kael',
                'leader_bio' => 'A mysterious figure known only by her codename, expert in covert ops.',
                'lore' => 'Echo Covert Operations specializes in stealth and reconnaissance technology.',
                'preferred_ship_types' => json_encode(['Stealth Ships', 'Recon Drones']),
                'allies' => json_encode([]),
                'rivals' => json_encode(['Galactic Federation']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert factions
        DB::table('factions')->insert($factions);

        // Fetch existing systems
        $systems = System::all();
        if ($systems->isEmpty()) {
            // Create some systems if none exist
            $systemNames = ['Alpheratz', 'Vega', 'Pollux', 'Fomalhaut', 'Betelgeuse'];
            foreach ($systemNames as $index => $name) {
                System::create([
                    'name' => $name,
                    'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
                    'x' => ($index - 2) * 100, // Spread systems out
                    'y' => ($index - 2) * 100,
                    'num_planets' => rand(1, 5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $systems = System::all();
        }

        // Assign systems to factions based on proximity to faction centers
        $factions = DB::table('factions')->get();
        foreach ($systems as $system) {
            $closestFaction = null;
            $minDistance = PHP_FLOAT_MAX;

            foreach ($factions as $faction) {
                $factionCenterX = ($faction->name === 'Galactic Federation') ? 0 : ($faction->name === 'Trade Syndicate' ? 10 : -10);
                $factionCenterY = ($faction->name === 'Galactic Federation') ? 0 : ($faction->name === 'Trade Syndicate' ? 10 : -10);

                $dx = $system->x - $factionCenterX;
                $dy = $system->y - $factionCenterY;
                $distance = sqrt($dx * $dx + $dy * $dy);

                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestFaction = $faction;
                }
            }

            // Assign the system to the closest faction
            $system->faction_id = $closestFaction->id;
            $system->save();
        }
    }
}
