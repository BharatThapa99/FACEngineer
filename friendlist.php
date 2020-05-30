<?php

ini_set('display_errors','1');

//include ('./inc/connect.inc.php');
include ('./inc/header.inc.php');

// include_once ('./inc/menu.inc.php');
include ('./inc/textfilter.php');
include ('./inc/loggedInUserDetails.php');

include ('./functions/getFriendslist.php');




 ?>


 <?php


   $friendListquery = "SELECT friends FROM users WHERE username = '$username'";
   $friendListExec = mysqli_query($conn,$friendListquery);
   $friendListRow = mysqli_fetch_assoc($friendListExec);
   $friendArray = $friendListRow['friends'];

   if($friendArray != "")
   {
     // echo "<h1>FIne</h1>";

     //gets an array of friends username
     $friendList = getFriendsList($friendArray);

}




  ?>
