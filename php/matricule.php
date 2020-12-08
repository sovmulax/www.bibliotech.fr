<?php
function matricule($an, $nom, $prenom, $email){
    $deb = substr($an, -2);
    $entre = $nom[0];
    $entref = $prenom[0];
    $entrefi = $email[0];
    $fin = mt_rand(00000, 99999);
    $matricule = $deb.$entre.$entref.$entrefi.$fin;
    return strtoupper($matricule);
}