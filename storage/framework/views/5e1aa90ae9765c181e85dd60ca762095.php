<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Банковская Игра: Лови Деньги!</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right, #0072c6, #00367A);
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        #gameInterface {
            position: relative;
            width: 400px;
            height: 600px;
            overflow: hidden;
            background: rgba(0, 54, 122, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        canvas {
            width: 100%;
            height: 100%;
            background: #0072c6;
            border-radius: 10px;
        }

        #score, #lives {
            position: absolute;
            font-size: 20px;
            color: #FFD700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }

        #score { top: 10px; left: 10px; }
        #lives { top: 10px; right: 10px; }

        #gameOver {
            display: none;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #0072c6;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        #gameOver h2 {
            margin: 0;
            color: #d9534f;
        }

        #gameOver p { color: #000; }
        #restartButton {
            padding: 10px 20px;
            background: #0072c6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #restartButton:hover { background: #005bb5; }
        #message {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 30px;
            color: #FFD700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            display: none;
            z-index: 1;
        }
    </style>
</head>

<body>
    <div id="gameInterface">
        <canvas id="gameCanvas" width="400" height="600"></canvas>
        <div id="score">Счет: 0</div>
        <div id="lives">Жизни: 3</div>
        <div id="message"></div>
    </div>

    <div id="gameOver">
        <h2>Игра Окончена</h2>
        <p>Ваш Счет: <span id="finalScore">0</span></p>
        <button id="restartButton">Назад</button>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        const walletImage = new Image();
        walletImage.src = '<?php echo asset('11696885.png'); ?>';
        let moneyBags = [];
        let score = 0;
        let lives = 3;
        let isGameOver = false;
        const bagRadius = 15;
        const basketHeight = 40;
        const walletWidth = 40;
        let basketX = canvas.width / 2 - walletWidth / 2;
        let spawnInterval;
        let messageElement = document.getElementById('message');

        function showMessage(text) {
            messageElement.innerText = text;
            messageElement.style.display = 'block';
            setTimeout(() => { messageElement.style.display = 'none'; }, 1500);
        }

        function drawBasket() {
            ctx.drawImage(walletImage, basketX, canvas.height - basketHeight, walletWidth, basketHeight);
        }

        function drawMoneyBags() {
            moneyBags.forEach(bag => {
                ctx.fillStyle = '#FFD700';
                ctx.beginPath();
                ctx.arc(bag.x + bagRadius, bag.y + bagRadius, bagRadius, 0, Math.PI * 2);
                ctx.fill();
                ctx.strokeStyle = '#FFFFFF';
                ctx.lineWidth = 2;
                ctx.stroke();
                ctx.fillStyle = 'black';
                ctx.font = '16px Arial';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText('₽', bag.x + bagRadius, bag.y + bagRadius);
            });
        }

        function checkCollision(x, y) {
            for (let i = 0; i < moneyBags.length; i++) {
                if (x < moneyBags[i].x + bagRadius * 2 && x + bagRadius * 2 > moneyBags[i].x && y < moneyBags[i].y + bagRadius * 2 && y + bagRadius * 2 > moneyBags[i].y) {
                    return true;
                }
            }
            return false;
        }

        function addMoneyBag() {
            let newX, newY;
            do {
                newX = Math.random() * (canvas.width - bagRadius * 2);
                newY = Math.random() * 1;
            } while (checkCollision(newX, newY));
            moneyBags.push({ x: newX, y: newY });
        }

        function updateMoneyBags() {
            moneyBags.forEach((bag, index) => {
                bag.y += 11;
                if (bag.y + bagRadius * 2 >= canvas.height - basketHeight && bag.x < basketX + walletWidth && bag.x + bagRadius * 2 > basketX) {
                    score++;
                    document.getElementById('score').innerText = 'Счет: ' + score;
                    showMessage('+1');
                    moneyBags.splice(index, 1);
                }
                if (bag.y > canvas.height) {
                    lives--;
                    document.getElementById('lives').innerText = 'Жизни: ' + lives;
                    showMessage('Промах!');
                    moneyBags.splice(index, 1);
                    if (lives <= 0) {
                        isGameOver = true;
                        clearInterval(spawnInterval);
                    }
                }
            });
            moneyBags = moneyBags.filter(bag => bag.y < canvas.height);
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
           	window.location.href = "<?php echo route('HomePage'); ?>"; 
        });

        document.addEventListener('mousemove', function(event) {
            basketX = event.clientX - canvas.getBoundingClientRect().left - (walletWidth / 2);
            basketX = Math.max(0, Math.min(basketX, canvas.width - walletWidth));
        });

        walletImage.onload = function() {
            gameLoop();
            spawnInterval = setInterval(addMoneyBag, 400);
        };
    </script>
</body>

</html>
<?php /**PATH /home/tobecomeawind/Devs/OpenApi/resources/views/game.blade.php ENDPATH**/ ?>