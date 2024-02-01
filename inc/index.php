<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "dott";
$db_conn = "";
try{
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
}catch(mysqli_sql_exception){
    echo "not connected to database";
}
?>
