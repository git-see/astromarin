<?php
session_start();

require_once('../../../librairies/database/database.php');
require_once('../../../librairies/patron.php');

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
}

if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['dateAnnee']) && !empty($_POST['dateAnnee'])
        && isset($_POST['textAmourAnnee']) && !empty($_POST['textAmourAnnee'])
        && isset($_POST['textTravailAnnee']) && !empty($_POST['textTravailAnnee'])
        && isset($_POST['textSanteAnnee']) && !empty($_POST['textSanteAnnee'])
    ) {

        modifieAn1();

        $_SESSION['message'] = "Prédiction modifiée";
        require_once('../../../database/deconnexionBDD.php');

        header('Location: annee.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// RÉCUPÉRER ET AFFICHER
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));

    $modifie = modifieAn2($id);

    if (!$modifie) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
if (
    isset($_GET['id']) && !empty($_GET['id'])
) {

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));

    $sign = modifieAn3($id);
}
?>

<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- MODIFIER UNE PRÉDICTION";
render('../../../', 'annee/modifier', compact('pageTitle', 'sign', 'modifie', 'result'));
?>