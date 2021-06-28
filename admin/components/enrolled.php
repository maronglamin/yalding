<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

// place holder for titles
print page_name('All students enrolled from an admission');

// the table starter and the title of the table, the title is optional
print table_wrapper('Approved Students from admission');

// assign the parameter values of the html table with action button. 
$tableHead = ['First name', 'Family Name', 'Previous', 'Student address', 'Action']; // table head <th></th>
$fieldIndex = ['stud_fname', 'stud_lname', 'pschool', 'address', '']; // field index or table <td></td>
$url =  PROOT . 'admin' . DS . 'components' . DS . 'admission_details';
$getVariable = 'stud_id';

// load the table
print htmlTableActionBtn($tableHead, $getStudAdmissionData, $fieldIndex, $url, $getVariable);

 
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
