<?php
include_once "../auth/objects/Login.php";
include_once "../auth/objects/User.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "../auth/TokenLogin.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $passwordHash = \john\auth\Login::GetUserPassword($_POST["email"]);
    if ($passwordHash !== false && password_verify($_POST["password"], $passwordHash)) {
        $user = \john\auth\Login::GetUser($_POST["email"]);
        if ($user !== false){
            $token = \john\auth\Login::CreateTokenFromUser($user);
            setcookie("bullitin-token", $token, time()+2678400, "/");
            $_SESSION["user"] = $user;

            header('Location: '."/index.php");
        }
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
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control email" tabindex="1" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small>255 characters maximum</small>
            <p class="errormessage" id="emailError"></p>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control password" tabindex="2" id="password" name="password" placeholder="Password">
            <small>60 characters maximum</small>
            <p class="errormessage" id="passwordError"></p>
        </div>
        <button type="submit" class="btn" tabindex="3">Login</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>