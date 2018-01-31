<?php

header("Access-Control-Allow-Origin: *");

$output = shell_exec(" curl -X POST -u 'juniorjbn:290fe1035b20f3ddf93fee0db11352cc' http://jenkins-meu-teste.getup.io/job/meu-teste/".$_POST['job_nu']."/input/Input1/proceedEmpty");

echo $output;


