<?php
declare(strict_types=1);

namespace App;

class Day1Exercise1
{
    public function getLineCalibration(string $input): int {
        $matches = [];
        preg_match_all('!\d!', $input, $matches);
        $digits = $matches[0];
        $firstAndLastDigit = [reset($digits), end($digits)];

        return (int) implode('', $firstAndLastDigit);
    }

    public function getTotalCalibrationForFile(string $filepath): int {
        $fileContent = file_get_contents($filepath);
        $lines = explode("\n", $fileContent);
        $linesCalibrations = array_map($this->getLineCalibration(...), $lines);

        return array_sum($linesCalibrations);
    }

}