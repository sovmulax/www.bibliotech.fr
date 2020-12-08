<?php session_start();
if (!isset($_SESSION['users'])) {
    header('Location: ../index.php');
    exit();
}
include('../php/connexion.php');
//
$id = $_SESSION['users']['photo'];
$mail = $_SESSION['users']['mail'];
$var = false;
$i = 1;
$req = $connexion->prepare('SELECT * FROM emprunter WHERE users_id = :id AND en_cour = :cour');
$req->execute(['id' => $id, 'cour' => $var]);
$errors = "";

if (isset($_POST['submit'])) {
    //check message
    if (empty($_POST['message'])) {
        $errors = "Ecrivé un méssage";
    } else {
        $message = $_POST['message'];
    }

    if (empty($errors)) {
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $sql = "INSERT INTO mail(email, messages) VALUES('$mail', '$message')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: profil.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}
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
                <div class="li"><a href="emprunts.php">Emprunts en cour</a></div>
                <div class="actives li"><a href="profil.php">Profil</a></div>
            </div>
        </nav>
    </header>
    <div class="containt-profil">
        <div class="container-profil">
            <div class="main-img">
                <div class="mains-img">
                    <img src="../Static/img/clients/<?php echo $_SESSION['users']['photo']; ?>" alt="profil user">
                </div>
            </div>
            <div class="info-users">
                <p>
                    <h3 class="title-profli"><span class="sapn">Nom:</span> <?php echo $_SESSION['users']['nom']; ?></h3><br>
                    <h3 class="title-profli"><span class="sapn">Prénom : </span> <?php echo $_SESSION['users']['prenom']; ?></h3><br>
                    <h3 class="title-profli"><span class="sapn">E-mail :</span> <?php echo $_SESSION['users']['mail']; ?></h3><br>
                    <h3 class="title-profli"><span class="sapn">Matricule :</span> <?php echo $_SESSION['users']['matricule']; ?></h3><br>
                </p>
            </div>
            <div class="contactez">
                <h1>Contactez-Nous</h1>
                <form method="POST">
                    <?php echo '<p class="red">' . $errors . '</p><br>'; ?>
                    <textarea name="message" cols="30" rows="10" placeholder="Entré vôtre méssage"></textarea><br>
                    <button type="submit" name="submit">Envoyer</button>
                </form>
            </div>
            <!--Historique des emprunts-->
            <div class="historique-user">
                <h1>Historique de vos Emprunts</h1>
                <div class="historique-tableau">
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
        </div>
    </div>
</body>

</html>