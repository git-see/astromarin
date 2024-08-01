<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
} else {
    require_once('../../../database/connexionBDD.php');
    $sql = 'SELECT * FROM signes, annee WHERE signes.id = annee.signes_id LIMIT 12';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- GESTION ANNÉE";
ob_start();
require('../../../templates/annee/annee.php');
$pageContent = ob_get_clean();
require('../../../templates/layout.php');
?>