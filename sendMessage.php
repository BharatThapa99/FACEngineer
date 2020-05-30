<?php

ini_set('display_errors','1');


?>
<?php
//include ("./inc/connect.inc.php");
include ("./inc/header.inc.php");
include ("./inc/textfilter.php");
include ("./inc/loggedInUserDetails.php");
date_default_timezone_set("Asia/Kathmandu");



 ?>

 <?php
 // echo "1 $username 2 $username1";
 if($username == $username1)
 {
   header('location:message_home_page.php');
   die();
 }
 $allowSendMsg = 0;//dont send msg on refresh

 // date_default_timezone_set("Asia/Kathmandu");
 //insertng msg to database
 if(isset($_GET['type-message'])){
   // echo "You son of a bitch i am in...";
 if($_GET['type-message'] == "")
 {
   $msgerror = "message cant be empty";
   die("$msgerror");
 }
 else {
   $msg = filterText($_GET['type-message']);
   $sender = $username;
   $reciver = $username1;
   $date_sent = date("y-m-d");
   $time_sent = date("h:i:sa");
   $is_seen = 0;

   echo "You son of a bitch i am in...";




     $query = "INSERT INTO messages (msg, sender, reciever, date_sent, time_sent, seen)
                 VALUES (?,?,?,?,?,?)";

     $stmtmsg = $conn -> stmt_init();
     if($stmtmsg -> prepare($query))
     {
       $stmtmsg -> bind_param('sssssd',$msg,$sender,$reciver,$date_sent,$time_sent,$is_seen);
       $stmtmsg -> execute();
     }
     else {
       $sendmsgerror = $stmt -> error;
       die("$sendmsgerror");
     }







 }
 }

?>
<?php
//##########################################
//############# TO DISPLAY MESSAGE WITH AJAX//

//############################# PHP CODE TO DISPLAY SENT MSG #############################

$queryRetrievemsg = "SELECT msg, sender, reciever, date_sent, time_sent, seen FROM messages WHERE  reciever = ? || sender = ? ORDER BY msg_id ASC";
$stmtRetrieveMsg = $conn -> stmt_init();
if($stmtRetrieveMsg -> prepare($queryRetrievemsg))
{
$stmtRetrieveMsg -> bind_param('ss',$username1,$username1);
$stmtRetrieveMsg -> execute();
$stmtRetrieveMsg -> bind_result($msgDisp,$senderDisp,$reciverDisp, $date_sent_Disp,$time_sent_Disp, $seen);
$stmtRetrieveMsg -> store_result();
$numOfMsg = $stmtRetrieveMsg -> num_rows;

}
else {
$errorRetrieveMsg = $stmtRetrieveMsg -> error;
die("$errorRetrieveMsg");
}
while($stmtRetrieveMsg -> fetch())
{
if($username1 == $senderDisp)
{
// echo "working";
$seenUpdateQuery = "UPDATE `messages` SET `seen` = '1' WHERE `sender` = ? && `reciever` = ?";
$seenUpdateQuerystmt = $conn -> stmt_init();
$seenUpdateQuerystmt -> prepare($seenUpdateQuery);
$seenUpdateQuerystmt  -> bind_param('ss',$username1,$username);
$seenUpdateQuerystmt  -> execute();
$seenUpdateQuerystmt -> free_result();
}
if($senderDisp == $username)//if i am the sender display the msg in right
{ ?>

<div class="box-message-2">
<div class="box-text">


<p><?=$msgDisp?></p>
<p class="waktu"><?php if($seen != 0){ echo "seen ";} ?><?=$date_sent_Disp." ".$time_sent_Disp?></p>
</div>
<div class="box-img">
<img src="./assets/pp.jpg">
</div>
</div>
</div>
<?php }
if($reciverDisp == $username)//if i am the reciever display msg in left
{ ?>

<div class="box-message-1">
<div class="box-img">
 <img src="./css/bg1.jpg">
</div>
<div class="box-text">
 <p><?=$msgDisp?></p>
 <p class="waktu"><?=$date_sent_Disp." ".$time_sent_Disp?></p>
</div>
</div>
<?php }
}//THIS IS THE CLOSING OF WHILE LOOP
?>
<!-- //############################# END OF PHP CODE TO DISPLAY SENT MSG ############################# -->
