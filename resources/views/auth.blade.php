<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Авторизация</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link href="./css/style_auth.css" rel="stylesheet">
</head>
<body class="text-center">
<form class="auth">
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    <label for="inputLogin" class="sr-only">Логин</label>
    <input type="login" id="inputLogin" class="form-control" placeholder="Логин" required="" autofocus="" name="email">
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required="" name="password">
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember"> Запомнить меня
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    <p class="mt-5 mb-3 text-muted">Нашли ошибку? Напишите на email: toni.neczvetaev.06@bk.ru</p>
</form>
</body>
</html>