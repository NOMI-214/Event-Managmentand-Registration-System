<?php

namespace Config;

class Optimize
{
    /**
     * --------------------------------------------------------------------------
     * Config Caching Enabled
     * --------------------------------------------------------------------------
     *
     * If true, the config classes will be cached and reused.
     */
    public bool $configCacheEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * Locator Caching Enabled
     * --------------------------------------------------------------------------
     *
     * If true, the Locator will cache the results of file searches.
     */
    public bool $locatorCacheEnabled = false;
}
