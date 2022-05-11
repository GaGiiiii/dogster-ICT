<?php

// Obezbediti da PHP strana vraća JSON.

header('Content-Type: application/json');

if(isset($_GET['id'])){
    require_once '../../config/connection.php';

    $id = $_GET['id'];

    $rezultat = $conn->prepare("SELECT * FROM categories WHERE id = ?");

    /*  
        Kako upit treba da izgleda?
        SELECT * FROM categories WHERE id = 1


        PITANJE: Na osnovu cega metod prepare() zna da NE treba staviti znake navoda?
        ODGOVOR: Na osnovu tipa podataka koji se nalazi u promenljivoj - BROJ
    */

    $rezultat->bindValue(1, $id);

    try {
        $rezultat->execute();
        $kategorija = $rezultat->fetch();
        echo json_encode($kategorija);
    }
    catch(PDOException $ex){
        echo json_encode(['poruka', 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}