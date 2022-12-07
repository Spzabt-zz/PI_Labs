<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <script src="find.js"></script>
    <title>Lab7</title>

</head>
<body>

<div class="container">
    <div class="mb-3">
        <label for="search-field" class="form-label">Пошук на comfy.ua:</label>
        <input type="text" class="form-control" id="search-field" placeholder="Наприклад 'sams'"
        onkeyup="find(event)" onchange="find(event)">
    </div>
    <h5 class="mb-3 mt-3">Працює локально, а на Heroku - ні.</h5>
    <div id="output" class="row row-cols-1 row-cols-md-2 g-4"></div>
</div>

<script src="/js/bootstrap.min.js"></script>
</body>
</html>
