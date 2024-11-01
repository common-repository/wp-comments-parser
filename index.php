<?php
/*
Plugin Name: WP Comments Parser
Description: Wordpress Plugin for parsing tripadvisor comments
Version: 1.0
Author: hireukraine.me
Author URI: hireukraine.me
*/
/*
    This program is a free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define('WPPTC_PL_FILE', __FILE__);

include_once 'const.php';

require_once 'autoload.php';

function WPPTC() {
    $manager = new WPPTC\Inc\WPPTCManager();
    $manager->init();
}

WPPTC();