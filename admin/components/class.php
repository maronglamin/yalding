<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");


if (isset($_GET['stud_id'])) {

    $id = (int)sanitize($_GET['stud_id']);
    $sql = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id` = '{$id}'");
    $data = mysqli_fetch_assoc($sql);
    $full_name = $data['stud_fname'] . ' ' . $data['stud_lname'];
    $mail = $data['email'];
    $email = $data['email'];

    $stud_number = ((isset($_POST['studNum'])) ? sanitize($_POST['studNum']) : '');
    $mail = ((isset($_POST['mail'])) ? sanitize($_POST['mail']) : '');
    $class = ((isset($_POST['class'])) ? sanitize($_POST['class']) : '');



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db->query("INSERT INTO `stud_class`(`stud_number`, `stud_class`, `stud_adm_no`) VALUES ('{$stud_number}', '{$class}', '{$id}')");
        $db->query("UPDATE `stud_adm_info` SET `email`= '$mail' WHERE `stud_id` = '{$id}'");
        $db->query("UPDATE `stud_adm_info` SET `status` = '1' WHERE `stud_id` = '{$id}'");
        $_SESSION['success_mesg'] .= 'Class assigned successfully!';
        redirect('class.php');
    }

    print page_name('get class');
    $divAttrs = ['class' => 'col-lg-10 col-sm-offset-1'];
    print htmlCardHead($divAttrs, 'student\'s information');

    echo '<form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">';
    print inputDisable('text', 'Student Name *', 'name', $full_name, ['class' => 'form-control', 'placeholder' => 'Name of the student'], ['class' => 'form-group'], [], '');
    print inputBlock('email', 'Student school mail *', 'mail', $email, ['class' => 'form-control', 'placeholder' => 'Assign a student number'], ['class' => 'form-group'], [], '');

    print inputBlock('text', 'Student number *', 'studNum', '', ['class' => 'form-control', 'placeholder' => 'Assign a student number'], ['class' => 'form-group'], [], '');
    print selectBlock('Class', 'class', ['', 'g7c', 'g7s', 'g8c', 'g8s', 'g9c', 'g9s'], ['tab to Select', 'Grade 7 cirle', 'Grade 7 Square', 'Grade 8 circle', 'Grade 9 circle', 'Grade 9 square'], ['class' => 'form-control', 'placeholder' => 'Write the name of the subject for planning'], ['class' => 'form-group'], []);
    print submitBlock('Save', [], [], 'class.php');
    echo '</form>';
    print cardClose();
} else {

    // place holder for titles
    print page_name('Assign classes to enrolled students');

    // the table starter and the title of the table, the title is optional
    print table_wrapper('Approved Students from admission');

    // assign the parameter values of the html table with action button. 
    $tableHead = ['First name', 'Family Name', 'Previous', 'Student address', 'Action']; // table head <th></th>
    $fieldIndex = ['stud_fname', 'stud_lname', 'pschool', 'address', '']; // field index or table <td></td>
    $url =  PROOT . 'admin' . DS . 'components' . DS . 'class';
    $getVariable = 'stud_id';

    // load the table
    print htmlTableActionBtn($tableHead, $getStudData, $fieldIndex, $url, $getVariable);
}
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
