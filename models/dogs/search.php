<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $searchValue = $_POST['searchValue'];

        $query = $conn->prepare("SELECT * FROM dogs WHERE name LIKE ? OR breed LIKE ?");
        $query->execute(array(
            "%$searchValue%",
            "%$searchValue%"
        ));

        $dogs = $query->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(201);
        echo json_encode(["dogs" => $dogs]);

        exit;
    } catch (PDOException $ex) {
        echo json_encode(['errors' => ['db_error' => 'DB Error: ' . $ex->getMessage()]]);
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}
