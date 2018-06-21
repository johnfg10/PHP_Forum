<?php
    function getUserIntro(){
        if (isset($_SESSION["user"])){
            $user = $_SESSION["user"];
            //ToDo finnish accouts page
            return "<button onclick='handleNavbarDropdownClick()' class='navbar-dropdown-btn'>Hello, ".$user->getUserName()."!</button>
                    <div id='dropDownDiv' class='navbar-dropdown-content navbar-themed nav-link' style='display: none'>
                        <a href='/auth/logout.php'>Logout</a><br>
                        <a href='/auth/changepassword.php'>Change password</a>
                    </div>
                    ";
        }else{
            return "<a class=\"nav-link dropdown-toggle navbar-dropdown-btn\" id=\"dropdown01\" data-toggle=\"dropdown\">Please login</a>
<div class=\"dropdown-menu navbar-themed\" aria-labelledby=\"dropdown01\">
              <a class=\"dropdown-item nav-link\" href='/auth/login.php'>Login</a><br>
              <a class=\"dropdown-item nav-link\" href='/auth/register.php'>Register</a>
            </div>";

            return "<button onclick='handleNavbarDropdownClick()' class='navbar-dropdown-btn'>Please login</button>
                    <div id='dropDownDiv' class='navbar-dropdown-content navbar-themed nav-link' style='display: none'>
                        <a href='/auth/login.php'>Login</a><br>
                        <a href='/auth/register.php'>Register</a>
                    </div>";
        }

    }
?>
<link rel="stylesheet" href="/css/navbar.css">
<nav class="navbar navbar-expand-lg navbar-themed">
    <a class="navbar-brand" href="#">Bullitin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav" id="navbarlist">
            <li class="nav-item">
                <a class="nav-link" href="/index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cms/createcomment.php">Create comment</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="/viewallcomments.php">View all comments</a></li>
            <li class="navbar-align-right">
                <?php echo getUserIntro(); ?>
            </li>
        </ul>
    </div>
</nav>
<script src="/js/navbar.js"></script>
<script>

</script>
<br>