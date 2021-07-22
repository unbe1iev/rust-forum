<?php
	session_start();
	require("config.php");

	echo "<br><div id='font2center'><span id='font2'>Rust Forum</span></div>
	<div id='categoriescontainer'>
	<button class='categorybutton' onclick=\"reload('general')\">
					<img class='categoryimage' src='https://files.facepunch.com/f/fi/6?c=cd84f'>
					<div class='forumtitle'>
					Rust General
					</div>
					<div class='forumsubtitle'>
					Anything and everything to do with Rust.
					</div>
	</button>
	<br><br>
	<button class='categorybutton' onclick=\"reload('servers')\">
					<img class='categoryimage' src='https://files.facepunch.com/f/fi/46.d551c'>
					<div class='forumtitle'>
					Servers Discussions
					</div>
					<div class='forumsubtitle'>
					Server talks.
					</div>
	</button>
	<br><br>
	<button class='categorybutton' onclick=\"reload('tips')\">
					<img class='categoryimage' src='https://files.facepunch.com/f/forumicons/7/20171017-130258'>
					<div class='forumtitle'>
					Game Tips
					</div>
					<div class='forumsubtitle'>
					Tutorials and tips to be better.
					</div>
	</button>
	<br><br>
	<button class='categorybutton' onclick=\"reload('help')\">
					<img class='categoryimage' src='https://files.facepunch.com/f/forumicons/39/20171017-130221'>
					<div class='forumtitle'>
					Help me
					</div>
					<div class='forumsubtitle'>
					Needed help with.
					</div>
	</button>
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
		$category = $_GET["category"];

		mysqli_select_db($connection, $dbname);

		$query = "SELECT * FROM $dbprefix"."articles WHERE category='$category'";
		$result = mysqli_query($connection, $query);

		while($row = mysqli_fetch_array($result)){
			$title=$row["title"];
			$content=$row["content"];

			echo "<div class='article'><div class='articletitle'>$title</div><div class='articlecontent1'><div class='articlecontent2'>$content</div></div></div>";
		}

	mysqli_close($connection);
?>
