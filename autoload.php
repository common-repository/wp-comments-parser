<?php

spl_autoload_register(function ($class) {
    $classPath = str_replace('WPPTC\\Inc\\', WPPTC_INC_PATH, $class);

    $file = str_replace('\\', DIRECTORY_SEPARATOR, $classPath) . '.php';
    if (file_exists($file)) {
        include_once $file;
    };

    if ($class == 'WP_Widget')
        include_once 'wp-includes/class-wp-widget.php';

    if ($class == 'phpQuery') {
        require_once WPPTC_ASSETS_ADMIN_PATH.'phpquery/phpQuery/phpQuery.php';
    }
}); 