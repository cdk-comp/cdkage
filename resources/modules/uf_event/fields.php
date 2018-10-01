<?php

use Ultimate_Fields\Container;
use Ultimate_Fields\Field;

/**
 * Module name: Events
 *
 * @package Ultimate Fields: CDKage Theme
 * @see readme.md for details
 */

/**
 * Register the needed fields for events.
 */
add_action('uf.init', function () {
    Container::create(__('Event Details', 'sage'))
        ->add_location('post_type', 'page')
        ->set_layout('grid')
        ->add_fields(array(
            Field::create('text', 'event_start', __('Start date', 'sage')),
            Field::create('text', 'event_end', __('End date', 'sage'))
        ));
});
