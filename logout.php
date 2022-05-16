<?php
session_start();
if (isset($_SESSION['authorized'])){
session_unset();
session_destroy();
unset($_COOKIE['logged']);
unset($_COOKIE['login']);
setcookie('logged', '', time() - 3600);
setcookie('login', '', time() - 3600);
session_start();

	echo "<span class='font2' style='color: #696969; text-transform: uppercase; margin-left: 40px'>Rust Forum</span><br>
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
		echo '~';
			require('./config.php');

			mysqli_select_db($connection, $dbname);

  		$query = "SELECT * FROM $dbprefix"."articles WHERE category='general'";
  		$result = mysqli_query($connection, $query);

  		while($row = mysqli_fetch_array($result)){
  			$title=$row["title"];
  			$content=$row["content"];

  			echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
  		}

  		mysqli_close($connection);
		} else echo "<h1 style='color: red; font-family: Impact'>You can't step like that!</h1><h2 style='color: red; font-family: Calibri'>There is nothing here...</h2>";
  ?>
