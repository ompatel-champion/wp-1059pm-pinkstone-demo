<?php
class wp_easycart_admin_promotions_pro{
	
	public $promotions_list_file;
	
	public function __construct( ){ 
		$this->promotions_list_file 	= WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/marketing/promotions/promotion-list.php';
		$this->promotions_details_file 	= WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/marketing/promotions/promotion-details.php';
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			remove_action( 'wp_easycart_admin_promotion_list', array( wp_easycart_admin( ), 'show_upgrade', 1 ) );
			remove_action( 'wp_easycart_admin_promotion_details', array( wp_easycart_admin( ), 'show_upgrade', 1 ) );
			add_action( 'wp_easycart_admin_promotion_list', array( $this, 'show_list' ), 1 );
			add_action( 'wp_easycart_admin_promotion_details', array( $this, 'show_details' ), 1 );
			
			// Form Action Hooks
			add_action( 'wp_easycart_process_post_form_action', array( $this, 'process_add_promotion' ) );
			add_action( 'wp_easycart_process_post_form_action', array( $this, 'process_update_promotion' ) );
			add_action( 'wp_easycart_process_get_form_action', array( $this, 'process_delete_promotion' ) );
			add_action( 'wp_easycart_process_get_form_action', array( $this, 'process_bulk_delete_promotion' ) );
		}
	}
	
	public function process_add_promotion( ){
		if( $_POST['ec_admin_form_action'] == "add-new-promotion" ){
			$result = $this->insert_promotion( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'promotions', $result );
		}
	}
	
	public function process_update_promotion( ){
		if( $_POST['ec_admin_form_action'] == "update-promotion" ){
			$result = $this->update_promotion( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'promotions', $result );
		}
	}
	
	public function process_delete_promotion( ){
		if( isset($_GET['subpage']) == 'promotions' && $_GET['ec_admin_form_action'] == 'delete-promotion' && isset( $_GET['promotion_id'] ) && !isset( $_GET['bulk'] ) ){
			$result = $this->delete_promotion( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'promotions', $result );
		}
	}
	
	public function process_bulk_delete_promotion( ){
		if( isset($_GET['subpage']) == 'promotions' && $_GET['ec_admin_form_action'] == 'delete-promotion' && !isset( $_GET['promotion_id'] ) && isset( $_GET['bulk'] ) ){
			$result = $this->bulk_delete_promotion( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'promotions', $result );
		}
	}
	
	private function print_admin_message($status, $message) {
		//success & error messages
		if ($status == 'success') {
			$print_message = '<div id="ec_message" class="ec_admin_message_success"><div class="dashicons-before dashicons-thumbs-up"></div>'.$message.'</div>';
		} else if ($status == 'error') {
			$print_message = '<div id="ec_message" class="ec_admin_message_error"><div class="dashicons-before dashicons-thumbs-down"></div>'.$message.'</div>';
		}
		return $print_message;
	}
	
	public function show_details( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_details_promotions.php' );
		$details = new wp_easycart_admin_details_promotions( );
		$details->output( esc_attr( $_GET['ec_admin_form_action'] ) );
	}
	
	public function show_list( ){
		//success messages
		if(isset($_GET['success'] )) {
			if ($_GET['success'] == 'promotion-inserted')
				echo $this->print_admin_message( 'success', __( 'Promotion successfully created', 'wp-easycart-pro' ) );
			if ($_GET['success'] == 'promotion-updated')
				echo $this->print_admin_message( 'success', __( 'Promotion successfully updated', 'wp-easycart-pro' ) );
			if ($_GET['success'] == 'promotion-deleted')
				echo $this->print_admin_message( 'success', __( 'Promotion successfully deleted', 'wp-easycart-pro' ) );
		}
		//failure messages
		if(isset($_GET['error'] )) {
			if ($_GET['error'] == 'promotion-inserted-error')
				echo $this->print_admin_message( 'error', __( 'Promotion failed to create', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'promotion-updated-error')
				echo $this->print_admin_message( 'error', __( 'Promotion failed to update', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'promotion-deleted-error')
				echo $this->print_admin_message( 'error', __( 'Promotion failed to delete', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'promotion-duplicate')
				echo $this->print_admin_message( 'error', __( 'Promotion failed to create due to duplicate', 'wp-easycart-pro' ) );
		}
		//show list page
		include( $this->promotions_list_file );
	}
	
	public function insert_promotion( ){
		$promotion_id = $_POST['promotion_id'];
		$name = stripslashes_deep( $_POST['name'] );
		$type = $_POST['type'];
		$start_date = date("Y-m-d",strtotime($_POST['start_date'])) . " 00:00:00";
		$end_date = date("Y-m-d",strtotime($_POST['end_date'])) . " 23:59:59";
		$product_id_1 = $_POST['product_id_1'];
		$product_id_2 = '';
		$product_id_3 = '';
		$manufacturer_id_1 = $_POST['manufacturer_id_1'];
		$manufacturer_id_2 = '';
		$manufacturer_id_3 = '';
		$category_id_1 = $_POST['category_id_1'];
		$category_id_2 = '';
		$category_id_3 = '';
		$price1 = $_POST['price1'];
		$price2 = $_POST['price2'];
		$price3 = '';
		$percentage1 = $_POST['percentage1'];
		$percentage2 = '';
		$percentage3 = '';
		$number1 = $_POST['number1'];
		$number2 = $_POST['number2'];
		$number3 = '';
		
		$query_vars = array( );
		
		global $wpdb;
		$duplicate = $wpdb->query( $wpdb->prepare( "SELECT * FROM ec_promotion WHERE ec_promotion.promotion_id='%s'", $promotion_id));
		
		//if no duplicates, insert
		if( $duplicate == 0 ){
			$result = $wpdb->query( $wpdb->prepare( "INSERT INTO ec_promotion(ec_promotion.promotion_id,  ec_promotion.name,  ec_promotion.type,  ec_promotion.start_date,  ec_promotion.end_date,  ec_promotion.product_id_1,  ec_promotion.product_id_2,  ec_promotion.product_id_3,  ec_promotion.manufacturer_id_1,  ec_promotion.manufacturer_id_2,  ec_promotion.manufacturer_id_3,  ec_promotion.category_id_1,  ec_promotion.category_id_2,  ec_promotion.category_id_3,  ec_promotion.price1,  ec_promotion.price2,  ec_promotion.price3,  ec_promotion.percentage1,  ec_promotion.percentage2,  ec_promotion.percentage3,  ec_promotion.number1,  ec_promotion.number2,  ec_promotion.number3 ) 
  VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )", $promotion_id, $name, $type, $start_date, $end_date, $product_id_1, $product_id_2, $product_id_3, $manufacturer_id_1, $manufacturer_id_2, $manufacturer_id_3, $category_id_1, $category_id_2, $category_id_3, $price1, $price2, $price3, $percentage1, $percentage2, $percentage3, $number1, $number2, $number3 ) );


  
			if(count($result)> 0 ){
				$query_vars['success'] = 'promotion-inserted';
			}else{
				$query_vars['error'] = 'promotion-inserted-error';
			}
		}else{
			$query_vars['error'] = 'promotion-duplicate';
		}
		
		return $query_vars;
	}
	
	public function update_promotion( ){
		$promotion_id = $_POST['promotion_id'];
		$name = stripslashes_deep( $_POST['name'] );
		$type = $_POST['type'];
		$start_date = date("Y-m-d",strtotime($_POST['start_date'])) . " 00:00:00";
		$end_date = date("Y-m-d",strtotime($_POST['end_date'])) . " 23:59:59";
		$product_id_1 = $_POST['product_id_1'];
		$product_id_2 = '';
		$product_id_3 = '';
		$manufacturer_id_1 = $_POST['manufacturer_id_1'];
		$manufacturer_id_2 = '';
		$manufacturer_id_3 = '';
		$category_id_1 = $_POST['category_id_1'];
		$category_id_2 = '';
		$category_id_3 = '';
		$price1 = $_POST['price1'];
		$price2 = $_POST['price2'];
		$price3 = '';
		$percentage1 = $_POST['percentage1'];
		$percentage2 = '';
		$percentage3 = '';
		$number1 = $_POST['number1'];
		$number2 = $_POST['number2'];
		$number3 = '';
		
		$query_vars = array( );
		
		global $wpdb;

		$result = $wpdb->query( $wpdb->prepare( "REPLACE INTO ec_promotion(ec_promotion.promotion_id,  ec_promotion.name,  ec_promotion.type,  ec_promotion.start_date,  ec_promotion.end_date,  ec_promotion.product_id_1,  ec_promotion.product_id_2,  ec_promotion.product_id_3,  ec_promotion.manufacturer_id_1,  ec_promotion.manufacturer_id_2,  ec_promotion.manufacturer_id_3,  ec_promotion.category_id_1,  ec_promotion.category_id_2,  ec_promotion.category_id_3,  ec_promotion.price1,  ec_promotion.price2,  ec_promotion.price3,  ec_promotion.percentage1,  ec_promotion.percentage2,  ec_promotion.percentage3,  ec_promotion.number1,  ec_promotion.number2,  ec_promotion.number3 ) 
  VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )", $promotion_id, $name, $type, $start_date, $end_date, $product_id_1, $product_id_2, $product_id_3, $manufacturer_id_1, $manufacturer_id_2, $manufacturer_id_3, $category_id_1, $category_id_2, $category_id_3, $price1, $price2, $price3, $percentage1, $percentage2, $percentage3, $number1, $number2, $number3 ) );
		
		
		if( count($result)> 0 ){
			$query_vars['success'] = 'promotion-updated';
		}else{
			$query_vars['error'] = 'promotion-updated-error';
		}

		
		return $query_vars;	
		
	}
	
	public function delete_promotion( ){
		
		$promotion_id = $_GET['promotion_id'];
		$query_vars = array( );
		
		global $wpdb;
		$result = $wpdb->query( $wpdb->prepare( "DELETE FROM ec_promotion WHERE ec_promotion.promotion_id = %s", $promotion_id ) );
		
		if( count($result)> 0 ){
			$query_vars['success'] = 'promotion-deleted';
		}else{
			$query_vars['error'] = 'promotion-deleted-error';
		}
		
		return $query_vars;
		
	}
	
	public function bulk_delete_promotion( ){
		$bulk_ids = $_GET['bulk'];
		$query_vars = array( );
		
		global $wpdb;
		$errors = 0;
		foreach( $bulk_ids as $bulk_id ){
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM ec_promotion WHERE ec_promotion.promotion_id = %s", $bulk_id ) );
			if( $result === false )
				$errors++;
		}
		
		if( $errors > 0){
			$query_vars['error'] = 'promotion-deleted-error';
		}else{
			$query_vars['success'] = 'promotion-deleted';
		}
		
		return $query_vars;
		
	}	
}
new wp_easycart_admin_promotions_pro( );