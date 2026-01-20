<?php

namespace Config;

/**
 * Paths Configuration
 *
 * NOTE: This class is required prior to Autoloader instantiation,
 * and does not extend BaseConfig.
 *
 * @immutable
 */
class Paths
{
    /**
     * -------- SYSTEM FOLDER --------
     * This variable must contain the name of your "system"
     * folder. Include the path if the folder is not in the same
     * directory as this file.
     */
    public string $systemDirectory = __DIR__ . '/../../vendor/codeigniter4/framework/system';

    /**
     * -------- APPLICATION FOLDER --------
     * If you want this front controller to use a different
     * "app" folder than the default one you can set its name here.
     * This folder can be renamed or relocated anywhere on your server.
     * Leave this value empty if you would like to use the default
     * "app" folder.
     *
     * @var string
     */
    public string $appDirectory = __DIR__ . '/..';

    /**
     * -------- WRITABLE DIRECTORY --------
     * This directory must be writable by the web server to accept
     * uploaded files, make logs, etc. Ensure it has world-writable
     * permissions. *DO NOT* change the name of this directory unless
     * you have already physically renamed it on your server.
     *
     * @var string
     */
    public string $writableDirectory = __DIR__ . '/../../writable';

    /**
     * -------- TEST DIRECTORY --------
     * This directory is used by the system for PHPUnit testing.
     * Do not change the name of this directory unless you have
     * physically renamed it on your server.
     *
     * @var string
     */
    public string $testsDirectory = __DIR__ . '/../../tests';

    /**
     * -------- VIEW DIRECTORY --------
     * This directory contains the view files that are currently in use.
     *
     * @var string
     */
    public string $viewDirectory = __DIR__ . '/../Views';
}
