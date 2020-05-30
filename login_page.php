    <title>Login</title>

<?php
//here is no use of u variable

include ('./inc/header.inc.php');





?>
<?php

if(isset($_SESSION['error']))
{
      echo "<h3 style = \"color: red;\">". $_SESSION['error']." </h3>";
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/facengineer.css">


</head>
<body>
    <div class="box">
        <h1>Log in</h1>
        <form action = "login.php" method = "POST">

                <p>Username</p>
                <input type="text" name = "user_login" placeholder="Username" value = '<?php if(isset($_SESSION['username']))echo "$username"; ?>'required>

                <p>Email Address</p>
                <input type="email" name = "user_email" value = '<?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];}else echo "@gmail.com"; ?>' required>


                <p>Password</p>
                <input type="password" name="password_login" placeholder="Password" required>

                <input type="submit" name = "login" value="Login">

            <div class="forget">
                <a href="password_reset_page.php">Forget your password?</a>
            </div>

            <div class="New">
                <a href="signup_page.php">Create New Account.</a>
            </div>

        </form>

</body>
</html>
