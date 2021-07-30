<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

$subj = $db->query("SELECT * FROM `subject_junior`");

if(isset($_GET['del'])) {
    $id = (int)sanitize($_GET['del']);
    $db->query("DELETE FROM `subject_junior` WHERE `subj_no` = '{$id}'");
    $_SESSION['success_mesg'] .= 'Deleted successfully.';
    redirect("subject_list.php");

}

print page_name('Subject taken in the school'); ?>

<div class="col-lg-8 col-sm-offset-2">
    <!--Project Activity start-->
    <section class="panel">
        <div class="panel-body progress-panel">
            <div class="row">
                <div class="col-lg-8 task-progress pull-left">
                    <h1>TEACHING MATERIALS</h1>
                </div>
                <div class="col-lg-4">
                    <span class="profile-ava pull-right">
                        <img alt="" class="simple" src="<?= PROOT ?>img/avatar1_small.jpg">
                        <?= $user_data['first']; ?>
                    </span>
                </div>
            </div>
        </div>
        <table class="table table-hover personal-task">
            <thead>
                <th>Subject Name</th>
                <th>Action</th>
            </thead>
            <?php while ($subject = mysqli_fetch_assoc($subj)) : ?>
                <tr>
                    <td><?= $subject['subj_name']; ?></td>
                    <td>
                        <a href="subject_list.php?del=<?= $subject['subj_no'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            <tbody>
        </table>
    </section>
    <!--Project Activity end-->
</div>

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
