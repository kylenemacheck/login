<?php
	require 'shared.php';
	@$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
	$nonce = htmlentities($_COOKIE['user']);
	setCookie('user', $nonce, time()-1000);
        getQuery($connect, "UPDATE theUserKyle SET nonce = ' ' WHERE nonce = '$nonce'");
	header("Location: loginpage.php");
?>
