<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab4</title>
</head>
<body>

<table width="65%" border="1" align="center" cellspacing="0">
    <tr>
        <th>Область</th>
        <th>Населення, тис</th>
        <th>Кількість вузів</th>
        <th>Число вузів на 100 тис населення</th>
    </tr>
    <tr>
        <?php
        $fp = fopen("oblinfo.txt", "r");
        $city = htmlspecialchars($_POST['city']);

        while (!feof($fp)) {
            $row = fgets($fp);
            if (trim($row) === trim($city)) {
                $pop = (int)fgets($fp);
                $universityCount = (int)fgets($fp);
                $perThousand = round($universityCount / $pop * 100, 2);
                echo '<td width="30%" style="text-align:center">' . $city . '</td>';
                echo '<td width="10%" style="text-align:center">' . $pop . '</td>';
                echo '<td width="10%" style="text-align:center">' . $universityCount . '</td>';
                echo '<td width="10%" style="text-align:center">' . $perThousand . '</td>';
            }
        }
        fclose($fp);
        ?>
    </tr>
</table>

</body>
</html>