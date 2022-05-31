<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

try {
    $perPage = 6;
    $page = $_GET['pagination'];
    $offset = $page * $perPage - $perPage;

    $query = $conn->prepare("SELECT * FROM `dogs`");
    $query->execute();
    $totalPages = ceil(sizeof($query->fetchAll(PDO::FETCH_ASSOC)) / $perPage);

    $query = $conn->prepare("SELECT * FROM `dogs` LIMIT $perPage OFFSET $offset");
    $query->execute();
    $dogs = $query->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(201);
    echo json_encode(["dogs" => $dogs, 'totalPages' => $totalPages]);

    exit;
} catch (PDOException $ex) {
    echo json_encode(['errors' => ['db_error' => 'DB Error: ' . $ex->getMessage()]]);
    http_response_code(500);
}
