<?php
ini_set('display_errors','1');


?>
<?php
//include ("./inc/connect.inc.php");
include ("./inc/header.inc.php");
include ("./inc/textfilter.php");
include ("./inc/loggedInUserDetails.php");
date_default_timezone_set("Asia/Kathmandu");
$upFlag= "";
$downFlag = "";
$respFlag = "";
$upvotes = "";
$downvotes = "";
$respects = "";
// print_r($_GET['post']);
// die();
      $post1 = str_replace("<br>","\n",$_GET['post']);
      // $post = nl2br($post1);
      // $post = mysqli_real_escape_string($conn,$post1);
      $post = filterText($post1);
      $post = str_replace(" ","&nbsp;",$post);
      $date_added = date("y-m-d");
      $time_added = date("h:i:sa");
      $added_by = "$username";
      $user_posted_to = $username1;
      if($post != "")
      {


        $sql = "INSERT INTO posts (body, date_added, time_added, added_by, user_posted_to )
        VALUES (?,?,?,?,?)";
        $postsQuery = $conn -> stmt_init();
        if($postsQuery -> prepare($sql))
        {
          $postsQuery -> bind_param('sssss',$post,$date_added,$time_added,$added_by,$user_posted_to);
          $postsQuery -> execute();

        }
        else {
          $error = $postsQuery -> error;
          die("$error");
        }
        //
        //
        // $sql = "INSERT INTO posts (body, date_added, time_added, added_by, user_posted_to )
        // VALUES ('".$post."','".$date_added."','".$time_added."','".$added_by."','".$user_posted_to."')";
        // $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        // //header("Location: profile.php?u=$username1");

    }
    else {
      echo "You must enter something...";
    }





 ?>

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

      $body = nl2br(filterText($row['body']));

      $date_added = $row['date_added'];
      $time_added = $row['time_added'];
      $added_by = $row['added_by'];
      $user_posted_to = $row['user_posted_to'];

        echo "<article class=\"section\">
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
                  <span   id = \comment$id\" class=\"button\" ><i class=\"icofont-comment\" style=\"font-size: 26px;\"></i><p>1303</p></span>
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
          </article>";



    }

//      echo "<div class = 'posted_by'><br><a style = \"border-bottom:none;\" href='profile.php?u=$added_by'>@$added_by</a>- $date_added  -$time_added</div>&nbsp;&nbsp;$body <br> <br><hr><br>";




}

           ?>
