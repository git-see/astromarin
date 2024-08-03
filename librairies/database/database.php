<?php

class Database
{
    /*
* Retourne la connexion à la base de données
*
* @return PDO
*/
    public static function getPdo(): PDO
    {
        $servername = "localhost";
        $database = "astromarin";
        $username = "root";
        $password = "";

        try {
            $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo "erreur de connexion:" . $e->getMessage();
            die();
        };
        return $db;
    }
}
