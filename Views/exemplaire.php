<?php
include('../php/connexion.php');
include('./parts/head.php');
$err = array('livre' => '', 'etat' => '', 'nombre' => '', 'editeur' => '');
$sql01 = "SELECT * FROM oeuvre";
$sql02 = "SELECT * FROM etat";
//requete
$result01 = mysqli_query($conn, $sql01);
$livres = mysqli_fetch_all($result01, MYSQLI_ASSOC);
mysqli_free_result($result01);

$result02 = mysqli_query($conn, $sql02);
$etats = mysqli_fetch_all($result02, MYSQLI_ASSOC);
mysqli_free_result($result02);

if (isset($_POST['submit'])) {

    //check livre
    if (empty($_POST['livrer'])) {
        $err['livre'] = "Entrée un livre";
    } else {
        $livrer = $_POST['livrer'];
        $req = 'SELECT * FROM livres WHERE oeuvre_id = \'' . $livrer . '\'';
        $rest = mysqli_query($conn, $req);
        $books = mysqli_fetch_all($rest, MYSQLI_ASSOC);
        mysqli_free_result($rest);
        foreach ($books as $res01) {
            if ($res01 == false) {
                $err['livre'] = 'Cette ouvrage n\'existe pas';
            }
        }
    }

    //check etat
    if (empty($_POST['etat'])) {
        $err['etat'] = "Entrée un etat";
    } else {
        $etat = $_POST['etat'];
    }

    //check editeur
    if (empty($_POST['editeur'])) {
        $err['editeur'] = "Entrée un éditeur";
    } else {
        $editeur = $_POST['editeur'];
        $sql03 = "INSERT  INTO editeur(nom) VALUE('$editeur')";
        if (mysqli_query($conn, $sql03)) {
            $last_id = mysqli_insert_id($conn);
        } else {
            echo 'query error : ' . mysqli_error($conn);
        }
    }

    //chek nombre
    if (empty($_POST['nombre'])) {
        $err['nombre'] = "Entrée une quantité d'exemplaire";
    } else {
        $nombre = (int) htmlspecialchars($_POST['nombre']);
        if ($nombre < 0) {
            $err['nombre'] = "le numéro entré n'est pas valide";
        }
    }

    if (array_filter($err)) {
        //rien
    } else {
        $req0 = 'SELECT * FROM livres WHERE oeuvre_id = \'' . $livrer . '\'';
        $rest02 = mysqli_query($conn, $req0);
        $book = mysqli_fetch_all($rest02, MYSQLI_ASSOC);
        mysqli_free_result($rest02);
        foreach ($book as $res02) {
            $auteur = $res02['auteur_id'];
            $oeuvre = $livrer;
            $types = $res02['types_id'];
            $categorie = $res02['categorie_id'];
        }
        //boucle d'insertion
        $i = 0;
        $out = true;

        while (($i != $nombre)) {
            //requete sql
            $emprunt = false;
            $sql = "INSERT INTO exemplaires(auteur_exem_id, oeuvre_exem_id, types_exem_id, categorie_exem_id, editeur_id, etat_id, emprunter) VALUES('$auteur', '$oeuvre', '$types', '$categorie', '$last_id', '$etat', '$emprunt')";
            // save to db and check
            if (mysqli_query($conn, $sql)) {
                // success
            } else {
                echo 'query error : ' . mysqli_error($conn);
            }
            $i++;
        }

        if ($out == false) {
            header('Location: exemplaire.php');
        }
    }
}
?>
<?php
include("./parts/section/nav.php");
include("./parts/section/header.php");
?>
<div class="contain">
    <div class="livre-containt">
        <div class="livre-title">
            <h2>créer des exemplaire</h2>
            <p>
                Renseignez les Information sur l'exemplaire que vous voulez ajouter
            </p>
        </div>
        <div class="error03">
            <?php
            echo $err['livre'] . '<br/>';
            echo $err['etat'] . '<br/>';
            echo $err['nombre'] . '<br/>';
            echo $err['editeur'];
            ?>
        </div>
        <form method="POST" class="livre">
            <select name="livrer">
                <option value="">--selectionné un Livre--</option>
                <?php foreach ($livres as $livre) { ?>
                    <option value="<?php echo $livre['id']; ?>"><?php echo $livre['nom']; ?></option>
                <?php } ?>
            </select><br />
            <select name="etat">
                <option value="">--selectionné un etat--</option>
                <?php foreach ($etats as $etat) { ?>
                    <option value="<?php echo $etat['id']; ?>"><?php echo $etat['nom']; ?></option>
                <?php } ?>
            </select><br />
            <input type="text" name="editeur" placeholder="Entré le nom de l'éditeur"><br>
            <input type="number" name="nombre" placeholder="nombre d'exemplaire">
            <button type="submit" name="submit" class="btn09">Ajouter</button>
        </form>
    </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>