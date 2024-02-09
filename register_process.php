<?php
include_once('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];
    $sql0 = "SELECT * FROM internaute";
    
// Prepare the query
$stmt = $db->prepare($sql0);

// Execute the query
$stmt->execute();

// Get the row count
$rowCount = $stmt->rowCount();
$IdInter='ID'.$rowCount;

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Internaute (Pseudo, Password,IdInter) VALUES ('$pseudo', '$hashedPassword','$IdInter')";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();

        echo "Registration successful. You can now <a href='login.php'>login</a>.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
