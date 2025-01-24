<html>
<head>
  <title>Sign Up</title>
  <link rel="stylesheet" href="../asset/css/index.css">
  <link rel="stylesheet" href="../asset/css/signup.css">
  <script src="../asset/js/signUpValiditon.js"></script>

</head>

<body>   
    <table cellspacing="0" align="center">
        <tr height="10%">
            <td>
            <fieldset>
              <legend> <h2>Sign Up</h2></legend>
              <form onsubmit="return validateSignUpForm();" action="../controller/checkSignup.php" method="post" >
                  
                  <label for="username">User name:</label><br>
                  <input type="text" id="username" name="username" required><br>
                  <div id="usererror" class="diverror"></div>
                  <?php
                    require("../controller/errorShowing.php");
                  ?> 
                  <br>

                  <label for="email">Email:</label><br>
                  <input type="email" id="email" name="email" required><br><br>
                  <div id="emailerror" class="diverror"></div>

                  <label for="password">Password:</label><br>
                  <input type="password" id="password" name="password" required><br>
                  <div id="passerror" class="diverror"></div><br>

                  <label for="repassword">ReTypePassword:</label><br>
                  <input type="password" id="repassword" name="repassword" required><br>
                  <div id="repasserror" class="diverror"></div><br>


                  <label for="user_type">User Type:</label><br>
                  <select id="user_type" name="user_type" required>
                    <option value="freelancer">Freelancer</option>
                    <option value="client">Client</option>
                  </select><br><br>

                  <input type="submit" value="Sign Up">
                  <a href="login.php">Login</a>
              </form>
            </fieldset>
            </td>     
    </table> 
</body>
</html>
