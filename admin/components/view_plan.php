<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

$lessonPlan = $db->query("SELECT * FROM `lesson_plan` WHERE `permit` = 1 LIMIT 5");


print page_name('Assign teachers to a class'); ?>


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

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
