<?php

namespace App;

use Ultimate_Fields\Container;
use Ultimate_Fields\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Loads modules for the theme.
 *
 * This is just a helper class, if you are here to see how Ultimate Fields/Advanced Custom Fields
 * works, don't focus on it. If you want to build a cdkage module, read it.
 */
class ModuleLoader
{
    /**
     * Holds the definition of every module that is loaded.
     *
     * @var mixed[]
     */
    protected $modules = array();

    /**
     * Saves a flag, which contains disabled modules.
     *
     * @var string[]
     */
    protected $disabled = array();

    /**
     * Creates and returns an instance of the loader.
     *
     * @return ModuleLoader
     */
    public static function getInstance()
    {
        static $instance;

        if (is_null($instance)) {
            $instance = new self;
        }
        return $instance;
    }

    /**
     * Loads all modules from the database.
     */
    private function __construct()
    {
        // If the plugin is not loaded, there is nothing else to load
        if (!class_exists('acf') && !function_exists('ultimate_fields')) {
            return;
        }

        /**
         * Allow additional modules to be registered.
         *
         * @since 3.0
         *
         * @param ModuleLoader $loader The loader to add modules to.
         */
        do_action('cdkage.load_modules', $this);

        // Load enabled modules
        $option = function_exists('get_field') ? get_field('cdkage_modules', 'option') : get_option('cdkage_modules');
        if ($option && is_array($option)) {
            foreach ($option as $id) {
                $path = $this->modules[$id]['path'];
                if (!isset($this->modules[$id]) || !file_exists($path . 'fields.php')) {
                    continue;
                }
                require_once $path . 'fields.php';
            }
        }

        // Add hooks
        add_action('wp_enqueue_scripts', array($this, 'enqueueScriptsAndStyles'), 11);
    }

    /**
     * Adds a module to the theme.
     *
     * @since 3.0
     *
     * @param string $id The ID of the module.
     * @param array $module {
     *     Arguments for the module.
     *
     * @param bool $pro Whether the module requires Advanced Custom Fields Pro/Ultimate Fields Pro
     * @param string $path The path to the module.
     * @param string $url The URL of the module.
     * }
     * @return ModuleLoader The loader
     */
    public function addModule($id, $module)
    {
        if (!isset($module['title'])
            || !isset($module['pro'])
            || !isset($module['path'])
            || !isset($module['url'])
            || !isset($module['redirect'])
        ) {
            wp_die('A module needs the following attributes: title, pro, path, url and redirect!');
        }

        if ($module['pro'] && (!defined('ULTIMATE_FIELDS_PRO') || !ULTIMATE_FIELDS_PRO)) {
            $this->disabled[] = $module['title'];
            return $this;
        }

        $module['path'] = trailingslashit($module['path']);
        $module['url'] = trailingslashit($module['url']);
        $this->modules[$id] = $module;

        return $this;
    }

    /**
     * Enqueue the styles and scripts for each module.
     */
    public function enqueueScriptsAndStyles()
    {
        foreach ($this->modules as $id => $module) {
            if (file_exists($module['path'] . 'module.js')) {
                wp_enqueue_script($id . '-js', $module['url'] . 'module.js', array('jquery'));
            }

            if (file_exists($module['path'] . 'module.css')) {
                wp_enqueue_style($id, $module['url'] . 'module.css');
            }
        }
    }

    /**
     * Add settings to the theme options page.
     *
     * @since 3.0
     *
     * @param ACF/Ultimate_Fields\Options_Page $page The page to control modules.
     * @param ACF/Ultimate_Fields\Type $wcf.
     * @throws \StoutLogic\AcfBuilder\FieldNameCollisionException
     */
    public function registerOptionsContainer($page, $wcf)
    {
        $modules = array();
        $active = $wcf == 'acf' ? get_field('cdkage_modules', 'option') : get_option('cdkage_modules');

        if (!$active) {
            $active = array();
        }

        foreach ($this->modules as $id => $data) {
            $title = $data['title'];

            if (isset($data['redirect']) && in_array($id, $active)) {
                $title .= sprintf(
                    ' [<a href="%s">View</a>]',
                    is_callable($data['redirect'])
                        ? call_user_func($data['redirect'])
                        : $data['redirect']
                );
            }

            if (isset($data['wcf']) && $data['wcf'] == 'uf' && !function_exists('ultimate_fields')) {
                continue;
            } elseif (isset($data['wcf']) && $data['wcf'] == 'acf' && !class_exists('acf')) {
                continue;
            } else {
                $modules[$id] = $title;
            }
        }

        $description = __('Select the modules you want to have enabled as a cdkage.', 'sage');

        if (!empty($this->disabled)) {
            $message = 'Some modules are ignored because they require Advanced Custom Fields Pro/Ultimate Fields Pro';
            $description .= "\n\n" . __($message, 'sage');
        }

        if ($wcf == 'acf') {
            $acf_modules = new FieldsBuilder('cdkage_modules');
            $acf_modules
                ->addMessage('cdkage_modules_description', $description, [
                    'label' => __('Modules', 'sage'),
                    'wrapper' => [
                        'width' => '22%',
                        'id' => 'major-publishing-actions',
                    ],
                    'esc_html' => 0,
                    'new_lines' => 'wpautop'
                ])
                ->addCheckbox('cdkage_modules', [
                    'label' => '',
                    'layout' => 'vertical',
                    'choices' => $modules,
                    'wrapper' => [
                        'width' => '78%'
                    ]
                ])
                ->setLocation('options_page', '==', 'cdkage_options_page');

            acf_add_local_field_group($acf_modules->build());
        } else {
            Container::create('CDKage Modules')
                ->add_location('options', $page)
                ->set_description_position('label')
                ->add_fields(array(
                    Field::create('multiselect', 'cdkage_modules', __('Modules', 'sage'))
                        ->set_description($description)
                        ->set_input_type('checkbox')
                        ->add_options($modules)
                ));
        }
    }

    /**
     * Returns all registered modules.
     *
     * @since 3.0
     *
     * @return array
     */
    public function getModules()
    {
        $partials = array();
        $option = function_exists('get_field') ? get_field('cdkage_modules', 'option') : get_option('cdkage_modules');
        if ($option && is_array($option)) {
            foreach ($option as $id) {
                $path = $this->modules[$id]['path'];
                if (!isset($path) || !file_exists($path . 'partial.blade.php')) {
                    continue;
                }
                $partials[] = basename(str_replace('partial.blade.php', '', $path)) . '.partial';
            }
        }

        return $partials;
    }
}
