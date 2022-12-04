<?php
$fp = fopen("oblinfo.txt", "r");

echo '<table width="65%" border="1" align="center" cellspacing="0">';
echo '<tr>';
echo '<th>№</th>';
echo '<th>Область</th>';
echo '<th>Населення, тис</th>';
echo '<th>Кількість вузів</th>';
echo '<th>Число вузів на 100 тис населення</th>';
echo '</tr>';

$row = fgets($fp);

$index = 0;
$cols = 3;
$numberOfRow = 1;
$populationData = 0;
$universityData = 0;

echo '<tr>';
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
echo '</tr>';
echo '</table>';
fclose($fp);
