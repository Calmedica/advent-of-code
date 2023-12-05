<?php
declare(strict_types=1);

namespace App;

use App\Day4\CardsStackCollection;
use App\Day4\CardStack;

class Day4
{
    public function getNumberOfMatches(string $card) {
        [$winningNumbersRaw, $ownedNumbersRaw] = explode('|', $card);
        $winningNumbers = $ownedNumbers = [];

        preg_match_all('#\d+#', $winningNumbersRaw, $winningNumbers);
        preg_match_all('#\d+#', $ownedNumbersRaw, $ownedNumbers);

        return sizeof(array_intersect($winningNumbers[0], $ownedNumbers[0]));
    }

    public function getScoreByMatchingNumbers(int $matchingNumber): int {
        if ($matchingNumber < 2) {
            return $matchingNumber;
        }

        return pow(2, $matchingNumber-1);
    }

    public function getTotalScoreForFileOfCards(string $filePath) {
        $file = file_get_contents($filePath);
        $lines = explode("\n", $file);

        $total = 0;
        foreach($lines as $line) {
            [$card, $cardData] = explode(':', $line);
            $matchingNumbersCount = $this->getNumberOfMatches($cardData);
            $cardScore = $this->getScoreByMatchingNumbers($matchingNumbersCount);

            $total += $cardScore;
        }

        return $total;
    }

    public function getTotalCardsNumber(string $filePath) {
        $file = file_get_contents($filePath);
        $lines = explode("\n", $file);

        $cardsStackCollection = new CardsStackCollection();
        foreach($lines as $line) {
            [$card, $cardData] = explode(':', $line);
            $matches = [];
            preg_match("#\d+#", $card, $matches);
            $cardNumber = (int) $matches[0];
            $matchingNumbersCount = $this->getNumberOfMatches($cardData);
            $cardsStackCollection->add($cardNumber, new CardStack($matchingNumbersCount, 1));
        }

        $cardsStackCollection->computeStacksAugmentations();
        return $cardsStackCollection->getTotalCardsNumber();
    }


}