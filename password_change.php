<?php
//include ('./inc/connect.inc.php');


$servername = "localhost";
$username = "bharat";
$password = "ProGrammEr99";
$dbname = "members";

$conn = mysqli_connect($servername, $username, $password, $dbname);


$password_change = strip_tags(@$_POST['new_password_change']);
$re_password_change = strip_tags(@$_POST['retype_new_password_change']);
$password_change_email =  strip_tags(@$_POST['password_change_email']);

 // die($encrypted_changed_password_re);

  if(isset($password_change_email))
    {
    $query_email_re = "SELECT user_id FROM users WHERE email = '$password_change_email ' LIMIT 1";
    $email_query_execute_re = mysqli_query($conn,$query_email_re);
    $email_count_re = mysqli_num_rows($email_query_execute_re);
    if($email_count_re == 0)
    {
        die("<br><br><b>Incorrect email.</b>");
    }
    else
    {

  while ($row = mysqli_fetch_array($email_query_execute_re))
  {
    $id_re = $row["user_id"];

    }
  }
if (isset($password_change)&& isset($re_password_change))
{
	# code...
	if ($password_change == $re_password_change) {
		# code...
    $password_change = password_hash($password_change,PASSWORD_DEFAULT);
    // echo "$password_change";
			$password_change_query = "UPDATE `users` SET `password` = '$password_change' WHERE `users`.`user_id` = $id_re";
   $execute_password_change_query = mysqli_query($conn,$password_change_query);
echo "<br><b>Passsword Changed. <a href = 'login_page.php'><b>Login</b> ";
	}
	else {
		die('<br><b>password dint matched</b>');
	}

}
}


?>
