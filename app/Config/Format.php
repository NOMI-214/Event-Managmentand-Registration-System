<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Format extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Available Request Formats
     * --------------------------------------------------------------------------
     *
     * A list of all of the formats that the Request class will be able to
     * automatically detect.
     *
     * @var array<string, strin>
     */
    public array $supportedResponseFormats = [
        'application/json',
        'application/xml', // machine-readable XML
        'text/xml', // human-readable XML
    ];

    /**
     * --------------------------------------------------------------------------
     * Formatters
     * --------------------------------------------------------------------------
     *
     * Lists the class to use to format the response for a given type.
     *
     * @var array<string, string>
     */
    public array $formatters = [
        'application/json' => \CodeIgniter\Format\JSONFormatter::class,
        'application/xml'  => \CodeIgniter\Format\XMLFormatter::class,
        'text/xml'         => \CodeIgniter\Format\XMLFormatter::class,
    ];

    /**
     * --------------------------------------------------------------------------
     * Formatters Options
     * --------------------------------------------------------------------------
     *
     * Additional options to pass to the formatters.
     *
     * @var array<string, mixed>
     */
    public array $formatterOptions = [
        'application/json' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        'application/xml'  => 0,
        'text/xml'         => 0,
    ];
}
