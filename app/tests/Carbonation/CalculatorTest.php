<?php

namespace Tests\PantherIt\Brewery\Carbonation;

use PantherIt\Brewery\Carbonation\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testCalculate(): void
    {
        $calculator = new Calculator(30, 18, 2.7,5);
        $this->assertSame( 169.18,$calculator->getSugar());
        $this->assertSame(186.1,$calculator->getGlucose());
    }


}
