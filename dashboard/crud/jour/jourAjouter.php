<?php
session_start();

require_once('../../../librairies/database/database.php');
require_once('../../../librairies/patron.php');
require_once('../../../librairies/models/Jour.php');

$jour = new Jour();

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
}

if ($_POST) {

    if (
        isset($_POST['signes_id']) && !empty($_POST['signes_id'])
        && isset($_POST['champDate']) && !empty($_POST['champDate'])
        && isset($_POST['textAmour']) && !empty($_POST['textAmour'])
        && isset($_POST['textTravail']) && !empty($_POST['textTravail'])
        && isset($_POST['textSante']) && !empty($_POST['textSante'])
    ) {

        $jour->ajout();

        $_SESSION['message'] = "Prédiction ajoutée";
        require_once('../../../librairies/database/deconnexionBDD.php');

        header('Location: jour.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- AJOUTER JOUR";
render('../../../', 'jour/ajouter', compact('pageTitle'));
?>