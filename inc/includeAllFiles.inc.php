<?php
$DIR = "/var/www/html/project";
include ($DIR.'/inc/header.inc.php');
//for d

//include ($DIR.'/inc/menu.inc.php');
include ($DIR.'/inc/textfilter.php');
include ($DIR.'/inc/loggedInUserDetails.php');


include ($DIR.'/functions/getFriendslist.php');
include ($DIR.'/functions/getFirstNameOfUpvotersandCount.function.php');

