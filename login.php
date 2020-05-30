<?php
//require_once ('./inc/connect.inc.php');
include ('./inc/header.inc.php');

//include ($DIR.'/class/classgetter/classGetter.php');
include ('./inc/textfilter.php');

?>


<?php
$_SESSION['error'] = "";


$_SESSION['username']= $_POST['user_login'];
$_SESSION['email'] = $_POST['user_email'];



$user_email = strip_tags(@$_POST["user_email"]);

$user_login = strip_tags(@$_POST["user_login"]);

$password_login = strip_tags(@$_POST["password_login"]);

echo "$user_email<br>";

if(isset($user_login) && isset($password_login))
{
  if(isset($user_email))
  {

    $query_email = "SELECT email FROM users WHERE BINARY email = '$user_email' LIMIT 1";
    $email_query_execute = mysqli_query($conn,$query_email);

    $email_count = mysqli_num_rows($email_query_execute);


    if($email_count === 0)
    {
        $_SESSION['error'] = "<br>Incorrect email.";
       header("location: login_page.php");
        // die('email incorect');


    }

    while ($row = mysqli_fetch_array($email_query_execute)) {
      $email = $row["email"];
      echo "$email";

      # code...
    }
    if($user_email != $email)
    {

          $_SESSION['error'] = "<br>Incorrect email.";
          header("location: login_page.php");
          die();

    }
    mysqli_free_result($email_query_execute);
  }


  // $user_login = preg_replace('#[^A-Za-z0-9]#i', '', $user_login);//filter anything but numbers and letters
  //   $password_login = preg_replace('#[^A-Za-z0-9]#i', '', $password_login);
// echo $user_login.'<br>';
//
//     echo '<br>';
// die($password_encrypted);
// die("<br>username is $username"."isok");
$query = "SELECT user_id, password FROM users WHERE BINARY username = ? LIMIT 1";//query check for user existence
$stmt = $conn -> stmt_init();
if($stmt -> prepare($query))
{
  $stmt -> bind_param('s',$user_login);
  $stmt -> execute();
  $stmt -> bind_result($id, $stored_password_encrypted);

  $stmt -> store_result();
}
else{
  echo "string";
  $error = $stmt -> error;
  die("$error");
}
// $lol = mysqli_query($conn,$query);
// $user_count = mysqli_num_rows($lol);//count the number of rows returned;

while ( $stmt -> fetch()) {


  # code...
}
// die("$id");
if (password_verify($password_login,$stored_password_encrypted))
{

header("location: phpSessionRegeneratingPage.php");
  exit();

  }

// $username = $_SESSION['username'];
  //$_SESSION["user_login"] = $user_login;



 else
 {
   // die("$id");
   $_SESSION['error'] = "<br><br>Username or password is incorrect." ;
header("Location: login_page.php");

 }
}

mysqli_close($conn);




?>
