<?php

declare(strict_types=1);

namespace App\Tests;

use App\Day1Exercise1;
use PHPUnit\Framework\TestCase;

class Day1Exercise1Test extends TestCase
{
    /**
     * @dataProvider oneRowDataProvider
     * @param string $input
     * @param int $expectedValue
     * @return void
     */
    public function testOneRowData(string $input, int $expectedValue): void
    {
        $sut = new Day1Exercise1();
        $result = $sut->getLineCalibration($input);
        $this->assertEquals($expectedValue, $result);
    }

    public static function oneRowDataProvider(): array
    {
        return [
            ['1mbecil3', 13], // Both digits at extremity of string
            ['1nfidel1ty', 11], // End digit in the string
            ['Perm1ss1on', 11], // Both digit in the string
            ['7oo muc8 d1g1t', 71], // Both digit in the string
            ['on1y one digit', 11], // Only a digit
            ['w17h two sticked together dig1ts', 11], // Only a digit
        ];
    }

    public function testMultipleLinesAreAddedAsFinalResult(): void
    {
        $sut = new Day1Exercise1();
        $result = $sut->getTotalCalibrationForFile(__DIR__ . '/fixtures/Day1Exercise1/myOwnTest');
        $this->assertEquals(24, $result);
    }

    public function testOnProvidedSample(): void
    {
        $sut = new Day1Exercise1();
        $result = $sut->getTotalCalibrationForFile(__DIR__ . '/fixtures/Day1Exercise1/givenSample');
        $this->assertEquals(142, $result);
    }

    public function testOnRealData(): void {
        $sut = new Day1Exercise1();
        $result = $sut->getTotalCalibrationForFile(__DIR__ . '/fixtures/Day1Exercise1/realData');
        $this->expectNotToPerformAssertions();
//        var_dump($result);
    }
}