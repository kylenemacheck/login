<html>
	 <?php
		require 'shared.php';
		@$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
		$msg = '';
		if (checkCookie($connect))
                        header("Location: protectedpage.php");
		if (isset($_REQUEST['signin']))
		{
			@$username = htmlentities($_REQUEST['username']);
                        @$password = md5($_REQUEST['password']);
                        if (isUserPass($connect, $username, $password))
                        {
                                setCookie('user', nonceGen($connect, $username));
                                header("Location: protectedpage.php");
                        }
			else
				$msg = 'Try again sir.';
       		}
        ?>

	<head>
		<title>Login</title>
	</head>
	<body style = "text-align: center">
		<h1>Login</h1>
                <br>
		<form method = "post" autocomplete = "off">
			<input type = "text" name = "username" placeholder = "Enter Username">
			<br><br>
			<input type = "password" name = "password" placeholder = "Enter Password">
			<br><br>
			<button type = "submit" name = "signin">Sign in</button>
		</form>
		<p>
			<?php echo $msg; ?>
		</p>
	</body>
</html>
