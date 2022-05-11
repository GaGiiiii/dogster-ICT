<?php

require_once "config/connection.php";
include "views/fixed/head.php";

print "<pre>";
print_r($_SESSION['user'] ?? 'nita');
// die("PRR");
print "</pre>";

if (!isset($_GET['page'])) {
    include "views/home.php";
} else {
    switch ($_GET['page']) {
        case 'login':
            include "views/login.php";
            break;
        case 'register':
            include "views/register.php";
            break;
        case 'profile':
            include "views/profile.php";
            break;
        case 'admin':
            include "views/admin.php";
            break;
        default:
            include "views/home.php";
            break;
    }
}

include "views/fixed/footer.php";
