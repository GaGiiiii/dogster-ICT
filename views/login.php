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
                    <h1 class="mb-1">Login</h1>
                    <p class="mb-4">Fields marked with <strong class="text-danger">*</strong> are required.</p>

                    <div id="login-errors" class="mb-3"></div>

                    <form id="login-form">
                        <div class="mb-4">
                            <label class="form-label">Username/Email <strong class="text-danger">*</strong></label>
                            <input name="usernameOrEmail" type="text" class="form-control" placeholder="Enter Username or email" value="<?php echo $username ?? ""; ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password <strong class="text-danger">*</strong></label>
                            <input name="password" type="password" class="form-control" placeholder="Enter password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>

                        <div class="text-center">
                            <div class="mt-3 mb-1">OR</div>
                        </div>

                        <div class="text-center mt-0">
                            You don't have an account, go to <a href="<?php echo BASE_URL ?>?page=register">register</a> page.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- -------- REGISTRACIJA ---------- -->