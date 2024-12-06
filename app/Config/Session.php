<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\BaseHandler;
use CodeIgniter\Session\Handlers\FileHandler;

class Session extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Session Driver
     * --------------------------------------------------------------------------
     *
     * The session storage driver to use:
     * - `CodeIgniter\Session\Handlers\FileHandler`
     * - `CodeIgniter\Session\Handlers\DatabaseHandler`
     * - `CodeIgniter\Session\Handlers\MemcachedHandler`
     * - `CodeIgniter\Session\Handlers\RedisHandler`
     *
     * @var class-string<BaseHandler>
     */
    public string $driver = FileHandler::class;

    /**
     * --------------------------------------------------------------------------
     * Session Cookie Name
     * --------------------------------------------------------------------------
     *
     * The session cookie name, must contain only [0-9a-z_-] characters.
     */
    public string $cookieName = 'ci_session';

    /**
     * --------------------------------------------------------------------------
     * Session Expiration
     * --------------------------------------------------------------------------
     *
     * The number of SECONDS you want the session to last.
     * Setting to 0 (zero) means expire when the browser is closed.
     */
    public int $expiration = 7200; // 2 hours, adjust as needed for your application

    /**
     * --------------------------------------------------------------------------
     * Session Save Path
     * --------------------------------------------------------------------------
     *
     * The location to save sessions to and is driver dependent.
     * For the 'files' driver, it's a path to a writable directory.
     * WARNING: Only absolute paths are supported!
     * IMPORTANT: You are REQUIRED to set a valid save path!
     */
    public string $savePath = WRITEPATH . 'session';

    /**
     * --------------------------------------------------------------------------
     * Session Match IP
     * --------------------------------------------------------------------------
     *
     * Whether to match the user's IP address when reading the session data.
     * Set to TRUE for increased security in environments where IP changes are rare.
     */
    public bool $matchIP = true; // Consider changing to true if applicable

    /**
     * --------------------------------------------------------------------------
     * Session Time to Update
     * --------------------------------------------------------------------------
     *
     * How many seconds between CI regenerating the session ID.
     * Recommended: 300 seconds (5 minutes) or lower for increased security.
     */
    public int $timeToUpdate = 300;

    /**
     * --------------------------------------------------------------------------
     * Session Regenerate Destroy
     * --------------------------------------------------------------------------
     *
     * Whether to destroy session data associated with the old session ID
     * when auto-regenerating the session ID. Setting to TRUE improves security.
     */
    public bool $regenerateDestroy = true; // Change to true for better security

    /**
     * --------------------------------------------------------------------------
     * Session Database Group
     * --------------------------------------------------------------------------
     *
     * DB Group for the database session.
     * Set if using the database driver.
     */
    public ?string $DBGroup = null;

    /**
     * --------------------------------------------------------------------------
     * Session Secure Cookie
     * --------------------------------------------------------------------------
     *
     * Whether to set the Secure flag on cookies.
     * This will ensure that cookies are sent over HTTPS only.
     */
    public bool $secure = true; // Set to true if using HTTPS

    /**
     * --------------------------------------------------------------------------
     * Session HttpOnly
     * --------------------------------------------------------------------------
     *
     * Whether to set the HttpOnly flag on cookies.
     * This will prevent JavaScript access to session cookies.
     */
    public bool $httpOnly = true; // Set to true to enhance security

    /**
     * --------------------------------------------------------------------------
     * Lock Retry Interval (microseconds)
     * --------------------------------------------------------------------------
     *
     * This is used for RedisHandler.
     * Time (microseconds) to wait if lock cannot be acquired.
     * The default is 100,000 microseconds (= 0.1 seconds).
     */
    public int $lockRetryInterval = 100_000;

    /**
     * --------------------------------------------------------------------------
     * Lock Max Retries
     * --------------------------------------------------------------------------
     *
     * This is used for RedisHandler.
     * Maximum number of lock acquisition attempts.
     * The default is 300 times. That is lock timeout is about 30 (0.1 * 300)
     * seconds.
     */
    public int $lockMaxRetries = 300;
}
