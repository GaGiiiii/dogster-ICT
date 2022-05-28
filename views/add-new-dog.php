<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php");

    exit;
}

?>

<!-- -------- REGISTRACIJA ---------- -->
<section class="mt-4 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10 col-10 g-0">
                <div class="login-form-container">
                    <h1 class="mb-1">Submit new dog &#128021;</h1>
                    <p class="mb-4">Fields marked with <strong class="text-danger">*</strong> are required.</p>

                    <div id="register-errors" class="mb-3"></div>

                    <form id="submit-new-dog-form">
                        <div class="mb-4">
                            <label class="form-label">Breed <strong class="text-danger">*</strong></label>
                            <input name="breed" type="text" class="form-control" placeholder="Enter breed">
                            <?php echo $errors['breed'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Name <strong class="text-danger">*</strong></label>
                            <input name="name" type="text" class="form-control" placeholder="Enter name">
                            <?php echo $errors['name'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description <strong class="text-danger">*</strong></label>
                            <textarea class="form-control" name="description" placeholder="Enter description" id="floatingTextarea2" style="height: 100px"></textarea>
                            <?php echo $errors['description'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Upload Image <strong class="text-danger">*</strong></label> <br>
                            <input type="file" name="file">
                            <?php echo $errors['image'] ?? ""; ?>
                        </div>

                        <button name="register" type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- -------- REGISTRACIJA ---------- -->