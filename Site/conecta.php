<?php

    $config = array (
        'APP_PREFIX' => '..',
        'DEFAULT_TIME_ZONE' => 'America/Sao_Paulo',
        'DB_HOST' => '127.0.0.1',
        'DB_USER' => 'root',
        'DB_DATABASE' => 'FORMULA1',
        'DB_PASSWORD' => '',
    );

	date_default_timezone_set($config['DEFAULT_TIME_ZONE']);
	
    function getConnection()
    {
        static $dbh = null;
        global $config;
        global $host, $user, $database, $pass;
 
        if($dbh == null)
        {
            $host = $config["DB_HOST"];
            $user = $config["DB_USER"];
            $database = $config["DB_DATABASE"];
            $pass = $config["DB_PASSWORD"];
            // Tenta abrir conexão com a base de dados do Mysql
            try
            {
                $dbh = new PDO("mysql:host={$host};dbname={$database};charset=utf8",$user,$pass);
            }
            catch(PDOException $e)
            {
                error_log("Unable to open connection {$user}@{$host} database {$database} using password.");
                header('HTTP/1.1 500 Internal Server Error');
                die();
            }
        }
        return $dbh;
    }