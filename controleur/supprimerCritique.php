<?php
include_once "../modele/bd.critiquer.inc.php";

if (isset($_GET['idR']) && isset($_GET['mailU'])) {
    $idR = $_GET['idR'];
    $mailU = $_GET['mailU'];

    // Appelez la fonction pour supprimer la critique par idR et mailU
    SupprimerCritique($idR, $mailU);

    echo "Message supprimé";
    echo "<br><a href='/'>Retourner à l'accueil</a>";

    // Assurez-vous d'exit après l'utilisation de header
    exit();
} else {
    // Gérez le cas où les paramètres sont manquants
    echo "Requête invalide !";
}
?>
