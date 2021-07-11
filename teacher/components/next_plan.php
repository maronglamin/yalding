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

if (isset($_GET['add'])) {

    $tbl_id = (int)sanitize($_GET['add']);

    // the page title
    print page_name('Full content');

    $divAttrs = ['class' => 'col-lg-10 col-sm-offset-1']; ?>

    <?= htmlCardHead($divAttrs, 'Lesson planning worksheets'); ?>
    <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // insert into a different location
            $db->query("UPDATE `lesson_plan` SET `general_objective`='{$general_obj}',`specific_objective`='{$specific_obj}',`procedures`='{$procedure}',`activities`='{$activities}',`summary`='{$summary}',`evaluation`='{$evaluation}' WHERE `id` = '{$tbl_id}'");
            $_SESSION['success_mesg'] .= 'Changes saved! lesson planned and the office will audit it on permission';
            redirect('dashboard.php?plan=' . $tbl_id);
        }
        ?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="general">General Objectives*</label>
            <div class="col-sm-10">
                <textarea id="general" name="general" class="form-control ckeditor" required rows="6" class="form-control" placeholder="Write the name of the subject for planning'], ['class' => 'form-group'], [], 'the general objective"></textarea>
                <span class="help-block">The objectives</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="specific">Specific Objectives *</label>
            <div class="col-sm-10">
                <textarea id="specific" name="specific" class="form-control ckeditor" required rows="6" class="form-control" placeholder="Write the name of the subject for planning'], ['class' => 'form-group'], [], 'the general objective"></textarea>
                <span class="help-block">The objectives</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="procedure">Procedure*</label>
            <div class="col-sm-10">
                <textarea id="procedure" name="procedure" class="form-control ckeditor" required rows="6" class="form-control" placeholder="Write the name of the subject for planning'], ['class' => 'form-group'], [], 'the general objective"></textarea>
                <span class="help-block">The objectives</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="activities">Activities*</label>
            <div class="col-sm-10">
                <textarea id="activities" name="activities" class="form-control ckeditor" required rows="6" class="form-control" placeholder="Write the name of the subject for planning'], ['class' => 'form-group'], [], 'the general objective"></textarea>
                <span class="help-block">The objectives</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="reference">Reference*</label>
            <div class="col-sm-10">
                <textarea id="reference" name="reference" class="form-control ckeditor" required rows="6" class="form-control" placeholder="Write the name of the subject for planning'], ['class' => 'form-group'], [], 'the general objective"></textarea>
                <span class="help-block">The objectives</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="summary">Summary*</label>
            <div class="col-sm-10">
                <textarea id="summary" name="summary" class="form-control ckeditor" required rows="6" class="form-control" placeholder="Write the name of the subject for planning'], ['class' => 'form-group'], [], 'the general objective"></textarea>
                <span class="help-block">The objectives</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="evaluation">Evaluation*</label>
            <div class="col-sm-10">
                <textarea id="evaluation" name="evaluation" class="form-control ckeditor" required rows="6" class="form-control" placeholder="Write the name of the subject for planning'], ['class' => 'form-group'], [], 'the general objective"></textarea>
                <span class="help-block">The objectives</span>
            </div>
        </div>
        <?= submitBlock('Next', [], [], 'plans.php') ?>
    </form>
    <?= cardClose() ?>


<?php }
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
