<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}

// GÉRER LA SUPPRESSION DE L'ANNÉE
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('../../../database/connexionBDD.php');

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
