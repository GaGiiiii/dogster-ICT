<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php");

    exit;
}

?>

<div class="col-md-10 offset-md-1 mt-4 mb-5">
    <h1 class="mb-4 text-center">Welcome to your profile page :)</h1>
    <div class="card text-center">
        <div class="card-header profile-header">

        </div>
        <div class="card-body">
            <div class="accordion" id="accordionExample">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
                            <i class="fa fa-comments" aria-hidden="true"></i> &nbsp; <span class="comments-number"></span>&nbsp;Comments
                        </button>
                    </h2>
                    <div id="collapseComments" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-start">
                            <ul class="comments-list">

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fa fa-heart" aria-hidden="true"></i> &nbsp; <span class="favorites-number"></span>&nbsp;Favorite dogs
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-start">
                            <ul class="favorites-list">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted user-joined">
        </div>
    </div>
</div>

<script src="assets/js/api/users/users.js"></script>