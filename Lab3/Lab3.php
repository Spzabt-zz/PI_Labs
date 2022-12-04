<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        button {
            float: left;
            margin-top: 10px;
            margin-left: 50px;
            color: black;
            display: table-cell;
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            height: 50px;
            width: 150px;
        }
    </style>
    <title>Lab3</title>
</head>
<body>

<form action="ResultOfReq.php" method="post">
    <?php
    $arr = file("napr.txt");
    sort($arr);
    for ($i = 0; $i < count($arr); $i++) {
        $str = $arr[$i];
        echo "<div style='margin: 5px;'><input type='radio' id='str$i' name='str' value='$str'>
 			  <label for='str'>$str</label></div>";
    }
    ?>
    <button type="submit">відшукати</button>
</form>
</body>
</html>