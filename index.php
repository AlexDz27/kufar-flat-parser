<?php

require_once __DIR__ . '/vendor/autoload.php';

use AlexDz27\Curl\Curl;

$curl = new Curl('https://re.kufar.by/l/kobrin/snyat/kvartiru-dolgosrochno/1k?size=30');
$response = $curl->getResponse();

echo 'Looking at the flats...' . PHP_EOL;

$foundAllFlatsCount = 0;
$allFlats = [];

$foundAllFlatsCount = preg_match_all('/<a class="kf-JUGv-e08be" .*?<\/a>/i', $response, $allFlats);

echo "All the flats count: $foundAllFlatsCount" . PHP_EOL;

echo 'Filtering...' . PHP_EOL;

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

echo "Result: $newFlatsCount new flats" . PHP_EOL;