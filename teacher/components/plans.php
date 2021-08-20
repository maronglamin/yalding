<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "lesson planning");
}

include(ROOT . DS . "core" . DS . "teacher_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "teacher_res" . DS . "aside.php");

# define an empty array to hold errrors
$errors = [];

# define variable for post data values
$subject = ((isset($_POST['subj'])) ? sanitize($_POST['subj']) : '');
$class = ((isset($_POST['class'])) ? sanitize($_POST['class']) : '');
$date = ((isset($_POST['date'])) ? sanitize($_POST['date']) : '');
$start_time = ((isset($_POST['start-time'])) ? sanitize($_POST['start-time']) : '');
$end_time = ((isset($_POST['end-time'])) ? sanitize($_POST['end-time']) : '');
$period = ((isset($_POST['period'])) ? sanitize($_POST['period']) : '');
$unit_topic = ((isset($_POST['unit-topic'])) ? sanitize($_POST['unit-topic']) : '');
$specific_topic = ((isset($_POST['specific-topic'])) ? sanitize($_POST['specific-topic']) : '');

# get the current user's id
$staff_id = $user_data['id'];



// the page title
print page_name('get started with planing lessons');

$divAttrs = ['class' => 'col-lg-10 col-sm-offset-1']; ?>

<?= htmlCardHead($divAttrs, 'Lesson planning worksheets'); ?>
<form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $required = array('subj', 'class', 'date', 'start-time', 'end-time', 'period', 'unit-topic', 'specific-topic');
        foreach ($required as $fields) {
            if ($_POST[$fields] == '') {
                $errors[] = 'You must fill out all fields marked with star(*).';
                break;
            }
        }
        if (!empty($errors)) {
            echo display_errors($errors);
        } else {

            # wrap the entire data into one bundle of data using the json format
            $dataValue = [
                'staff'         => $staff_id,
                'subject'       => $subject,
                'start-time'    => $start_time,
                'end-time'      => $end_time,
                'period'        => $period,
                'unit-topic'    => $unit_topic,
                'specific-topic' => $specific_topic
            ];

            $jSonDataValue = json_encode($dataValue);
            $db->query("INSERT INTO `lesson_plan`(`staff_id`, `class_id`, `first_record`,`planed_date`) VALUES ('{$staff_id}','{$class}','{$jSonDataValue}','{$date}')");
            $_SESSION['success_mesg'] .= 'First stage saved! contiune planning your lesson';
            redirect('dashboard.php');
        }
    }
    ?>
    <?= inputBlock('text', 'Subject *', 'subj', '', ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], [], ''); ?>
    <?= selectBlock('Class', 'class', ['', '1', '2', '3', '4', '5', '6'], ['', 'Grade 7 cirle', 'Grade 7 Square', 'Grade 8 circle', 'Grade 9 circle', 'Grade 9 square'], ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], []); ?>
    <?= inputBlock('date', 'Date *', 'date', '', ['class' => 'form-control'], ['class' => 'form-group'], [], ''); ?>
    <?= inputBlock('time', 'Start Time *', 'start-time', '', ['class' => 'form-control'], ['class' => 'form-group'], [], ''); ?>
    <?= inputBlock('time', 'End Time *', 'end-time', '', ['class' => 'form-control'], ['class' => 'form-group'], [], ''); ?>
    <?= inputBlock('number', 'Period *', 'period', '', ['class' => 'form-control', 'placeholder' => 'Enter the number of the period', 'min' => '0', 'max' => '15'], ['class' => 'form-group'], [], ''); ?>
    <?= inputBlock('text', 'Unit Topic *', 'unit-topic', '', ['class' => 'form-control', 'placeholder' => 'Write the unit topic of the to be planned subject'], ['class' => 'form-group'], [], ''); ?>
    <?= inputBlock('text', 'Specific Topic *', 'specific-topic', '', ['class' => 'form-control', 'placeholder' => 'Write the specific topic'], ['class' => 'form-group'], [], ''); ?>
    <?= submitBlock('Next', [], [], 'dashboard.php') ?>
</form>
<?= cardClose() ?>

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
