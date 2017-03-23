<?php

require_once 'vendor/autoload.php';

use App\Model;

date_default_timezone_set('Europe/Kiev');

$connectionParams = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'rss_news',
    'user' => 'root',
    'password' => '123',
    'charset'   => 'utf8mb4',
);
$config = new \Doctrine\DBAL\Configuration;
$db = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$feed_urls = [];
$source_mapper = new Model\SourceMapper($db);
$sources = $source_mapper->getSources();

foreach ($sources as $source) {
    if ($source->isActive()) $feed_urls[] = $source->getRssFeedLink();
}

$feed = new SimplePie();
$feed->enable_cache(false);
$feed->set_feed_url($feed_urls);
$feed->init();

$items = $feed->get_items();
$news_mapper = new Model\NewsMapper($db);

foreach ($items as $item) {
    $news = new Model\NewsEntity([
        'title'       => $item->get_title(),
        'link'        => $item->get_link(),
        'description' => $item->get_description(),
        'source'      => $item->get_feed()->get_link(),
        'pub_date'    => $item->get_date("Y-m-d H:i:s"),
    ]);

    $news_mapper->save($news);
}
