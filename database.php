<?php
$mysqli = new mysqli("galerinha:3306", "user", "vEYRj2BgpQhh", "userdb");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* return name of current default database */
if ($result = $mysqli->query("SHOW STATUS LIKE 'wsrep_cluster_size'")) {
    $row = $result->fetch_row();
    printf("Number of Cluster Replicas : %s\n", $row[0]);
    $result->close();
}

$mysqli->close();
?>
