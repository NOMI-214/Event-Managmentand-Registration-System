<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Publisher extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Publisher Restrictions
     * --------------------------------------------------------------------------
     *
     * Prevent the Publisher from copying files to these directories.
     */
    public array $restrictions = [
        ROOTPATH,
        APPPATH,
        SYSTEMPATH,
    ];
}
