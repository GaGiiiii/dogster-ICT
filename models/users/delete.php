<?php

header('Content-Type: application/json');

if(isset($_GET['id'])){
    require_once '../../config/connection.php';

    $id = $_GET['id'];
    $rezultat = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $rezultat->bindValue(1, $id);

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