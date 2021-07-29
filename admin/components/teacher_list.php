<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

if (isset($_GET['class'])) {
    $id = (int)sanitize($_GET['class']);
    $getClass = $db->query("SELECT * FROM `assig_subj_techer` WHERE class_id = $id");
    $new_getClass = $getClass;

    if (mysqli_num_rows($new_getClass) != 0) {
        $data_values = [];
        foreach (mysqli_fetch_assoc($getClass) as $key => $data) {
            $data_values[$key] = $data;
        }
        $teacher_id = $data_values['stuff_no'];
        $subj = $data_values['subj_no'];

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

        print page_name('lesson planned by classes'); ?>
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
                        <tr>
                            <td><?= $staff_values['full_name']; ?></td>
                            <td><?= $subj_values['subj_name']; ?></td>
                            <th></th>
                        </tr>
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
