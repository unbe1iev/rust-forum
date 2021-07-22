<?php
session_start();
if (isset($_SESSION['authorized']) && ($_SESSION['authorized'] == 'root')){
$id = $_GET['id'];
$login = $_COOKIE['login'];

echo "<button type='submit' class='button2' style='width: 100px; margin-right: 70px; margin-top: 5px;' onclick='backScript()' id='backButtonScript'>Back</button>";
echo "<br><br>
<button class='reloadOrdered' onclick=\"reloadOrdered('general', 'root')\">
        <img class='categoryimage'src='https://files.facepunch.com/f/fi/6?c=cd84f'>
        <div class='forumtitle'>
        Rust General
        </div>
        <div class='forumsubtitle'>
        Anything and everything to do with Rust.
        </div>
</button>
<br><br>
<button class='reloadOrdered' onclick=\"reloadOrdered('servers', 'root')\">
        <img class='categoryimage' src='https://files.facepunch.com/f/fi/46.d551c'>
        <div class='forumtitle'>
        Servers Discussions
        </div>
        <div class='forumsubtitle'>
        Server talks.
        </div>
</button>
<br><br>
<button class='reloadOrdered' onclick=\"reloadOrdered('tips', 'root')\">
        <img class='categoryimage' src='https://files.facepunch.com/f/forumicons/7/20171017-130258'>
        <div class='forumtitle'>
        Game Tips
        </div>
        <div class='forumsubtitle'>
        Tutorials and tips to be better.
        </div>
</button>
<br><br>
<button class='reloadOrdered' onclick=\"reloadOrdered('help', 'root')\">
        <img class='categoryimage' src='https://files.facepunch.com/f/forumicons/39/20171017-130221'>
        <div class='forumtitle'>
        Help me
        </div>
        <div class='forumsubtitle'>
        Needed help with.
        </div>
</button>";
echo "~";
echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('root')\"><image src='resources/search.ico' id='searchico'/></button>";
echo "~";
echo "<div class='rank' style='color: white'>Welcome, ".$login."</div><div style='float: left;'><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button></div>";
echo "~";

require('./config.php');
mysqli_select_db($connection, $dbname);

$query = "SELECT * FROM $dbprefix"."articles WHERE id=".$id."";
$result = mysqli_query($connection, $query);

$row = mysqli_fetch_array($result);
$id=$row['id'];
$title=$row["title"];
$content=$row["content"];
$category=$row["category"];

echo "<div id='articleboard'>
<div class='articletitle'>$title  - ID: $id</div>
<div class='articleinfonames'><div id='articlecategory' style='width: 300px; height: 20px; margin-top: 5px'>&nbsp&nbsp [ Category ]: $category</div></div>
<div id='articlecontentboard'><span id='contenttext'>[ Content ]:</span><div id='articlecontent'>$content</div></div>
</div>";

mysqli_close($connection);
} else echo "<h1 style='color: red; font-family: Impact'>You can't step like that!</h1><h2 style='color: red; font-family: Calibri'>There is nothing here...</h2>";
?>
