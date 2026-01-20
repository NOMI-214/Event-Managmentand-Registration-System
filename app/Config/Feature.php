<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Feature extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Enable Multiple Filters
     * --------------------------------------------------------------------------
     *
     * If true, multiple filters can be applied to a single route.
     *
     * @var bool
     */
    public bool $multipleFilters = false;

    /**
     * --------------------------------------------------------------------------
     * Auto Routes Improved
     * --------------------------------------------------------------------------
     *
     * If true, checks the AutoRouterImproved class for a match.
     *
     * @var bool
     */
    public bool $autoRoutesImproved = false;
}
