<?php
session_start();

require_once('../librairies/Rendus.php');

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

  \Redirections::redirect('/formulaires/formConnexion.php', '');
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- DASHBOARD/ACCUEIL";
\Rendus::render('../', 'accueilDashboard', compact('pageTitle'));
?>