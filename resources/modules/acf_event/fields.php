<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Module name: Events
 *
 * @package Advanced Custom Fields: CDKage Theme
 * @see readme.md for details
 */

/**
 * Register the needed fields for events.
 */
if (function_exists('acf_add_local_field_group')) {
    $acf_module = new FieldsBuilder('event_details', ['title' => __('Event Details', 'sage')]);
    $acf_module
        ->addText('acf_event_start', ['label' => __('Start date', 'sage')])
        ->addText('acf_event_end', ['label' => __('End date', 'sage')])
        ->setLocation('post_type', '==', 'page');
    acf_add_local_field_group($acf_module->build());
}
