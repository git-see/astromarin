<?php
session_start();

require_once('../../../librairies/database/database.php');
require_once('../../../librairies/patron.php');
require_once('../../../librairies/models/Annee.php');

$annee = new Annee();


if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
}

// GÉRER LA SUPPRESSION DE L'ANNÉE
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = strip_tags($_GET['id']);

    $recuperer = $annee->supprime1($id);

    // CONFIRMER'IL EXISTE
    if (!$recuperer) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: annee.php');
        die();
    }

    $annee->supprime2($id);

    $_SESSION['message'] = "Prédiction supprimée";
    header('Location: annee.php');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: annee.php');
}
