<?php


namespace PantherIt\Brewery\Carbonation;


final class Calculator
{
    private float $liter;
    private float $temperature;
    private float $carbonation;
    private float $blg;
    private float $sugar;

    public function __construct(float $liter, float $temperature, float $carbonation, float $blg)
    {
        if ($liter <= 0) {
            throw new \InvalidArgumentException(\sprintf('Liter %s cannot be less than 0', $liter));
        }
        if ($temperature <= 0) {
            throw new \InvalidArgumentException(\sprintf('Temperature %s cannot be less than 0', $temperature));
        }
        if ($carbonation <= 0) {
            throw new \InvalidArgumentException(\sprintf('Carbonation %s cannot be less than 0', $carbonation));
        }
        if ($blg < 0) {
            throw new \InvalidArgumentException(\sprintf('blg %s cannot be less than 0', $blg));
        }
        $this->liter = $liter;
        $this->temperature = $temperature;
        $this->carbonation = $carbonation;
        $this->blg = $blg;
        $this->sugar = $this->calculateSugar();
    }


    private function calculateSugar(): float
    {
        $fahrenheit = $this->temperature * (9 / 5) + 32;
        $co2 = 3.0378 - (0.050062 * $fahrenheit) + (0.00026555 * pow($fahrenheit, 2));
        $carbonation = $this->carbonation - $co2;
        if ($carbonation <= 0) {
            $carbonation = 0;
        }
        $sugar = round($carbonation * 4 * $this->liter, 2);
        return $sugar - ($this->blg * (($this->temperature * 10) / 20));
    }

    public function getSugar(): float
    {
        return $this->sugar;
    }

    public function getGlucose(): float
    {
        return round($this->sugar + $this->sugar * 0.1, 2);
    }


}