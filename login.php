<?php
    require_once("functions/authenticate.php");
    require_once("functions/user.php");

    $lAuth = new Authenticate();
    
    $lValidationMsg = SUCCESS;
    if (isset($_POST["email"]) && isset($_POST["password"]))
    {
        $lUser = new User("",$_POST["email"],$_POST["password"],"");
        $lValidationMsg = $lAuth->Login($lUser);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="description" content="FriendBook Assignment content value."/>
  <meta name="keywords" content="FriendBook,Assignment"/>
  <meta name="author" content="xxxxxxxxx"/>
  <title>FriendBook Assignment 02 - Login</title>
  <!-- Stylesheets  -->
  <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <!-- Page Title & Navigation links-->
    <header>
        <?php include ("functions/header.inc");?>
        <nav>
            <?php include ("functions/menu.inc");?>
        </nav>
    </header>
    <hr/>
    <article>
        <!-- Login Error Message -->
        <?php
            if ($lValidationMsg != SUCCESS )
            {
                echo '<section id="validationMsg">';
                echo "<p>Login Error</p>";
                echo "<ul> $lValidationMsg </ul>";
                echo "</section>";
            }
        ?>
        
        <!-- Section Form-->
        <section id="formSection">
            <!-- Start of form submission system -->
            <form method="POST" action="login.php">
                <!-- Login details -->        
                <fieldset id="fieldDetail"> 
                    <legend>Login</legend>
                    <p class="row">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?php echo (isset($_POST["email"])) ? $_POST["email"] : "Enter email"?>" id="email" />
                    </p>
                    <p class="row">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"/>
                    </p>            
                </fieldset>
                <!-- Submit & Reset buttons-->
                <input type="submit" value="Login"/>
                <input type="reset" value="Clear" />
            </form>  
        </section>
    </article>    
    <!-- Footer section --> 
    <footer>
        <?php include ("functions/footer.inc");?>
    </footer>
</body>
</html>