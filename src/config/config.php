<?php

    function getConnexion()
    {
        $config = [
            'db' => [
                'host' => 'localhost',
                'port' => '3307',
                'username' => 'root',
                'password' => 'root',
                'database' => 'beauty'
            ]
        ];

        try {
            $pdo = new PDO(
                'mysql:host=' . $config['db']['host'] . ';port=' . $config['db']['port'] . ';dbname=' . $config['db']['database'],
                $config['db']['username'],
                $config['db']['password']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $pdo;
    }

