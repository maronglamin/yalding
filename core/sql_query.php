<?php
$get_stud_adm_data = $db->query("SELECT * FROM `stud_adm_info`");

// getmethod to crap the id and select the right requested information
if (isset( $_GET['stud_id'] ))
{
    $id = (int)sanitize($_GET['stud_id']);
    $get_stud_adm_data_id = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id` = '{$id}'");
}






