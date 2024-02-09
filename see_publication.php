
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
$sql = "SELECT * FROM Publication";
$stmt = $db->query($sql);
$publications = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
          
          <span class="heading__1">List of Publications</span><br />
          
        </h1>
    <table id="customers">
        <tr>
            <th>Publication Code (CodePub)</th>
            <th>Publication Type (TypePub)</th>
        </tr>

        <?php foreach ($publications as $publication): ?>
            <tr>
                <td><?php echo $publication['CodePub']; ?></td>
                <td><?php echo $publication['TypePub']; ?></td>
                <td>
                    <form action="remove_publication.php" method = "post"><input type="hidden" <?php echo 'value='.$publication['CodePub']?> name="CodePub"><button type="submit" >delete</button>
                    </form>
                    <button type="submit" ><a href="update_publication_form.php">Update</a></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a class="button" href="add_publication_form.php">Add Publication</a>
    </div>
      </div>
      <div class="image__container">
        <img src="assets/img1.jpg" alt="header" />
        <img src="assets/img2.jpg" alt="header" />
        
      </div>
    </section>
  </body>
</html>