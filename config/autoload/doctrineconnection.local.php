<?php
/**
 * This file will only be needed if you didn't set up a Doctrine-Connection yet
 */
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'Bosari31#',
                    'dbname'   => 'alice',
                    'charset' => 'utf8',
                    'driverOptions' => array(
                        1002=>'SET NAMES utf8'
                    )
                )
            )
        )
    )
);