<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab2</title>
</head>
<body>

<table width="65%" border="1" align="center" cellspacing="0">
    <tr>
        <th>№</th>
        <th>Область</th>
        <th>Населення, тис</th>
        <th>Кількість вузів</th>
        <th>Число вузів на 100 тис населення</th>
    </tr>
    <tr>
        <?php
        $fp = fopen("oblinfo.txt", "r");
        $row = fgets($fp);

        $index = 0;
        $cols = 3;
        $numberOfRow = 1;
        $populationData = 0;
        $universityData = 0;

        while (!feof($fp) && $numberOfRow < 28) {
            if ($index < $cols) {
                $data = fgets($fp);
                if ($index == 0) {
                    echo '<td width="3%" style="text-align:center">' . $numberOfRow . '</td>';
                    echo '<td width="30%" style="text-align:center">' . $data . '</td>';
                } else {
                    echo '<td width="10%" style="text-align:center">' . $data . '</td>';
                    if ($index == 1)
                        $populationData = $data;
                    else if ($index == 2) {
                        $universityData = $data;
                        $perThousand = round($universityData * 100 / $populationData, 2);
                        echo '<td width="10%" style="text-align:center">' . $perThousand . '</td>';
                    }
                }
                $index++;
            } else {
                $index = 0;
                $numberOfRow++;
                echo '</tr>';
                echo '<tr>';
            }
        }
        fclose($fp);
        ?>
    </tr>
</table>
</body>
</html>