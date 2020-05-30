<?php
// include('./inc/textfilter.php');
$firstname="";
$lastname="";
$email="";
$username1="";

date_default_timezone_set("Asia/Kathmandu");

if ($active_stats != 1) {
	die('You must be logged in to view this page::');
	// code...
}

if (isset($_GET['u'])) {
	$pop = filterText($_GET['u']);

	$username1 = $pop;

	if (ctype_alnum($username1)) {
		$username_copy = $username1;
				//check if user exists
		$query = "SELECT `user_id`,`username`, `first_name`, `last_name`, `email` FROM `users` WHERE BINARY `username` = ?";
		$stmt = $conn -> stmt_init();
		if($stmt -> prepare($query))
		{
			$stmt -> bind_param('s',$username1);
			$stmt -> execute();
			$stmt -> bind_result($user_id,$username1,$firstname, $lastname,$email);
			$stmt -> store_result();
			$check = $stmt -> num_rows;
			if($check == 1)
			{
				while($stmt -> fetch())
				{

				}
			}

			else
			{
				echo "<b>User does not exist</b>";
				exit();
			}




		}
		else {
			$error = $stmt -> error;
			echo "$error";
		}


		//
		// $check = mysqli_query($conn,$query);
		// if (mysqli_num_rows($check)== 1) {
		// 	$get = mysqli_fetch_assoc($check);
		//
		// 	$username1 = $get['username'];
		//
		// 	$firstname = $get['first_name'];
		// 	$lastname = $get['last_name'];
		// 	$email = $get['email'];
		// 	# code...
		// }

		# code...
	}
	if($firstname == "")
	{
		die("<b>user does not exist</b>");
	}
	# code...
}
