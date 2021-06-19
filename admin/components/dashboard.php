<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
  login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");
$id = (int)$user_data['adm_no'];
$sql = $db->query("SELECT * FROM `administrators` WHERE `adm_no` = $id");
$arr = array();
$results = mysqli_fetch_assoc($sql);
print page_name('Dashboard');

?>
<div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-cloud-download"></i>
              <div class="count">10099</div>
              <div class="title">ENROLLED STUDENT CLASS</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-shopping-cart"></i>
              <div class="count">2</div>
              <div class="title">TEACHING STAFF</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-cubes"></i>
              <div class="count">4</div>
              <div class="title">Unproccess Applicants</div>
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
                    <h1>TEACHING MATERIALS</h1>
                  </div>
                  <div class="col-lg-4">
                    <span class="profile-ava pull-right">
                                        <img alt="" class="simple" src="<?=PROOT?>img/avatar1_small.jpg">
                                        <?=$user_data['first'];?>
                                </span>
                  </div>
                </div>
              </div>
              <table class="table table-hover personal-task">
                  <thead>
                      <th>DATES</th>
                      <th>MATERIAL SUBMITTED</th>
                      <th>DESRIPTION</th>
                      <th>DETAILS</th>
                  </thead>
                <tbody>
                  <tr>
                    <td><?=day_month($results["last_login"]);?></td>
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