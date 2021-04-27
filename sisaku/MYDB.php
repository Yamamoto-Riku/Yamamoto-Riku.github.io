<?php
function db_connect(){

$db_user = "appter_hanatarou";
$db_pass = "hanatarou";
$db_host = "mysql1.php.xdomain.ne.jp";
$db_name = "appter_yamada";
$db_type = "mysql";

$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

try{
    $pdo = new PDO($dsn,$db_user,$db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (Exception $ex) {
    die($ex->getMessage());
}
return $pdo;
}

?>