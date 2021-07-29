<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "teacher_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "teacher_res" . DS . "aside.php");

$id = $user_data['id'];
$sql = $db->query("SELECT * FROM `assig_subj_techer` WHERE `stuff_no` = $id");

print page_name('My classes information');
?>

<div class="col-lg-8 col-sm-offset-2">
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
                <th>The class and Grade</th>
                <th>Subject taken </th>
                <th></th>
            </thead>
            <tbody>

                <?php while ($result = mysqli_fetch_assoc($sql)) :
                    $id = $result['subj_no'];
                    $qry = $db->query("SELECT * FROM `subject_junior` WHERE `subj_no` = $id");
                    $plans = [];
                    foreach (mysqli_fetch_assoc($qry) as $key => $plan) {
                        $plans[$key] = $plan;
                    }
                ?>
                    <tr>
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
                        <td><?= $plans['subj_name']; ?></td>
                        <td></td>
                    </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
    </section>
    <!--Project Activity end-->
</div>

<?php include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
