<?php
session_start();
include './connexion.php';
$val = false;
$req = $connexion->prepare('UPDATE users SET actif = :val WHERE email = :email');
$req->execute(array('val' => $val, 'email' => $_GET['mail']));
header('Location: ../Views/form/client/Carte.php');
exit();