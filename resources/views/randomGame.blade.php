@php

$files = [
    1 => view('index'),
    2 => view('game')
];

$randomKey = array_rand($files);

echo $files[$randomKey];

@endphp
