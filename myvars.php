<?php
$var_name = $_GET["variavel"];
echo "Env var $var_name is '" . getenv($var_name) . "'\n";
?>