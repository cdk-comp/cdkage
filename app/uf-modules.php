<?php

/**
 * Setup the theme and load modules.
 */
add_action('after_setup_theme', function () {
    // Include the module loader and initialize it
    require_once __DIR__ . '/../resources/modules/class-module-loader.php';
    Module_Loader::get_instance();
});

/**
 * Loads all built-in modules.
 *
 * @param Module_Loader $loader A loader that includes modules.
 */
add_action('cdkage.load_modules', function ($loader) {
    $loader->add_module('uf_builder', array(
        'title' => __('Builder', 'sage'),
        'pro' => false,
        'path' => __DIR__ . '/../resources/modules/uf_builder',
        'url' => get_template_directory_uri() . '/modules/uf_builder',
        'redirect' => admin_url('post.php?post=2&action=edit')
    ));

    $loader->add_module('event', array(
        'title' => __('Event', 'sage'),
        'pro' => false,
        'path' => __DIR__ . '/../resources/modules/event',
        'url' => get_template_directory_uri() . '/modules/event',
        'redirect' => admin_url('post.php?post=2&action=edit')
    ));
});
