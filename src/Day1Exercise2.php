<?php
declare(strict_types=1);

namespace App;

class Day1Exercise2
{
    private const array NUMBERS_AS_LETTERS = [
        1 => 'one',
        2 => "two",
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine'
    ];

    public function __construct(protected Day1Exercise1 $calibrationComputer) {}

    public function correctedCalibrationsForFile(string $filepath): int
    {
        $fileContent = file_get_contents($filepath);
        $lines = explode("\n", $fileContent);
        $correctedLines = array_map($this->correctStringOnNumberWrittenAsLetters(...), $lines);
        $linesCalibrations = array_map($this->calibrationComputer->getLineCalibration(...), $correctedLines);

        return array_sum($linesCalibrations);
    }

    public function correctStringOnNumberWrittenAsLetters(string $data): string
    {
        return str_replace(
            array_values(self::NUMBERS_AS_LETTERS),
            array_keys(self::NUMBERS_AS_LETTERS), $this->doubleLettersToAvoidNumbersOverlap($data),
            $data
        );
    }


    private function doubleLettersToAvoidNumbersOverlap(string $data):string {
        return str_replace(
            ['eightwo', 'oneight', 'sevenine', 'fiveight', 'nineight', 'eighthree', 'twone'],
            ['eighttwo', 'oneeight', 'sevennine', 'fiveeight', 'nineeight', 'eightthree', 'twoone'],
            $data
        );
    }

}