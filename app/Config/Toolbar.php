<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Debug\Toolbar\Collectors\Database;
use CodeIgniter\Debug\Toolbar\Collectors\Events;
use CodeIgniter\Debug\Toolbar\Collectors\Files;
use CodeIgniter\Debug\Toolbar\Collectors\History;
use CodeIgniter\Debug\Toolbar\Collectors\Logs;
use CodeIgniter\Debug\Toolbar\Collectors\Routes;
use CodeIgniter\Debug\Toolbar\Collectors\Timers;
use CodeIgniter\Debug\Toolbar\Collectors\Views;

/**
 * --------------------------------------------------------------------------
 * Debug Toolbar
 * --------------------------------------------------------------------------
 *
 * The Debug Toolbar provides a wealth of information to the developer
 * about the current request, improving the speed of development.
 */
class Toolbar extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Toolbar Collectors
     * --------------------------------------------------------------------------
     *
     * List of toolbar collectors that will be called when the Debug Toolbar
     * fires.
     *
     * @var list<class-string>
     */
    public array $collectors = [
        Timers::class,
        Database::class,
        Logs::class,
        Views::class,
        // \CodeIgniter\Debug\Toolbar\Collectors\Cache::class,
        Files::class,
        Routes::class,
        Events::class,
        History::class,
    ];

    /**
     * --------------------------------------------------------------------------
     * Collect Var Data
     * --------------------------------------------------------------------------
     *
     * If true, the collectors will also collect the data associated with
     * the variable data.
     */
    public bool $collectVarData = true;

    /**
     * --------------------------------------------------------------------------
     * Max History
     * --------------------------------------------------------------------------
     *
     * The maximum number of history files to keep.
     */
    public int $maxHistory = 20;

    /**
     * --------------------------------------------------------------------------
     * Toolbar Views Path
     * --------------------------------------------------------------------------
     *
     * The path to the views that are used to generate the Toolbar.
     */
    public string $viewsPath = SYSTEMPATH . 'Debug/Toolbar/Views/';

    /**
     * --------------------------------------------------------------------------
     * Max Queries
     * --------------------------------------------------------------------------
     *
     * The maximum number of queries to display in the Toolbar.
     */
    public int $maxQueries = 100;
}
