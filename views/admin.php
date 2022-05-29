<?php

if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 0)) {
    header("Location: index.php");

    exit;
}
