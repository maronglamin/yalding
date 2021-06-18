<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$confirm = ((isset($_POST['confirm_password'])) ? sanitize($_POST['confirm_password']) : '');
$email = trim($email);
$password = trim($password);
$confirm = trim($confirm);
$errors = array();
?>
<body class="login-img3-body">
<div class="container">
  <form class="login-form" action="#" method="post">
    <div class="login-wrap">
      <p class="login-img"><i class="icon_lock_alt"></i></p>
      <div>
    <?php
    if ($_POST) {

        $emailQuery = $db->query("SELECT * FROM `stud_adm_info` WHERE `email` = '$email'");
        $emailCount = mysqli_num_rows($emailQuery);


        if ($emailCount != 0) {
            $errors[] = 'That email exist in our database';
        }

        $required = array('email', 'password', 'confirm_password');
        foreach ($required as $fields) {
            if ($_POST[$fields] == '') {
                $errors[] = 'You must fill out all fields marked with star(*).';
                break;
            }
        }
        if (strlen($password) < 6) {
            $errors[] = 'The password must be at least 6 characters.';
        }
        if ($password != $confirm) {
            $errors[] = 'Your password does not match the confirmation';
        }
        if (!empty($errors)) {
            echo display_errors($errors);
        } else {
            // add user
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO `stud_adm_info` (`email`,`password`) VALUES('$email','$hashed')";
            $db->query($insert);
            $_SESSION['success_mesg'] = 'Registration successful.';
            header('Location: ../index.php');
        }
    }
    ?>
</div>
        <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name="confirm_password" class="form-control" required placeholder="Confirm Password">
            </div>
            <input class="btn btn-info btn-lg btn-block" value="Register" type="submit"><br>
            <p>Already have an account? <a href="../index.php">Login</a></p>
            </div>
        </form>
        </div>