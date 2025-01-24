<?php

    session_start();
    require_once("../controller/AuthCheck.php");
    if (!isset($_SESSION['username'])) {
        session_unset();
        session_destroy();

?>

        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <link rel="stylesheet" href="../asset/css/style.css">
            <link rel="stylesheet" href="../asset/css/login.css">
        </head>
        <body>
            <main>
                <section class="login-container">
<?php
    if(isset($_GET['message']) && $_GET['message'] === 'account_created'){

?>
                
                <p align="center"><b>Account successfully created, Please login to access your account.</b></p>
<?php

    }
?>
                    <fieldset>

                        <legend>
                        <h2>JobJunction</h2>    
                        <h3>Login</h3></legend>
                        <form action="../controller/checkLogin.php" method="post">
                            <div class="input-group">
                                <label for="username"><b>UserName:</b></label>
                                <input type="text" name="username" id="username" required>
                            </div>
                            <div class="input-group">
                                <label for="password"><b>Password:</b></label>
                                <input type="password" name="password" id="password" required>
                            </div>
                            <?php require("../controller/errorShowing.php");?>
                            <hr>
                            <div class="actions">
                                <input type="submit" value="Login">
                                <a href="../view/signup.php">Signup</a>
                            </div>
                        </form>
                    </fieldset>
                </section>
            </main>
        </body>
        </html>
        

<?php
    }
    
    else {

        $userType = getUserType();
        $redirectPage = $userType."Dashboard.php";
        header("location: ../view/$redirectPage");
        exit();
    }
?>

