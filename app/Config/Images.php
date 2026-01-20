<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Images\Handlers\GDHandler;
use CodeIgniter\Images\Handlers\ImageMagickHandler;

class Images extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Default Image Handler
     * --------------------------------------------------------------------------
     *
     * The name of the image handler to use by default.
     */
    public string $defaultHandler = 'gd';

    /**
     * --------------------------------------------------------------------------
     * Available Image Handlers
     * --------------------------------------------------------------------------
     *
     * The available image handlers.
     *
     * @var array<string, class-string>
     */
    public array $handlers = [
        'gd'      => GDHandler::class,
        'imagick' => ImageMagickHandler::class,
    ];

    /**
     * --------------------------------------------------------------------------
     * Image Library
     * --------------------------------------------------------------------------
     *
     * The library to use for image manipulation.
     * Allowed values: 'gd', 'imagick'
     *
     * @deprecated Use $defaultHandler instead.
     */
    public string $library = 'gd';

    /**
     * --------------------------------------------------------------------------
     * Image Driver
     * --------------------------------------------------------------------------
     *
     * The driver to use for image manipulation.
     * Allowed values: 'gd', 'imagick'
     *
     * @deprecated Use $defaultHandler instead.
     */
    public string $driver = 'gd';

    /**
     * --------------------------------------------------------------------------
     * Image Quality
     * --------------------------------------------------------------------------
     *
     * The default quality for image saving.
     */
    public int $compress = 90;

    /**
     * --------------------------------------------------------------------------
     * Image Magick Path
     * --------------------------------------------------------------------------
     *
     * The path to the ImageMagick executable.
     */
    public string $libraryPath = '/usr/local/bin/convert';
}
