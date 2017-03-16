<?php

require_once '../vendor/autoload.php';

$app = new Silex\Application;
$app['debug'] = true;

$app->get('/', 'App\Controller\Front::getIndex');

$app->run();
