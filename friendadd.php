<?php
    require_once("functions/authenticate.php");
    require_once("functions/user.php");
    require_once("functions/usermanager.php");

    $lAuth = new Authenticate();
    $lAuth->RedirectCheckAuth();

    $lUser = $lAuth->GetUser();
    $lUserManager = new UserManager();

    if (isset($_POST['addfriend']) && isset($_POST['emailId'])) {
        $lAddUser = new User("",$_POST['emailId'],"","");
        $lUser->AddFriend($lAddUser);
    }

    $lData = $lUserManager->GetAllNonFriendsMutualConnections($lUser); 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="description" content="FriendBook Assignment content value."/>
  <meta name="keywords" content="FriendBook,Assignment"/>
  <meta name="author" content="xxxxxxxxx"/>
  <title>FriendBook Assignment 02 - FriendAdd</title>
  <!-- Stylesheets  -->
  <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <!-- Page Title & Navigation links-->
    <header>
        <?php include ("functions/header.inc");?>
        <nav>
            <?php include ("functions/menuLogin.inc");?>
        </nav>
    </header>
    <hr/>
    <article>
        <section id="headInfo">
            <?php echo "<h2>".$lUser->GetProfileName()." FriendBook  Add Page </h2>"?>
            <?php echo "<h4> Total number of friends : ".$lUser->GetFriendCount()."</h4>"?>
        </section>
        <section id="friendList">
            <?php
                             
                if (!empty($lData))
                {
                    echo "<table>\n <thead>\n";
                    echo "<tr>\n"
                        ."<th scope=\"col\">Profile Name</th>\n"
                        ."<th scope=\"col\">Mutual Connection</th>\n"
                        ."<th scope=\"col\">Action</th>\n"
                        ."</tr>\n </thead> \n <tbody> ";

                    for($i = 0; $i <= count($lData)-1; $i++)
                    {
                        echo "<tr>\n";
                        echo "<td>",$lData[$i]->GetProfileName(),"</td>\n";
                        echo "<td>",$lData[$i]->GetMutualKnowns(),"</td>\n";
                        echo '<td> <form method="post" action="">
                                        <input type="submit" name="addfriend" value="Add Friend"/>
                                        <input type="hidden" name="emailId" value="'.$lData[$i]->GetEmail().'"/>
                                    </form>
                            </td>'."\n";
                        echo "</tr>\n";
                    }
                    
                    echo "</tbody></table>\n";
                }
            ?>
        </section>
    </article>   
    <!-- Footer section --> 
    <footer>
        <?php include ("functions/footer.inc");?>
    </footer>
</body>
</html>