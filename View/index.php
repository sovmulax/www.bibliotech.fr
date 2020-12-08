<?php session_start();
include '../php/connexion.php';
$errors = array('email' => '', 'n_password' => '', 'acces' => '');
$error = "";
if (isset($_POST['submit'])) {

  //check email
  if (empty($_POST['email'])) {
    $errors['email'] = "Entrée vôtre e-mail";
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "le mail entré n'est pas valide";
    }
  }

  //check password
  if (empty($_POST['n_password'])) {
    $errors['n_password'] = "Entrée vôtre code";
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
    $req = $connexion->prepare('SELECT * FROM users WHERE email = :email');
    $req->execute(['email' => $email]);
    $ges = $req->fetch();
    if($ges['email'] == $email){
      if (($_POST['n_password'] == $ges['matricule']) && ($ges['actif'] == $actif)) {
        //sauvegarde de session
        $reponse = $connexion->prepare('SELECT * FROM users WHERE email= :mail AND actif = :bool');
        $reponse->execute(['mail' => $email, 'bool' => $actif]);
        while ($elements = $reponse->fetch()) {
          $n_nom = $elements['nom'];
          $n_prenom = $elements['prenom'];
          $name = $elements['id'] . '.' . $elements['extension'];
          $matricule = $elements['matricule'];
          $mail = $elements['email'];
          $id = $elements['id'];
        }
          //recupération des info depuis la bdd
          $_SESSION['users'] = array('id'=>$id ,'nom' => $n_nom, 'prenom' => $n_prenom, 'photo' => $name, 'matricule' => $matricule, 'mail' => $mail);
        //header
        header('Location: acceuil.php');
      } else {
        $errors['n_password'] = "Code Incorrect Ou vous êtes inactif";
      }
    }else{
      $errors['email'] = "email Incorrect";
    }
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
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
        <input type="password" name="n_password" placeholder="Matricule" /><br />
        <button type="submit" name="submit" class="btn01">Valider</button>
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
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>