<?php
/*
Plugin Name: Kiss Metrics
Plugin URI: http://www.stinkyinkshop.co.uk/themes/plugins/kiss-metrics/
Description: Enables <a href="http://www.kissmetrics.com/">Kiss Metrics</a> on all pages.
Version: 1.2
Author: Stinkyink
Author URI: http://www.stinkyinkshop.co.uk/themes/
*/

if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

function activate_kissmetrics() {
  add_option('kissmetrics_api_key', '');
}

function deactive_kissmetrics() {
  delete_option('kissmetrics_api_key');
}

function admin_init_kissmetrics() {
  register_setting('kissmetrics', 'kissmetrics_api_key');
}

function admin_menu_kissmetrics() {
  add_options_page('Kiss Metrics', 'Kiss Metrics', 'manage_options', 'kissmetrics', 'options_page_kissmetrics');
}

function options_page_kissmetrics() {
  include(WP_PLUGIN_DIR.'/kiss-metrics/options.php');  
}

function render_kissmetrics($kissmetrics_api_key) {
  if($kissmetrics_api_key) {
?>

<script type="text/javascript">
  var _kmq = _kmq || [];
  function _kms(u){
    setTimeout(function(){
      var s = document.createElement('script'); var f = document.getElementsByTagName('script')[0]; s.type = 'text/javascript'; s.async = true;
      s.src = u; f.parentNode.insertBefore(s, f);
    }, 1);
  }
  _kms('//i.kissmetrics.com/i.js');_kms('//doug1izaerwt3.cloudfront.net/<?php echo $kissmetrics_api_key; ?>.1.js');
</script>

<?php
  }
}



function kissmetrics() { 
  
  $kissmetrics_api_key = get_option('kissmetrics_api_key');
  render_kissmetrics($kissmetrics_api_key);

}

register_activation_hook(__FILE__, 'activate_kissmetrics');
register_deactivation_hook(__FILE__, 'deactive_kissmetrics');

if (is_admin()) {
  add_action('admin_init', 'admin_init_kissmetrics');
  add_action('admin_menu', 'admin_menu_kissmetrics');
}

if (!is_admin()) {
	add_action('wp_footer', 'kissmetrics');
}

?>