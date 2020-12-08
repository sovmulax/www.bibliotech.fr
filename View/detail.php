<?php session_start();
if (!isset($_SESSION['users'])) {
    header('Location: ../index.php');
    exit();
}

include('../php/connexion.php');
$id = $_GET['id'];
//requete
$reqs = $connexion->prepare('SELECT * FROM livres WHERE id = :livre');
$reqs->execute(['livre' => $id]);
$ress = $reqs->fetch();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Detail Livre| BiblioTech</title>
    <link rel="stylesheet" href="../Static/css/formulaire.css" />
    <link rel="stylesheet" href="../Static/css/client.css" />
    <link rel="stylesheet" href="../Static/css/style.css" />
</head>
<body>
    <header>
        <nav class="client-nav">
            <div class="client-title">
                <h1><a href="acceuil.php">BiblioTech</a></h1>
            </div>
            <div class="menu-client">
                <div class="li"><a href="acceuil.php">accueil</a></div>
                <div class="li"><a href="emprunts.php">Emprunts en cour</a></div>
                <div class="li"><a href="profil.php">Profil</a></div>
            </div>
        </nav>
    </header>
    <div class="containt-profil">
        <div class="container-profil">
            <h1 class="book-title"><?php $req = $connexion->prepare('SELECT * FROM oeuvre WHERE id = :photo');
                                    $req->execute(['photo' => $ress['oeuvre_id']]);
                                    $res = $req->fetch();
                                    echo $res['nom']; ?></h1>
            <div class="info-book">
                <div class="img-book">
                    <img src="../Static/img/livres/<?php $req = $connexion->prepare('SELECT * FROM photo WHERE id = :photo');
                                                    $req->execute(['photo' => $ress['photo_id']]);
                                                    $res = $req->fetch();
                                                    echo $res['nom']; ?>" alt="livres">
                </div>
                <div class="detail-book">
                    <h3>Auteur : <?php $req0 = $connexion->prepare('SELECT * FROM auteur WHERE id = :auteur');
                                    $req0->execute(['auteur' => $ress['auteur_id']]);
                                    $res0 = $req0->fetch();
                                    echo $res0['nom']; ?></h3>
                    <h3>Catégorie : <?php $req1 = $connexion->prepare('SELECT * FROM categorie WHERE id = :categorie');
                                    $req1->execute(['categorie' => $ress['categorie_id']]);
                                    $res1 = $req1->fetch();
                                    echo $res1['nom']; ?></h3>
                    <h3>Types : <?php $req2 = $connexion->prepare('SELECT * FROM types WHERE id = :types');
                                $req2->execute(['types' => $ress['types_id']]);
                                $res2 = $req2->fetch();
                                echo $res2['nom']; ?></h3>
                </div>
            </div>

            <div class="resume-book">
                <h2>Résumé du Livre</h2>
                <p>
                    <?php echo $ress['resumes'];
                    $_SESSION['id'] = array('oeuvre' => $ress['resumes']);
                    ?>
                </p>
            </div>

            <button name="client"><a href="acceuil.php">Retour</a></button>
        </div>
</body>

</html>