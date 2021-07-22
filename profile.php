<?php
session_start();
require('./config.php');

if (isset($_POST['login']) && isset($_POST['password1'])){
  if (($_POST['login'] != "") && ($_POST['password1'] != "")){
    $login = $_POST['login'];
    $password = $_POST['password1'];

    $download_password = mysqli_query($connection, "SELECT password FROM $dbprefix"."users WHERE login='".$login."'");

    $access = 0;
    if(mysqli_num_rows($download_password) == true){

      $result = mysqli_fetch_assoc($download_password);

      $password_encrypted = $result["password"];

      $access = password_verify($password, $password_encrypted);
    }

    if ($access == 1){
      setcookie("logged", 1);
      setcookie("login", $login);
      $download_rank = mysqli_query($connection, "SELECT permission FROM $dbprefix"."ranks WHERE login='".$login."'");
      $result2 = mysqli_fetch_assoc($download_rank);
      $permission = $result2["permission"];

      if ($permission == 'root'){
        $_SESSION['authorized'] = 'root';
        echo "<div class='normalfloat'><button class='button3' type='submit' name='addArticleButtonForm' onclick=\"addArticleForm('$permission')\">Add an article</button></div><br><br>";
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
        echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
        echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('root')\"><image src='resources/search.ico' id='searchico'/></button>";
        echo "~";
        echo "<div class='rank'>Welcome, ".$login."</div><div class='normalfloat'><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button></div>";
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

          <div class='normalfloat'>
          <input type='image' src='resources/delete.png' onclick=\"deleteArticleScript($id)\"></div>

          <div class='marginfloat'>
          <input type='image' src='resources/edit.png' onclick=\"editArticleForm($id, 'root')\"></div>

          <div class='marginfloat'>
          <input type='image' src='resources/preview.png' onclick='previewArticle($id)'></div>

          </div>

          </div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
        }
      }

      if  ($permission == 'user'){
        $_SESSION['authorized'] = 'user';
        echo "<div class='normalfloat'><button class='button3' type='submit' name='addArticleButtonForm' onclick=\"addArticleForm('$permission')\">Add an article</button></div><br><br>";
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
        echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
        echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('user')\"><image src='resources/search.ico' id='searchico'/></button>";
        echo "~";
        echo "<div class='rank'>Welcome, ".$login."</div><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button>";
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
          <div id='loginform1'>
            <span class='span1'>Log in to your account!</span>
            <br><br><br><br><br>

            <div id='loginform3'>
              <span class='span2'>Login: </span>
              <br><br><br>

              <span class='span3'>Password: </span>
              <br><br><br>
            </div>

            <div id='loginform2'>
              <input type='text' id='login'>
              <input type='password' id='password1'>
              <button class='button1' type='submit' name='signinform' onclick='signinScript()'>Sign in</button>
            </div>

            <div id='neededstyle2'>
              <image src='resources/campfire.gif' id='campfire' width='210px' height='150px'>
            </div>

            <div id='neededstyle1'>
            <image src='resources/ak47.png' id='ak47' width='125px' height='157px'>
            </div>
          </div>";
      echo "<h1 id='warn3'>Login or password is incorrect!</h1>";
      echo "~";
      echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
      echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('null')\"><image src='resources/search.ico' id='searchico'/></button>";
      echo "~";
      echo "<div id='registerpagebutton'>
      <button class='button3' type='submit' name='registerpage' onclick='register()'>Register</button><br><br>
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
        <div id='loginform1'>
          <span class='span1'>Log in to your account!</span>
          <br><br><br><br><br>

          <div id='loginform3'>
            <span class='span2'>Login: </span>
            <br><br><br>

            <span class='span3'>Password: </span>
            <br><br><br>
          </div>

          <div id='registerform3'>
            <input type='text' id='login'>
            <input type='password' id='password1'>
            <button class='button1' type='submit' name='signinform' onclick='signinScript()'>Sign in</button>
          </div>

          <div id='neededstyle2'>
            <image src='resources/campfire.gif' id='campfire' width='210px' height='150px'>
          </div>

          <div id='neededstyle1'>
          <image src='resources/ak47.png' id='ak47' width='125px' height='157px'>
          </div>
        </div>";
    echo "<h1 id='warn3'>Fill in all fields!</h1>";
    echo "~";
    echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
    echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('null')\"><image src='resources/search.ico' id='searchico'/></button>";
    echo "~";
    echo "<div id='registerpagebutton'>
    <button class='button3' type='submit' name='registerpage' onclick='register()'>Register</button><br>
    </div>

    <div id='loginpagebutton'>
    <button class='button3' type='submit' name='loginpage' onclick='signin()'>Sign in</button><br>
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
      echo "<div class='normalfloat'><button class='button3' type='submit' name='addArticleButtonForm' onclick=\"addArticleForm('$permission')\">Add an article</button></div><br><br>";
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
      echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
      echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('root')\"><image src='resources/search.ico' id='searchico'/></button>";
      echo "~";
      echo "<div class='rank'>Welcome, ".$login."</div><div class='normalfloat'><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button></div>";
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

        <div class='normalfloat'>
        <input type='image' src='resources/delete.png' onclick=deleteArticleScript($id)></div>

        <div class='marginfloat'>
        <input type='image' src='resources/edit.png' onclick=\"editArticleForm($id, 'root')\"></div>

        <div class='marginfloat'>
        <input type='image' src='resources/preview.png' onclick='previewArticle($id)'></div>

        </div>

        </div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
      }
    }

    if  ($permission == 'user'){
      $_SESSION['authorized'] = 'user';
      echo "<div class='normalfloat'><button class='button3' type='submit' name='addArticleButtonForm' onclick=\"addArticleForm('$permission')\">Add an article</button></div><br><br>";
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
      echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
      echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('user')\"><image src='resources/search.ico' id='searchico'/></button>";
      echo "~";
      echo "<div class='rank'>Welcome, ".$login."</div><div class='normalfloat'><button class='button2' type='submit' name='logoutredirect' onclick='logOut()' id='logoutpagebutton'>Log out</button></div>";
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
} else echo "<h1 id='warn1'>You can't step like that!</h1><h2 id='warn2'>There is nothing here...</h2>";

mysqli_close($connection);
?>
