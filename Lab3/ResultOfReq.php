<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css"/>
    <title>Lab3</title>
</head>
<body>

<table>
    <thead>
    <tr>
        <th>№</th>
        <th>Середній бал вступивших на бюджет</th>
        <th>Кількість бюджетників</th>
        <th>Недобір</th>
        <th>Число контрактників</th>
        <th>ВНЗ</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $napr = htmlspecialchars($_POST['str']);
    $data = fopen("data.txt", "r");

    while (!feof($data)) {

        $firstRow = fgets($data);
        if (trim($firstRow) === trim($napr)) {

            $count = fgets($data);
            for ($i = 1; $i <= $count; $i++) {
                $thirdRow = (float)fgets($data);
                $fourthRow = (int)fgets($data);
                $fifthRow = (int)fgets($data);
                $sixthRow = fgets($data);

                echo '<tr>';
                echo '<th scope="row">' . $i . '</th>';
                echo '<td>' . $thirdRow . '</td>';
                echo '<td>' . $fourthRow . '</td>';
                echo '<td>-</td>';
                echo '<td>' . $fifthRow . '</td>';
                echo '<td>' . $sixthRow . '</td>';
                echo '</tr>';
            }

            break;
        }
    }
    fclose($data);
    ?>
    </tbody>
</table>
</body>
</html>