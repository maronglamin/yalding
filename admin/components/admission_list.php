<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
  login_error_redirect("../index.php", "Dashboard");
}

include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");
print page_name('students under list');
while($stud_adm_data = mysqli_fetch_assoc($get_stud_adm_data)) {
        print html_table( // three prams 
            // table heads values
            ['Date filled','First name', 'Family Name','Previous', ' '],
            // table data values 
            [
                $stud_adm_data['stud_fname'], 
                $stud_adm_data['stud_lname'],
                $stud_adm_data['pschool'],
                time_format($stud_adm_data['date_form_filled']),
                '<a href="admission_details.php?stud_id='.$stud_adm_data['stud_id'].'" class="btn btn-primary">Details</a>'
            ],
        // table header title name 
        'Student data collected from filled form on admission');
    }

include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
    
