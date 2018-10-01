<?php
/**
 * Displays a message that Advance Custom Fields/Ultimate Fields is needed for the theme.
 */
add_action('admin_notices', function () {
    if (!function_exists('ultimate_fields') && !class_exists('acf')) {
        $message = __('Please install and activate Advance Custom Fields/Ultimate Fields.', 'sage');
        $message = wpautop($message); // wpautop - Replaces double line-breaks with paragraph elements
        printf('<div class="notice notice-error">%s</div>', $message);
    }
});
