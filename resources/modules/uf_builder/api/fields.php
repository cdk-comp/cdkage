<?php

use Ultimate_Fields\Container\Repeater_Group;
use Ultimate_Fields\Field;

/**
 * Module name: api
 *
 * @package Ultimate Fields: CDKage Theme
 * @see readme.md for details
 */

$uf_module = Repeater_Group::create('api')
    ->set_title(__('api'))
    ->set_icon('dashicons dashicons-admin-settings')
    ->add_fields(array(
        Field::create('text', 'api')
    ));

$uf_modules->add_group($uf_module);
