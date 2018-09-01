<?php

use Ultimate_Fields\Options_Page;

/**
 * Add a page for theme options and module control.
 */
add_action('uf.init', function () {
    $page = Options_Page::create('theme-options', __('CDKage Options', 'sage'))
        ->set_type('appearance');

    // Expose to other modules
    $GLOBALS['cdkage_options_page'] = $page;

    Module_Loader::get_instance()->register_options_container($page);
});
