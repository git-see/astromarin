<?php
session_start();

require_once ('../../../librairies/database/database.php');
require_once ('../../../librairies/patron.php');


if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');

}

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = strip_tags($_GET['id']);

    $recuperer = supprimeJour1($id);

    if (!$recuperer) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: jour.php');
        die();
    }

    supprimejour2($id);

    $_SESSION['message'] = "Prédiction supprimée";
    header('Location: jour.php');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: jour.php');
}
