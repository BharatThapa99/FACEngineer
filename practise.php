<?php
  include 'practiseClass/class.inc.php';
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>oop practise</title>
  </head>
  <body>
  <?php
    $person1 = new person();
    $person1 -> setName("bharat");
    echo $person1 -> name;
   ?>
  </body>
</html>
