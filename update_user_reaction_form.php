<?php
include_once('connexion.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
$adminID=$_SESSION['user'];
$sql1 = "SELECT * FROM internaute WHERE IdInter = :adminID";
$stmt1 = $db->prepare($sql1);
$stmt1->bindParam(':adminID', $adminID);
$stmt1->execute();
$row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$username=$row1[0]['Pseudo'];
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'];?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Web Design Mastery | Learning Landing Page</title>
  </head>
  <body>
    <nav>
      <div class="nav__logo"><a href="#">Suivi Reactions</a></div>
      <ul class="nav__links">
       
        <?php   if (!isset($_SESSION['user']))
                { echo '<li class="link"><a href="login.php" class="nav__btn">Login</a></li>';
                }
                else
                {
                    echo '<li class="link"><a href="logout.php" class="nav__btn">Logout('.$username.')</a></li>';
                }
                ?>
        <li class="link"><a href="index.php" class="nav__btn">Homepage</a></li>
        <li class="link"><a href="admin.php" class="nav__btn">Admin Dashboard</a></li>
        
      </ul>
    </nav>
    <section class="container">
      <div class="content__container">
        <h1>
          
          <span class="heading__1">Update</span><br />
          
        </h1>
    <form action="update_user_reaction.php" method="post">
        <input type="text" name="idInter" placeholder="ID internaute "required>
        <input type="text" name="codePub" placeholder="Publication Code(CodePub)"required>
        <input type="text" name="codeR" placeholder="Reaction Code(CodeR)"required>

        <label for="datePub">DatePub:</label>
        <input type="date" name="datePub" required>

        <label for="heurePub">HeurePub:</label>
        <input type="time" name="heurePub" required>

        <div class="link">
            <button type="submit" class="login">Update</button>
            <a href="see_user_reaction.php" class="forgot">Cancel</a>
          </div>
          <hr>
       
      </div>
      <div class="image__container">
        <img src="assets/img1.jpg" alt="header" />
        <img src="assets/img2.jpg" alt="header" />
        
      </div>
    </section>
  </body>
</html>