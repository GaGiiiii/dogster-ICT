<?php

session_start();
require_once "config.php";

zabeleziPristupStranici($_GET['page'] ?? "index");

try {
    $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

function executeQuery($query)
{
    global $conn;
    return $conn->query($query)->fetchAll();
}

function zabeleziPristupStranici($page = "index")
{
    $open = fopen(LOG_FAJL, "a");
    $date = date('Y-m-d H:i:s');
    if ($open) {
        fwrite($open, "page=$page\ttime=$date\t{$_SERVER['PHP_SELF']}\t{$_SERVER['REMOTE_ADDR']}\n");
        fclose($open);
    }
}
