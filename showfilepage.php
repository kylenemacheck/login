<?php
	require 'shared.php';
	@$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
        if (!checkCookie($connect))
                header("Location: loginpage.php");
	else
	{
		$title = htmlentities($_GET['title']);
		$contenttype = mysqli_fetch_assoc(getQuery($connect, "SELECT content_type FROM filesKyle WHERE title = '$title'"))['content_type'];
		header("Content-type: $contenttype");
		echo mysqli_fetch_assoc(getQuery($connect, "SELECT data FROM filesKyle WHERE title = '$title'"))['data'];
	}
?>
