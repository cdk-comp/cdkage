<?php
/**
 * Displays a message that Ultimate Fields is needed for the theme.
 */
add_action('admin_notices', function () {
    if (!function_exists('ultimate_fields')) {
        /**
         * Displays a message that Ultimate Fields is needed for the theme.
         */
        $message = __('Please install and activate Ultimate Fields or Ultimate Fields Pro.', 'sage');
        $message = wpautop($message); // wpautop - Replaces double line-breaks with paragraph elements
        printf('<div class="notice notice-error">%s</div>', $message);
    }
});
