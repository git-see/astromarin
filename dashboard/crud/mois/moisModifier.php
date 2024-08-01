<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}

if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['dateMois']) && !empty($_POST['dateMois'])
        && isset($_POST['textAmourMois']) && !empty($_POST['textAmourMois'])
        && isset($_POST['textTravailMois']) && !empty($_POST['textTravailMois'])
        && isset($_POST['textSanteMois']) && !empty($_POST['textSanteMois'])
    ) {

        require_once('../../../database/connexionBDD.php');

        $id = strip_tags($_POST['id']);
        $dateMois = strip_tags($_POST['dateMois']);
        $textAmourMois = strip_tags($_POST['textAmourMois']);
        $textTravailMois = strip_tags($_POST['textTravailMois']);
        $textSanteMois = strip_tags($_POST['textSanteMois']);

        // MODIFIER
        $sql = 'UPDATE mois SET dateMois = :dateMois, textAmourMois = :textAmourMois, textTravailMois = :textTravailMois, textSanteMois = :textSanteMois WHERE id = :id;';

        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dateMois', $dateMois, PDO::PARAM_STR);
        $query->bindValue(':textAmourMois', $textAmourMois, PDO::PARAM_STR);
        $query->bindValue(':textTravailMois', $textTravailMois, PDO::PARAM_STR);
        $query->bindValue(':textSanteMois', $textSanteMois, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['message'] = "Prédiction modifiée";
        require_once('../../../database/deconnexionBDD.php');

        header('Location: mois.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// RÉCUPÉRER ET AFFICHER
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('../../../database/connexionBDD.php');

    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM mois WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $modifie = $query->fetch();

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
    $sql2 = 'SELECT signe FROM signes,mois WHERE signes.id = mois.signes_id AND mois.id = :id';
    $query2 = $db->prepare($sql2);
    $query2->execute(['id' => $_GET['id']]);
    $sign = $query2->fetch();
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- MODIFIER MOIS";
ob_start();
require('../../../templates/mois/modifier.php');
$pageContent = ob_get_clean();
require('../../../templates/layout.php');
?>