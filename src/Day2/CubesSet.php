<?php
declare(strict_types=1);

namespace App\Day2;

class CubesSet
{
    protected ?int $red = null;

    protected ?int $green = null;

    protected ?int $blue = null;

    public function __construct(string $rawResults) {
        $tries = explode(';', $rawResults);
        foreach($tries as $try) {
            $this->computeTry($try);
        }
    }

    public function red(): int {
        return $this->red;
    }

    public function blue(): int {
        return $this->blue;
    }

    public function green(): int {
        return $this->green;
    }

    private function computeTry(string $try): void {
        $detailByCubeType = explode(',', $try);
        foreach($detailByCubeType as $byCubeInfo) {
            $this->computeCubeInfo($byCubeInfo);
        }
    }

    private function computeCubeInfo(string $byCubeInfo) {
        $byCubeInfo = trim($byCubeInfo);
        [$numberOfCubes, $color] = explode(' ', $byCubeInfo);
        $numberOfCubes = (int) $numberOfCubes;
        if ($this->$color === null || $this->$color <= $numberOfCubes) {
            $this->$color = $numberOfCubes;
        }
    }

    public function getMinimalPower() {
        return $this->red*$this->blue*$this->green;
    }
}