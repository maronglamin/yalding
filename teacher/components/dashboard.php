<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
  login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "teacher_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "teacher_res" . DS . "aside.php");
?>
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
  </div>
</div>

<div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-cloud-download"></i>
              <div class="count">3</div>
              <div class="title">ASSIGNED CLASS</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-shopping-cart"></i>
              <div class="count">2</div>
              <div class="title">SUBJECT TEACH</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-cubes"></i>
              <div class="count">4</div>
              <div class="title">CLASS PER SHIFT</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

        </div>
        <!--/.row-->

        <div class="col-lg-12">
            <!--Project Activity start-->
            <section class="panel">
              <div class="panel-body progress-panel">
                <div class="row">
                  <div class="col-lg-8 task-progress pull-left">
                    <h1>Teacher's Work Plan</h1>
                  </div>
                  <div class="col-lg-4">
                    <span class="profile-ava pull-right">
                                        <img alt="" class="simple" src="<?=PROOT?>img/avatar1_small.jpg">
                                        Teacher's Name
                                </span>
                  </div>
                </div>
              </div>
              <table class="table table-hover personal-task">
                  <thead>
                      <th>DATES</th>
                      <th>WORK PLAN TITLE</th>
                      <th>PLAN DESRIPTION</th>
                      <th>DETAILS</th>
                  </thead>
                <tbody>
                  <tr>
                    <td>03/05/21</td>
                    <td>
                      Grade eight circle lesson plan
                    </td>
                    <td>
                        This is some decription for me to remeber what it entails. Lorem ipsum dolor, sit amet consectetur adipisicing elitero repudia...
                      <!-- <span class="badge bg-important">Upload</span> -->
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary">checkout</a>
                    </td>
                  </tr>
                  <tr>
                    <td>03/05/21</td>
                    <td>
                      Grade eight circle lesson plan
                    </td>
                    <td>
                        This is some decription for me to remeber what it entails. Lorem ipsum dolor, sit amet consectetur adipisicing elitero repudia...
                      <!-- <span class="badge bg-important">Upload</span> -->
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary">checkout</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </section>
            <!--Project Activity end-->
          </div>
<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");