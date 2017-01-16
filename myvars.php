<?php
$var_name = $_GET["AMBIENTE"];
echo "Este é o $var_name de '" . getenv($var_name) . "'\n";
?>