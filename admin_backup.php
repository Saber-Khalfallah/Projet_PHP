<?php
include_once('connexion.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>

    <?php if ($isAdmin): ?>
        
        <h2>Admin Options:</h2>
        <ul>
            <li><a href="see_internaute.php">show all internautes</a></li>
            <li><a href="add_internaute_form.php">Add an internaute</a></li>
            <li><a href="remove_internaute_form.php">Remove an internaute</a></li>
            <li><a href="see_reaction.php">show all available Reactions</a></li>
            <li><a href="add_reaction_form.php">Add a Reaction</a></li>
            <li><a href="remove_reaction_form.php">Remove a Reaction</a></li>
            <li><a href="see_publication.php">Show available Publications</a></li>
            <li><a href="add_publication.php">Add a Publication</a></li>
            <li><a href="remove_publication_form.php">Remove a Publication</a></li>
            <li><a href="see_user_reaction.php">Show all Users Reaction</a></li>
            <li><a href="add_user_reaction_form.php">Add a User Reaction</a></li>
            <li><a href="remove_user_reaction_form.php">Remove a User's Reaction</a></li>
           
        </ul>
    <?php else: ?>
        <p>You do not have permission to access this page.</p>
    <?php endif; ?>

    <br><a href="logout.php">Logout</a>
</body>
</html>
