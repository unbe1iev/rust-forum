<?php
  session_start();
  if (isset($_POST)){
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

  	  require("./config.php");

  		mysqli_select_db($connection, $dbname);

  		$query = "SELECT * FROM $dbprefix"."articles";
  		$result = mysqli_query($connection, $query);

  		while($row = mysqli_fetch_array($result)){
  			$title=$row["title"];
  			$content=$row["content"];

  			echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
  		}

  		mysqli_close($connection);
    } else echo "xd";
  ?>
