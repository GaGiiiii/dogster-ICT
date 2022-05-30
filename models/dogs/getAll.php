<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

try {
    $query = $conn->prepare("SELECT * FROM `dogs`");
    $query->execute();
    $dogs = $query->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(201);
    echo json_encode(["dogs" => $dogs]);

    exit;
} catch (PDOException $ex) {
    echo json_encode(['errors' => ['db_error' => 'DB Error: ' . $ex->getMessage()]]);
    http_response_code(500);
}
