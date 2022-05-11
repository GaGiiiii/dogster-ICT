<?php

// Podesavanje da PHP stranica vraca JSON

header('Content-Type: application/json');

if(isset($_POST['id']) && isset($_POST['naziv'])){
    require_once '../../config/connection.php';

    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $rezultat = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");

    /*  
        Kako upit treba da izgleda?
        UPDATE categories SET naziv = 'jakne'

        Mi navodnike nismo stavili u okviru upita. 

        PITANJE: Na osnovu cega metod prepare() zna da treba staviti znake navoda?
        ODGOVOR: Na osnovu tipa podataka koji se nalazi u promenljivoj - STRING
    */

    $rezultat->bindValue(1, $naziv);
    $rezultat->bindValue(2, $id);

    try {
        $rezultat->execute();
        http_response_code(204); // 204 - Success and No content (Nothing to return)
    }
    catch(PDOException $ex){
        echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}