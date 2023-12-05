<?php
declare(strict_types=1);

namespace App\Day2;

class Bag
{
    public function __construct(
        public readonly int $red,
        public readonly int $blue,
        public readonly int $green
    ) {

    }

    public function isAdaptedToCubeSet(CubesSet $maxCubesSet) {
        return $this->blue >= $maxCubesSet->blue()
            && $this->red >= $maxCubesSet->red()
            && $this->green >= $maxCubesSet->green();
    }

}