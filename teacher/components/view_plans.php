<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "teacher_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "teacher_res" . DS . "aside.php");

print page_name('Lesson plan view');

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

<?php }
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
?>