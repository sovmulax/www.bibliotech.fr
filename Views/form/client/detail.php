<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: ../../../index.php');
    exit();
}
include '../../../php/connexion.php';
if (!isset($_GET['code'])) {
    header('Location: ./Carte.php');
    exit();
}
$sql = $connexion->query('SELECT * FROM users WHERE matricule = \'' . $_GET['code'] . '\'');
$name = "img_avatar.png";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Imprimer | BiblioTech</title>
    <link rel="stylesheet" href="../../../Static/css/formulaire.css" />
    <link rel="stylesheet" href="../../../Static/css/style.css" />
</head>

<body>
    <section class="main-detail">
        <?php while ($resultat = $sql->fetch()) : ?>
            <div class="carte-gestion">
                <h2><i class="fas fa-book-open"></i>BiblioTech</h2>
                <div class="element-carte">
                    <div class="attribu-gestion">
                        <span>Nom : </span><span><?php echo $resultat['nom']; ?></span><br />
                        <span>Prénom : </span><span><?php echo $resultat['prenom']; ?></span><br />
                        <span>Email : </span><span><?php echo $resultat['email']; ?></span><br />
                        <span>Numéro : </span><span><?php echo $resultat['contact']; ?></span><br>
                        <span>Date de Naissance : </span><span><?php echo $resultat['born_date']; ?></span><br>
                        <span>Matricule : </span><span><?php echo $resultat['matricule']; ?></span><br>
                        <span>Structure : </span><span><?php $req = $connexion->prepare('SELECT nom FROM structure WHERE id = :id_structure');
                                                        $req->execute(['id_structure' => $resultat['user_structure']]);
                                                        $res = $req->fetch();
                                                        echo $res['nom']; ?></span><br>

                    </div>
                    <div class="img-desative">
                        <div class="carte-gestion-img">
                            <img src="../../../Static/img/clients/<?php $name = $resultat['id'] . '.' . $resultat['extension'];
                                                                    echo $name; ?>" alt="carte" />
                        </div>
                        <div class="buttons">
                        </div>
                    </div>
                </div>
            </div><br>
        <?php endwhile ?>
    </section>
    <footer>
        <div class="gestion-accueil">
            <button name="desactiver"><a href="./detail.php" OnClick="javascript:window.print()">Imprimer</a></button>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
<!--OnClick="javascript:window.print()"-->