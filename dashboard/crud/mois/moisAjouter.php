<?php
session_start();

require_once('../../../librairies/database/database.php');
require_once('../../../librairies/patron.php');

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
}

if ($_POST) {

    if (
        isset($_POST['signes_id']) && !empty($_POST['signes_id'])
        && isset($_POST['dateMois']) && !empty($_POST['dateMois'])
        && isset($_POST['textAmourMois']) && !empty($_POST['textAmourMois'])
        && isset($_POST['textTravailMois']) && !empty($_POST['textTravailMois'])
        && isset($_POST['textSanteMois']) && !empty($_POST['textSanteMois'])
    ) {

        ajoutMois();

        $_SESSION['message'] = "Prédiction ajoutée";
        require_once('../../../librairies/database/deconnexionBDD.php');

        header('Location: mois.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- AJOUTER MOIS";
render('../../../', 'mois/ajouter', compact('pageTitle', 'result'));
?>