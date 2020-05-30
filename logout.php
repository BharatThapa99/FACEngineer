<?php
session_start();
 include ('./inc/activeStatus.inc.php');
$active_stats = 0;
unset($_SESSION['username']);
unset($_SESSION['active_stats']);
unset($_SESSION['email']);
unset($_SESSION['error']);

if(isset($_COOKIE[session_name()]))
{
  setcookie(session_name,"",time()-86400,'/');
}
session_destroy();
header("Location: login_page.php");

?>
