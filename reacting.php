<!-- add_reaction.php -->
<?php
include_once('connexion.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user'];
    $codePub = $_POST["codePub"];
    $codeR = $_POST["reaction"];
    $datePub = date("Y-m-d"); // Current date
    $heurePub = date("H:i:s"); // Current time

    // Check if the user is reacting to an existing publication
    $sqlCheckPublication = "SELECT 1 FROM Publication WHERE CodePub = :codePub";
    $stmtCheckPublication = $db->prepare($sqlCheckPublication);
    $stmtCheckPublication->bindParam(':codePub', $codePub);
    $stmtCheckPublication->execute();

    if ($stmtCheckPublication->fetchColumn()) {
        // Insert the reaction into the Suivi table
        $sqlAddReaction = "INSERT INTO Suivi (IdInter, CodePub, CodeR, DatePub, HeurePub) VALUES (:userId, :codePub, :codeR, :datePub, :heurePub)";
        $stmtAddReaction = $db->prepare($sqlAddReaction);
        $stmtAddReaction->bindParam(':userId', $userId);
        $stmtAddReaction->bindParam(':codePub', $codePub);
        $stmtAddReaction->bindParam(':codeR', $codeR);
        $stmtAddReaction->bindParam(':datePub', $datePub);
        $stmtAddReaction->bindParam(':heurePub', $heurePub);

        if ($stmtAddReaction->execute()) {
            echo "Reaction added successfully.<a href='user.php'>Back To User Dashboard</a>";
        } else {
            echo "Error adding reaction: " . $stmtAddReaction->errorInfo()[2];
        }
    } else {
        echo "Publication not found.";
    }
}
?>