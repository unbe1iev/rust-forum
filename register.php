<?php
session_start();

  echo "
        <div id='registerform1'>
          <span class='span1' >Create an account!</span>
          <br><br><br><br><br>

          <div id='registerform2'>
            <span class='span2'>Login: </span>
            <br><br><br>

            <span class='span3'>Password: </span>
            <br><br><br>

            <span class='span3'>Password: </span>
          </div>

          <div id='registerform3'>
            <input type='text' id='login' name='login'>
            <input type='password' id='password1' name='password1'>
            <input type='password' id='password2' name='password2'>
            <button class='button1' type='submit' onclick='registerScript()'>Register</button>
          </div>
        </div>";

				require('./config.php');

				if (isset($_POST['login']) && isset($_POST['password1']) && isset($_POST['password2'])) {
					if (($_POST['login'] != "") && ($_POST['password1'] != "") && ($_POST['password2'] != "")){
						$login = $_POST['login'];
						$password1 = $_POST['password1'];
						$password2 = $_POST['password2'];

						$returnQuery=mysqli_query($connection, "SELECT * FROM $dbprefix"."users WHERE login='$login'");

						if ($returnQuery->num_rows != 0)  echo "<h1 style='color: red'>Someone already has such a login.</h1>";
						else{
						 if ($password1 == $password2){
							 if (strlen($password1) >= 8){
								 $password_encrypted = password_hash($password1, PASSWORD_DEFAULT);
								 mysqli_query($connection, "INSERT INTO $dbprefix"."users VALUES('', '$login', '$password_encrypted')");
								 mysqli_query($connection, "INSERT INTO $dbprefix"."ranks VALUES('$login', 'user')");
								 echo "<h1 style='color: lime'>Successfully registered!</h1>";

							 } else echo "<h1 style='color: red'>The password must be at least 8 characters long.</h1>";
						 } else  echo "<h1 style='color: red'>Passwords are not correct, check it.</h1>";
					 }
				 } else echo "<h1 style='color: red'>Fill in all fields!</h1>";
			 }
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

	  		mysqli_select_db($connection, $dbname);

	  		$query = "SELECT * FROM $dbprefix"."articles";
	  		$result = mysqli_query($connection, $query);

	  		while($row = mysqli_fetch_array($result)){
	  			$title=$row["title"];
	  			$content=$row["content"];

	  			echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
	  		}

	  		mysqli_close($connection);
  ?>
