<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/PageStart.php';

include_once $_SERVER['DOCUMENT_ROOT']."/cms/CMSManager.php";
include_once $_SERVER['DOCUMENT_ROOT']."/cms/Objects/Comment.php";
require_once $_SERVER['DOCUMENT_ROOT']."/Connections.php";

use john\database\Connections;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/Website.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/navbar.php'; ?>
<div class="container-fluid">
    <?php
    $connection = Connections::GetConnection();
    $prepStatement = $connection->prepare('SELECT YEAR(`created`) as yr, MONTH(`created`) as moth, 
    DAY(`created`) as dya, `IP`, count(*) as page_hits 
    from `stats` GROUP BY YEAR(`created`), MONTH(`created`), DAY(`created`)');

    $execBool = $prepStatement->execute();

    while ($fetched = $prepStatement->fetch()){
        echo "<div class=\"row thread\">";
        echo "<div class=\"col-6 threaditembackground\">";
        echo 'year: ';
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo $fetched['yr'];
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo 'ip: ';
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo $fetched['IP'];
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo 'month: ';
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo $fetched['moth'];
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo 'day: ';
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo $fetched['dya'];
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo 'page hits: ';
        echo "</div>";
        echo "<div class=\"col-6 threaditembackground\">";
        echo $fetched['page_hits'];
        echo "</div>";

        echo "</div>";
    }
    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>