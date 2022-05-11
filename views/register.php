<?php

// if (Database::getInstance()->isUserLoggedIn()) {
//     $_SESSION['unauthorized_access'] = '<div class="container-fluid">
//     <div class="row">
//       <div class="col-md-10 col-sm-10 offset-sm-1 offset-md-1 p-0 mt-5">
//         <div class="alert alert-danger alert-dismissible show" role="alert">
//           <strong>Danger!</strong> Access denied! <i class="fas fa-exclamation-triangle"></i>
//           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//         </div>
//       </div>
//     </div>
//   </div>';
//     header("Location: pocetna");

//     exit;
// }

// if (isset($_POST['register'])) {
//     $email = clean($_POST['email']);
//     $password = clean($_POST['password']);
//     $password2 = clean($_POST['password2']);
//     $firstname = clean($_POST['firstname']);
//     $lastname = clean($_POST['lastname']);
//     $phone_number = clean($_POST['phone_number']);
//     $grade = clean($_POST['grade']);
//     $slazemSe = $_POST['slazem_se'] ?? 0;

//     $errors = array();

//     if (empty($email)) {
//         $errors['email'] = '<div class="mb-0 invalid-feedback">Please enter email.</div>';
//     } else {
//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $errors['email'] = '<div class="mb-0 invalid-feedback">Wrong email format.</div>';
//         }
//     }

//     if (empty($password)) {
//         $errors['password'] = '<div class="mb-0 invalid-feedback">Please enter password šifru.</div>';
//     } else {
//         if ($password != $password2) {
//             $errors['password_confirm'] = '<div class="mb-0 invalid-feedback">Passwords do not match.</div>';
//         } else {
//             if (empty($password2)) {
//                 $errors['password2'] = '<div class="mb-0 invalid-feedback">Please confirm password.</div>';
//             }
//         }
//     }

//     if (empty($firstname)) {
//         $errors['firstname'] = '<div class="mb-0 invalid-feedback">Please enter firstname.</div>';
//     } else {
//         if (!isLettersOnly($firstname)) {
//             $errors['firstname'] = '<div class="mb-0 invalid-feedback">Only letters allowed.</div>';
//         }
//     }

//     if (empty($lastname)) {
//         $errors['lastname'] = '<div class="mb-0 invalid-feedback">Please enter lastname.</div>';
//     } else {
//         if (!isLettersOnly($lastname)) {
//             $errors['lastname'] = '<div class="mb-0 invalid-feedback">Only letters allowed.</div>';
//         }
//     }

//     if ($slazemSe === 0) {
//         $errors['slazem_se'] = '<div class="mb-0 invalid-feedback">Niste prihvatili uslove korišćenja.</div>';
//     }

//     if (count($errors) == 0) {
//         $data = array(
//             "email" => $email,
//             "password" => $password,
//             "firstname" => $firstname,
//             "lastname" => $lastname,
//             "phone_number" => $phone_number,
//             "grade" => $grade,
//         );

//         if (Database::getInstance()->takenEmail($email)) {
//             $errors['taken_email'] = '<div class="alert alert-danger alert-dismissible show" role="alert">
//       <strong>Greška!</strong> Email is taken.
//       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//     </div>';
//         } else if (Database::getInstance()->registerUser($data)) {
//             $_SESSION['register_success_message'] = '<div class="container-fluid">
//         <div class="row">
//           <div class="col-md-10 col-sm-10 offset-sm-1 offset-md-1 p-0 mt-5">
//             <div class="alert alert-warning alert-dismissible show" role="alert" style="margin-bottom: 4rem;">
//               <strong>Registration successful! <i class="fas fa-check"></i></strong> Welcome ' . $_SESSION['user']['user.username'] .
//                 '. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//             </div>
//           </div>
//         </div>
//       </div>';

//             header("Location: " . BASE_URL . "kursevi");

//             exit;
//         }
//     }
// }
?>

<!-- -------- REGISTRACIJA ---------- -->
<section class="mt-4 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10 col-10 g-0">
                <div class="login-form-container">
                    <h1 class="mb-1">Register</h1>
                    <p class="mb-4">Fields marked with <strong class="text-danger">*</strong> are required.</p>

                    <?php echo $errors['taken_email'] ?? ""; ?>

                    <form id="register-form">
                        <div class="mb-4">
                            <label class="form-label">Username <strong class="text-danger">*</strong></label>
                            <input name="username" type="text" class="form-control <?php if (isset($errors['username'])) echo 'is-invalid';
                                                                                    else if (isset($username)) echo 'is-valid'; ?>" placeholder="Enter Username" value="<?php echo $username ?? ""; ?>">
                            <?php echo $errors['username'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Email <strong class="text-danger">*</strong></label>
                            <input name="email" type="email" class="form-control <?php if (isset($errors['email']) || isset($errors['taken_email'])) echo 'is-invalid';
                                                                                    else if (isset($email)) echo 'is-valid'; ?>" placeholder="Enter email" value="<?php echo $email ?? ""; ?>">
                            <?php echo $errors['email'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password <strong class="text-danger">*</strong></label>
                            <input name="password" type="password" class="form-control <?php if (isset($errors['password']) || isset($errors['password_confirm'])) echo 'is-invalid'; ?>" placeholder="Confirm password">
                            <?php echo $errors['password'] ?? ""; ?>
                            <?php echo $errors['password_confirm'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm password <strong class="text-danger">*</strong></label>
                            <input name="password2" type="password" class="form-control <?php if (isset($errors['password2'])) echo 'is-invalid'; ?>" placeholder="Potvrdite šifru">
                            <?php echo $errors['password2'] ?? ""; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Birthday</label>
                            <input name="birthday" type="date" class="form-control <?php if (isset($errors['birthday'])) echo 'is-invalid';
                                                                                    else if (isset($birthday)) echo 'is-valid'; ?>" placeholder="Enter birthday" value="<?php echo $birthday ?? ""; ?>">
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