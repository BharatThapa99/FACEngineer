<?php
ini_set("display_errors","1");
 include 'inc/includeAllFiles.inc.php';
date_default_timezone_set("Asia/Kathmandu");


$post_id = $_GET['post_id'];
//echo $post_id;
$comment_body = $_GET['comment_body'];
$date_posted = date('yy-m-d h:i:sa');

$comment_upvote = 0;
$comment_downvote = 0;
$comment_respect = 0;
$comment_reply = 0;
$upvoters_id = 0;
$downvoters_id = 0;
$respecters_id = 0;
$repliers_id = 0;
 $commenters_id = $_GET['my_id'];
//echo "$post_id $comment_body $commenters_id";
// $dbconnect2 = new databaseConnect("members","localhost","bharat","ProGrammEr99");
// $conn = $dbconnect2 -> connectDb();
$commentInsertquery = "INSERT INTO `post_comments` (`comment_body`, `post_id`, `commenters_id`,
                     `upvotes`, `downvotes`, `respects`, `reply`, `upvoters_id`, `downvoters_id`,
                     `respecters_id`, `repliers_id`, `date_posted`)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$commentInsertquerystmt = $conn -> stmt_init();
if($commentInsertquerystmt -> prepare($commentInsertquery))
{
   $commentInsertquerystmt -> bind_param('siiiiiiiiiis',$comment_body,$post_id, $commenters_id
                                            , $comment_upvote, $comment_downvote, $comment_respect
                                             , $comment_reply, $upvoters_id, $downvoters_id, $respecters_id, $repliers_id
                                                , $date_posted);

  $commentInsertquerystmt -> execute();
    $commentInsertquerystmt-> free_result();


   echo "success";

}
else
{
    echo "error";
    $error = $commentInsertquerystmt -> error;
    echo $error;
}
?>
