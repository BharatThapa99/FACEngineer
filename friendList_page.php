<?php
include ('./friendlist.php');
 ?>
  <html>
  <head>
  </head>
  <body>
<table style="border: 1px solid black;">
  <?php
  if(isset($friendList)){
  foreach ($friendList as $value) {
    // code...
    echo "<tr>
      <td><a href=\"profile.php?u=$value\">@$value</a></td>

    </tr>";
  }
}
else {
  echo "Cureently you have no friends to show";
}

?>
</table>



  </body>
  </html>
