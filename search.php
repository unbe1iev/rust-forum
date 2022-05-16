<?php
session_start();
if (isset($_POST['searchword'])){
$searchword = $_POST['searchword'];
$permissionToSearch = $_POST['permissionToSearch'];

require('./config.php');

if ($permissionToSearch == 'null'){
  echo  "<span class='font2' style='color: #696969; text-transform: uppercase; margin-left: 40px'>Rust Forum</span><br>
  <br>
  <button onclick=\"reload('general')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/fi/6?c=cd84f' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Rust General
        </div>
        <div class='forumsubtitle'>
        Anything and everything to do with Rust.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('servers')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/fi/46.d551c' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Servers Discussions
        </div>
        <div class='forumsubtitle'>
        Server talks.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('tips')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/forumicons/7/20171017-130258' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Game Tips
        </div>
        <div class='forumsubtitle'>
        Tutorials and tips to be better.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('help')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/forumicons/39/20171017-130221' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Help me
        </div>
        <div class='forumsubtitle'>
        Needed help with.
        </div>
  </button>";
  echo "~";
  echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
  echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('null')\"><image src='resources/search.ico' style='width: 15px; height: 15px;'/></button>";
  echo "~";
  echo "<div id='registerpagebutton'>
  <button class='button3' type='submit' name='registerpage' onclick='register()'>Register</button>
  </div>

  <div id='loginpagebutton'>
  <button class='button3' type='submit' name='loginpage' onclick='signin()'>Sign in</button>
  </div>";
  echo "~";

  mysqli_select_db($connection, $dbname);

  $query = "SELECT * FROM $dbprefix"."articles WHERE title LIKE '%$searchword%' OR content LIKE '%$searchword%'";
  $result = mysqli_query($connection, $query);

  while($row = mysqli_fetch_array($result)){
    $title=$row["title"];
    $content=$row["content"];

    echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
  }
}

if ($permissionToSearch == 'user'){
  $login = $_COOKIE['login'];
  echo "<div style='float: left'><button class='button3' type='submit' name='addArticleButton' onclick=\"addArticleForm('user')\" style='width: 120px; height: 40px; margin-left: 25px; margin-top: 3px'>Add an article</button></div>";
  echo  "<span class='font2' style='color: #696969; text-transform: uppercase; margin-left: 40px'>Rust Forum</span><br>
  <br>
  <button onclick=\"reload('general')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/fi/6?c=cd84f' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Rust General
        </div>
        <div class='forumsubtitle'>
        Anything and everything to do with Rust.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('servers')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/fi/46.d551c' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Servers Discussions
        </div>
        <div class='forumsubtitle'>
        Server talks.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('tips')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/forumicons/7/20171017-130258' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Game Tips
        </div>
        <div class='forumsubtitle'>
        Tutorials and tips to be better.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('help')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/forumicons/39/20171017-130221' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Help me
        </div>
        <div class='forumsubtitle'>
        Needed help with.
        </div>
  </button>";
  echo "~";
  echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
  echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('user')\"><image src='resources/search.ico' style='width: 15px; height: 15px;'/></button>";
  echo "~";
  echo "<div class='rank' style='color: white'>Welcome, ".$login."</div><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button>";
  echo "~";

  mysqli_select_db($connection, $dbname);

  $query = "SELECT * FROM $dbprefix"."articles WHERE title LIKE '%$searchword%' OR content LIKE '%$searchword%'";
  $result = mysqli_query($connection, $query);

  while($row = mysqli_fetch_array($result)){
    $title=$row["title"];
    $content=$row["content"];

    echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
  }
}

if ($permissionToSearch == 'root'){
  $login = $_COOKIE['login'];
  echo "<div style='float: left'><button class='button3' type='submit' name='addArticleButton' onclick=\"addArticleForm('root')\" style='width: 120px; height: 40px; margin-left: 25px; margin-top: 3px'>Add an article</button></div>";
  echo  "<span class='font2' style='color: #696969; text-transform: uppercase; margin-left: 40px'>Rust Forum</span><br>
  <br>
  <button onclick=\"reload('general')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/fi/6?c=cd84f' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Rust General
        </div>
        <div class='forumsubtitle'>
        Anything and everything to do with Rust.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('servers')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/fi/46.d551c' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Servers Discussions
        </div>
        <div class='forumsubtitle'>
        Server talks.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('tips')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/forumicons/7/20171017-130258' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Game Tips
        </div>
        <div class='forumsubtitle'>
        Tutorials and tips to be better.
        </div>
  </button>
  <br><br>
  <button onclick=\"reload('help')\" style='width: 585px;'>
        <img src='https://files.facepunch.com/f/forumicons/39/20171017-130221' style='float: left;' width='55' height='55'>
        <div class='forumtitle'>
        Help me
        </div>
        <div class='forumsubtitle'>
        Needed help with.
        </div>
  </button>";
  echo "~";
  echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
  echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('root')\"><image src='resources/search.ico' style='width: 15px; height: 15px;'/></button>";
  echo "~";
  echo "<div class='rank' style='color: white'>Welcome, ".$login."</div><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button>";
  echo "~";

  mysqli_select_db($connection, $dbname);

  $query = "SELECT * FROM $dbprefix"."articles WHERE title LIKE '%$searchword%' OR content LIKE '%$searchword%'";
  $result = mysqli_query($connection, $query);

  while($row = mysqli_fetch_array($result)){
    $id =$row['id'];
    $title=$row["title"];
    $content=$row["content"];

    echo "<div class='article'><div class='articletitle'>$title

    <div class='articlepanel'>

    <div style='float: left'>
    <input type='image' src='resources/delete.png' onclick='deleteArticleScript($id)'></div>

    <div style='float: left; margin-left: 5px'>
    <input type='image' src='resources/edit.png' onclick=\"editArticleForm($id, 'root')\"></div>

    <div style='float: left; margin-left: 5px'>
    <input type='image' src='resources/preview.png' onclick='previewArticle($id)'></div>

    </div>

    </div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
  }
}
} else echo "<h1 style='color: red; font-family: Impact'>You can't step like that!</h1><h2 style='color: red; font-family: Calibri'>There is nothing here...</h2>";
?>
