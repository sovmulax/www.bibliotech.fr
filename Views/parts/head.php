<?php session_start(); 
if (!isset($_SESSION['name'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../Static/css/style.css" type="text/css" />
    <link
      rel="stylesheet"
      href="../Static/css/formulaire.css"
      type="text/css"
    />
    <link rel="stylesheet" href="../Static/css/carte.css">
    <title>Acceuil | BiblioTech</title>
  </head>
  <body>