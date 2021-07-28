<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

#Set the post variables
$class = (isset($_POST['class']) ? sanitize($_POST['class']) : '');
$subj = (isset($_POST['subject']) ? sanitize($_POST['subject']) : '');
$teach = (isset($_POST['teacher']) ? sanitize($_POST['teacher']) : '');

#process the request
if ($_POST) {
    $db->query("INSERT INTO `assig_subj_techer`(`stuff_no`, `subj_no`, `class_id`) VALUES ('{$teach}','{$subj}','{$class}')");
    $_SESSION['success_mesg'] .= 'The teacher is assgned!';
    redirect('teacher_list.php');
}

// queries
$subject = $db->query("SELECT * FROM `subject_junior`");
$classes = $db->query("SELECT * FROM `class_grade`");
$teacher = $db->query("SELECT * FROM `staff`");

print page_name('Assign teachers to a class');

$divAttrs = ['class' => 'col-lg-10 col-sm-offset-1'];
print htmlCardHead($divAttrs, 'Class List'); ?>
<form class="form-horizontal" action="teacher.php" method="post">
    <div>
        <div class="form-group">
            <label for="className" class="control-label col-lg-2">Class Names</label>
            <div class="col-sm-10"">
    <select id=" class" name="class" class="form-control" required>
                <option value="" <?= ((isset($_POST['class']) && $_POST['class'] == '') ? ' selected' : ''); ?>></option>
                <?php while ($class = mysqli_fetch_assoc($classes)) : ?>
                    <option value="<?= $class['class_id']; ?>" <?= ((isset($_POST['class']) && $_POST['class'] == $class['class_id']) ? ' selected' : ''); ?>><?= $class['grade_name']; ?></option>
                <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="subject" class="control-label col-lg-2">Subjects</label>
            <div class="col-sm-10"">
    <select id=" subject" name="subject" class="form-control" required>
                <option value="" <?= ((isset($_POST['subject']) && $_POST['subject'] == '') ? ' selected' : ''); ?>></option>
                <?php while ($subj = mysqli_fetch_assoc($subject)) : ?>
                    <option value="<?= $subj['subj_no']; ?>" <?= ((isset($_POST['subject']) && $_POST['subject'] == $subj['subj_no']) ? ' selected' : ''); ?>><?= $subj['subj_name']; ?></option>
                <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="staff" class="control-label col-lg-2">teacher</label>
            <div class="col-sm-10"">
                <select id=" teacher" name="teacher" class="form-control" required>
                <option value="" <?= ((isset($_POST['teacher']) && $_POST['teacher'] == '') ? ' selected' : ''); ?>></option>
                <?php while ($teach = mysqli_fetch_assoc($teacher)) : ?>
                    <option value="<?= $teach['id']; ?>" <?= ((isset($_POST['teacher']) && $_POST['teacher'] == $teach['id']) ? ' selected' : ''); ?>><?= $teach['full_name']; ?></option>
                <?php endwhile; ?>
                </select>
            </div>
        </div>
        <input type="submit" value="Assign" class="btn btn-primary">

    </div>
</form>
<?php print cardClose(); ?>



<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
