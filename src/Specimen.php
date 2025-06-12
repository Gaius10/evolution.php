<?php

namespace Otimizer;

class Specimen
{
    public readonly float $y;

    public function __construct(public readonly float $x)
    {
    }

    public function setY(float $y)
    {
        $this->y = $y;
    }

    public function mutated(): static
    {
        return new static($this->x + rand(-5, 5));
    }
}
