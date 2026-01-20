<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Kint\Parser\ConstructablePluginInterface;
use Kint\Renderer\RendererInterface;


/**
 * --------------------------------------------------------------------------
 * Kint
 * --------------------------------------------------------------------------
 *
 * We use Kint's `RichRenderer` and `CliRenderer`. This area provides control
 * over their output.
 */
class Kint extends BaseConfig
{
    /*
    |--------------------------------------------------------------------------
    | Global Settings
    |--------------------------------------------------------------------------
    */

    /**
     * @var array<class-string<ConstructablePluginInterface>|ConstructablePluginInterface>|null
     */
    public $plugins;

    /**
     * @var int
     */
    public $maxDepth = 6;

    /**
     * @var bool
     */
    public $displayCalledFrom = true;

    /**
     * @var bool
     */
    public $expanded = false;

    /*
    |--------------------------------------------------------------------------
    | RichRenderer Settings
    |--------------------------------------------------------------------------
    */

    /**
     * @var string
     */
    public $richTheme = 'aante-light.css';

    /**
     * @var bool
     */
    public $richFolder = false;



    /**
     * @var array<string, class-string<RendererInterface>>|null
     */
    public $richObjectPlugins;

    /**
     * @var array<string, class-string<RendererInterface>>|null
     */
    public $richTabPlugins;

    /*
    |--------------------------------------------------------------------------
    | CliRenderer Settings
    |--------------------------------------------------------------------------
    */

    /**
     * @var bool
     */
    public $cliColors = true;

    /**
     * @var bool
     */
    public $cliForceUTF8 = false;

    /**
     * @var bool
     */
    public $cliDetectWidth = true;

    /**
     * @var int
     */
    public $cliMinWidth = 40;
}
