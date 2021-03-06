<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
  login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

print page_name('students under list');
print table_wrapper('Student data collected from filled form on admission');

// assign the parameter values of the html table with action button. 
$tableHead = ['First name', 'Family Name', 'Previous', 'Student address', 'Action']; // table head <th></th>
$fieldIndex = ['stud_fname', 'stud_lname', 'pschool', 'address', '']; // field index or table <td></td>
$url =  PROOT . 'admin' . DS . 'components' . DS . 'admission_details';
$getVariable = 'stud_id';

// table heads values and the table data values give the index from the database. three prams, 2 array and string.
// load the table
print htmlTableActionBtn($tableHead, $get_stud_adm_data, $fieldIndex, $url, $getVariable);
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
