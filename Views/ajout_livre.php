<?php
include("./parts/head.php");
if (!isset($_SESSION['auteur']['id'])) {
    header('Location: ajout00.php');
    exit();
}
include '../php/connexion.php';
$err = array('oeuvre' => '', 'categorie' => '', 'type' => '', 'resumes' => '');
$sql01 = "SELECT * FROM oeuvre";
$sql03 = "SELECT * FROM categorie";
$sql04 = "SELECT * FROM types";
//requete
$result01 = mysqli_query($conn, $sql01);
$resultats01 = mysqli_fetch_all($result01, MYSQLI_ASSOC);
mysqli_free_result($result01);

$result03 = mysqli_query($conn, $sql03);
$resultats03 = mysqli_fetch_all($result03, MYSQLI_ASSOC);
mysqli_free_result($result03);

$result04 = mysqli_query($conn, $sql04);
$resultats04 = mysqli_fetch_all($result04, MYSQLI_ASSOC);
mysqli_free_result($result04);

if (isset($_POST['annuler'])) {
    unset($_SESSION['auteur']);
    unset($_SESSION['photos']);
    unset($_SESSION['editeurs']);
    $fichier = '../Static/img/livres/' . $nom_photo;
    unlink($fichier);
    header('Location: ajout00.php');
}

if (isset($_POST['submit'])) {
    //check photo
    $nom_photo = $_SESSION['photos']['nom'];
    $sql0 = "INSERT INTO photo(nom) VALUE('$nom_photo')";
    if (mysqli_query($conn, $sql0)) {
        // success
    } else {
        echo 'query error 0: ' . mysqli_error($conn);
    }
    $req00 = $connexion->prepare('SELECT id FROM photo WHERE nom = :nom');
    $req00->execute(['nom' => $nom_photo]);
    $res00 = $req00->fetch();
    $photo = $res00['id'];

    //check auteur
    $auteur = $_SESSION['auteur']['id'];

    //check oeuvre
    if (empty($_POST['oeuvre'])) {
        $err['oeuvre'] = "Entrée un oeuvre";
    } else {
        $oeuvre = $_POST['oeuvre'];
        $req001 = $connexion->prepare('SELECT id FROM livres WHERE oeuvre_id = :id');
        $req001->execute(['id' => $oeuvre]);
        while ($res001 = $req001->fetch()) {
            
            $err['oeuvre'] = "cette oeuvre a déjà été créé";
        } 

    }

    //check categorie
    if (empty($_POST['categorie'])) {
        $err['categorie'] = "Entrée une categorie";
    } else {
        $categorie = $_POST['categorie'];
    }

    //check résumer
     if (empty($_POST['resumes'])) {
        $err['resumes'] = "Ecrivez un réeumer";
    } else {
        $resumes = $_POST['resumes'];
    }

    //check type
    if (empty($_POST['type'])) {
        $err['type'] = "Entrée un type";
    } else {
        $type = $_POST['type'];
    }

    //envoie de donner
    if (array_filter($err)) {
        //rien du tous
    } else {
        $resumes = mysqli_real_escape_string($conn, $_POST['resumes']);;
        //requete sql
        $sql = "INSERT INTO livres(auteur_id, oeuvre_id, types_id, categorie_id, photo_id, resumes) VALUES('$auteur', '$oeuvre', '$type', '$categorie', '$photo', '$resumes')";
        // sauvegarde check
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: ajout00.php');
        } else {
            echo 'query error : ' . mysqli_error($conn);
        }
    }
}
include("./parts/section/nav.php");
include("./parts/section/header.php");
?>
<div class="contain">
    <div class="livre-containt">
        <div class="livre-title">
            <h2>Ajouter un Livre</h2>
            <p>
                Renseignez les Information sur l'exemplaire que vous voulez ajouter
            </p>
        </div>
        <div class="error03">
            <?php
            echo $err['oeuvre'] . '<br/>';
            echo $err['categorie'] . '<br/>';
            echo $err['type'] . '<br/>';
            echo $err['resumes'];
            ?>
        </div>
        <form method="POST" class="livre">
            <select name="oeuvre">
                <option value="">--selectionné une oeuvre--</option>
                <?php
                $sql05 = 'SELECT * FROM oeuvre WHERE auteur_id = \'' . $_SESSION['auteur']['id'] . '\'';
                $result05 = mysqli_query($conn, $sql05);
                $resultats05 = mysqli_fetch_all($result05, MYSQLI_ASSOC);
                mysqli_free_result($result05);
                ?>
                <?php foreach ($resultats05 as $resultat05) { ?>
                    <option value="<?php echo $resultat05['id']; ?>"><?php echo $resultat05['nom']; ?></option>
                <?php } ?>
            </select><br />
            <select name="categorie">
                <option value="">--selectionné une catégorie--</option>
                <?php foreach ($resultats03 as $resultat03) { ?>
                    <option value="<?php echo $resultat03['id']; ?>"><?php echo $resultat03['nom']; ?></option>
                <?php } ?>
            </select><br />
            <select name="type">
                <option value="">--selectionné un Type--</option>
                <?php foreach ($resultats04 as $resultat04) { ?>
                    <option value="<?php echo $resultat04['id']; ?>"><?php echo $resultat04['nom']; ?></option>
                <?php } ?>
            </select><br />
            <textarea class="resume" name="resumes" cols="30" rows="10" placeholder="Ecriver un résumer du livre"></textarea><br>
            <section class="btn-place">
                <button type="submit" name="annuler" class="btn08">Annuler</button>
                <button type="submit" name="submit" class="btn04">Ajouter</button>
            </section>
        </form>
    </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>