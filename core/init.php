<?php
// require the configuration setting where you define contants 
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/config/config.php';

// connect to the database
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB);
if (mysqli_connect_errno()) {
    echo "fail to connect with the error: ". mysqli_connect_error();
    die();
}

// include and require resources and usable funvtion 
include(ROOT . DS . "core" . DS . "res" . DS . "head.php");
require_once(ROOT . DS . "func" . DS . "func.php");
require_once(ROOT . DS . "func" . DS . "helpers.php");
require_once(ROOT . DS . "core" . DS . "sql_query.php");

// start session 
session_start();

// register user sessions that are logged in 

    if (isset($_SESSION['ADMIN_USER_SESSIONS'])) {

        $admin_id = $_SESSION['ADMIN_USER_SESSIONS'];
        $query = $db->query("SELECT * FROM `administrators` WHERE `adm_no` = '{$admin_id}'");
        $user_data = mysqli_fetch_assoc($query);
        $fn = explode(' ', $user_data['full_name']);
        $user_data['first'] = $fn[0];

    } 

    elseif (isset($_SESSION['TEACHR_USER_SESSIONS'])) {

        $user_id = $_SESSION['TEACHR_USER_SESSIONS'];
        $query = $db->query("SELECT * FROM `staff` WHERE `id` = '{$user_id}'");
        $user_data = mysqli_fetch_assoc($query);
        $fn = explode(' ', $user_data['full_name']);
        $user_data['fname'] = $fn[0];

    } elseif (isset($_SESSION['STUDENT_USER_SESSIONS'])) {

        $user_id = $_SESSION['STUDENT_USER_SESSIONS'];
        $query = $db->query("SELECT * FROM `stud_adm_info` WHERE `stud_id` = '{$user_id}'");
        $user_data = mysqli_fetch_assoc($query);
        $fname = $user_data['stud_fname'];
    } 
    

    
if (isset($_SESSION['error_mesg_red'])) {
    echo '<div class="alert alert-danger alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' . ' ' . $_SESSION['error_mesg_red'] . '</div>';
    unset($_SESSION['error_mesg_red']);
}