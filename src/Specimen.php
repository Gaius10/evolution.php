<?php

namespace Otimizer;

class Specimen
{
    public readonly float $error;

    public function __construct(public readonly float $x)
    {
    }

    public function mutated(): static
    {
        return new static($this->x + rand(-5, 5));
    }

    public function setError(int $error)
    {
        $this->error = $error;
    }
}

