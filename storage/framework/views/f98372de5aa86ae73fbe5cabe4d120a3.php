<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Website Test</title>
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

<body class="d-flex flex-column min-vh-100">
    <header id="header" class="v1-c-hYYuhA v1-c-fUDpwJ v1-c-fUDpwJ-fbymLd-isAuthorized-true">
        <div class="v1-c-hYYuhA v1-c-hUZzbq"
            style="display: flex; align-items: center; justify-content: space-between;">

            <a href="#" class="header-logo">
                <img src="https://multibonus.ru/images/home-logo-white.svg" alt="На главную"
                    class="header-logo-styles__StyledImage-hRXOXc iuCPms">
            </a>
        </div>
    </header>

    <main class="form-signin flex-fill">
        <form action="<?php echo e(route('UserLogin')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h1 class="h3 mb-3 fw-normal text-center">Вход в ВТБ Банка</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="login" id="login" placeholder="Логин" required>
                <label for="login">Имя</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Пароль" required>
                <label for="password">Пароль</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Войти</button> 
		</form>
        <button class="btn btn-primary w-100 py-2 mb-2"     type="button" onclick="window.location.href='<?php echo route("RegPage"); ?>';">У вас нет аккаунта?</button>
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




<?php if(session('error')): ?>
<div id="errorModal" class="error-modal">
    <div class="error-modal-content">
        <span id="closeBtn" class="close-btn">&times;</span>
        <p><?php echo e(session('error')); ?></p>
    </div>
</div>

<script>
    // Открыть модальное окно, если есть ошибка
    document.getElementById('errorModal').style.display = 'flex';

    // Закрыть модальное окно
    document.getElementById('closeBtn').addEventListener('click', function() {
        document.getElementById('errorModal').style.display = 'none';
    });

    // Закрыть модальное окно при клике вне его
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('errorModal')) {
            document.getElementById('errorModal').style.display = 'none';
        }
    });
</script>

<style>
    /* Стиль модального окна */
    .error-modal {
        display: none;
        /* Скрыто по умолчанию */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Полупрозрачный фон */
        justify-content: center;
        align-items: center;
    }

    .error-modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        min-width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
    }

    /* Кнопка закрытия */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
    }

    .close-btn:hover {
        color: red;
    }

    /* Убираем лишние стили для текста и кнопок */
    .error-modal-content p {
        font-size: 16px;
        color: #d9534f;
        margin-top: 0;
        /* Убираем отступ сверху */
    }
</style>
<?php endif; ?>

</html>
<?php /**PATH /home/tobecomeawind/Devs/OpenApi/resources/views/Login.blade.php ENDPATH**/ ?>