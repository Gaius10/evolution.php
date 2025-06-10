<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Otimizer\Application;
use Otimizer\Specimen;

(function () {
    array_map('unlink', array_filter((array) glob(__DIR__ . "/dumps/*")));
    $avaliation = function (Specimen $s) {
        return $s->x;
    };

    $target = 35;
    $app = new Application(10, $target, $avaliation);
    $app->dump(__DIR__ . '/dumps/start.json');

    $generation = 1;
    do {
        $app->avaliate();
        $app->rank();

        $champion = $app->getChampion();
        $app->dump(__DIR__ . "/dumps/d{$generation}.json");
        $generation++;

        $app->genocide();
        $app->orgy();
    } while ($champion->x != $target && $generation < 100);
})();

