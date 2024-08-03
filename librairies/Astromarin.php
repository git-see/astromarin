<?php

class Astromarin
{
    /*
* Retourne une redirection
*
* @param string $url, $msg
* @return void
*/
    public static function crud(string $dossier, string $crud)
    {
        $controller = new $dossier();
        $controller->$crud();
    }
}
