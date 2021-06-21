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

// table heads values and the table data values give the index from the database. three prams, 2 array and string.
print html_table(['First name', 'Family Name','Previous','Student address','Action'], $get_stud_adm_data,['stud_fname', 'stud_lname', 'pschool','address','stud_id']);
include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");