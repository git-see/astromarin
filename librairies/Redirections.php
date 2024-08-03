<?php

class Redirections
{
    /*
* Retourne une redirection
*
* @param string $url, $msg
* @return void
*/
    public static function redirect(string $url, string $msg)
    {
        header("Location: $url");
        die($msg);
    }
}
