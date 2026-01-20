<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use DateTimeInterface;

class Cookie extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Cookie Prefix
     * --------------------------------------------------------------------------
     *
     * Set a cookie name prefix to avoid collisions.
     */
    public string $prefix = '';

    /**
     * --------------------------------------------------------------------------
     * Cookie Expires
     * --------------------------------------------------------------------------
     *
     * The default expiration time for cookies.
     */
    public DateTimeInterface|int|string $expires = 0;

    /**
     * --------------------------------------------------------------------------
     * Cookie Path
     * --------------------------------------------------------------------------
     *
     * The path for which the cookie is available.
     */
    public string $path = '/';

    /**
     * --------------------------------------------------------------------------
     * Cookie Domain
     * --------------------------------------------------------------------------
     *
     * The domain for which the cookie is available.
     */
    public string $domain = '';

    /**
     * --------------------------------------------------------------------------
     * Cookie Secure
     * --------------------------------------------------------------------------
     *
     * If true, the cookie will only be set if the connection is secure.
     */
    public bool $secure = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie HTTP Only
     * --------------------------------------------------------------------------
     *
     * If true, the cookie will be accessible only through the HTTP protocol.
     */
    public bool $httponly = true;

    /**
     * --------------------------------------------------------------------------
     * Cookie SameSite
     * --------------------------------------------------------------------------
     *
     * The SameSite attribute controls when cookies are sent.
     * Allowed values: 'Lax', 'Strict', 'None', or empty string.
     */
    public string $samesite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Cookie Raw
     * --------------------------------------------------------------------------
     *
     * If true, the cookie value will not be URL encoded.
     */
    public bool $raw = false;
}
