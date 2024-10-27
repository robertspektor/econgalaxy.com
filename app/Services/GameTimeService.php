<?php

namespace App\Services;

use Carbon\Carbon;

class GameTimeService
{
    private $startYear = 2765;  // Startjahr in GY
    private $timeFactor = 60;   // Zeitfaktor (1 Spielminute = 60 reale Sekunden)

    /**
     * Berechnet die aktuelle Spielzeit basierend auf der realen Zeit.
     *
     * @return array
     */
    public function getCurrentGameTime()
    {
        // Startzeitpunkt des Spiels
        $gameStart = Carbon::create($this->startYear, 1, 1, 0, 0, 0);

        // Verstrichene reale Sekunden seit dem Startzeitpunkt
        $realSecondsElapsed = now()->diffInSeconds($gameStart);

        // Verstrichene Spielminuten unter Berücksichtigung des Zeitfaktors
        $gameMinutesElapsed = $realSecondsElapsed * $this->timeFactor;

        // Ermittlung des aktuellen Spieljahrs und Tages in GY
        $currentGameDate = $gameStart->copy()->addMinutes($gameMinutesElapsed);

        // Formatieren der Spielzeit als Jahr, Tag und Uhrzeit
        $gameTime = [
            'year' => $currentGameDate->year,
            'day' => $currentGameDate->dayOfYear,
            'time' => $currentGameDate->format('H:i:s')
        ];

        return $gameTime;
    }
}
