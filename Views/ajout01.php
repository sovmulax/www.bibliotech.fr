<?php
include("./parts/head.php");
include ('../php/connexion.php');
$err = array('photo' => '');
if (isset($_POST['submit'])) {
    //check de photo
    if (isset($_FILES['photo']) and $_FILES['photo']['error'] == 0) {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['photo']['size'] <= 1000000) {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'png');
            if (in_array($extension_upload, $extensions_autorisees)) {
                $envoie = true;
            } else {
                $envoie = false;
            }
        } else {
            $err['photo'] = 'Erreur de fichier';
        }
    } else {
        $err['photo'] = 'Selectionné une photo';
    }

    if (array_filter($err)) {
        //rien
    } else {
        if ($envoie) {
            // On peut valider le fichier et le stocker définitivement
            $id = uniqid('image');
            $_FILES['photo']['name'] = $id . '.' . $extension_upload;
            $nom_photo = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], '../Static/img/livres/' . $nom_photo);
            $_SESSION['photos'] = array('nom' => $nom_photo);
            header('Location: ajout_livre.php');
        }
    }
}
?>
<?php
include("./parts/section/nav.php");
include("./parts/section/header.php"); ?>
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
            echo $err['photo'];
            ?>
        </div>
        <form method="POST" class="livre" enctype="multipart/form-data">
            <input type="file" name="photo" class="photo" accept="image/png, image/jpeg, image/jpg" placeholder="Selectionné une photo"><br>
            <button type="submit" name="submit" class="btn07">Continuer</button>

        </form>
    </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>