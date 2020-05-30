<?php
ini_set('display_errors','1');
//here is not use of u variable
//include ('/var/www/html/project/inc/connect.inc.php');
$DIR = '/var/www/html/project';
include ( $DIR."/inc/header.inc.php");
//for d

// include ($DIR.'/inc/menu.inc.php');
include ($DIR.'/inc/textfilter.php');
include ($DIR.'/inc/loggedInUserDetails.php');
include ($DIR.'/functions/getFriendslist.php');



 ?>
 <?php

 // die("$user_id");
  if($active_stats != 1)
  {
    die('You must be logged in to view this page');
  }



  ?>

  <?php
  $name = $_GET['u'];
  // echo "$name";
  $purpose = $_GET['purpose'];
  // echo "$purpose";

  $request_by = $username;
  $request_to = $username1;

  $friendButton = 0;// 0 means request is not sent and you are not friend... 1 means request is sent


  $stmt = $conn -> stmt_init();
  $friendReqList = 'SELECT req_to, req_by FROM friend_requests WHERE req_to = ? && req_by = ?';
  if($stmt -> prepare($friendReqList))
  {
    // die("ok prepare");

    $stmt -> bind_param('ss',$request_to, $request_by);
    $stmt -> execute();
    $stmt -> bind_result($retrievedReqTo,$retrievedReqBy);
    $stmt -> store_result();
  }
  else {
    $error = $stmt -> error;
    die((string)$error);
  }
  while ($stmt -> fetch()) {

    if(isset($retrievedReqBy, $retrievedReqTo))
  {

    if($retrievedReqTo == $request_to && $retrievedReqBy == $request_by)
    {

      $friendButton = 1;
      $addFriendButton = '<input type="submit" name="addfridend" value="Request Sent">';

    }
  }
  }
  $stmt ->free_result();

 if($purpose == "follow")//on clicking add friend button
 {
 if($friendButton != 1)//if request is not sent then...
 {

        $stmt = $conn -> stmt_init();
        $friend_query = 'INSERT INTO friend_requests (req_to, req_by)
        VALUES(?,?)';
        if($stmt-> prepare($friend_query))
        {
          $stmt -> bind_param('ss', $request_to, $request_by);
          $stmt -> execute();
          if ($stmt -> affected_rows > 0) {
            $OK = true;
            // code...
          }
          $stmt ->free_result();

          if(!$OK)
          {
            die('Error inserting data');
          }

        }
        else {
          $stmt -> close;
        }
 }

 }


   ?>

   <?php


     $friendListquery = "SELECT friends FROM users WHERE username = '$username1'";
     $friendListExec = mysqli_query($conn,$friendListquery);
     $friendListRow = mysqli_fetch_assoc($friendListExec);
     $friendArray = $friendListRow['friends'];

     if($friendArray != "")
     {
       // echo "<h1>FIne</h1>";

       $friendList = getFriendsList($friendArray);
       $followersCount = countFollowers($friendArray);

       if($purpose == "remove")
       {

         $remMeFromThatList = str_replace("$username, ", "", $friendArray);
       }

     }
     mysqli_free_result($friendListExec);

     $j = 0;//dont kNOW WHAT IT IS DOING HERE...
     $friendListquery1 = "SELECT friends FROM users WHERE username = '$username'";
     $friendList1Exec = mysqli_query($conn,$friendListquery1);
     $friendList1Row = mysqli_fetch_assoc($friendList1Exec);
     $friendArray1 = $friendList1Row['friends'];

     if($friendArray1 != "")
     {
       // echo "<h1>FIne</h1>";

       $friendList1 = getFriendsList($friendArray1);
       $followersCount1 = countFollowers($friendArray1);

       if($purpose == "remove")
       {

         $remThatFromMyList = str_replace("$username1, ", "", $friendArray1);
       }
     }
     mysqli_free_result($friendList1Exec);

     if($purpose == "remove")
     {
       $friendlistupdatequery = "UPDATE users SET friends = '$remMeFromThatList' WHERE username = '$username1'";
       $friendlistupdatequeryExexute = mysqli_query($conn, $friendlistupdatequery);
       $friendlistupdatequery1 = "UPDATE users SET friends = '$remThatFromMyList' WHERE username = '$username'";
       $friendlistupdatequeryExexute1 = mysqli_query($conn, $friendlistupdatequery1);
       echo 'send request';
       die();
     }

     if($friendButton != 1)//if request is not sent then...
     {
     if($friendArray == "")
     {

       $addFriendButton = '<input type="submit" name="addfriend" value="send Friend req">';

     }
     if(isset($friendList)){
     if(!(in_array("$username",$friendList)))
     {
       $addFriendButton = '<input type="submit" name="addfriend" value="send Friend req" style = "cursor:pointer;">';
     }
     else
     {

       $addFriendButton = '<input type="button" id= "removeFriend" onclick = "remFriend(this);" value=" Remove Friend"  style = "cursor:pointer;">';
       // code...
     }

   }

 }
 ?>
