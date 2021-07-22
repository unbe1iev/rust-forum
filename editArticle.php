<?php
session_start();

if (isset($_SESSION['authorized']) && ($_SESSION['authorized'] == 'root')){
$login = $_COOKIE['login'];
$permission = $_POST['permission'];
$id = $_POST['id'];

echo "<div class='addform'>
                <span class='editspan'>Category:</span>
                <select id='editArticleCategoryForm'>
                  <option>general</option>
                  <option>servers</option>
                  <option>tips</option>
                  <option>help</option>
                </select>
                &nbsp;&nbsp;&nbsp;
                <span class='editspan'>Title:</span>
                <input type='text' id='editArticleTitleForm' size='32' maxlength='25' style='margin-top: 46px'/><br><br>
                <span class='editspan'>Content:</span><br>
                <textarea id='editArticleContentForm' rows='9' cols='48' style='margin-top: 13px'></textarea>
                <button type='submit' class='button3' style='margin-top: 15px' onclick=\"editArticleScript($id, '$permission')\" id='editArticleButton'>Modify an article</button>
                <button type='submit' class='button2' style='margin-top: 15px;' onclick='backScript()' id='backButtonScript'>Back</button>
    </div>";

    require('./config.php');
    mysqli_select_db($connection, $dbname);

if (isset($_POST['id']) && isset($_POST['category']) && isset($_POST['title']) && isset($_POST['content'])){
  if (($_POST['title'] != "") && ($_POST['content'] != "")){
    $category = $_POST['category'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = "UPDATE $dbprefix"."articles SET category='".$category."', title='".$title."', content='".$content."' WHERE id=".$id."";
    $result = mysqli_query($connection, $query);

    echo "<h1 style='color: lime'>Successfully modified an article!</h1>";
  } else echo "<h1 style='color: red'>Fill in all fields!</h1>";
}

echo "~";
  echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
  echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('root')\"><image src='resources/search.ico' style='width: 15px; height: 15px;'/></button>";
echo "~";
echo "<div class='rank' style='color: white'>Welcome, ".$login."</div><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button>";
echo "~";

$query = "SELECT * FROM $dbprefix"."articles WHERE id=".$id."";
$result = mysqli_query($connection, $query);

$row = mysqli_fetch_array($result);

$title=$row["title"];
$content=$row["content"];

echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";

mysqli_close($connection);

} else echo "<h1 style='color: red; font-family: Impact'>You can't step like that!</h1><h2 style='color: red; font-family: Calibri'>There is nothing here...</h2>";
?>
