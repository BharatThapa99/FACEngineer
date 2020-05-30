<?php
ini_set('display_errors','1');
include ('./inc/header.inc.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css\signin.css">
    <script type="text/javascript" src="./js/validate.js">

    </script>
    <link rel="stylesheet" href="css/facengineer.css">

    <title>Signin</title>
</head>
<body>
  <div>
      <div id="error">
        <p id="errormsg"><?php
        if(isset($error))
        {
          foreach ($error  as $value) {
            echo "<h3 style=\"color:red\">".$value."</h3>";
            // code...
          }
        }

       ?></p>
      </div>

  </div>



    <div class="signinbox">
        <form action = "signin.php" method = "POST" >
            <h1>Sign In</h1>
              <p>Username</p>
            <input id="username" type="text" name="username" placeholder="Username" value="<?php if(isset($_SESSION['signup_username'])) {echo $_SESSION['signup_username'];} ?>">

            <p>First Name</p>
            <input id="firstname" type="text" name="firstname" placeholder="First Name" value="<?php  if(isset($_SESSION['signup_firstname'])) {echo $_SESSION['signup_firstname'];} ?>">
            <p>Last Name</p>
            <input id="lastname" type="text" name ="lastname" placeholder="Last name" value="<?php  if(isset($_SESSION['signup_lastname'])) {echo $_SESSION['signup_lastname'];} ?>">

            <p>Email Address</p>
            <input id="email" type="email" name= "email"  placeholder="Email address" value="<?php  if(isset($_SESSION['signup_email'])) {echo $_SESSION['signup_email'];} ?>">

            <p>Password</p>
            <input id="password" type="password" name= "password" placeholder="Password" value="<?php  if(isset($_SESSION['signup_password'])) {echo $_SESSION['signup_password'];}  ?>">

            <p>Re-Type Password</p>
            <input id="password1" type="password" name = "password1"placeholder="Re-Type Password" value="<?php if(isset($_SESSION['signup_password1'])) {echo $_SESSION['signup_password1'];} ?>">


            <input type="submit" name = "signin" value="SignIn" >
        </form>



   <?php
include ('./inc/footer.inc.php');


?>
