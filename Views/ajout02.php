<?php
include("./parts/head.php");
include ('../php/connexion.php');
$err = array('editeur' => '');
if (isset($_POST['submit'])) {
    //check auteur
    if (empty($_POST['editeur'])) {
        $err['editeur'] = "Entrée le nom de l'éditeur";
    } else {
        $editeur = htmlspecialchars($_POST['editeur']);
        $_SESSION['editeurs'] = array('nom' => $editeur);
        header('Location: ajout_livre.php');
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
            echo $err['editeur'];
            ?>
        </div>
        <form method="POST" class="livre" id="auteur">
            <input type="text" name="editeur" placeholder="Entré le nom de l'éditeur"><br>
            <button type="submit" name="submit" class="btn07">Continuer</button>
        </form>
    </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>