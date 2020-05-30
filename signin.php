<?php
ini_set('display_errors','1');
//here is no use of u variable

include('./inc/header.inc.php');
//include('./inc/connect.inc.php');



?>
<?php

$flag = 1;
$uname = strip_tags(@$_POST["username"]);
$fname = strip_tags(@$_POST["firstname"]);
$lname = strip_tags(@$_POST["lastname"]);
$email = strip_tags(@$_POST["email"]);
$password1 = strip_tags(@$_POST["password"]);
$password2 = strip_tags(@$_POST["password1"]);
$signin = strip_tags(@$_POST['signin']);

//for session session Storage

$_SESSION['signup_username'] = $uname;
$_SESSION['signup_firstname'] = $fname;
$_SESSION['signup_lastname'] = $lname;
$_SESSION['signup_email'] = $email;
$_SESSION['signup_password'] = $password;
$_SESSION['signup_password1'] = $password2;




//create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn)
{
  die("connection failed: ". mysqli_connect_error());
}

//check connection
if($signin){
$u_check =mysqli_query($conn,"SELECT username FROM users WHERE username = '$uname'");
$ucheck = mysqli_num_rows($u_check);
$email_check_query = mysqli_query($conn,"SELECT email FROM users WHERE email = '$email'");
$echeck = mysqli_num_rows($email_check_query);


if($password1 != $password2)
{

    $error[]="password dint match..";
    // die('password dudbt natch');
    header('signup_page.php');

}
if($password1 == $password2)
{
  $flag = 0;

 // $u_check =mysqli_query($conn,"SELECT username FROM users WHERE username = '$uname'");
 // $ucheck = mysqli_num_rows($u_check);
 // $email_check_query = mysqli_query($conn,"SELECT email FROM users WHERE email = '$email'");
 // $echeck = mysqli_num_rows($email_check_query);

}

if($echeck != 0)
{
  $flag = 1;
  $error[] = "<br><br><b>email is already taken</b>";
}

if($ucheck != 0)
{
    $flag = 1;
    $error[] = "username already taken";

}


  if($uname&&$fname && $lname && $email && $password1 && $password2)
  {
    if(strlen($fname) > 25 || strlen($lname) > 25)
    {
      $flag = 1;
      $error[]="The maximum limit for first/last name is 25 characters";
    }


      if(strlen($password1) < 5 || strlen($password1) > 30)
        {
          $flag = 1;
          $error[]="Password must be greater than 5 and less than 30 characters";
        }


  }
  else
  {
    $flag = 1;
    $error[] = "please fill all the fields";

  }



if($flag == 0)
{
  $friends = "";


    $password1 = password_hash($password1,PASSWORD_DEFAULT);
    $sql = " INSERT INTO users(username, first_name, last_name, email, password, registeration_date,friends)
VALUES ('".$uname."','".$fname."','".$lname."','".$email."','".$password1."','$date', '".$friends."')";

if (mysqli_query($conn, $sql))
{
echo "<h2>Congratulation, You are now a member of FACEngineers";
echo "<br><br><b>Do you want to login?<a href='login_page.php'><i><b>Login Now</b></i></b>";
die();
}
else {
echo "Error:".$sql. "<br>".mysqli_error($conn);
}


}
header("location: signup_page.php");

}
//-------------------------------------------------

// User login code

//----------------------------------------------------

// if(isset($_POST["login"])){
//    echo "string";

// $sql = "CREATE TABLE members ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   firstname VARCHAR(30) NOT NULL,
//   lastname VARCHAR(30)  NOT NULL,
//   password VARCHAR(30) NOT NULL,
//   email VARCHAR(50) NOT NULL,
//   login_Date DATETIME NOT NULL)";





mysqli_close($conn);


?>
