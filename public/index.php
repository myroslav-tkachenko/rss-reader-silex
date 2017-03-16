<?php

require_once '../vendor/autoload.php';

$app = new Silex\Application;
$app['debug'] = true;

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'rss_news',
        'user' => 'root',
        'password' => '123',
        'charset'   => 'utf8mb4',
    ),
));

$app->get('/', 'App\Controller\Front::getIndex');
$app->get('/login', 'App\Controller\Front::getLogin');
$app->post('/login', 'App\Controller\Front::postLogin');
$app->get('/logout', 'App\Controller\Front::getLogin');
$app->get('/cabinet', 'App\Controller\Front::getCabinet');

$app->run();
