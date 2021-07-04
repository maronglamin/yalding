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
    $class_id = (int)sanitize($_GET['class']);
    $result = $db->query("SELECT
                                c.stud_adm_no AS cid,
                                c.stud_number AS snum,
                                ad.stud_fname AS fname,
                                ad.stud_lname AS lname,
                                ad.email AS mail,
                                ad.tele AS phone
                            FROM
                                stud_class c
                            LEFT JOIN stud_adm_info ad
                            ON c.stud_adm_no = ad.stud_id
                            WHERE
                                c.stud_class = '$class_id'");


    print page_name('class records');

    $divAttrs = ['class' => 'col-lg-10 col-sm-offset-1'];
    print htmlCardHead($divAttrs, 'students in the class');
    print table_wrapper('Students');

    // assign the parameter values of the html table with action button. 
    $tableHead = ['First Name', 'Last Name', 'Email', 'Telephone of the Guiden', 'Action']; // table head <th></th>
    $fieldIndex = ['fname', 'lname', 'mail', 'phone', 'cid']; // field index or table <td></td>
    $url =  PROOT . 'admin' . DS . 'components' . DS . 'stud_details';
    $getVariable = 'cid';

    // load the table
    print htmlTableActionBtn($tableHead, $result, $fieldIndex, $url, $getVariable);
    print cardClose();
}

include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
