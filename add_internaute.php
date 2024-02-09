<?php

require "connexion.php";

$pseudo =$_POST['pseudo'];
$password=$_POST['password'];
$sql = "SELECT * FROM internaute";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $db->prepare($sql);
$stmt->execute();
$rowCount = $stmt->rowCount();
$IdInter='ID'.$rowCount;
$req= "insert into internaute values ('$IdInter','$pseudo','$hashedPassword')";
$db->exec($req);
echo "ajouter avec succés";
header('location:see_internaute.php')
?>