<?php

header("Access-Control-Allow-Origin: *");


$data = json_decode($_POST['payload']);

$jobID = $data->actions[0]->value;

print_r($jobID);

//$output = shell_exec(" curl -L -X POST -u 'juniorjbn:290fe1035b20f3ddf93fee0db11352cc' http://jenkins-meu-teste.getup.io/job/meu-teste/$jobID/input/Input1/proceedEmpty");
$output = shell_exec("curl -L -X POST -u 'admin:8d13989101f7efd6206a140adff50c90' https://jenkins-aristides.getup.io/job/aristides/job/master/$jobID/input/Input1/proceedEmpty");

echo $output;

