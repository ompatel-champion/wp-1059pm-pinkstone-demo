<?php
class wp_easycart_admin_giftcards_pro{
	
	public $giftcards_list_file;
	
	public function __construct( ){ 
		$this->giftcards_list_file 		= WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/marketing/giftcards/giftcard-list.php';
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			remove_action( 'wp_easycart_admin_giftcard_list', array( wp_easycart_admin( ), 'show_upgrade', 1 ) );
			remove_action( 'wp_easycart_admin_giftcard_details', array( wp_easycart_admin( ), 'show_upgrade', 1 ) );
			add_action( 'wp_easycart_admin_giftcard_list', array( $this, 'show_list' ), 1 );
			add_action( 'wp_easycart_admin_giftcard_details', array( $this, 'show_details' ), 1 );
			
			// Form Action Hooks
			add_action( 'wp_easycart_process_post_form_action', array( $this, 'process_add_giftcard' ) );
			add_action( 'wp_easycart_process_post_form_action', array( $this, 'process_update_giftcard' ) );
			add_action( 'wp_easycart_process_get_form_action', array( $this, 'process_delete_giftcard' ) );
			add_action( 'wp_easycart_process_get_form_action', array( $this, 'process_bulk_delete_giftcard' ) );
		}
	}
	
	public function process_add_giftcard( ){
		if( $_POST['ec_admin_form_action'] == "add-new-gift-card" ){
			$result = $this->insert_gift_card( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'gift-cards', $result );
		}
	}
	
	public function process_update_giftcard( ){
		if( $_POST['ec_admin_form_action'] == "update-gift-card" ){
			$result = $this->update_gift_card( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'gift-cards', $result );
		}
	}
	
	public function process_delete_giftcard( ){
		if( (isset($_GET['subpage']) == 'gift-cards' && $_GET['ec_admin_form_action'] == 'delete-giftcard' && isset( $_GET['giftcard_id'] ) && !isset( $_GET['bulk'])) || ($_GET['page'] == 'wp-easycart-rates' && !isset($_GET['subpage']) && $_GET['ec_admin_form_action'] == 'delete-giftcard' && isset( $_GET['giftcard_id'] ) && !isset( $_GET['bulk'] ))){
			$result = $this->delete_gift_card( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'gift-cards', $result );
		}
	}
	
	public function process_bulk_delete_giftcard( ){
		if( (isset($_GET['subpage']) == 'gift-cards' && $_GET['ec_admin_form_action'] == 'delete-giftcard' && !isset( $_GET['giftcard_id'] ) && isset( $_GET['bulk'])) || ($_GET['page'] == 'wp-easycart-rates' && !isset($_GET['subpage']) && $_GET['ec_admin_form_action'] == 'delete-giftcard' && !isset( $_GET['giftcard_id'] ) && isset( $_GET['bulk'] ))){
			$result = $this->bulk_delete_gift_card( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'gift-cards', $result );
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
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_details_giftcard.php' );
		$details = new wp_easycart_admin_details_giftcard( );
		$details->output( esc_attr( $_GET['ec_admin_form_action'] ) );
	}
	
	public function show_list( ){
		//success messages
		if(isset($_GET['success'] )) {
			if ($_GET['success'] == 'gift-card-inserted')
				echo $this->print_admin_message( 'success', __( 'Gift Card(s) successfully created', 'wp-easycart-pro' ) );
			if ($_GET['success'] == 'gift-card-updated')
				echo $this->print_admin_message( 'success', __( 'Gift Card(s) successfully updated', 'wp-easycart-pro' ) );
			if ($_GET['success'] == 'gift-card-deleted')
				echo $this->print_admin_message( 'success', __( 'Gift Card(s) successfully deleted', 'wp-easycart-pro' ) );
		}
		//failure messages
		if(isset($_GET['error'] )) {
			if ($_GET['error'] == 'gift-card-inserted-error')
				echo $this->print_admin_message( 'error', __( 'Gift Card(s) failed to create', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'gift-card-updated-error')
				echo $this->print_admin_message( 'error', __( 'Gift Card(s) failed to update', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'gift-card-deleted-error')
				echo $this->print_admin_message( 'error', __( 'Gift Card(s) failed to delete', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'gift-card-duplicate')
				echo $this->print_admin_message( 'error', __( 'Gift Card(s) failed to create due to duplicate', 'wp-easycart-pro' ) );
		}
		//show list page
		include( $this->giftcards_list_file );
	}
	
	public function insert_gift_card( ){
		
		$giftcard_id = preg_replace( "/[^A-Za-z0-9]/", '', stripslashes_deep( $_POST['giftcard_id'] ) );
		$amount = $_POST['amount'];
		$message = stripslashes_deep( $_POST['message'] );
		
		$query_vars = array( );
		
		global $wpdb;
		$duplicate = $wpdb->query( $wpdb->prepare( "SELECT * FROM ec_giftcard WHERE ec_giftcard.giftcard_id='%s'", $giftcard_id));
		
		//if no duplicates, insert
		if( $duplicate == 0 ){
			$result = $wpdb->query( $wpdb->prepare( "INSERT INTO ec_giftcard( ec_giftcard.giftcard_id, ec_giftcard.amount, ec_giftcard.message ) VALUES(%s, %s, %s)", $giftcard_id, $amount, $message) );
			if(count($result)> 0){
				$query_vars['success'] = 'gift-card-inserted';
			}else{
				$query_vars['error'] = 'gift-card-inserted-error';
			}
		}else{
			$query_vars['error'] = 'gift-card-duplicate';
		}
		
		return $query_vars;
	}
	
	public function update_gift_card( ){
		
		$original_id = $_POST['original_id'];
		$giftcard_id = preg_replace( "/[^A-Za-z0-9]/", '', stripslashes_deep( $_POST['giftcard_id'] ) );
		$amount = $_POST['amount'];
		$message = stripslashes_deep( $_POST['message'] );
		
		$query_vars = array( );
		
		global $wpdb;

		$result = $wpdb->query( $wpdb->prepare( "UPDATE ec_giftcard SET giftcard_id = %s, amount = %s, message = %s WHERE giftcard_id = %s", $giftcard_id, $amount, $message, $original_id ) );
		
		//print_r($result);
		if( count($result)> 0 ){
			$query_vars['success'] = 'gift-card-updated';
		}else{
			$query_vars['error'] = 'gift-card-updated-error';
		}

		
		return $query_vars;	
		
	}
	
	public function delete_gift_card( ){
		
		$giftcard_id = $_GET['giftcard_id'];
		$query_vars = array( );
		
		global $wpdb;
		$result = $wpdb->query( $wpdb->prepare( "DELETE FROM ec_giftcard WHERE ec_giftcard.giftcard_id = %s", $giftcard_id ) );
		
		if( count($result)> 0){
			$query_vars['success'] = 'gift-card-deleted';
		}else{
			$query_vars['error'] = 'gift-card-deleted-error';
		}
		
		return $query_vars;
		
	}
	
	public function bulk_delete_gift_card( ){
		$bulk_ids = $_GET['bulk'];
		$query_vars = array( );
		
		global $wpdb;
		$errors = 0;
		foreach( $bulk_ids as $bulk_id ){
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM ec_giftcard WHERE ec_giftcard.giftcard_id = %s", $bulk_id ) );
			if( $result === false )
				$errors++;
		}
		
		if( $errors ){
			$query_vars['error'] = 'gift-card-deleted-error';
		}else{
			$query_vars['success'] = 'gift-card-deleted';
		}
		
		return $query_vars;
		
	}
		
}
new wp_easycart_admin_giftcards_pro( );