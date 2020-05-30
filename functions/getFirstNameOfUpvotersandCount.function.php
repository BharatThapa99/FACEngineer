<?php
function upvoteRespectDisplay($conn,$listExplode,$upvoterstodisplay,$storeResult)
{
    $upvotersNamequerystmt = $conn->stmt_init();
//TODO: CHANGE THIS CODE TO CLASS SO THAT YOU CAN USE SAME FOR RESPECTS ALSO WITHOUT DUPLICATING IT
    $upvotersNamequery = "SELECT username,first_name,last_name FROM users WHERE user_id = ?";
    if ($upvotersNamequerystmt->prepare($upvotersNamequery))
    {
        if($storeResult === 'upvote' || $storeResult === 'respect') {
            $upvotersNamequerystmt->bind_param('i', $listExplode[$upvoterstodisplay]);
        }
        elseif($storeResult === 'comment')
        {
            $user_id = $upvoterstodisplay;
            $upvotersNamequerystmt->bind_param('i', $user_id);

        }
        $upvotersNamequerystmt->execute();
        if($storeResult === "respect") {
            $upvotersNamequerystmt->bind_result($respecterUsername,$respecterFirstName,$respecterLastName);

        }
        elseif($storeResult === "upvote")
        {
            $upvotersNamequerystmt->bind_result($upvoterUsername,$upvoterFirstName,$upvoterLastName);

        }
        elseif($storeResult === "comment")
        {
            $upvotersNamequerystmt->bind_result($commenterUsername,$commenterFirstName,$commenterLastName);

        }
        $upvotersNamequerystmt->store_result();


    } else {
        echo 'error connecting to the databases';

    }
    while ($upvotersNamequerystmt->fetch()) {

    }
    if($storeResult == "respect") {
        return $respecterUsername;
    }
    elseif($storeResult === "upvote")
    {
        return $upvoterUsername;

    }
    elseif($storeResult === "comment")
    {
        return $commenterFirstName. ' ' ."$commenterLastName";

    }


}






