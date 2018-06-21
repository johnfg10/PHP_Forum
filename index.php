<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/PageStart.php';

include_once $_SERVER['DOCUMENT_ROOT']."/cms/CMSManager.php";
include_once $_SERVER['DOCUMENT_ROOT']."/cms/Objects/Comment.php";
require_once $_SERVER['DOCUMENT_ROOT']."/auth/objects/Login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Website.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
</head>
<body>
<?php include 'navbar.php'; ?>
<!-- todo -->
<div class="container-fluid">


<?php
    $comments = \johnfg10\cms\CMSManager::SelectComments(5);
    if ($comments === false){
        die("comments not found");
    }
    echo "<table class='thread' style='text-align: center;margin: auto;'>";
    echo "<tr>";
    echo "<td class='threaditembackground'>Thread name</td>";
    echo "<td class='threaditembackground'>Comment</td>";
    echo "<td class='threaditembackground'>Author</td>";
    echo "</tr>";
    foreach ($comments as $comment){
        echo "<tr>";

        echo "<td class='threaditembackground'>";
        echo $comment->getThread();
        echo "</td>";
        echo "<td class='threaditembackground'>";
        echo $comment->getComment();
        echo "</td>";

        echo "<td class='threaditembackground'>";
        $user = \john\auth\Login::GetUserId($comment->getAuthor());
        if ($user != false){
            echo $user->getUserName();
        }else{
            echo "User could not be loaded!";
        }
        echo "</td>";

        echo "</tr>";
    }
    echo "</table>";
    ?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>