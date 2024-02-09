
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

$sql = "SELECT * FROM Suivi";
$stmt = $db->query($sql);
$userReactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
          
          <span class="heading__1">List of users reactions</span><br />
          
        </h1>

    <table id="customers">
        <tr>
            <th>Internaute ID (IdInter)</th>
            <th>Publication Code (CodePub)</th>
            <th>Reaction Code (CodeR)</th>
            <th>DatePub</th>
            <th>HeurePub</th>
        </tr>

        <?php foreach ($userReactions as $userReaction): ?>
            <tr>
                <td><?php echo $userReaction['IdInter']; ?></td>
                <td><?php echo $userReaction['CodePub']; ?></td>
                <td><?php echo $userReaction['CodeR']; ?></td>
                <td><?php echo $userReaction['DatePub']; ?></td>
                <td><?php echo $userReaction['HeurePub']; ?></td>
                <td width='200px'>
                    <form action="remove_user_reaction.php" method = "post">
                        <input type="hidden" <?php echo 'value='.$userReaction['IdInter']?> name="IdInter">
                        <input type="hidden" <?php echo 'value='.$userReaction['CodePub']?> name="CodePub">
                        <input type="hidden" <?php echo 'value='.$userReaction['CodeR']?> name="CodeR">
                        <input type="hidden" <?php echo 'value='.$userReaction['DatePub']?> name="DatePub">
                        <input type="hidden" <?php echo 'value='.$userReaction['HeurePub']?> name="HeurePub">
                    <button type="submit" >delete</button>
                    </form>
                    <button type="submit" ><a href="update_user_reaction_form.php">Update</a></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a class="button" href="add_user_reaction_form.php">Add a user's reaction</a>
    </div>
      </div>
      <div class="image__container">
        <img src="assets/img1.jpg" alt="header" />
        <img src="assets/img2.jpg" alt="header" />
        
      </div>
    </section>
  </body>
</html>