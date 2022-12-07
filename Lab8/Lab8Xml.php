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
        }

        span {
            font-size: 20px;
            margin: auto;
        }

        .container {
            font-size: 25px;
            margin: 25px;
            width: 50%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <p><strong>IP search</strong></p>
    <form method="post" action="Lab8Json.php">
        <input type="text" name="ip" id="ip-input" placeholder="IP" title="Enter IP address"/>
        <input type="submit" value="IP search"/>
    </form>
    <br>
    <?php
    $ip = getenv('REMOTE_ADDR', true) ?: getenv('REMOTE_ADDR');

    $resultXml = simplexml_load_file("http://ip-api.com/xml/" . $ip);
    if ($resultXml === FALSE) {
        echo '<p>Помилка при запиті XML!</p>';
        return;
    }
    echo '<span>Details for ' . $resultXml->query . '</span>';
    echo '<br><br><p><strong>Geolocation Info</strong></p>';
    echo '<span>Country code: ' . $resultXml->country . '</span>';
    echo '<br><span>Flag:<img src="./flags_ISO/' . strtolower($resultXml->countryCode) . '.png" /></span>';
    echo '<br><span>Region: ' . $resultXml->region . '</span>';
    echo '<br><span>Region Name: ' . $resultXml->regionName . '</span>';
    echo '<br><span>City: ' . $resultXml->city . '</span>';
    echo '<br><span>Postal Code: ' . $resultXml->zip . '</span>';
    echo '<br><span>Latitude: ' . $resultXml->lat . '</span>';
    echo '<br><span>Longitude: ' . $resultXml->lon . '</span>';
    ?>
</div>
</body>
</html>