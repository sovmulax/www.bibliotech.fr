<?php
session_start();
include '../../../php/connexion.php';
include '../../../php/matricule.php';
$errors = array('n_nom' => '', 'n_prenom' => '', 'n_mail' => '', 'n_contact' => '', 'n_date' => '', 'photo' => '', 'structure' => '');
$start = '2020-11-01';
$sql00 = "SELECT * FROM structure";
//
$result = mysqli_query($conn, $sql00);
$resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
if (isset($_POST['submit'])) {

  //check de photo
  if (isset($_FILES['photo']) and $_FILES['photo']['error'] == 0) {
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['photo']['size'] <= 1000000) {
      // Testons si l'extension est autorisée
      $infosfichier = pathinfo($_FILES['photo']['name']);
      $extension_upload = $infosfichier['extension'];
      $extensions_autorisees = array('jpg', 'jpeg', 'png');
      if (in_array($extension_upload, $extensions_autorisees)) {
        $envoie = true;
      } else {
        $envoie = false;
      }
    } else {
      $errors['photo'] = 'Erreur de fichier';
    }
  } else {
    $errors['photo'] = 'selectionné une photo';
  }

  //check nom
  if (empty($_POST['n_nom'])) {
    $errors['n_nom'] = "Entrée un nom";
  } else {
    $n_nom = htmlspecialchars($_POST['n_nom']);
    if (!preg_match('/^[a-zA-Z\s]+$/', $n_nom)) {
      $errors['n_nom'] = "le nom entré n'est pas valide";
    }
  }

  //check prenom
  if (empty($_POST['n_prenom'])) {
    $errors['n_prenom'] = "Entrée un prenom";
  } else {
    $n_prenom = htmlspecialchars($_POST['n_prenom']);
    if (!preg_match('/^[a-zA-Z\s]+$/', $n_prenom)) {
      $errors['n_prenom'] = "le prenom entré n'est pas valide";
    }
  }

  //check email
  if (empty($_POST['n_mail'])) {
    $errors['n_mail'] = "Entrée un E-MAIL";
  } elseif (!filter_var($_POST['n_mail'], FILTER_VALIDATE_EMAIL)) {
    $errors['n_mail'] = "le mail entré n'est pas valide";
  } else {
    $req = $connexion->prepare('SELECT id FROM users WHERE email = ?');
    $req->execute([$_POST['n_mail']]);
    $user = $req->fetch();
    if ($user) {
      $errors['n_mail'] = "Cet email existe déjà";
    } else {
      $n_mail = htmlspecialchars($_POST['n_mail']);
    }
  }

  //check number
  if (empty($_POST['n_contact'])) {
    $errors['n_contact'] = "Entrée un contact";
  } else {
    $n_contact = htmlspecialchars($_POST['n_contact']);
    if ((strlen($n_contact) < 8) || $n_contact < 0) {
      $errors['n_contact'] = "le numéro entré n'est pas valide";
    }
  }

  //check date
  if (empty($_POST['n_date'])) {
    $errors['n_date'] = "Entrée une date";
  } else {
    $n_date = $_POST['n_date'];
  }

  //check structure
  if (empty($_POST['structure'])) {
    $errors['structure'] = "Sélectionné une structure";
  } else {
    $structure = $_POST['structure'];
  }

  //envoie de donner
  if (array_filter($errors)) {
    //rien du tous
  } else {

    //securité des donners
    $n_nom = mysqli_real_escape_string($conn, $_POST['n_nom']);
    $n_prenom = mysqli_real_escape_string($conn, $_POST['n_prenom']);
    $n_mail = mysqli_real_escape_string($conn, $_POST['n_mail']);
    $n_contact = mysqli_real_escape_string($conn, $_POST['n_contact']);
    $date = date("Y");
    $matricule = matricule($date, $n_nom, $n_prenom, $n_mail);
    $actif = true;
    //requete sql
    $sql = "INSERT INTO users(nom, prenom, email, born_date, contact, extension, user_structure, matricule, actif) VALUES('$n_nom','$n_prenom','$n_mail', '$n_date', '$n_contact','$extension_upload', '$structure', '$matricule', '$actif')";

    // save to db and check
    if (mysqli_query($conn, $sql)) {
      $last_id = mysqli_insert_id($conn);
      // success
      if ($envoie) {
        // On peut valider le fichier et le stocker définitivement
        $_FILES['photo']['name'] = $last_id . '.' . $extension_upload;
        move_uploaded_file($_FILES['photo']['tmp_name'], '../../../Static/img/clients/' . basename($_FILES['photo']['name']));
        header('Location: ./Carte.php');
      }
    } else {
      echo 'query error: ' . mysqli_error($conn);
    }
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Client | BiblioTech</title>
  <link rel="stylesheet" href="../../../Static/css/formulaire.css" />
  <link rel="stylesheet" href="../../../Static/css/wave.css">
</head>

<body>
  <div class="body">
    <header class="head-bar-c">
      <h1 class="head-title-c"><i class="fas fa-book-open"></i>BiblioTech</h1>
      <button type="submit" class="btn10"><a href="../../livres.php">Retour</a></button>
    </header>
    <section class="instru">
      <h1>Inscription</h1>
      <p>Informations relatif aux Clients</p>
    </section>
    <div class="form-place02">
      <form method="POST" enctype="multipart/form-data">
        <div class="error02">
          <?php
          echo $errors['n_nom'] . '<br/>';
          echo $errors['n_prenom'] . '<br/>';
          echo $errors['n_mail'] . '<br/>';
          echo $errors['n_contact'] . '<br/>';
          echo $errors['n_date'] . '<br/>';
          echo $errors['photo'] . '<br/> ';
          echo $errors['structure'];
          ?>
        </div>
        <div class="img-form01">
          <input type="file" name="photo" class="photos" accept="image/png, image/jpeg, image/jpg">
        </div>
        <p>
          <input type="text" name="n_nom" placeholder="Nom" /><br />
          <input type="text" name="n_prenom" placeholder="Prénom" /><br />
          <input type="email" name="n_mail" placeholder="E-mail" /><br />
          <input type="number" name="n_contact" placeholder="Contact" /><br />
          <input type="date" name="n_date" max="<?php echo $start; ?>" /><br />
          <select name="structure">
            <option value="">--selectionné une option--</option>
            <?php foreach ($resultats as $resultat) { ?>
              <option value="<?php echo $resultat['id']; ?>"><?php echo $resultat['nom']; ?></option>
            <?php } ?>
          </select>
          <button type="submit" name="submit" class="btn02">Valider</button>
        </p>
      </form>
    </div>
    <footer>
      <p>
        Copyright &copy;
        <script>
          document.write(new Date().getFullYear());
        </script>
        All rights reserved
      </p>
      <section class="vague">
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
      </section>
    </footer>
  </div>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>