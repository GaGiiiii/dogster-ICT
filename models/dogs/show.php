<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

try {
    $id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM dogs WHERE id = :id");
    $query->execute(array(
        ':id' => $id,
    ));

    $dog = $query->fetch(PDO::FETCH_ASSOC);

    $query = $conn->prepare("SELECT c.*, u.username, u.id AS UID FROM comments c JOIN users u ON u.id = c.user_id WHERE dog_id = :id ORDER BY c.id DESC");
    $query->execute(array(
        ':id' => $id,
    ));

    $comments = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $conn->prepare("SELECT * FROM favorites WHERE dog_id = :dog_id");
    $query->execute(array(
        ':dog_id' => $id,
    ));

    $favorites = $query->fetchAll(PDO::FETCH_ASSOC);


    $query = $conn->prepare("SELECT * FROM favorites WHERE user_id = :user_id AND dog_id = :dog_id");
    $query->execute(array(
        ':user_id' => $_SESSION['user']['id'] ?? -1,
        ':dog_id' => $id,
    ));

    $favorite = $query->fetch(PDO::FETCH_ASSOC);
    $favorite = $favorite ? true : false;

    http_response_code(200);
    echo json_encode([
        'dog' => $dog,
        'comments' => $comments,
        'favorites' => $favorites,
        'favorite' => $favorite,
        'admin' => isset($_SESSION['user']) && $_SESSION['user']['is_admin'],
        'user' => isset($_SESSION['user'])
    ]);

    exit;
} catch (PDOException $ex) {
    echo json_encode(['errors' => ['db_error' => 'DB Error: ' . $ex->getMessage()]]);
    http_response_code(500);
}
