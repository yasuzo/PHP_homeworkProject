<?php

declare(strict_types=1);

use PHPUint\Framework\TestCase;

class ZbrajanjeTest extends TestCase{
    public function testWithMultipleDigits(): void{
        $this->assertSame(6, zbrajanje('123'));
    }

    public function testWithLargeDigit(): void{
        $this->assertSame(135, zbrajanje('123456789123456789123456789'));
    }

    public function testWith(): void{
        $this->assertSame(6, zbrajanje(123));
    }

    public function testThatReturnsCorrect(): void{
        $this->assertSame(6, zbrajanje(123));
    }
}