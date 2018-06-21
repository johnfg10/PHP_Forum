<?php
/**
 * Created by IntelliJ IDEA.
 * User: sgs376414
 * Date: 12/03/2018
 * Time: 09:50
 */
require_once $_SERVER['DOCUMENT_ROOT']."/auth/objects/Login.php";
require_once $_SERVER['DOCUMENT_ROOT']."/auth/objects/User.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT']."/auth/TokenLogin.php";

require_once $_SERVER['DOCUMENT_ROOT'] . '/misc/StatsTracker.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/misc/ErrorHandler.php';

//require_once $_SERVER['DOCUMENT_ROOT'].'/StatsTracker.php';