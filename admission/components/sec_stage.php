<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Admission");
}
$errors = [];
$user_id = $user_data['stud_id'];

$tele = ((isset($_POST['tele'])) ? sanitize($_POST['tele']) : '');
$pname = ((isset($_POST['pname'])) ? sanitize($_POST['pname']) : '');
$address = ((isset($_POST['address'])) ? sanitize($_POST['address']) : '');
$ethen = ((isset($_POST['ethen'])) ? sanitize($_POST['ethen']) : '');
$pschool = ((isset($_POST['pschool'])) ? sanitize($_POST['pschool']) : '');
?>
<section class="wrapper">
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?=PROOT?>index.php">Home</a></li>
            <li><i class="fa fa-desktop"></i>Student personal information</li>
        </ol>
    <h3 class="page-header"><i class="fa fa-file-text-o"></i> enrollment information</h3>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
    <section class="panel">
        <header class="panel-heading">Student Admission Process</header>
        <div class="panel-body">
        <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
        <div id="errormessage">
        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
         {
            // display error if it occurs 
            if (!empty($errors)) 
            {
                echo display_errors($errors);
            } 
                else
                    {
                        //save data from applicant
                        $db->query("UPDATE `stud_adm_info` SET `tele` = '{$tele}', `stud_parent_name` = '{$pname}', `address` = '{$address}', `eth` = '{$ethen}', `pschool` = '{$pschool}' WHERE `stud_id` = '{$user_id}'");
                        $_SESSION['success_mesg'] .= 'Details stored Successful';
                        redirect("admission/components/form-sinfo.php");
                    }
         }
         ?>
        </div>
        <?=inputBlock('tel', 'Mobile*', 'tele', '', ['class'=>'form-control', 'placeholder' => 'Enter Active contact number'],['class'=>'form-group'],[],'');?>
        <?=inputBlock('text', 'Parent*', 'pname', '', ['class'=>'form-control', 'placeholder' => 'Parent or guiden\'s name'],['class'=>'form-group'],[],'');?>
        <?=inputBlock('text', 'Address*', 'address', '', ['class'=>'form-control', 'placeholder' => 'Enter the address of the student'],['class'=>'form-group'],[],'');?>
        <?=inputBlock('text', 'Ethenicity', 'ethen', '', ['class'=>'form-control', 'placeholder' => 'The ethenicity the student'],['class'=>'form-group'],[],'You can optionality leave it blank if you wise to.');?>
        <?=inputBlock('text', 'Previous School*', 'pschool', '', ['class'=>'form-control', 'placeholder' => 'Clearly state the name of your previous school.'],['class'=>'form-group'],[],'This enable to know school you were enrolled');?>
        <?=submitBlock('Submit',['class' => "btn btn-primary"],[], '#')?>
        <a href="fstage.php" class="pull-right btn btn-default">Back</a>
