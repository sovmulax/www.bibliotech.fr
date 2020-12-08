<?php
include("./parts/head.php");
include("../php/connexion.php");

$sql = "SELECT * FROM emprunter WHERE en_cour = true";
$result0 = mysqli_query($conn, $sql);
$books = mysqli_fetch_all($result0, MYSQLI_ASSOC);
mysqli_free_result($result0);
$i = 1;
include("./parts/section/nav.php");
include("./parts/section/header.php"); ?>
<div class="contain">
    <?php include("./parts/section/search.php"); ?>
    <h1 class="header">Liste des Emprunts</h1><br>
    <div class="tableau">
        <table>
            <tr>
                <th>N°</th>
                <th>Clients</th>
                <th>Exemplaire</th>
                <th>Date d'emprunt</th>
                <th>Date de retour Prévu</th>
            </tr>
            <?php foreach ($books as $book) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php $req = $connexion->prepare('SELECT * FROM users WHERE id = :id_structure');
                        $req->execute(['id_structure' => $book['users_id']]);
                        $res = $req->fetch();
                        echo $res['nom'] . ' ' . $res['prenom']; ?></td>
                    <td><?php $req = $connexion->prepare('SELECT * FROM exemplaires WHERE id = :id_structure');
                        $req->execute(['id_structure' => $book['exemplaire_id']]);
                        $res = $req->fetch();
                        //
                        $req0 = $connexion->prepare('SELECT * FROM oeuvre WHERE id = :id_structure');
                        $req0->execute(['id_structure' => $res['oeuvre_exem_id']]);
                        $res0 = $req0->fetch();
                        echo $res0['nom'];  ?></td>
                    <td><?php echo $book['emprunt_date']; ?></td>
                    <td><?php echo $book['date_retour']; ?></td>
                </tr>
            <?php } ?>
        </table>

        <button type="histoire"><a href="./historique.php">Historique des Emprunts</a></button>
    </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>