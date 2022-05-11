<?php
require_once "../../config/config.php";

if(isset($_POST['btnSacuvaj'])){
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];

    $regex = "/^[^&]*$/";

    if(preg_match($regex, $ime) && preg_match($regex, $prezime)){

        $open = fopen(ADRESAR, "a");
        $string = $ime.SEPARTOR.$prezime."\n";
        fwrite($open, $string);
        fclose($open);
        header("Location: ../../index.php?page=zadatak1");
    }
    else {
        echo "Ne smete uneti &&!!!";
    }
}