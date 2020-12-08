<?php
session_start();
include '../../../php/connexion.php';
$errors = array('n_nom' => '', 'n_prenom' => '', 'n_mail' => '', 'n_contact' => '', 'n_date' => '', 'n_password' => '', 'photo' => '');
$start = '2020-11-01';
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
    $errors['photo'] = 'Erreur de fichier';
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
    $req = $connexion->prepare('SELECT id FROM gestionnaire WHERE email = ?');
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

  //check password
  if (empty($_POST['n_password']) && empty($_POST['n_pass_confirm'])) {
    $errors['n_password'] = "Entrée un mot de passe";
  } else {
    if ($_POST['n_password'] === $_POST['n_pass_confirm']) {
      $n_password = $_POST['n_password'];
    } else {
      $errors['n_password'] = "Entrée le même mot de passe";
    }
  }

  $actif = true;
  $req = $connexion->prepare('SELECT id FROM gestionnaire WHERE actif = ?');
  $req->execute([$actif]);
  $users = $req->fetch();
  if ($users) {
    $errors['n_nom'] = "Un gestionnaire est déjà en activité";
  }
  //envoie de donner
  if (array_filter($errors)) {
    //rien du tous
  } else {
    if ($envoie) {
      // On peut valider le fichier et le stocker définitivement
      $_FILES['photo']['name'] = $n_mail . '.' . $extension_upload;
      move_uploaded_file($_FILES['photo']['tmp_name'], '../../../Static/img/gestionnaire/' . basename($_FILES['photo']['name']));
    }
    //securité des donners
    $n_nom = mysqli_real_escape_string($conn, $_POST['n_nom']);
    $n_prenom = mysqli_real_escape_string($conn, $_POST['n_prenom']);
    $n_mail = mysqli_real_escape_string($conn, $_POST['n_mail']);
    $n_contact = mysqli_real_escape_string($conn, $_POST['n_contact']);
    $password = password_hash($_POST['n_password'], PASSWORD_BCRYPT);



    //requete sql
    $sql = "INSERT INTO gestionnaire(nom, prenom, email, pass, born_date, contact, extension, actif) VALUES('$n_nom','$n_prenom','$n_mail', '$password', '$n_date', '$n_contact','$extension_upload', true)";

    // save to db and check
    if (mysqli_query($conn, $sql)) {
      // success
      header('Location: ../../../index.php');
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
  <title>Inscription | BiblioTech</title>
  <link rel="stylesheet" href="../../../Static/css/formulaire.css" />
  <link rel="stylesheet" href="../../../Static/css/wave.css">
</head>

<body>
  <div class="info">
    <h1><i class="fas fa-book-open"></i> BiblioTech</h1>
    <p>Numéro une des plate-formes en ligne de gestion de Bibliothèque</p>
  </div>
  <div class="form-place00">
    <form method="POST" enctype="multipart/form-data">
      <div class="error00">
        <?php
        echo $errors['n_nom'] . '<br/>';
        echo $errors['n_prenom'] . '<br/>';
        echo $errors['n_mail'] . '<br/>';
        echo $errors['n_contact'] . '<br/>';
        echo $errors['n_date'] . '<br/>';
        echo $errors['n_password'] . " ";
        echo $errors['photo'];
        ?>
      </div>
      <div class="img-form00">
        <input type="file" name="photo" class="photos" accept="image/png, image/jpeg, image/jpg">
      </div>

      <p>
        <input type="text" name="n_nom" placeholder="Nom" /><br />
        <input type="text" name="n_prenom" placeholder="Prénom" /><br />
        <input type="email" name="n_mail" placeholder="E-mail" /><br />
        <input type="number" name="n_contact" placeholder="+225" /><br />
        <input type="date" name="n_date" max="<?php echo $start; ?>" /><br />
        <input type="password" name="n_password" placeholder="Mot de Passe" /><br />
        <input type="password" name="n_pass_confirm" placeholder="Confirmé" />
        <button type="submit" name="submit" class="btn00">Valider</button>
      </p>
    </form>
    <p><a href="../../index.php">Connexion ?</a></p>
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
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>