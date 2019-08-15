<?php
	require 'shared.php';
        @$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
        if (!checkCookie($connect))
        	header("Location: loginpage.php");
	else
	{
		$msg = '';
		if (isset($_REQUEST['create']))
		{
	                @$username = htmlentities($_REQUEST['username']);
	                @$password = md5($_REQUEST['password']);
			if (($username == null) or ($password == null))
				$msg = 'You have to enter a Username and Password';
                       	elseif (!isUser($connect, $username))
			{
				getQuery($connect, "INSERT INTO theUserKyle (username, password, nonce) VALUES ('$username', '$password', '')");
                                $msg = 'You are now an user!';
                        }
                        else
				$msg = "The username <b>'$username'</b> already exsits.";
		}
?>
<html>
	<head>
		<title>Create User Page</title>
	</head>
	<body style = "text-align: center">
		<form method = "post" action = "logoutpage.php">
                        <button style = "float: left" type = "submit">Logout</button>
                </form>
		<form method = "post" action = "protectedpage.php">
			<button style = "float: right" type = "submit">User Page</button>
		</form>
		<h1>Create User</h1>
		<form method = "post" autocomplete = "off">
			<h4>What do you want your username to be?</h4>
                        <input type = "text" name = 'username' placeholder = "Enter Username">
			<h4>What do you want your password to be?</h4>
                        <input type = "password" name = 'password' placeholder = "Enter Password">
			<br><br><br>
                        <button type = "submit" name = "create">Create user</button>
                </form>
		<p>
                        <?php echo $msg; ?>
                </p>
	</body>
</html>
<?php } ?>
