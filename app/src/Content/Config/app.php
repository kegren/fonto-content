<?php
/**
 * Part of Fonto Framework
 *
 * Application settings
 */

return array(
    /**
     * language
     */
    'language' => 'en',
    /**
     * Default timezone
     */
    'timezone' => 'Europe/Stockholm',
    /**
     * Database settings
     */
    'database' => array(
        'local' => array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'fontomvc',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ),
        'server' => array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'fontomvc',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ),
    ),
    /**
     * Application environment
     */
    'environment' => 'local',
);