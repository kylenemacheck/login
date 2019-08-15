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
                <title>Protected Page</title>
        </head>
        <body>
		<div>
			<form action = "logoutpage.php">
                	        <button style = "float: left" type = "submit">Logout</button>
                	</form>
			<div style = "float: right">
				<form action = "listuserpage.php">
                		        <button type = "submit">List of Users</button>
                		</form>
				<form action = "listfilespage.php">
					<button type = "submit">List of Files</button>
				</form>
				</form>
        			<form action = "createuserpage.php">
					<button type = "submit">Create Account</button>
				</form>
				<form action = "uploadfilepage.php">
					<button type = "submit">Upload a File</button>
				</form>
			</div>
		</div>
		<div style = "text-align: center">
			<img src = "http://uberhumor.com/wp-content/uploads/2010/12/duck-pic.jpg" width = 500 height = 300>
        		<?php
                                $nonce = htmlentities($_COOKIE['user']);
                                $username = mysqli_fetch_assoc(getQuery($connect, "SELECT username FROM theUserKyle WHERE nonce = '$nonce'"))['username'];
                                echo "<br><br>Welcome back <b>" . $username . "</b>!";
                        ?>
		</div>
	</body>
</html>
<?php } ?>
