# URLClass Module

* Date:    March 2, 2020
* Author:  Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
* Version: 2.p
* License: http://opensource.org/licenses/MIT

Adds a class to the HTML tag to the "{{ urlClass }}" placeholder allowing you to target pages via CSS using the URL. It replaces spaces and forward slashes with dashes to make it URL friendly. It adds "-index" to the end of the class if the page is the default page in that directory.

## Usage

~~~html
    <html class="{{ urlClass }}">
        ...
    </html>
~~~

## Changelog

### Version 2.0
* Updated

### Version 1.1
* Bugfix: Trailing slashes are now properly converted to dashes