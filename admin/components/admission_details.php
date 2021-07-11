<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");
print page_name('All information submitted during admission');

// request to update the student as been enrolled
if (isset($_GET['enroll'])) {
    $id = (int)sanitize($_GET['enroll']);
    $db->query("UPDATE `stud_adm_info` SET `enrolled` = '1' WHERE `stud_id` = '{$id}'");
    redirect('admission_details.php?stud_id=' . $id);
}
if (isset($_GET['unenroll'])) {
    $id = (int)sanitize($_GET['unenroll']);
    $db->query("UPDATE `stud_adm_info` SET `enrolled` = '0' WHERE `stud_id` = '{$id}'");
    redirect('admission_details.php?stud_id=' . $id);
}
?>

<div class="col-lg-8 col-sm-offset-2">
    <section class="panel">
        <div class="panel-body progress-panel">
            <div class="row">
                <div class="col-lg-8 task-progress pull-left">
                    <h1>Review information</h1>
                </div>
            </div>
        </div>
        <table class="table table-hover personal-task"><br><br>
            <tbody>
                <?php while ($info = mysqli_fetch_assoc($get_stud_adm_data_id)) : ?>
                    <div class="col-lg-12">
                        <div class="text-center profile-ava"><img class="simple wid" src="<?= PROOT . 'admission' . $info['path']; ?>" alt="image not found">
                            <p>The student's passport photo</p>
                            <?php if ($info['enrolled'] == '1') : ?>
                                <button class="btn btn-success pull-right">Enrolled</button>
                                <a href="admission_details.php?unenroll=<?= $info['stud_id']; ?>" class="btn btn-danger pull-right">Unenroll</a>

                            <?php else : ?>
                                <a href="admission_details.php?enroll=<?= $info['stud_id']; ?>" class="btn btn-primary pull-right">Enroll</a>
                            <?php endif; ?>
                        </div>
                    </div><br>
                    <tr>
                        <td>First Name</td>
                        <td><strong><?= $info['stud_fname']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><strong><?= $info['stud_lname']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><strong><?= $info['email']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>The gender or sex of the stuent</td>
                        <td><strong><?= ($info['gender'] == 1) ? "Male" : "Female"; ?></strong></td>
                    </tr>
                    <tr>
                        <td>The telephone or mobile number (either the parent or the student)</td>
                        <td><strong><?= '+220 ' . $info['tele']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>The parent or Guidian's Names</td>
                        <td><strong><?= $info['stud_parent_name']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>The address of the student</td>
                        <td><strong><?= $info['address']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>The enthenicity the student (optioanl)</td>
                        <td><strong><?= ($info['eth'] == '') ? "The student intend to fill it" : $info['eth']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>The date of birth</td>
                        <td><strong><?= $info['date_of_birth']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Place of birth</td>
                        <td><strong><?= $info['stud_place_birth']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>The lasted attended school</td>
                        <td><strong><?= $info['pschool']; ?></strong></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</div>
<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
