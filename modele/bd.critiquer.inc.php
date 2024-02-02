<?php

include_once "bd.inc.php";

function getCritiquerByIdR($idR) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getNoteMoyenneByIdR($idR) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select avg(note) from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    if ($req->rowCount()>0){
        return $resultat["avg(note)"];
    }
    else{
        return 0;
    }
}
function addCritique($idR, $mailU, $note, $commentaire) {
    try {
        $cnx = connexionPDO();

        // Vérifier s'il existe déjà une critique avec la même combinaison d'idR et mailU
        $checkReq = $cnx->prepare("SELECT COUNT(*) FROM critiquer WHERE idR = :idR AND mailU = :mailU");
        $checkReq->execute([':idR' => $idR, ':mailU' => $mailU]);

        if ($checkReq->fetchColumn() == 0) {
            // Aucun doublon trouvé, on peut insérer la critique
            $insertReq = $cnx->prepare("INSERT INTO critiquer (idR, mailU, note, commentaire) VALUES (:idR, :mailU, :note, :commentaire)");
            $insertReq->execute([':idR' => $idR, ':mailU' => $mailU, ':note' => $note, ':commentaire' => $commentaire]);
        } else {
            // Doublon trouvé, gestion de l'erreur ou message approprié
            echo "Vous avez déjà existé déjà.";
        }
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
}

// Traitement du formulaire d'ajout de critique
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assurez-vous que l'utilisateur est connecté avant de traiter le formulaire
    if (isLoggedOn()) {
        $idR = $_POST['idR'];
        $mailU = getMailULoggedOn();
        $note = $_POST['note'];
        $commentaire = $_POST['commentaire'];

        // Appel de la fonction addCritique
        addCritique($idR, $mailU, $note, $commentaire);
    } else {
        // Redirection vers la page de connexion (ou autre gestion d'erreur)
        header("Location: /");
        exit();
    }
}

function SupprimerCritique($idR, $mailU) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE FROM critiquer WHERE idR=:idR AND mailU=:mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
    } catch (PDOException $e) {
        die("Erreur !: " . $e->getMessage());
    }
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "\n getCritiquerByIdR(1) : \n";
    print_r(getCritiquerByIdR(1));

    echo "\n getNoteMoyenneByIdR(1) : \n";
    print_r(getNoteMoyenneByIdR(1));
    
    echo "\n addCritiquerByIdR(1) : \n";
    print_r(addCritiquerByIdR(1));
    
    echo "\n supprimerCritiqueByIdR(1) : \n";
    print_r(supprimerCritiqueByIdR(1));
}
?>