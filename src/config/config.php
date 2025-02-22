<?php

    function getConnexion()
    {
        $config = [
            'db' => [
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => 'beauty'
            ]
        ];

        try {
            $pdo = new PDO("mysql:host={$config['db']['host']};dbname={$config['db']['database']}", $config['db']['username'], $config['db']['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<script>console.log('Connected to the database')</script>";
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $pdo;
    }

