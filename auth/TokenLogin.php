<?php
/**
 * Created by IntelliJ IDEA.
 * User: johnfg10
 * Date: 17/01/18
 * Time: 20:37
 */

if (!isset($_SESSION["user"]) || empty($_SESSION["user"])){
    if (isset($_COOKIE["bullitin-token"])){
        $token = $_COOKIE["bullitin-token"];
        $user = \john\auth\Login::GetUserFromToken($token);
        if ($user != false && $user != null){
            $_SESSION["user"] = $user;
        }
    }
}