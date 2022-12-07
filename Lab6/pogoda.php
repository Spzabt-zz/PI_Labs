<?php
$city = $_GET['city'];

$url = "https://www.gismeteo.ua/ua/weather-" . $city . "/";
//$url = "https://www.gismeteo.ua/ua/weather-kyiv-4944/";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HEADER, false);
$html = curl_exec($curl);
curl_close($curl);

libxml_use_internal_errors(true);

$dom = new DOMDocument();
$dom->loadHTML($html, LIBXML_NOERROR);
$xpath = new DOMXPath($dom);

$city = $xpath->query("//input[contains(@class, 'input js-input')]")->item(0);
$cityName = $city->getAttribute("placeholder");

$date = date("d.m.Y");

$astroTime = $xpath->query("//div[contains(@class,'astro-times')]")->item(0);
$astroTimeCount = $astroTime->childNodes->length;

$dayTimeArr = array();
for ($i = 0; $i < $astroTimeCount; $i++) {
    $dayTimeArr[$i] = $astroTime->childNodes->item($i)->textContent;
}
$sunrise = substr($dayTimeArr[1], 12);
$sunrise = trim($sunrise);
$sunset = substr($dayTimeArr[2], 14);
$sunset = trim($sunset);

$dayTime = substr($dayTimeArr[0], 28);
$dayTime = trim($dayTime);
$timeArr = explode(" ", $dayTime);
$hour = $timeArr[0];
$minute = $timeArr[2];

preg_match_all("/<span class=\"unit unit_temperature_c\">(.*?)<\/span>/", $html, $matches);
$temperatureC = $xpath->query("//span[contains(@class,'unit unit_temperature_c')]/text()");
$temperatureCount = $temperatureC->length;
$temperature = array();
for ($i = 6; $i < $temperatureCount; $i++) {
    $temperature[$i] = $matches[1][$i];
}

//image
$width = 700;
$height = 400;
$retreat = 45;
$font_file = './GothamPro-Black.ttf';

$image = imagecreatetruecolor($width, $height);
imageantialias($image, true);

// colors
$black = imagecolorallocate($image, 0x00, 0x00, 0x00);
$blue = imagecolorallocate($image, 0x00, 0xFF, 0xFF);
$red = imagecolorallocate($image, 255, 0, 0);

// background
imagefilledrectangle($image, 0, 0, 499, 199, $black);

//background - images
$left = imagecreatefrompng('./left_optimized.png');
$right = imagecreatefrompng('./right_optimized.png');

$sunrise_seconds = (int)explode(":", $sunrise)[0] * 3600 + (int)explode(":", $sunrise)[1] * 60;

$sunset_seconds = (int)explode(":", $sunset)[0] * 3600 + (int)explode(":", $sunset)[1] * 60;

$left_percent = (int)($sunrise_seconds * 100 / (24 * 3600));
$left_point = (int)($left_percent * 700 / 100);

$right_percent = (int)($sunset_seconds * 100 / (24 * 3600));
$right_point = (int)($right_percent * 640 / 100);

$center = imagecreatefrompng('./center_optimized.png');

$center_point = $right_point - $left_point - 50;

imagecopyresampled($image, $left, $left_point, 0, 0, 0, 50, 310, 100, 100);
imagecopyresampled($image, $right, $right_point, 0, 0, 0, 50, 310, 100, 100);
imagecopyresampled($image, $center, $left_point + 50, 0, 0, 0, $center_point, 310, 100, 100);

//sun & moon
$moon = imagecreatefrompng('./moon_sm_optimized.png');
$sun = imagecreatefrompng('./sun_sm_optimized.png');
imagecopyresampled($image, $moon, 45, 10, 0, 0, 130, 130, 100, 100);
imagecopyresampled($image, $sun, $width / 2 - 40, 0, 0, 0, 110, 110, 60, 60);
imagecopyresampled($image, $moon, $width - 125, 10, 0, 0, 130, 130, 100, 100);

//line
imageline($image, $retreat, $height - $retreat * 2, $width - $retreat, $height - $retreat * 2, $blue);

//temperature
$start_point = 35;
$step = $width / count($temperature);
$points = array();

foreach ($temperature as $key => $value) {
    $x = $start_point;
    if (str_contains($value, "&minus;")) {
        $value = substr($value, -2);
        $returnInt = intval($value);
        if ($returnInt === 0) {
            $value = substr($value, -1);
            $returnInt = intval($value);
        }
        $value = -1 * abs($returnInt);
    } else if (str_contains($value, "&minus;")) {
        $value = substr($value, -2);
        $returnInt = intval($value);
        if ($returnInt === 0) {
            $value = substr($value, -1);
            $returnInt = intval($value);
        }
        $value = $returnInt;
    }
    $y = ($height / 2 - $value * 10) + 140;
    imagefttext($image, 18, 0, $x, $y, $red, $font_file, $value);
    $start_point += $step;
    $points[] = array($x, $y);
}

for ($i = 0; $i < count($points) - 1; $i++) {
    $x1 = $points[$i][0] + 10;
    $y1 = $points[$i][1] + 15;
    $x2 = $points[$i + 1][0] + 10;
    $y2 = $points[$i + 1][1] + 15;
    imageline($image, $x1, $y1, $x2, $y2, $red);
}

//point
$x1 = $retreat;
$x2 = $retreat;
$y1 = $height - $retreat * 2;
$y2 = $height - $retreat * 2 + 10;
$r = ($width - $retreat * 2) / 8;
$s = 5;
$count = 0;
for ($i = 0; $i < 9; $i++) {
    imageline($image, $x1, $y1, $x2, $y2, $blue);
    imagefttext($image, 15, 0, $x1 - $s, $y2 + 20, $blue, $font_file, $count);
    $x1 = $x1 + $r;
    $x2 = $x2 + $r;
    $count = $count + 3;
    if ($i > 3) {
        $s = $s + 2;
    }
}

//city
$x = $retreat;
$y = $height - 10;
imagefttext($image, 20, 0, $x, $y, $blue, $font_file, $cityName);
//date
$x = $width - 170;
imagefttext($image, 20, 0, $x, $y, $blue, $font_file, $date);

header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
