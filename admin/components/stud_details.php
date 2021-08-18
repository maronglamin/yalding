<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';

// check if the user is logged in before accessing the page
if (!is_logged_in()) {
    login_error_redirect("../index.php", "Dashboard");
}

// load the two navigation sections
include(ROOT . DS . "core" . DS . "admin_res" . DS . "topnav.php");
include(ROOT . DS . "core" . DS . "admin_res" . DS . "aside.php");

if (isset($_GET['pro'])) {
    $cid = (int)sanitize($_GET['cid']);
    $id = (int)sanitize($_GET['pro']);
    $values = $db->query("SELECT * FROM `stud_class` WHERE id = $id");
    $value = mysqli_fetch_assoc($values);
    $get_int_value = (int)$value["stud_class"];
    $int_result = $get_int_value + 1;
    $db->query("UPDATE `stud_class` SET `stud_class`='{$int_result}' WHERE id = $id");
    redirect('stud_details.php?cid=' . $cid);
}

if (isset($_GET['cid'])) {
    $class_id = (int)sanitize($_GET['cid']);
    $result = $db->query("SELECT
                                c.stud_adm_no AS cid,
                                c.id AS stId,
                                c.stud_number AS snum,
                                c.stud_class AS class_name,
                                ad.stud_fname AS fname,
                                ad.stud_lname AS lname,
                                ad.email AS mail,
                                ad.new_email AS new_mail,
                                ad.tele AS phone,
                                ad.path AS link
                            FROM
                                stud_class c
                            LEFT JOIN stud_adm_info ad
                            ON c.stud_adm_no = ad.stud_id
                            WHERE
                                ad.stud_id = '$class_id'");


    print page_name('Student details');


    $divAttrs = ['class' => 'col-lg-10 col-sm-offset-1'];
    print htmlCardHead($divAttrs, 'student full information');
    while ($sql = mysqli_fetch_assoc($result)) { ?>

        <?php if ($sql['class_name'] < '6') : ?>
            <a href="stud_details.php?pro=<?= $sql['stId'] ?>&cid=<?= $sql['cid'] ?>" class="btn btn-warning pull-right">Promote</a>
        <?php endif; ?>
        <?php if ($sql['class_name'] == '6') : ?>
            <a href="stud_details.php?pro=<?= $sql['stId'] ?>&cid=<?= $sql['cid'] ?>" class="btn btn-warning pull-right">Graduate Student</a>
        <?php endif; ?>
<?php
        # display the profile photo.
        $html = '<div class="text-center profile-ava"><img class="simple wid" src="' . PROOT  . 'admission' . $sql['link'] . '" alt="image not found">';
        $html .= '<h2 class="list-group-item-heading">' . $sql['fname'] . ' ' . $sql['lname'] . '</h2>';
        if ($sql['class_name'] == '1') {
            $html .= '<p><strong>Student class</strong> Grade 7 Circle</p>';
        }
        if ($sql['class_name'] == '2') {
            $html .= '<p><strong>Student class</strong> Grade 7 Square</p>';
        }
        if ($sql['class_name'] == '3') {
            $html .= '<p><strong>Student class</strong> Grade 8 Circle</p>';
        }
        if ($sql['class_name'] == '4') {
            $html .= '<p><strong>Student class</strong> Grade 8 Square</p>';
        }
        if ($sql['class_name'] == '5') {
            $html .= '<p><strong>Student class</strong> Grade 9 Circle</p>';
        }
        if ($sql['class_name'] == '6') {
            $html .= '<p><strong>Student class</strong> Grade 9 Square</p>';
        }
        $html .= '<p><strong>Email at Admission</strong> ' . $sql['mail'] . '</p>';
        $html .= '<p><strong>Assigned Email after Admission</strong> ' . $sql['new_mail'] . '</p>';
        $html .= '<p><strong>Student guident phone number</strong> +220 ' . $sql['phone'] . '</p>';
        print $html;

        # display all information about the student.

    }

    print cardClose();
}

include(ROOT . DS . "core" . DS . "res" . DS . "footer.php");
