<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Otimizer\Application;
use Otimizer\Specimen;

(function () {
    array_map('unlink', array_filter((array) glob(__DIR__ . "/dumps/*")));
    $avaliation = function (Specimen $s) {
        return -($s->x * $s->x) + 78;
    };

    $app = new Application(10, $avaliation);
    $app->dump(__DIR__ . '/dumps/start.json');

    $generation = 1;
    do {
        $app->avaliate();
        $app->rank();

        $oldChampion = $champion ?? null;
        $champion = $app->getChampion();
        $app->dump(__DIR__ . "/dumps/dump_{$generation}.json");
        $generation++;

        $app->genocide();
        $app->orgy();
    } while (is_null($oldChampion) || abs($champion->x - $oldChampion->x) > 0);
})();

