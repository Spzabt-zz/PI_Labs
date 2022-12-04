<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table, td, th {
            table-layout: fixed;
            width: auto;
            border-collapse: collapse;
            border: 3px solid black;
            text-align: left;
        }
    </style>
    <title>Lab3</title>
</head>
<body>

<table>
    <thead>
    <tr>
        <th>№</th>
        <th>Середній бал</th>
        <th>К-ть бюджетників</th>
        <th>Недобор</th>
        <th>К-ть котрактників</th>
        <th>ВНЗ</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $str = htmlspecialchars($_POST['str']);
    $f = fopen("data.txt", "r");
    while (!feof($f)) {
        $row = fgets($f);
        if (strcasecmp($row, $str) == -3) {
            $size = fgets($f);
            for ($i = 0; $i < $size; $i++) {
                $avg = (float)fgets($f);
                $ent = (int)fgets($f);
                $contract = (int)fgets($f);
                $univ = fgets($f);
                echo "<tr>
				  <th scope='row'>$i</th>
				  <td>$avg</td>
				  <td>$ent</td>
				  <td>-</td>
				  <td>$contract</td>
				  <td>$univ</td>
				 </tr>";
            }
            break;
        }
    }
    fclose($f);
    ?>
    </tbody>
</table>
</body>
</html>