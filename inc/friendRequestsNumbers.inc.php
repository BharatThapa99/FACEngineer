<?php

 ?>


 <?php

 $friendReqQuery = 'SELECT user_id, req_to, req_by FROM friend_requests WHERE req_to = ? ORDER BY user_id DESC';
 $stmt1 = $conn -> stmt_init();
 if($stmt1 -> prepare($friendReqQuery))
 {
   $stmt1 -> bind_param('s', $username);
   $stmt1 -> execute();
   $stmt1 -> bind_result($id, $requests, $requestsFrom);
   $stmt1 -> store_result();
   $numRows = $stmt1 -> num_rows;

 }
 else
 {
   $error = $stmt -> error;
   echo "$error";
 }



  ?>
