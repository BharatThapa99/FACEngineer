
<?php
ini_set('display_errors','1');


// DEFINE("DIR","/var/www/html/project/");
// define('DIR', '/var/www/html/project');
$DIR = "/var/www/html/project/";

$servername = "localhost";
$username = "bharat";
$password = "ProGrammEr99";
$dbname = "members";

$date = date('Y-m-d');

try {
  $conn = new mysqli($servername, $username, $password, $dbname);
  mysqli_set_charset($conn,'utf8');

} catch (Exception $e) {


  echo "An exception occured MESSAGE: ". $e -> getMessage();
  echo"<br>The system is busy please try again later";

}
 catch (Error $e)
 {
   echo "An error occured: MESSAGE: ".$e -> getMessage();
   echo "<br>The system is busy please try again later";
 }
// $conn = mysqli_connect($servername, $username, $password, $dbname);


// if(!$conn)
// {
//   die("connection failed: ". mysqli_connect_error());
// }
// $con = new mysqli("localhost","root","","test") ;

// if($con -> connect_errno > 0)
// {
// 	die('unable  to connect '. $con -> connect_errno);
// }
// else {
// 	echo "Connected to sql server and database named test.";
// }

?>
