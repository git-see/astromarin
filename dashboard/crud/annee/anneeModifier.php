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
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['champDate']) && !empty($_POST['champDate'])
        && isset($_POST['textAmour']) && !empty($_POST['textAmour'])
        && isset($_POST['textTravail']) && !empty($_POST['textTravail'])
        && isset($_POST['textSante']) && !empty($_POST['textSante'])
    ) {

        $annee->modifie1();

        $_SESSION['message'] = "Prédiction modifiée";
        require_once('../../../librairies/database/deconnexionBDD.php');

        header('Location: annee.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// RÉCUPÉRER ET AFFICHER
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));

    $modifie = $annee->modifie2($id);

    if (!$modifie) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ../index.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ../index.php');
}
if (
    isset($_GET['id']) && !empty($_GET['id'])
) {

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));

    $sign = $annee->modifie3($id);
}
?>

<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- MODIFIER UNE PRÉDICTION ANNUELLE";
render('../../../', 'annee/modifier', compact('pageTitle', 'sign', 'modifie'));
?>