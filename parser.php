<?php
require __DIR__ . '/vendor/autoload.php';
// $curl = new anlutro\cURL\cURL;

date_default_timezone_set('Asia/Kuala_lumpur');
$url = "http://www.billboard.com/rss/charts/hot-100";
$imageAPIURL = "https://itunes.apple.com/search";
$rss = Feed::loadRss($url);
Feed::$cacheDir = __DIR__ . '/cache';
Feed::$cacheExpire = '5 hours';

// echo json_encode($rss->item);
// echo 'Title: ', $rss->title;
// echo 'Description: ', $rss->description;
// echo 'Link: ', $rss->link;
$items = array();
foreach ($rss->item as $item) {

	// easily build an url with a query string
	// $url = $curl->buildUrl($imageAPIURL, ['term' => $item->chart_item_title->__toString()]);
	// $response = $curl->get($url);
	// $json = $response->body;
	// $object = json_decode($json);
	// var_dump($object->results[0]->artworkUrl100);
	$items[] = array(
		'title' => $item->title->__toString(), 
		'link' => $item->link->__toString(),
		'artist' => $item->artist->__toString(),
		'chart_item_title' => $item->chart_item_title->__toString(),
		'description' => $item->description->__toString(),
		'category' => $item->category->__toString(),
		'date' => $item->pubDate->__toString(),
		'rank_this_week' => $item->rank_this_week->__toString(),
		'rank_last_week' => $item->rank_last_week->__toString(),
		'guid' => $item->guid->__toString()
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

$fp = fopen('temp.json', 'w');
fwrite($fp, json_encode($data));
fclose($fp);