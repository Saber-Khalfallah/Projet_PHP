<?php

require "connexion.php";
$LibelleReaction=$_POST['LibelleR'];
$sql = "SELECT * FROM reaction";
$stmt = $db->prepare($sql);
$stmt->execute();
$rowCount = $stmt->rowCount();
$CodeR='R'.$rowCount;
$req="insert into reaction values ('$CodeR','$LibelleReaction')";
$db->exec($req);
echo "ajoutée avec succés";
header('location: see_reaction.php')
?>