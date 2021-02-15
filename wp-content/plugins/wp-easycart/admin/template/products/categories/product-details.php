<form action="<?php echo $this->action; ?>"  method="POST" name="wpeasycart_admin_form" id="wpeasycart_admin_form" novalidate="novalidate">
<input type="hidden" name="ec_admin_form_action" value="<?php echo $this->form_action; ?>" />
<?php
	if(isset($_GET['category_id'])) {
		$category_id = $_GET['category_id'];
	} else {
		global $wpdb;
		$category_id = $wpdb->get_var( $wpdb->prepare( "SELECT ec_categoryitem.category_id FROM ec_categoryitem WHERE ec_categoryitem.category_id = %d", $_GET['category_id'] ) );
	}	
?>
<input type="hidden" name="category_id" value="<?php echo $category_id; ?>" />	
<input type="hidden" name="categoryitem_id" value="<?php echo $this->categoryitem->categoryitem_id; ?>" />

<div class="ec_admin_settings_panel ec_admin_details_panel">
    <div class="ec_admin_important_numbered_list">
        <div class="ec_admin_flex_row">
            <div class="ec_admin_list_line_item ec_admin_col_12 ec_admin_col_first">
                <div class="ec_admin_settings_label">
                    <div class="dashicons-before dashicons-products"></div>
                    <span><?php _e( 'ADD CATEGORY PRODUCT', 'wp-easycart' ); ?></span>
                    <div class="ec_page_title_button_wrap">
                        <a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('products', 'categories', 'categories');?>" target="_blank" class="ec_help_icon_link">
                            <div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart' ); ?>
                        </a>
                        <?php echo wp_easycart_admin( )->helpsystem->print_vids_url('products', 'categories', 'details');?>
                        <a href="<?php echo $this->action; ?>" class="ec_page_title_button"><?php _e( 'Cancel', 'wp-easycart' ); ?></a>
                        <input type="submit" value="<?php _e( 'Save', 'wp-easycart' ); ?>" onclick="return wpeasycart_admin_validate_form( )" class="ec_page_title_button">
                    </div>
                </div>
            
                <div class="ec_admin_settings_input ec_admin_settings_currency_section">
                	<div id="ec_admin_row_heading_title" class="ec_admin_row_heading_title"><?php _e( 'Add Category Product', 'wp-easycart' ); ?><br></div>
                    <div id="ec_admin_row_heading_message" class="ec_admin_row_heading_message"><p><?php _e( 'Add your product to this category below.', 'wp-easycart' ); ?></p></div>
					<?php do_action( 'wp_easycart_admin_category_product_details_basic_fields' ); ?>
                </div>
            </div>
        </div> 
    </div>
</div>

<div class="ec_admin_details_footer">
	<div class="ec_page_title_button_wrap">
    	<a href="<?php echo $this->action; ?>" class="ec_page_title_button"><?php _e( 'Cancel', 'wp-easycart' ); ?></a>
        <input type="submit" value="<?php _e( 'Save', 'wp-easycart' ); ?>" onclick="return wpeasycart_admin_validate_form( )" class="ec_page_title_button">
    </div>
</div>
</form>