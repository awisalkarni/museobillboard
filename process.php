<?php
require __DIR__ . '/vendor/autoload.php';
$curl = new anlutro\cURL\cURL;

$temp = fopen("temp.json", "r") or die("Unable to open file!");
$itunesAPI = "https://itunes.apple.com/search";
$data = fread($temp, filesize("temp.json"));
fclose($temp);

$decoded = json_decode($data);
$items = array();
$counter = 0;
foreach($decoded->items as $pos => $item) {

	if (!isset($item->album_image)) {
		// easily build an url with a query string
		$url = $curl->buildUrl($itunesAPI, ['term' => $item->chart_item_title]);
		$response = $curl->get($url);
		$json = $response->body;
		$object = json_decode($json);
		$album_image = $object->results[0]->artworkUrl100;
	} else {
		continue;
	}
	

	$items[] = array(
		'title' => $item->title, 
		'link' => $item->link,
		'artist' => $item->artist,
		'chart_item_title' => $item->chart_item_title,
		'description' => $item->description,
		'category' => $item->category,
		'date' => $item->date,
		'rank_this_week' => $item->rank_this_week,
		'rank_last_week' => $item->rank_last_week,
		'guid' => $item->guid,
		'album_image' => $album_image
		);
	$counter = $pos+1;
	if(curl_exec($ch)){ // ?? - if request and data are completely received
    	continue; // ?? - go to the next loop
	}
}

$data = array(
	'title' => $decoded->title,
	'description' => $decoded->description,
	'link' => $decoded->link,
	'items' => $items
	);

$fp = fopen('temp.json', 'w');
fwrite($fp, json_encode($data));
fclose($fp);