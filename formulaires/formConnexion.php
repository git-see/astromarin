<link rel="stylesheet" href="/style.css">
<?php
require_once ('../librairies/Rendus.php');
?>
<?php
$pageTitle = "CONNEXION";
\Rendus::render('../', 'formulaires/connexion', compact('pageTitle'));
?>