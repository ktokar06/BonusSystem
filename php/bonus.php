<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Банковская Игра: Лови Деньги!</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background: #f4f6f9; /* Светлый фон */
            font-family: Arial, sans-serif;
            color: #333;
        }

        canvas {
            display: block;
            margin: 0 auto;
            background: #0072c6; /* Темно-синий VTB */
            border: 5px solid #00a3e0; /* Светло-синие границы */
            border-radius: 10px; /* С закругленными углами */
        }

        #score, #lives {
            position: absolute;
            top: 10px;
            font-size: 20px;
            color: #FFD700; /* Золотистый цвет для счёта и жизней */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8), -1px -1px 2px rgba(0, 0, 0, 0.8);
        }

        #score {
            left: 20px;
        }

        #lives {
            right: 20px;
        }

        #gameOver {
            display: none;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #0072c6;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        #gameOver h2 {
            margin: 0;
            color: red;
        }

        #restartButton {
            padding: 10px 20px;
            background: #0072c6;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        #restartButton:hover {
            background: #005bb5;
        }
        #gameInterface {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 10px;
            background: #00367A; /* Темно-синий интерфейс */
            color: white;
            text-align: center;
            font-size: 22px;
            border-bottom: 3px solid #00a3e0;
        }
    </style>
</head>

<body>
    <div id="gameInterface">
        <div id="score">Счет: 0</div>
        <div>Игра</div>
        <div id="lives">Жизни: 3</div>
    </div>
    <canvas id="gameCanvas" width="400" height="600"></canvas>

    <div id="gameOver">
        <h2>Игра Окончена</h2>
        <p>Ваш Счет: <span id="finalScore">0</span></p>
        <button id="restartButton">Назад</button>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        let moneyBags = [];
        let score = 0;
        let lives = 3; // Количество жизней
        let isGameOver = false;
        const bagWidth = 30;
        const bagHeight = 30;
        const basketHeight = 20; // Увеличена высота корзины
        let basketX = canvas.width / 2 - bagWidth / 2;

        function drawBasket() {
            ctx.fillStyle = '#8B4513'; // Коричневый цвет для корзины
            ctx.fillRect(basketX, canvas.height - basketHeight, bagWidth, basketHeight);
            ctx.strokeStyle = '#FFFFFF'; // Цвет обводки
            ctx.lineWidth = 3; // Толщина обводки
            ctx.strokeRect(basketX, canvas.height - basketHeight, bagWidth, basketHeight); // Обводка корзины
        }

        function drawMoneyBags() {
            ctx.fillStyle = '#FFD700'; // Золотой цвет для мешков
            moneyBags.forEach(bag => {
                ctx.fillRect(bag.x, bag.y, bagWidth, bagHeight);
            });
        }

        function checkCollision(x, y) {
            for (let i = 0; i < moneyBags.length; i++) {
                if (
                    x < moneyBags[i].x + bagWidth &&
                    x + bagWidth > moneyBags[i].x &&
                    y < moneyBags[i].y + bagHeight &&
                    y + bagHeight > moneyBags[i].y
                ) {
                    return true; // Есть наложение
                }
            }
            return false; // Нет наложения
        }

        function updateMoneyBags() {
            if (Math.random() < 0.016) { // 1.6% шанс появления нового мешка денег
                let newX, newY;
                do {
                    newX = Math.random() * (canvas.width - bagWidth);
                    newY = Math.random() * 100; // Случайная начальная позиция по Y (0-100 пикселей)
                } while (checkCollision(newX, newY));

                moneyBags.push({
                    x: newX,
                    y: newY
                });
            }

            moneyBags.forEach((bag, index) => {
                bag.y += 6;

                // Проверка на ловлю мешка денег
                if (bag.y + bagHeight >= canvas.height - basketHeight &&
                    bag.x < basketX + bagWidth &&
                    bag.x + bagWidth > basketX) {
                    score++;
                    document.getElementById('score').innerText = 'Счет: ' + score;
                    moneyBags.splice(index, 1); // Удаляем пойманный мешок
                }

                // Если мешок упал ниже экрана
                if (bag.y > canvas.height) {
                    lives--;
                    document.getElementById('lives').innerText = 'Жизни: ' + lives;
                    moneyBags.splice(index, 1); // Удаляем упавший мешок

                    // Проверка на окончание игры
                    if (lives <= 0) {
                        isGameOver = true;
                    }
                }
            });
        }

        function drawGameOver() {
            document.getElementById('finalScore').innerText = score; // Отображаем конечный счет
            document.getElementById('gameOver').style.display = 'block'; // Показываем модальное окно
        }

        function update() {
            if (!isGameOver) {
                updateMoneyBags();
            }
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawMoneyBags();
            drawBasket();

            if (isGameOver) {
                drawGameOver();
            }
        }

        function gameLoop() {
            update();
            draw();
            requestAnimationFrame(gameLoop);
        }

        document.getElementById('restartButton').addEventListener('click', function() {
            // Перенаправление на новую страницу
            window.location.href = "newpage.html"; // замените "newpage.html" на нужный вам URL
        });

        document.addEventListener('mousemove', function(event) {
            basketX = event.clientX - canvas.getBoundingClientRect().left - bagWidth / 2;
            basketX = Math.max(0, Math.min(basketX, canvas.width - bagWidth));
        });

        gameLoop();
    </script>
</body>

</html>
        