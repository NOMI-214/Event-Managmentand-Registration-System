<?php

namespace Config;

/**
 * --------------------------------------------------------------------------
 * Encryption Configuration
 * --------------------------------------------------------------------------
 *
 * This file contains the configuration for the encryption service.
 *
 * @see \CodeIgniter\Encryption\Encryption
 */
class Encryption extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Encryption Key
     * --------------------------------------------------------------------------
     *
     * The encryption key used by the encryption service.
     *
     * @var string
     */
    public string $key = '';

    /**
     * --------------------------------------------------------------------------
     * Encryption Driver
     * --------------------------------------------------------------------------
     *
     * The driver used by the encryption service.
     *
     * @var string
     */
    public string $driver = 'OpenSSL';

    /**
     * --------------------------------------------------------------------------
     * Bytes to generate
     * --------------------------------------------------------------------------
     *
     * The number of bytes to generate for the encryption key.
     *
     * @var int
     */
    public int $blockSize = 16;

    /**
     * --------------------------------------------------------------------------
     * Digest
     * --------------------------------------------------------------------------
     *
     * The HMAC digest algorithm.
     *
     * @var string
     */
    public string $digest = 'SHA512';
}
