<?php

include '/var/www/html/project/inc/includeAllFiles.inc.php';

$id = $_GET['post_id'];
$whattodo = $_GET['whattodo'];
//echo "$user_id and $id";
$queryUpvote = 'SELECT upvote, respect, upvoted_by_id, downvoted_by_id, respected_by_id FROM post_upvotes WHERE upvoted_to_id = ? && post_id = ?';
$queryUpvotestmt = $conn -> stmt_init();
if($queryUpvotestmt -> prepare($queryUpvote))
{

    $queryUpvotestmt -> bind_param('ii',$user_id, $id);
    $queryUpvotestmt -> execute();
    // print_r($queryUpvotestmt);
    $queryUpvotestmt -> bind_result($upvotes, $respects, $upvotedBylist, $downvotedBylist,$respectedBylist);
    $queryUpvotestmt -> store_result();
//     echo "you son of a bitch i am in";
}
else {

    echo $queryUpvotestmt -> error;
}
while($queryUpvotestmt -> fetch())
{
//   echo "you son of a bitch i am in";


    // echo "$net_upvotes";
//     die();






}


$respectedBylistExplode = explode(', ',$respectedBylist);
$respectedBylistCount = count($respectedBylistExplode);
$respectedBylistCount -= 1;

// EXPLODING UPVOTED ID's
$upvotedBylistExplode = explode(", ", $upvotedBylist);
$upvotedBylistCount = count($upvotedBylistExplode);
$upvotedBylistCount -= 1;

// EXPLODING DOWNVOTED ID'S
$downvotedBylistExplode = explode(", ", $downvotedBylist);
$downvotedBylistCount = count($downvotedBylistExplode);
$downvotedBylistCount -= 1;

if($whattodo === 'upvote') {
    if ($upvotes > 0) {
        $upvoterstodisplay = $upvotedBylistCount - 1;
//      echo  $upvoterstodisplay ;
        if ($upvoterstodisplay > -1) {
            $upvoterUsername = upvoteRespectDisplay($conn, $upvotedBylistExplode, $upvoterstodisplay, "upvote");
//
//echo $upvoterUsername;
        }
    }
    if (isset($upvoterUsername) && $upvotes > 0) {
        echo "@$upvoterUsername";
        if ($upvoterstodisplay > 0) {
            echo ' and ' . (string)$upvoterstodisplay;
            echo $upvoterstodisplay > 1 ? ' others' : ' other';
        }
    } else {
        echo 'Be the First person to upvote this';
    }
}
else if($whattodo === 'respect') {
    if ($respects > 0) {
        $respectertodisplay = $respectedBylistCount - 1;
        if ($respectertodisplay > -1) {
            $respecterUsername = upvoteRespectDisplay($conn, $respectedBylistExplode, $respectertodisplay, "respect");

        }

    }


    if (isset($respecterUsername) && $respects > 0) {
        echo "@$respecterUsername";
        if ($respectertodisplay > 0) {
            echo ' and ' . (string)$respectertodisplay;
            echo $respectertodisplay > 1 ? ' others' : ' other';
        }
    } else {
        echo 'Be the First person to respect this';
    }
}
else
{
    die();
}
