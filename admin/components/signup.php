<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';
$name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$confirm = ((isset($_POST['confirm_password'])) ? sanitize($_POST['confirm_password']) : '');
$email = trim($email);
$password = trim($password);
$confirm = trim($confirm);
$errors = array();
?>
<body class="login-img-teach-body">
<div class="container">
  <form class="login-form" action="#" method="post">
    <div class="login-wrap">
    <div>
    <?php
    if ($_POST) {

        $emailQuery = $db->query("SELECT * FROM administrators WHERE email = '$email'");
        $emailCount = mysqli_num_rows($emailQuery);


        if ($emailCount != 0) {
            $errors[] = 'That email exist in our database';
        }

        $required = array('name', 'email', 'password', 'confirm_password');
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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'You must enter a valid email address';
        }
        if (!empty($errors)) {
            echo display_errors($errors);
        } else {
            // add user
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO administrators (`full_name`,`email`,`password`) VALUES('$name','$email','$hashed')";
            $db->query($insert);
            $_SESSION['success_mesg'] = 'Registration successful.';
            header('Location: ../index.php');
        }
    }
    ?>
</div>
    <div class="input-group">
        <span class="input-group-addon"><i class="icon_profile"></i></span>
        <input type="text" class="form-control" name="name" placeholder="Full name" autofocus>
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_profile"></i></span>
        <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
        <input type="password" name="password" class="form-control" required placeholder="Password">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
        <input type="password" name="confirm_password" class="form-control" required placeholder="ConfirmPassword">
      </div>
      <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button><br>
      Already have an ACCOUNT?<a href="../index.php"> Sign in</a>
    </div>
  </form>
</div>