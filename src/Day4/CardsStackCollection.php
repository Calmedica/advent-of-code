<?php
declare(strict_types=1);

namespace App\Day4;

class CardsStackCollection
{

    /**
     * @var CardStack[]
     */
    private array $stacks;

    public function __construct() {}

    public function add(int $cardNumber, CardStack $stack) {
        $this->stacks[$cardNumber] = $stack;
    }

    public function getTotalCardsNumber() {
        return array_reduce($this->stacks, fn(int $total, CardStack $cardStack) => $total += $cardStack->numberOfCards(), 0);
    }

    public function computeStacksAugmentations() {
        ksort($this->stacks);

        foreach($this->stacks as $cardNumber => $stack) {
           if ($stack->matchingNumbers() === 0) {
               continue;
           }

           for($i = 1; $i <= $stack->matchingNumbers(); $i++) {
               $cardToAdd = $cardNumber + $i;
               if (array_key_exists($cardToAdd, $this->stacks)) {
                   $this->stacks[$cardToAdd]->addCards($stack->numberOfCards());
               }
           }
        }
    }


}