<?php
include("./parts/head.php");
include '../php/connexion.php';
$err = array('oeuvre' => '');
$sql00 = "SELECT * FROM oeuvre";
$result00 = mysqli_query($conn, $sql00);
$resultats00 = mysqli_fetch_all($result00, MYSQLI_ASSOC);
mysqli_free_result($result00);
if (isset($_POST['submit'])) {
    //check auteur
    if (empty($_POST['oeuvre'])) {
        $err['oeuvre'] = "Entrée une oeuvre";
    } else {
        $oeuvre = $_POST['oeuvre'];
    }

    if(array_filter($err)){
        //rien
    }else{
        $_SESSION['oeuvre'] = array('id' => $oeuvre);        
        header('Location: take_emprunts.php');
    }
}
?>
<?php
include("./parts/section/nav.php");
include("./parts/section/header.php"); ?>
<div class="contain">
    <div class="livre-containt">
        <div class="livre-title">
            <h2>Selectionné une oeuvre</h2>
            <p>
                Renseignez les Information sur l'exemplaire que vous voulez ajouter
            </p>
        </div>
        <div class="error03">
            <?php
            echo $err['oeuvre'];
            ?>
        </div>
        <form method="POST" class="livre" id="oeuvre">
            <select name="oeuvre">
                <option value="">--selectionné une Oeuvre--</option>
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