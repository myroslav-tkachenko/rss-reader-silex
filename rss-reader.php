<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('Europe/Kiev');

use App\Model;

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

var_dump($db); die();

$sql = "INSERT IGNORE INTO news (title, link, description, source, pub_date) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);


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

foreach ($items as $item) {
    $stmt->execute([
        $item->get_title(),
        $item->get_link(),
        $item->get_description(),
        $item->get_feed()->get_link(),
        $item->get_date("Y-m-d H:i:s"),
    ]);
}
