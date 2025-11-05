<?php
namespace SchoolAgent\Config;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null) {
            // Charger la configuration
            $config = include __DIR__ . '/database.config.php';
            
            $host = $config['host'];
            $port = $config['port'];
            $dbname = $config['dbname'];
            $username = $config['username'];
            $password = $config['password'];
            $charset = $config['charset'];

            try {
                self::$instance = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $username, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion : ' . $e->getMessage() . "\n" .
                    'Vérifier app/Config/database.config.php');
            }
        }

        return self::$instance;
    }
}
