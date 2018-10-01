<?php

use Ultimate_Fields\Options_Page;

/**
 * Add a page for theme options and module control.
 */
if (function_exists('acf_add_options_page')) {
    add_action('acf/init', function () {
        acf_add_options_page(array(
            'page_title' => __('CDKage Options', 'sage'),
            'menu_slug' => 'cdkage_options_page',
            'parent_slug' => 'themes.php'
        ));

        App\ModuleLoader::getInstance()->registerOptionsContainer('', 'acf');
    });
} else {
    add_action('uf.init', function () {
        $page = Options_Page::create('theme-options', __('CDKage Options', 'sage'))
            ->set_type('appearance');

        // Expose to other modules
        $GLOBALS['cdkage_options_page'] = $page;

        App\ModuleLoader::getInstance()->registerOptionsContainer($page, 'uf');
    });
}
