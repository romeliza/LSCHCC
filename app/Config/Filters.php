<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>>
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'auth' => \App\Filters\AuthFilter::class,
        'NoAuthFilter' => \App\Filters\NoAuthFilter::class,
     
    ];

    /**
     * List of special required filters.
     *
     * Filters set by default provide framework functionality.
     *
     * @var array{before: list<string>, after: list<string>}
     */
    public array $required = [
        'before' => [
            // Optional: 'forcehttps', // Uncomment if needed for global HTTPS
        ],
        'after' => [
            // Optional filters can be placed here
            'toolbar',
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            // Optional global filters such as 'csrf' or 'honeypot'
        ],
        'after' => [
            // Optional: 'secureheaders',
            'toolbar',
        ],
    ];

    /**
     * List of filter aliases that work on specific HTTP methods (GET, POST, etc.).
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on specific URI patterns.
     *
     * Example: 'auth' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [];
}
