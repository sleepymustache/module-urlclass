<?php
namespace Module\URLclass;

/**
 * Generates a class based on the URL.
 *
 * This way we can target this page with css. Specifically it takes the folder
 * and filename and replaces the directory separator with a hyphen, e.g.
 * *\user\login\* will translate into *user-login-index*. The index added to the
 * end if we are using the default page. *\user\login.php* will translate into
 * *user-login*.
 *
 * @return string The class name
 * @internal
 */
function render() {
	// Get the current URL
	$url = \Sleepy\Hook::addFilter('urlclass_url', htmlspecialchars($_SERVER['REQUEST_URI']));

	// Remove the parameters
	if ($parameters = strlen($url) - (strlen($url) - strpos($url, '?'))) {
		$url = substr($url, 0, $parameters);
	}

	// Remove first slash
	if (strpos($url, '/') == 0) {
		$url = substr($url, 1, strlen($url) - 1);
	}

	// If it doesn't end in php, then add default page
	if (!strpos($url, '.php')) {
		// Add trailing slash
		if (substr($url, -1) !== '/' && strlen($url)) {
			$url .= '/';
		}

		$url = $url . \Sleepy\Hook::addFilter('urlclass_default', 'index');
	} else {
		$url = substr($url, 0, strlen($url) - 4);
	}

	$url = str_replace('/', '-', $url);

	if (empty($url)) {
		$url = \Sleepy\Hook::addFilter('urlclass_default', 'index');
	}

	return \Sleepy\Hook::addFilter('urlclass_class', $url);
}

// Apply SM Hooks
\Sleepy\Hook::applyFilter(
	'render_placeholder_urlclass',
	'\Module\URLclass\render'
);