<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Website Test</title>
    <link rel="stylesheet" href="/css/styles.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <header id="header" class="v1-c-hYYuhA v1-c-fUDpwJ v1-c-fUDpwJ-fbymLd-isAuthorized-true">

        <div class="v1-c-hYYuhA v1-c-hUZzbq"
            style="display: flex; align-items: center; justify-content: space-between;">

            <a href="<?php echo e(route('HomePage')); ?>" class="logo">
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
                <div class="dropdown" style="position: relative;">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        id="dropdownMenuLink" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" id="dropdownMenuItems"
                        style="display: none; position: absolute; top: 100%; right: 0; z-index: 1000;">
                        <li><a class="dropdown-item" href="/BonusSystem/html/Profile.html">Профиль</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php echo e(app('App\Http\Controllers\UserController')->unLogIn()); ?>">Выйти </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Обработка выпадающего меню
            const dropdownToggle = document.getElementById('dropdownMenuLink');
            const dropdownMenu = document.getElementById('dropdownMenuItems');

            dropdownToggle.addEventListener('click', (event) => {
                event.preventDefault();
                dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
            });

            // Закрепление шапки при прокрутке
            const header = document.getElementById('header');
            let lastScrollTop = 0;

            window.addEventListener('scroll', () => {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > lastScrollTop) {
                    // Прокрутка вниз
                    header.classList.add('hidden');
                } else {
                    // Прокрутка вверх
                    header.classList.remove('hidden');
                }
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Для мобильных устройств или если прокрутка на верх
            });
        });
    </script>

    <div class="container px-4 py-5" id="custom-cards">
        <h2 class="pb-2 border-bottom">Ваши Бонусы</h2>

        <div class="d-flex flex-row align-items-start g-4">

            <div class="list-group d-grid gap-2 border-0 me-4">
                <button class="list-group-item list-group-item-action rounded-3" id="listGroupButton1">
                    <strong class="fw-semibold">Баланс</strong>
                </button>
                <button class="list-group-item list-group-item-action rounded-3" id="listGroupButton2">
                    <strong class="fw-semibold">Перевод</strong>
                </button>
                <button class="list-group-item list-group-item-action rounded-3" id="listGroupButton4">
                    <strong class="fw-semibold">Уведомления</strong>
                </button>
                <button class="list-group-item list-group-item-action rounded-3" id="listGroupButton5">
                    <strong class="fw-semibold">Подписки</strong>
                </button>
                <button class="list-group-item list-group-item-action rounded-3" id="listGroupButton6">
                    <strong class="fw-semibold">История</strong>
                </button>
                <button class="list-group-item list-group-item-action rounded-3" id="listGroupButton7">
                    <strong class="fw-semibold">Игра</strong>
                </button>
            </div>

            <div class="col">
                <div class="card mb-4 rounded-3 shadow-lg" id="bonusCard">
                    <div class="card-body text-center" id="bonusContent">
                        <svg id="bonusIcon" width="60" height="36" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="mb-3">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.785 10.8h-13.8L3.981 8h13.8l-.996 2.8Zm-.498 1.4h-13.8L1.49 15h13.8l.996-2.8Zm-1.491 4.2H.995L0 19.2h13.8l.995-2.8Z"
                                fill="#0AF"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M50.607 25.315h2.509c.952 0 1.529-.222 1.932-.72.202-.25.49-.692.49-1.522 0-.83-.288-1.412-.864-1.827-.346-.25-.808-.388-1.587-.388h-2.48v4.457ZM47.29 28V12h10.845l-.952 2.685h-6.576v3.543h2.682c2.163 0 3.288.499 4.067 1.135.606.499 1.644 1.606 1.644 3.793 0 2.159-1.067 3.35-1.962 3.958-1.038.692-2.134.886-4.355.886H47.29Zm-9.605 0V14.685h-4.817V12h13.383l-.951 2.685h-4.27V28h-3.345Zm-13.354-9.605h1.875c.576 0 .865 0 1.153-.084.78-.22 1.27-.885 1.27-1.799 0-1.08-.52-1.55-1.27-1.771-.317-.083-.634-.111-1.269-.111h-1.76v3.765Zm.029 2.768v4.207h2.307c.692 0 1.327-.055 1.788-.47.462-.416.664-.941.664-1.634 0-.525-.145-1.024-.433-1.384-.49-.581-1.096-.72-2.134-.72H24.36Zm5.336-1.689v.055c.634.222 1.24.61 1.557.859.98.775 1.413 1.799 1.413 3.127 0 2.187-1.211 3.765-3.201 4.263-.606.166-1.24.222-2.423.222h-6.028V12h5.336c1.096 0 1.846.056 2.509.222 1.932.498 3.202 1.771 3.202 3.792 0 1.08-.404 1.993-1.068 2.602-.288.277-.692.609-1.297.858Z"
                                fill="currentColor"></path>
                        </svg>
                        <h1 class="card-title pricing-card-title display-4" id="bonusAmount"><?php echo e(app('App\Http\Controllers\UserController')->getBonuses($accountId)); ?></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li class="fs-5 text-body-secondary" id="bonusDescription">МультиБонусы</li>
                        </ul>
                    </div>
                </div>

                <div id="transferContent" class="d-none">
                    <h2 class="mb-4">Перевод средств</h2>
                    <div class="card-body text-center" id="bonusContentranslation">
                        <svg id="bonusIcon" width="60" height="36" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="mb-3">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.785 10.8h-13.8L3.981 8h13.8l-.996 2.8Zm-.498 1.4h-13.8L1.49 15h13.8l.996-2.8Zm-1.491 4.2H.995L0 19.2h13.8l.995-2.8Z"
                                fill="#0AF"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M50.607 25.315h2.509c.952 0 1.529-.222 1.932-.72.202-.25.49-.692.49-1.522 0-.83-.288-1.412-.864-1.827-.346-.25-.808-.388-1.587-.388h-2.48v4.457ZM47.29 28V12h10.845l-.952 2.685h-6.576v3.543h2.682c2.163 0 3.288.499 4.067 1.135.606.499 1.644 1.606 1.644 3.793 0 2.159-1.067 3.35-1.962 3.958-1.038.692-2.134.886-4.355.886H47.29Zm-9.605 0V14.685h-4.817V12h13.383l-.951 2.685h-4.27V28h-3.345Zm-13.354-9.605h1.875c.576 0 .865 0 1.153-.084.78-.22 1.27-.885 1.27-1.799 0-1.08-.52-1.55-1.27-1.771-.317-.083-.634-.111-1.269-.111h-1.76v3.765Zm.029 2.768v4.207h2.307c.692 0 1.327-.055 1.788-.47.462-.416.664-.941.664-1.634 0-.525-.145-1.024-.433-1.384-.49-.581-1.096-.72-2.134-.72H24.36Zm5.336-1.689v.055c.634.222 1.24.61 1.557.859.98.775 1.413 1.799 1.413 3.127 0 2.187-1.211 3.765-3.201 4.263-.606.166-1.24.222-2.423.222h-6.028V12h5.336c1.096 0 1.846.056 2.509.222 1.932.498 3.202 1.771 3.202 3.792 0 1.08-.404 1.993-1.068 2.602-.288.277-.692.609-1.297.858Z"
                                fill="currentColor"></path>
                        </svg>
                        <h1 class="card-title pricing-card-title display-4" id="bonusAmountranslation"><?php echo e(app('App\Http\Controllers\UserController')->getBonuses($accountId)); ?> бонусов</h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li class="fs-5 text-body-secondary" id="bonusDescriptiontranslation">МультиБонусы</li>
                        </ul>
                    </div>
                    <form action="<?php echo e(route('BonusSend')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="senderId" value="<?php echo e($accountId); ?>" />
                        <div class="mb-3">
                            <label class="form-label">ID Получателя</label>
                            <input type="text" class="form-control" name="recipientId" placeholder="Account ID" required
                                title="ID Получателя">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Сумма перевода:</label>
                            <input type="number" class="form-control" name="amount" placeholder="Введите сумму" required min="1">
                        </div>
                        <button type="submit" class="btn btn-primary">Перевести</button>
                    </form>
                </div>


                <div id="notificationsContent" class="d-none">
                    <h2 class="mb-4">Уведомления</h2>
                    <div class="sc-jsJBEP cktOpk my-messages-style__StyledMessagesWrapper-idkvZL jlqhrE">
                        <div class="no-messages-styles__StyledNoMessageWrapper-IIbfr hFqYnZ">
                            <div class="no-messages-styles__StyledNoMessageTextWrapper-iexTxC FMCns">
                                <h3 letter-spacing="normal"
                                    class="sc-aXZVg cQIama no-messages-styles__StyledNoMessagesTitle-eYUOiL erzljb">
                                    Будем держать вас в курсе
                                </h3>
                                <p letter-spacing="0.2px"
                                    class="sc-aXZVg ipzYgs no-messages-styles__StyledNoMessagesDescription-dtNibV dXISNv">
                                    Здесь будут уведомления про наши новые акции и интересные новости
                                </p>
                            </div>
                            <picture class="no-messages-styles__StyledNoMessagesPicture-iKmVSP ljQHmS">
                                <source media="(min-width: 1020px)"
                                    srcset="/images/notification-desktop.61987af8.png 1x, /images/notification-desktop@2x.35d9e849.png 2x">
                            </picture>
                        </div>
                    </div>
                </div>

                <div id="subscriptionsContent" class="d-none">
                    <h2 class="mb-4">Подписки</h2>
                    <div letter-spacing="normal"
                        class="sc-aXZVg jetvsJ error-message-styles__StyledErrorText-hslNut DiZuU">
                        <h3 letter-spacing="normal"
                            class="sc-aXZVg cQIama error-message-styles__StyledErrorTitle-eTFfzQ dQZwwI">Ничего не
                            нашли
                        </h3>Здесь отображаются ранее использованные подписки
                    </div>
                </div>

                <div id="historyContent" class="d-none">
                    <h2 class="mb-4">История транзакций</h2>
                    <table class="table table-bordered mb-4">
						<?php
							$data = app('App\Http\Controllers\UserController')->getTransactions($accountId);
						?>		
                        <?php if($data->status() != 200): ?>	
							<p>У пользователя ещё нет транзакций</p>
						<?php else: ?>
                        	<thead>
                           		<tr>
                                	<th>ID Транзакции</th>
                                	<th>Получатель</th>
                                	<th>Тип валюты</th>
                                	<th>Сумма</th>
                            	</tr>
                        	</thead>
                        	<tbody>
							<?php $__currentLoopData = $data->collect(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           		<tr>
							    	<td><?php echo e($row['transactionId']); ?></td>
                                	<td><?php echo e($row['recipientId']); ?></td>
                                	<td><?php echo e($row['currencyType']); ?></td>
                                	<td><?php echo e($row['value']); ?></td>
                            	</tr>
                        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div id="gameContent" class="d-none">
                    <div class="row align-items-stretch">
                        <div class="col-md-6">
                            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                                style="background-image: url('unsplash-photo-1.jpg'); height: 100%;">
                                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                                    <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Название Игры</h3>
                                    <p>Увлекательное приключение, которое погружает вас в мир фантазий и новых
                                        возможностей.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4">
                                <h3 class="fw-bold">Описание Игры</h3>
                                <p>Увлекательное приключение, которое погружает вас в мир фантазий и новых возможностей.
                                    Каждый уровень открывает что-то новое!</p>
								<form action="<?php echo e(route("GamePage")); ?>" method="GET">
                                	<button type="submit" class="btn btn-primary">Играть</button>
								</form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.list-group-item');
            const historyContent = document.getElementById('historyContent');
            const gameContent = document.getElementById('gameContent');
            const notificationsContent = document.getElementById('notificationsContent');
            const subscriptionsContent = document.getElementById('subscriptionsContent');
            const bonusCard = document.getElementById('bonusCard');
            const transferContent = document.getElementById('transferContent');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const buttonText = this.textContent.trim(); // Получаем текст кнопки
                    hideAllContents(); // Скрыть все контенты
                    if (buttonText === 'Баланс') {
                        bonusCard.classList.remove('d-none'); // Показываем карточку с бонусами
                    } else if (buttonText === 'Перевод') {
                        transferContent.classList.remove('d-none'); // Показываем форму перевода
                    } else if (buttonText === 'Уведомления') {
                        notificationsContent.classList.remove('d-none'); // Показываем уведомления
                    } else if (buttonText === 'Подписки') {
                        subscriptionsContent.classList.remove('d-none'); // Показываем подписки
                    } else if (buttonText === 'История') {
                        historyContent.classList.remove('d-none'); // Показываем историю
                    } else if (buttonText === 'Игра') {
                        gameContent.classList.remove('d-none'); // Показываем игровой контент
                    }
                });
            });

            function hideAllContents() {
                historyContent.classList.add('d-none');
                gameContent.classList.add('d-none');
                notificationsContent.classList.add('d-none');
                subscriptionsContent.classList.add('d-none');
                bonusCard.classList.add('d-none');
                transferContent.classList.add('d-none');
            }
            // Обработка отправки формы перевода
            const transferForm = document.getElementById('transferForm');
            transferForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Предотвращаем перезагрузку страницы
                const recipient = document.getElementById('recipient').value;
                const amount = document.getElementById('amount').value;
                alert(`Переведено ${amount} бонусов на счет ${recipient}`);
                transferForm.reset(); // Сброс формы
            });
        });
    </script>

    <div class="container px-4 py-5" id="hanging-icon">
        <h2 class="pb-2 border-bottom">Наши партнеры и их предложения</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <a class="sc-gcUDKN eoTqhA" href="/partners/5ac798ea-cc3b-419f-8fdd-466ff43c19bc">
                    <div class="card text-center">
                        <img src="https://storage.multibonus.ru/2bf59f1c_0e08_4a4a_8780_7587753e9534_logo_afisha_ru_698d7e6ba2.png"
                            class="card-img-top">
                        <div class="card-body">
                            <h2 class="card-title" style="color: black;">Кешбэк до 20%</h2>
                            <p class="card-text">Действует до 31.12.2024</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a class="sc-gcUDKN eoTqhA" href="/partners/2">
                    <div class="card text-center">
                        <img data-test-id="PARTNER-info-image" alt="" role="presentation"
                            src="https://storage.multibonus.ru/front-prod/images/logo_gold_apple_64af8a9444.png"
                            class="partner-info-styles__StyledPartnerInfoImage-iKYBqs LvCCG">
                        <div class="card-body">
                            <h2 class="card-title" style="color: black;">Кешбэк до 5%</h2>
                            <p class="card-text">Действует до 15.01.2025</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a class="sc-gcUDKN eoTqhA" href="/partners/3">
                    <div class="card text-center">
                        <img data-test-id="PARTNER-info-image" alt="" role="presentation"
                            src="https://storage.multibonus.ru/f74d887b_27e5_49aa_be86_fd5a81e23e08_logo_Miuz_diamonds_0e9f827938.png"
                            class="partner-info-styles__StyledPartnerInfoImage-iKYBqs LvCCG">
                        <div class="card-body">
                            <h2 class="card-title" style="color: black;">Кешбэк до 10%</h2>
                            <p class="card-text">Действует до 28.02.2025</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a class="sc-gcUDKN eoTqhA" href="/partners/4">
                    <div class="card text-center">
                        <img data-test-id="PARTNER-info-image" alt="" role="presentation"
                            src="https://storage.multibonus.ru/749fb3c4_f2e6_4e26_b443_4194985573a4_logo_gruzovichkof_ce2a396af2.png"
                            class="partner-info-styles__StyledPartnerInfoImage-iKYBqs LvCCG">
                        <div class="card-body">
                            <h2 class="card-title" style="color: black;">Кешбэк до 7%</h2>
                            <p class="card-text">Действует до 30.03.2025</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>


    <div class="container px-4 py-5">
        <h2 class="pb-2 border-bottom">Частые вопросы</h2>

        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
            <div class="col d-flex flex-column align-items-start gap-2">
                <h2 class="fw-bold text-body-emphasis">Основные вопросы о кешбэке</h2>
                <p class="text-body-secondary">Здесь вы найдете ответы на часто задаваемые вопросы о программе кешбэка и
                    использовании бонусов.</p>
            </div>

            <div class="col">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <div class="col d-flex flex-column gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                            <svg class="bi" width="1em" height="1em">
                                <use xlink:href="#collection"></use>
                            </svg>
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Почему лучше выбирать категории до начала
                            месяца?</h4>
                        <p class="text-body-secondary">Так вы сможете получать кешбэк с начала следующего месяца, а не с
                            даты выбора, и не теряя выгоду.</p>
                    </div>

                    <div class="col d-flex flex-column gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                            <svg class="bi" width="1em" height="1em">
                                <use xlink:href="#gear-fill"></use>
                            </svg>
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Куда и когда начисляется кешбэк?</h4>
                        <p class="text-body-secondary">Кешбэк начисляется на мастер-счет до 20 числа следующего месяца.
                            А в течение месяца прогноз начислений кешбэка за покупки можно отслеживать в онлайн-режиме в
                            разделе «Кешбэк» в ВТБ Онлайн.</p>
                    </div>

                    <div class="col d-flex flex-column gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                            <svg class="bi" width="1em" height="1em">
                                <use xlink:href="#speedometer"></use>
                            </svg>
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Что будет, если забыли выбрать категории?</h4>
                        <p class="text-body-secondary">Чтобы получать кешбэк, важно каждый месяц выбирать категории.
                            Если категории не выбраны, кешбэк не начисляется.</p>
                    </div>

                    <div class="col d-flex flex-column gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                            <svg class="bi" width="1em" height="1em">
                                <use xlink:href="#table"></use>
                            </svg>
                        </div>
                        <h4 class="fw-semibold mb-0 text-body-emphasis">Как использовать накопленные бонусы?</h4>
                        <p class="text-body-secondary">Накопленные бонусы можно использовать для получения скидок при
                            оплате товаров и услуг в партнерских магазинах.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">

            </div>
            <div class="col-6 col-md">
                <h5>Отделения и банкоматы</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1">
                        <a class="link-secondary text-decoration-none" href="#">© Банк ВТБ (ПАО),
                            2007–2024</a>
                        <a class="link-secondary text-decoration-none" href="#">© Банк ВТБ (ПАО),
                            2007–2024</a>
                    </li>

                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Контакты</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">1 000</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">8 800 100-24-24</a>
                    </li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">+7 495 777-24-24</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>
<?php /**PATH /home/tobecomeawind/Devs/OpenApi/resources/views/Home.blade.php ENDPATH**/ ?>