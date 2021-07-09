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

$sql = $db->query("SELECT * FROM `lesson_plan` WHERE `staff_id` = '{$id}'");


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
    foreach ($plan_data as $plan) {
      $plans[] = $plan;
    }


  ?>
    <div class="col-lg-4">
      <strong>Subject: </strong>
      <p><?= $plans[1]; ?></p>
    </div>
    <div class="col-lg-4">
      <strong>Unit Topic: </strong>
      <p><?= $plans[7]; ?></p>
    </div>
    <div class="col-lg-4">
      <strong>Specific Topic: </strong>
      <p><?= $plans[8] ?></p>
    </div>
  <?php endwhile; ?>
  <br>
  <h3 class="text-center text-warning">Wriiten Plans</h3>

  <?php while ($result2 = mysqli_fetch_assoc($sql2)) :
    $full_text = json_decode($result2["second_record"]);

    // dnd($full_text);

    $plan_sec = [];
    foreach ($full_text as $planned) {
      $plan_sec[] = $planned;
    }
  ?>
    <div class="col-lg-12">
      <strong>General Objective: </strong>
      <p><?= nl2br($plan_sec[1]); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>specific-objective: </strong>
      <p><?= nl2br($plan_sec[2]); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>procedure: </strong>
      <p><?= nl2br($plan_sec[3]); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>activities: </strong>
      <p><?= nl2br($plan_sec[4]); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>Summary: </strong>
      <p><?= nl2br($plan_sec[5]); ?></p>
    </div>
    <div class="col-lg-12">
      <strong>evaluation: </strong>
      <p><?= nl2br($plan_sec[6]); ?></p>
    </div>


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
          <th>End Time</th>
          <th>Class</th>
          <th>Subject</th>
          <th>Unit Topic</th>
          <th>Specific Topic</th>
          <th>Details</th>
        </thead>
        <tbody>
          <tr>
            <?php while ($result = mysqli_fetch_assoc($sql)) :
              $plan_data = json_decode($result['first_record']);
              $plans = [];
              foreach ($plan_data as $plan) {
                $plans[] = $plan;
              }
            ?>

              <td><?= day_month($plans[3]); ?></td>
              <td><?= $plans[4]; ?></td>
              <td><?= $plans[5]; ?></td>
              <?php if ($plans[2] == 1) : ?>
                <td>Grade 7 Circle</td>
              <?php elseif ($plans[2] == 2) : ?>
                <td>Grade 7 Square</td>
              <?php elseif ($plans[2] == 3) : ?>
                <td>Grade 8 Circle</td>
              <?php elseif ($plans[2] == 4) : ?>
                <td>Grade 8 Square</td>
              <?php elseif ($plans[2] == 5) : ?>
                <td>Grade 9 Circle</td>
              <?php elseif ($plans[2] == 6) : ?>
                <td>Grade 9 Square</td>
              <?php endif; ?>
              <td><?= $plans[1]; ?></td>
              <td><?= $plans[7]; ?></td>
              <td><?= $plans[8]; ?></td>
              <td>
                <a href="dashboard.php?plan=<?= $result['id'] ?>" class="btn btn-primary">checkout</a>
              </td>
            <?php endwhile; ?>
          </tr>
        </tbody>
      </table>
    </section>
    <!--Project Activity end-->
  </div>
<?php }
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
