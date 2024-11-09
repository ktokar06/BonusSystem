<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Банковская Игра: Лови Деньги!</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #333;
        }

        canvas {
            display: block;
            margin: 0 auto;
            background: #0072c6;
            border: 5px solid #00a3e0;
            border-radius: 10px;
        }

        #score, #lives {
            position: absolute;
            top: 10px;
            font-size: 20px;
            color: #FFD700;
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
            background: #00367A;
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
        let lives = 3;
        let isGameOver = false;
        const bagWidth = 30;
        const bagHeight = 30;
        const basketHeight = 20;
        let basketX = canvas.width / 2 - bagWidth / 2;

        function drawBasket() {
            ctx.fillStyle = '#8B4513';
            ctx.fillRect(basketX, canvas.height - basketHeight, bagWidth, basketHeight);
            ctx.strokeStyle = '#FFFFFF';
            ctx.lineWidth = 3;
            ctx.strokeRect(basketX, canvas.height - basketHeight, bagWidth, basketHeight);
        }

        function drawMoneyBags() {
            ctx.fillStyle = '#FFD700';
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
                    return true;
                }
            }
            return false;
        }

        function updateMoneyBags() {
            if (Math.random() < 0.016) {
                let newX, newY;
                do {
                    newX = Math.random() * (canvas.width - bagWidth);
                    newY = Math.random() * 100;
                } while (checkCollision(newX, newY));

                moneyBags.push({
                    x: newX,
                    y: newY
                });
            }

            moneyBags.forEach((bag, index) => {
                bag.y += 6;

                if (bag.y + bagHeight >= canvas.height - basketHeight &&
                    bag.x < basketX + bagWidth &&
                    bag.x + bagWidth > basketX) {
                    score++;
                    document.getElementById('score').innerText = 'Счет: ' + score;
                    moneyBags.splice(index, 1);
                }

                if (bag.y > canvas.height) {
                    lives--;
                    document.getElementById('lives').innerText = 'Жизни: ' + lives;
                    moneyBags.splice(index, 1);

                    if (lives <= 0) {
                        isGameOver = true;
                    }
                }
            });
        }

        function drawGameOver() {
            document.getElementById('finalScore').innerText = score;
            document.getElementById('gameOver').style.display = 'block';
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
            window.location.href = "newpage.html";
        });

        document.addEventListener('mousemove', function(event) {
            basketX = event.clientX - canvas.getBoundingClientRect().left - bagWidth / 2;
            basketX = Math.max(0, Math.min(basketX, canvas.width - bagWidth));
        });

        gameLoop();
    </script>
</body>

</html>
