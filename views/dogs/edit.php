<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php");

    exit;
}

$id = $_GET['id'];

$query = $conn->prepare("SELECT * FROM dogs WHERE id = :id");
$query->execute(array(
    ':id' => $id,
));

$dog = $query->fetch(PDO::FETCH_ASSOC);

?>

<!-- -------- REGISTRACIJA ---------- -->
<section class="mt-4 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10 col-10 g-0">
                <div class="login-form-container">
                    <h1 class="mb-1">Edit "<?php echo $dog['name']; ?>" &#128021;</h1>
                    <p class="mb-4">Fields marked with <strong class="text-danger">*</strong> are required.</p>

                    <div id="register-errors" class="mb-3"></div>

                    <form id="edit-dog-form">
                        <div class="mb-4">
                            <label class="form-label">Breed <strong class="text-danger">*</strong></label>
                            <input name="breed" type="text" class="form-control" placeholder="Enter breed" value="<?php echo $dog['breed']; ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Name <strong class="text-danger">*</strong></label>
                            <input name="name" type="text" class="form-control" placeholder="Enter name" value="<?php echo $dog['name']; ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description <strong class="text-danger">*</strong></label>
                            <textarea class="form-control" name="description" placeholder="Enter description" id="floatingTextarea2" style="height: 100px"><?php echo $dog['description']; ?></textarea>
                        </div>

                        <input type="hidden" name="dogID" value="<?php echo $dog['id']; ?>">

                        <div class="mb-4">
                            <label class="form-label">Upload Image</label> <br>
                            <input type="file" name="file">
                        </div>

                        <button name="register" type="submit" class="btn btn-secondary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- -------- REGISTRACIJA ---------- -->