<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/PageStart.php';
include_once $_SERVER['DOCUMENT_ROOT']."/cms/CMSManager.php";
include_once $_SERVER['DOCUMENT_ROOT']."/cms/Objects/Comment.php";

use \johnfg10\cms\CMSManager;
use \johnfg10\cms\Comment;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/Website.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] .'/navbar.php';
    if (!isset($_SESSION['user'])){
        die("You must be logged in to perform this action");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $bool = CMSManager::CreateComment(Comment::GeneratedId($_POST['thread'], $_POST['comment'], $_SESSION['user']->getUserId()));
        if ($bool == false){
            die("Creation failed");
        }
    }
?>

<div>
    <form action="createcomment.php" method="post">
        <div class="form-group">
            <label for="thread">Thread</label>
            <input type="text" class="form-control" tabindex="1" id="thread" name="thread" aria-describedby="threadHelp" placeholder="Enter thread name">
            <p class="errormessage" id="emailError"></p>
        </div>
        <div class="form-group">
            <label for="">Comment</label>
            <input type="text" class="form-control" tabindex="2" id="comment" name="comment" placeholder="comment">
            <p class="errormessage" id="passwordError"></p>
        </div>
        <button type="submit" class="btn" tabindex="3">Submit</button>
    </form>
</div>

<script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>