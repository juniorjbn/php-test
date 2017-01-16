<?php
$var_name = $_SERVER["AMBIENTE"];
echo "Este é o $var_name de '" . getenv($var_name) . "'\n";
?>