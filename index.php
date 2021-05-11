<?php

require_once __DIR__ . '/vendor/autoload.php';

use AlexDz27\Curl\Curl;

$curl = new Curl('https://re.kufar.by/l/kobrin/snyat/kvartiru-dolgosrochno/1k?size=30');
$response = $curl->getResponse();

$foundAllFlatsCount = 0;
$allFlats = [];

$foundAllFlatsCount = preg_match_all('/<a class="kf-JUGv-e08be" .*?<\/a>/i', $response, $allFlats);

var_dump($foundAllFlatsCount);
var_dump($allFlats[0]);

$flatsWithPhoto = [];
// remove flats with no photo
foreach ($allFlats[0] as $flat) {
  if (!preg_match('/no-photo\/re_v3\.svg/i', $flat)) {
    $flatsWithPhoto[] = $flat;
  }
}

// remove specific flats by IDs
$filteredFlats = [];
foreach ($flatsWithPhoto as $flat) {
  if (!preg_match('/kobrin\/snyat\/kvartiru-dolgosrochno\/121153866/i', $flat)) {
    $filteredFlats[] = $flat;
  }
}

$newFlats = $filteredFlats;
$newFlatsCount = count($newFlats);

var_dump($newFlatsCount);
var_dump($newFlats);
