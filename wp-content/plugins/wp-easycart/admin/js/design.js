function wpeasycart_admin_update_dynamic_sizing( ){
    if( !jQuery( document.getElementById( 'ec_option_default_dynamic_sizing' ) ).is( ':checked' ) ){
        jQuery( document.getElementById( 'ec_admin_ec_option_default_desktop_image_height_row' ) ).show( );
        jQuery( document.getElementById( 'ec_admin_ec_option_default_laptop_image_height_row' ) ).show( );
        jQuery( document.getElementById( 'ec_admin_ec_option_default_tablet_wide_image_height_row' ) ).show( );
        jQuery( document.getElementById( 'ec_admin_ec_option_default_tablet_image_height_row' ) ).show( );
        jQuery( document.getElementById( 'ec_admin_ec_option_default_smartphone_image_height_row' ) ).show( );
    }else{
        jQuery( document.getElementById( 'ec_admin_ec_option_default_desktop_image_height_row' ) ).hide( );
        jQuery( document.getElementById( 'ec_admin_ec_option_default_laptop_image_height_row' ) ).hide( );
        jQuery( document.getElementById( 'ec_admin_ec_option_default_tablet_wide_image_height_row' ) ).hide( );
        jQuery( document.getElementById( 'ec_admin_ec_option_default_tablet_image_height_row' ) ).hide( );
        jQuery( document.getElementById( 'ec_admin_ec_option_default_smartphone_image_height_row' ) ).hide( );
    }
}

function ec_admin_save_design_options( this_ele ){
	jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saving' ).show( );
	
	var val = 0;
		
	if( jQuery( this_ele ).is( ':checked' ) )
		val = 1;
		
	var data = {
		action: 'ec_admin_ajax_save_design_settings',
		update_var: jQuery( this_ele ).attr( 'id' ),
		val: val
	}
	
	jQuery.ajax({url: ajax_object.ajax_url, type: 'post', data: data, success: function(data){ 
		jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saving' ).hide( );
		jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saved' ).fadeIn( ).delay( 500 ).fadeOut( 'slow' );
	} } );
	
	return false;
}

function ec_admin_save_design_text_setting( this_ele ){
	jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saving' ).show( );
	jQuery( this_ele ).parent( ).find( '.wp-easycart-admin-icon-close-check' ).hide( );

	var val = jQuery( this_ele ).val( );

	var data = {
		action: 'ec_admin_ajax_save_design_settings',
		update_var: jQuery( this_ele ).attr( 'id' ),
		val: val
	}

	jQuery.ajax({url: ajax_object.ajax_url, type: 'post', data: data, success: function(data){ 
		jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saving' ).hide( );
		jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saved' ).fadeIn( ).delay( 500 ).fadeOut( 'slow' );
		jQuery( this_ele ).parent( ).find( '.wp-easycart-admin-icon-close-check' ).delay( 900 ).fadeIn( 'slow' );
	} } );
	
	return false;
}

function ec_admin_save_design_color_setting( this_ele ){
    console.log( 'test color picker' );
	jQuery( this_ele ).parent( ).parent( ).parent( ).parent( ).find( '.wp_easycart_toggle_saving' ).show( );
	jQuery( this_ele ).parent( ).parent( ).parent( ).parent( ).find( '.wp-easycart-admin-icon-close-check' ).hide( );

	var val = jQuery( this_ele ).val( );

	var data = {
		action: 'ec_admin_ajax_save_design_settings',
		update_var: jQuery( this_ele ).attr( 'id' ),
		val: val
	}

	jQuery.ajax({url: ajax_object.ajax_url, type: 'post', data: data, success: function(data){ 
		jQuery( this_ele ).parent( ).parent( ).parent( ).parent( ).find( '.wp_easycart_toggle_saving' ).hide( );
		jQuery( this_ele ).parent( ).parent( ).parent( ).parent( ).find( '.wp_easycart_toggle_saved' ).fadeIn( ).delay( 500 ).fadeOut( 'slow' );
		jQuery( this_ele ).parent( ).parent( ).parent( ).parent( ).find( '.wp-easycart-admin-icon-close-check' ).delay( 900 ).fadeIn( 'slow' );
	} } );
	
	return false;
}