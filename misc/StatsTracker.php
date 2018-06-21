<?php
/**
 * Created by IntelliJ IDEA.
 * User: sgs376414
 * Date: 12/03/2018
 * Time: 09:35
 */
//INSERT INTO `stats`(`ID`, `Page`, `IP`, `Username`) VALUES (1, 'www.test.com' , '192.343.321' , 'test')
require_once $_SERVER['DOCUMENT_ROOT'] . "/Connections.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Snowflake.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/auth/objects/User.php";

use john\database\Connections;
use johnfg10\utils\Snowflake;
use john\auth;

$connection = Connections::GetConnection();
$prepStatement = $connection->prepare("INSERT INTO `stats`(`ID`, `Page`, `IP`, `Username`) VALUES (?, ?, ?, ?)");

$username = "Unknown";
if (isset($_SESSION['user'])){
    $username = $_SESSION['user']->getUserName();
}

$execBool = $prepStatement->execute([Snowflake::getUniqueId(), $_SERVER['PHP_SELF'], $_SERVER['REMOTE_ADDR'], $username ]);