<?php
include_once('connexion.php');
session_start();

if (!isset($_SESSION['user'])) {
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
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'];
$sql = "SELECT * FROM Internaute";
$stmt = $db->query($sql);
$internautes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <li class="link"><a href="admin.php" class="nav__btn">Admin Dashboard</a></li>
        
      </ul>
    </nav>
    <section class="container">
      <div class="content__container">
        <h1>
          
          <span class="heading__1">List of internautes</span><br />
          
        </h1>
        <table id="customers">
        <tr>
            <th>Internaute ID (IdInter)</th>
            <th>Pseudo</th>
        </tr>

        <?php foreach ($internautes as $internaute): ?>
            <tr>
                <td><?php echo $internaute['IdInter']; ?></td>
                <td><?php echo $internaute['Pseudo']; ?></td>
                <td>
                    <form action="remove_internaute.php" method = "post"><input type="hidden" <?php echo 'value='.$internaute['IdInter']?> name="IdInter"><button type="submit" >delete</button>
                    </form>
                    <button type="submit" ><a href="update_internaute_form.php">Update</a></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a class="button" href="add_internaute_form.php">Add internaute</a>
    </div>
      </div>
      <div class="image__container">
        <img src="assets/img1.jpg" alt="header" />
        <img src="assets/img2.jpg" alt="header" />
        
      </div>
    </section>
  </body>
</html>