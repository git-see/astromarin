<?php
session_start();

require_once ('../../../librairies/database/database.php');
require_once ('../../../librairies/patron.php');

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
   
    $db = getPdo();

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM mois WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $recuperer = $query->fetch();

    if (!$recuperer) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: mois.php');
        die();
    }

    $sql = 'DELETE FROM mois WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $_SESSION['message'] = "Prédiction supprimée";
    header('Location: mois.php');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: mois.php');
}
