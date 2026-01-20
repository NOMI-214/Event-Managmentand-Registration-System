<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Log\Handlers\FileHandler;

/**
 * --------------------------------------------------------------------------
 * Logging Configuration
 * --------------------------------------------------------------------------
 *
 * This configuration determines how and where log messages are stored.
 */
class Logger extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Error Logging Threshold
     * --------------------------------------------------------------------------
     * You can enable error logging by setting a threshold over zero. The
     * threshold determines what gets logged. Any log level at or below the
     * threshold will be logged.
     *
     * Threshold options are:
     *
     *  0 = Disables logging, Error logging TURNED OFF
     *  1 = Emergency Messages  - System is unusable
     *  2 = Alert Messages      - Action must be taken immediately
     *  3 = Critical Messages   - Application component unavailable, unexpected exception
     *  4 = Error Messages      - Runtime errors that do not require immediate action
     *  5 = Warning Messages    - Exceptional occurrences that are not errors
     *  6 = Notice Messages     - Normal but significant events
     *  7 = Info Messages       - Interesting events, user logs in, SQL logs
     *  8 = Debug Messages      - Detailed debug information
     *  9 = All Messages
     *
     * You can also pass an array with threshold levels to have that level
     * logged only.
     *
     * For a live site you'll usually enable Critical or higher (3) to be logged
     * to prevent sensitive information from being logged.
     */
    public int $threshold = 9;

    /**
     * --------------------------------------------------------------------------
     * Date Format for Logs
     * --------------------------------------------------------------------------
     * Each item that is logged has an associated date. You can use PHP date
     * codes to set your own date formatting
     */
    public string $dateFormat = 'Y-m-d H:i:s';

    /**
     * --------------------------------------------------------------------------
     * Log Handlers
     * --------------------------------------------------------------------------
     * The logging system supports multiple handlers to log messages. The handlers
     * are executed in the order defined in this array.
     *
     * Available handlers:
     *  - FileHandler: Writes log messages to files
     *  - ChromeLoggerHandler: Sends log messages to Chrome Logger extension
     *  - ErrorlogHandler: Writes log messages to PHP's error_log
     *
     * @var array<class-string, array<string, int|list<string>|string>>
     */
    public array $handlers = [
        /*
         * --------------------------------------------------------------------
         * File Handler
         * --------------------------------------------------------------------
         */
        FileHandler::class => [
            /**
             * The log levels that this handler will handle.
             *
             * @var list<string>
             */
            'handles' => [
                'critical',
                'alert',
                'emergency',
                'debug',
                'error',
                'info',
                'notice',
                'warning',
            ],

            /*
             * The default filename extension for log files.
             * An extension of 'php' allows for protecting the log files
             * via basic scripting, when they are to be stored under a publicly
             * accessible directory.
             *
             * Note: Leaving it blank will default to 'log'.
             */
            'fileExtension' => 'log',

            /*
             * The file system permissions to be applied on newly created log files.
             *
             * IMPORTANT: This MUST be an integer (no quotes) and you MUST use octal
             *            integer notation (i.e. 0700, 0644, etc.)
             */
            'filePermissions' => 0644,

            /*
             * Logging Directory Path
             *
             * By default, logs are written to WRITEPATH . 'logs/'
             * Specify a different path if needed.
             */
            'path' => WRITEPATH . 'logs/',
        ],
    ];
}
