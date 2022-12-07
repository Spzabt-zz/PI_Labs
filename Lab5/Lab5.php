<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab5</title>
</head>
<body>

<?php
//$url = 'https://www.gismeteo.ua/ua/weather-kyiv-4944/';
$url = 'https://www.gismeteo.ua/ua/weather-kharkiv-5053/';

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
echo $cityName;
echo "<br/>";

echo date("d.m.Y");
echo "<br/>";
echo "<br/>";

$astroTime = $xpath->query("//div[contains(@class,'astro-times')]")->item(0);
$astroTimeCount = $astroTime->childNodes->length;

$dayTimeArr = array();
for ($i = 0; $i < $astroTimeCount; $i++) {
    $dayTimeArr[$i] = $astroTime->childNodes->item($i)->textContent;
}

echo $dayTimeArr[1];
echo "<br/>";

echo $dayTimeArr[2];
echo "<br/>";

echo "<span>Тривалість дня: </span>";
$dayTime = substr($dayTimeArr[0], 28);
$dayTime = trim($dayTime);

$timeArr = explode(" ", $dayTime);
if ($timeArr[0] == 1 && count($timeArr) > 2) {
    echo $timeArr[0] . " " . $timeArr[1] . "ина " . $timeArr[2] . " " . $timeArr[3];
} else if ($timeArr[0] == 1 && count($timeArr) == 2) {
    echo $timeArr[0] . " " . $timeArr[1] . "ина";
}

if (($timeArr[0] >= 2 && $timeArr[0] <= 4) && count($timeArr) > 2) {
    echo $timeArr[0] . " " . $timeArr[1] . "ини " . $timeArr[2] . " " . $timeArr[3];
} else if (($timeArr[0] >= 2 && $timeArr[0] <= 4) && count($timeArr) == 2) {
    echo $timeArr[0] . " " . $timeArr[1] . "ини";
}

if (($timeArr[0] >= 5 && $timeArr[0] <= 12) && count($timeArr) > 2) {
    echo $timeArr[0] . " " . $timeArr[1] . "ин " . $timeArr[2] . " " . $timeArr[3];
} else if (($timeArr[0] >= 5 && $timeArr[0] <= 12) && count($timeArr) == 2) {
    echo $timeArr[0] . " " . $timeArr[1] . "ин";
}

echo "<br/>";
echo "<br/>";

echo "<span>Температура за день: </span>";
$temperatureC = $xpath->query("//span[contains(@class,'unit unit_temperature_c')]/text()");
$temperatureCount = $temperatureC->length;
$count = 0;
for ($i = 6; $i < $temperatureCount; $i++) {
    $temperature = $temperatureC->item($i)->textContent;
    echo $count . " г: ";
    echo $temperature . "<span>&#8451;</span>" . " ";
    $count = $count + 3;
}
echo "<br/>";
?>

</body>
</html>
