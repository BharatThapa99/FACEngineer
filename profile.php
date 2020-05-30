<?php
ini_set('display_errors','1');

include './inc/menu.inc.php';
include './inc/includeAllFiles.inc.php';
 ?>
 <?php
 // die("$user_id");
  if($active_stats !== 1)
  {
    die('You must be logged in to view this page');
  }



  ?>
  <?php

  if(isset($_POST['sendMsg1']))
  {
    header("location: message_specific_person.php?u=$username1");
  }

  date_default_timezone_set("Asia/Kathmandu");
  $user_posted_to = "";
  $row = 1;
  $user_post = "SELECT * FROM posts WHERE user_posted_to = '$username1' ORDER BY id ASC LIMIT 100";
  $user_post_query = mysqli_query($conn,$user_post);
  if($user_post_query)
  {


    $i = 0;
    while ($row = mysqli_fetch_assoc($user_post_query))
     {
       $i = $i + 1;
    $post_id = $row['id'];



    $body = filterText($row['body']);

    $date_added = $row['date_added'];
    $time_added = $row['time_added'];
    $added_by = $row['added_by'];
    $user_posted_to = $row['user_posted_to'];
  //      echo "<div class = 'posted_by'><br><a style = \"border-bottom:none;\" href='profile.php?u=$added_by'>@$added_by</a>- $date_added  -$time_added</div>&nbsp;&nbsp;$body <br> <br><hr><br>";
  // echo "$net_upvotes<br>";

// echo "$net_upvotes";
      }

      }

// die();

   ?>
   <?php //die("d $net_upvotes") ?>

<!-- ######################################################
##########  PHP SCRIPT FOR FRIEND REQUEST       ######
##########        SYSTEM                        ######
##########                                      ######
######################################################
-->
   <?php

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
     die("$error");
   }
   while ($stmt -> fetch()) {
     // code..
     // die("ok while");

     if(isset($retrievedReqBy) && isset($retrievedReqTo))
   {

     if($retrievedReqTo == $request_to && $retrievedReqBy == $request_by)
     {
       // die("ok");
       $friendButton = 1;
       $addFriendButton = "<input type=\"submit\" name=\"addfridend\" value=\"Request Sent\">";

     }
   }
   }
   $stmt ->free_result();
    // die("$retrievedReqBy is by and $retrievedReqTo is to and $request_to is to and $request_by is by");



      // $stmt -> free_result();
// }
// else {
//  //
// }




     // if(isset($_POST['addfriend']))
     // {
if(isset($_POST['addfriend']))//on cliking add friend button
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
             die("Error inserting data");
           }

         }
         else {
           $stmt -> close;
         }
}

}

// die("$friendButton");

   //A FUNCTION THAT DISPLAYS THE ONE NAME AND OTHERS FOR EG @ALA AND 32 OTHERS..THIS IS FOR UPVOTE AND RESPECT
    ?>

  <!--
    ######################################################
    ##########  PHP SCRIPT FOR FRIEND REQUEST       ######
    ##########        SYSTEM  ENDS                  ######
    ##########                                      ######
    ######################################################
    -->

<!-------------------------------------------------------------------------------------------------------------->


<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">

<head>
  <!-- /*! Author: Efranelas | MIT License | github.com/efranelas/facebook-clone | twitter.com/efranelas */-->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" href="https://facebook.com/favicon.ico" />

  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="facebook, clone, efranelas, source, code, layout, download" />
  <meta name="description" content="A Facebook Clone - Facebook layout-like page for experience testing." />
  <meta name="author" content="efranelas" />
  <meta name="designer" content="efranelas" />
  <meta name="language" content="en" />
  <!-- opengraph -->
  <meta property="og:title" content="Facebook Clone (by @Efranelas)">
  <meta property="og:description" content="A Facebook Clone layout source code by Efranelas.">
  <meta property="og:image" content="https://efranelas.github.io/facebook-clone/img/splash.png">
  <meta property="og:image:width" content="1280">
  <meta property="og:image:height" content="720">
  <meta property="og:image:type" content="image/png">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="en_US">
  <meta property="og:site_name" content="Facebook Clone (by @efranelas)">
  <meta property="og:url" content="https://efranelas.github.io/facebook-clone/index.html">
  <!-- twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="Facebook Clone by Efranelas">
  <meta property="twitter:description" content="A Facebook Clone layout source code by Efranelas.">
  <meta property="twitter:image" content="https://efranelas.github.io/facebook-clone/img/splash.png">
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/icofont/icofont.min.css" />
  <!-- <link rel="stylesheet" href=".css/icofont/icofont.css" /> -->
  <link rel="stylesheet" href="./css/original_fb_clone_profile_style.css" />
    <link rel="stylesheet" href="./comments.css">


    <title>Profile Page</title>
</head>

<body>
<!-- ###############################
     ## Top menu with logo and    ##
     ## search button etc         ##
     ###############################

-->
  <header>
    <div class="container">
      <div class="inline logo-container">
        <a href="/" class="inline block logo">f</a>
      </div>
      <div class="inline nav-form-container">
        <form action="search.php" method="POST" class="nav_form">
          <input class="nav_search_box" type="text" value="" placeholder="Search..." />
          <button class="block nav_submit" type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
      <div class="inline nav_buttons">
        <i class="y-divisor"></i>

        <a href="#" class="button user"><i class="user-icon"></i> Efranelas</a>
        <a href="#" class="button">Home</a>

        <i class="y-divisor"></i>
      </div>
      <div class="inline nav_right_menu">
        <div class="menu-container">
          <i class="dropdown-collapser fa fa-bars block" id="dropdown-button"></i>
          <div id="menu-dropdown">
            <a href="#mygroups">Your Groups</a>
            <div class="h-divisor"></div>
            <a href="#ads">Advertising on Efranelas</a>
            <div class="h-divisor"></div>
            <a href="#log">Activity Log</a>
            <a href="#settings/feed">News Feed Preferences</a>
            <a href="#settings">Settings</a>
            <a href="#logout">Log Out</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- ######################################
       ## END OF Top menu with logo and    ##
       ## search button etc                ##
       ######################################

  -->

  <section class="profile">
    <div class="container">

      <div class="profile-header"><!-- THIS WILL COVER UPTO OUR FOLLOWERS FOLLOWING PANEL -->

        <div class="profile-cover"><!-- THIS IS DIVISION FOR OUR COVER PICTURE -->

          <!-- THIS DIVISION IS FOR TO DISPLAY AUTHOR OF COVER PIC

          WE DONT NEED THIS -->
          <div class="cover-author">Photo by <a target="_blank" href="https://unsplash.com/photos/Ny0C6Iwou40">Lance Asper</a> on Unsplash</div>

          <img class="cover-image" src="img/mybg.jpg" /><!-- COVER picture -->
          <!-- Little shade to make username more readable in the background (cover image) -->
          <div class="cover-shade"></div>
        </div>
<!-- ###########PROFILE PICTURE BLOCK ########### -->
        <div class="profile-thumbnail">
          <div class="thumbnail-mask">
            <div class="profile-picture">
              <a href="#" title="Profile Picture" alt="Efranelas's Profile Picture">
                <img src="img/user-picture-3.jpg" class="profile-picture" width="160px" />
              </a>
            </div>
          </div>
        </div>
        <!-- #########  END OF PROFILE PICTURE BLOCK###########-->


<!-- #########  FOR NAME ###########-->
        <div class="profile-names">
          <a href="#"><?php echo "$firstname $lastname";  ?></a>
<!-- #######  FOR USERNAME#########-->
          <a href="#" class="secondary">  <?php echo "<p>@$username1</p>";?></a>
        </div>


        <!-- profile-tabs -->
        <div class="profile-navbar" style="height: 100px;">
          <div class="container">
            <!-- <a href="#" class="active">Timeline</a>
            <a href="#">About</a>
            <a href="#">Friends</a>
            <a href="#">Photos</a>
            <a href="#">More <i class="fa fa-caret-down"></i></a> -->

            <!--block of info section end-->

             <!--block of profile menues like Follower etc section starts-->
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

                 if(isset($_POST['remfriend']))
                 {

                   $remMeFromThatList = str_replace("$username, ", "", $friendArray);
                 }


                 // $friendArray = explode(", ",$friendArray);
                 // $countFriendArray = count($friendArray);
                 // $countFriendArray -= 1;
                 // $friendList = array_slice($friendArray,0,$countFriendArray);
                 //


                 // echo "username1 is $username1";
                 //   print_r($friendList);
                 // die();
                 // $test = in_array($username,$friendList);
                 // echo "<h1>$test</h1>";
                 // die();
               }
               mysqli_free_result($friendListExec);

               $j = 0;//dont kNOW WAHT IT IS DOING HERE...
               $friendListquery1 = "SELECT friends FROM users WHERE username = '$username'";
               $friendList1Exec = mysqli_query($conn,$friendListquery1);
               $friendList1Row = mysqli_fetch_assoc($friendList1Exec);
               $friendArray1 = $friendList1Row['friends'];

               if($friendArray1 != "")
               {
                 // echo "<h1>FIne</h1>";

                 $friendList1 = getFriendsList($friendArray1);
                 $followersCount1 = countFollowers($friendArray1);

                 if(isset($_POST['remfriend']))
                 {

                   $remThatFromMyList = str_replace("$username1, ", "", $friendArray1);
                 }
               }
               mysqli_free_result($friendList1Exec);

               if(isset($_POST['remfriend']))
               {
                 $friendlistupdatequery = "UPDATE users SET friends = '$remMeFromThatList' WHERE username = '$username1'";
                 $friendlistupdatequeryExexute = mysqli_query($conn, $friendlistupdatequery);
                 $friendlistupdatequery1 = "UPDATE users SET friends = '$remThatFromMyList' WHERE username = '$username'";
                 $friendlistupdatequeryExexute1 = mysqli_query($conn, $friendlistupdatequery1);
               }


               // if(isset($_POST['remfriend']))
               // {
               //     array_search($)
               //
               //           // $deleteReqQuery = "DELETE FROM `friend_requests` WHERE `user_id` = '$id'";
               //           // mysqli_query($conn,$deleteReqQuery);
               //           // header("Location: profile.php?u=$username1");
               //
               //
               // }

//#####################FOR FOLLOWING COUNT IN PROGRESS ###########################################
                    // $friendListquery1 = "SELECT friends FROM users WHERE username = '$username'";
                    // $friendListExec1 = mysqli_query($conn,$friendListquery1);
                    // $friendListRow1 = mysqli_fetch_assoc($friendListExec1);
                    // $friendArray1 = $friendListRow1['friends'];
                    // print_r($friendArray1);
                    // die();
                    //
                    // if($friendArray1 != "")
                    // {
                    //   // echo "<h1>FIne</h1>";
                    //
                    //   $friendList1 = getFriendsList($friendArray1);
                    //   $followingCount = countFollowers($friendArray1);
                    //
                    // }
  //##################### END FOR FOLLOWING COUNT IN PROGRESS ###########################################



               if($friendButton != 1)//if request is not sent then...
               {
               if($friendArray == "")
               {

                 $addFriendButton = "<input type=\"submit\" name=\"addfriend\" value=\"send Friend req\">";

               }
               if(isset($friendList)){
               if(!(in_array("$username",$friendList)))
               {
                 $addFriendButton = "<input type=\"button\" id=\"followtheperson\" onclick=\"follow(this);\" value=\"send Friend req\" style = \"cursor:pointer;\">";
               }
               else
               {

                 $addFriendButton = "<input type=\"button\" id= \"removeFriend\" onclick = \"remFriend(this);\" value=\" Remove Friend\"  style = \"cursor:pointer;\">";
                 // code...
               }

             }

           }
           ?>
           <script type="text/javascript">
           function remFriend(remFriendId)
           {
             var id = remFriendId.id;
             var removeFriendButton = document.getElementById(id);
             // removeFriendButton.value = "Send Request";
             var purpose = "remove";


             //AJAX FOR REMOVING Friend
             var url = "./AJAX/requests/friendAddRemoveRequest.php?u="+"<?=$username1?>";
             if(window.XMLHttpRequest)
             {
               var xmlhttp = new XMLHttpRequest();

             }
             else {
               var xmlhttp = new ActiveXObject("Microsoft.XMLHttpRequest");
             }
             xmlhttp.open("POST",url+"&purpose=remove",true);
             xmlhttp.onreadystatechange = function()
             {
               if(this.readyState == 4 && this.status == 200)
               {
                 // alert(id);
                 var return_data = xmlhttp.responseText;
                 removeFriendButton.value = "Follow";

               }
             }
             xmlhttp.send();
           }

           function follow(followtoId)
           {
            var id = followtoId.id;
            var followthepersonButton = document.getElementById(id);

            var url = "./AJAX/requests/friendAddRemoveRequest.php?u="+"<?=$username1?>";

            if(window.XMLHttpRequest)
            {
              var xmlhttp = new XMLHttpRequest();

            }
            else
            {
              var xmlhttp = new ActiveXObject("Microsoft.XMLHttpRequest");
            }
            xmlhttp.open("POST",url+"&purpose=follow",true);
            xmlhttp.onreadystatechange = function()
            {
              if(this.readyState == 4 && this.status == 200)
              {
                // alert(id);
                var return_data = xmlhttp.responseText;
                followthepersonButton.value = "Request sent";
              }
            }
            xmlhttp.send();
           }

           </script>


            <div class="act">

                <div class="link1">Posts
                    <div class="value" id = "post_count"><?php echo $i ?></div>
                </div>
                <div class="link2">Following
                    <div class="value"><?php if(isset($followersCount)) {
                     echo "$followersCount";

                   }
                   else {
                     echo "0";

                   }
                    ?></div>
                </div>
                <div class="link3">Follower
                    <div class="value">
                        <?php if(isset($followersCount)) {
                         echo "$followersCount";

                       }
                       else {
                         echo "0";

                       }
                        ?></div>
                </div>
                <div class="link4">Rank
                    <div class="value">12</div>
                </div>
                <div class="link5">Activity
                    <div class="value">0</div>
                </div>

             </div>

            <!--block of profile menues like Follower etc section ends-->

          </div>
        </div>
        <!-- /profile-tabs -->
      </div>

      <div class="profile-body">
        <aside class="sidebar">
          <div class="section introduction">
            <header>
              <?php
              //echo "<h1>$username and 1 is $username1";

              if($username != $username1)
              {

              echo "<form style=\"float: left; cursor:pointer;\">
                    $addFriendButton
                    </form>
                  <form action='message_specific_person.php?u=$username1' method='post'>
                  <input formtarget='_blank' type=\"submit\" name=\"sendMsg1\" value=\"Message\" style = \"cursor:pointer;\">


                </form>";
            }

             ?>
<!-- php script for friend request system -->
              <!-- <i class="fa fa-globe-americas badge badge-intro"></i>
              <a>Intro</a> -->
            </header>
            <div class="content">
              <div class="row resume-container">
                <p class="resume">Fullstack PHP Developer, nature lover, cryptocurrency enthusiast.</p>
              </div>
              <div class="row">
                <div class="col icon"><i class="fa fa-suitcase"></i></div>
                <div class="col">
                  Group Member at <a href="#">PHP World</a>
                </div>
              </div>
              <div class="row">
                <div class="col icon"><i class="fa fa-suitcase"></i></div>
                <div class="col">
                  WEB Developer at <a href="#">Freelancer</a>
                </div>
              </div>
              <div class="row">
                <div class="col icon"><i class="fa fa-graduation-cap"></i></div>
                <div class="col">
                  Studied at <a href="#">Internet</a>
                </div>
              </div>
              <div class="row">
                <div class="col icon"><i class="fa fa-rss"></i></div>
                <div class="col">
                  <?php if(isset($followersCount)) {
                   echo "Followed by <a href=\"friendList_page.php\">$followersCount peoples </a>";
                 }
                 else {
                   echo "No followers";

                 }
                  ?>
                </div>
              </div>
            </div>
          </div>

          <div class="section photos">
            <header>
              <i class="fa fa-images badge badge-photos"></i>
              <a href="#fotos">Photos</a>
            </header>
            <div class="content">
              <div class="row">
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
              </div>
              <div class="row">
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
              </div>
              <div class="row">
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
                <div class="col"><a href="#"><img src="img/user-picture-3.jpg" width="100%" /></a></div>
              </div>
            </div>

          </div>

          <div class="section languages">
            <div class="content">
              <div class="row">
                <div class="col">
                  <a>English (US)</a> ·
                  <a href="#">Português (Portugal)</a> ·
                  <a href="#">Português (Brasil)</a> ·
                  <a href="#">Español</a> ·
                  <a href="#">Latine</a>
                </div>
                <div class="col plus-box">
                  <i class="fa fa-plus"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="section main footer">
            <footer class="main-footer">
              <div class="content">
                <a href="#">Privacy</a> ·
                <a href="#">Terms</a> ·
                <a href="#">Advertising</a> ·
                <a href="#">Ad Choices <i class="fa fa-ad" style="font-size: 0.8rem;"></i></a> ·
                <a href="#">Cookies</a> ·
                <a href="#">More <i class="fa fa-caret-down" style="font-size: 0.7rem;"></i></a>
                <div class="row copyright">Efranelas &copy; MIT License 2019</div>
              </div>
            </footer>
          </div>
        </aside>

        <!-- #################### AJAX to upload and display post + post_count ################################## -->
        <script type="text/javascript">



            function send_post() {

                var hr = new XMLHttpRequest();
                var url = "send_post.php?u="+"<?=$username1?>";


                var post = document.getElementById('post').value;
                // post1 = post1.replace(/apple/g,"ball");
                //  alert(post);
                // document.write(post);
                // return false;
                var post = post.replace(/(?:\r\n|\r|\n)/g,"<br>");



                var post_count = document.getElementById('post_count').innerHTML;
                var num_post_count = Number(post_count);

                num_post_count += 1;

                // alert(num_post_count);
                // return false;

                document.getElementById("post_display").innerHTML = "processing...";
                hr.open("POST",url+"&post="+post,true);
                // hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                hr.onreadystatechange = function()
                {
                    if(hr.readyState == 4)
                    {
                        var return_data = hr.responseText;
                        document.getElementById("post_display").innerHTML = return_data;
                        document.getElementById('post_count').innerHTML = num_post_count;
                        document.getElementById('post').value = "";
                        // getElementsByClassName('className')
                    }
                }
                hr.send();
            }



            function upvote(string)
            {
                var whattodo = "upvote";
                var id = string.id;
                var upvoteButton = document.getElementById(id);

                var extractNumFromid = id.match(/\d+/g).map(Number);

                var downvoteButton = document.getElementById("downvote"+extractNumFromid);

                if(upvoteButton.style.color == "rgb(76, 175, 80)")
                {
                    return false;
                    // upvoteButton.style.color = "";
                }
                else{
                    upvoteButton.style.color = "#4CAF50";
                    upvoteButton.classList.remove('upvote');
                    downvoteButton.style.color = "";
                    downvoteButton.classList.add('downvote');



                }


                //AJAX TO LIKE count

                // return false;
                var hr = new XMLHttpRequest();
                var url = "upvotecount.php?u="+"<?=$username1?>";

                hr.open("POST",url+"&post_id="+extractNumFromid+"&name=up",true);
                // hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                hr.onreadystatechange = function()
                {
                    if(hr.readyState == 4)
                    {
                        var return_data = hr.responseText;
                        upvoteButton.childNodes[1].innerHTML = return_data;
                    }
                }
                hr.send();


                displayUpvotersName(extractNumFromid, whattodo);

//FOR DISPLAYING UPVOTERS NAME E.G @BHARAT AND 34 OTHERS

            }
function displayUpvotersName(extractNumFromid, whattodo)
{
    // var extractNumFromid = id.match(/\d+/g).map(Number);
    // alert(extractNumFromid);
    var displayUpvotersNameElement = document.getElementById("displayUpvotersName"+extractNumFromid);
    var displayRespectersNameElement = document.getElementById("displayRespectersName"+extractNumFromid);
    // alert(displayUpvotersNameElement.innerText);
    var displayUrl = "AJAX/requests/displayUpvotersNameandOtherRequest.php?u="+"<?=$username1?>";
    if(window.XMLHttpRequest)
    {
        var xmlhttp = new XMLHttpRequest();
    }
    else
    {
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xmlhttp.open("POST",displayUrl+"&post_id="+extractNumFromid+"&whattodo="+whattodo,true);
    xmlhttp.onreadystatechange = function()
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var response_text = xmlhttp.responseText;
            if(whattodo == 'upvote')
            displayUpvotersNameElement.innerHTML = response_text;
            else if(whattodo == 'respect')
                displayRespectersNameElement.innerHTML = response_text;
            else
                return false;
        }
    }

    xmlhttp.send();


}

            function downvote(downId)
            {
                var whattodo = "upvote";
                var id = downId.id;
                var downvoteButton = document.getElementById(id);
                // alert(id);
                var extractNumFromid = id.match(/\d+/g).map(Number);

                var upvoteButton = document.getElementById("upvote"+extractNumFromid);

                if(downvoteButton.style.color == "rgb(234, 67, 53)" )
                {
                    return false;
                }
                else {
                    downvoteButton.style.color = "#ea4335";
                    downvoteButton.classList.remove('downvote');
                    upvoteButton.style.color = "";
                    upvoteButton.classList.add('upvote');



                }

                /////AJAX FOR DOWNBOTE//////

                var url = "upvotecount.php?u="+"<?=$username1?>";


                if(window.XMLHttpRequest)
                {
                    //code for IE7+, firefox, chrome , safari
                    // var hr = new XMLHttpRequest();
                    var xmlhttp = new XMLHttpRequest();
                }
                else {
                    //code for IE6,5

                    var  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    // alert(xmlhttp);
                }
                // alert(xmlhttp);

                xmlhttp.open("POST",url+"&post_id="+extractNumFromid+"&name=down",true);

                // alert("imin");

                xmlhttp.onreadystatechange = function()
                {
                    // alert("imin");

                    if(this.readyState == 4 && this.status == 200)
                    {
                        // alert("imin");

                        //main code goes HERE
                        var return_data = xmlhttp.responseText;
                        // document.getElementById('post_display').innerHTML = return_data;
                        // alert(return_data);
                        // downvoteButton.childNodes[1].innerHTML = return_data;




                    }
                }
                xmlhttp.send();
                displayUpvotersName(extractNumFromid, whattodo);


            }

            function respect(respId)
            {
                var whattodo = "respect";
                var id = respId.id;
                var respectButton = document.getElementById(id);
                var extractNumFromid = id.match(/\d+/g).map(Number);

                if(respectButton.style.color == "rgb(209, 200, 80)")
                {
                    return false;
                }

                else {
                    respectButton.style.color = "rgb(209, 200, 80)";
                    respectButton.classList.remove('respect');



                }


                //#########AJAX FOR RESPECTS ################

                var url = "upvotecount.php?u="+"<?=$username1?>";

                if(window.XMLHttpRequest)
                {
                    var xmlhttp = new XMLHttpRequest();
                }
                else {
                    var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.open("POST",url+"&post_id="+extractNumFromid+"&name=respect");

                xmlhttp.onreadystatechange = function()
                {
                    if(this.status == 200 && this.readyState == 4)
                    {
                        var return_data = xmlhttp.responseText;
                        respectButton.childNodes[1].innerHTML = return_data;

                    }
                }
                xmlhttp.send();

                displayUpvotersName(extractNumFromid, whattodo);
            }

            let showOrhide = 1;//1 to hide 0 to show

            //TODO: move this script to top it is being duplicated in every loop
            function comment(posts_id,comment_post)
            {
                // let showOrhide = 1;//1 to hide 0 to show
                var post_id = posts_id.id;
                var commenter_id = "<?=$myuserid?>";
                //var comment_count = "<?//=$commentCount?>//";

                var extractNumFromid = post_id.match(/\d+/g).map(Number);
                if(showOrhide == 1) {
                    document.getElementById('comments_wrapper' + extractNumFromid).style.display = "";
                    showOrhide = 0;
                }
                else if(showOrhide == 0){
                    document.getElementById('comments_wrapper' + extractNumFromid).style.display = "none";
                    showOrhide = 1;
                }
                if(comment_post == 1) {
                    var comment_body_element = document.getElementById("comment_body"+extractNumFromid);
                    // alert(commenter_id);
                    var comment_body = comment_body_element.value;

                    // alert(comment_body);
                    var url = "post_comment.php?u="+"<?=$username1?>";


                    if (window.XMLHttpRequest) {
                        var xmlhttp = new XMLHttpRequest();
                    } else {
                        var xmlhttp = new ActiveXObject("Microsoft.XMLHttp");

                    }
                    xmlhttp.open("POST",url+"&post_id="+extractNumFromid+"&comment_body="+comment_body+
                        "&my_id="+commenter_id+"&insert_comment=1",true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response_text = xmlhttp.responseText;
                            // document.getElementById('comment_body').value = "";
                            comment_body_element.value = "";

                        }

                    }
                    xmlhttp.send();
                }
                // alert(extractNumFromid);
            }




        </script>

        <!-- #################### END of AJAX to upload and display post + post_count ################################## -->

        <main class="publications">
          <div class="postform">
                <form >
                    <textarea id="post" name="post" rows="5" cols="74"></textarea>
                    <input type="button" name="send" onclick="send_post()" value="post" style = "cursor:pointer;" >
                    </form>
    </div>

<!--#################### ONE BLOCK OF POST #################-->

<?php

date_default_timezone_set("Asia/Kathmandu");
$user_posted_to = "";
$row = 1;
$user_post = "SELECT * FROM posts WHERE user_posted_to = '$username1' ORDER BY id DESC LIMIT 100";
$user_post_query = mysqli_query($conn,$user_post);
if($user_post_query)
{



  while ($row = mysqli_fetch_assoc($user_post_query))
  {

  $id = $row['id'];


  $body = filterText($row['body']);

  $date_added = $row['date_added'];
  $time_added = $row['time_added'];
  $added_by = $row['added_by'];
  $user_posted_to = $row['user_posted_to'];
//      echo "<div class = 'posted_by'><br><a style = \"border-bottom:none;\" href='profile.php?u=$added_by'>@$added_by</a>- $date_added  -$time_added</div>&nbsp;&nbsp;$body <br> <br><hr><br>";




          ######################################################
          ##########  PHP SCRIPT FOR LOAD
          ######
          ##########                                      ######
          ##########                                      ######
          ######################################################



        $queryUpvote = 'SELECT upvote, respect, upvoted_by_id, downvoted_by_id, respected_by_id FROM post_upvotes WHERE upvoted_to_id = ? && post_id = ?';
        $queryUpvotestmt = $conn -> stmt_init();
        if($queryUpvotestmt -> prepare($queryUpvote))
        {
          $queryUpvotestmt -> bind_param('ii',$user_id, $id);
          $queryUpvotestmt -> execute();
          // print_r($queryUpvotestmt);
          $queryUpvotestmt -> bind_result($upvotes, $respects, $upvotedBylist, $downvotedBylist,$respectedBylist);
          $queryUpvotestmt -> store_result();
          // echo "you son of a bitch i am in";
        }
        else {

          echo $queryUpvotestmt -> error;
        }
        while($queryUpvotestmt -> fetch())
        {

        }
        $queryUpvotestmt -> free_result();




            ######################################################
            ##########  PHP SCRIPT FOR LOAD UPVOTES         ######
            ##########        ENDS                          ######
            ##########                                      ######
            ######################################################

      // <!-------------------------------------------------------------------------------------------------------------->

?>

      <?php


      $respectedBylistExplode = explode(', ',$respectedBylist);
      $respectedBylistCount = count($respectedBylistExplode);
      $respectedBylistCount -= 1;

      // EXPLODING UPVOTED ID's
      $upvotedBylistExplode = explode(", ", $upvotedBylist);
//       print_r($upvotedBylistExplode);
      $upvotedBylistCount = count($upvotedBylistExplode);
      $upvotedBylistCount -= 1;

      // echo "$upvotedBylistCount";

      // EXPLODING DOWNVOTED ID'S
      $downvotedBylistExplode = explode(", ", $downvotedBylist);
//       print_r($upvotedBylistExplode);
//       echo "$upvotedBylistExplode[1]";
      $downvotedBylistCount = count($downvotedBylistExplode);
      $downvotedBylistCount -= 1;
      // echo "d $downvotedBylistCount";
      // FOR UPVOTE
      $upFlag = "";
      $downFlag = "";
      $respFlag = 0;

      if($respectedBylistCount >0)
      {
        if(in_array($myuserid, $respectedBylistExplode))
        {
          $respFlag = 1;

        }
      }
      if($upvotedBylistCount !== 0)
      {
      if(in_array("$myuserid",$upvotedBylistExplode,false))
      {
        $upFlag = 1;
        $downFlag = 0;
      }
     }

     // print_r($downvotedBylistExplode)

      //FOR DOWNVOTE
      // echo "$downvotedBylistCount";
      if($downvotedBylistCount != 0)
      {
        // echo "down";
      if(in_array("$myuserid", $downvotedBylistExplode))
      {
        // echo "$myuserid";
        // print_r($upvotedBylistExplode);
        $downFlag = 1;
        $upFlag = 0;
      }
      }
      if($upvotedBylistCount === 0 && $downvotedBylistCount === 0) {
        $downFlag = 0;
        $upFlag = 0;
      }
      // echo "d $downvotedBylistCount";

      // echo "$upFlag = up and $downFlag = down";


      ?>

      <?php

      if($upvotes > 0) {
          $upvoterstodisplay = $upvotedBylistCount - 1;
//      echo  $upvoterstodisplay ;
          if ($upvoterstodisplay > -1) {
              $upvoterUsername = upvoteRespectDisplay($conn, $upvotedBylistExplode, $upvoterstodisplay, "upvote");
//

          }
      }
          if($respects > 0)
          {
              $respectertodisplay = $respectedBylistCount - 1;
              if($respectertodisplay > -1)
              {
                  $respecterUsername = upvoteRespectDisplay($conn,$respectedBylistExplode,$respectertodisplay,"respect");

              }

          }

      ?>
<!--      This php script for displayig comments on profile load-->


  <?php
  $forCommentcountQuery = 'SELECT comment_id FROM `post_comments` WHERE post_id = ? ORDER BY comment_id DESC';
  $forCommentcountQueryStmt = $conn -> stmt_init();
  if($forCommentcountQueryStmt -> prepare($forCommentcountQuery))
  {
//          echo "<h1>$id</h1>";
      $forCommentcountQueryStmt -> bind_param('i',$id);
      $forCommentcountQueryStmt -> execute();
      $forCommentcountQueryStmt -> bind_result($commentCountId);
      $forCommentcountQueryStmt -> store_result();
  }
  $commentCount = 0;
  while($forCommentcountQueryStmt -> fetch()) {
      $commentCount++;
  }
  ?>

<?php
        echo  "<div id= 'post_display'>
        <article class=\"section\">
            <div class=\"main-section\">
              <header>
                <div class=\"row\">
                  <div class=\"col profile-picture\">
                    <img src=\"img/user-picture-3.jpg\" alt=\"Efranelas' Profile Picture\" />
                  </div>
                  <div class=\"col\">
                    <div class=\"row\">";
                    if($added_by!== $user_posted_to )
                    {
                      $query1 = "SELECT username, first_name, last_name FROM users WHERE BINARY username = '$added_by' ";
                  		$check1 = mysqli_query($conn,$query1);
                  		if (mysqli_num_rows($check1)== 1) {
                  			$get1 = mysqli_fetch_assoc($check1);

                  		//	$username = $get['username'];

                  			$firstnameOfPoster = $get1['first_name'];
                  			$lastnameOfPoster = $get1['last_name'];
                  		//	$email = $get['email'];
                  			# code...
                      }

                       if(isset($firstnameOfPoster)&& isset($lastnameOfPoster)){
                       echo "<a href=\"profile.php?u=$added_by\" class=\"author\"> $firstnameOfPoster $lastnameOfPoster </a>&#10148 <a href=\"profile.php?u=$username1\" class=\"author\">$firstname $lastname</a>";
                       }

                   }

                    else {
                      echo "<a href=\"#\" class=\"author\">$firstname $lastname</a>";
                    }
                    echo "</div>
                    <div class=\"row\">
                      <a href=\"#\" class=\"date\">$date_added at $time_added</a>
                    </div>
                  </div>
                </div>
              </header>
              <section class=\"content\">";
              echo nl2br(  "<p> $body </p>" );

            echo '  </section>
            </div>
            <footer>
              <div class="row post-info">
                <div class="col left">';
                  echo "<span id = \"displayUpvotersName$id\">";
             if(isset($upvoterUsername) && $upvotes > 0) {
                 echo "@$upvoterUsername";
                 if($upvoterstodisplay > 0)
                 {
                     echo ' and ' .(string)$upvoterstodisplay;
                     echo $upvoterstodisplay > 1 ? ' others' : ' other';
                 }
             }
             else {
                 echo 'Be the First person to upvote this';
             }
      echo '</span></div>
                <div class="col right">';
      echo "<span id = \"displayRespectersName$id\">";
      if(isset($respecterUsername) && $respects > 0) {
          echo "@$respecterUsername";
          if($respectertodisplay > 0)
          {
              echo ' and ' .(string)$respectertodisplay;
              echo $respectertodisplay > 1 ? ' others' : ' other';
          }
      }
      else {
          echo 'Be the First person to respect this';
      }
                echo "</span></div>
              </div>
              <div class=\"row buttons\">
                <div class=\"content\">
                <span id = \"upvote$id\"";
                if($upFlag == 1){echo ' class="button" style="color : #4CAF50;"';}
                elseif ($upFlag == 0) { echo ' class="button upvote"';   }
                echo 'onclick = "upvote(this);" ';
                echo "><i class=\"icofont-stylish-up\" style=\"font-size: 30px;\"></i><p>$upvotes</p></span>
                <span   id = \"downvote$id\"";
                if($downFlag == 1){echo ' class="button" style="color : #ea4335;"';}
                elseif ($downFlag == 0) { echo ' class="button downvote"';

                  }
                echo 'onclick = "downvote(this);" ';
                 echo "><i class=\"icofont-stylish-down\" style=\"font-size: 30px;\"></i></span>
                  <span   id = \"comment$id\" class=\"button\" onclick='comment(this,0);' ><i class=\"icofont-comment\" style=\"font-size: 26px;cursor: pointer\"></i><p>$commentCount</p></span>
                  <span   id = \"share$id\" class=\"button\"><i class=\"icofont-paper-plane\" style=\"font-size: 26px;\"></i><p>234k</p></span>";
                  echo "<span   id = \"respect$id\" ";
                  if($respFlag == 1) {echo 'class="button" style = "color : #d1c850" '; }
                  elseif ($respFlag == 0 && $username1 !== $username) {echo 'class = "button respect"'; }
//SO THAT THEY CAN'T RESPECT THEIR OWN POSTS
                  if($username1 !== $username)
                  {
                      echo 'onclick ="respect(this);"';
                  }
                  echo "><i class=\"icofont-bird-wings\" style=\"font-size: 26px;\"></i><p>$respects</p></span>

                </div>
              </div>

            </footer>
          ";?>
                 <?php echo "<div id=\"comments_wrapper$id\""?> style="display: none;">
            <form action="" method="post">
                <textarea name="post_comment" id="comment_body<?=$id?>" cols="65" rows="3" placeholder="write your comment..."></textarea>
                <input type="button" id = <?php echo "\"$id\""?>  value="post" onclick="comment(this,1);" style ="float: right; margin-top: 30px;"><br><br>
            </form>

            <div class="section" style="margin-top: -12px;">
                <?php
                $displayCommentQuery = 'SELECT * FROM `post_comments` WHERE post_id = ? ORDER BY comment_id DESC';
                $displayCommentQueryStmt = $conn -> stmt_init();
                if($displayCommentQueryStmt -> prepare($displayCommentQuery))
                {
//          echo "<h1>$id</h1>";
                    $displayCommentQueryStmt -> bind_param('i',$id);
                    $displayCommentQueryStmt -> execute();
                    $displayCommentQueryStmt -> bind_result($cmntId, $commentBody, $postID, $commentersId, $commentUp, $commentOdwn
                        , $commentResp, $commentReply, $cmntUpId, $cmntDownId
                        ,$cmntRespId, $cmntRepliersId, $cmntDateAdded);
                    $displayCommentQueryStmt -> store_result();
                }
                $commentCount = 0;
                while($displayCommentQueryStmt -> fetch())
                {
                   $commenterName = upvoteRespectDisplay($conn, "",$commentersId,"comment");
//                   echo "<h1>$commenterName</h1>";
                    echo "<div class=\"main-section\" >
    <header>
        <div class=\"row\">
            <div class=\"col profile-picture\">
                <img src=\"/project/img/user-picture.png\" alt=\"Efranelas' Profile Picture\">
            </div>
            <div class=\"col\">
                <div class=\"comment_row\" style=\"margin: 10px 0 0 8px;\">
                <a href=\"profile.php?u=FirstUserInLinux\" class=\"author\"> $commenterName
                        <a href=\"#\" class=\"comment_date\">$cmntDateAdded</a>

                </div>
<!--                <div class=\"row\">-->
<!--                    <a href=\"#\" class=\"comment_date\">2020-04-24 at 05:57:42pm</a>-->
<!--                </div>-->
            </div>
        </div>
    </header>
    <section class=\"content\"><p> $commentBody </p>  </section>
</div>
<footer>
    <div class=\"row post-info\">
        <div class=\"col left\"><span id=\"displayUpvotersName239\">360 people upvoted this</span></div>
        <div class=\"col right\"><span id=\"displayRespectersName239\">10 people respected this</span></div>
    </div>
    <div class=\"row comment_buttons\">
        <div class=\"content\">

            <span id=\"upvote2390\" class=\"button upvote\" onclick=\"upvote(this);\"><i class=\"icofont-stylish-up\" style=\"font-size: 20px;\"></i><p></p></span>
            <span id=\"downvote2309\" class=\"button downvote\" onclick=\"downvote(this);\"><i class=\"icofont-stylish-down\" style=\"font-size: 20px;\"></i></span>
<!--            <span id=\"\comment239&quot;\" class=\"button\"><i class=\"icofont-comment\" style=\"font-size: 26px;\"></i><p>1303</p></span>-->
<!--            <span id=\"share239\" class=\"button\"><i class=\"icofont-paper-plane\" style=\"font-size: 26px;\"></i><p>234k</p></span>-->
            <span id=\"respect2309\"><i class=\"icofont-bird-wings\" style=\"font-size: 20px;\"></i><p></p></span>
            <span id=\"reply2309\"><i class=\"icofont-reply\" style=\"font-size: 20px;\"></i><p></p>149</span>


        </div>
    </div>

</footer>";

                }
                                    $displayCommentQueryStmt -> free_result();

                //      echo "<h1>$commentBody</h1>";



                ?>


            </div>


           <?php echo '</article></div>';
//          die();

}
if(!isset($id))
{

    echo '<div id= "post_display"></div>';
}
}

          ?>


          <!--####################END OF ONE BLOCK OF POST #################-->

          <!--################################# POST WHEN PHOTOS ARE UPLOADED ############################-->

<!--

          <article class="section">
            <div class="main-section gallery">
              <header>
                <div class="row">
                  <div class="col profile-picture">
                    <img src="img/user-picture-3.jpg" alt="Efranelas' Profile Picture" />
                  </div>
                  <div class="col">
                    <div class="row">
                      <a href="#" class="author">Efranelas XVI</a>
                    </div>
                    <div class="row">
                      <a href="#" class="date">March 5 at 2:02 PM</a>
                    </div>
                  </div>
                </div>
              </header>
              <section class="content">

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua. </p>
                <img src="img/user-picture.png" style="width: 100%" />
              </section>
            </div>
            <footer>
              <div class="row post-info">
                <div class="col left">
                  <i class="fa fa-heart" style="color: rgba(255, 0, 0, 0.8);"></i> 305
                </div>
                <div class="col right">
                  45 Comments 18 Shares
                </div>
              </div>
              <div class="row buttons">
                <div class="content">
                  <a href="#" class="button"><i class="far fa-thumbs-up"></i> Like</a>
                  <a href="#" class="button"><i class="far fa-comment-alt"></i> Comment</a>
                  <a href="#" class="button"><i class="far fa-paper-plane"></i> Share</a>
                </div>
              </div>

            </footer>
          </article> -->

<!--#################################END OF TEST POST WHEN PHOTOS ARE UPLOADED ############################-->
        </main>

      </div>

    </div>
  </section>

  <!-- script for cover image moving effect -->
  <script>
    // prevent img deslocation bug
    document.querySelector(".profile-picture").addEventListener("dragstart", function (e) { e.preventDefault(); });
    document.querySelector(".profile-cover").addEventListener("dragstart", function (e) { e.preventDefault(); });

    // Profile header elements
    let profileCover = document.querySelector(".cover-image"); // <img> element
    let profileShade = document.querySelector(".cover-shade"); // shade to read the name better
    let profilePicture = document.querySelector(".profile-thumbnail");
    let profileNames = document.querySelector(".profile-names");

    // check if there is a previous position saved or reset if there isn't
    profileCover.style.top = localStorage.getItem("top") || "0px";

    // save cover position when hit ENTER
    window.addEventListener("keyup", function (e) {
      if (e.keyCode === 13) {
        console.log("salvo 111!");
        l = true;
        // clicar enter === salva posição
        localStorage.setItem("top", profileCover.style.top);
      }
    });

    /**
      * Move a cover no eixo Y utilizando o eixo X do mouse.
      */
    function moveX(e) {

      // disable temporary some profile items to see the cover better.
      profileCover.style.opacity = "0.8";
      profileNames.style.opacity = "0.3";
      profilePicture.style.opacity = "0.3";
      profileShade.style.display = "none";

      let max = 283;
      let percent = parseInt(17 + 100 * (e.clientX - max) / max);
      let y = percent; //e.clientX - max;
      if (y < 0) {
        // travar no == top: 0px
        profileCover.style.top = "0px";
      }
      else if (y > max) {
        // travar no máximo bottom da imagem
        profileCover.style.top = "-283px";
      }
      else {
        profileCover.style.top = -y + "px";
      }
    }

    /**
      * Move a cover no eixo Y utilizando o eixo Y do mouse.
      */
    function move(e) {

      // disable temporary some profile items to see the cover better.
      profileCover.style.opacity = "0.8";
      profileNames.style.opacity = "0.3";
      profilePicture.style.opacity = "0.3";
      profileShade.style.display = "none";

      let y = e.clientY - (250 + 42);
      if (y > 0) {
        // travar no == top: 0px
        profileCover.style.top = "0px";
      }
      else if (y < -283) {
        // travar no máximo bottom da imagem
        profileCover.style.top = "-283px";
      }
      else {
        profileCover.style.top = y + "px";
      }
    }


    /**
     * ABAIXO, várias instruções, eventos e funções para:
     * 1. Habilitar o evento de mover somente quando o usuário segurar o botao esquerdo do mouse e arrastar.
     * 2. Controlar o cursor do mouse.
     * 3. Remover os eventos após o uso
     */


    /**
     * Chama a função que move, e muda o cursor do mouse.
     */
    function handleMovement(e) {
      // Está movendo a imagem!!
      profileCover.style.cursor = "move";
      move(e);
    }
    function activateMovement(e) {
      profileCover.addEventListener("mousemove", handleMovement, false);
    }

    // Ao clicar na cover, ativa o drag and drop.
    profileCover.addEventListener("mousedown", activateMovement, false);
    // Ao parar de mover a cover, deleta os eventos para não consumir memoria
    profileCover.addEventListener("mouseup", function (e) {
      profileCover.removeEventListener("click", activateMovement, false);
      profileCover.removeEventListener("mousemove", handleMovement, false);
      profileCover.style.cursor = "default";
      profileCover.style.opacity = "1";
      profilePicture.style.opacity = "1";
      profileNames.style.opacity = "1";
      profileShade.style.display = "block";
    }, false);
  </script>
</body>

</html>
