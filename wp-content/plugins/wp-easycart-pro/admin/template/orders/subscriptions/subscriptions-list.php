<?php
$table = new wp_easycart_admin_table( );
$table->set_table( 'ec_subscription', 'subscription_id' );
$table->set_table_id( 'ec_admin_subscription_list' );
$table->set_default_sort( 'next_payment_date', 'DESC' );
$table->set_docs_link ('orders','subscriptions');
$table->set_icon( 'update' );
$table->set_add_new(false, '', '');
$table->set_list_columns( 
	array(
		array( 
			'name' 	=> 'title', 
			'label'	=> __( 'Subscription Title', 'wp-easycart-pro' ),
			'format'=> 'string'
		),
		array( 
			'name' 	=> 'subscription_status',
			'label'	=> __( 'Status', 'wp-easycart-pro' ),
			'format'=> 'string'
		),
		array( 
			'name' 	=> 'first_name',
			'label'	=> __( 'First Name', 'wp-easycart-pro' ),
			'format'=> 'string'
		),
		array( 
			'name' 	=> 'last_name',
			'label'	=> __( 'Last Name', 'wp-easycart-pro' ),
			'format'=> 'string'
		),
		array( 
			'name' 	=> 'price',
			'label'	=> __( 'Price', 'wp-easycart-pro' ),
			'format'=> 'currency'
		)
	)
);
$table->set_search_columns(
	array( 'ec_subscription.title', 'ec_subscription.email', 'ec_subscription.first_name', 'ec_subscription.last_name', 'ec_subscription.subscription_status' )
);
$table->set_bulk_actions(
	array(
		array(
			'name'	=> 'delete-subscription',
			'label'	=> __( 'Delete', 'wp-easycart-pro' )
		)
	)
);
$table->set_actions(
	array(
		array(
			'name'	=> 'edit',
			'label'	=> __( 'Edit', 'wp-easycart-pro' ),
			'icon'  => 'edit'
		),
		array(
			'name'	=> 'delete-subscription',
			'label'	=> __( 'Delete', 'wp-easycart-pro' ),
			'icon'  => 'trash'
		)
	)
);
$table->set_filters(
	array( )
);
$table->set_label( __( 'Subscription', 'wp-easycart-pro' ), __( 'Subscriptions', 'wp-easycart-pro' ) );
$table->print_table( );
?>