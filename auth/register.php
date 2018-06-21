<?php
if (!isset($_SESSION)){
    session_start();
}
require_once "../auth/objects/User.php";
require_once "../auth/objects/Login.php";
?>


<?php
if (isset($_SESSION["user"])){
    //ToDO insert logout lin
    die("You appear to already be logged in! Would you like to log out?");
}
if (isset($_POST["email"], $_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["surname"])){
    $user = \john\auth\User::GeneratedIdAndHashPassword($_POST["email"], $_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["surname"]);
    if ($user != null){
        $createUserResult = \john\auth\Login::CreateUser($user);
        if ($createUserResult){
            $_SESSION["user"] = $user;
            $token = \john\auth\Login::CreateTokenFromUser($user);
            if ($token != false){
                setcookie("bullitin-token", $token, time()+2678400, "/");
            }

            header('Location: '."/index.php");
        }
    }

    die("a error occured in the creation of your account");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login/register.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/navbar.php'; ?>

<script type="application/javascript">
    /**
     * @returns boolean
     */
    function validateData() {
        var isValid = true;
        if (document.forms["registrationForm"]["email"].value.isEmpty()){
            document.getElementById("emailError").innerText = "Email must not be empty!";
            isValid = false;
        }
        if (document.forms["registrationForm"]["username"].value.isEmpty()){
            document.getElementById("usernameError").innerText  += ("Username must not be empty!");
            isValid = false;
        }

        if (document.forms["registrationForm"]["username"].value.length < 5){
            document.getElementById("usernameError").innerText += ("Username must be 6 characters or longer!");
            isValid = false;
        }

        if (document.forms["registrationForm"]["password"].value.isEmpty()){
            document.getElementById("passwordError").innerText  += ("Password must not be empty!");
            isValid = false;
        }

        if (document.forms["registrationForm"]["password"].value.contains()){
            document.getElementById("passwordError").innerText  += ("Password must not be empty!");
            isValid = false;
        }

        if (!document.forms["registrationForm"]["password"].value.containsNumber()){
            document.getElementById("passwordError").innerText  += ("Password must contain at least one number!");
            isValid = false;
        }

        if (!document.forms["registrationForm"]["password"].value.containsCapital()){
            document.getElementById("passwordError").innerText  += ("Password must contain at least one uppercase character!");
            isValid = false;
        }

        if (!document.forms["registrationForm"]["password"].value.containsLowerCase()){
            document.getElementById("passwordError").innerText  += ("Password must contain at least one lowercase character!");
            isValid = false;
        }

        if (document.forms["registrationForm"]["firstname"].value.isEmpty()){
            document.getElementById("firstnameError").innerText  += ("First name must not be empty!");
            isValid = false;
        }

        if (document.forms["registrationForm"]["firstname"].value.onlyLetters()){
            document.getElementById("firstnameError").innerText  += ("First name must only contain letters");
            isValid = false;
        }

        if (document.forms["registrationForm"]["surname"].value.isEmpty()){
            document.getElementById("surnameError").innerText  += ("Surname must not be empty!");
            isValid = false;
        }

        if (document.forms["registrationForm"]["surname"].value.onlyLetters()){
            document.getElementById("surnameError").innerText  += ("Surname must only contain letters!");
            isValid = false;
        }

        return isValid;
    }

    String.prototype.isEmpty = function () {
        if (this === "" || this == null)
            return true;

        return false;
    };

    String.prototype.containsNumber = function () {
        if (this.contains(0) || this.contains(1) || this.contains(2) || this.contains(3) ||
            this.contains(4) || this.contains(5) || this.contains(6) || this.contains(7) ||
            this.contains(8) || this.contains(9))
        return false;
    };

    String.prototype.containsCapital = function () {
        return (/[A-Z]/.test(this))
    };

    String.prototype.containsLowerCase = function () {
        return (/[a-z]/.test(this))
    };

    String.prototype.onlyLetters = function () {
        return(/[^a-z][^A-Z]*/.test(this))
    };
</script>

<div class="register">
    <form action="register.php" method="post" id="registrationForm" onsubmit="return validateData()">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control email" tabindex="1" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small>255 characters maximum</small>
            <p class="errormessage" id="emailError"></p>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control username" tabindex="2" id="username" name="username" placeholder="Enter username">
            <small>50 characters maximum, must be at least 6 characters</small>
            <p class="errormessage" id="usernameError"></p>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control password" tabindex="3" id="password" name="password" placeholder="Password">
            <small>60 characters maximum</small>
            <p class="errormessage" id="passwordError"></p>
        </div>
        <div class="form-group">
            <label for="firstname">First name</label>
            <input type="text" class="form-control name" id="firstname" tabindex="4" name="firstname" placeholder="Enter your first name">
            <small>50 characters maximum</small>
            <p class="errormessage" id="firstnameError"></p>
        </div>
        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" class="form-control name" id="surname" tabindex="5" name="surname" placeholder="Enter your surname">
            <small>50 characters maximum</small>
            <p class="errormessage" id="surnameError"></p>
        </div>
        <button type="submit" class="btn" tabindex="7">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>