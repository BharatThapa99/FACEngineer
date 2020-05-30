<?php
//here is no use of u variable
include ("./inc/header.inc.php");
include ("./inc/activeStatus.inc.php");
include ("./inc/friendRequestsNumbers.inc.php");
include ("./inc/menu.inc.php");

unset($_SESSION['error']);

 ?>
 <title>home</title>
    <link rel="stylesheet" href="css/facengineer.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/styles.css">
 
 <style>
 b {
    color: #fff;
 }
 </style>
<?php
if($active_stats == 1)
{
 //$_SESSION["user_login"] = $user_login;
// if($active_stats == 0)
// {
//   die('You have to login to view this page');
// }
if($username == 'bharat')
{
  header("Location: login_page.php");

	// die('<h3>You are not logged in.</h3>');
}
echo "<br><br><b>Hello, </b>"."<b><i>$username</i></b>";
echo "<br><br><b>Welcome to Beta version of FaceEngineer. Enjoy Nepal's very first social network</b><br><br>";
echo "<a href = \"friendList_page.php\" style =\"text-decoration:none; color: white;\"> See your friend list </a><br>";
echo "<a href = \"friend_request.php\" style =\"text-decoration:none; color: white;\"> Friend Requests( " .$numRows. " )</a><br>";
}
else {
  echo "<script>alert(\"You are not logged in\");</script>";
  header("Location: login_page.php");

}

exit();

?>
