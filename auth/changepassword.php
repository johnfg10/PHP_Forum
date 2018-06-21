<?php
/**
 * Created by PhpStorm.
 * User: sgs376414
 * Date: 05/02/2018
 * Time: 10:47
 */
include_once "../auth/objects/Login.php";
include_once "../auth/objects/User.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "../auth/TokenLogin.php";

if (!isset($_SESSION["user"])){
    die('<h1>You must be logged in to continue with this action</h1>');
}else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo "userid: ".$_SESSION["user"]->getUserId()." password: ".$_POST["password"]."<br>";
        echo \john\auth\Login::SetUserPassword($_SESSION["user"], $_POST["password"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <link rel="stylesheet" href="/css/Website.css"/>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/navbar.php'; ?>

<div>
    <form action="changepassword.php" method="post">
        <div class="form-group">
            <label for="oldpass">Password</label>
            <input type="password" class="form-control password" tabindex="1" id="password" name="password" placeholder="Password">
            <small>255 characters maximum</small>
            <p class="errormessage" id="emailError"></p>
        </div>
        <button type="submit" class="btn" tabindex="2">Change password</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>