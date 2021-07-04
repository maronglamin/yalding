<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "lesson planning");
}

include(ROOT . DS . "core" . DS . "teacher_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "teacher_res" . DS . "aside.php");

# define variable for post data values
$general_obj = ((isset($_POST['general'])) ? sanitize($_POST['general']) : '');
$specific_obj = ((isset($_POST['specific'])) ? sanitize($_POST['specific']) : '');
$procedure = ((isset($_POST['procedure'])) ? sanitize($_POST['procedure']) : '');
$activities = ((isset($_POST['activities'])) ? sanitize($_POST['activities']) : '');
$reference = ((isset($_POST['reference'])) ? sanitize($_POST['reference']) : '');
$summary = ((isset($_POST['summary'])) ? sanitize($_POST['summary']) : '');
$evaluation = ((isset($_POST['evaluation'])) ? sanitize($_POST['evaluation']) : '');


# define an empty array to hold errrors
$errors = [];

# get the current user's id
$staff_id = $user_data['id'];

// the page title
print page_name('Full content');

$divAttrs = ['class' => 'col-lg-10 col-sm-offset-1']; ?>

<?= htmlCardHead($divAttrs, 'Lesson planning worksheets'); ?>
<form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $dataValue = [
            'staff_id'              => $staff_id,
            'general-objective'     => $general_obj,
            'specific-objective'    => $specific_obj,
            'procedure'             => $procedure,
            'activities'            => $activities,
            'reference'             => $reference,
            'summary'               => $summary,
            'evaluation'            => $evaluation
        ];


        $jSonDataValue = json_encode($dataValue);
        $db->query("UPDATE `lesson_plan` SET `second_record`='{$jSonDataValue}' WHERE `staff_id` = '{$staff_id}'");
        $_SESSION['success_mesg'] .= 'Changes saved! lesson planned and the office will audit it on permission';
        redirect('dashboard.php');
    }
    ?>
    <?= text_area('General Objectives*', 'general', ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], [], 'the general objective') ?>
    <?= text_area('Specific Objectives *', 'specific', ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], [], '') ?>
    <?= text_area('Procedure*', 'procedure', ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], [], '', '') ?>
    <?= text_area('Activities*', 'activities', ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], [], '') ?>
    <?= text_area('Reference*', 'reference', ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], [], '') ?>
    <?= text_area('Summary*', 'summary', ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], [], '') ?>
    <?= text_area('Evaluation*', 'evaluation', ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], [], '') ?>
    <?= submitBlock('Next', [], [], 'plans.php') ?>
</form>
<?= cardClose() ?>

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
