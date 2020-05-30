<?php
//include './inc/connect.inc.php';
include './inc/header.inc.php';
include './inc/textfilter.php';
include './inc/loggedInUserDetails.php';


 ?>



<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/f96113016a.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/profile_style.css" />
  <link rel="stylesheet" href="./css/style_timeline.css">
  <link rel="stylesheet" href="./css/style_menu.css">
  <title>Feeds</title>
</head>
<!-- onclick="menuResponsive()" -->

<body>
  <header>
    <nav>
      <div class="wrapper-btn">
        <div class="menu-btn" id="menu-btn">
          <div class="menu-btn__burger" id="menu-btn__burger"></div>
        </div>
      </div>

      <div class="logo__container">
        <img src="./assets/logo-tl.png" class="logo">
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
              <a href="#">Logout</a>
            </div>
          </div>
        </div>
      </div>

    </nav>
  </header>

  <section>
    <aside>
      <!-- <div class="profile-2"> -->
        <img src="./assets/pp.jpg">
      <!-- </div> -->
      <div class="profile-2-names">

        <a href="profile.php?u=<?=$username?>"><?=$myfirstname." ".$mylastname?></a>
    <br>
        <a href="profile.php?u=<?=$username?>" style="font-size: small;padding: 5px;"><?="@".$username?></a>
      </div>

      <div class="menu">
        <div class="home click" id="ganti">
          <div class="f-w">
            <i class="fas fa-home"></i>
          </div>
          <a href="newsfeed.php">Home <div class="click"></div></a>
        </div>

        <div class="profile">
          <div class="f-w">
            <i class="fas fa-user-alt"></i>
          </div>
          <a href="profile.html">Profile</a>
        </div>

        <div class="people">
          <div class="f-w">
            <i class="fas fa-users"></i>
          </div>
          <a href="people.html">People</a>
        </div>

        <div class="message">
          <div class="f-w">
            <i class="fas fa-comment-dots"></i>
          </div>
          <a href="message_home_page.php">Message</a>
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
              <a href="timeline.html" class="click"><i class="fas fa-home"></i></a>
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
              <a href="message.html"><i class="fas fa-comment-dots"></i></a>
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


      <article id="timeline">

        <!-- <div class="container-post">
          <img src="./assets/pp.jpg">
          <textarea name="tulis-post" id="tulis-post" cols="30" rows="10" placeholder="Text Anything..."></textarea>
          <div class="wrapper-upload-post">
            <div class="upload-gambar">
              <div id="hide" class="upload">
                <label class="hand-cursor">
                  <input type="file" nv-file-select uploader="$ctrl.uploader" />
                  <span class="far fa-image"></span>
                  <span class="photo_text hidden-xs">Photo</span>
                </label>
              </div>
            </div>
            <button type="submit">Post</button>
          </div>
        </div>

        <div class="wrapper-status">
          <div class="container-tl">
            <div class="tl-profile">
              <img src="./assets/pp.jpg">
              <div class="tl-profile-name">
                <h4>Jhon Doe</h4>
                <p class="waktu">13/03/2020 21:51.PM</p>
              </div>
            </div>
            <div class="tl-status">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eveniet cupiditate cumque placeat
                atque
                suscipit delectus quos quisquam enim, deleniti ipsam consequuntur fugit non debitis culpa nulla
                exercitationem harum pariatur ea itaque. Neque cum, blanditiis quo at perferendis, illo voluptas vitae,
                quas
                recusandae quod iusto nostrum corporis atque. Debitis, sed.</p>
            </div>
            <div class="foot-tl">
              <div class="comment">
                <p>1</p>
                <i class="far fa-comment"></i>
                <button onclick="myFunction()">Comment</button>
              </div>
            </div>
          </div>

          <div class="container-comment" id="comment">
            <div class="comment-profile">
              <img src="./assets/pp.jpg">
              <div class="tl-profile-name">
                <h4>Jhon Doe</h4>
                <p class="waktu">13/03/2020 21:51.PM</p>
              </div>
            </div>
            <div class="comment-section">
              <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim aut minus similique eius earum? Animi
                non
                itaque rem odit atque!</p>
            </div>
          </div>
          <div class="tulis-comment">
            <textarea name="tulis-comment" id="tulis-comment" cols="30" rows="10"></textarea>
            <button>Sent</button>
          </div>
        </div>-->

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


        echo  "<div id= \"post_display\">
        <article class=\"section1\">
            <div class=\"main-section1\">
              <header>
                <div class=\"row\">
                  <div class=\"col profile-picture\">
                    <img src=\"img/user-picture-3.jpg\" alt=\"Efranelas' Profile Picture\" />
                  </div>
                  <div class=\"col\">
                    <div class=\"row\">";
                    if($added_by!= $user_posted_to )
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
              <section1 class=\"content\">";
              echo nl2br(  "<p> $body </p>" );

            echo "  </section1>
            </div>
            <footer>
              <div class=\"row post-info\">
                <div class=\"col left\">
                  <i class=\"fa fa-heart\" style=\"color: rgba(255, 0, 0, 0.8);\"></i> 411
                </div>
                <div class=\"col right\">
                  19 Comments 59 Shares
                </div>
              </div>
              <div class=\"row buttons\">
                <div class=\"content\">
                  <a href=\"#\" class=\"button\"><i class=\"far fa-thumbs-up\"></i> Like</a>
                  <a href=\"#\" class=\"button\"><i class=\"far fa-comment-alt\"></i> Comment</a>
                  <a href=\"#\" class=\"button\"><i class=\"far fa-paper-plane\"></i> Share</a>
                </div>
              </div>

            </footer>
          </article>";
          echo "<div>";

      }
    }

        ?>


      </article>
    </main>


    <article id="friend-list">
      <div class="container-fl">
        <div class="title-fl">
          <h4>Friend List</h4>
        </div>

        <div class="friend">
          <img src="./assets/pp.jpg">
          <a href="">Jhon Doe</a>
        </div>
        <div class="friend">
          <img src="./assets/pp.jpg">
          <a href="">Jhon Doe</a>
        </div>
        <div class="friend">
          <img src="./assets/pp.jpg">
          <a href="">Jhon Doe</a>
        </div>
        <div class="friend">
          <img src="./assets/pp.jpg">
          <a href="">Jhon Doe</a>
        </div>
        <div class="friend">
          <img src="./assets/pp.jpg">
          <a href="">Jhon Doe</a>
        </div>
        <div class="friend">
          <img src="./assets/pp.jpg">
          <a href="">Jhon Doe</a>
        </div>
        <div class="friend">
          <img src="./assets/pp.jpg">
          <a href="">Jhon Doe</a>
        </div>
        <div class="friend">
          <img src="./assets/pp.jpg">
          <a href="">Jhon Doe</a>
        </div>
      </div>
    </article>
  </section>
  <script src="./javascript/show-hide.js"></script>
  <script src="./javascript/burger.js"></script>
</body>

</html>
