<?php
session_start();

// require_once('../../../librairies/controllers/Annee.php');

require_once('../../../librairies/autoload.php');

$controller = new \Controllers\Annee();
$controller->lireListe();

