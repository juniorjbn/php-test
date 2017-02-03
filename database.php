<?php
$dbhost = "getenv('MYSQL_HOSTNAME'):3306";
$dbuser = "getenv('MYSQL_USER')";
$dbpass = "getenv('MYSQL_PASSWORD')";
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Falha na Conexão com o Banco de dados: ' . mysql_error());
}
$sql = 'SELECT my FROM status';

mysql_select_db('test_db');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    echo "Connection Status: {$row['my']}  <br> ".
         "--------------------------------<br>";
} 
echo "Fetched data successfully\n";
mysql_close($conn);
?>