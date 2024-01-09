<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    pre {
      font-family: 'Segoe UI', sans-serif;
    }
  </style>
</head>

<body>
</body>

</html>

<?php

$i = 5;

function test($arg) {
  echo $arg;
}

// test($i);

// $words = ["apple", "pear", "banana", "computer"];
$words = file('words.txt');

$test_array = array_rand($words, 10);

echo '<pre>';
for ($i = 0; $i < count($test_array); $i++) {
  echo $words[$test_array[$i]];
  // echo $test_array[$i] . PHP_EOL;
}
echo '</pre>';

$word = rtrim($words[array_rand($words)]);

$word_length = strlen($word);
echo "$word $word_length ";

for ($i = 0; $i < $word_length; $i++) {
  echo "_ ";
}
?>