<?php
$get_stud_adm_data = $db->query("SELECT * FROM `stud_adm_info` WHERE `enrolled` = '0' ORDER BY `enrolled`");
$coutAll = mysqli_num_rows($get_stud_adm_data);

$getStudAdmissionData = $db->query("SELECT * FROM `stud_adm_info` WHERE `enrolled` = '1'");
$countEnrolled = mysqli_num_rows($getStudAdmissionData);

$getStudData = $db->query("SELECT * FROM `stud_adm_info` WHERE `enrolled` = '1' AND `status` = '0'");


$getNames = $db->query("SELECT * FROM `class_name`");
$classNames = mysqli_fetch_assoc($getNames);

$class = $db->query("SELECT * FROM `class_grade`");
$class_plan = $db->query("SELECT * FROM `class_grade`");

// getmethod to crap the id and select the right requested information
if (isset($_GET['stud_id'])) {
    $id = (int)sanitize($_GET['stud_id']);
    $get_stud_adm_data_id = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id` = '{$id}'");
}


