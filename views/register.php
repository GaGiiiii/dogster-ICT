<?php

if (isset($_SESSION['user'])) {
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
                    <h1 class="mb-1">Register</h1>
                    <p class="mb-4">Fields marked with <strong class="text-danger">*</strong> are required.</p>

                    <div id="register-errors" class="mb-3"></div>

                    <form id="register-form">
                        <div class="mb-4">
                            <label class="form-label">Username <strong class="text-danger">*</strong></label>
                            <input name="username" type="text" class="form-control" placeholder="Enter Username" value="<?php echo $username ?? ""; ?>">
                            <?php echo $errors['username'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Email <strong class="text-danger">*</strong></label>
                            <input name="email" type="email" class="form-control" placeholder="Enter email" value="<?php echo $email ?? ""; ?>">
                            <?php echo $errors['email'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password <strong class="text-danger">*</strong></label>
                            <input name="password" type="password" class="form-control" placeholder="Confirm password">
                            <?php echo $errors['password'] ?? ""; ?>
                            <?php echo $errors['password_confirm'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm password <strong class="text-danger">*</strong></label>
                            <input name="password2" type="password" class="form-control" placeholder="Potvrdite šifru">
                            <?php echo $errors['password2'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Birthday</label>
                            <input name="birthday" type="date" class="form-control" placeholder="Enter birthday" value="<?php echo $birthday ?? ""; ?>">
                            <?php echo $errors['birthday'] ?? ""; ?>
                        </div>

                        <button name="register" type="submit" class="btn btn-primary w-100">Register</button>

                        <div class="text-center">
                            <div class="mt-3 mb-1">OR</div>
                        </div>

                        <div class="text-center mt-0">
                            You already have account, go to <a href="<?php echo BASE_URL ?>?page=login">login</a> page.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- -------- REGISTRACIJA ---------- -->