<?php session_start();
if (!isset($_SESSION['users'])) {
    header('Location: ../index.php');
    exit();
}
include('../php/connexion.php');
//
$id = $_SESSION['users']['photo'];
$var = true;
$i = 1;
$req = $connexion->prepare('SELECT * FROM emprunter WHERE users_id = :id AND en_cour = :cour');
$req->execute(['id' => $id, 'cour' => $var]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Acceuil Client| BiblioTech</title>
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
                <div class="actives li"><a href="emprunts.php">Emprunts en cour</a></div>
                <div class="li"><a href="profil.php">Profil</a></div>
            </div>
        </nav>
    </header>
    <div class="containt">
        <div class="container">
            <div class="tableau">
                <h2>Résumé de Emprunts en cour</h2>
                <table>
                    <tr>
                        <th>N°</th>
                        <th>Exemplaire</th>
                        <th>Date d'emprunt</th>
                        <th>Date de retour Prévu</th>
                    </tr>
                    <?php while ($book = $req->fetch()) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php $req = $connexion->prepare('SELECT * FROM exemplaires WHERE id = :id_structure');
                                $req->execute(['id_structure' => $book['exemplaire_id']]);
                                $res = $req->fetch();
                                //
                                $reqs = $connexion->prepare('SELECT * FROM oeuvre WHERE id = :id_structure');
                                $reqs->execute(['id_structure' => $res['oeuvre_exem_id']]);
                                $ress = $reqs->fetch();
                                echo $ress['nom'];
                                ?></td>
                            <td><?php echo $book['emprunt_date']; ?></td>
                            <td><?php echo $book['date_retour']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <section class="mini-profil">
            <div class="mini-img">
                <img src="../Static/img/clients/<?php echo $_SESSION['users']['photo']; ?>" alt="profil user">
            </div>
            <div class="espace">----------<br></div>
            <p>
                <h3 class="title-profli"><span class="sapn">Nom:</span> <?php echo $_SESSION['users']['nom'] . '<br>'; ?></h3>
                <div class="espace">-----------<br></div>
                <h3 class="title-profli"><span class="sapn">Prénom : </span> <?php echo $_SESSION['users']['prenom'] . '<br>'; ?></h3>
                <h3 class="title-profli"><span class="sapn">E-mail :</span> <?php echo $_SESSION['users']['mail'] . '<br>'; ?></h3>
                <h3 class="title-profli"><span class="sapn">Matricule :</span> <?php echo $_SESSION['users']['matricule'] . '<br>'; ?></h3>
            </p>
            <button name="client"><a href="../php/logout_user.php">Déconnecter</a></button>
        </section>
    </div>
</body>

</html>