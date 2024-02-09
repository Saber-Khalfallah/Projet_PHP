<?php

require "connexion.php";

$CodeR =$_POST['CodeR'];
$sql = "DELETE FROM reaction WHERE CodeR = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $CodeR);

try {
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Reaction supprimé avec succés.";
        header('location: see_reaction.php');
    } else {
        echo "Reaction avec Code $CodeR n existe pas ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>