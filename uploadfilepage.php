<?php
	require 'shared.php';
	@$connect = makeCon('localhost', 'student', 'fredfredburger', 'student');
        if (!checkCookie($connect))
                header("Location: loginpage.php");
        else
        {
		$msg = '';
		$errors = array();
                if(isset($_REQUEST['submit']))
                {
                        $filename = htmlentities($_FILES['file']['name']);
                        $filesize = htmlentities($_FILES['file']['size']);
                        $filetmp = htmlentities($_FILES['file']['tmp_name']);
                        $filetype = htmlentities($_FILES['file']['type']);
			$errors = findErrors($connect, $filename, $filetype, $filetmp, $filesize);
                        if (!$errors)
			{
	                    	uploadFile($connect, $filename, $filetype, $filetmp);
				$msg = 'Successfully uploaded <b>' . $filename . '</b>!';
			}
                }
?>
<html>
	<body style = "text-align: center">
		<div>
                        <form action = "logoutpage.php">
                                <button style = "float: left" type = "submit">Logout</button>
                        </form>
                        <form action = "protectedpage.php">
                                <button style = "float: right" type = "submit">Users Page</button>
			</form>
                </div>
		<form action = "" method = "POST" enctype = "multipart/form-data">
			<input type = "file" name = "file">
			<button type = "submit" name = "submit">Submit</button>
		</form>
		<p>
			<?php
				foreach($errors as &$a)
					print $a;
				print $msg;
			?>
		</p>
	</body>
</html>
<?php } ?>
