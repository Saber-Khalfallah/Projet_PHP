<?php

require "connexion.php";

$CodePub =$_POST['CodePub'];
$IdInter=$_POST['IdInter'];
$CodeR=$_POST['CodeR'];
$DatePub=$_POST['DatePub'];
$HeurePub=$_POST['HeurePub'];


$sql = 'UPDATE suivi SET
    CodePub=:CodePub,CodeR=:CodeR,IdInter=:IdInter,DatePub=:DatePub,HeurePub=:HeurePub
    WHERE
    suivi.CodePub=:CodePub and 
    suivi.CodeR=:CodeR and 
    suivi.IdInter=:IdInter ';
    
$stmt = $db->prepare($sql);
$stmt->bindParam(':CodePub', $CodePub);
$stmt->bindParam(':CodeR', $CodeR);
$stmt->bindParam(':IdInter', $IdInter);
$stmt->bindParam(':DatePub', $DatePub);
$stmt->bindParam(':HeurePub',$HeurePub);


$stmt->execute();


echo "ajouter avec succés";
header('location:see_user_reaction.php');
?>