<?php

// Podesavanje da PHP stranica vraca JSON

header('Content-Type: application/json');

if (isset($_POST['register'])) {
    require_once '../../config/connection.php';

    $naziv = $_POST['naziv'];
    $rezultat = $conn->prepare("INSERT INTO categories VALUES (NULL, ?)");

    try {
        // Drugi nacin da se ? zameni sa vrednoscu!
        // Metodi "execute()" se prosledjuje NIZ vrednosti!

        $rezultat->execute([$naziv]);

        http_response_code(201); // 201 - Created

        // 204 statusni kod govori klijentu (JS) da se nista nece vratiti kao poruka
        // Medjutim, 201 govori da je sve ok, ali NE i da se nista nece vratiti

        // Ako smo u AJAX naveli "dataType:json", ovde se mora vratiti UVEK json!!! (Osim kada je kod 204, jer on kaze da nece vratiti nista)

        // Bez ove linije pokusati i pogledati rezultat -> ucice u ERROR!! Greska: ne moze da parsira JSON
        echo json_encode(["uspeh" => "Uspesno kreirana kategorija!"]);
    } catch (PDOException $ex) {
        echo json_encode(['poruka' => 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}
