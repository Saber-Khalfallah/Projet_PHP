<?php
include_once('connexion.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
$adminID=$_SESSION['user'];
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'];
$sql1 = "SELECT * FROM internaute WHERE IdInter = :adminID";
$stmt1 = $db->prepare($sql1);
$stmt1->bindParam(':adminID', $adminID);
$stmt1->execute();
$row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$username=$row1[0]['Pseudo'];
?>

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
        
      </ul>
    </nav>
    <section class="container">
      <div class="content__container">
        <h1>
          
          <span class="heading__1"><?php echo $username ?> Dashboard</span><br />
          
        </h1>
        <?php if ($isAdmin): ?>
        
        <h2>Admin Options:</h2>
        <ul class="nav_links">
            <li class="link"><a class="nav__btn" href="see_internaute.php">show all internautes</a></li>
            <li class="link"><a class="nav__btn" href="see_reaction.php">show all available Reactions</a></li>
            <li class="link"><a class="nav__btn" href="see_publication.php">Show available Publications</a></li>
            <li class="link"><a class="nav__btn" href="see_user_reaction.php">Show all Users Reaction</a></li>
           
        </ul>
    <?php else: ?>
        <p>You do not have permission to access this page.</p>
    <?php endif; ?>

    </div>
      </div>
      <div class="image__container">
        <img src="assets/img1.jpg" alt="header" />
        <img src="assets/img2.jpg" alt="header" />
        
      </div>
    </section>
  </body>
</html>
