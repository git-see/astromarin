<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}

if ($_POST) {

    if (
        isset($_POST['signes_id']) && !empty($_POST['signes_id'])
        && isset($_POST['dateMois']) && !empty($_POST['dateMois'])
        && isset($_POST['textAmourMois']) && !empty($_POST['textAmourMois'])
        && isset($_POST['textTravailMois']) && !empty($_POST['textTravailMois'])
        && isset($_POST['textSanteMois']) && !empty($_POST['textSanteMois'])
    ) {

        require_once('..////..///../database/connexionBDD.php');

        $signe = strip_tags($_POST['signes_id']);
        $dateMois = strip_tags($_POST['dateMois']);
        $textAmourMois = strip_tags($_POST['textAmourMois']);
        $textTravailMois = strip_tags($_POST['textTravailMois']);
        $textSanteMois = strip_tags($_POST['textSanteMois']);

        $sql = 'INSERT INTO mois (signes_id, dateMois, textAmourMois, textTravailMois, textSanteMois) VALUES (:signes_id, :dateMois, :textAmourMois, :textTravailMois, :textSanteMois)';

        $query = $db->prepare($sql);

        $query->bindValue(':signes_id', $signe, PDO::PARAM_INT);
        $query->bindValue(':dateMois', $dateMois, PDO::PARAM_STR);
        $query->bindValue(':textAmourMois', $textAmourMois, PDO::PARAM_STR);
        $query->bindValue(':textTravailMois', $textTravailMois, PDO::PARAM_STR);
        $query->bindValue(':textSanteMois', $textSanteMois, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Prédiction ajoutée";
        require_once('../../../database/deconnexionBDD.php');

        header('Location: mois.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- AJOUTER MOIS";
ob_start();
require('../../../templates/mois/ajouter.php');
$pageContent = ob_get_clean();
require('../../../templates/layout.php');
?>