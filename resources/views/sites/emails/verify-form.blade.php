<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Regenerate Email</title>
</head>
<body>
<div class="container">
    <div class="container d-flex justify-content-center">
        <a class="btn btn-success"
           href="{{ "https://xn--m1aaxj.xn--90ais/signup/new-customer/verify-email/$userId/$token" }}"
           target="_blank">Подтвердить почту
        </a>
    </div>
</div>
</body>
</html>