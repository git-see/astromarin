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
        && isset($_POST['dateAnnee']) && !empty($_POST['dateAnnee'])
        && isset($_POST['textAmourAnnee']) && !empty($_POST['textAmourAnnee'])
        && isset($_POST['textTravailAnnee']) && !empty($_POST['textTravailAnnee'])
        && isset($_POST['textSanteAnnee']) && !empty($_POST['textSanteAnnee'])
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