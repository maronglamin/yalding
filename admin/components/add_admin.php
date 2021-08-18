<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

$errors = [];
$name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$password = password_hash('adminpassword', PASSWORD_DEFAULT);

$emailQuery = $db->query("SELECT * FROM administrators WHERE email = '{$email}'");
$emailCount = mysqli_num_rows($emailQuery);


print page_name('Add Administrators of the system');

$divAttrs = ['class' => 'col-lg-10 col-sm-offset-1'];
print htmlCardHead($divAttrs, 'Admin information'); ?>

<form class="form-horizontal" action="add_admin.php" method="post">
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($emailCount != 0) {
            $errors[] = 'That email exist in your database';
        }
        if (!empty($errors)) {
            echo display_errors($errors);
        } else {
            $db->query("INSERT INTO `administrators`(`full_name`, `email`, `password`) VALUES ('{$name}','{$email}','{$password}')");
            $_SESSION['success_mesg'] .= 'save! Added successfully';
        }
    } ?>
    <?= inputBlock('text', 'Admin full Name *', 'name', '', ['class' => 'form-control', 'placeholder' => 'Enter the Name of the subject'], ['class' => 'form-group'], [], ''); ?>
    <?= inputBlock('text', 'Email Address *', 'email', '', ['class' => 'form-control', 'placeholder' => 'Enter the Name of the subject'], ['class' => 'form-group'], [], ''); ?>
    <?= submitBlock('Submit', ['class' => "btn btn-primary"], [], 'dashboard.php') ?>
</form>

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
