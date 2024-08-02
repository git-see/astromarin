<?php
session_start();

require_once('../../../librairies/database/database.php');
require_once('../../../librairies/patron.php');
require_once('../../../librairies/models/Annee.php');

$annee = new Annee();

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

        $annee->ajout();

        $_SESSION['message'] = "Prédiction ajoutée";
        require_once('../../../librairies/database/deconnexionBDD.php');

        header('Location: annee.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- RAJOUTER UNE PRÉDICTION SUPPRIMÉE";
render('../../../', 'annee/ajouter', compact('pageTitle'));
?>