<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "teacher_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "teacher_res" . DS . "aside.php");


$id = $user_data['id'];
$sql = $db->query("SELECT * FROM `assig_subj_techer` WHERE `stuff_no` = $id ORDER BY `class_id`");

print page_name('My classes information');



if (isset($_GET['class']) && $_GET['subj']) {
    $class_id = (int)sanitize($_GET['class']);
    $subj_id = (int)sanitize($_GET['subj']);
    $qry = $db->query("SELECT * FROM `stud_class` WHERE `stud_class` ='{$class_id}'"); ?>

    <div class="col-lg-12">
        <!--Project Activity start-->
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>My student in the class</h1>
                    </div>
                </div>
            </div>
            <table class="table table-hover personal-task">
                <thead>
                    <th>Student Number </th>
                    <th>Student Name</th>
                    <th>First Test (25%)</th>
                    <th>Second Test (25%)</th>
                    <th>Tests Total (50%)</th>
                    <th>Exams (50%)</th>
                    <th>Grand Total (100%)</th>
                    <th></th>
                    <th></th>


                </thead>
                <tbody>

                    <?php while ($result = mysqli_fetch_assoc($qry)) :
                        $id = $result['stud_adm_no'];
                        $new_id = $result['stud_adm_no'];

                        $sql = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id`= '{$id}'");
                        $infos = [];
                        foreach (mysqli_fetch_assoc($sql) as $key => $info) {
                            $infos[$key] = $info;
                        }

                        $sql_qry = $db->query("SELECT * FROM `stud_reports` WHERE `stud_no`= '{$new_id}'");
                        $intValues = [];
                        if (mysqli_num_rows($sql_qry) != 0) {
                            foreach (mysqli_fetch_assoc($sql_qry) as $key => $inVal) {
                                $intValues[$key] = $inVal;
                            }
                        }

                        $check_qry = $db->query("SELECT * FROM `stud_reports` WHERE `stud_no` = '{$result['stud_adm_no']}' AND `stud_class` = '{$result['stud_class']}'");
                        $checks = mysqli_num_rows($check_qry)
                    ?>
                        <tr>
                            <td><?= $result['stud_number'] ?></td>
                            <td><?= $infos['stud_fname'] . ' ' . $infos['stud_lname'] ?></td>

                            <td><?= (($checks == 0) ? '0' : $intValues['test1']) ?></td>
                            <td><?= (($checks == 0) ? '0' : $intValues['test2']) ?></td>
                            <td><?= (($checks == 0) ? '0' : (int)$intValues['test1'] + (int)$intValues['test2']) ?></td>
                            <td><?= (($checks == 0) ? '0' : $intValues['exam']) ?></td>
                            <td><strong><?= (($checks == 0) ? '0' : (int)$intValues['test1'] + (int)$intValues['test2'] + (int)$intValues['exam']) ?></strong></td>
                            <td>
                                <?php if ($checks == 0) : ?>
                                    <a href="gradeData.php?add=<?= $result['stud_adm_no'] ?>&class=<?= $result['stud_class'] ?>&subj=<?= $subj_id ?>" class="btn btn-default">Grades</a>
                                <?php endif; ?>
                            </td>
                            <td><a href="gradeData.php?edit=<?= $result['stud_adm_no'] ?>&class=<?= $result['stud_class'] ?>&subj=<?= $subj_id ?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
        </section>
        <!--Project Activity end-->
    </div>

<?php } else {

?>

    <div class="col-lg-8 col-sm-offset-2">
        <!--Project Activity start-->
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>My class and subject list</h1>
                    </div>
                </div>
            </div>
            <table class="table table-hover personal-task">
                <thead>
                    <th>The class and Grade</th>
                    <th>Subject taken </th>
                    <th>Class list</th>
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
                            <td><a href="my_class.php?class=<?= $result['class_id']; ?>&subj=<?= $plans['subj_no'] ?>" class="btn btn-primary">Students</a></td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
        </section>
        <!--Project Activity end-->
    </div>

<?php }
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
