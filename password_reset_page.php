<?php

include ('./inc/connect.inc.php');


?>

<title>
Change password
</title>

    <link rel="stylesheet" href="css/facengineer.css">

   
    

    <div class = "box">

  <form action = "password_change.php" method = "POST">
          <p>Email Address</p>
                <input type="email" name = "password_change_email" value = "@gmail.com" required>  

               
        
 <p>New Password</p>
                <input type="password" name="new_password_change" placeholder="Enter new password" required>
  <p>Retype New Password</p>
                <input type="password" name="retype_new_password_change" placeholder="Re-Enter new password" required>
                    
              <br>
              <br>
                <input type="submit" name = "change_password" value="Change">
</form>
</div>