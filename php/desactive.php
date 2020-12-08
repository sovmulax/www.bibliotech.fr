<?php
session_start();
include './connexion.php';
$val = false;
$req = $connexion->prepare('UPDATE gestionnaire SET actif = :val WHERE email = :email');
$req->execute(array('val' => $val, 'email' => $_GET['mail']));
header('Location: ../index.php');
exit();