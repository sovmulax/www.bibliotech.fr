<?php include("./parts/head.php");
include '../php/connexion.php';
$errors00 = array('n1_client' => '', 'num1_exemplaire' => '');
$valid00 = '';
//
$id = $_SESSION['oeuvre']['id'];
$resultats0 = $connexion->query('SELECT * FROM exemplaires WHERE oeuvre_exem_id = \'' . $id . '\' AND emprunter = false');

$sql00 = "SELECT * FROM users";
$result00 = mysqli_query($conn, $sql00);
$resultats00 = mysqli_fetch_all($result00, MYSQLI_ASSOC);
mysqli_free_result($result00);
if (isset($_POST['submit00'])) {
  //
  if (empty($_POST['num1_exemplaire'])) {
    $errors00['num1_exemplaire'] = "false";
  } else {
    $num1_exemplaire = $_POST['num1_exemplaire'];
  }

  //
  if (empty($_POST['n1_client'])) {
    $errors00['n1_client'] = "false";
  } else {
    $n1_client = $_POST['n1_client'];
  }

  foreach ($errors00 as $err) {
    if ($err == "false") {
      $valid00 = "Il y a une erreur";
    } else {
      $valid00 = '';
    }
  }

  if (array_filter($errors00)) {
  } else {
    $today = date("Y-m-d");
    $return_day = date('Y-m-d', strtotime('+7 day'));
    $actif = true;
    $sql = "INSERT INTO emprunter(exemplaire_id, users_id, emprunt_date, date_retour, en_cour) VALUES('$num1_exemplaire', ' $n1_client', '$today', '$return_day', '$actif')";
    if (mysqli_query($conn, $sql)) {
      // success
      $val = true;
      $req = $connexion->prepare('UPDATE exemplaires SET emprunter = :val WHERE id = :ids');
      $req->execute(array('val' => $val, 'ids' => $num1_exemplaire));
      header('Location: take_emprunts0.php');
    } else {
      echo 'query error : ' . mysqli_error($conn);
    }
  }
}

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
      echo $valid00;
      ?>
    </div>
    <form name="emprunt" method="POST">
      <select name="num1_exemplaire">
        <option value="">--selectionné l'exemplaire--</option>
        <?php while($resultat0 = $resultats0->fetch()) { ?>
          <option value="<?php echo $resultat0['id']; ?>"><?php
                                                          $req = $connexion->prepare('SELECT nom FROM oeuvre WHERE id = :id_structure');
                                                          $req->execute(['id_structure' => $resultat0['oeuvre_exem_id']]);
                                                          $res = $req->fetch();
                                                          echo '#' . $resultat0['id'] . ' ' . $res['nom']; ?></option>
        <?php } ?>
      </select><br />
      <select name="n1_client">
        <option value="">--selectionné le client--</option>
        <?php foreach ($resultats00 as $resultat00) { ?>
          <option value="<?php echo $resultat00['id']; ?>"><?php echo $resultat00['nom'] . ' ' . $resultat00['prenom']; ?></option>
        <?php } ?>
      </select><br />
      <button type="submit" name="submit00" class="btn11">Valider</button>
    </form>
  </div>
</div>
<?php
include("./parts/section/float.php");
include("./parts/foot.php"); ?>