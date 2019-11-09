<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="description" content="FriendBook Assignment content value."/>
  <meta name="keywords" content="FriendBook,Assignment"/>
  <meta name="author" content="xxxxxxxxx"/>
  <title>FriendBook Assignment 02 - About</title>
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
        <!-- Section Introduction-->
        <section id="aboutSection">
            <h2>About</h2>
            <p>List of Answers: </p>
            <ul>
                <?php
                echo "<li> Current PHP version: ".phpversion()."</li>"
                ?>
                <li>All tasks completed and all pages HTML5 validated, except for page numbering. </li>
                <li>Extra Features : None. </li>          
            </ul>
            <!-- Image of Discussion -->
            <p>Discussion</p>
            <figure id="discussionImage"> 
                <img src="images/image_discussion.JPG" alt=" Image of Discussion" height="401" width="673"/>
            </figure>
            <p>Pages</p>
            <ul>
                <li>Hidden pages
                    <ol>
                        <li><a href="friendlist.php">Friend List</a></li>
                        <li><a href="friendadd.php">Friend Add</a></li>
                    </ol>
        </section>
    </article>    
    <!-- Footer section --> 
    <footer>
        <?php include ("functions/footer.inc");?>
    </footer>
</body>
</html>