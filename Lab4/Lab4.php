<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Lab4</title>
</head>
<body>

<form action="ResultOfReq.php" method="post">
    <label class="label" for="city">Виберіть область:</label>
    <br>
    <select class="select" name='city' id="city">
        <?php
        $fp = fopen("oblinfo.txt", "r");
        $row = fgets($fp);
        $index = 0;

        while (!feof($fp) && $index < 27) {
            $city = fgets($fp);
            $pop = fgets($fp);
            $university = fgets($fp);
            echo "<option value='$city'>$city</option>";
            $index++;
        }
        ?>
    </select>
    <br>
    <button class="btn" type="submit">Відправити запит</button>
</form>

</body>
</html>