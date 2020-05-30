<?php
ini_set('display_errors','1');


 ?>
<?php
include ('./inc/connect.inc.php');
include ('./inc/header.inc.php');
//include ('./inc/menu.inc.php');
include ("./inc/loggedInUserDetails.php");

?>
<title>
	profile page
</title>




    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/proofile.css">
		<link rel="stylesheet" href="css/profile_special.css">
    <script src="js/main.js" type="text/javascript" ></script>

</head>





<body>




                <div class="name">
                        <?php echo "<h2 class = \"name1\">$firstname"." ". "$lastname </h2>";?>
                    </div>

                    <div class="username">
											<?php echo "<p>@$username1</p>";?>

                    </div>


                <!--block of info section end-->

                 <!--block of profile menues like Follower etc section starts-->
                <!-- <div class="act">

                    <div class="link1">Posts
                        <div class="value">120k</div>
                    </div>
                    <div class="link2">Following
                        <div class="value">100k</div>
                    </div>
                    <div class="link3">Follower
                        <div class="value">1M</div>
                    </div>
                    <div class="link4">Rank
                        <div class="value">12</div>
                    </div>
                    <div class="link5">Activity
                        <div class="value">0</div>
                    </div>

                 </div> -->

                <!--block of profile menues like Follower etc section ends-->

                <div class="postform">
													<!-- <form class="" action=<?php echo "send_post.php?u=$username1" ?> method="post">
													<textarea id="post" name="post" rows="5" cols="90"></textarea>
													<input type="submit" name="send" onclick="javascript:send_post()" value="post" >
													</form> -->
</div>

													<!-- YOUR POSTS GOES HERE -->
                          <main class="publications">

                          <article class="section">

                          <?php

                          date_default_timezone_set("Asia/Kathmandu");
                          $user_posted_to = "";
                          $row = 1;
                          $user_post = "SELECT * FROM posts WHERE user_posted_to = '$username1' ORDER BY id DESC LIMIT 10";
                          $user_post_query = mysqli_query($conn,$user_post);
                          if($user_post_query)
                          {



                            while ($row = mysqli_fetch_assoc($user_post_query)) {
                            $id = $row['id'];

                            $body = $row['body'];

                            $date_added = $row['date_added'];
                            $time_added = $row['time_added'];
                            $added_by = $row['added_by'];
                            $user_posted_to = $row['user_posted_to'];
                      //      echo "<div class = 'posted_by'><br><a style = \"border-bottom:none;\" href='profile.php?u=$added_by'>@$added_by</a>- $date_added  -$time_added</div>&nbsp;&nbsp;$body <br> <br><hr><br>";


                     echo   "    <div class=\"main-section\">
                      <header>
                         <div class=\"row\">
                           <div class=\"col profile-picture\">
<img src=\"img/user-picture-3.jpg\" alt=\"Efranelas Profile Picture\" />
                    </div>
                    <div class=\"col\">
                      <div class=\"row\">
                        <a href=\"#\" class=\"author\">$firstname $lastname</a>
                      </div>
                      <div class=\"row\">
                        <a href=\"#\" class=\"date\">March 5 at 2:02 PM</a>
                      </div>
                    </div>
                    </div>
                    </header>
                    <section class=\"content\">

                    <p>$body
                      </p>
                    </section>
                    </div>
                    <footer>
                    <div class=\"row post-info\">
                    <div class=\"col left\">
                    <i class=\"fa fa-heart\" style=\"color: rgba(255, 0, 0, 0.8);\"></i> 305
                    </div>
                    <div class=\"col right\">
                    45 Comments 18 Shares
                    </div>
                    </div>
                    <div class=\"row buttons\">
                    <div class=\"content\">
                    <a href=\"#\" class=\"button\"><i class=\"far fa-thumbs-up\"></i> Like</a>
                    <a href=\"#\" class=\"button\"><i class=\"far fa-comment-alt\"></i> Comment</a>
                    <a href=\"#\" class=\"button\"><i class=\"far fa-paper-plane\"></i> Share</a>
                    </div>
                    </div>

                    </footer>";

                            // code...
                        // mysqli_free_result($user_post_query);
                          }

                        }


                           ?>

                      <!--  ####################
                            ## END OF PHP CODE##
                            ##                ##
                            ####################   -->


                          </article>
                        </main>





									</div>


							  </div>





        </div>
        <!--block of profile page ends-->

    </div>

</body>
</html>
