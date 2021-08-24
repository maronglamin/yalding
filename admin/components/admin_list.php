<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

$admins = $db->query("SELECT * FROM `administrators` WHERE `permission` = 0");


if (isset($_GET['permit'])) {
    $id = (int)sanitize($_GET['permit']);
    $db->query("UPDATE `administrators` SET `permission` = '1' WHERE `adm_no` = '{$id}'");
}

print page_name('Pending Administrators of the system'); ?>


<div class="col-lg-8 col-sm-offset-2">
    <!--Project Activity start-->
    <section class="panel">
        <div class="panel-body progress-panel">
            <div class="row">
                <div class="col-lg-8 task-progress pull-left">
                    <h1>PENDING ADMIN USER</h1>
                </div>
            </div>
        </div>
        <table class="table table-hover personal-task">
            <thead>
                <th>Subject Name</th>
                <th>Email Address</th>
                <th>Action</th>
            </thead>
            <?php while ($admin = mysqli_fetch_assoc($admins)) : ?>
                <tr>
                    <td><?= $admin['full_name']; ?></td>
                    <td><?= $admin['email']; ?></td>
                    <td>
                        <a href="admin_list.php?permit=<?= $admin['adm_no'] ?>" class="btn btn-primary">Permit</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            <tbody>
        </table>
    </section>
</div>

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
