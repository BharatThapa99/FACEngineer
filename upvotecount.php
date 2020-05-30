<?php
ini_set('display_errors','1');
//include './inc/connect.inc.php';
include './inc/header.inc.php';
include './inc/textfilter.php';
include './inc/loggedInUserDetails.php';

// echo "<h1>hello</h1>";
date_default_timezone_set("Asia/Kathmandu");
$curr_date_time = date("yy-m-d h:i:s");
// echo "$curr_date_time";
 ?>


<?php
$post_id = $_GET['post_id'];
$upordown = $_GET['name'];
// echo $upordown;
// echo "$post_id";
// die();
//
// echo "$id and $post_id";
$queryUpvote = 'SELECT upvote, downvote, net_upvotes, respect, upvoted_by_id, downvoted_by_id, respected_by_id FROM post_upvotes WHERE upvoted_to_id = ? && post_id = ?';
$queryUpvotestmt = $conn -> stmt_init();
if($queryUpvotestmt -> prepare($queryUpvote))
{
  $queryUpvotestmt -> bind_param('ii',$user_id, $post_id);
  $queryUpvotestmt -> execute();
  // print_r($queryUpvotestmt);
  $queryUpvotestmt -> bind_result($upvotes,$downvotes,$net_upvotes, $respects, $upvotedBylist, $downvotedBylist,$respectedBylist);
  $queryUpvotestmt -> store_result();
  $postCount = $queryUpvotestmt -> num_rows;
  // echo "you son of a bitch i am in";
}
else {

  echo $queryUpvotestmt -> error;
}

while($queryUpvotestmt -> fetch())
{

}

$respectedBylistExplode = explode(", ",$respectedBylist);
$respectedBylistCount = count($respectedBylistExplode);
$respectedBylistCount -= 1;


$upvotedBylistExplode = explode(", ", $upvotedBylist);
// print_r($upvotedBylistExplode);
$upvotedBylistCount = count($upvotedBylistExplode);
$upvotedBylistCount -= 1;
// echo "$upvotedBylistCount";

$downvotedBylistExplode = explode(", ", $downvotedBylist);
// print_r($downvotedBylistExplode);
$downvotedBylistCount = count($downvotedBylistExplode);
$downvotedBylistCount -= 1;
// echo "$downvotedBylistCount";

$queryUpvotestmt -> free_result();
// echo "$upvotedBylist";

// echo "net = $net_upvotes, total up = $upvotes and down = $downvotes";

 //if post is not recored in database then we have to insert the data for first upvote and then update it in next upvotes
if($postCount == 0)
{
  if($upordown == "up")
  {
  $newupvote = 1;
  $newdownvote = 0;
  $newnetupvote = 1;
  $newrespect = 0;
  $upvotedfirsttimeid = "$myuserid, ";
  $downvotedfirsttimeid = "";
  $respectedfirsttimeid = "";

  echo "$newupvote";

}
else if($upordown == "down")
{
  $newupvote = 0;
  $newdownvote = 1;
  $newnetupvote = 0;
  $newrespect = 0;
  $downvotedfirsttimeid = "$myuserid, ";
  $upvotedfirsttimeid = "";
  $respectedfirsttimeid = "";

  // echo "$newupvote";
}
elseif ($upordown == "respect")
{
  // code...
  $newrespect = 1;
  $newupvote = 0;
  $newdownvote = 0;
  $newnetupvote = 0;
  $respectedfirsttimeid = "$myuserid, ";
  $downvotedfirsttimeid = "";
  $upvotedfirsttimeid = "";
  echo "$newrespect";


}
else {
  die();
}

// IF ONE POST IS FOUND then


  $upvoteInsertquery = 'INSERT INTO post_upvotes(post_id, upvote, downvote, net_upvotes,
                        respect, upvoted_by_id, downvoted_by_id,respected_by_id, upvoted_to_id, date_time)
                        VALUES(?,?,?,?,?,?,?,?,?,?)';
  $upvoteInsertstmt = $conn -> stmt_init();
  if($upvoteInsertstmt -> prepare($upvoteInsertquery))
  {
    $upvoteInsertstmt -> bind_param('iiiiisssis',$post_id, $newupvote, $newdownvote,
                         $newnetupvote,$newrespect, $upvotedfirsttimeid, $downvotedfirsttimeid,
                         $respectedfirsttimeid ,$user_id,$curr_date_time);
    $upvoteInsertstmt -> execute();
    // print_r($upvoteInsertstmt);
    // $upvoteInsertstmt -> bind_result($net_upvotes, $upvotedBy);
    // $upvoteInsertstmt -> store_result();
    // $postCount = $upvoteInsertstmt -> num_rows;
    // echo "you son of a bitch i am in";
    $upvoteInsertstmt-> free_result();
  }
  else {

    echo $upvoteInsertstmt -> error;
  }
}
//IF  1 POST IS FOUND THEN
elseif($postCount == 1)
 {
   if($upordown == "up")
   {
     //IF I HAVE NOT UPVOTED PREVIOUSLY
     if(!(in_array("$myuserid",$upvotedBylistExplode)) && !(in_array("$myuserid",$downvotedBylistExplode)))
     {
   $upvotes += 1;
   $upvotedlist = "$myuserid, ";
   $downvotedlist = "";
   echo "$upvotes";

   // if(strstr($downvotedBylist, "$myuserid, "))
   // {
   // $newdownvotedlist = str_replace("$myuserid, ","",$downvotedBylist);
   // // $upvotes -= 1;
   // // $upvotes += 1;
   // $downvotes -= 1;
   // }

 }
 elseif (in_array("$myuserid",$upvotedBylistExplode) || in_array("$myuserid",$downvotedBylistExplode))
 {
          if (in_array("$myuserid",$upvotedBylistExplode))
          {
            die();
            // code...
          }
          elseif (in_array("$myuserid",$downvotedBylistExplode))
          {
            // code...
            $upvotes += 1;
            $downvotes -= 1;
            $upvotedlist = "$myuserid, ";
            $newdownvotedlist = str_replace("$myuserid, ","",$downvotedBylist);
            echo "$upvotes";
          }
   // code...
 }
 else {
  die();
 }
   // echo $upvote;
 }
 elseif ($upordown == "down")
 {
   //IF I AM SEEING THAT POST FOR THE FIRST TIME I.E MY FIRST UPVOTE OR DOWNVOTE TO THAT POST
   if(!in_array("$myuserid",$upvotedBylistExplode) && !in_array("$myuserid",$downvotedBylistExplode))
   {

   $downvotes += 1;
   $downvotedlist = "$myuserid, ";
   $upvotedlist = "";

 }
 //IF I HAD ALREADY UPVOTED OR DOWNVOTED THAT POST PREVIOUSLY
   elseif(in_array("$myuserid",$upvotedBylistExplode) || in_array("$myuserid",$downvotedBylistExplode))
   {
     //IF I HAD PREVIOUSLY UPVOTED THAT POST AND NOW I AM DODWNVOTING THEN..
     if(in_array("$myuserid",$upvotedBylistExplode))
     {
       $downvotes += 1;
       $upvotes -= 1;
       $newupvotedlist = str_replace("$myuserid, ","",$upvotedBylist);
       $downvotedlist = "$myuserid, ";
       echo "$upvotes";



     }
     //IF I HAD ALREADY DOWNVOTED PREVIOUSLY AND AGAIN I CLICKED DOWNVOTE THEN DO NOTHING AND DIE
     elseif (in_array("$myuserid",$downvotedBylistExplode)) {
       // code...
       die();
     }
     // $upvotes -= 1;
   }
 }

#################################### IF NOT BOTH UPVOTE OR DOWNVOTE IS CLICKED THEN DIE HERE COMMENT AND OTHHER BUTTONS CODE WILL GO LATER##################3
  elseif ($upordown == "respect")
  {
    // code...
    //THIS CODE HERE MEANS I AM ALREADY INTRODUCED TO THAT POST BY UPVOTING OR DODWNVOTING
    //IF I CLICKED RESPECT THEN
    //****FIRST CHECK IF I HAD PREVIOUSLY DID RESPECT OR NOT
    //IF MY NAME IS NOT IN THE RESPECTED ID LIST THEN ONLY
    if(!in_array($myuserid,$respectedBylistExplode))
    {
        $respects += 1;
        $respectedBylist = "$myuserid, ";//concatinate this.
        echo "$respects";
        $respectupdatequery = 'UPDATE `post_upvotes` SET  `respect`= ?, `respected_by_id`=  CONCAT(respected_by_id,?) WHERE `post_upvotes`.`post_id` = ?';
        $respectupdatestmt = $conn -> stmt_init();
        // $upvoteupdatestmt = $conn -> stmt_init();
          if($respectupdatestmt -> prepare($respectupdatequery))
          {
            $respectupdatestmt -> bind_param('isi', $respects, $respectedBylist, $post_id);
            $respectupdatestmt -> execute();

          }

          else {

            echo $respectupdatestmt -> error;
          }
    }
    //IF I ALREADY HAD RESPECTED THEN END THIS
    else
    {
      die();
    }
  }
  //IF BUTTON PRESSED IS EXCEPT THEN UP DOWN OR RESPECT THEN END
else {
     die();
   }

   // echo "$upvotedBylist";
   // $upvotes -= 1;

   // code...
 }


 ############################## FOR CLICKING DOWNVOTE BUTTON #################################

  if(isset($newupvotedlist))//i.e I want to downvote and my name_id is in upvotedlist
  {
//      echo "hello";
//TO NOT MAKE RESPECT BUTTON COUNT TO -1.IF BECOMES -1 THEN CHANGE IT TO ZERO
      $net_upvotes = ($upvotes - $downvotes) > 0 ? ($upvotes - $downvotes) : 0;
   if($net_upvotes >= 0)
   {
     if(($net_upvotes + 1) % 20 == 0)
     {
       $respect = $respects - 1;

     }

     else {
       $respect = $respects;
     }
   }
   // $respect = ($net_upvotes / 20) ;
   $upvoteupdatequery = 'UPDATE `post_upvotes` SET `upvote` = ?, `downvote` = ?, `net_upvotes` = ?, `respect`= ?, `upvoted_by_id`= ?, `downvoted_by_id`= CONCAT(downvoted_by_id,?) WHERE `post_upvotes`.`post_id` = ?';
   $upvoteupdatestmt = $conn -> stmt_init();
   // $upvoteupdatestmt = $conn -> stmt_init();
     if($upvoteupdatestmt -> prepare($upvoteupdatequery))
     {
       $upvoteupdatestmt -> bind_param('iiiissi',$upvotes, $downvotes, $net_upvotes, $respect, $newupvotedlist, $downvotedlist, $post_id);
       $upvoteupdatestmt -> execute();

     }

     else {

       echo $upvoteupdatestmt -> error;
     }
   }
     elseif(!isset($newupvotedlist) && $upordown == "down") {//IF I CLICKED DOWNVOTE AND MY NAME IS NOT IN UPVOTEDLIST
       if($net_upvotes %20 == 0 && $net_upvotes > 0)
       {
         $net_upvotes1 = $upvotes - $downvotes;
         if($net_upvotes1 == ($net_upvotes - 1))
         {
           $respect = $respects - 1;

         }

       }
       else {
         $respect = $respects;
       }
       $net_upvotes = $upvotes - $downvotes;
       // $respect = $net_upvotes / 20;
       $upvoteupdatequery = 'UPDATE `post_upvotes` SET `upvote` = ?, `downvote` = ?, `net_upvotes` = ?, `respect` = ?, `upvoted_by_id`= CONCAT(upvoted_by_id,?), `downvoted_by_id`= CONCAT(downvoted_by_id,?) WHERE `post_upvotes`.`post_id` = ?';
       $upvoteupdatestmt = $conn -> stmt_init();
       // $upvoteupdatestmt = $conn -> stmt_init();
         if($upvoteupdatestmt -> prepare($upvoteupdatequery))
         {
           $upvoteupdatestmt -> bind_param('iiiissi',$upvotes, $downvotes, $net_upvotes, $respect, $upvotedlist, $downvotedlist, $post_id);
           $upvoteupdatestmt -> execute();

         }

         else {

           echo $upvoteupdatestmt -> error;
         }
     }

############################## END FOR CLICKING DOWNVOTE BUTTON #################################


################################ FOR CLICKING UPVOTE BUTTON #######################################

if(isset($newdownvotedlist))//i.e I want to upvote and my name_id is already in downvotedlist
{

    $net_upvotes = $upvotes - $downvotes;
  if($net_upvotes >= 0)
  {
    if((($net_upvotes+ 1) % 20) == 0)
    {

      $respect = $respects + 1;
    }

    else {
      // die("$respects");
      $respect = $respects;
    }
  }

 // $respect = $net_upvotes / 20;
 $upvoteupdatequery = 'UPDATE `post_upvotes` SET `upvote` = ?, `downvote` = ?, `net_upvotes` = ?,`respect` = ?, `upvoted_by_id`= CONCAT(upvoted_by_id,?), `downvoted_by_id`= ?  WHERE `post_upvotes`.`post_id` = ?';
 $upvoteupdatestmt = $conn -> stmt_init();
 // $upvoteupdatestmt = $conn -> stmt_init();
   if($upvoteupdatestmt -> prepare($upvoteupdatequery))
   {
     $upvoteupdatestmt -> bind_param('iiiissi',$upvotes, $downvotes, $net_upvotes, $respect, $upvotedlist, $newdownvotedlist, $post_id);
     $upvoteupdatestmt -> execute();

   }

   else {

     echo $upvoteupdatestmt -> error;
   }
 }
   elseif(!isset($newdownvotedlist) && $upordown === "up") {//IF I CLICKED UPVOTE AND MY NAME IS NOT IN DOWNVOTEDLIST
     $net_upvotes = $upvotes - $downvotes;
     if($net_upvotes % 20 == 0 && $respects > 0)
     {
       $respect = $respects + 1;
     }
     else {
       $respect = $respects;
     }


     $upvoteupdatequery = 'UPDATE `post_upvotes` SET `upvote` = ?, `downvote` = ?, `net_upvotes` = ?, `respect` = ?, `upvoted_by_id`= CONCAT(upvoted_by_id,?), `downvoted_by_id`= CONCAT(downvoted_by_id,?) WHERE `post_upvotes`.`post_id` = ?';
     $upvoteupdatestmt = $conn -> stmt_init();
     // $upvoteupdatestmt = $conn -> stmt_init();
       if($upvoteupdatestmt -> prepare($upvoteupdatequery))
       {
         $upvoteupdatestmt -> bind_param('iiiissi',$upvotes, $downvotes, $net_upvotes, $respect, $upvotedlist, $downvotedlist, $post_id);
         $upvoteupdatestmt -> execute();

       }

       else {

         echo $upvoteupdatestmt -> error;
       }
   }


################################ END FOR CLICKING UPVOTE BUTTON #######################################










 ?>
