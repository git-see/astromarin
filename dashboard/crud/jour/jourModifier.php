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
        && isset($_POST['dateJour']) && !empty($_POST['dateJour'])
        && isset($_POST['textAmourJour']) && !empty($_POST['textAmourJour'])
        && isset($_POST['textTravailJour']) && !empty($_POST['textTravailJour'])
        && isset($_POST['textSanteJour']) && !empty($_POST['textSanteJour'])
    ) {

        modifieJour1();

        $_SESSION['message'] = "Prédiction modifiée";
        require_once('../../../database/deconnexionBDD.php');

        header('Location: jour.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));

    $modifie = modifieJour2($id);

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

    $sign = modifieJour3($id);
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- MODIFIER JOUR";
render('../../../', 'jour/modifier', compact('pageTitle', 'sign', 'modifie', 'result'));
?>