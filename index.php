<?php
session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Membre") || !isset($_SESSION["user"]) &&  !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
} else {
    require_once('database/connexionBDD.php');

    $sql = 'SELECT `id`, `signe`, `image` FROM `signes`
';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    require_once('database/deconnexionBDD.php');
}
?>
<?php
$pageTitle = "ACCUEIL";
ob_start();
require('templates/indexAccueil.php');
$pageContent = ob_get_clean();
require('templates/layout.php');
?>