<?php
declare(strict_types=1);

namespace App\Day3;

class NumberAndPositionCombination
{
    public function __construct(
        public readonly int $number,
        public readonly int $beginPosition,
        public readonly int $endPosition,
    ) {

    }

    public function hasCharacterAdjacent(?string $precedingLine, string $currentLine, ?string $nextLine):bool {
        $searchedBeginPosition = $this->beginPosition - 1;
        if ($searchedBeginPosition < 0) {
            $searchedBeginPosition = 0;
        }
        $searchedEndPosition = $this->endPosition + 1;

        $searchedPortionLength = $searchedEndPosition - $searchedBeginPosition + 1;

        foreach ([$precedingLine, $currentLine, $nextLine] as $line) {
            if ($line === null) {
                continue;
            }
            $adjacentLinePortion = substr($line, $searchedBeginPosition, $searchedPortionLength);
            if (preg_match('/[^0-9.]+/', $adjacentLinePortion)) {
                return true;
            }
        }

        return false;
    }

}