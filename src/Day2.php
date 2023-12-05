<?php
declare(strict_types=1);

namespace App;

use App\Day2\Bag;
use App\Day2\CubesSet;

class Day2
{
    public function getGameValueForTotal(string $rawData, Bag $bag): int {
        [$game, $rawResults] = explode(':', $rawData);
        if (!$this->areResultsPossibleWithBag($rawResults, $bag)) {
            return 0;
        }

        return (int) str_replace('Game ', '', $game);
    }

    public function areResultsPossibleWithBag(string $rawResults, Bag $bag): bool
    {
        $maxCubesSet = new CubesSet($rawResults);
        return $bag->isAdaptedToCubeSet($maxCubesSet);
    }

    public function getTotalFromFile(string $filePath, Bag $bag): int {
        $file = file_get_contents($filePath);
        $lines = explode("\n", $file);

        $total = 0;
        foreach($lines as $line) {
            $total += $this->getGameValueForTotal($line, $bag);
        }

        return $total;
    }

    public function getMinimalPowerForGame(string $gameData): int {
        $minCubesSet = new CubesSet($gameData);
        return $minCubesSet->getMinimalPower();
    }

    public function getMinimaPowerFromFile(string $filePath): int {
        $file = file_get_contents($filePath);
        $lines = explode("\n", $file);

        $total = 0;
        foreach($lines as $line) {
            [,$rawResults] = explode(':', $line);
            $minimalPower = $this->getMinimalPowerForGame($rawResults);
            $total += $minimalPower;
        }

        return $total;
    }


}