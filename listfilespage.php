<?php
	require 'shared.php';
	@$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
	if (!checkCookie($connect))
        	header('Location: loginpage.php');
	else
	{
?>
<html>
	<div>
                <form action = "logoutpage.php">
               		<button style = "float: left" type = "submit">Logout</button>
               	</form>
                <form action = "protectedpage.php">
   	             <button style = "float: right" type = "submit">Users Page</button>
        	</form>
        </div>
	<h1 style = "text-align: center">List of files</h1>
	<br>
	<center>
		<table style = "text-align: center">
			<tr>
				<th>File Name</th>
				<th>Content Type</th>
				<th></th>
			</tr>
			<?php
				makeTable($connect);
			?>
		</table>
	</center>
</html>
<?php } ?>
