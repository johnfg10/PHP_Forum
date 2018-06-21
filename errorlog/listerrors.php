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
    $prepStatement = $connection->prepare('SELECT * FROM phperrors');

    $execBool = $prepStatement->execute();
    echo "<table class='thread' style='text-align: center;margin: auto;'>";
    echo "<tr>";
    echo "<td class='threaditembackground'>Error level</td>";
    echo "<td class='threaditembackground'>Error string</td>";
    echo "<td class='threaditembackground'>Error file</td>";
    echo "<td class='threaditembackground'>Error line</td>";
    echo "<td class='threaditembackground'>Error content</td>";
    echo "</tr>";
    while ($fetched = $prepStatement->fetch()){
        echo "<tr>";

        echo "<td class='threaditembackground'>";
        echo $fetched['errorLog'];
        echo "</td>";

        echo "<td class='threaditembackground'>";
        echo $fetched['errorString'];
        echo "</td>";

        echo "<td class='threaditembackground'>";
        echo $fetched['errorFile'];
        echo "</td>";

        echo "<td class='threaditembackground'>";
        echo $fetched['errorLine'];
        echo "</td>";
        echo "<td class='threaditembackground'>";
        echo $fetched['errorContent'];
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