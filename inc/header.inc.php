<?php
$DIR = "/var/www/html/project/";
// include ($DIR.'/class/classgetter/classGetter.php');

include 'inc/Autoloader.inc.php';
$date = date('Y-m-d');


//include ($DIR.'/inc/connect.inc.php');

$dbconnect1 = new databaseConnect("members","localhost","bharat","ProGrammEr99");
$conn = $dbconnect1 -> connectDb();
session_start();
$active_stats = 0;
//if the session variable is not created then do nothhing else if session variable is
//created then assign the username entered from login form to $username
if(!isset($_SESSION["username"]))
{
header($DIR.'login_page.php');

}else
{
	$username = $_SESSION["username"];
	$_SESSION["active_stats"] = 1;
	$active_stats = $_SESSION['active_stats'];

	$queryMyDetails = "SELECT user_id,first_name, last_name FROM users WHERE username = ?";
	$stmtmydetails  = $conn -> stmt_init();
	if($stmtmydetails -> prepare($queryMyDetails))
	{
		$stmtmydetails -> bind_param('s',$username);
		$stmtmydetails -> execute();
		$stmtmydetails -> bind_result($myuserid,$myfirstname, $mylastname);
		$stmtmydetails -> store_result();


	}

	else {
		$details_error = $stmtmydetails -> error;
		die("$details_error");
	}
	while($stmtmydetails -> fetch())
	{


	}


	// echo "$myuserid $username";
    //header("location: home.php");
}
?>
