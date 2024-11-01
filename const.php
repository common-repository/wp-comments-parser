<?php
define('WPPTC_PATH', plugin_dir_path(__FILE__));
define('WPPTC_URL', plugin_dir_url(__FILE__));

define('WPPTC_INC_PATH', WPPTC_PATH . 'Inc/');
define('WPPTC_INC_URL', WPPTC_URL . 'Inc/');


define('WPPTC_DB_COMMENTS', 'wpptc_db_comments');
define('WPPTC_COUNT_COMMENTS_PAGES', 6);

define('WPPTC_ASSETS_URL', WPPTC_INC_URL . 'assets/');
define('WPPTC_ASSETS_PATH', WPPTC_INC_PATH . 'assets/');

define('WPPTC_ASSETS_ADMIN_URL', WPPTC_ASSETS_URL . 'admin/');
define('WPPTC_ASSETS_ADMIN_PATH', WPPTC_ASSETS_PATH . 'admin/');


define('WPPTC_ASSETS_ADMIN_JS_URL', WPPTC_ASSETS_ADMIN_URL . 'js/');
define('WPPTC_ASSETS_ADMIN_CSS_URL', WPPTC_ASSETS_ADMIN_URL . 'css/');
define('WPPTC_ASSETS_ADMIN_IMAGES_URL', WPPTC_ASSETS_ADMIN_URL . 'img/');

define('WPPTC_ASSETS_FRONTEND_URL', WPPTC_ASSETS_URL . 'frontend/');
define('WPPTC_ASSETS_FRONTEND_JS_URL', WPPTC_ASSETS_FRONTEND_URL . 'js/');
define('WPPTC_ASSETS_FRONTEND_CSS_URL', WPPTC_ASSETS_FRONTEND_URL . 'css/');

define('WPPTC_INIT_PATH', WPPTC_INC_PATH . 'Init/');

define('WPPTC_TEMPLATE_PATH', WPPTC_INC_PATH . 'templates/');
define('WPPTC_T_ADMIN_PATH', WPPTC_TEMPLATE_PATH . 'admin/');
define('WPPTC_T_FRONT_PATH', WPPTC_TEMPLATE_PATH . 'frontend/');

define('WPPTC_CONTROLLERS', WPPTC_INC_PATH . 'Controllers/');

define('WPPTC_INC_DB_PATH', WPPTC_INC_PATH . 'DbClasses/');
