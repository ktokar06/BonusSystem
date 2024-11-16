<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Website Test</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
        .form-signin {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-width: 400px;
            margin: auto;
            height: 100%;
        }

        footer {
            margin-top: auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <header id="header" class="v1-c-hYYuhA v1-c-fUDpwJ v1-c-fUDpwJ-fbymLd-isAuthorized-true">
        <div class="v1-c-hYYuhA v1-c-hUZzbq"
            style="display: flex; align-items: center; justify-content: space-between;">

            <a href="#" class="header-logo">
                <img src="https://multibonus.ru/images/home-logo-white.svg" alt="На главную"
                    class="header-logo-styles__StyledImage-hRXOXc iuCPms">
            </a>

            <div class="header-right" style="display: flex; align-items: center; gap: 20px;">
        </div>
    </header>

    <main class="form-signin flex-fill">
        <form action="/api/account" method="POST">
            <h1 class="h3 mb-3 fw-normal text-center">Регистрация в ВТБ Банка</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="login" required>
                <label for="floatingName">Логин</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" required>
                <label for="floatingName">Имя</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="surname" required>
                <label for="floatingFName">Фамилия</label>
            </div>

            <div class="form-floating mb-3">
                <input type="phone" class="form-control" name="phone" required>
                <label for="floatingEmail">Телефон </label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" required>
                <label for="floatingPassword">Пароль</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Зарегистрироваться</button>
        </form>
            <button class="btn btn-primary w-100 py-2"      type="button" onclick="window.location.href='<?php echo route("LoginPage"); ?>';">Есть Аккаунт</button>
    </main>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row justify-content-center">
            <div class="col-12 col-md"></div>
            <div class="col-6 col-md text-center">
                <h5>Отделения и банкоматы</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1">
                        <a class="link-secondary text-decoration-none" href="#">© Банк ВТБ (ПАО), 2007–2024</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md text-center">
                <h5>Контакты</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">1 000</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">8 800 100-24-24</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">+7 495 777-24-24</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>

<?php if(session('success')): ?>
	<script>
		alert("Вы успешно зерегистрировались!");
	</script>
<?php endif; ?>

</html>
<?php /**PATH /home/tobecomeawind/Devs/OpenApi/resources/views/Reg.blade.php ENDPATH**/ ?>