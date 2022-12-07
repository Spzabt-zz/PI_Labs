<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab8</title>
    <style>
        body {
            background: #A3DDD9;
        }

        p {
            font-size: 25px;
            font-weight: bold;
            font-family: 'Relaway', sans-serif;
            margin: 25px;
        }

        span {
            font-size: 20px;
            margin: 25px;
        }
    </style>
</head>
<body>
<p><strong>IP search</strong></p>
<br>
<?php
$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_URL, "http://ip-api.com/json/" . $_POST['ip']);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curlHandle, CURLOPT_HEADER, 0);
$result = curl_exec($curlHandle);
curl_close($curlHandle);
if ($result === FALSE) {
    echo "Помилка CURL: " . curl_error($curlHandle);
    return;
}
$resultJson = json_decode($result);
if ($resultJson === FALSE || $resultJson->status === "fail") {
    echo '<p id="#error">Помилка при запиті JSON!</p>';
    return;
}
echo '<span>Details for ' . $resultJson->query . '</span>';
echo '<br><br><p><strong>Geolocation Info</strong></p>';
echo '<span>Country code: ' . $resultJson->country . '</span>';
echo '<br><span>Flag:<img src="./flags_ISO/' . strtolower($resultJson->countryCode) . '.png" /></span>';
echo '<br><span>Region: ' . $resultJson->region . '</span>';
echo '<br><span>Region Name: ' . $resultJson->regionName . '</span>';
echo '<br><span>City: ' . $resultJson->city . '</span>';
echo '<br><span>Postal Code: ' . $resultJson->zip . '</span>';
echo '<br><span>Latitude: ' . $resultJson->lat . '</span>';
echo '<br><span>Longitude: ' . $resultJson->lon . '</span>';
?>
</body>
</html>
