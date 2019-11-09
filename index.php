<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="description" content="FriendBook Assignment content value."/>
  <meta name="keywords" content="FriendBook,Assignment"/>
  <meta name="author" content="xxxxxxxxx"/>
  <title>FriendBook Assignment 02 - Home</title>
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
        <section id="introduction">
            <h2>
                Introduction
            </h2>
            <!-- Definition List -->
            <dl>
                <dt>Name </dt>
                    <dd> xxxxxxxxx</dd>
                <dt>Student ID </dt>
                    <dd>xxxxxxxxx</dd>
                <dt>Email </dt>
                    <dd><a href="mailto:xxxxxxxxx@student.xxxxxxxxx.edu.au"> xxxxxxxxx@student.xxxxxxxxx</a></dd>         
            </dl>            
            <p>
            I declare that this assignment is my individual work. I have not worked collaboratively nor have I
            copied from any other student’s work or from any other source. 
            </p>   
        </section>
    </article>    
    <!-- Footer section --> 
    <footer>
        <?php include ("functions/footer.inc");?>
    </footer>
</body>
</html>