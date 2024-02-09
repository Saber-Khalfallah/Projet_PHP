<?php

require "connexion.php";

$IdInter =$_POST['IdInter'];
$sql = "DELETE FROM internaute WHERE IdInter = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $IdInter);

try {
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->rowCount() > 0) {
        echo "Internaute supprimé avec succés.";
        header("location: see_internaute.php");
    } else {
        echo "internaute avec  ID $IdInter n existe pas ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>