<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';
$id = $user_data['stud_id'];
$errors = [];

// store user's inputs values in a variable when post is happening.
$fname = ((isset($_POST['fname'])) ? sanitize($_POST['fname']) : '');
$lname = ((isset($_POST['lname'])) ? sanitize($_POST['lname']) : '');
$gender = ((isset($_POST['gender'])) ? sanitize($_POST['gender']) : '');
$dateOfBirth = ((isset($_POST['dateOfBirth'])) ? sanitize($_POST['dateOfBirth']) : '');
$placeOfBirth = ((isset($_POST['placeOfBirth'])) ? sanitize($_POST['placeOfBirth']) : '');
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
            $required = array('fname', 'lname', 'gender','dateOfBirth','placeOfBirth');
            foreach ($required as $fields)
             {
                if ($_POST[$fields] == '')
                 {
                    $errors[] = 'You must fill out all fields marked with star(*).';
                    break;
                 }
             }
             // display error if it occurs 
            if (!empty($errors)) 
            {
                echo display_errors($errors);
            } 
                else
                    {
                        // save first stage filling.
                        $db->query("UPDATE `stud_adm_info` SET `stud_fname` = '{$fname}', `stud_lname` = '{$lname}', `gender` = '{$gender}', `date_of_birth` = '{$dateBirth}', `stud_place_birth` = '{$placeOfBirth}' WHERE `stud_id` = '{$id}'");
                        $_SESSION['success_mesg'] .= 'save! Continue filling details';
                        redirect("admission/components/sec_stage.php");

                    }
        }
        ?>
        </div>
        <?=inputBlock('text', 'First Name*', 'fname', '', ['class'=>'form-control', 'placeholder' => 'Enter First Name'],['class'=>'form-group'],[display_errors($errors)],'');?>
        <?=inputBlock('text', 'Last Name*', 'lname', '', ['class'=>'form-control', 'placeholder' => 'Enter Last Name'],['class'=>'form-group'],[],'');?>
        <?=selectBlock("Gender*","gender",['1' => "Male", '2' => "Female"],['---SELECT GENDER---','Male', 'Female'],['class'=>'form-control', 'placeholder' => 'Enter First Name'],['class'=>'form-group'],[],'')?>
        <?=inputBlock('date', 'Date of Birth*', 'dateOfBirth', '', ['class'=>'form-control', 'placeholder' => 'Choose your date of birth'],['class'=>'form-group'],[],'');?>
        <?=inputBlock('text', 'Place of Birth*', 'placeOfBirth', '', ['class'=>'form-control', 'placeholder' => 'Enter place of birth'],['class'=>'form-group'],[],'');?>
        <?=submitBlock('Submit',['class' => "btn btn-primary"],[], '#')?>
