<?php

namespace Config;

use CodeIgniter\Cache\Handlers\FileHandler;
use CodeIgniter\Config\BaseConfig;

/**
 * --------------------------------------------------------------------------
 * Cache Configuration
 * --------------------------------------------------------------------------
 *
 * This configuration determines how and where items are cached.
 */
class Cache extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Primary Handler
     * --------------------------------------------------------------------------
     *
     * The name of the preferred handler that should be used. If for some reason
     * it is not available, the $backupHandler will be used in its place.
     */
    public string $handler = 'file';

    /**
     * --------------------------------------------------------------------------
     * Backup Handler
     * --------------------------------------------------------------------------
     *
     * The name of the handler that will be used in case the first one is
     * unreachable. Often, 'dummy' is the lucky winner.
     */
    public string $backupHandler = 'dummy';

    /**
     * --------------------------------------------------------------------------
     * Cache Directory Path
     * --------------------------------------------------------------------------
     *
     * The path to where the file cache is stored.
     */
    public string $storePath = WRITEPATH . 'cache/';

    /**
     * --------------------------------------------------------------------------
     * Cache Include Query String
     * --------------------------------------------------------------------------
     *
     * Whether to take the URL query string into consideration when generating
     * output cache files. Valid options are:
     *
     *  false      = Disabled
     *  true       = Enabled, take all query parameters into account.
     *               Please be aware that this may result in numerous cache
     *               files generated for the same page over and over again.
     *  array('q') = Enabled, but only take into account the specified list
     *               of query parameters.
     */
    public bool|array $cacheQueryString = false;

    /**
     * --------------------------------------------------------------------------
     * Key Prefix
     * --------------------------------------------------------------------------
     *
     * This string is added to all cache item names to help avoid collisions
     * with other applications using the same cache.
     */
    public string $prefix = '';

    /**
     * --------------------------------------------------------------------------
     * Reserved Characters
     * --------------------------------------------------------------------------
     *
     * Character list associated with key prefix, to be used as a check.
     */
    public string $reservedCharacters = '{}()/\@:';


    /**
     * --------------------------------------------------------------------------
     * TTL for specific Cache Handlers
     * --------------------------------------------------------------------------
     *
     * The Time-To-Live for specific handlers.
     *
     * @var array<string, int>
     */
    public array $ttl = [
        'file'      => 60,
        'redis'     => 60,
        'memcached' => 60,
    ];

    /**
     * --------------------------------------------------------------------------
     * File settings
     * --------------------------------------------------------------------------
     */
    public array $file = [
        'storePath' => WRITEPATH . 'cache/',
        'mode'      => 0640,
    ];

    /**
     * --------------------------------------------------------------------------
     * Memcached settings
     * --------------------------------------------------------------------------
     */
    public array $memcached = [
        'host'   => '127.0.0.1',
        'port'   => 11211,
        'weight' => 1,
        'raw'    => false,
    ];

    /**
     * --------------------------------------------------------------------------
     * Redis settings
     * --------------------------------------------------------------------------
     */
    public array $redis = [
        'host'     => '127.0.0.1',
        'password' => null,
        'port'     => 6379,
        'timeout'  => 0,
        'database' => 0,
    ];

    /**
     * --------------------------------------------------------------------------
     * Available Cache Handlers
     * --------------------------------------------------------------------------
     *
     * This is an array of the class names of all available cache handlers.
     *
     * @var array<string, class-string>
     */
    public array $validHandlers = [
        'dummy'     => \CodeIgniter\Cache\Handlers\DummyHandler::class,
        'file'      => \CodeIgniter\Cache\Handlers\FileHandler::class,
        'memcached' => \CodeIgniter\Cache\Handlers\MemcachedHandler::class,
        'predis'    => \CodeIgniter\Cache\Handlers\PredisHandler::class,
        'redis'     => \CodeIgniter\Cache\Handlers\RedisHandler::class,
        'wincache'  => \CodeIgniter\Cache\Handlers\WincacheHandler::class,
    ];
}
