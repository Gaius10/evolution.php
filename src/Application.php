<?php

namespace Otimizer;

class Application
{
    protected Specimen $champion;

    /** @var array<Specimen> */
    protected array $population;

    public function __construct(
        protected int $size,
        protected \Closure $avaliationFunction,
    ) {
        $this->avaliationFunction = function (Specimen $s) use ($avaliationFunction) {
            return (int) $avaliationFunction($s);
        };

        $this->init();
    }

    public function dump(string $path)
    {
        $data = array_map(function (Specimen $s) {
            $dump = [ 'x' => $s->x ];

            if (isset($s->y)) {
                $dump['y'] = $s->y;
            }

            return $dump;
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
        foreach ($this->population as $s) {
            $s->setY(($this->avaliationFunction)($s));
        }
    }

    public function rank()
    {
        usort($this->population, function (Specimen $a, Specimen $b) {
            return $b->y <=> $a->y;
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
