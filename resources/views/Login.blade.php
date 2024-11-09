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

            <div class="header-right" style="display: flex; align-items: center; gap: 20px;">
                <div class="cart-zone-styles__StyledCartZoneContainer-ePPims iGkgls"
                    style="display: flex; align-items: center; gap: 15px;">
                    <a class="cart-zone-styles__StyledLink-btGMdd dYstHa" href="#">
                        <div class="cart-zone-styles__StyledCardWrapper-exwLOi bUOJlI">
                            <div class="StyledCartZoneImage">
                                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.6 2.58a.65.65 0 1 0-1.3 0v2.044A4.792 4.792 0 0 0 7.29 8.22l-1.765 7.06H4.8a.65.65 0 1 0 0 1.3h14.3a.65.65 0 1 0 0-1.3h-.725L16.61 8.22a4.792 4.792 0 0 0-4.01-3.596V2.58Zm4.44 12.7-1.69-6.74a3.497 3.497 0 0 0-3.4-2.66c-1.61 0-3.01 1.1-3.4 2.66l-1.69 6.74h10.18Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M10.65 18.585a.65.65 0 0 0-1.3.03c.03 1.298 1.173 2.235 2.45 2.235 1.276 0 2.419-.937 2.45-2.235a.65.65 0 0 0-1.3-.03c-.011.481-.464.965-1.15.965-.686 0-1.139-.484-1.15-.965Z"
                                        fill="currentColor"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <a class="cart-zone-styles__StyledLink-btGMdd dYstHa" href="#">
                        <div class="cart-zone-styles__StyledCardWrapper-exwLOi bUOJlI">
                            <div class="StyledCartZoneImage">
                                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.325 13.632a.65.65 0 1 0 1.3-.01c0-.3.04-.5.15-.78.14-.33.42-.63.72-.94l.004-.004c.489-.51 1.036-1.079 1.175-1.996.13-.87-.23-1.77-.95-2.34-.74-.59-1.72-.72-2.62-.37-1.18.47-1.85 1.49-1.79 2.75.01.36.33.63.68.62a.65.65 0 0 0 .62-.68c-.03-.49.13-1.15.97-1.48.47-.18.95-.12 1.33.18.36.28.54.71.48 1.13-.078.502-.418.858-.81 1.269l-.02.021c-.36.37-.76.79-.99 1.36-.18.43-.25.8-.25 1.27ZM12.85 16.35a.85.85 0 1 1-1.7 0 .85.85 0 0 1 1.7 0Z"
                                        fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18Zm-7.7 9a7.7 7.7 0 1 1 15.4 0 7.7 7.7 0 0 1-15.4 0Z"
                                        fill="currentColor"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="form-signin w-100 m-auto flex-fill">
        <form action="{{route('UserLogin')}}" method="POST">
				@csrf
            <h1 class="h3 mb-3 fw-normal text-center">Вход в ВТБ Банка</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="login" id="login" placeholder="Логин" required>
                <label for="login">Имя</label>
            </div>


            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Пароль" required>
                <label for="password">Пароль</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Политика Конфиденциальности
                </label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Войти</button>
        </form>
		<form> 
			<button class="btn btn-primary w-100 py-2" type="button" formaction={{route('RegPage')}}>Регистрация</button>
        </form>
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
@if(session('error'))
	<script>
		alert("{{session('error')}}");	
	</script>
@endif

{{ session()->forget('accountId')}}
{{dd(session()->all())}}

</html>
