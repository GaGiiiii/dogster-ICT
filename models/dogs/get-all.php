<?php

header('Content-Type: application/json');

require_once '../../config/connection.php';

$kategorije = executeQuery("SELECT * FROM categories");
echo json_encode($kategorije);