<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\View\ViewDecoratorInterface;

class View extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Saved Data
     * --------------------------------------------------------------------------
     *
     * If true, will save the data to the View class when the
     * view is rendered.
     */
    public bool $saveData = true;

    /**
     * --------------------------------------------------------------------------
     * View Filters
     * --------------------------------------------------------------------------
     *
     * An array of view filters to run on the generated HTML.
     */
    public array $filters = [];

    /**
     * --------------------------------------------------------------------------
     * View Decorators
     * --------------------------------------------------------------------------
     *
     * An array of view decorators to run on the generated HTML.
     *
     * @var list<class-string<ViewDecoratorInterface>>
     */
    public array $decorators = [];
}
