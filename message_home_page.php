<?php
ini_set('display_errors','1');
//here is not use of u variable
//include ('./inc/connect.inc.php');
include ('./inc/header.inc.php');
//for d

include ('./inc/menu.inc.php');
include ('./inc/textfilter.php');
include ("./inc/loggedInUserDetails.php");


include ("./functions/getFriendslist.php");
include ("./functions/time_elapsed.php");


 ?>

<?php
$queryMsgNotification = "SELECT sender, reciever, date_sent, time_sent FROM messages WHERE reciever = ? ORDER BY msg_id DESC";
$queryMsgNotificationstmt = $conn -> stmt_init();
if($queryMsgNotificationstmt -> prepare($queryMsgNotification))
{
  $queryMsgNotificationstmt -> bind_param('s',$username);
  $queryMsgNotificationstmt -> execute();
  $queryMsgNotificationstmt -> bind_result($senderNoti, $reciverNoti, $date_sent_noti, $time_sent_noti);
  // $queryMsgNotificationstmt -> store_result();
  $numOfMsg = $queryMsgNotificationstmt -> num_rows;

}


else {
  $msgnotierror = $queryMsgNotificationstmt -> error;
  die("$msgnotierror");
}

 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Messages</title>
   </head>
   <body>
     <br>
     <h3>You have <?=$numOfMsg ?> messages.</h3>
     <?php
     $numOfMsg = 0;
     $senderrepetitionCheck = "";

     // $arr = $queryMsgNotificationstmt -> fetch();
      while($queryMsgNotificationstmt -> fetch())
      {
// print_r($senderNoti);
if($senderrepetitionCheck == $senderNoti)
{
  continue;
}
$numOfMsg += 1;

$daysMessagedAgo = time_elapsed($date_sent_noti);

       ?>


     <p><a href="message_specific_person.php?u=<?=$senderNoti ?>"><?=$senderNoti ?> </a> messaged you on <?=$date_sent_noti." at ".$time_sent_noti." --- ".$daysMessagedAgo ?></p>

   <?php
   $senderrepetitionCheck = $senderNoti;
        }
    $queryMsgNotificationstmt -> free_result();
    ?>


   </body>
 </html>
