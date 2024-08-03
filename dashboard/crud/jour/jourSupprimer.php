<?php
session_start();

require_once('../../../librairies/controllers/Jour.php');

$controller = new \Controllers\Jour();
$controller->effacer();