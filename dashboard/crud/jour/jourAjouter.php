<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}

if ($_POST) {

    if (
        isset($_POST['signes_id']) && !empty($_POST['signes_id'])
        && isset($_POST['dateJour']) && !empty($_POST['dateJour'])
        && isset($_POST['textAmourJour']) && !empty($_POST['textAmourJour'])
        && isset($_POST['textTravailJour']) && !empty($_POST['textTravailJour'])
        && isset($_POST['textSanteJour']) && !empty($_POST['textSanteJour'])
    ) {

        require_once('../../../database/connexionBDD.php');

        $signe = strip_tags($_POST['signes_id']);
        $dateJour = strip_tags($_POST['dateJour']);
        $textAmourJour = strip_tags($_POST['textAmourJour']);
        $textTravailJour = strip_tags($_POST['textTravailJour']);
        $textSanteJour = strip_tags($_POST['textSanteJour']);

        $sql = 'INSERT INTO jour (signes_id, dateJour, textAmourJour, textTravailJour, textSanteJour) VALUES (:signes_id, :dateJour, :textAmourJour, :textTravailJour, :textSanteJour)';

        $query = $db->prepare($sql);

        $query->bindValue(':signes_id', $signe, PDO::PARAM_INT);
        $query->bindValue(':dateJour', $dateJour, PDO::PARAM_STR);
        $query->bindValue(':textAmourJour', $textAmourJour, PDO::PARAM_STR);
        $query->bindValue(':textTravailJour', $textTravailJour, PDO::PARAM_STR);
        $query->bindValue(':textSanteJour', $textSanteJour, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Prédiction ajoutée";
        require_once('../../../database/deconnexionBDD.php');

        header('Location: jour.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- AJOUTER JOUR";
ob_start();
require('../../../templates/jour/ajouter.php');
$pageContent = ob_get_clean();
require('../../../templates/layout.php');
?>