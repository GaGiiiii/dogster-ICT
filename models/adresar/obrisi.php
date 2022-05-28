<?php

if(isset($_GET['id'])){

    require_once "../../config/connection.php";

    $id = $_GET['id'];

    $open = fopen(ADRESAR, "r");
    $podaci = file(ADRESAR);

    fclose($open);

    $string = "";
    foreach($podaci as $key => $value){
        if($key != $id){
            $string .= $value;
        }
    }

    $open = fopen(ADRESAR, "w");

    fwrite($open, $string);
    fclose($open);
    header("Location: ../../index.php?page=zadatak1");

} else {
    http_response_code(400);
}