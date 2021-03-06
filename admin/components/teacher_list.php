<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

if (isset($_GET['delete'])) {
    $id = (int)sanitize($_GET['delete']);
    $classid = (int)sanitize($_GET['classId']);
    $db->query("DELETE FROM `assig_subj_techer` WHERE `id` = $id");
    $_SESSION['success_mesg'] .= 'Teacher teacher deleted!';
    redirect('teacher_list.php?class=' . $classid);/*  */
}

if (isset($_GET['grades']) && $_GET['classId']) {
    $subj = (int)sanitize($_GET['grades']);
    $class_id = (int)sanitize($_GET['classId']);

    $grades = $db->query("SELECT * FROM `stud_reports` WHERE `stud_class` = '{$class_id}' AND `subj` = '{$subj}'");

    print page_name('Students Grades'); ?>
    <div class="col-lg-10 col-sm-offset-1">
        <!--Project Activity start-->
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>Teachers and subject taken</h1>
                    </div>
                </div>
            </div>
            <table class="table table-hover personal-task">
                <thead>
                    <th>Student Name</th>
                    <th>First test</th>
                    <th>Second test</th>
                    <th>Exam</th>
                    <th>total</th>
                    <th>Grade</th>
                </thead>
                <tbody>
                    <?php while ($stud = mysqli_fetch_assoc($grades)): 
                        $totql_grade = (int)$stud['test1'] + (int)$stud['test2'] + (int)$stud['exam'];
                        $stud_id = $stud['stud_no'];
                        $stud_qty = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id` = '{$stud_id}'");
                        $value = mysqli_fetch_assoc($stud_qty);
                        ?>
                    <tr>
                        <td><?=$value['stud_fname']. ' '. $value['stud_lname']?></td>
                        <td><?=$stud['test1']?></td>
                        <td><?=$stud['test2']?></td>
                        <td><?=$stud['exam']?></td>
                        <td><?=$totql_grade?></td>
                        <td>
                            <?php if ($totql_grade >= 80 && $totql_grade <= 100) :?>
                                <strong>A</strong>
                            <?php elseif ($totql_grade >= 70 && $totql_grade <= 79 ):?> 
                                <strong>B</strong>   
                            <?php elseif ($totql_grade >= 60 && $totql_grade <= 69 ):?>
                                <strong>B</strong> 
                            <?php elseif ($totql_grade >= 50 && $totql_grade <= 59 ):?>
                                <strong>C</strong> 
                            <?php elseif ($totql_grade >= 40 && $totql_grade <= 49 ):?> 
                                <strong>D</strong>  
                            <?php else:?>
                                <strong>F</strong>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </section>
        <!--Project Activity end-->
    </div>

    <?php } else if (isset($_GET['class'])) {
    $id = (int)sanitize($_GET['class']);
    $getClass = $db->query("SELECT * FROM `assig_subj_techer` WHERE class_id = $id");
    $new_getClass = $getClass;

    if (mysqli_num_rows($new_getClass) != 0) {
        print page_name('lesson planned by classes');

    ?>
        <div class="col-lg-10 col-sm-offset-1">
            <!--Project Activity start-->
            <section class="panel">
                <div class="panel-body progress-panel">
                    <div class="row">
                        <div class="col-lg-8 task-progress pull-left">
                            <h1>Teachers and subject taken</h1>
                        </div>
                    </div>
                </div>
                <table class="table table-hover personal-task">
                    <thead>
                        <th>Teacher's Name</th>
                        <th>Subject Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php while ($data_values = mysqli_fetch_assoc($getClass)) :
                            $teacher_id = $data_values['stuff_no'];
                            $subj = $data_values['subj_no'];
                            $tbId = $data_values['id'];

                            $getteacher = $db->query("SELECT * FROM `staff` WHERE id = $teacher_id");
                            $staff_values = [];
                            foreach (mysqli_fetch_assoc($getteacher) as $keys => $staff_data) {
                                $staff_values[$keys] = $staff_data;
                            }
                            $getSubject = $db->query("SELECT * FROM `subject_junior` WHERE `subj_no` = '{$subj}'");
                            $subj_values = [];
                            foreach (mysqli_fetch_assoc($getSubject) as $keys => $subj_data) {
                                $subj_values[$keys] = $subj_data;
                            }

                        ?>
                            <tr>
                                <td><?= $staff_values['full_name']; ?></td>
                                <td><?= $subj_values['subj_name']; ?></td>
                                <td>
                                    <a href="teacher_list.php?grades=<?= $subj_values['subj_no'] ?>&classId=<?= $id ?>" class="btn btn-default">View Grades</a>
                                    <a href="teacher_list.php?delete=<?= $tbId ?>&classId=<?= $id ?>" class="btn btn-danger">Delete</a>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
            <!--Project Activity end-->
        </div>
    <?php } else {
        print page_name('No records');
        echo '<h3 class="text-center text-danger">Their is no record on this category</h3>';
    }
} else {

    print page_name('Teachers and it\'s class details');

    $sql = $db->query("SELECT * FROM `assig_subj_techer`");
    ?>

    <div class="col-lg-12">
        <!--Project Activity start-->
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>Teachers and subject taken</h1>
                    </div>
                </div>
            </div>
            <table class="table table-hover personal-task">
                <thead>
                    <th>Teacher's Name</th>
                    <th>Subject Name</th>
                    <th>Class Name</th>
                    <th>Date teacher joinned</th>
                    <th>Last login time</th>
                    <th></th>

                </thead>
                <tbody>

                    <?php while ($result = mysqli_fetch_assoc($sql)) :
                        $staff_id = $result['stuff_no'];
                        $staff_details = $db->query("SELECT full_name, date_join, last_login, id FROM staff WHERE id = $staff_id");
                        $data = [];
                        foreach (mysqli_fetch_assoc($staff_details) as $name) {
                            $data[] = $name;
                        }

                        $subject = $result['subj_no'];
                        $subject_details = $db->query("SELECT subj_name FROM subject_junior WHERE subj_no = $subject");
                        $subject_data = [];
                        foreach (mysqli_fetch_assoc($subject_details) as $subject_name) {
                            $subject_data[] = $subject_name;
                        }


                        $class = $result['class_id'];
                        $class_details = $db->query("SELECT grade_name FROM class_grade WHERE class_id = $class");
                        $class_data = [];
                        foreach (mysqli_fetch_assoc($class_details) as $class_name) {
                            $class_data[] = $class_name;
                        }


                    ?>
                        <tr>
                            <td><?= $data[0]; ?></td>
                            <td><?= $subject_data[0]; ?></td>
                            <td><?= $class_data[0]; ?></td>
                            <td><?= time_format($data[1]); ?></td>
                            <td><?= (($data[2] == '0000 00 00 00:00:00') ? 'Teacher never LOGIN to the system' : tim_format($data[2])) . ' login time'; ?></td>
                            <!-- <td><a href="teacher_list?details=<?= $data[3] ?>" class="btn btn-warning">Details</a></td> -->
                            <td></td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
        </section>
        <!--Project Activity end-->
    </div>

<?php }
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
