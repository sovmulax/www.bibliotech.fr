<?php include './connexion.php';
$oeuvre = $_GET['id_oeuvre'];
$delete = $connexion->query('SELECT * FROM exemplaires WHERE oeuvre_exem_id = \'' . $oeuvre . '\'');
while($sup = $delete->fetch()){
    $id = $sup['id'];
    $deletes = $connexion->prepare('DELETE FROM exemplaires WHERE id = :id');
    $deletes->execute(['id' => $id]);
    #$deletes->fetch();
}
//supprimer un livre
$livre = $connexion->prepare('DELETE FROM oeuvre WHERE id = :id');
$livre->execute(['id' => $oeuvre]);

$livres = $connexion->prepare('DELETE FROM livres WHERE oeuvre_id = :id');
$livres->execute(['id' => $oeuvre]);
header('Location: ../Views/livres.php');