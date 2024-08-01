<link rel="stylesheet" href="/style.css">
<?php
require_once ('../librairies/patron.php');
?>
<?php
$pageTitle = "CONNEXION";
render('../', 'formulaires/connexion', compact('pageTitle'));
?>