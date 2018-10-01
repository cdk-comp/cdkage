<?php

/**
 * Setup the theme and load modules.
 */
add_action('after_setup_theme', function () {
    // Include the module loader and initialize it
    require_once __DIR__ . '/../resources/modules/class-module-loader.php';
    App\ModuleLoader::getInstance();
});

/**
 * Loads all built-in modules.
 *
 * @param ModuleLoader $loader A loader that includes modules.
 */
add_action('cdkage.load_modules', function ($loader) {
    $loader->addModule('uf_builder', array(
        'title' => __('Builder for uf', 'sage'),
        'pro' => false,
        'wcf' => 'uf',
        'path' => __DIR__ . '/../resources/modules/uf_builder',
        'url' => get_template_directory_uri() . '/modules/uf_builder',
        'redirect' => admin_url('post.php?post=2&action=edit')
    ));

    $loader->addModule('uf_event', array(
        'title' => __('Event for uf', 'sage'),
        'pro' => false,
        'wcf' => 'uf',
        'path' => __DIR__ . '/../resources/modules/uf_event',
        'url' => get_template_directory_uri() . '/modules/uf_event',
        'redirect' => admin_url('post.php?post=2&action=edit')
    ));

    $loader->addModule('acf_event', array(
        'title' => __('Event for acf', 'sage'),
        'pro' => false,
        'wcf' => 'acf',
        'path' => __DIR__ . '/../resources/modules/acf_event',
        'url' => get_template_directory_uri() . '/modules/acf_event',
        'redirect' => admin_url('post.php?post=2&action=edit')
    ));
});
