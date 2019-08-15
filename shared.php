<?php
	// use "require 'shared.php'"
	function getQuery($connect, $command)
        {
                $result = $connect->query($command);
                if ($result === FALSE)
                	die('Connection failed when trying to query command: ' . $connect->connect_error);
		return $result;
        }

	function checkCookie($connect)
       	{
		if (!isset($_COOKIE['user']))
			return FALSE;
                $cookie = htmlentities($_COOKIE['user']);
	        return mysqli_num_rows(getQuery($connect, "SELECT nonce FROM theUserKyle where nonce = '$cookie'")) == 1;
        }

	function makeCon($domain, $username, $password, $db)
	{
		$connect = new mysqli($domain, $username, $password, $db);
		if ($connect->connect_error)
               		die('Connection failed: ' . $connect->connect_error);
		return $connect;
	}

	function isUser($connect, $username)
        {
                $command = "SELECT username, password FROM theUserKyle WHERE username = '$username'";
        	return mysqli_num_rows(getQuery($connect, $command)) == 1;
        }

	function isUserPass($connect, $username, $password)
        {
                $command = "SELECT username, password FROM theUserKyle WHERE (username = '$username') and (password = '$password')";
       		return mysqli_num_rows(getQuery($connect, $command)) == 1;
        }

        function nonceGen($connect, $username)
       	{
                $nonce = rand(10000, 99999);
                getQuery($connect, "UPDATE theUserKyle SET nonce = '$nonce' WHERE username = '$username'");
        	return $nonce;
        }

	function uploadFile($connect, $filename, $filetype, $filetmp)
        {
                $data = addslashes(fread(fopen($filetmp, 'r'), filesize($filetmp)));
                fclose(fopen($filetmp, 'r'));
                getQuery($connect, "INSERT INTO filesKyle (title, content_type, data) VALUES ('$filename', '$filetype', '$data')");
        }

        function findErrors($connect, $filename, $filetype, $filetmp, $filesize)
        {
                $errors = array();
                if ($filename == null)
                        $errors[] = 'File name cannot be null.<br>';
                if (mysqli_num_rows(getQuery($connect, "SELECT title FROM filesKyle WHERE title = '$filename'")) > 0)
                        $errors[] = 'This file or file name has already been used.<br>';
                if (($filesize > 4294967295) or ($filesize == null))
                        $errors[] = 'Invalid file size.<br>';
                if (!(($filetype == 'image/jpeg') or ($filetype == 'audio/mp3')))
                        $errors[] = 'Invalid file type. Must be mpeg or jpeg.<br>';
                return $errors;
        }

	function makeTable($connect)
        {
                $result = getQuery($connect, "SELECT title, content_type FROM filesKyle");
                if (mysqli_num_rows($result) > 0)
                {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                                $title = $row['title'];
                                print '<tr><td><a href = "showfilepage.php?title=' . $title . '">' . $title . '</a></td>';
                                print '<td>' . $row['content_type'] . '</td>';
                                print '<td><a href = "deletefilepage.php?title=' . $title . '">Delete File</a></b></td></tr>';
                        }
                }
                else
                        die('No files in database.');
        }
?>
