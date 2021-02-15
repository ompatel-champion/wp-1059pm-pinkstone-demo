function ec_admin_save_shipping_text_setting_pro( this_ele ){
	jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saving' ).show( );
	jQuery( this_ele ).parent( ).find( '.wp-easycart-admin-icon-close-check' ).hide( );

	var val = jQuery( this_ele ).val( );
    if( jQuery( this_ele ).attr( 'type' ) == 'checkbox' && !jQuery( this_ele ).is( ':checked' ) ){
        val = 0;
    }
    
	var data = {
		action: 'ec_admin_ajax_save_shipping_settings_pro',
		update_var: jQuery( this_ele ).attr( 'id' ),
		val: val
	}

	jQuery.ajax({url: ajax_object.ajax_url, type: 'post', data: data, success: function(data){ 
		jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saving' ).hide( );
		jQuery( this_ele ).parent( ).find( '.wp_easycart_toggle_saved' ).fadeIn( ).delay( 500 ).fadeOut( 'slow' );
		jQuery( this_ele ).parent( ).find( '.wp-easycart-admin-icon-close-check' ).delay( 900 ).fadeIn( 'slow' );
        
        if( data ){
            var data_json = JSON.parse( data );
            jQuery( document.getElementById( 'ec_admin_' + data_json.type + '_status_connected' ) ).hide( );
            jQuery( document.getElementById( 'ec_admin_' + data_json.type + '_status_error' ) ).hide( );
            jQuery( document.getElementById( 'ec_admin_' + data_json.type + '_status_disabled' ) ).hide( );
            jQuery( document.getElementById( 'ec_admin_' + data_json.type + '_status_' + data_json.response ) ).show( );
        }
	} } );
	
	return false;
}