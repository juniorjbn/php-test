<?php
function fib($n)
{
    if ($n <= 2)
        return 1;
    else
        return fib($n - 1) + fib($n - 2);
}

$value = $_GET["value"];
$loop = array_key_exists("loop", $_GET);

$starttime = microtime(true);
$result = fib($value);
$elapsedtime = microtime(true) - $starttime;

if ($loop) {
    header("Location: $_SERVER[REQUEST_URI]");
}
header("Content-Type: text/plain");

printf("Fibonacci(%s) = %s (%0.2fs)\n", $value, $result, $elapsedtime);
?>
