<?php
session_start();

require_once('../../../librairies/autoload.php');

$controller = new \Controllers\Jour();
$controller->creer();