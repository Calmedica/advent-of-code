<?php
declare(strict_types=1);

namespace App;

use App\Day3\NumberAndPositionCombination;

class Day3
{

    /**
     * @param string $string
     * @return NumberAndPositionCombination[]
     */
    public function findNumbersWithItsPosition(string $string): array {
        $currentNumber = '';

        $numbersWithPosition = [];

        $characters = str_split($string);

        $beginPosition = null;
        foreach($characters as $position => $char) {
            if (in_array($char, [0,1,2,3,4,5,6,7,8,9])) {
                if ($currentNumber === '') {
                    $beginPosition = $position;
                }
                $currentNumber .= $char;
            } else {
                if ($currentNumber !== '') {
                    $endPosition = $position - 1;
                    $numbersWithPosition[] = new NumberAndPositionCombination((int) $currentNumber, $beginPosition, $endPosition);
                    $currentNumber = '';
                }
            }
        }

        if ($currentNumber !== '') {
            $endPosition = array_key_last($characters);
            $numbersWithPosition[] = new NumberAndPositionCombination((int) $currentNumber, $beginPosition, $endPosition);
        }

        return $numbersWithPosition;
    }

    public function getLinePartsSum(?string $precedingLine, string $currentLine, ?string $nextLine) {
        $existingNumbers = $this->findNumbersWithItsPosition($currentLine);

        $sumOfParts = 0;
        foreach($existingNumbers as $existingNumber) {
            if ($existingNumber->hasCharacterAdjacent($precedingLine, $currentLine, $nextLine)) {
                $sumOfParts += $existingNumber->number;
            }
        }

        return $sumOfParts;
    }

    public function getSumOfEnginePartsForFile(string $filePath): int {
        $file = file_get_contents($filePath);
        $lines = explode("\n", $file);

        $total = 0;
        foreach($lines as $lineNumber => $line) {
            $lineSum = $this->getLinePartsSum($lines[$lineNumber - 1] ?? null, $line, $lines[$lineNumber + 1] ?? null);
            $total += $lineSum;
        }

        return $total;
    }
}