<?php

require "connexion.php";

$CodePub =$_POST['CodePub'];
$TypePub=$_POST['TypePub'];

$sql = 'UPDATE publication SET CodePub=:CodePub,TypePub=:TypePub WHERE publication.CodePub=:CodePub';

$stmt = $db->prepare($sql);
$stmt->bindParam(':CodePub', $CodePub);
$stmt->bindParam(':TypePub', $TypePub);
$stmt->execute();


echo "ajouter avec succés";
header('location:see_publication.php');
?>