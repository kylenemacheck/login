<?php
        require 'shared.php';
	@$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
        if (!checkCookie($connect))
        	header("Location: loginpage.php");
	else
	{
        	$title = htmlentities($_GET['title']);
        	getQuery($connect, "DELETE FROM filesKyle WHERE title = '$title'");
		header("Location: listfilespage.php");
	}
?>
