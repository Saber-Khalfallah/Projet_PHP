<?php
include_once('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idInter = $_POST["IdInter"];
    $codePub = $_POST["CodePub"];
    $codeR = $_POST["CodeR"];
    $datePub = $_POST["DatePub"];
    $heurePub = $_POST["HeurePub"];
    $checkReactionSql = "SELECT COUNT(*) AS count FROM Suivi WHERE IdInter = :idInter AND CodePub = :codePub AND CodeR = :codeR AND DatePub = :datePub AND HeurePub = :heurePub";
    $checkReactionStmt = $db->prepare($checkReactionSql);
    $checkReactionStmt->bindParam(':idInter', $idInter);
    $checkReactionStmt->bindParam(':codePub', $codePub);
    $checkReactionStmt->bindParam(':codeR', $codeR);
    $checkReactionStmt->bindParam(':datePub', $datePub);
    $checkReactionStmt->bindParam(':heurePub', $heurePub);
    $checkReactionStmt->execute();
    $reactionExists = ($checkReactionStmt->fetch(PDO::FETCH_ASSOC)['count'] > 0);

    if ($reactionExists) {
        $removeReactionSql = "DELETE FROM Suivi WHERE IdInter = :idInter AND CodePub = :codePub AND CodeR = :codeR AND DatePub = :datePub AND HeurePub = :heurePub";
        $removeReactionStmt = $db->prepare($removeReactionSql);
        $removeReactionStmt->bindParam(':idInter', $idInter);
        $removeReactionStmt->bindParam(':codePub', $codePub);
        $removeReactionStmt->bindParam(':codeR', $codeR);
        $removeReactionStmt->bindParam(':datePub', $datePub);
        $removeReactionStmt->bindParam(':heurePub', $heurePub);

        try {
            $removeReactionStmt->execute();
            echo "User reaction removed successfully.";
            header('location: see_user_reaction.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "User reaction not found. Please check the provided details.";
    }
} else {
    echo "Invalid request.";
}
?>
