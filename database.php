<?php
/* 
Criar a tabela e inserir dados para pegar na query
CREATE TABLE status (name VARCHAR(20), estado VARCHAR(20));
INSERT INTO status (name,estado) VALUES("my","ok"); 

*/

$mysqli = new mysqli("galerinha:3306", "user", "vEYRj2BgpQhh", "userdb");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* return name of current default database */
if ($result = $mysqli->query("SELECT estado FROM status")) {
    $row = $result->fetch_row();
    printf("Number of Cluster Replicas : %s\n", $row[1]);
    $result->close();
}

if ($result2 = $mysqli->query("SHOW STATUS LIKE 'wsrep_cluster_size'")) {
    $row2 = $result2->fetch_row();
    printf("Number of Cluster Replicas : %s\n", $row2[0]);
    $result2->close();
}



$mysqli->close();
?>
