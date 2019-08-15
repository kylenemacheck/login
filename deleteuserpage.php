<?php
	require 'shared.php';
	@$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
	if (!checkCookie($connect))
        	header("Location: loginpage.php");
	$username = htmlentities($_GET['username']);
	getQuery($connect, "DELETE FROM theUserKyle WHERE username = '$username'");
	header("Location: listuserpage.php");
?>
