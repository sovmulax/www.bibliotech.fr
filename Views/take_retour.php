<?php include("./parts/head.php");
include '../php/connexion.php';
$errors01 = array('num_exemplaire' => '', 'state' => '');
$succes = '';
$valid01 = '';

$resultats0 = $connexion->query('SELECT * FROM exemplaires WHERE emprunter = true');

$sql02 = "SELECT * FROM etat";
$result02 = mysqli_query($conn, $sql02);
$etats = mysqli_fetch_all($result02, MYSQLI_ASSOC);
mysqli_free_result($result02);

if (isset($_POST['submit01'])) {
  //
  if (empty($_POST['num_exemplaire'])) {
    $errors01['num_exemplaire'] = "false";
  } else {
    $num_exemplaire = $_POST['num_exemplaire'];
  }

  //
  if (empty($_POST['state'])) {
    $errors01['state'] = "false";
  } else {
    $state = $_POST['state'];
  }

  foreach ($errors01 as $err) {
    if ($err === "false") {
      $valid01 = "Il y a une erreur";
    } else {
      $valid0 = '';
    }
  }

  if (array_filter($errors01)) {
  } else {
      $val = false;
      $req = $connexion->prepare('UPDATE emprunter SET en_cour = :val WHERE exemplaire_id = :ids');
      $req->execute(array('val' => $val, 'ids' => $num_exemplaire));
      //
      $req = $connexion->prepare('UPDATE exemplaires SET etat_id = :val, emprunter = :vals WHERE id = :ids');
      $req->execute(array('val' => $state, 'vals' => $val, 'ids' => $num_exemplaire));
      $succes = 'Retour réussi';
      header('Location: take_retour.php');
    }
}
?>
<?php
include("./parts/section/nav.php");
include("./parts/section/header.php"); ?>
<div class="contain">
  <div class="gestion-livre">
    <div class="retour">
      <h2>Retour de Livre</h2>
      <p>renseignez les champs Correctement</p>
      <br />
      <div class="error05">
        <?php
          echo $valid01;
        ?>
        <div class="vert">
         <?php echo $succes; ?>
        </div>
      </div>
      <br>
      <form method="POST" name="form">
      <select name="num_exemplaire">
        <option value="">--selectionné l'exemplaire--</option>
        <?php while($resultat0 = $resultats0->fetch()) { ?>
          <option value="<?php echo $resultat0['id']; ?>"><?php
                                                          $req = $connexion->prepare('SELECT nom FROM oeuvre WHERE id = :id_structure');
                                                          $req->execute(['id_structure' => $resultat0['oeuvre_exem_id']]);
                                                          $res = $req->fetch();
                                                          echo '#' . $resultat0['id'] . ' ' . $res['nom']; ?></option>
        <?php } ?>
      </select><br />
        <select name="state">
          <option value="">--selectionné l'etat de retour--</option>
          <?php foreach ($etats as $etat) { ?>
            <option value="<?php echo $etat['id']; ?>"><?php echo $etat['nom']; ?></option>
          <?php } ?>
        </select><br />
        <button type="submit" name="submit01" class="btn06">Valider</button>
      </form>
    </div>
  </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>