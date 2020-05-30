<?php
function getFriendsList($arrayToExplode)
{

$arrayToExplode= explode(", ",$arrayToExplode);
$countFriendArray = count($arrayToExplode);
$countFriendArray -= 1;
 return (array_slice($arrayToExplode,0,$countFriendArray));
//

}

function countFollowers($arrayToExplode)
{

$arrayToExplode= explode(", ",$arrayToExplode);
$countFriendArray = count($arrayToExplode);
$countFriendArray -= 1;
 return ($countFriendArray);
//

}
 ?>
