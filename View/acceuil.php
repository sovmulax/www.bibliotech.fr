<?php session_start();
if (!isset($_SESSION['users'])) {
    header('Location: ../index.php');
    exit();
}
//requete
include "../php/connexion.php";
$sql = "SELECT * FROM livres";
$result0 = mysqli_query($conn, $sql);
$livres = mysqli_fetch_all($result0, MYSQLI_ASSOC);
mysqli_free_result($result0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Acceuil Client| BiblioTech</title>
    <link rel="stylesheet" href="../Static/css/carte.css" />
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
                <div class="actives li"><a href="acceuil.php">accueil</a></div>
                <div class="li"><a href="emprunts.php">Emprunts en cour</a></div>
                <div class="li"><a href="profil.php">Profil</a></div>
            </div>
        </nav>
    </header>
    <div class="containt">
        <div class="container">
            <section class="writting-zone">
                <input type="search" id="filter" placeholder="Rechercher" class="search-client" /><i class="fas fa-search position"></i><br>
            </section>
            <div class="cards">
                <h2 class="header">Liste des livres</h2>
                <div class="services" id="block">
                    <?php foreach ($livres as $livre) : ?>
                        <div class="content">

                            <h2><span><?php $req = $connexion->prepare('SELECT nom FROM oeuvre WHERE id = :id_structure');
                                $req->execute(['id_structure' => $livre['oeuvre_id']]);
                                $res = $req->fetch();
                                echo $res['nom']; ?></span></h2>
                            <p>
                                <h3>Auteur : <?php $req = $connexion->prepare('SELECT nom FROM auteur WHERE id = :id_structure');
                                                $req->execute(['id_structure' => $livre['auteur_id']]);
                                                $res = $req->fetch();
                                                echo $res['nom']; ?></h3>
                                <h3>Catégorie : <?php $req = $connexion->prepare('SELECT nom FROM categorie WHERE id = :id_structure');
                                                $req->execute(['id_structure' => $livre['categorie_id']]);
                                                $res = $req->fetch();
                                                echo $res['nom']; ?></h3>
                                <h3>Types : <?php $req = $connexion->prepare('SELECT nom FROM types WHERE id = :id_structure');
                                            $req->execute(['id_structure' => $livre['types_id']]);
                                            $res = $req->fetch();
                                            echo $res['nom']; ?></h3>
                            </p>
                            <a href="./detail.php?id=<?php echo $livre['id']; ?>">Plus...</a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <section class="mini-profil">
            <div class="mini-img">
                <img src="../Static/img/clients/<?php echo $_SESSION['users']['photo']; ?>" alt="profil user">
            </div>
            <h3 class="title-profli"><span class="sapn">Nom:</span> <?php echo $_SESSION['users']['nom']; ?></h3>
            <h3 class="title-profli"><span class="sapn">Prénom : </span> <?php echo $_SESSION['users']['prenom']; ?></h3>
            <h3 class="title-profli"><span class="sapn">E-mail :</span> <?php echo $_SESSION['users']['mail']; ?></h3>
            <h3 class="title-profli"><span class="sapn">Matricule :</span> <?php echo $_SESSION['users']['matricule']; ?></h3>
            <button name="client"><a href="../php/logout_user.php">Déconnecter</a></button>
        </section>
    </div>
</body>
</html>