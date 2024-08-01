<?php
session_start();

require_once ('../../../librairies/database/database.php');
require_once ('../../../librairies/patron.php');


if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
}

// GÉRER LA SUPPRESSION DE L'ANNÉE
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $db = getPdo();

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM annee WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $recuperer = $query->fetch();

    // CONFIRMER'IL EXISTE
    if (!$recuperer) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: annee.php');
        die();
    }

    // S'IL EXISTE - SUPPRIMER(confirmer JS)
    $sql = 'DELETE FROM annee WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $_SESSION['message'] = "Prédiction supprimée";
    header('Location: annee.php');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: annee.php');
}
