<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}
?>
    <link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- DASHBOARD/ACCUEIL";
ob_start();
require('../templates/accueilDashboard.php');
$pageContent = ob_get_clean();
require('../templates/layout.php');
?>
