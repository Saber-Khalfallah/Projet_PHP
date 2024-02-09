<?php

require "connexion.php";

$CodeR =$_POST['CodeR'];
$libelleR=$_POST['LibelleR'];

$sql = 'UPDATE reaction SET CodeR=:CodeR,libelleReaction=:libelleR WHERE Reaction.CodeR=:CodeR';

$stmt = $db->prepare($sql);
$stmt->bindParam(':CodeR', $CodeR);
$stmt->bindParam(':libelleR', $libelleR);
$stmt->execute();


echo "ajouter avec succés";
header('location:see_reaction.php');
?>