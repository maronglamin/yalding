<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "teacher_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "teacher_res" . DS . "aside.php");

if (isset($_GET['add']) && $_GET['subj']) {
    $stud_id = (int)sanitize($_GET['add']);
    $class_id = (int)sanitize($_GET['class']);
    $subj_id = (int)sanitize($_GET['subj']);


    $test1 = ((isset($_POST['f_test'])) ? sanitize($_POST['f_test']) : '');
    $test2 = ((isset($_POST['s_test'])) ? sanitize($_POST['f_test']) : '');
    $exam = ((isset($_POST['exam'])) ? sanitize($_POST['exam']) : '');

    print page_name('Add grades');

?>


    <div class="col-lg-8 col-sm-offset-2">
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>Add Grades</h1>
                    </div>
                </div>
            </div>
            <div><br>
                <form class="form-horizontal" action="#" method="post">
                    <?php
                    if ($_POST) {
                        $db->query("INSERT INTO `stud_reports`(`stud_no`, `stud_class`, `subj`, `test1`, `test2`, `exam`) VALUES ('{$stud_id}','{$class_id}','{$subj_id}', '{$test1}','{$test2}', '{$exam}')");
                        redirect('my_class.php?class=' . $class_id . '&subj=' . $subj_id);
                    }
                    ?>
                    <?= inputBlock('number', 'First test *', 'f_test', '', ['class' => 'form-control', 'placeholder' => 'Enter the first score', 'min' => '0', 'max' => '25'], ['class' => 'form-group'], [], ''); ?>
                    <?= inputBlock('number', 'Second test *', 's_test', '', ['class' => 'form-control', 'placeholder' => 'Enter the second test score', 'min' => '0', 'max' => '25'], ['class' => 'form-group'], [], ''); ?>
                    <?= inputBlock('number', 'Exams*', 'exam', '', ['class' => 'form-control', 'placeholder' => 'Enter the exam score', 'min' => '0', 'max' => '50'], ['class' => 'form-group'], [], ''); ?>
                    <?= submitBlock('Submit', ['class' => "btn btn-primary"], [], 'my_class.php?class=' . $class_id . '&subj=' . $subj_id) ?>
                </form>
            </div>
        </section>
    </div>
<?php } else if (isset($_GET['edit']) && $_GET['subj']) {

    $stud_id = (int)sanitize($_GET['edit']);
    $class_id = (int)sanitize($_GET['class']);
    $subj_id = (int)sanitize($_GET['subj']);


    $test1 = ((isset($_POST['f_test'])) ? sanitize($_POST['f_test']) : '');
    $test2 = ((isset($_POST['s_test'])) ? sanitize($_POST['f_test']) : '');
    $exam = ((isset($_POST['exam'])) ? sanitize($_POST['exam']) : '');

    print page_name('Edit Grades');

    $getGrade = $db->query("SELECT * FROM `stud_reports` WHERE `stud_class` = '{$class_id}' AND `stud_no` = '{$stud_id}' AND `subj` = '{$subj_id}'");
    $grades = mysqli_fetch_assoc($getGrade);

?>


    <div class="col-lg-8 col-sm-offset-2">
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>Edit Grades</h1>
                    </div>
                </div>
            </div>
            <div><br>
                <form class="form-horizontal" action="#" method="post">
                    <?php
                    if ($_POST) {
                        $db->query("UPDATE `stud_reports` SET `test1` = '{$test1}', `test2` = '{$test2}', `exam` = '{$exam}' WHERE `stud_class` = '{$class_id}' AND `stud_no` = '{$stud_id}' AND `subj` = '{$subj_id}'");
                        redirect('my_class.php?class=' . $class_id . '&subj=' . $subj_id);
                    }
                    ?>
                    <?= inputBlock('number', 'First test *', 'f_test', $grades['test1'], ['class' => 'form-control', 'placeholder' => 'Enter the first score', 'min' => '0', 'max' => '25'], ['class' => 'form-group'], [], ''); ?>
                    <?= inputBlock('number', 'Second test *', 's_test', $grades['test2'], ['class' => 'form-control', 'placeholder' => 'Enter the second test score', 'min' => '0', 'max' => '25'], ['class' => 'form-group'], [], ''); ?>
                    <?= inputBlock('number', 'Exams*', 'exam', $grades['exam'], ['class' => 'form-control', 'placeholder' => 'Enter the exam score', 'min' => '0', 'max' => '50'], ['class' => 'form-group'], [], ''); ?>
                    <?= submitBlock('Submit', ['class' => "btn btn-primary"], [], 'my_class.php?class=' . $class_id . '&subj=' . $subj_id) ?>
                </form>
            </div>
        </section>
    </div>
<?php }
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
