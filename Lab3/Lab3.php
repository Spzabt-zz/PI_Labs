<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab3</title>
</head>
<body>

<form action="ResultOfReq.php" method="post">
    <?php
    $arr = file("napr.txt");
    array_multisort($arr);

    for ($i = 0; $i < count($arr); $i++) {
        $str = $arr[$i];
        echo '<div style="margin: 5px;">';
        echo "<input type='radio' id='str$i' name='str' value='$str'>$str</input>";
        echo '</div>';
    }
    ?>
    <button type="submit">Відправити запит</button>
</form>
</body>
</html>