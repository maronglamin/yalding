<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

$permitted_admins = $db->query("SELECT * FROM `administrators` WHERE `permission` = 1");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db->query("INSERT INTO `administrators`(`full_name`, `email`, `password`) VALUES ('{$name}','{$email}','{$password}')");
    $_SESSION['success_mesg'] .= 'save! Added successfully';
    redirect("admin_list.php");
}

print page_name('Permtted Administrators to the system'); ?>



<div class="col-lg-8 col-sm-offset-2">
    <!--Project Activity start-->
    <section class="panel">
        <div class="panel-body progress-panel">
            <div class="row">
                <div class="col-lg-8 task-progress pull-left">
                    <h1>ACTIVE ADMINISTRATORS</h1>
                </div>
            </div>
        </div>
        <table class="table table-hover personal-task">
            <thead>
                <th>Subject Name</th>
                <th>Email Address</th>
                <th>Action</th>
            </thead>
            <?php while ($p_admin = mysqli_fetch_assoc($permitted_admins)) : ?>
                <tr>
                    <td><?= $p_admin['full_name']; ?></td>
                    <td><?= $p_admin['email']; ?></td>
                    <td>
                        <a href="admin_list.php?permit=<?= $subject['adm_no'] ?>" class="btn btn-primary">Permit</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            <tbody>
        </table>
    </section>
</div>

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
