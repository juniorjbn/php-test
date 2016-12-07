<?php
$hostname = getenv('HOSTNAME');
if (substr($hostname, 0, 5) == 'siteb') {
    echo 'Response from host:      ' . getenv('HOSTNAME') . "\n";
} else {
    echo 'Response from host: ' . getenv('HOSTNAME') . "\n";
}
?>
