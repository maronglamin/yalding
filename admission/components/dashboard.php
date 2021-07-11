<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';
include(ROOT . DS . 'admission' . DS . 'components' . DS . 'topnav.php');

$id = $user_data['stud_id'];
$sql = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id` = '{$id}'");
$result = mysqli_fetch_assoc($sql);

$get_stud_adm_data_id = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id` = '{$id}'");


// check if the user is logged in before accessing the page
if (!is_logged_in()) {
  login_error_redirect("../index.php", "Admission");
}

if ($result['stud_fname'] == '') { ?>
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-6 col-sm-offset-3">
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="<?= PROOT ?>index.php">Home</a></li>
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
                <img src="<?= PROOT ?>img/profile-avat.jpg" alt="User's photo to diplay here ---profile">
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
                      <p class="list-group-item-text"><?= $result['email'] ?></p>
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
  <?php } else { ?>
    <section class="wrapper">
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
                <div class="text-center profile-ava"><img class="simple wid" src="<?= PROOT . 'admission' . $info['path']; ?>" alt="image not found">
                  <p>Profile Photo</p>
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
                  <td>The last attended school</td>
                  <td><strong><?= $info['pschool']; ?></strong></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </section>
      </div>
    </section>
  <?php } ?>

  <?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
