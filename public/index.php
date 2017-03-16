<?php

require_once '../vendor/autoload.php';

$app = new Silex\Application;
$app['debug'] = true;

$app->register(new Silex\Provider\SessionServiceProvider());

$app->get('/', 'App\Controller\Front::getIndex');
$app->get('/login', 'App\Controller\Front::getLogin');
$app->post('/login', 'App\Controller\Front::postLogin');
$app->get('/logout', 'App\Controller\Front::getLogin');
$app->get('/cabinet', 'App\Controller\Front::getCabinet');

$app->run();
