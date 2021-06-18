<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

$id = $user_data['stud_id'];
$sql = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id` = '{$id}'");
$result = mysqli_fetch_assoc($sql);
// check if the user is logged in before accessing the page
if (!is_logged_in()) {
  login_error_redirect("../index.php", "Admission");
}
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
        <div class="row">
        <div class="col-lg-4">
        <img src="<?=PROOT?>img/profile-avat.jpg" alt="User's photo to diplay here ---profile">
        <div class="text-right"><br>
            <a href="fstage.php" class="btn btn-primary">Start</a>
        </div>
        </div>
        <div class="col-lg-8">
            <section class="panel">
              <header class="panel-heading">
                Registered Information
              </header>
              <div class="list-group">
                
                <a class="list-group-item active" href="javascript:;">
                  <h4 class="list-group-item-heading">Email:</h4>
                  <p class="list-group-item-text"><?=$result['email']?></p>
                </a>
                <a class="list-group-item active" href="javascript:;">
                  <h4 class="list-group-item-heading">Information</h4>
                  <p class="list-group-item-text">We will collect information from you when you start admission proccess</p>
                </a>
                
              </div>
            </section>
          </div>
        </div>
    </section>
    </div>
</div>