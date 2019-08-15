<?php
	require 'shared.php';
        @$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
        if (!checkCookie($connect))
        	header("Location: loginpage.php");
	else
	{
?>
<html>
	<head>
                <title>List User Page</title>
        </head>
        <body style = "text-align: center">
                <form action = "logoutpage.php">
                        <button style = "float: left" type = "submit" name = "logout">Logout</button>
                </form>
                <form action = "protectedpage.php">
                        <button style = "float: right" type = "submit" name = "protect">User Page</button>
                </form>
                <h1>List of Users</h1>
        </body>
	<?php
		$result = getQuery($connect, "SELECT username FROM theUserKyle");
    		if (mysqli_num_rows($result) > 0)
		{
			while ($row = mysqli_fetch_assoc($result))
			{
				$thing = $row['username'];
				print 'Username: ' . '<a href = "deleteuserpage.php?username=' . $thing . '">' . $thing . '</a><br>';
			}
		}
		else
			die('No users in database.');
	?>
</html>
<?php } ?>
