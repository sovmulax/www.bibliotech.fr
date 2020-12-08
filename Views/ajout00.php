<?php
include("./parts/head.php");
include '../php/connexion.php';
$err = array('auteur' => '');
$sql00 = "SELECT * FROM auteur";
$result00 = mysqli_query($conn, $sql00);
$resultats00 = mysqli_fetch_all($result00, MYSQLI_ASSOC);
mysqli_free_result($result00);
if (isset($_POST['submit'])) {
    //check auteur
    if (empty($_POST['auteur'])) {
        $err['auteur'] = "Entrée un auteur";
    } else {
        $auteur = $_POST['auteur'];
    }

    if(array_filter($err)){
        //rien
    }else{
        $_SESSION['auteur'] = array('id' => $auteur);        
        header('Location: ajout01.php');
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
            echo $err['auteur'];
            ?>
        </div>
        <form method="POST" class="livre" id="auteur">
            <select name="auteur">
                <option value="">--selectionné un Auteur--</option>
                <?php foreach ($resultats00 as $resultat00) { ?>
                    <option value="<?php echo $resultat00['id']; ?>"><?php echo $resultat00['nom']; ?></option>
                <?php } ?>
            </select><br />
            <button type="submit" name="submit" class="btn07">Continuer</button>
            
        </form>
    </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>