<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

$subject = ((isset($_POST['subj'])) ? sanitize($_POST['subj']) : '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db->query("INSERT INTO `subject_junior`(`subj_name`) VALUES ('{$subject}')");
    $_SESSION['success_mesg'] .= 'save! subject added successfully';
    redirect("subject_list.php");
}


print page_name('Add Subject taken in the school');

$divAttrs = ['class' => 'col-lg-10 col-sm-offset-1'];
print htmlCardHead($divAttrs, 'Add subjects'); ?>

<form class="form-horizontal" action="add_subj.php" method="post">
    <?= inputBlock('text', 'Subject Name*', 'subj', '', ['class' => 'form-control', 'placeholder' => 'Enter the Name of the subject'], ['class' => 'form-group'], [], ''); ?>
    <?= submitBlock('Submit', ['class' => "btn btn-primary"], [], 'dashboard.php') ?>
</form>

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
