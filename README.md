# [CDKage based Sage](https://roots.io/sage/)
[![Packagist](https://img.shields.io/packagist/vpre/cdk-comp/cdkage.svg?style=flat-square)](https://packagist.org/packages/cdk-comp/cdkage)
[![devDependency Status](https://img.shields.io/david/dev/cdk-comp/cdkage.svg?style=flat-square)](https://david-dm.org/cdk-comp/cdkage#info=devDependencies)
[![Build Status](https://img.shields.io/travis/cdk-comp/cdkage.svg?style=flat-square)](https://travis-ci.org/cdk-comp/cdkage)

CDKAGE is a Sage based WordPress starter theme with a modern development workflow.

## Features

* Sass for stylesheets
* Modern JavaScript
* [Webpack](https://webpack.github.io/) for compiling assets, optimizing images, and concatenating and minifying files
* [Browsersync](http://www.browsersync.io/) for synchronized browser testing
* [Blade](https://laravel.com/docs/5.6/blade) as a templating engine
* [Controller](https://github.com/soberwp/controller) for passing data to Blade templates
* [ACF](https://www.advancedcustomfields.com) support with custom modules development
* [ACF Builder](https://github.com/StoutLogic/acf-builder) configuration arrays for Advanced Custom Fields Pro using the builder pattern and a fluent API
* [Ultimate Fields](https://www.ultimate-fields.com/) support with custom modules development

See a working example at [roots-example-project.com](https://roots-example-project.com/).

## Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 4.9.8
* [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields) >= 5.7.6
  or
* [Ultimate Fields](https://wordpress.org/plugins/ultimate-fields) >= 3.0.2
* [PHP](https://secure.php.net/manual/en/install.php) >= 7.1.3 (with [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php) enabled)
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install)

## Theme installation

Install CDKage using Composer from your WordPress themes directory (replace `your-theme-name` below with the name of your theme):

```shell
# @ app/themes/ or wp-content/themes/
$ composer create-project cdk-comp/cdkage your-theme-name
```

To install the latest development version of Sage, add `dev-master` to the end of the command:

```shell
$ composer create-project roots/sage your-theme-name dev-master
```

During theme installation you will have options to update `style.css` theme headers, select a CSS framework, and configure Browsersync.

## Theme structure

```shell
themes/your-theme-name/               # → Root of your Sage based theme
├── app/                              # → Theme PHP
│   ├── Controllers/                  # → Controller files
│   ├── admin.php                     # → Theme customizer setup
│   ├── filters.php                   # → Theme filters
│   ├── helpers.php                   # → Helper functions
│   ├── setup.php                     # → Theme setup
│   ├── wcf-check.php                 # → Check if required plugin's exist
│   ├── wcf-init.php                  # → Init option page for module management
│   ├── wcf-modules.php               # → Module management for ACF/Ultimate fields
│   └── setup.php                     # → Theme setup
├── composer.json                     # → Autoloading for `app/` files
├── composer.lock                     # → Composer lock file (never edit)
├── dist/                             # → Built theme assets (never edit)
├── node_modules/                     # → Node.js packages (never edit)
├── package.json                      # → Node.js dependencies and scripts
├── resources/                        # → Theme assets and templates
│   ├── assets/                       # → Front-end assets
│   │   ├── config.json               # → Settings for compiled assets
│   │   ├── build/                    # → Webpack and ESLint config
│   │   ├── fonts/                    # → Theme fonts
│   │   ├── images/                   # → Theme images
│   │   ├── scripts/                  # → Theme JS
│   │   └── styles/                   # → Theme stylesheets
│   ├── functions.php                 # → Composer autoloader, theme includes
│   ├── index.php                     # → Never manually edit
│   ├── modules/                      # → Module loads and config
│   │   ├── **/fields.php             # → Fields management
│   │   ├── **/partial.blade.php      # → Module template
│   │   ├── **/script.js              # → Module JS
│   │   ├── **/style.scss             # → Module stylesheets
│   │   └── class-module-loader.php   # → Settings for compiled assets
│   ├── screenshot.png                # → Theme screenshot for WP admin
│   ├── style.css                     # → Theme meta information
│   └── views/                        # → Theme templates
│       ├── layouts/                  # → Base templates
│       └── partials/                 # → Partial templates
└── vendor/                           # → Composer packages (never edit)
```

## Theme setup

Edit `app/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

## Theme development

* Run `yarn` from the theme directory to install dependencies
* Update `resources/assets/config.json` settings:
  * `devUrl` should reflect your local development hostname
  * `publicPath` should reflect your WordPress folder structure (`/wp-content/themes/cdkage` for non-[Bedrock](https://roots.io/bedrock/) installs)

### Build commands

* `yarn start` — Compile assets when file changes are made, start Browsersync session
* `yarn build` — Compile and optimize the files in your assets directory
* `yarn build:production` — Compile assets for production

## Documentation

* [Sage documentation](https://roots.io/sage/docs/)
* [Controller documentation](https://github.com/soberwp/controller#usage)
* [Advanced Custom Fields](https://www.advancedcustomfields.com/resources/)
* [ACF Builder](https://github.com/StoutLogic/acf-builder/wiki)
* [Ultimate Fields](http://ultimate-fields.com/docs/)

## Contributing

Contributions are welcome from everyone.

## CDKage sponsors

Help support our open-source development efforts by:

* Buy a [hosting](http://bit.ly/do_cdk) (and receive $10 credit!)
* [PayPal donate](https://www.paypal.me/cdkdev)
* Buy me a [coffee](https://www.buymeacoffee.com/cdk)

## Community

* Participate on the [Telegram](https://t.me/dimaminka)

TODO
==========
- [ ] Make example project with cdk-comp/bedrock and vagrant-easyengine
- [ ] Update dependencies for Node.js
- [ ] Make ACF builder module
- [ ] Include showcase screencast about a CDKage

