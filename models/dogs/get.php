<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

try {
    $id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM dogs WHERE id = ?");
    $query->execute(array(
        $id
    ));

    $dog = $query->fetch(PDO::FETCH_ASSOC);

    http_response_code(201);
    echo json_encode(["dog" => $dog]);

    exit;
} catch (PDOException $ex) {
    echo json_encode(['errors' => ['db_error' => 'DB Error: ' . $ex->getMessage()]]);
    http_response_code(500);
}
