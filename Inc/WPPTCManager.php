<?php

namespace WPPTC\Inc;

use WPPTC\Inc\Classes\WPPTCInitWidget;
use WPPTC\Inc\DbClasses\WPPTCCommonDbClass;
use WPPTC\Inc\Classes\WPPTCShortcode;

use WPPTC\Inc\Classes\WPPTCParser;

/**
 * Class WPPTCManager
 * @package WPPTC\Inc
 * Init scripts
 */
class WPPTCManager
{
    private $WPPTCInitWidget;

    public $pretext;
    public $Parser;

    public function __construct()
    {
        $this->initWidget();
        $this->activation();
        $this->initFrontendHooks();
    }

    private function activation()
    {
        register_activation_hook(WPPTC_PL_FILE, array('WPPTC\Inc\WPPTCManager', 'createTables'));
//        register_deactivation_hook(WPPTC_PL_FILE, array('WPPTC\Inc\WPPTCManager', 'dropTables'));
        register_uninstall_hook(WPPTC_PL_FILE, array('WPPTC\Inc\WPPTCManager', 'dropTables'));
    }

    private function initWidget()
    {
        add_action('widgets_init', [$this, 'registerWidget']);
    }

    public function registerWidget()
    {
        $this->WPPTCInitWidget = new WPPTCInitWidget();
        register_widget($this->WPPTCInitWidget);
    }

    public function initFrontendHooks()
    {
        add_shortcode('hireukraine_shortCodeParser', [$this, 'shortCodeParser']);
    }
    
    public function shortCodeParser()
    {
        $controller = new WPPTCShortcode;
        return $controller->exec();
    }

    public function createTables()
    {
        $db = new WPPTCCommonDbClass();
        return $db->createTables();
    }

    public function dropTables()
    {
        $db = new WPPTCCommonDbClass();
        return $db->dropTables();
    }

    public function init()
    {
        add_action('admin_menu', [$this, 'parserPage']);
        add_action('admin_init', [$this, 'themeSettings']);
        $this->Parser = new WPPTCParser();
//        add_action('admin_enqueue_scripts', [$this, 'initStylesAdmin']);
        add_action('admin_enqueue_scripts', [$this, 'initScriptsAdmin']);
        add_action('wp_enqueue_scripts', [$this, 'initScriptsFrontend']);
        add_action('wp_enqueue_scripts', [$this, 'initStylesFrontend']);
        add_action('plugins_loaded', [$this, 'loadPluginTextdomain']);
    }


    public function initScriptsAdmin()
    {
        wp_register_script('WPPTC-script', WPPTC_ASSETS_ADMIN_JS_URL . 'scripts.js', array(), '1.0.0', true);
        wp_enqueue_script('WPPTC-script');
    }

    public function initStylesAdmin()
    {

    }

    public function initScriptsFrontend()
    {
        wp_register_script('WPPTC-frontend-script', WPPTC_ASSETS_FRONTEND_JS_URL . 'frontend-scripts.js', array(), '1.0.0', true);
        wp_enqueue_script('WPPTC-frontend-script');
    }

    public function initStylesFrontend()
    {
        wp_enqueue_style('WPPTC-frontend-styles', WPPTC_ASSETS_FRONTEND_CSS_URL . 'WPPTC-frontend.css', false, '1.0.0');
        wp_enqueue_style('WPPTC-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false, '1.0.0');
    }

    public function parserPage()
    {
        add_menu_page(__('Parser options'.'WPPTC'), __('CommentsParser', 'WPPTC'), 'manage_options', 'parser-theme-settings', '', 'dashicons-menu', 101);
        add_submenu_page('parser-theme-settings', __('Settings','WPPTC'), 'Parserpage', 'manage_options', 'parser-theme-settings', [$this, 'settings']);
    }

    public function settings()
    {
        require(WPPTC_T_ADMIN_PATH . 'admin_settings.php');
    }

    public function themeSettings()
    {
        $defaults = array('sanitize_callback' => [$this, 'sanitizeCallbackUrl']);
        register_setting('homepage-option-group', 'WPPTCShortCode', $defaults);
        add_settings_section('theme-index-options', __('Parser comments with tripadvisor', 'WPPTC'), '', 'parser-theme-settings');
        add_settings_field('WPPTCShortCode-text', __('Site URL','WPPTC'), [$this, 'shortCodeCallback'], 'parser-theme-settings', 'theme-index-options');
    }

    public function shortCodeCallback()
    {
        $this->pretext = esc_attr(get_option('WPPTCShortCode'));
        echo '<input type="text" size="130" name="WPPTCShortCode" placeholder="text" value="' . $this->pretext . '">';
    }

    public function sanitizeCallbackUrl($arra)
    {
        $this->Parser->urlResponse($arra);
        return $arra;
    }

    public function loadPluginTextdomain() {
        load_plugin_textdomain('WPPTC', false, dirname(plugin_basename(WPPTC_PL_FILE)).'/Inc/languages/');
    }

}
