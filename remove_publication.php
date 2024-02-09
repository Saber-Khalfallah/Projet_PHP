<?php

require "connexion.php";

$CodePub =$_POST['CodePub'];
$sql = "DELETE FROM publication WHERE CodePub = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $CodePub);

try {
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->rowCount() > 0) {
        echo "Publication supprimé avec succés.";
        header('location: see_publication.php');
    } else {
        echo "Publication avec  CodePub $CodePub n existe pas ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>