<?php
/**
 * Version 0.4
 */

//Overwrite class variables
add_action('init', 'atw_pro_construct');
function atw_pro_construct(){
	global $atw;
	$atw->shortname = __('ATW PRO Plugin', $atw->hook);
	$atw->longname = __('Advanced Text Widget PRO: Options', $atw->hook);
}

//Add condition fields to the in_widget_form to make them available on all widgets
add_action('in_widget_form', 'atw_add_condition_fields');
add_action('in_widget_form', 'atw_add_pro_fields');

//this action removes widget form the global $sidebar_widgets if visibility is set to false
add_filter('sidebars_widgets', 'atw_remove_hidden_widgets', 10);
//this action applies formatting to the widget output if any (example: title suppression)
add_filter('widget_display_callback', 'atw_check_widget_visibility', 10, 3);

//Initiating this early enough to remove different actions
add_action('init', 'atw_remove_actions');
function atw_remove_actions(){
	//Remove ATW condition fields from regular version
	remove_action('atw_condition_fields', 'atw_add_condition_fields', 10, 2);
}

add_filter('atw_settings_array', 'atw_pro_settings');
function atw_pro_settings($settings){
	global $atw;

	$pro_settings = array(
		'Misc. Settings'	=> array(
			array(
			    'label'	=> __('Apply visibility conditions to "Advanced Text" widget only', $atw->hook),
			    'id'	=> array('misc', 'atw-only'),
			    'type'	=> 'checkbox',
			),
			array(
			    'label'	=> __('Custom CSS ID/Class', $atw->hook),
			    'id'  	=> array('misc', 'custom-id-class'),
          'type'	=> 'checkbox',
          'desc'  => '<p>Custom CSS ID and Class fields will be added to every widget.</p>',
			),
			array(
			    'label'	=> __('Export Settings', $atw->hook),
			    'id'        => 'misc-export',
          'type'      => 'input',
          'attr'      => array('type' => 'button', 'value' => __('Export', $atw->hook), 'class' => 'button'),
			),
			array(
			    'label'	=> __('Import Settings', $atw->hook),
			    'id'        => 'misc-import',
          'type'      => 'html',
          'default'   => '<input type="file" name="atw-import" />',
			),
		),
	);

	$settings = array_merge($settings, $pro_settings);
	return $settings;
}


add_action('atw_add_boxes', 'atw_add_pro_boxes');
function atw_add_pro_boxes(){
	global $atw;
	$atw->add_box(__('Misc. Settings', $atw->hook), $atw->settings('Misc. Settings'), 1);
	?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#misc-export').click(function(){
			jQuery('#atw_export').submit();
		});
	});
	</script>
	<form name="atw_export" id="atw_export" method="post">
		<input type="hidden" name="export" value="1">
	</form>
	<?php
}

/**
 * Checks ATW settings to determin if conditions should be applied only to ATW widgets
 */
 function atw_only(){
	global $atw;
	//check if conditions should apply to ATW only
	if( isset($atw->options['misc']['atw-only']) ){
		return true;
	}
	return false;
}

/**
 * Update instance parameters with visibility conditions on widget save action.
 */
add_filter('widget_update_callback', 'atw_update_callback', 1, 4);
function atw_update_callback($instance, $new_instance, $old_instance, $wp_widget){
	global $atw;

	$instance['action'] = $new_instance['action'];
	$instance['show'] = $new_instance['show'];
	$instance['slug'] = $new_instance['slug'];
	$instance['suppress_title'] = $new_instance['suppress_title'];
	$instance['css_id'] = esc_attr($new_instance['css_id']);
	$instance['css_class'] = esc_attr($new_instance['css_class']);
	return $instance;
}

/**
 * Removes widgets from $sidebar_widgets array that are hidden by visibility conditions
 */
function atw_remove_hidden_widgets($sidebar_widgets){
	global $wp_registered_widgets;

	//don't apply conditions in the admin dashboard
	if(is_admin() || empty($sidebar_widgets))
		return $sidebar_widgets;

	//unset wp_inactive_widgets to get only active ones
	$active_sidebar_widgets = $sidebar_widgets;
	unset($active_sidebar_widgets['wp_inactive_widgets']);
	//loop through each sidebar
	foreach($active_sidebar_widgets as $sidebar => $widgets){
		//if sidebar has no widgets - skip the internal loop
		if( empty($widgets) )
			continue;
		//loop through each registered widget
		foreach ($widgets as $widget_id) {

			//reset widget object since we're in the loop
			$widget = false;
			$number = false; //widget instance number
			/* Note regarding the $number:
			originally I took $number from $widget->number,
			but it seems like it represents some sort of total number, which
			doesn't always reflect the current instance number. In that case the
			instance conditions were applied incorrectly.
			*/
			if(isset($wp_registered_widgets[$widget_id]['callback'][0])){
				//get widget object by widget_id
				$widget = $wp_registered_widgets[$widget_id]['callback'][0];
				$number = $wp_registered_widgets[$widget_id]['params'][0]['number'];
			}


			if( !$widget || !$number )
				continue;

			//check if conditions should apply to ATW only
			if( atw_only() ){
				if( 'advanced_text' !== get_class($widget) ){
					continue;
				}
			}

			//get widget settings
			$widget_settings = get_option($widget->option_name);
			//get instance of this particular widget by parameter number
			$instance = $widget_settings[$number];
			//check visibility
			$show = atw_check_widget_visibility($instance);
			//if not show - unset widget from the sidebar
			if ($show == false) {
				$key = array_search($widget_id, $widgets);
				unset($active_sidebar_widgets[$sidebar][$key]);
			}


		}
	}

	return $active_sidebar_widgets;
}

/**
 * Add additional fields to widgets
 */
function atw_add_pro_fields($widget, $instance = false){
	global $atw;

	if( isset($atw->options['misc']['custom-id-class']) ):

	if(!$instance && is_numeric($widget->number)){
		$widget_settings = get_option($widget->option_name);
		$instance = $widget_settings[$widget->number];
	}
	?>
	<div class="atw-conditions">
		<?php _e('Custom CSS Attributes:', $atw->hook);?><br/>
		<label for="<?php echo $widget->get_field_id('css_id'); ?>" title="<?php _e('Custom CSS ID', $atw->hook);?>" style="display:inline-block; width: 15%;"><?php _e('ID:', $atw->hook);?></label>
		<input id="<?php echo $widget->get_field_id('css_id'); ?>" name="<?php echo $widget->get_field_name('css_id'); ?>" type="text" value="<?php echo @$instance['css_id']; ?>" style="display:inline-block; width: 80%" /><br/>
		<label for="<?php echo $widget->get_field_id('css_class'); ?>" title="<?php _e('Custom CSS Class', $atw->hook);?>" style="display:inline-block; width: 15%;"><?php _e('Class:', $atw->hook);?></label>
		<input id="<?php echo $widget->get_field_id('css_class'); ?>" name="<?php echo $widget->get_field_name('css_class'); ?>" type="text" value="<?php echo @$instance['css_class']; ?>" style="display:inline-block; width: 80%" />
	</div>
	<?php
	endif;
}

/**
 * Apply custom CSS IDs and Classes to widgets
 */
add_filter( 'dynamic_sidebar_params', 'atw_apply_custom_id_class' );
function atw_apply_custom_id_class($params){
	global $atw;

	if( !isset($atw->options['misc']['custom-id-class']) )
		return $params;

	global $wp_registered_widgets;
	$widget_id   	= $params[0]['widget_id'];
	$widget_obj   = $wp_registered_widgets[$widget_id];
	$widget_opt   = get_option($widget_obj['callback'][0]->option_name);
	$widget_num   = $widget_obj['params'][0]['number'];

	if ( isset($widget_opt[$widget_num]['css_id']) && !empty($widget_opt[$widget_num]['css_id']) )
	$params[0]['before_widget'] = preg_replace( '/id="[A-Za-z0-9_-]+"/', "id=\"{$widget_opt[$widget_num]['css_id']}\"", $params[0]['before_widget'], 1 );

	if ( isset($widget_opt[$widget_num]['css_class']) && !empty($widget_opt[$widget_num]['css_class']) )
	$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['css_class']} ", $params[0]['before_widget'], 1 );

	return $params;
}


//add_action('wp_ajax_atw_export', 'atw_export_options');
add_action('admin_init', 'atw_export_import');
function atw_export_import(){
	global $atw;

  if( !isset($_GET['page']) || $_GET['page'] != $atw->hook  )
		return;

	if(!$atw->options)
		return;

	if(isset($_POST['export']) && 1 == $_POST['export'] ) {
		atw_export();
		die();
	}

	return;
}


function atw_export(){
	global $atw;

	//date string to suffix the file nanme: month - day - year
  $suffix = date('n-j-y');
	// send response headers to the browser
  header( 'Content-Type: text' );
  header( 'Content-Disposition: attachment;filename=atw_settings_' . $suffix . '.txt');
  $fp = fopen('php://output', 'w');
  $output = serialize($atw->options);
  fwrite($fp, $output);
  fclose($fp);
  die();
}


//add_filter('init', 'atw_import');
add_filter('atw_validate_input', 'atw_import');
function atw_import($input){
	global $atw;

	if( !isset($_FILES['atw-import']) )
		return $input;

	if( !isset($_FILES['atw-import']['tmp_name']) || empty($_FILES['atw-import']['tmp_name']) )
		return $input;

	$content = file_get_contents( $_FILES['atw-import']['tmp_name'] );

	if( !$new_input = unserialize($content) )
		return $input;

	return $new_input;
}