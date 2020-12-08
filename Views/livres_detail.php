<?php
include("./parts/head.php");
include('../php/connexion.php');
$id = $_GET['id'];
$i = 1;
//requete
$reqs = $connexion->prepare('SELECT * FROM livres WHERE id = :livre');
$reqs->execute(['livre' => $id]);
$ress = $reqs->fetch();
//
$oeuvre = $_GET['oeuvre'];
$books = $connexion->query('SELECT * FROM exemplaires WHERE oeuvre_exem_id = \'' . $oeuvre . '\'');

include("./parts/section/nav.php");
include("./parts/section/header.php");
?>
<div class="contain">
    <h1 class="book-title"><?php $req = $connexion->prepare('SELECT * FROM oeuvre WHERE id = :photo');
                            $req->execute(['photo' => $ress['oeuvre_id']]);
                            $res = $req->fetch();
                            echo $res['nom']; ?></h1>
    <div class="info-book">
        <div class="img-book">
            <img src="../Static/img/livres/<?php $req = $connexion->prepare('SELECT * FROM photo WHERE id = :photo');
                                            $req->execute(['photo' => $ress['photo_id']]);
                                            $res = $req->fetch();
                                            echo $res['nom']; ?>" alt="livres">
        </div>
        <div class="detail-book">
            <h3>Auteur : <?php $req0 = $connexion->prepare('SELECT * FROM auteur WHERE id = :auteur');
                            $req0->execute(['auteur' => $ress['auteur_id']]);
                            $res0 = $req0->fetch();
                            echo $res0['nom']; ?></h3>
            <h3>Catégorie : <?php $req1 = $connexion->prepare('SELECT * FROM categorie WHERE id = :categorie');
                            $req1->execute(['categorie' => $ress['categorie_id']]);
                            $res1 = $req1->fetch();
                            echo $res1['nom']; ?></h3>
            <h3>Types : <?php $req2 = $connexion->prepare('SELECT * FROM types WHERE id = :types');
                        $req2->execute(['types' => $ress['types_id']]);
                        $res2 = $req2->fetch();
                        echo $res2['nom']; ?></h3>

        </div>
    </div>
    <div class="resume-book">
        <h2>Résumé du Livre</h2>
        <p>
            <?php echo $ress['resumes'];
            $_SESSION['id'] = array('oeuvre' => $ress['resumes']);
            ?>
        </p>
    </div>
    <div class="tableau">
        <h2>Résumé des Exemplaires</h2>
        <table>
            <tr>
                <th>N°</th>
                <th>Editeur</th>
                <th>Etat</th>
                <th>Emprunter</th>
            </tr>
            <?php while($book = $books->fetch()) { ?>
                <tr>
                    <td><?php echo '#'.$i++; ?></td>
                    <td><?php $req20 = $connexion->prepare('SELECT * FROM editeur WHERE id = :types');
                        $req20->execute(['types' => $book['editeur_id']]);
                        $res20 = $req20->fetch();
                        echo $res20['nom']; ?></td>
                    <td><?php $req2 = $connexion->prepare('SELECT * FROM etat WHERE id = :types');
                        $req2->execute(['types' => $book['etat_id']]);
                        $res2 = $req2->fetch();
                        echo $res2['nom']; ?></td>
                    <td><?php if($book['emprunter'] == true){
                        echo 'oui';
                    }else{
                        echo 'non';
                    } ?></td>
                </tr>
            <?php } ?>
        </table>
        <button class="delete"><a href="../php/delete_livres.php?id_oeuvre=<?php echo $ress['oeuvre_id']; ?>">Supprimer le Livre</a></button>
    </div>
    
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>