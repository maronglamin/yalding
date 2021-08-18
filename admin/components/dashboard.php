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

$enroll = $db->query("SELECT * FROM `stud_adm_info` WHERE enrolled = 1");
$enroll_count = mysqli_num_rows($enroll);

$unenroll = $db->query("SELECT * FROM `stud_adm_info` WHERE enrolled = 0");
$unenroll_count = mysqli_num_rows($unenroll);

$teach = $db->query("SELECT * FROM `staff` WHERE permitted = 1");
$teach_count = mysqli_num_rows($teach);


$results = mysqli_fetch_assoc($sql);

$lessonPlan = $db->query("SELECT * FROM `lesson_plan` WHERE `permit` = 1 LIMIT 5");

if (isset($_GET['plan'])) {
  $plan_id = (int)sanitize($_GET['plan']);
  $plan_ids = (int)sanitize($_GET['plan']);


  $sql = $db->query("SELECT * FROM `lesson_plan` WHERE `id` = '{$plan_id}'");
  $sql2 = $db->query("SELECT * FROM `lesson_plan` WHERE `id` = '{$plan_ids}'");

  print page_name('Teacher\'s lesson plans');

  $divAttrs = ['class' => 'col-lg-10 col-sm-offset-1'];
  print htmlCardHead($divAttrs, 'Lesson Plan full Details'); ?>

  <?php while ($result = mysqli_fetch_assoc($sql)) :
    $plan_data = json_decode($result['first_record']);

    $plans = [];
    foreach ($plan_data as $key => $plan) {
      $plans[$key] = $plan;
    }


  ?>
    <div class="col-lg-4">
      <strong>Subject: </strong>
      <p><?= $plans['subject']; ?></p>
    </div>
    <div class="col-lg-4">
      <strong>Unit Topic: </strong>
      <p><?= $plans['unit-topic']; ?></p>
    </div>
    <div class="col-lg-4">
      <strong>Specific Topic: </strong>
      <p><?= $plans['specific-topic'] ?></p>
    </div>
  <?php endwhile; ?>
  <br>
  <h3 class="text-center text-warning">Wriiten Plans</h3>

  <?php while ($result2 = mysqli_fetch_assoc($sql2)) :
    $check = $result2['general_objective'];
  ?>
    <div class="col-lg-12">
      <strong>General Objective: </strong>
      <p><?= nl2br($result2['general_objective']); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>specific-objective: </strong>
      <p><?= nl2br($result2['specific_objective']); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>procedure: </strong>
      <p><?= nl2br($result2['procedures']); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>activities: </strong>
      <p><?= nl2br($result2['activities']); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>Summary: </strong>
      <p><?= nl2br($result2['summary']); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>evaluation: </strong>
      <p><?= nl2br($result2['evaluation']); ?></p>
    </div>
  <?php endwhile;
} else {
  print page_name('Dashboard');

  ?>

  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="info-box blue-bg">
        <i class="fa fa-cloud-download"></i>
        <div class="count"><?= number_format($enroll_count) ?></div>
        <div class="title">ENROLLED STUDENT CLASS</div>
      </div>
      <!--/.info-box-->
    </div>
    <!--/.col-->

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="info-box brown-bg">
        <i class="fa fa-shopping-cart"></i>
        <div class="count"><?= number_format($teach_count) ?></div>
        <div class="title">TEACHING STAFF</div>
      </div>
      <!--/.info-box-->
    </div>
    <!--/.col-->

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="info-box green-bg">
        <i class="fa fa-cubes"></i>
        <div class="count"><?= number_format($unenroll_count) ?></div>
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
              <img alt="" class="simple" src="<?= PROOT ?>img/avatar1_small.jpg">
              <?= $user_data['first']; ?>
            </span>
          </div>
        </div>
      </div>
      <table class="table table-hover personal-task">
        <thead>
          <th>DATES</th>
          <th>Start Time</th>
          <th>Period</th>
          <th>Class</th>
          <th>Subject</th>
          <th>Unit Topic</th>
          <th>Details</th>
        </thead>
        <tbody>
          <?php while ($result = mysqli_fetch_assoc($lessonPlan)) :
            $plan_data = json_decode($result['first_record']);
            $plans = [];
            foreach ($plan_data as $key => $plan) {
              $plans[$key] = $plan;
            }
          ?>
            <tr>
              <td><?= day_month($result['planed_date']); ?></td>
              <td><?= $plans['start-time']; ?></td>
              <td><?= $plans['period'] . ' Periods'; ?></td>
              <?php if ($result['class_id'] == 1) : ?>
                <td>Grade 7 Circle</td>
              <?php elseif ($result['class_id'] == 2) : ?>
                <td>Grade 7 Square</td>
              <?php elseif ($result['class_id'] == 3) : ?>
                <td>Grade 8 Circle</td>
              <?php elseif ($result['class_id'] == 4) : ?>
                <td>Grade 8 Square</td>
              <?php elseif ($result['class_id'] == 5) : ?>
                <td>Grade 9 Circle</td>
              <?php elseif ($result['class_id'] == 6) : ?>
                <td>Grade 9 Square</td>
              <?php endif; ?>
              <td><?= $plans['subject']; ?></td>
              <td><?= $plans['unit-topic']; ?></td>
              <td>
                <a href="dashboard.php?plan=<?= $result['id'] ?>" class="btn btn-primary">checkout</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </section>
    <!--Project Activity end-->
  </div>
<?php }
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
