<?php
include("./parts/head.php");
include("../php/connexion.php");
$books = $connexion->query('SELECT * FROM mail');
?>
<div class="contain">
    <h1 class="header">Méssage des clients</h1><br>
    <div class="tableaus">
        <?php while($book = $books->fetch()): ?>
            <div>
                <h2 class="mail"><?php echo $book['email'] ?></h2>
                <p class="messa">
                <?php echo $book['messages'] ?>
                </p>
            </div><br>
        <?php endwhile ?>
        <button type="submit" class="bbb"><a href="./livres.php">retour</a></button>
    </div>
</div>
<?php
include("./parts/foot.php"); ?>