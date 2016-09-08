<?php
require __DIR__ . '/vendor/autoload.php';
date_default_timezone_set('Asia/Kuala_lumpur');
$url = "http://www.billboard.com/rss/charts/hot-100";
$rss = Feed::loadRss($url);
Feed::$cacheDir = __DIR__ . '/cache';
Feed::$cacheExpire = '5 hours';

// echo json_encode($rss->item);
// echo 'Title: ', $rss->title;
// echo 'Description: ', $rss->description;
// echo 'Link: ', $rss->link;
$items = array();
foreach ($rss->item as $item) {

	$items[] = array(
		'title' => $item->title->__toString(), 
		'link' => $item->link->__toString(),
		'chart_item_title' => $item->chart_item_title->__toString(),
		'description' => $item->description->__toString(),
		'date' => $item->pubDate->__toString(),
		'rank_this_week' => $item->rank_this_week->__toString(),
		'rank_last_week' => $item->rank_last_week->__toString()
		);
	// var_dump($item->title);
    // echo 'Title: ', $item->title;
    // echo 'Link: ', $item->link;
    // echo 'Timestamp: ', $item->timestamp;
    // echo 'Description ', $item->description;
    // echo 'HTML encoded content: ', $item->{'content:encoded'};
}
// var_dump($rss->title->); exit;
$data = array(
	'title' => $rss->title->__toString(),
	'description' => $rss->description->__toString(),
	'link' => $rss->link->__toString(),
	'items' => $items
	);

echo json_encode($data);