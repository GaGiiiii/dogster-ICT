<?php

if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 0)) {
    header("Location: index.php");

    exit;
}

?>

<div class="col-md-10 offset-md-1 mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">Pages statistics</h5>
            <hr>
            <p class="card-text">
            <table class="table text-center table-hover">
                <thead>
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">TOTAL VISITS</th>
                        <th scope="col">LAST 24h VISITS</th>
                    </tr>
                </thead>
                <tbody class="pages-stat">

                </tbody>
            </table>
            <h5 class="card-title active-users"></h5>
            <hr>
            </p>
        </div>
    </div>
</div>

<script src="assets/js/api/admin/admin.js"></script>