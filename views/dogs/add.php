<?php

if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 0)) {
    header("Location: index.php");

    exit;
}

?>

<section class="mt-4 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10 col-10 g-0">
                <div>
                    <h1 class="mb-1">Submit new dog &#128021;</h1>
                    <p class="mb-4">Fields marked with <strong class="text-danger">*</strong> are required.</p>

                    <div id="add-new-dog-errors" class="mb-3"></div>

                    <form id="submit-new-dog-form">
                        <div class="mb-4">
                            <label class="form-label">Breed <strong class="text-danger">*</strong></label>
                            <input name="breed" type="text" class="form-control" placeholder="Enter breed">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Name <strong class="text-danger">*</strong></label>
                            <input name="name" type="text" class="form-control" placeholder="Enter name">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description <strong class="text-danger">*</strong></label>
                            <textarea class="form-control" name="description" placeholder="Enter description" id="floatingTextarea2" style="height: 100px"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Upload Image <strong class="text-danger">*</strong></label> <br>
                            <input type="file" name="file">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/api/dogs/dogs.js"></script>