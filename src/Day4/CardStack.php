<?php
declare(strict_types=1);

namespace App\Day4;

class CardStack
{
    public function __construct(protected int $matchingNumbers, protected int $numberOfCards) {

    }

    public function matchingNumbers(): int {
        return $this->matchingNumbers;
    }

    public function numberOfCards(): int {
        return $this->numberOfCards;
    }

    public function addCards(int $amount): void {
        $this->numberOfCards += $amount;
    }
}