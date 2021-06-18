<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';
unset($_SESSION['TEACHR_USER_SESSIONS']);
$_SESSION['success_mesg'] = 'You are now logg out, have a nice day';
header('Location: ../index.php');