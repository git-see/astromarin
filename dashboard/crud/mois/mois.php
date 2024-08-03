<?php
session_start();

require_once('../../../librairies/controllers/Mois.php');

$controller = new \Controllers\Mois();
$controller->lireListe();