<?php
declare(strict_types=1);

namespace App\Tests;

use App\Day1Exercise1;
use App\Day1Exercise2;
use PHPUnit\Framework\TestCase;

class Day1Exercise2Test extends TestCase
{
    public function testReplaceNumbersInLettersByRealNumber(): void {
        $sut = new Day1Exercise2(new Day1Exercise1());
        $result = $sut->correctStringOnNumberWrittenAsLetters("five6seven");
        $this->assertSame('567', $result);
    }

    public function testReplaceFirstOccurrenceOfLetterNumberOfString(): void {
        $sut = new Day1Exercise2(new Day1Exercise1());
        $result = $sut->correctStringOnNumberWrittenAsLetters("eighthree4");
        $this->assertSame('834', $result);
    }

    public function testReplaceLastOccurrenceOfLetterNumberOfString(): void {
        $sut = new Day1Exercise2(new Day1Exercise1());
        $result = $sut->correctStringOnNumberWrittenAsLetters("four2eighthree");
        $this->assertSame('4283', $result);
    }

    public function testReplacement(): void {
        $sut = new Day1Exercise2(new Day1Exercise1());
        $result = $sut->correctStringOnNumberWrittenAsLetters("tdszrfzspthree2ttzseven5seven");
        $this->assertSame('tdszrfzsp32ttz757', $result);
    }

    public function testOtherReplacement(): void {
        $sut = new Day1Exercise2(new Day1Exercise1());
        $result = $sut->correctStringOnNumberWrittenAsLetters("2jcrmhfvntc3lqnine4five4");
        $this->assertSame('2jcrmhfvntc3lq9454', $result);
    }

    public function testCalibrationOnSampleData(): void {
        $sut = new Day1Exercise2(new Day1Exercise1());
        $result = $sut->correctedCalibrationsForFile(__DIR__ . '/fixtures/Day1Exercise2/givenSample');
        $this->assertSame(281, $result);
    }

    public function testOnRealData(): void {
        $sut = new Day1Exercise2(new Day1Exercise1());
        $result = $sut->correctedCalibrationsForFile(__DIR__ . '/fixtures/Day1Exercise1/realData');
        $this->expectNotToPerformAssertions();
//        var_dump($result);
    }
}