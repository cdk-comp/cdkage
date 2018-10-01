<?php

use Ultimate_Fields\Container;
use Ultimate_Fields\Field;

/**
 * Module name: Builder
 *
 * @package Ultimate Fields: CDKage Theme
 * @see readme.md for details
 */
/**
 * Add the necessary fields for the builder.
 */
add_action('uf.init', function () {
    // Preparation
    $uf_modules = Field::create('repeater', 'uf_modules');
    Container::create('builder')
        ->add_location('post_type', 'page')
        ->add_fields(array(
            $uf_modules->hide_label()
        ));

    // get all sub-uf_modules
    $dirs = array_filter(glob(__DIR__ . '/*'), 'is_dir');
    foreach ($dirs as $file) {
        // import fields
        $module_fields = $file . '/fields.php';
        if (file_exists($module_fields)) {
            require_once($module_fields);
        }
    }
});
