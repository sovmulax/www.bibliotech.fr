<?php
include("./parts/head.php");
include('../php/connexion.php');
//requete
$sql = "SELECT * FROM exemplaires WHERE emprunter = true";
$result0 = mysqli_query($conn, $sql);
$livres = mysqli_fetch_all($result0, MYSQLI_ASSOC);
mysqli_free_result($result0);
include("./parts/section/nav.php");
include("./parts/section/header.php"); ?>
<div class="contain">
    <?php include("./parts/section/search.php"); ?>
    <div class="cards">
        <h2 class="header">Liste des Exemplaires Emprunter</h2>
        <div class="services">
            <?php foreach ($livres as $livre) : ?>
                <div class="content">

                    <h2><?php $req = $connexion->prepare('SELECT nom FROM oeuvre WHERE id = :id_structure');
                                    $req->execute(['id_structure' => $livre['oeuvre_exem_id']]);
                                    $res = $req->fetch();
                                    echo '#'.$livre['id'].' '.$res['nom']; ?></h2>
                    <p>
                        <h3>Auteur : <?php $req = $connexion->prepare('SELECT nom FROM auteur WHERE id = :id_structure');
                                    $req->execute(['id_structure' => $livre['auteur_exem_id']]);
                                    $res = $req->fetch();
                                    echo $res['nom']; ?></h3>
                        <h3>Catégorie : <?php $req = $connexion->prepare('SELECT nom FROM categorie WHERE id = :id_structure');
                                    $req->execute(['id_structure' => $livre['categorie_exem_id']]);
                                    $res = $req->fetch();
                                    echo $res['nom']; ?></h3>
                        <h3>Types : <?php $req = $connexion->prepare('SELECT nom FROM types WHERE id = :id_structure');
                                    $req->execute(['id_structure' => $livre['types_exem_id']]);
                                    $res = $req->fetch();
                                    echo $res['nom']; ?></h3>
                    </p>
                    
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>