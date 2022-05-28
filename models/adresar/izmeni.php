<?php

if(isset($_POST['btnSacuvaj'])){

    require_once "../../config/connection.php";

    $id = $_POST['id'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];

    $regex = "/^[^&]*$/";

    if(preg_match($regex, $ime) && preg_match($regex, $prezime)){

        $open = fopen(ADRESAR, "r");
        
        $podaci = file(ADRESAR);

        $string = "";

        foreach($podaci as $key=>$value){
            if($key == $id){
                $string .= $ime.SEPARTOR.$prezime."\n";
            } else {
                $string .=$value;
            }
        }

        $open = fopen(ADRESAR, "w");

        fwrite($open, $string);

        fclose($open);
        header("Location: ../../index.php?page=zadatak1");
    }
    else {
        echo "Ne smete uneti &!!!";
    }
}