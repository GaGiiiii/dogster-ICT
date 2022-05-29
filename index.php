<?php

require_once "config/connection.php";
include "views/fixed/head.php";

if (!isset($_GET['page'])) {
    include "views/home.php";
} else {
    switch ($_GET['page']) {
        case 'about':
            include "views/about.php";
            break;
        case 'dogs-edit':
            include "views/dogs/edit.php";
            break;
        case 'dogs':
            include "views/dogs/show.php";
            break;
        case 'add-new-dog':
            include "views/dogs/add.php";
            break;
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
        case 'logout':
            include "views/logout.php";
            break;
        default:
            include "views/home.php";
            break;
    }
}

include "views/fixed/footer.php";
