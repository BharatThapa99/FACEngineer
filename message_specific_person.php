
<?php
include ('./friendlist.php');


 ?>



<?php
if($username == $username1)
{
  header('location:message_home_page.php');
  die();
}
$allowSendMsg = 0;//dont send msg on refresh

date_default_timezone_set("Asia/Kathmandu");
//insertng msg to database
if(isset($_POST['type-message'])){
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


}
}
if(isset($_POST['sendMsg']))
{





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



 ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://kit.fontawesome.com/f96113016a.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="./css/style_message.css">
   <link rel="stylesheet" href="./css/style_menu.css">
   <title>FACEngineer</title>
 </head>
 <!-- onclick="menuResponsive()" -->

 <body>

   <!-- #################### AJAX to upload and display post + post_count ################################## -->
   <script type="text/javascript">

       function sendMsg() {
         var hr = new XMLHttpRequest();
         var url = "sendMessage.php?u="+"<?=$username1?>";
         var message = document.getElementById('type-message').value;
         // alert("dmessage");
         // return false;
         // var post_count = document.getElementById('post_count').innerHTML;
         // var num_post_count = Number(post_count);

         // num_post_count += 1;

         // alert(num_post_count);
         // return false;

         document.getElementById("msg_display").innerHTML = "sending...";
         var element = document.getElementById('msg');
         hr.open("POST",url+"&type-message="+message,true);
         hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         hr.onreadystatechange = function()
         {
           if(hr.readyState == 4)
           {
             var return_data = hr.responseText;
             document.getElementById("msg_display").innerHTML = return_data;
             element.scrollIntoView(false);
             // document.getElementById('post_count').innerHTML = num_post_count;
             document.getElementById('type-message').value = "";
             // getElementsByClassName('className')
           }
         }
         hr.send();
       }

   </script>
   <!-- #################### END of AJAX to upload and display post + post_count ################################## -->




   <header>
     <nav>
       <div class="wrapper-btn">
         <div class="menu-btn" id="menu-btn">
           <div class="menu-btn__burger" id="menu-btn__burger"></div>
         </div>
       </div>

       <div class="logo__container">
         <!-- <img src="./assets/logo-tl.png" class="logo"> -->
         <p>FACEngineer.</p>
       </div>
       <div class="search">
         <input type="search" placeholder="Search Friends..">
         <button><i class="fas fa-search"></i></button>
       </div>
       <div class="info">
         <div class="notif">
           <div class="wrapper-dot">
             <div class="dot">
               <p>12</p>
             </div>
           </div>

           <div class="wrapper">
             <div class="alert">
               <i class="far fa-bell"></i>
             </div>

             <div class="d-info-alert">
               <div class="info-alert">
                 <img src="./assets/pp.jpg">
                 <a href="#">Laura following you!</a>
               </div>
             </div>

           </div>
         </div>
         <div class="profile-1">
           <img src="./assets/pp.jpg">
           <div class="dropdown">
             <a href="#" class="nama"><?=$myfirstname." ".$mylastname?></a>
             <div class="dropdown-content">
               <a href="logout.php">Logout</a>
             </div>
           </div>
         </div>
       </div>

     </nav>
   </header>

   <section>
     <aside>
       <div class="profile-2">
         <img src="./assets/pp.jpg">
         <a href="#"><?=$myfirstname." ".$mylastname?></a>
       </div>

       <div class="menu">
         <div class="home" id="ganti">
           <div class="f-w">
             <i class="fas fa-home"></i>
           </div>
           <a href="home.php">Home</a>
         </div>

         <div class="profile">
           <div class="f-w">
             <i class="fas fa-user-alt"></i>
           </div>
           <a href="profile.php?u=<?=$username ?>">Profile</a>
         </div>

         <div class="people">
           <div class="f-w">
             <i class="fas fa-users"></i>
           </div>
           <a href="people.html">People</a>
         </div>

         <div class="message click">
           <div class="f-w">
             <i class="fas fa-comment-dots"></i>
           </div>
           <a href="message.php">Message <div class="click"></div></a>
         </div>
       </div>

       <div class="settings">
         <div class="setting">
           <div class="f-w">
             <i class="fas fa-cog"></i>
           </div>
           <a href="setting.html">Setting</a>
         </div>
       </div>
     </aside>

     <div id="menu-responsive">
       <div class="profile-2">
         <a href=""><img src="./assets/pp.jpg"></a>
       </div>

       <div class="wrapper">
         <div class="menu">
           <div class="home">
             <div class="f-w">
               <a href="timeline.html"><i class="fas fa-home"></i></a>
             </div>
           </div>

           <div class="profile">
             <div class="f-w">
               <a href="profile.html"><i class="fas fa-user-alt"></i></a>
             </div>
           </div>

           <div class="people">
             <div class="f-w">
               <a href="people.html"><i class="fas fa-users"></i></a>
             </div>
           </div>

           <div class="message">
             <div class="f-w">
               <a href="message.html" class="click"><i class="fas fa-comment-dots"></i></a>
             </div>
           </div>
         </div>

         <div class="settings">
           <div class="setting">
             <div class="f-w">
               <a href="setting.html"><i class="fas fa-cog"></i></a>
             </div>
           </div>
         </div>

         <div class="logout">
           <div class="f-w">
             <a href="login.html"><i class="fas fa-sign-out-alt"></i></a>
           </div>
         </div>
       </div>
     </div>
     <!-- END OF NAVBAR -->
     <main>
       <article id="timeline">

         <div class="container-profile-message">
           <div id = 'msg' class="wrapper-message" >
             <div class="sticky-top-message">
               <p>To <span><?="@".$username1 ?></span></p>
             </div>

             <div class="container-message" id = "msg_display">

               <?php
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



        <!-- ####################### FOR SEEN AND NOT SEEN #########################3 -->
         <?php
         // echo "username1 = $username1 and Sender = $senderDisp";


          ?>
          <!-- ####################### END OF FOR SEEN AND NOT SEEN #########################3 -->













             </div>

             <div class="type-message">
               <form class="">

               <textarea name="type-message" id="type-message" cols="30" rows="10"></textarea>
               <input type="button" name = "send"  onclick="sendMsg()" value="send" style = "cursor:pointer;" >

             </form>
             </div>
           </div>
         </div>

       </article>
     </main>


     <article id="friend-list">
       <div class="wrapper-message-profile">
         <div class="container-message-profile">
           <img src="./assets/skate-2.png">
           <div class="bg-color"></div>
           <div class="wrapper-semua">
             <div class="wrapper-img-profile">
               <img src="./assets/pp.jpg">
             </div>
             <div class="nama">
               <p><?php echo "$myfirstname"." "."$mylastname" ?></p>
             </div>
             <div class="message-location">
               <i class="fas fa-map-marker-alt"></i>
               <p>@<?=$username ?></p>
             </div>
           </div>
         </div>


         <div class="container-fl">
           <div class="title-fl">
             <h4>Friend List</h4>
           </div>

           <?php
           foreach ($friendList as $value) {
             // code...

            ?>

           <div class="friend">
             <img src="./assets/pp.jpg">
             <a href="message_specific_person.php?u=<?=$value?>"><?="@".$value ?></a>
           </div>
         <?php }
         $stmt->free_result();
          ?>



         </div>
       </div>
     </article>
   </section>
   <script src="./javascript/show-hide.js"></script>
   <script src="./javascript/burger.js"></script>
 </body>

 </html>
