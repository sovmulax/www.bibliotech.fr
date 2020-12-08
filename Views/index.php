<?php session_start();
include '../php/connexion.php';
$errors = array('email' => '', 'n_password' => '', 'acces' => '');
$error = "";
if (isset($_POST['submit'])) {

  //check email
  if (empty($_POST['email'])) {
    $errors['email'] = "Entrée un E-MAIL";
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "le mail entré n'est pas valide";
    }
  }

  //check password
  if (empty($_POST['n_password'])) {
    $errors['n_password'] = "Entrée un mot de passe";
  } else {
    $n_password = $_POST['n_password'];
  }

  //envoie de donner
  if (array_filter($errors)) {
    //rien du tous
  } else {
    //securité des donners

    $actif = true;
    //requete sql
    $req = $connexion->prepare('SELECT * FROM gestionnaire WHERE email = :email');
    $req->execute(['email' => $email]);
    $ges = $req->fetch();
    if($ges['email'] == $email){
      if (password_verify($_POST['n_password'], $ges['pass']) && $ges['actif'] == $actif) {
        //sauvegarde de session
        $reponse = $connexion->prepare('SELECT nom, prenom, extension FROM gestionnaire WHERE email= :mail AND actif = :bool');
        $reponse->execute(['mail' => $email, 'bool' => $actif]);
        while ($elements = $reponse->fetch()) {
          $n_nom = $elements['nom'];
          $n_prenom = $elements['prenom'];
          $name = $ges['email'] . '.' . $elements['extension'];
        }
        //recupération des info depuis la bdd
        $_SESSION['name'] = array('nom' => $n_nom, 'prenom' => $n_prenom, 'photo' => $name);
  
        //header
        header('Location: livres.php');
      } else {
        $errors['n_password'] = "mot de passe Incorrect Ou vous êtes inactif";
      }
    }else{
      $errors['email'] = "email Incorrect";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Connexion | BiblioTech</title>
  <link rel="stylesheet" href="../Static/css/formulaire.css" />
  <link rel="stylesheet" href="../Static/css/wave.css">
</head>

<body>
  <div class="info">
    <h1><i class="fas fa-book-open"></i> BiblioTech</h1>
    <p>Numéro une des plate-formes en ligne de gestion de Bibliothèque</p>
  </div>
  <div class="form-place01">
    <form method="POST">
      <h2>Connexion</h2>
      <div class="error01">
        <?php
        echo $errors['email'] . '<br/>';
        echo $errors['n_password'];
        echo $errors['acces'];
        ?>
      </div>
      <p>
        <input type="email" name="email" placeholder="E-mail" /><br />
        <input type="password" name="n_password" placeholder="Mot de Passe" /><br />
        <button type="submit" name="submit" class="btn01">Valider</button>
      </p>
    </form>
    <p><a href="./form/gestionnaire/inscription.php">Inscription ?</a></p>
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