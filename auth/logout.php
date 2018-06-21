<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/auth/objects/Login.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/auth/objects/User.php";
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . "/auth/TokenLogin.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //log out users
        \john\auth\Login::DestroyToken($_COOKIE["bullitin-token"]);
        unset($_SESSION["user"]);
        //ensure the cookies deleted
        setcookie("bullitin-token", "", time()-1, "/");

        header('Location: '."/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <link rel="stylesheet" href="/css/Website.css"/>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/navbar.php'; ?>

<div>
    <h1>Would you like to log out?</h1>
    <form action="logout.php" method="post">
        <button type="submit" class="accentedbtn2" tabindex="1">Yes</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>