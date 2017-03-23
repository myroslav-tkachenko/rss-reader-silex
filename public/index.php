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
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new App\Service\ViewServiceProvider());

$app->get('/', 'App\Controller\Front::getIndex');
$app->get('/login', 'App\Controller\Front::getLogin');
$app->post('/login', 'App\Controller\Front::postLogin');
$app->get('/logout', 'App\Controller\Front::getLogout');
$app->get('/cabinet', 'App\Controller\Cabinet::getIndex')
    ->before('App\Controller\Cabinet::_before');
$app->post('/cabinet/toggle/{id}', 'App\Controller\Cabinet::postDisableSource')
    ->assert('id', '\d+')
    ->before('App\Controller\Cabinet::_before');
$app->post('/cabinet', 'App\Controller\Cabinet::postAddSource')
    ->before('App\Controller\Cabinet::_before');

$app->run();
