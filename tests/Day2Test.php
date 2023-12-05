<?php
declare(strict_types=1);

namespace App\Tests;

use App\Day2;
use App\Day2\Bag;
use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    /**
     * @dataProvider isGamePossibleProvider
     */
    public function testIsGamePossible(string $data, bool $expectedResult): void {
        $bag = new Bag(red: 5, blue: 3, green: 4);
        $sut = new Day2();
        $result = $sut->areResultsPossibleWithBag($data, $bag);
        $this->assertSame($expectedResult, $result);
    }

    public static function isGamePossibleProvider(): array {
        return [
            ['3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green', false],
            ['3 blue, 4 red; 1 red, 2 green, 2 blue; 2 green', true],
            ['3 blue, 4 red; 1 red, 2 green, 2 blue; 5 green', false],
        ];
    }

    /**
     * @dataProvider gameValueProvider
     */
    public function testGameValue(string $rawData, int $value): void {
        $bag = new Bag(red: 5, blue: 3, green: 4);
        $sut = new Day2();
        $result = $sut->getGameValueForTotal($rawData, $bag);
        $this->assertEquals($value, $result);
    }

    public static function gameValueProvider(): array {
        return [
            ['Game 15: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green', 0],
            ['Game 60: 3 blue, 4 red; 1 red, 2 green, 2 blue; 2 green', 60],
            ['Game 13: 3 blue, 4 red; 1 red, 2 green, 2 blue; 5 green', 0],
        ];
    }

    public function testWithSampleData(): void {
        $bag = new Bag(red: 12, blue: 14, green: 13);
        $sut = new Day2();
        $result = $sut->getTotalFromFile(__DIR__ . '/fixtures/Day2/givenSample', $bag);
        $this->assertEquals(8, $result);
    }

    public function testOnRealData(): void {
        $bag = new Bag(red: 12, blue: 14, green: 13);
        $sut = new Day2();
        $result = $sut->getTotalFromFile(__DIR__ . '/fixtures/Day2/realData', $bag);
        $this->expectNotToPerformAssertions();

//        var_dump($result);
    }

    /**
     * @dataProvider minimalPowerProvider
     */
    public function testMinimalPowerOfGame(string $gameData, $expectedPower): void {
        $sut = new Day2();
        $result = $sut->getMinimalPowerForGame($gameData);
        $this->assertSame($expectedPower, $result);
    }

    public static function minimalPowerProvider(): array {
        return [
            ['3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green', 48],
            ['3 blue, 4 red; 1 red, 2 green, 2 blue; 2 green', 24],
            ['3 blue, 4 red; 1 red, 2 green, 2 blue; 5 green', 60],
        ];
    }

    public function testMinimalPowerWithSampleData(): void {
        $sut = new Day2();
        $result = $sut->getMinimaPowerFromFile(__DIR__ . '/fixtures/Day2/givenSample');
        $this->assertEquals(2286, $result);
    }

    public function testMinimalPowerOnRealData(): void {
        $sut = new Day2();
        $result = $sut->getMinimaPowerFromFile(__DIR__ . '/fixtures/Day2/realData');
        $this->expectNotToPerformAssertions();

//        var_dump($result);
    }
}