<?php
/**
 * URLClass Module
 *
 * The URLClass module adds a class to the placeholder {{ urlclass }} that can be
 * used to uniquely identify a page in css.
 *
 * PHP version 7.0.0
 *
 * @category Module
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */

namespace Module\UrlClass;

use \Sleepy\Core\Hook;
use \Sleepy\Core\Module;

/**
 * The URLClass module
 *
 * @category Module
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */
class UrlClass extends Module
{

    public $hooks = [
        'render_placeholder_urlclass' => 'convert'
    ];

    /**
     * Convert the placeholder into the URLClass
     *
     * @param string $url The current URL
     *
     * @return void
     */
    public function convert($url)
    {
        // Get the current URL
        $url = Hook::addFilter('urlclass_url', $_SERVER['REQUEST_URI']);

        // Remove the parameters
        if ($parameters = strlen($url) - (strlen($url) - strpos($url, '?'))) {
            $url = substr($url, 0, $parameters);
        }

        // Remove first slash
        if (strpos($url, '/') == 0) {
            $url = substr($url, 1, strlen($url) - 1);
        }

        // Slashes become dashes
        $url = str_replace('/', '-', $url);

        // If it doesn't end in php, then add default page
        if (!strpos($url, '.php')) {
            // Add trailing slash
            if (substr($url, -1) !== '-' && strlen($url)) {
                $url .= '-';
            }

            $url = $url . Hook::addFilter('urlclass_default', 'index');
        } else {
            $url = substr($url, 0, strlen($url) - 4);
        }

        if (empty($url)) {
            $url = Hook::addFilter('urlclass_default', 'index');
        }

        // XSS Prevention
        $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);

        return Hook::addFilter('urlclass_class', $url);
    }
}

Hook::register(new UrlClass());
