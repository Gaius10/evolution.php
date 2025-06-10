<?php

namespace Otimizer;

class Application
{
    protected Specimen $champion;

    /**
     * @param array<Specimen> $population
     */
    public function __construct(
        protected int $size,
        protected int $target,
        protected \Closure $avaliationFunction,
        protected array $population = [],
    ) {
        $this->avaliationFunction = function (Specimen $s) use ($avaliationFunction) {
            return (int) $avaliationFunction($s);
        };

        if (count($this->population) === 0) {
            $this->init();
        }
    }

    public function dump(string $path)
    {
        $data = array_map(function (Specimen $s) {
            $row = [ 'x' => $s->x ];

            if (isset($s->error)) {
                $row['error'] = $s->error;
            }

            return $row;
        }, $this->population);

        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
    }

    /** @return array<Specimen> */
    public function snapshot(): array
    {
        return $this->population;
    }

    public function getChampion(): Specimen
    {
        return $this->champion;
    }

    private function init()
    {
        for ($i = 0; $i < $this->size; $i++) {
            $this->population[] = new Specimen(rand(-100, 100));
        }
    }

    public function avaliate()
    {
        foreach ($this->population as $specimen) {
            $error = abs($this->target - ($this->avaliationFunction)($specimen));
            $specimen->setError($error);
        }
    }

    public function rank()
    {
        usort($this->population, function (Specimen $a, Specimen $b) {
            return $a->error <=> $b->error;
        });

        $this->champion = $this->population[0];
    }

    public function genocide()
    {
        $this->population = [];
    }

    public function orgy()
    {
        for ($i = 0; $i < $this->size; $i++) {
            $this->population[] = $this->champion->mutated();
        }
    }
}
