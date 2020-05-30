<?php
ini_set('display_errors','1');
 ?>
<title>Friend Requests</title>
<?php
//include('./inc/connect.inc.php');
include('./inc/header.inc.php');
include('./inc/menu.inc.php');
include('./inc/loggedInUserDetails.php');
include ("./inc/friendRequestsNumbers.inc.php");



 ?>
 <?php
if(isset($notification))
{
  echo "$notification";
}

  ?>

 <?php
 $flag = 0;
// echo "$username";
if(isset($numRows))
{
  if($numRows == 0)
  {
    echo "you have no requests<br>";
  }
  else
  {
  echo "There are $numRows requests </br> ";
  while($stmt1->fetch())
  {


        if(isset($_POST['delete_request'.$requestsFrom]))
        {

          $deleteReqQuery = "DELETE FROM `friend_requests` WHERE `user_id` = '$id'";
          mysqli_query($conn,$deleteReqQuery);
          header('Location: friend_request.php');

        }

    if(isset($_POST['accept_request'.$requestsFrom]))
    {

        $deleteReqQuery = "DELETE FROM `friend_requests` WHERE `user_id` = '$id'";
        mysqli_query($conn,$deleteReqQuery);

    // echo "string";
      // ####################### FOR LOGGEN IN USER ###############################
      $stmt = $conn -> stmt_init();
      $friendReqQuerylist = 'SELECT friends FROM users WHERE username = ?' ;
      if($stmt->prepare($friendReqQuerylist) ){
      $stmt -> bind_param('s', $requests);
      $stmt -> execute();
      $stmt -> bind_result($friend_array);
      $stmt -> store_result();
      while($stmt -> fetch())
      {

      }
      $friendlist_explode = explode(",",$friend_array);
      // echo "$friendlist_explode";
      $friend_list_count = count($friendlist_explode);

      if($friend_array == "")
      {
        // echo "hello";
        $friend_list_count = (int)0;
      }
      // echo $friend_list_count;
    }

    else {
      $error = $stmt -> error;
      echo "$error";
    }

    if($friend_list_count >= 0)
    {
      $friendAddQueryReciever = "UPDATE `users` SET `friends` =  CONCAT(friends,'$requestsFrom, ') WHERE `username` = '$requests'";
      mysqli_query($conn , $friendAddQueryReciever);
    }
    //

    // ####################### END OF FOR LOGGEN IN USER ###############################


    // ####################### FOR REQUEST SENDER ###############################


      $friendReqQuerylistSender = 'SELECT friends FROM users WHERE username = ?' ;
      $stmt = $conn -> stmt_init();

      if($stmt->prepare($friendReqQuerylistSender) )
      {
      $stmt -> bind_param('s', $requestsFrom);
      $stmt -> execute();
      $stmt -> bind_result($friend_array_sender);
      $stmt -> store_result();
      while($stmt -> fetch())
      {

      }
      $friendlistSender_explode = explode(',',$friend_array_sender);
      $friend_list_sender_count = count($friendlistSender_explode);

    //if there are 0 riend of sender then array count should be 0 but returns 1 so to make 0 below code
      if($friend_array_sender == "")
      {
        // echo "hello";
        $friend_list_sender_count = (int)0;
      }
      // echo $friend_list_sender_count;

      if($friend_list_sender_count >= 0)
      {
        $friendAddQuerySender = "UPDATE `users` SET `friends` =  CONCAT(friends,'$requests, ') WHERE `username` = '$requestsFrom'";
        mysqli_query($conn , $friendAddQuerySender);

      }
    }

    else {
      $error = $stmt -> error;
      echo "$error";
    }


    // ####################### FOR LOGGEN IN USER ###############################

     // echo "<p>You and @$requestsFrom are now friends</p>";
     $flag = 1;
    }





        echo "<form action = \"friend_request.php\" method = \"POST\">";
        if($flag == 1)
        {
          $notification = "<br> @$requestsFrom and you are friends now&nbsp";
          //To clear all fetched details to make it ready for another loop
          header('Location: friend_request.php');
        }
        else {
          // code...
          echo "<br> @$requestsFrom sent you a friend request &nbsp";
          echo "<input type = \"submit\" name = \"accept_request$requestsFrom\" value = \"Accept\">";
          echo "<input type = \"submit\" name = \"delete_request$requestsFrom\" value = \"Delete\">";

        }

    echo "</form>";

  }
  $stmt1 -> free_result();//To clear all fetched details to make it ready for another loop


}
}

  ?>
