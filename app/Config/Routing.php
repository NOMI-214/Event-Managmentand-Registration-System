<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * --------------------------------------------------------------------------
 * Routing Configuration
 * --------------------------------------------------------------------------
 *
 * This file allows you to configure global routing settings.
 */
class Routing extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Router Default Namespace
     * --------------------------------------------------------------------------
     *
     * The default namespace to use for Controllers when no other
     * namespace has been specified.
     */
    public string $defaultNamespace = 'App\Controllers';

    /**
     * --------------------------------------------------------------------------
     * Router Default Controller
     * --------------------------------------------------------------------------
     *
     * The default controller to use when no other controller has been
     * specified.
     */
    public string $defaultController = 'Home';

    /**
     * --------------------------------------------------------------------------
     * Router Default Method
     * --------------------------------------------------------------------------
     *
     * The default method to call on the controller when no other
     * method has been specified.
     */
    public string $defaultMethod = 'index';

    /**
     * --------------------------------------------------------------------------
     * Router Translate URIs
     * --------------------------------------------------------------------------
     *
     * If true, the URI will be translated to dashes.
     */
    public bool $translateURIDashes = false;

    /**
     * --------------------------------------------------------------------------
     * Router Auto Route
     * --------------------------------------------------------------------------
     *
     * If true, the system will attempt to match the URI to a controller
     * and method.
     */
    public bool $autoRoute = false;

    /**
     * --------------------------------------------------------------------------
     * Override 404
     * --------------------------------------------------------------------------
     *
     * If true, the system will attempt to use the 404 Override
     * controller/method when no route is found.
     */
    public ?string $override404 = null;
    
    /**
     * --------------------------------------------------------------------------
     * Module Routing
     * --------------------------------------------------------------------------
     *
     * If true, the system will attempt to match the URI to a module.
     */
    public bool $moduleRoutes = true;

    /**
     * --------------------------------------------------------------------------
     * Prioritize URI
     * --------------------------------------------------------------------------
     *
     * If true, the system will prioritize the URI over the defined routes.
     */
    public bool $prioritize = false;
    
    /**
     * --------------------------------------------------------------------------
     * Route Files
     * --------------------------------------------------------------------------
     *
     * The route files to load.
     *
     * @var array<string, string>
     */
    public array $routeFiles = [
        'Routes' => APPPATH . 'Config/Routes.php',
    ];

    /**
     * --------------------------------------------------------------------------
     * Multiple Segments One Method
     * --------------------------------------------------------------------------
     *
     * If true, the system will allow multiple segments to be mapped to a single method.
     */
    public bool $multipleSegmentsOneParam = false;
}
