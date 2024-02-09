<?php
$host="localhost";
$user ="root";
$password ='';
$db='gestion_suivis';
$dsn = "mysql:host=$host;dbname=$db;port=3306;charset=utf8";
try{
$db = new PDO($dsn, $user, $password);
$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
echo 'Erreur : ' . $e->getMessage();
exit();
}
?>