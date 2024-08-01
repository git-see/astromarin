<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('../../../database/connexionBDD.php');

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM jour WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $recuperer = $query->fetch();

    if (!$recuperer) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: jour.php');
        die();
    }

    $sql = 'DELETE FROM jour WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $_SESSION['message'] = "Prédiction supprimée";
    header('Location: jour.php');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: jour.php');
}
