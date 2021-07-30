<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
  login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "teacher_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "teacher_res" . DS . "aside.php");

print page_name('Dashboard');

# get teacher's planned details.
$id = $user_data['id'];
$ids = $user_data['id'];

$sql = $db->query("SELECT * FROM `lesson_plan` WHERE `staff_id` = '{$id}' LIMIT 10");

if (isset($_GET['submit'])) {
  $id = (int)sanitize($_GET['submit']);

  # update the db and set permit to 1
  $db->query("UPDATE `lesson_plan` SET `permit` = '1' WHERE `id` = '{$id}'");
  $_SESSION['success_mesg'] .= 'Senior Staff permitted and can see your lesson plans.';
  redirect('dashboard.php');
}

if (isset($_GET['hidden'])) {
  $id = (int)sanitize($_GET['hidden']);

  # update the db and set permit to 1
  $db->query("UPDATE `lesson_plan` SET `permit` = '0' WHERE `id` = '{$id}'");
  $_SESSION['success_mesg'] .= 'Senior Staff can\'t see your lesson plans.';
  redirect('dashboard.php');
}


if (isset($_GET['plan'])) {
  $plan_id = (int)sanitize($_GET['plan']);
  $plan_ids = (int)sanitize($_GET['plan']);


  $sql = $db->query("SELECT * FROM `lesson_plan` WHERE `id` = '{$plan_id}'");
  $sql2 = $db->query("SELECT * FROM `lesson_plan` WHERE `id` = '{$plan_ids}'");


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
    <?php if ($check == '') : ?>
      <a href="next_plan.php?add=<?= $result2['id'] ?>" class="btn btn-primary pull-right">Add Contents</a><br><br>
    <?php else : ?>
      <a href="next_plan.php?edit=<?= $result2['id'] ?>" class="btn btn-success pull-right">Edit Contents</a><br><br>
    <?php endif; ?>
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
    <?php if ($result2['permit'] == '0') : ?>
      <a href="dashboard.php?submit=<?= $result2['id'] ?>" class="btn btn-primary">Permit senior teacher</a>
    <?php else : ?>
      <a href="dashboard.php?hidden=<?= $result2['id'] ?>" class="btn btn-primary pull-right">Set Hidden</a>
      <p class="text-primary">Senior teacher permitted and the lesson plan is vissible</p>
    <?php endif; ?>
  <?php endwhile; ?>

<?php } else {

?>
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
  <div class="col-lg-12">
    <!--Project Activity start-->
    <section class="panel">
      <div class="panel-body progress-panel">
        <div class="row">
          <div class="col-lg-8 task-progress pull-left">
            <h1>Teacher's Work Plan</h1>
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

          <?php while ($result = mysqli_fetch_assoc($sql)) :
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
