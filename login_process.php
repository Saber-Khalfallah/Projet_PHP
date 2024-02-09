<?php
include_once('connexion.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM Internaute WHERE Pseudo = :pseudo";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $row["Password"];
            if (password_verify($password, $hashedPassword)) {
                echo 'true';    
                $_SESSION['user'] = $row["IdInter"];

                if ($row["IdInter"] == 'ID1') {
                    $_SESSION['admin'] = true;
                    header("Location: admin.php");
                    exit();
                } else {
                    header("Location: user.php");
                    exit();
                }
            } else {
                $error = "Incorrect password.";
                header('location :login.php');
                exit();
                

            }
        } else {
            $error = "Username not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php  echo $error; ?></p>
    <?php endif; ?>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>
</html>