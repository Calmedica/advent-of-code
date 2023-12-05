<?php
declare(strict_types=1);

namespace App\Tests;

use App\Day3;
use App\Day3\NumberAndPositionCombination;
use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    public function testCheckPositionOfNumberInLine(): void {
        $sut = new Day3();
        $result = $sut->findNumbersWithItsPosition('.4516...89....1');
        $expected = [
            new NumberAndPositionCombination(4516, 1, 4),
            new NumberAndPositionCombination(89, 8, 9),
            new NumberAndPositionCombination(1, 14, 14),
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * @param string $precedingLine
     * @param string $currentLine
     * @param string $nextLine
     * @param int $expectedResult
     * @dataProvider checkIfAnotherCharacterIsPresentNearNumberProvider
     */
    public function testCheckIfAnotherCharacterIsPresentNearNumber(?string $precedingLine, string $currentLine, ?string $nextLine, int $expectedResult): void {
        $sut = new Day3();
        $result = $sut->getLinePartsSum($precedingLine, $currentLine, $nextLine);

        $this->assertEquals($expectedResult, $result);
    }

    public static function checkIfAnotherCharacterIsPresentNearNumberProvider(): array {
        return [
            [ // one adjacent character directly on top
                '..*...',
                '..89..',
                '......',
                89
            ],
            [ // one adjacent character diagonally
              '.*....',
              '..62..',
              '......',
              62
            ],
            [ // one adjacent directly on bottom
              '......',
              '..41..',
              '..$...',
              41
            ],
            [ // one adjacent on the left side
              '......',
              '.-22..',
              '......',
              22
            ],
            [ // one adjacent on the left side
              '......',
              '.-22..',
              '......',
              22
            ],
            [ // one existing character, with preceding line being null
              null,
              '..41..',
              '..$...',
              41
            ],
            [ // no characters present
              '......',
              '..89..',
              '......',
              0
            ],
            [ // existing characters but not adjacent
                '*.....',
                '..89..',
                '*.....',
              0
            ],
            [ // two numbers with both an adjacent character
              '...%.....',
              '..89...11',
              '........*',
              100
            ],
            [ // two numbers but only one is adjacent to a character
              '.........',
              '..89...11',
              '........*',
              11
            ],
        ];
    }

    public function testWithSampleData(): void {
        $sut = new Day3();
        $result = $sut->getSumOfEnginePartsForFile(__DIR__ . '/fixtures/Day3/givenSample');
        $this->assertEquals(4361, $result);
    }

    public function testOnRealData(): void {
        $sut = new Day3();
        $result = $sut->getSumOfEnginePartsForFile(__DIR__ . '/fixtures/Day3/realData');
        $this->expectNotToPerformAssertions();

//        var_dump($result);
    }
}