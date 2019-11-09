<?php
    require_once("functions/authenticate.php");
    require_once("functions/user.php");

    $lAuth = new Authenticate();
    $lAuth->RedirectCheckAuth();

    $lUser = $lAuth->GetUser();

    if (isset($_POST['unfriend']) && isset($_POST['emailId'])) {
        $lRemoveUser = new User("",$_POST['emailId'],"","");
        $lUser->RemoveFriend($lRemoveUser);
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="description" content="FriendBook Assignment content value."/>
  <meta name="keywords" content="FriendBook,Assignment"/>
  <meta name="author" content="xxxxxxxxx"/>
  <title>FriendBook Assignment 02 - FriendList</title>
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
            <?php echo "<h2>".$lUser->GetProfileName()." FriendBook  List Page </h2>"?>
            <?php echo "<h4> Total number of friends : ".$lUser->GetFriendCount()."</h4>"?>
        </section>
        <section id="friendList">
            <?php
              if ($lUser->GetFriendCount() != 0)
              {
                $lData = $lUser->GetFriendList();

                echo "<table>\n <thead>\n";
                echo "<tr>\n"
                    ."<th scope=\"col\">Profile Name</th>\n"
                    ."<th scope=\"col\">Action</th>\n"
                    ."</tr>\n </thead> \n <tbody> ";

                foreach($lData as $lUser)
                {
                    echo "<tr>\n";
                    echo "<td>",$lUser->GetProfileName(),"</td>\n";
                    echo '<td> <form method="post" action="">
                                     <input type="submit" name="unfriend" value="Unfriend"/>
                                     <input type="hidden" name="emailId" value="'.$lUser->GetEmail().'"/>
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