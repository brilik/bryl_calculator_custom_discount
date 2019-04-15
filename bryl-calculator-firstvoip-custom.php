<?php

/**
 * Plugin Name: Calculator FirstVoip Custom
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Example uses plugin shortcode: [Calculator title="Totals Without" select="1:0,2:0,3:15,4:35,5:55,6:65,7:75,8:75,9:75,10+:75" price="10.00"]
 * Version: 1.0
 * Author: Vitalii Bryl
 * Author URI: mailto:megabrilik@gmail.com
 * License: A "Calculator FirstVoip Custom" license name e.g. GPL2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: bryl-calculator-firstvoip-custom
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Invalid request.' );
}

include_once "assets/classes/Calculator.php";

$calc = new Calculator();

add_action( 'wp_head', 'my_header_scripts' );
function my_header_scripts(){
    ?>
    <link rel="stylesheet" type="text/css" href="<?=plugin_dir_url( __FILE__ );?>assets/css/style.css" />
    <script src="<?=plugin_dir_url( __FILE__ );?>assets/js/jquery-3.4.0.min.js"></script>
    <script src="<?=plugin_dir_url( __FILE__ );?>assets/js/main.js"></script>
    <?php
}