<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';
$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$email = trim($email);
$password = trim($password);
$errors = array();
?>

<body class="login-img-teach-body">
<div class="container">
  <form class="login-form" action="#" method="post">
    <div class="login-wrap">
      <p class="login-img"><i class="icon_lock_alt"></i></p>
      <div>
        <!-- display error in this DOM element -->
        <?php 
          if ($_POST) {
            //checking password's length
            if (strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 character.';
            } 
            
            //check if the email exist in the database
            $query = $db->query("SELECT * FROM `administrators` WHERE `email` = '{$email}'");
            $user = mysqli_fetch_assoc($query);
            $userCount = mysqli_num_rows($query);

            if ($userCount < 1) {
                $errors[] = 'That record doesn\' t exist in our record';
            } 

            // check for correct password 
            if (!password_verify($password, $user['password'])) {
            $errors[] = 'The password does not match our records. please try again.';
            }
            
            // check if user is deleted 
            $delquery = $db->query("SELECT * FROM `administrators` WHERE `email` = '{$email}' AND `deleted` != 0");
            $counter = mysqli_num_rows($delquery);


            if ($counter == 1) {
                $errors[] = 'We have block your usage to the system, PLEASE contact us';
            }

            $permitQuery = $db->query("SELECT * FROM `administrators` WHERE `email` = '{$email}' AND `permission` = 0");
            $counterPermission = mysqli_num_rows($permitQuery);

            // check for permission  
            if ($counterPermission == 1) {
                $errors[] = 'You not permiited yet to login to the system. Please wait until you are permitted';
            }

            // display error if it occurs 
            if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                //log user in
                $user_id = $user['adm_no'];
                login_addmin($user_id);
            } 
          }
        ?>
      </div>
      <?php
        // echo inputBlock('email', 'Email', 'email', '', ['class'=>'form-control', 'placeholder' => 'Email'],['class'=>'input-group',]);
      ?>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_profile"></i></span>
        <input type="email" class="form-control" name="email" placeholder="Email" autofocus>
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
        <input type="password" name="password" class="form-control" required placeholder="Password">
      </div>
      <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button><br>
      Don't have an ACCOUNT?<a href="components/signup.php"> Signup</a>
    </div>
  </form>
</div>
<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");