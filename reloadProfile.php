<?php
session_start();
if (isset($_SESSION['authorized'])){
require("config.php");
$login = $_COOKIE['login'];
$permission = $_POST['permission'];

echo "<div class'normalfloat'><button class='button3' type='submit' name='addArticleButton' onclick=\"addArticleForm('$permission')\">Add an article</button></div><br><br>";
echo "<br><br>
<button class='reloadOrdered' onclick=\"reloadOrdered('general', '$permission')\">
        <img class='categoryimage' src='https://files.facepunch.com/f/fi/6?c=cd84f'>
        <div class='forumtitle'>
        Rust General
        </div>
        <div class='forumsubtitle'>
        Anything and everything to do with Rust.
        </div>
</button>
<br><br>
<button class='reloadOrdered' onclick=\"reloadOrdered('servers', '$permission')\">
        <img class='categoryimage' src='https://files.facepunch.com/f/fi/46.d551c'>
        <div class='forumtitle'>
        Servers Discussions
        </div>
        <div class='forumsubtitle'>
        Server talks.
        </div>
</button>
<br><br>
<button class='reloadOrdered' onclick=\"reloadOrdered('tips', '$permission')\">
        <img class='categoryimage' src='https://files.facepunch.com/f/forumicons/7/20171017-130258'>
        <div class='forumtitle'>
        Game Tips
        </div>
        <div class='forumsubtitle'>
        Tutorials and tips to be better.
        </div>
</button>
<br><br>
<button class='reloadOrdered' onclick=\"reloadOrdered('help', '$permission')\">
        <img class='categoryimage' src='https://files.facepunch.com/f/forumicons/39/20171017-130221'>
        <div class='forumtitle'>
        Help me
        </div>
        <div class='forumsubtitle'>
        Needed help with.
        </div>
</button>";
echo "~";
if ($permission == 'root'){
  echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
  echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('root')\"><image src='resources/search.ico' id='searchico'/></button>";
}
if ($permission == 'user'){
  echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
  echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('user')\"><image src='resources/search.ico' id='searchico'/></button>";
}
echo "~";
echo "<div class='rank'>Welcome, ".$login."</div><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button>";
echo "~";

mysqli_select_db($connection, $dbname);
$category = $_POST['category'];

$query = "SELECT * FROM $dbprefix"."articles WHERE category='$category'";
$result = mysqli_query($connection, $query);

if ($permission == 'user'){
  while($row = mysqli_fetch_array($result)){
    $title=$row["title"];
    $content=$row["content"];

    echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
  }
}

if ($permission == 'root'){
  while($row = mysqli_fetch_array($result)){
    $id=$row['id'];
    $title=$row["title"];
    $content=$row["content"];

    echo "<div class='article'><div class='articletitle'>$title

    <div class='articlepanel'>

    <div class='normalfloat'>
    <input type='image' src='resources/delete.png' onclick='deleteArticleScript($id)'></div>

    <div class='marginfloat'>
    <input type='image' src='resources/edit.png' onclick=\"editArticleForm($id, 'root')\"></div>

    <div class='marginfloat'>
    <input type='image' src='resources/preview.png' onclick='previewArticle($id)'></div>

    </div>

    </div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
  }
}

mysqli_close($connection);
} else echo "<h1 id='warn1'>You can't step like that!</h1><h2 id='warn2'>There is nothing here...</h2>";
?>
