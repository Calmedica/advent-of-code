<?php
declare(strict_types=1);

namespace App\Tests;

use App\Day4;
use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    /**
     * @param string $card
     * @param $expectedNumberOfMatches
     * @dataProvider cardsContentProvider
     */
    public function testMatchingNumbersOnBothSideOfACard(string $card, $expectedNumberOfMatches): void {
        $sut = new Day4();
        $result = $sut->getNumberOfMatches($card);

        $this->assertEquals($expectedNumberOfMatches, $result);
    }

    public static function cardsContentProvider(): array {
        return [
            ['41 48 83 86 17 | 83 86  6 31 17  9 48 53', 4],
            ['41 92 73 84 69 | 59 84 76 51 58  5 54 83', 1]
        ];
    }

    /**
     * @param int $matchingNumber
     * @param int $expectedScore
     * @dataProvider matchingNumbersScoreProvider
     */
    public function testCardScoreByMatchingNumbers(int $matchingNumber, int $expectedScore): void {
        $sut = new Day4();
        $result = $sut->getScoreByMatchingNumbers($matchingNumber);

        $this->assertEquals($expectedScore, $result);
    }

    public static function matchingNumbersScoreProvider(): array {
        return [
            [0, 0],
            [1, 1],
            [2, 2],
            [3, 4],
            [4, 8],
            [5, 16]
        ];
    }

    public function testWithSampleData(): void {
        $sut = new Day4();
        $result = $sut->getTotalScoreForFileOfCards(__DIR__ . '/fixtures/Day4/givenSample');
        $this->assertEquals(13, $result);
    }

    public function testOnRealData(): void {
        $sut = new Day4();
        $result = $sut->getTotalScoreForFileOfCards(__DIR__ . '/fixtures/Day4/realData');
        $this->expectNotToPerformAssertions();

//        var_dump($result);
    }

    public function testNewCardsAreCreatedWhenMatchingNumbersExist(): void {
        $sut = new Day4();
        $result = $sut->getTotalCardsNumber(__DIR__ . '/fixtures/Day4/givenSample');

        $this->assertEquals(30, $result);
    }

    public function testCardsQuantityOnRealData(): void {
        $sut = new Day4();
        $result = $sut->getTotalCardsNumber(__DIR__ . '/fixtures/Day4/realData');

        $this->expectNotToPerformAssertions();
//        var_dump($result);
    }
}