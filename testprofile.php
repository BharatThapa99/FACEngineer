<title>
	profile page
</title>
<?php
//include ('./inc/connect.inc.php');
include ('./inc/header.inc.php');


?>

<?php
$firstname="";
$lastname="";
$email="";
$username="";

if (isset($_GET['u'])) {
	$pop = $_GET['u'];
	$username = mysqli_real_escape_string($conn,$pop);

	if (ctype_alnum($username)) {
		//check if user exists
		$query = "SELECT username, first_name, last_name, email FROM users WHERE username = '$username' ";
		$check = mysqli_query($conn,$query);
		if (mysqli_num_rows($check)== 1) {
			$get = mysqli_fetch_assoc($check);
			$username = $get['username'];
			$firstname = $get['first_name'];
			$lastname = $get['last_name'];
			$email = $get['email'];
			# code...
		}
		else
		{
			echo "<b>User does not exist</b>";
			exit();
		}
		# code...
	}
	# code...
}
?>

<b>profile page of <?php echo "$username"; ?></b>
<br>
<br>

<b>First name: <?php echo "$firstname" ;?></b>
<br>
<br>
<b>Last name: <?php echo "$lastname"; ?></b>
<br>
<br>

<b>Email: <?php echo "$email" ;?></b>
