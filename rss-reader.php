<?php

require_once 'vendor/autoload.php';

use App\Model;

date_default_timezone_set('Europe/Kiev');

$config = new \Doctrine\DBAL\Configuration;
$connectionParams = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'rss_news',
    'user' => 'root',
    'password' => '123',
    'charset'   => 'utf8mb4',
);

$db = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$source_mapper = new Model\SourceMapper($db);
$sources = $source_mapper->getSources();

$feed_urls = [];

foreach ($sources as $source) {
    if ($source->isActive()) $feed_urls[] = $source->getRssFeedLink();
}

var_dump($feed_urls); die();

$feed_urls = [
    'http://www.pravda.com.ua/rss/',
    'http://football.ua/rss2.ashx',
    'https://rss.unian.net/site/news_ukr.rss',
];

$feed = new SimplePie();
$feed->enable_cache(false);
// $feed->enable_order_by_date(false);

$feed->set_feed_url($feed_urls);
$feed->init();

$items = $feed->get_items();

$sql = "INSERT IGNORE INTO news (title, link, description, source, pub_date) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);

foreach ($items as $item) {
    $stmt->execute([
        $item->get_title(),
        $item->get_link(),
        $item->get_description(),
        $item->get_feed()->get_link(),
        $item->get_date("Y-m-d H:i:s"),
    ]);
}
