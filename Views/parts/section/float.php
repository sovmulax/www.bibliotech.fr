<?php# include('../../../php/connexion.php'); ?>
<nav class="float-square">
    <div class="card">
        <h2 class="headers">Statistiques</h2>
        <p class="stats">Toutes les nombres (stats) de la plateforme</p>
        <p>
            <h3 class="title-profl"><span class="sap">Clients : </span><?php $res = $connexion->query('SELECT id FROM users');
                                                                        $i = 0;
                                                                        while ($k = $res->fetch()) {
                                                                            $i++;
                                                                        }
                                                                        echo $i;
                                                                        ?></h3>
            <h3 class="title-profl"><span class="sap">Clients Inactif : </span><?php $res = $connexion->query('SELECT id FROM users WHERE actif = false');
                                                                        $i = 0;
                                                                        while ($k = $res->fetch()) {
                                                                            $i++;
                                                                        }
                                                                        echo $i;
                                                                        ?></h3>
            <h3 class="title-profl"><span class="sap">Livres</span> : <?php $res = $connexion->query('SELECT id FROM livres');
                                                                        $i = 0;
                                                                        while ($k = $res->fetch()) {
                                                                            $i++;
                                                                        }
                                                                        echo $i; ?></h3>
            <h3 class="title-profl"><span class="sap">Exemplaires</span> : <?php $res = $connexion->query('SELECT id FROM exemplaires');
                                                                            $i = 0;
                                                                            while ($k = $res->fetch()) {
                                                                                $i++;
                                                                            }
                                                                            echo $i; ?></h3>
            <h3 class="title-profl"><span class="sap">Exemplaires Irrécupérable : </span> <?php $res = $connexion->query('SELECT id FROM exemplaires WHERE etat_id = 3');
                                                                                            $i = 0;
                                                                                            while ($k = $res->fetch()) {
                                                                                                $i++;
                                                                                            }
                                                                                            echo $i; ?></h3>
            <h3 class="title-profl"><span class="sap">Exemplaires Présent : </span> <?php $res = $connexion->query('SELECT id FROM exemplaires WHERE emprunter = false');
                                                                                    $i = 0;
                                                                                    while ($k = $res->fetch()) {
                                                                                        $i++;
                                                                                    }
                                                                                    echo $i; ?></h3>
            <h3 class="title-profl"><span class="sap">Exemplaires Emprunter : </span> <?php $res = $connexion->query('SELECT id FROM exemplaires WHERE emprunter = true');
                                                                                        $i = 0;
                                                                                        while ($k = $res->fetch()) {
                                                                                            $i++;
                                                                                        }
                                                                                        echo $i; ?></h3>
        </p>
    </div>
</nav>