<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

if (isset($_GET['cid'])) {
    $class_id = (int)sanitize($_GET['cid']);
    $result = $db->query("SELECT
                                c.stud_adm_no AS cid,
                                c.stud_number AS snum,
                                ad.stud_fname AS fname,
                                ad.stud_lname AS lname,
                                ad.email AS mail,
                                ad.tele AS phone,
                                ad.path AS link
                            FROM
                                stud_class c
                            LEFT JOIN stud_adm_info ad
                            ON c.stud_adm_no = ad.stud_id
                            WHERE
                                ad.stud_id = '$class_id'");


    print page_name('Student name');

    $divAttrs = ['class' => 'col-lg-10 col-sm-offset-1'];
    print htmlCardHead($divAttrs, 'student full information');
    while ($sql = mysqli_fetch_assoc($result)) {
        # display the profile photo.
        $html = '<div class="text-center profile-ava"><img class="simple wid" src="' . PROOT . $sql['link'] . '" alt="image not found">';
        $html .= '<h2 class="list-group-item-heading">' . $sql['fname'] . ' ' . $sql['lname'] . '</h2>';
        print $html;

        # display all information about the student.
        
    }

    print cardClose();
}

include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
