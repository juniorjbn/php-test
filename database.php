<?php
$mysqli = new mysqli("galera:3306", "user", "vEYRj2BgpQhh", "userdb");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* return name of current default database */
if ($result = $mysqli->query("SELECT my FROM status")) {
    $row = $result->fetch_row();
    printf("Connection to Mysql status : %s\n", $row[0]);
    $result->close();
}

$mysqli->close();
?>
