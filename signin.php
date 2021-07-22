<?php
  session_start();
  if (isset($_POST)){
      echo "<div id='loginform1'>
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

      <div id='campfirediv'><image src='resources/campfire.gif' id='campfire' width='140px' height='100px'></div>

      <div><image id='ak47' src='resources/ak47.png' width='110px' height='100px'></div>
    </div>";


			echo "~";
      echo "<input type='text' id='searchfield' placeholder='Search' size='25'>";
      echo "<button type='submit' id='searchsubmit' onclick=\"searchcontent('null')\"><image id='searchico' src='resources/search.ico'/></button>";
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
