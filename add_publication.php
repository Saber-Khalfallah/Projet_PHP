<?php

require "connexion.php";
$typePub=$_POST['typePub'];
$sql = "SELECT * FROM publication";
$stmt = $db->prepare($sql);
$stmt->execute();
$rowCount = $stmt->rowCount();
$codePub='PUB'.$rowCount;
$req="insert into publication values ('$codePub','$typePub')";
$db->exec($req);
echo "ajouter avec succés";
header('location: see_publication.php')
?>