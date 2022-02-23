<?php

use emag\hero\Characters\Monster;
use emag\hero\Characters\Orderus;
use emag\hero\GameTypes\Battle;

require_once __DIR__ . '/../vendor/autoload.php';

\Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->safeLoad();

$fight = new Battle(new Orderus(), new Monster());
$fight->start();
