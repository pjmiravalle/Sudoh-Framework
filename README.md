[Sudoh Framework](https://github.com/Sudoh/Sudoh-Framework)
===============

Version 0.1 : WordPress 3.7.1 stable.

Sudoh is a lightweight theming framework that ties all the goodness of [Foundation 4](http://foundation.zurb.com/) and [HTML5 Boilerplate](http://html5boilerplate.com/) with WordPress.

Please note that this framework is very early in development, and there will likely be bugs and quirks. If you happen to come across any said issues, please submit an Issue in GitHub and we'll try to iron it out as soon as we can. Thanks!

## Installation
1. Clone our repo `git clone git@github.com:Sudoh/Sudoh-Framework.git`, or get the ZIP [here](https://github.com/Sudoh/Sudoh-Framework/archive/master.zip). Once downloaded, rename the folder to the name of your theme.
* Install and activate the latest version of [Option Tree](http://wordpress.org/plugins/option-tree/).
* Configure default settings for your site in the `functions.php` file.
* Activate your theme.

## Grunt Setup
Our framework has [Grunt](http://gruntjs.com/) support! Install Grunt [here](http://gruntjs.com/getting-started), and then run `npm install` in your command line from within your theme directory. Once all Grunt dependencies have been installed, run `grunt watch`. This will tell Grunt to watch for updates to your SCSS and JS files and it will automatically re-build as you write your code.  

## Documentation
Coming soon..

## Features
* Foundation 4.3.2
* HTML5 Boilerplate
* Developer friendly
* Organized architecture
* Relative URLs
* Theme assets mapped to site root (`/assets/*`)
* WordPress cleanup
* Option Tree integration
* Post type helper class
* Metabox helper class
* Widget helper class
* Compass support
* Grunt build script

## Recommended Plugins
* [Option Tree](http://wordpress.org/plugins/option-tree/)
* [W3 Total Cache](http://wordpress.org/plugins/w3-total-cache/)
* [WordPress SEO](http://wordpress.org/plugins/wordpress-seo/)
* [Regenerate Thumbnails](http://wordpress.org/plugins/regenerate-thumbnails/)
