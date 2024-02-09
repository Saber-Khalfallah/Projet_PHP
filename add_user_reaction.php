<?php
include_once('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idInter = $_POST["idInter"];
    $codePub = $_POST["codePub"];
    $codeR = $_POST["codeR"];
    $datePub = $_POST["datePub"];
    $heurePub = $_POST["heurePub"];

    $checkIdInterSql = "SELECT COUNT(*) AS count FROM Internaute WHERE IdInter = :idInter";
    $checkIdInterStmt = $db->prepare($checkIdInterSql);
    $checkIdInterStmt->bindParam(':idInter', $idInter);
    $checkIdInterStmt->execute();
    $idInterExists = ($checkIdInterStmt->fetch(PDO::FETCH_ASSOC)['count'] > 0);

    $checkCodePubSql = "SELECT COUNT(*) AS count FROM Publication WHERE CodePub = :codePub";
    $checkCodePubStmt = $db->prepare($checkCodePubSql);
    $checkCodePubStmt->bindParam(':codePub', $codePub);
    $checkCodePubStmt->execute();
    $codePubExists = ($checkCodePubStmt->fetch(PDO::FETCH_ASSOC)['count'] > 0);
    $checkCodeRSql = "SELECT COUNT(*) AS count FROM Reaction WHERE CodeR = :codeR";
    $checkCodeRStmt = $db->prepare($checkCodeRSql);
    $checkCodeRStmt->bindParam(':codeR', $codeR);
    $checkCodeRStmt->execute();
    $codeRExists = ($checkCodeRStmt->fetch(PDO::FETCH_ASSOC)['count'] > 0);

    if ($idInterExists && $codePubExists && $codeRExists) {
        $insertSql = "INSERT INTO Suivi (IdInter, CodePub, CodeR, DatePub, HeurePub) VALUES (:idInter, :codePub, :codeR, :datePub, :heurePub)";
        $insertStmt = $db->prepare($insertSql);
        $insertStmt->bindParam(':idInter', $idInter);
        $insertStmt->bindParam(':codePub', $codePub);
        $insertStmt->bindParam(':codeR', $codeR);
        $insertStmt->bindParam(':datePub', $datePub);
        $insertStmt->bindParam(':heurePub', $heurePub);

        try {
            $insertStmt->execute();
            echo "User reaction added successfully.";
            header('location: see_user_reaction.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        $missingKey = $idInterExists ? ($codePubExists ? 'CodeR' : 'CodePub') : 'IdInter';
        echo "$missingKey does not exist in the respective table.";
        echo '<li class="link"><a href="add_user_reaction_form.php" class="nav__btn">go back</a></li>';
    }
} else {
    echo "Invalid request.";
}
?>
