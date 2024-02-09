<?php

require "connexion.php";

$pseudo =$_POST['pseudo'];
$password=$_POST['password'];
$IdInter=$_POST['IdInter'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql = 'UPDATE Internaute SET Pseudo=:pseudo,Password=:pwd ,IdInter=:IdInter WHERE internaute.IdInter=:IdInter';

$stmt = $db->prepare($sql);
$stmt->bindParam(':pseudo', $pseudo);
$stmt->bindParam(':pwd', $hashedPassword);
$stmt->bindParam(':IdInter', $IdInter);
$stmt->execute();


echo "ajouter avec succés";
header('location:see_internaute.php')
?>