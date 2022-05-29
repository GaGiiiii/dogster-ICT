<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $sortValue = $_POST['sortValue'];

        switch ($sortValue) {
            case 1:
                $query = $conn->prepare("SELECT * FROM dogs");
                $query->execute();

                $dogs = $query->fetchAll(PDO::FETCH_ASSOC);
                break;
            case 2:
                $query = $conn->prepare("SELECT d.*, COUNT(c.dog_id) AS BROJ_KOM FROM dogs d LEFT JOIN comments c ON c.dog_id = d.id GROUP BY d.id, c.dog_id ORDER BY BROJ_KOM DESC");
                $query->execute();

                $dogs = $query->fetchAll(PDO::FETCH_ASSOC);
                break;
            case 3:
                $query = $conn->prepare("SELECT d.*, COUNT(f.dog_id) AS BROJ_FAV FROM dogs d LEFT JOIN favorites f ON f.dog_id = d.id GROUP BY d.id, f.dog_id ORDER BY BROJ_FAV DESC");
                $query->execute();

                $dogs = $query->fetchAll(PDO::FETCH_ASSOC);
                break;
        }

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
