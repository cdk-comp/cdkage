<?php
use Ultimate_Fields\Container\Repeater_Group;
use Ultimate_Fields\Field;

/**
 * Module name: key
 *
 * @package Ultimate Fields: CDKage Theme
 * @see readme.md for details
 */

$uf_module = Repeater_Group::create( 'key' )
    ->set_title( __( 'key' ) )
    ->set_icon( 'dashicons dashicons-admin-settings' )
    ->add_fields(array(
        Field::create( 'text', 'key' )
    ));

$uf_modules->add_group($uf_module);
