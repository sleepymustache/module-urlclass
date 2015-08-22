# HTML Compress Module

* Date:    April 16, 2015
* Author:  Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
* Version: 1.0
* License: http://opensource.org/licenses/MIT

Adds a class to the HTML tag to the "{{ urlClass }}" placeholder allowing you to target pages via CSS using the URL. It replaces spaces and forward slashes with dashes to make it URL friendly. It adds "-index" to the end of the class if the page is the default page in that directory.

## Usage

~~~html
    <html class="{{ urlClass }}">
        ...
    </html>
~~~