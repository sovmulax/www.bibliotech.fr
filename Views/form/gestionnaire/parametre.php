<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: ../../../index.php');
    exit();
}
include '../../../php/connexion.php';
$sql = 'SELECT nom, prenom, email, born_date, contact, extension, actif FROM gestionnaire';
$result = mysqli_query($conn, $sql);
$resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
$name = "img_avatar.png";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Client | BiblioTech</title>
    <link rel="stylesheet" href="../../../Static/css/formulaire.css" />
    <link rel="stylesheet" href="../../../Static/css/style.css" />
</head>
<body>
    <header class="head-bar-c">
        <h1 class="head-title-c"><i class="fas fa-book-open"></i>BiblioTech</h1>
    </header>
    <section class="main">
        <?php foreach ($resultats as $resultat) : ?>
            <div class="carte-gestions">
                <h2><i class="fas fa-book-open"></i>BiblioTech</h2>
                <div class="element-carte">
                    <div class="attribu-gestion">
                        <span>Nom : </span><span><?php echo $resultat['nom']; ?></span><br />
                        <span>Prénom : </span><span><?php echo $resultat['prenom']; ?></span><br />
                        <span>Email : </span><span><?php echo $resultat['email']; ?></span><br />
                        <span>Numéro : </span><span><?php echo $resultat['contact']; ?></span><br>
                        <span>Date de Naissance : </span><span><?php echo $resultat['born_date']; ?></span><br>
                        <span>Actif : </span><span><?php if ($resultat['actif'] == true) {echo "Oui";} else { echo "Non";} ?></span>
                    </div>
                    <div class="img-desative">
                        <div class="carte-gestion-img">
                            <img src="../../../Static/img/gestionnaire/<?php $name = $resultat['email'] . '.' . $resultat['extension'];echo $name; ?>" alt="carte" />
                        </div>
                        <?php
                        if ($resultat['actif'] == true) { ?>

                            <button name="desactiver" class="desactive"><a href="../../../php/desactive.php?mail=<?php echo $resultat['email']?>">Desactivé</a></button>
                        <?php } else { ?>
                            <!--rien-->
                        <?php } ?>
                    </div>
                </div>
            </div><br>
        <?php endforeach ?>
    </section>
    <footer>
        <div class="gestion-accueil">
            <button class="print"><a href="../../livres.php">Acceuil</a></button>
        </div><br>
        <p>
            Copyright &copy;
            <script>
                document.write(new Date().getFullYear());
            </script>
            All rights reserved
        </p>
    </footer>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
<!--OnClick="javascript:window.print()"-->