<nav class="nav-side">
  <h1 class="text-center title"><i class="fas fa-book"></i> BiblioTech</h1>
  <br />
  <div class="profile">
    <div class="img-profil">
      <img src="../../../Static/img/gestionnaire/<?php echo $_SESSION['name']['photo'] ?>" alt="photo-de-profile">
    </div>
    <p class="auth">
      <span class="name"><?php echo $_SESSION['name']['nom'] . ' ' . $_SESSION['name']['prenom']; ?></span> <br />
      Bibliothécaire
    </p>
  </div>
  <div class="menu">
    <ul class="menu-list">
      <li class="on-list">
        <i class="fas fa-angle-right"> </i> Menu Etudiant
      </li>
      <ul class="under">
        <li>
          <a href="form/client/Carte.php"><i class="fas fa-users"></i> Liste des Inscrits</a>
        </li>
        <li>
          <a href="form/client/index.php"><i class="fas fa-user-plus"></i> inscription de clients</a>
        </li>
      </ul>
      <li class="on-list">
        <i class="fas fa-angle-right"></i> Menu Livres
      </li>
      <ul class="under">
        <li>
          <a href="livres.php"><i class="far fa-bookmark"></i> Liste des livres</a>
        </li>
        <li>
          <a href="ajout00.php"><i class="far fa-file-alt"></i> Ajouter une Oeuvre</a>
        </li>
        <li>
          <a href="exemplaire.php"><i class="far fa-file-alt"></i> Crée des exemplaires</a>
        </li>
        <li>
          <a href="emprunters.php"><i class="far fa-paper-plane"></i> Les emprunters</a>
        </li>
        <li>
          <a href="presents.php"><i class="fas fa-thumbtack"></i> Les Présents</a>
        </li>
      </ul>
      <li class="on-list">
        <i class="fas fa-angle-right"></i> Menu Emprunts
      </li>
      <ul class="under">
        <li>
          <a href="take_emprunts0.php"><i class="fas"></i> Emprunt</a>
        </li>
        <li>
          <a href="take_retour.php"><i class="fas"></i> Retour</a>
        </li>
        <li>
          <a href="mauvais.php">Récapitulatif</a>
        </li>
      </ul>
      <li class="on-list">
        <a href="divers.php">Ajout de divers</a>
      </li>
      <div class="parametre"><a href="form/gestionnaire/parametre.php"><i class="fas fa-cog"></i> Paramètre</a></div>
    </ul>
  </div>
  <div class="pied">
    <p>
      Copyright &copy;
      <script>
        document.write(new Date().getFullYear());
      </script>
      All rights reserved
    </p>
  </div>
</nav>