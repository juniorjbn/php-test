<h3>Select</h3>

<?php
$dbhost = getenv('DATABASE_SERVICE_NAME') ?: "mysql";
$dbuser = getenv('MYSQL_USER');
$dbpass = getenv('MYSQL_PASSWORD');

$link = mysqli_connect($dbhost, $dbuser, $dbpass);

$style_selected = "style=\"background-color: blue; color: white;\"";

// notice: no error handling for the sake of simplicity

function run_sql($link, $sql)
{
    $res = mysqli_query($link, $sql);
    if (gettype($res) == "mysqli_result") {
        print_r(mysqli_fetch_all($res));
    } else {
        print_r($res);
    }
}

function list_databases($link)
{
    $sql = "SHOW DATABASES";
    $res = mysqli_query($link, $sql);
    $databases = array();

    while ($row = mysqli_fetch_row($res)) {
        if (($row[0] != "information_schema")
           && ($row[0] != "mysql")
           && ($row[0] != "performance_schema")) {
            $databases[] = $row[0];
        }
    }

   return $databases;
}

function ask_database($link, $current=null)
{
    global $style_selected;

    echo "<p>Selecione a base: ";
    $databases = list_databases($link);
    foreach ($databases as $db) {
        if ($current === $db) {
            echo "<a href=\"?db=$db\" $style_selected>$db</a> ";
        } else {
            echo "<a href=\"?db=$db\">$db</a> ";
        }
    }
    echo "</p>\n";
}

function list_tables($link, $db)
{
    $sql = "SHOW TABLES";
    $res = mysqli_query($link, $sql);
    $tables = array();

    while ($row = mysqli_fetch_row($res)) {
        $tables[] = $row[0];
    }

   return $tables;
}

function ask_table($link, $db, $current=null)
{
    global $style_selected;

    echo "<p>Selecione a tabela ($db): ";
    $tables = list_tables($link, $db);
    foreach ($tables as $table) {
        if ($current === $table) {
            echo "<a href=\"?db=$db&table=$table\" $style_selected>$table</a> ";
        } else {
            echo "<a href=\"?db=$db&table=$table\">$table</a> ";
        }
    }
    echo "</p>\n";
}

function dump_table($link, $db, $table)
{
    echo "<p>Conteúdo da tabela ($db.$table)<br>";
    $sql = "SELECT * from $table";
    $res = mysqli_query($link, $sql);

    //list field names
    $fields  = mysqli_fetch_fields($res);

    echo "<table border=1>\n";
    echo "  <tr>\n";
    foreach ($fields as $field) {
        echo "    <td>$field->name ($field->type)</td>\n";
    }
    echo "  </tr>\n";

    while ($row = mysqli_fetch_row($res)) {
        echo "  <tr>\n";
        foreach ($row as $col) {
            echo "    <td>$col</td>\n";
        }
        echo "  <tr>\n";
    }
    echo "</table></p>\n";

}

$db = $_GET["db"] ?: null;
if ($db) {
    mysqli_select_db($link, $db);
}
ask_database($link, $db);

$table = $_GET["table"] ?: null;
if ($db) {
    ask_table($link, $db, $table);
}

if ($db && $table) {
    dump_table($link, $db, $table);
}
?>

<h3>Run sql</h3>
<form method=post>
    <textarea rows="6" cols="80" name="sql"></textarea>
    <br>
    <input type=submit value="Run SQL"/>
</form>

<?php
if ($_POST["sql"]) {
    echo "<hr>";
    echo "<pre>mysql&gt; $_POST[sql];\n";
    run_sql($link, $_POST["sql"]);
    echo "</pre>\n";
}
?>
