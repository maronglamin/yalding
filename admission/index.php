<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';
$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$email = trim($email);
$password = trim($password);
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
            //checking password's length
            if (strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 character.';
            } 
            
            //check if the email exist in the database
            $query = $db->query("SELECT * FROM `stud_adm_info` WHERE `email` = '{$email}'");
            $user = mysqli_fetch_assoc($query);

            $que = $db->query("SELECT * FROM `stud_adm_info` WHERE `email` = '{$email}'");
            $userCount = mysqli_num_rows($que);

            if ($userCount < 0) {
                $errors[] = 'That record doesn\' t exist in our record';
            } 

            // check for correct password 
            if (!password_verify($password, $user['password'])) {
            $errors[] = 'The password does not match our records. please try again.';
            }

            // display error if it occurs 
            if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                //log user in
                $user_id = $user['stud_id'];
                login_stud($user_id);
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
      <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
      <a href="components/sign.php" class="btn btn-info btn-lg btn-block" type="submit">Signup</a>
    </div>
  </form>
</div>
<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");