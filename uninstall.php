<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

// delete the option created by the plugin
$option_name = "eagatc_trackingcode";
delete_option($option_name);
