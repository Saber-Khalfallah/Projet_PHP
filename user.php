<?php
include_once('connexion.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user'];
$sql = "SELECT * FROM Suivi WHERE IdInter = :userId";
$stmt = $db->prepare($sql);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$reactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql1 = "SELECT * FROM internaute WHERE IdInter = :userId";
$stmt1 = $db->prepare($sql1);
$stmt1->bindParam(':userId', $userId);
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
        <ul>
            <?php foreach ($reactions as $reaction): ?>
                <li><?php echo $reaction['IdInter'] . ' : ' .$reaction['CodePub'].' : '. $reaction['CodeR'].' : '.  $reaction['DatePub'] . ': ' . $reaction['HeurePub']; ?></li>
            <?php endforeach; ?>
        </ul>
        <h1><span class="heading__1">Add Reaction:</span></h1>
     <div class="content__container">           
        <form action="reacting.php" method="post">
            <label for="codePub">Publication Code (CodePub):</label>
            <input type="text" name="codePub" required>
            <br>

            <label for="reaction">Choose Reaction:</label>
            <select name="reaction" required>
                <?php
                $sqlGetReactions = "SELECT * FROM Reaction";
                $stmtGetReactions = $db->query($sqlGetReactions);
                $reactionsList = $stmtGetReactions->fetchAll(PDO::FETCH_ASSOC);
                foreach ($reactionsList as $reaction) {
                    echo '<option value="' . $reaction['CodeR'] . '">' . $reaction['LibelleReaction'] . '</option>';
                }
                ?>
            </select>

            <button type="submit">React</button>
        </form>
    </div>
      </div>
      <div class="image__container">
        <img src="assets/img1.jpg" alt="header" />
        <img src="assets/img2.jpg" alt="header" />
        
      </div>
    </section>
  </body>
</html>
