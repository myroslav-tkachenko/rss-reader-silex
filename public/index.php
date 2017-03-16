<?php

require_once '../vendor/autoload.php';

$app = new Silex\Application;

$app->get('/', function () {
    return 'Test';
});

$app->run();
