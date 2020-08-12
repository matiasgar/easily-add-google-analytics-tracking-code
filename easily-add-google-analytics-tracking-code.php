<?php
/**
 * @package EagatcPlugin
 */

/*
Plugin Name: Easily Add Google Analytics Tracking Code
Plugin URI:  https://matiasgarrido.com/
Description: This plugin allows you to easily add your Google Analytics tracking code to your website
Version: 	1.0
Author:  	Matias Garrido
Author URI:  https://matiasgarrido.com/
License: 	GNU GPL 2+

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this plugin. You can also find the license here:
https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
*/

// Security condition
if ( ! defined( 'ABSPATH' ) ) {
  die;
}

if( $_POST['action'] == "call_this"){
      update_option('eagatc_trackingcode',"");
      exit;
}

// Registering setting + creating setting section + creating setting field

function eagatc_admin_init() {
  // Registering the setting
  $setting_group = 'eagatc';
  $setting_name = 'eagatc_trackingcode';
  register_setting(
    $setting_group,
    $setting_name,
    'eagatc_trackingcode_validate_and_sanitize'
  );
  // Creating the setting's section
  $setting_section = 'eagatc_main';
  $setting_page = $setting_group;
  add_settings_section(
    $setting_section,
    '', // We don't need section title so we leave it empty
    '', // We don't need callback function so we leave it empty
    $setting_page
  );
  // Creating setting's field
  $setting_field = $setting_name;
  add_settings_field (
      $setting_field,
      '', //We don't need a label for the field so we leave it empty
      'eagatc_field_markup',
      'eagatc',
      'eagatc_main'
  );
}
add_action( 'admin_init', 'eagatc_admin_init' );


// Funtion that validates the setting
function eagatc_trackingcode_validate_and_sanitize( $input) {
  $re = '/UA-\d{4,9}-\d{1,4}/i';
  if ( empty( $input) ) {
    add_settings_error(
      'eagatc_trackingcode',
      'pi-error-message',
      'Paste your code inside the box before clicking the button',
      'error'
    );
    return FALSE;
  }

  if ( strlen( $input ) > 1500 || preg_match( $re, $input ) !== 1 ) {
    add_settings_error(
      'eagatc_trackingcode',
      'pi-error-message2',
      'Oops, that didn\'t look like a valid tracking code. If you don\'t know what a tracking code is and where you can get yours, read <a href="http://blog.analytics-toolkit.com/2016/google-analytics-tracking-code-id-check-setup/" target="_blank">this guide</a>.',
      'error'
    );
    return FALSE;
  }

  return $input;
}


  // if ( $validated === "a@a.com" ) {
  //       add_settings_error(
  //         'eagatc_trackingcode',
  //         'pi-error-message',
  //         'Invalid Email',
  //         'error'
  //       );
  // } elseif ( $validated === "a@a.com" ){
  //   add_settings_error(
  //     'eagatc_trackingcode',
  //     'pi-error-message2',
  //     'aa Email',
  //     'error'
  //   );
  // }


// Function that validates the setting
// function eagatc_trackingcode_validate_and_sanitize( $input ) {
//   if ( empty( $input) ) {
//     add_settings_error(
//       'eagatc_trackingcode',
//       'pi-error-message',
//       'Paste your code inside the box before clicking the button',
//       'error'
//     );
//   } elseif ($input === 12 ) {
//       add_settings_error(
//         'eagatc_trackingcode',
//         'pi-error-message2',
//         'Pasteee',
//         'error'
//       );
//     }
//   return $input;
//   }


  //   $re = '/UA-\d\d\d\d\d\d\d\d\d-\d/m';
  //   function eagatc_is_valid_tracking_code($string) {
  //       if ( ( preg_match( $re, $string ) === 1 ) && ( strlen($string ) <= 1500 ) ) {
  //         return TRUE;
  //       } else {
  //         return FALSE;
  //       }
  //   }
  //
  //   if ( eagatc_is_valid_tracking_code( $input ) ) {
  //     add_settings_error(
  //       'eagatc_trackingcode',
  //       'pi-error-message2',
  //       'Oops that doesn\'t look like a valid tracking code',
  //       'error'
  //     );
  //   }
  //
  //
  //
  //
  //
  //
  //
  // }





  /* else {
    add_settings_error(
      'eagatc_trackingcode',
      'pi-success-message',
      'Your Google Analytics tracking code was added to your website and is correctly set up.<br /><br />Yes, easily is that easily!',
      'success'
    );
  } */

  // $validated = sanitize_email( $input );
  //
  // if ( $validated !== $input ) {
  //       add_settings_error(
  //         'eagatc_trackingcode',
  //         'pi-error-message',
  //         'Email was invaalid but we sanitized it bitch',
  //         'error'
  //       );
  // } else {
  //   add_settings_error(
  //     'eagatc_trackingcode',
  //     'pi-success-message',
  //     'Your Google Analytics code was added.<br /><br />Easily is that easily!',
  //     'success'
  //   );
  // }
  // return $validated;
// }






// Function that renders the markup for that field
function eagatc_field_markup() {
  echo '<textarea name="eagatc_trackingcode" id="eagatc_trackingcode">' . get_option('eagatc_trackingcode') . '</textarea>';
}

// Add settings page to the WordPress Admin dashboard
function eagatc_add_page_to_admin() {
  $svg = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="1220.000000pt" height="1280.000000pt" viewBox="0 0 1220.000000 1280.000000"
 preserveAspectRatio="xMidYMid meet">
<metadata>
Created by potrace 1.15, written by Peter Selinger 2001-2017
</metadata>
<g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)"
fill="#ffffff" stroke="none">
<path d="M6130 12794 c-1416 -68 -2602 -473 -3610 -1234 -756 -571 -1413
-1357 -1831 -2192 -385 -770 -594 -1551 -671 -2513 -19 -244 -16 -887 5 -1110
100 -1029 409 -1900 977 -2750 488 -730 1213 -1451 1965 -1952 890 -594 1812
-920 2885 -1020 229 -21 891 -24 1135 -5 1123 88 1991 330 3000 834 570 285
1016 559 1634 1001 146 104 268 191 270 193 2 2 -2038 3045 -2054 3062 -2 2
-124 -77 -272 -175 -685 -457 -1103 -690 -1610 -897 -494 -201 -931 -302
-1417 -326 -528 -26 -899 58 -1281 290 -101 61 -296 202 -293 211 2 5 1630
1045 3618 2312 l3615 2304 3 91 3 92 -95 187 c-750 1482 -1778 2518 -3064
3087 -618 273 -1227 425 -1972 492 -156 14 -775 26 -940 18z m608 -3559 c129
-25 244 -61 355 -112 112 -51 277 -142 276 -152 0 -3 -84 -56 -187 -117 -103
-61 -900 -539 -1771 -1063 l-1584 -952 7 58 c8 72 50 260 82 372 43 146 93
271 179 446 269 550 736 1028 1256 1291 250 125 590 218 904 244 139 12 384 4
483 -15z"/>
</g>
</svg>';

  $goodsvg = 'data:image/svg+xml;base64,' . base64_encode( $svg );

  add_menu_page(
    'Easily Add Google Analytics Tracking Code',
    'Easily Plugin',
    'manage_options',
    'easily-eagatc',
    'eagatc_page_markup',
    $goodsvg
  );
}
add_action( 'admin_menu', 'eagatc_add_page_to_admin' );






// Function that renders the markup for the settings page
function eagatc_page_markup() {
  // check user capabilities
  if ( ! current_user_can( 'manage_options' ) ) {
   return;
  }

  // add success/error notification

  // // check if the user have submitted the settings
  // // wordpress will add the "settings-updated" $_GET parameter to the url
  // if ( isset( $_GET['settings-updated'] ) ) {
  //   // add settings saved message with the class of "updated"
  //     if ( !empty( get_option('eagatc_trackingcode') ) ) {
  //     add_settings_error(
  //       'eagatc_trackingcode',
  //       'pi-success-message',
  //       'Your Googlddeeeee Analytics code was added.<br /><br />Easily is that easily!',
  //       'success'
  //     );
  //   }
  //   else {
  //     add_settings_error(
  //       'eagatc_trackingcode',
  //       'pi-error-message',
  //       'You need to paste your code in the box before clicking the button',
  //       'error'
  //     );
  //   }
  // }



  ?>
  <div class="eagatc-wrap">

      <h1><span>Easily</span> Add Google Analytics Tracking Code</h1>


      <?php if ( empty(get_option( 'eagatc_trackingcode' ) ) ) {
        ?>
          <p>Paste your Google Analytics Tracking Code inside this box and then hit the 'Add Code' button.</p>
          <form action="options.php" method="post">
            <?php settings_fields( 'eagatc' ); ?>
            <?php do_settings_sections( 'eagatc' ); ?>
            <?php settings_errors( 'eagatc_trackingcode' ); ?>
            <input type="submit" name="submit" value="Add code" />
          </form>
        <?php


      } else {
        ?>
          <div class="eagatc-success-box">
            <p><strong>Your Google Analytics code was added to your website and everything is set up now!</strong></p>
            <p><strong>Yes, <span class="eagatc-brand">Easily</span> is that easily!</strong></p>
          </div>

          <?php





        function remove_footer_admin () {
            echo 'If you want to revert your changes and enter a new tracking code click here: &nbsp;<button id="eagatc-revert">Revert changes</button>';
        }
        add_filter('admin_footer_text', 'remove_footer_admin');


        // if ( isset($_POST['pinocchio'] ) ) {
        //     delete_option('eagatc_trackingcode');
        // }
      }


      ?>
    </div>
  <?php
}

//
// // This function includes the Option page markup and its functionality
// function eagatc_options_page_html(){
//   // this fires when the form in eagatc-options-page.php is submitted
//   // it creates/updates the 'eagatc' option in the wp_options database table with whatever is in the submitted 'eagatctextarea' textarea
//   if (isset($_POST['eagatctextarea'])) {
//     update_option('eagatc', $_POST['eagatctextarea']);
//   }
//   // this includes the markup of the options page in the WordPress Admin
//   include 'eagatc-options-page.php';
// }
//
// // Creates the plugin's option page in the WordPress admin dashboard
// function eagatc_options_page(){
//   add_menu_page('Easily Settings Page', 'Easily Plugin', 'manage_options',
//   'eagatc-plugin', 'eagatc_options_page_html',
//   plugin_dir_url(__FILE__) . 'images/easily-admin-icon.png');
// }
// add_action('admin_menu', 'eagatc_options_page');
//
// Adds the entered Google Tracking Code to the head of the website pages
function eagatc_add_to_head(){
echo get_option('eagatc_trackingcode');
}
add_action('wp_head', 'eagatc_add_to_head');

// Adds plugins styles
function eagatc_add_styles_and_scripts($hook_suffix){
  if( $hook_suffix == "toplevel_page_easily-eagatc") {
    wp_register_style( 'eagatc-styles', plugins_url( 'css/style.css', __FILE__ ) );
    wp_enqueue_style( 'eagatc-styles' );
    wp_register_script( 'eagatc-script', plugins_url( 'js/eagatc.js', __FILE__ ), array('jquery') );
    wp_enqueue_script( 'eagatc-script' );
  }
}
add_action( 'admin_enqueue_scripts', 'eagatc_add_styles_and_scripts' );
