<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Migrations extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Enable/Disable Migrations
     * --------------------------------------------------------------------------
     *
     * In an environment where you do not want to run migrations, set this to false.
     */
    public bool $enabled = true;

    /**
     * --------------------------------------------------------------------------
     * Migration Table Name
     * --------------------------------------------------------------------------
     *
     * The name of the database table that will store the current migration state.
     */
    public string $table = 'migrations';

    /**
     * --------------------------------------------------------------------------
     * Timestamp Format
     * --------------------------------------------------------------------------
     *
     * The format of the timestamp used in the migration filenames.
     */
    public string $timestampFormat = 'Y-m-d-His_';
}
