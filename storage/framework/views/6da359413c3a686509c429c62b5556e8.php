<?php

$files = [
    1 => view('index'),
    2 => view('game')
];

$randomKey = array_rand($files);

echo $files[$randomKey];

?>
<?php /**PATH /home/tobecomeawind/Devs/OpenApi/resources/views/randomGame.blade.php ENDPATH**/ ?>