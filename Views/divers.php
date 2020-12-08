<?php
include("./parts/head.php");
include('../php/connexion.php');
$err = array('auteur' => '', 'oeuvre' => '');
$err0 = array('type' => '');
$err1 = array('categorie' => '');
$err2 = array('livrer' => '', 'aut' => '');
$sql00 = "SELECT * FROM auteur";
$result00 = mysqli_query($conn, $sql00);
$resultats00 = mysqli_fetch_all($result00, MYSQLI_ASSOC);
mysqli_free_result($result00);
if (isset($_POST['submit'])) {
    //check auteur
    if (empty($_POST['auteur'])) {
        $err['auteur'] = "Entrée un auteur";
    } else {
        $req = $connexion->prepare('SELECT * FROM auteur WHERE nom = ?');
        $req->execute([$_POST['auteur']]);
        $user = $req->fetch();
        if ($user) {
            $err['auteur'] = "Ce auteur existe déjà";
        } else {
            $auteur = $_POST['auteur'];
        }
    }

    if (empty($_POST['oeuvre'])) {
        $err['oeuvre'] = "Entrée une oeuvre";
    } else {
        $oeuvre = $_POST['oeuvre'];
    }

    if (array_filter($err)) {
        //rien
    } else {
        $sql0 = "INSERT INTO auteur(nom) VALUES('$auteur')";
        if (mysqli_query($conn, $sql0)) {
            $last_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO oeuvre(nom, auteur_id) VALUES('$oeuvre', '$last_id')";
            if (mysqli_query($conn, $sql)) {
                //succès
            } else {
                echo 'query error : ' . mysqli_error($conn);
            }
        } else {
            echo 'query error : ' . mysqli_error($conn);
        }
        header('Location: divers.php');
    }
}

if (isset($_POST['submit0'])) {
    //check auteur
    if (empty($_POST['aut'])) {
        $err['aut'] = "Entrée un auteur";
    } else {
        $aut = $_POST['aut'];
    }

    if (empty($_POST['livrer'])) {
        $err['livrer'] = "Entrée un livre";
    } else {
        $livrer = $_POST['livrer'];
    }

    if (array_filter($err2)) {
        //rien
    } else {
        $sqlss = "INSERT INTO oeuvre(nom, auteur_id) VALUES('$livrer', '$aut')";
        if (mysqli_query($conn, $sqlss)) {
        } else {
            echo 'query error : ' . mysqli_error($conn);
        }
        header('Location: divers.php');
    }
}

if (isset($_POST['submit1'])) {
    if (empty($_POST['categorie'])) {
        $err1['categorie'] = "Entrée une categorie";
    } else {
        $categorie = $_POST['categorie'];
    }
    if (array_filter($err1)) {
        //rien
    } else {
        $sql03 = "INSERT  INTO categorie(nom) VALUE('$categorie')";
        if (mysqli_query($conn, $sql03)) {
            //succès
        } else {
            echo 'query error : ' . mysqli_error($conn);
        }
        header('Location: divers.php');
    }
}

if (isset($_POST['submit2'])) {
    if (empty($_POST['types'])) {
        $err0['types'] = "Entrée un types";
    } else {
        $types = $_POST['types'];
    }

    if (array_filter($err0)) {
        //rien
    } else {
        $sql03 = "INSERT  INTO types(nom) VALUE('$types')";
        if (mysqli_query($conn, $sql03)) {
            //succès
        } else {
            echo 'query error : ' . mysqli_error($conn);
        }
        header('Location: divers.php');
    }
}
?>
<?php
include("./parts/section/nav.php");
include("./parts/section/header.php"); ?>
<div class="contain">
    <div class="containers">
        <div class="livres-containt">
            <div class="livre-title">
                <h2>Ajouter une oeuvre</h2>
            </div>
            <?php
            echo $err['auteur'] . '<br>';
            echo $err['oeuvre'];
            ?>
            <form method="POST">
                <input type="text" name="oeuvre" placeholder="Entré le nom de l'oeuvre"><br>
                <input type="text" name="auteur" placeholder="Le nom de l'Auteur"> <br>
                <button type="submit" name="submit" class="">Ajouter</button>
            </form>
        </div>
        <div class="livres-containt">
            <div class="livre-title">
                <h2>Ajouter un livre</h2>
                <p class="stats">Un livre dons L'auteur est déjà enrégister</p>
            </div>
            <?php
            echo $err2['livrer'] . '<br>';
            echo $err2['aut'];
            ?>
            <form method="POST">
                <input type="text" name="livrer" placeholder="Entré une oeuvre"><br>
                <select name="aut">
                    <option value="">--selectionné un Auteur--</option>
                    <?php foreach ($resultats00 as $resultat00) { ?>
                        <option value="<?php echo $resultat00['id']; ?>"><?php echo $resultat00['nom']; ?></option>
                    <?php } ?>
                </select><br />
                <button type="submit" name="submit0" class="">Ajouter</button>
            </form>
        </div>
        <div class="livres-containt">
            <div class="livre-title">
                <h2>Ajouter une Catégorie</h2>
            </div>
            <?php
            echo $err1['categorie'];
            ?>
            <form method="POST">
                <input type="text" name="categorie" placeholder="Entré une catégorie"><br>
                <button type="submit" name="submit1" class="">Ajouter</button>
            </form>
        </div>
        <div class="livres-containt">
            <div class="livre-title">
                <h2>Ajouter un Type</h2>
            </div>
            <?php
            echo $err0['type'];
            ?>
            <form method="POST">
                <input type="text" name="types" placeholder="Entré un Type"><br>
                <button type="submit" name="submit2" class="">Ajouter</button>
            </form>
        </div>
    </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>