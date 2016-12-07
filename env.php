<?php
$var_name = $_GET["var"];
echo "Env var $var_name is '" . getenv($var_name) . "'\n";
?>
