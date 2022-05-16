<?php
session_start();
require('./config.php');

if (isset($_POST['login']) && isset($_POST['password1'])){
  if (($_POST['login'] != "") && ($_POST['password1'] != "")){
    $login = $_POST['login'];
    $password = $_POST['password1'];

    $download_password = mysqli_query($connection, "SELECT password FROM $dbprefix"."users WHERE login='".$login."'");
    $result = mysqli_fetch_assoc($download_password);
    $password_encrypted = $result["password"];

    $access = password_verify($password, $password_encrypted);

    if ($access == 1){
      setcookie("logged", 1);
      setcookie("login", $login);
      $download_rank = mysqli_query($connection, "SELECT permission FROM $dbprefix"."ranks WHERE login='".$login."'");
      $result2 = mysqli_fetch_assoc($download_rank);
      $permission = $result2["permission"];

      if ($permission == 'root'){
        $_SESSION['authorized'] = 'root';
        echo "<div style='float: left'><button class='button3' type='submit' name='addArticleButtonForm' onclick=\"addArticleForm('$permission')\" style='width: 120px; height: 40px; margin-left: 25px; margin-top: 3px'>Add an article</button></div>";
        echo "<span class='font2' style='color: #696969; text-transform: uppercase; margin-left: 40px'>Rust Forum</span><br>
        <br>
        <button onclick=\"reloadOrdered('general', '$permission')\" style='width: 585px;'>
                <img src='https://files.facepunch.com/f/fi/6?c=cd84f' style='float: left;' width='55' height='55'>
                <div class='forumtitle'>
                Rust General
                </div>
                <div class='forumsubtitle'>
                Anything and everything to do with Rust.
                </div>
        </button>
        <br><br>
        <button onclick=\"reloadOrdered('servers', '$permission')\" style='width: 585px;'>
                <img src='https://files.facepunch.com/f/fi/46.d551c' style='float: left;' width='55' height='55'>
                <div class='forumtitle'>
                Servers Discussions
                </div>
                <div class='forumsubtitle'>
                Server talks.
                </div>
        </button>
        <br><br>
        <button onclick=\"reloadOrdered('tips', '$permission')\" style='width: 585px;'>
                <img src='https://files.facepunch.com/f/forumicons/7/20171017-130258' style='float: left;' width='55' height='55'>
                <div class='forumtitle'>
                Game Tips
                </div>
                <div class='forumsubtitle'>
                Tutorials and tips to be better.
                </div>
        </button>
        <br><br>
        <button onclick=\"reloadOrdered('help', '$permission')\" style='width: 585px;'>
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
        echo "<div class='rank' style='color: white'>Welcome, ".$login."</div><div style='float: left;'><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button></div>";
        echo "~";
        mysqli_select_db($connection, $dbname);

        $query = "SELECT * FROM $dbprefix"."articles WHERE category='general'";
        $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($result)){
          $id=$row['id'];
          $title=$row["title"];
          $content=$row["content"];

          echo "<div class='article'><div class='articletitle'>$title

          <div class='articlepanel'>

          <div style='float: left'>
          <input type='image' src='resources/delete.png' onclick=\"deleteArticleScript($id)\"></div>

          <div style='float: left; margin-left: 5px'>
          <input type='image' src='resources/edit.png' onclick=\"editArticleForm($id, 'root')\"></div>

          <div style='float: left; margin-left: 5px'>
          <input type='image' src='resources/preview.png' onclick='previewArticle($id)'></div>

          </div>

          </div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
        }
      }

      if  ($permission == 'user'){
        $_SESSION['authorized'] = 'user';
        echo "<div style='float: left'><button class='button3' type='submit' name='addArticleButtonForm' onclick=\"AddArticleForm('$permission')\" style='width: 120px; height: 40px; margin-left: 25px; margin-top: 3px'>Add an article</button></div>";
        echo "<span class='font2' style='color: #696969; text-transform: uppercase; margin-left: 40px'>Rust Forum</span><br>
      	<br>
      	<button onclick=\"reloadOrdered('general', '$permission')\" style='width: 585px;'>
      					<img src='https://files.facepunch.com/f/fi/6?c=cd84f' style='float: left;' width='55' height='55'>
      					<div class='forumtitle'>
      					Rust General
      					</div>
      					<div class='forumsubtitle'>
      					Anything and everything to do with Rust.
      					</div>
      	</button>
      	<br><br>
      	<button onclick=\"reloadOrdered('servers', '$permission')\" style='width: 585px;'>
      					<img src='https://files.facepunch.com/f/fi/46.d551c' style='float: left;' width='55' height='55'>
      					<div class='forumtitle'>
      					Servers Discussions
      					</div>
      					<div class='forumsubtitle'>
      					Server talks.
      					</div>
      	</button>
      	<br><br>
      	<button onclick=\"reloadOrdered('tips', '$permission')\" style='width: 585px;'>
      					<img src='https://files.facepunch.com/f/forumicons/7/20171017-130258' style='float: left;' width='55' height='55'>
      					<div class='forumtitle'>
      					Game Tips
      					</div>
      					<div class='forumsubtitle'>
      					Tutorials and tips to be better.
      					</div>
      	</button>
      	<br><br>
      	<button onclick=\"reloadOrdered('help', '$permission')\" style='width: 585px;'>
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

        $query = "SELECT * FROM $dbprefix"."articles WHERE category='general'";
        $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($result)){
          $title=$row["title"];
          $content=$row["content"];

          echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
        }
      }
    } else{
      echo "
          <div style='margin-top: 30px;width: 585px; height: 365px'>
            <span class='span1' style='margin-left: 100px;'>Log in to your account!</span>
            <br><br><br><br><br>

            <div style='width: 210px; height: 200px; float: left'>
              <span class='span2'>Login: </span>
              <br><br><br>

              <span class='span3'>Password: </span>
              <br><br><br>
            </div>

            <div style='width: 175px; height: 200px; float: left'>
              <input type='text' id='login' style='margin-top: 5px'>
              <input type='password' id='password1' style='margin-top: 43px'>
              <button class='button1' type='submit' name='signinform' onclick='signinScript()'>Sign in</button>
            </div>

            <div style='width: 200px; height: 200px; float: left'>
              <image src='resources/campfire.gif' id='campfire' width='210px' height='150px'>
            </div>

            <div style='width: 200px; height: 180px; margin-top: 150px'>
            <image src='resources/ak47.png' id='ak47' width='125px' height='157px' style='margin-top: -105px; margin-left: 20px;transform: rotate(0.2turn);'>
            </div>
          </div>";
      echo "<h1 style='color: red'>Login or password is incorrect!</h1>";
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

      $query = "SELECT * FROM $dbprefix"."articles";
      $result = mysqli_query($connection, $query);

      while($row = mysqli_fetch_array($result)){
        $title=$row["title"];
        $content=$row["content"];

        echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
      }
    }

  } else{
    echo "
        <div style='margin-top: 30px;width: 585px; height: 365px'>
          <span class='span1' style='margin-left: 100px;'>Log in to your account!</span>
          <br><br><br><br><br>

          <div style='width: 210px; height: 200px; float: left'>
            <span class='span2'>Login: </span>
            <br><br><br>

            <span class='span3'>Password: </span>
            <br><br><br>
          </div>

          <div style='width: 175px; height: 200px; float: left'>
            <input type='text' id='login' style='margin-top: 5px'>
            <input type='password' id='password1' style='margin-top: 43px'>
            <button class='button1' type='submit' name='signinform' onclick='signinScript()'>Sign in</button>
          </div>

          <div style='width: 200px; height: 200px; float: left'>
            <image src='resources/campfire.gif' id='campfire' width='210px' height='150px'>
          </div>

          <div style='width: 200px; height: 180px; margin-top: 150px'>
          <image src='resources/ak47.png' id='ak47' width='125px' height='157px' style='margin-top: -105px; margin-left: 20px;transform: rotate(0.2turn);'>
          </div>
        </div>";
    echo "<h1 style='color: red'>Fill in all fields!</h1>";
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

    $query = "SELECT * FROM $dbprefix"."articles";
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($result)){
      $title=$row["title"];
      $content=$row["content"];

      echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
    }
  }
}

if (isset($_SESSION['authorized'])){
  if (isset($_COOKIE['logged']) && ($_COOKIE['logged'] == 1)){
    $login = $_COOKIE['login'];

    $download_rank = mysqli_query($connection, "SELECT permission FROM $dbprefix"."ranks WHERE login='".$login."'");
    $result2 = mysqli_fetch_assoc($download_rank);
    $permission = $result2["permission"];

    if ($permission == 'root'){
      $_SESSION['authorized'] = 'root';
      echo "<div style='float: left'><button class='button3' type='submit' name='addArticleButtonForm' onclick=\"addArticleForm('$permission')\" style='width: 120px; height: 40px; margin-left: 25px; margin-top: 3px'>Add an article</button></div>";
      echo "<span class='font2' style='color: #696969; text-transform: uppercase; margin-left: 40px'>Rust Forum</span><br>
      <br>
      <button onclick=\"reloadOrdered('general', '$permission')\" style='width: 585px;'>
              <img src='https://files.facepunch.com/f/fi/6?c=cd84f' style='float: left;' width='55' height='55'>
              <div class='forumtitle'>
              Rust General
              </div>
              <div class='forumsubtitle'>
              Anything and everything to do with Rust.
              </div>
      </button>
      <br><br>
      <button onclick=\"reloadOrdered('servers', '$permission')\" style='width: 585px;'>
              <img src='https://files.facepunch.com/f/fi/46.d551c' style='float: left;' width='55' height='55'>
              <div class='forumtitle'>
              Servers Discussions
              </div>
              <div class='forumsubtitle'>
              Server talks.
              </div>
      </button>
      <br><br>
      <button onclick=\"reloadOrdered('tips', '$permission')\" style='width: 585px;'>
              <img src='https://files.facepunch.com/f/forumicons/7/20171017-130258' style='float: left;' width='55' height='55'>
              <div class='forumtitle'>
              Game Tips
              </div>
              <div class='forumsubtitle'>
              Tutorials and tips to be better.
              </div>
      </button>
      <br><br>
      <button onclick=\"reloadOrdered('help', '$permission')\" style='width: 585px;'>
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
      echo "<div class='rank' style='color: white'>Welcome, ".$login."</div><div style='float: left;'><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button></div>";
      echo "~";
      mysqli_select_db($connection, $dbname);

      $query = "SELECT * FROM $dbprefix"."articles WHERE category='general'";
      $result = mysqli_query($connection, $query);

      while($row = mysqli_fetch_array($result)){
        $id=$row["id"];
        $title=$row["title"];
        $content=$row["content"];

        echo "<div class='article'><div class='articletitle'>$title

        <div class='articlepanel'>

        <div style='float: left'>
        <input type='image' src='resources/delete.png' onclick=deleteArticleScript($id)></div>

        <div style='float: left; margin-left: 5px'>
        <input type='image' src='resources/edit.png' onclick=\"editArticleForm($id, 'root')\"></div>

        <div style='float: left; margin-left: 5px'>
        <input type='image' src='resources/preview.png' onclick='previewArticle($id)'></div>

        </div>

        </div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
      }
    }

    if  ($permission == 'user'){
      $_SESSION['authorized'] = 'user';
      echo "<div style='float: left'><button class='button3' type='submit' name='addArticleButtonForm' onclick=\"addArticleForm('$permission')\" style='width: 120px; height: 40px; margin-left: 25px; margin-top: 3px'>Add an article</button></div>";
      echo "<span class='font2' style='color: #696969; text-transform: uppercase; margin-left: 40px'>Rust Forum</span><br>
      <br>
      <button onclick=\"reloadOrdered('general', '$permission')\" style='width: 585px;'>
              <img src='https://files.facepunch.com/f/fi/6?c=cd84f' style='float: left;' width='55' height='55'>
              <div class='forumtitle'>
              Rust General
              </div>
              <div class='forumsubtitle'>
              Anything and everything to do with Rust.
              </div>
      </button>
      <br><br>
      <button onclick=\"reloadOrdered('servers', '$permission')\" style='width: 585px;'>
              <img src='https://files.facepunch.com/f/fi/46.d551c' style='float: left;' width='55' height='55'>
              <div class='forumtitle'>
              Servers Discussions
              </div>
              <div class='forumsubtitle'>
              Server talks.
              </div>
      </button>
      <br><br>
      <button onclick=\"reloadOrdered('tips', '$permission')\" style='width: 585px;'>
              <img src='https://files.facepunch.com/f/forumicons/7/20171017-130258' style='float: left;' width='55' height='55'>
              <div class='forumtitle'>
              Game Tips
              </div>
              <div class='forumsubtitle'>
              Tutorials and tips to be better.
              </div>
      </button>
      <br><br>
      <button onclick=\"reloadOrdered('help', '$permission')\" style='width: 585px;'>
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
      echo "<div class='rank' style='color: white'>Welcome, ".$login."</div><div style='float: left;'><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button></div>";
      echo "~";
      mysqli_select_db($connection, $dbname);

      $query = "SELECT * FROM $dbprefix"."articles WHERE category='general'";
      $result = mysqli_query($connection, $query);

      while($row = mysqli_fetch_array($result)){
        $title=$row["title"];
        $content=$row["content"];

        echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
      }
    }
  }
} else echo "<h1 style='color: red; font-family: Impact'>You can't step lisdgsdfsdke that!</h1><h2 style='color: red; font-family: Calibri'>There is nothing here...</h2>";

mysqli_close($connection);
?>
