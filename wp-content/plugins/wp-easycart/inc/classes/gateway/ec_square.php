<?php
// This is a payment gateway basic structure,
// child classes will be based on this class.

class ec_square extends ec_gateway{
	
	/****************************************
	* GATEWAY SPECIFIC HELPER FUNCTIONS
	*****************************************/
	
	function get_gateway_data( ){
		
		if( get_option( 'ec_option_square_currency' ) == '' ){
			$this->set_currency( );
		}
        
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
		if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
        
        $square_order_id = $this->insert_order( );
        
		$json_arr = array( 	
            "source_id"			    => $_POST['nonce'],
            //"verification_token"	=> $_POST['buyerVerification-token'],
            "amount_money"			=> array(
                "amount"				=> (integer) number_format( $this->order_totals->grand_total * 100, 0, "", "" ),
                "currency"				=> get_option( 'ec_option_square_currency' )
            ),
            "idempotency_key"		=> uniqid( ),
            "reference_id"			=> (string) $this->order_id,
            //"order_id"              => $square_order_id,
            "note"					=> 'EasyCart - Order ' . (string) $this->order_id,
            "billing_address"		=> array( 
                "address_line_1"	=> (string) $this->user->billing->address_line_1,
                "address_line_2"	=> (string) $this->user->billing->address_line_2,
                "locality"			=> (string) $this->user->billing->city,
                "administrative_district_level_1"	=> (string) $this->user->billing->state,
                "postal_code"		=> (string) $this->user->billing->zip,
                "country"			=> strtoupper( (string) $this->user->billing->country )
            ),
            "shipping_address"		=> array( 
                "address_line_1"	=> (string) $this->user->shipping->address_line_1,
                "address_line_2"	=> (string) $this->user->shipping->address_line_2,
                "locality"			=> (string) $this->user->shipping->city,
                "administrative_district_level_1"	=> (string) $this->user->shipping->state,
                "postal_code"		=> (string) $this->user->shipping->zip,
                "country"			=> strtoupper( (string) $this->user->shipping->country )
            ),
            "buyer_email_address"	=> (string) $this->user->email,
            "location_id"           => $location_id
            //"verification_token"    => (string) '' // Need to add later for SCA
        );
        
        if( $square_order_id ){
            $json_arr['order_id']   = $square_order_id;
        }
		
		$application_fee = number_format( $this->order_totals->grand_total * 100 * apply_filters( 'wp_easycart_stripe_connect_fee_rate', 2 ) * .01, 0, '', '' );
		if( $application_fee > 0 && get_option( 'ec_option_square_currency' ) == 'USD' && !get_option( 'ec_option_square_is_sandbox' ) ){
			//$json_arr["additional_recipients"] = array(
			$json_arr["app_fee_money"] = (object) array(
                //"location_id"		=> "D3G74XXQYM8Y5",
                //"description"		=> "Application Fees",
                //"amount_money"		=> (object) array(
                    "amount"		=> (int) $application_fee,
                    "currency"		=> get_option( 'ec_option_square_currency' )
                //)
			);
		}
		
		return $json_arr;
		
	}
	
	function get_gateway_url( ){
		
        return ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/payments" : "https://connect.squareup.com/v2/payments";

	}
	
	function handle_gateway_response( $response ){
		
		$response_arr = json_decode( $response );
		
		$error_text = "";
		if( isset( $response_arr->errors ) && count( $response_arr->errors ) > 0 ){
			$this->is_success = 0;
			$error_text = $response_arr->errors[0]->detail;
		}else{
			$this->is_success = 1;
			$ids = array( 
                "payment_id"    => $response_arr->payment->id,
                "order_id"    => $response_arr->payment->order_id
            );
			$this->mysqli->update_order_transaction_id( $this->order_id, json_encode( $ids ) );
		}
		
		$this->mysqli->insert_response( $this->order_id, !$this->is_success, "Square", $error_text );
		
		if( !$this->is_success )
			$this->error_message = $error_text;
			
	}
	
	function get_gateway_response( $gateway_url, $gateway_data, $gateway_headers ){
		
		if( get_option( 'ec_option_square_application_id' ) == '' ){
			$this->renew_token( );
		}
		
		$access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
		$location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
		
        $headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, true ); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
		$response = curl_exec($ch);
		if( $response === false )
			$this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
		else
			$this->mysqli->insert_response( 0, 0, "Square Charge Response", print_r( $response, true ) );
		
		curl_close ($ch);
		
        $response_decode = json_decode( $response );
        if( isset( $response_decode->payment ) && isset( $response_decode->payment->card_details ) ){
            global $wpdb;
            $wpdb->query( $wpdb->prepare( "UPDATE ec_order SET payment_method = %s, cc_exp_month = %s, cc_exp_year = %s, creditcard_digits = %s WHERE order_id = %d", $response_decode->payment->card_details->card->card_brand, $response_decode->payment->card_details->card->exp_month, $response_decode->payment->card_details->card->exp_year, $response_decode->payment->card_details->card->last_4, $this->order_id ) );
        }
		
		return $response;
		
	}
    
    function insert_order( ){
        
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
		$location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
        
        $gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/locations/" . $location_id . "/orders" : "https://connect.squareup.com/v2/locations/" . $location_id . "/orders";
        
        $gateway_data = $this->get_order_data( );
        
        $headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, true ); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
		$response = curl_exec($ch);
		if( $response === false )
			$this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
		else
			$this->mysqli->insert_response( 0, 0, "Square Order Response", print_r( $gateway_data, true ) . ' --- ' . print_r( $response, true ) );
		
		curl_close ($ch);
		
		return $this->process_order_response( $response );
        
    }
    
    function cancel_order( $transaction_id ){
        $ids = json_decode( $transaction_id );
        
        // V2
        if( isset( $ids->order_id ) ){
            $order = $this->get_order( $ids->order_id );
            
            if( !$order ){
                return false;
            }

            $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
            $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
            if( !$location_id ){
                $location_id = $this->get_location_id( );
            }
            
            $gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/locations/" . $location_id . "/orders/" . $ids->order_id : "https://connect.squareup.com/v2/locations/" . $location_id . "/orders/" . $ids->order_id;

            $gateway_data = array(
                'order' => array(
                    'location_id'   => $location_id,
                    'version'       => $order->version,
                    'fulfillments'  => array(
                        array(
                            'uid'   => $order->fulfillments[0]->uid,
                            'state' => 'CANCELED'
                        )
                    )
                )
            );

            $headr = array();
            $headr[] = 'Accept: application/json';
            $headr[] = 'Content-Type: application/json';
            $headr[] = 'Authorization: Bearer ' . $access_token;
            $headr[] = 'Square-Version: 2019-10-23';

            $ch = curl_init( );
            curl_setopt($ch, CURLOPT_URL, $gateway_url );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT" );
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
            curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
            curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
            $response = curl_exec($ch);
            if( $response === false )
                $this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
            else
                $this->mysqli->insert_response( 0, 0, "Square Order UPDATE Response", $gateway_url  . ' --- ' . print_r( $gateway_data, true ) . ' --- ' . print_r( $response, true ) );

            curl_close ($ch);
        }
    }
    
    function get_order( $order_id ){
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
        
        $gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/locations/" . $location_id . "/orders/batch-retrieve" : "https://connect.squareup.com/v2/locations/" . $location_id . "/orders/batch-retrieve";

        $gateway_data = array(
            'order_ids' => array(
                $order_id
            )
        );

        $headr = array();
        $headr[] = 'Accept: application/json';
        $headr[] = 'Content-Type: application/json';
        $headr[] = 'Authorization: Bearer ' . $access_token;
        $headr[] = 'Square-Version: 2019-10-23';

        $ch = curl_init( );
        curl_setopt($ch, CURLOPT_URL, $gateway_url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
        curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
        $response = curl_exec($ch);
        if( $response === false )
            $this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
        else
            $this->mysqli->insert_response( 0, 0, "Square Get Order Response", $gateway_url  . ' --- ' . print_r( $gateway_data, true ) . ' --- ' . print_r( $response, true ) );

        curl_close ($ch);
        
        $response_arr = json_decode( $response );
        
        if( count( $response_arr->orders ) > 0 ){
            return $response_arr->orders[0];
        }
        
        return false;
    }
    
    function get_order_data( ){
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
        
        /* Get Shipping Label */
        $shipping_method = "";
		if( !get_option( 'ec_option_use_shipping' ) ){
        	$shipping_method = "";
        
		}else if( $GLOBALS['ec_cart_data']->cart_data->shipping_method == "free" ){
			$shipping_method = $GLOBALS['language']->get_text( "cart_estimate_shipping", "cart_estimate_shipping_free" );
			
		}else if( $GLOBALS['ec_cart_data']->cart_data->shipping_method == "promo_free" ){
			$promotion = new ec_promotion( );
			$shipping_method = $promotion->get_free_shipping_promo_label( $this->cart );
			
		}else if( $this->cart->shipping_subtotal <= 0 ){
			$shipping_method = "";
        
		}else if( $this->shipping->shipping_method == "fraktjakt" ){
			$shipping_method = $this->shipping->get_selected_shipping_method( );
			
		}else if( $GLOBALS['ec_cart_data']->cart_data->shipping_method != "" && $GLOBALS['ec_cart_data']->cart_data->shipping_method != "standard" ){
			$db = new ec_db( );
            $shipping_method = $db::get_shipping_method_name( $GLOBALS['ec_cart_data']->cart_data->shipping_method );
		
        }else if( ( $this->shipping->shipping_method == "price" || $this->shipping->shipping_method == "weight" ) && $GLOBALS['ec_cart_data']->cart_data->expedited_shipping != "" ){
			$shipping_method = $GLOBALS['language']->get_text( "cart_estimate_shipping", "cart_estimate_shipping_express" );
		
        }else{
			$shipping_method = $GLOBALS['language']->get_text( "cart_estimate_shipping", "cart_estimate_shipping_standard" );
        
        }
        
		// Check for NULL rate in poor setups
		if( !$shipping_method ){
			$shipping_method = "";
        }
        
        /* Tax Items */
        $tax_items = $this->tax->get_square_tax_rates( $this->cart->taxable_subtotal, $this->cart->vat_subtotal, ( $this->order_totals->tax_total / ( $this->cart->taxable_subtotal - $this->order_totals->discount_total ) ) );
        
        /* Line Items */
        $line_items = array( );
        for( $i=0; $i<count( $this->cart->cart ); $i++ ){
            $line_item = array(
                'quantity'          => (string) $this->cart->cart[$i]->quantity,
                'base_price_money'  => array(
                    'amount'        => (int) number_format( $this->cart->cart[$i]->unit_price * 100, 0, '', '' ),
                    'currency'      => (string) get_option( 'ec_option_square_currency' )
                ),
                'name'              => (string) $this->cart->cart[$i]->title,
                'applied_taxes'     => array( )
            );
            
            for( $j=0; $j<count( $tax_items ); $j++ ){
                if( $tax_items[$j][3] == 'tax' && $this->cart->cart[$i]->is_taxable ){
                    $line_item['applied_taxes'][] = array(
                        'tax_uid'   => (string) 'tax-'.$j
                    );
                    
                }else if( $tax_items[$j][3] == 'vat' && $this->cart->cart[$i]->vat_enabled ){
                    $line_item['applied_taxes'][] = array(
                        'tax_uid'   => (string) 'tax-'.$j
                    );
                    
                }
                
            }
            
            if( $this->cart->cart[$i]->use_advanced_optionset && count( $this->cart->cart[$i]->advanced_options ) > 0 ){
                
                $line_item['modifiers'] = array( );
                foreach( $this->cart->cart[$i]->advanced_options as $advanced_option ){
                    $line_item['modifiers'][]  = array(
                        'base_price_money'      => array(
                            'amount'            => (int) 0,
                            'currency'          => (string) get_option( 'ec_option_square_currency' )
                        ),
                        'name'                  => (string) $advanced_option->optionitem_name
                    );
                    
                    if( $advanced_option->optionitem_price_onetime != 0 ){
                        $line_item_modifier = array(
                            'quantity'          => '1',
                            'base_price_money'  => array(
                                'amount'        => (int) number_format( $advanced_option->optionitem_price_onetime * 100, 0, '', '' ),
                                'currency'      => (string) get_option( 'ec_option_square_currency' )
                            ),
                            'name'              => (string) $advanced_option->optionitem_name,
                            'applied_taxes'     => $line_item['applied_taxes']
                        );
                        $line_items[]           =  $line_item_modifier;
                    }
                }
                
                
            }else if( $this->cart->cart[$i]->optionitem1_id || $this->cart->cart[$i]->optionitem2_id || $this->cart->cart[$i]->optionitem3_id || $this->cart->cart[$i]->optionitem4_id || $this->cart->cart[$i]->optionitem5_id ){
                
                $line_item['modifiers'] = array( );
                
                if( $this->cart->cart[$i]->optionitem1_id ){
                    $line_item['modifiers'][]  = array(
                        'base_price_money'      => array(
                            'amount'            => (int) 0,
                            'currency'          => (string) get_option( 'ec_option_square_currency' )
                        ),
                        'name'                  => (string) $this->cart->cart[$i]->optionitem1_name
                    );
                }
                
                if( $this->cart->cart[$i]->optionitem2_id ){
                    $line_item['modifiers'][]  = array(
                        'base_price_money'      => array(
                            'amount'            => (int) 0,
                            'currency'          => (string) get_option( 'ec_option_square_currency' )
                        ),
                        'name'                  => (string) $this->cart->cart[$i]->optionitem2_name
                    );
                }
                
                if( $this->cart->cart[$i]->optionitem3_id ){
                    $line_item['modifiers'][]  = array(
                        'base_price_money'      => array(
                            'amount'            => (int) 0,
                            'currency'          => (string) get_option( 'ec_option_square_currency' )
                        ),
                        'name'                  => (string) $this->cart->cart[$i]->optionitem3_name
                    );
                }
                
                if( $this->cart->cart[$i]->optionitem4_id ){
                    $line_item['modifiers'][]  = array(
                        'base_price_money'      => array(
                            'amount'            => (int) 0,
                            'currency'          => (string) get_option( 'ec_option_square_currency' )
                        ),
                        'name'                  => (string) $this->cart->cart[$i]->optionitem4_name
                    );
                }
                
                if( $this->cart->cart[$i]->optionitem5_id ){
                    $line_item['modifiers'][]  = array(
                        'base_price_money'      => array(
                            'amount'            => (int) 0,
                            'currency'          => (string) get_option( 'ec_option_square_currency' )
                        ),
                        'name'                  => (string) $this->cart->cart[$i]->optionitem5_name
                    );
                }
                
            }
            
            $line_items[]           = $line_item;
        }
        
        $json_arr = array( 	
            "idempotency_key"		    => uniqid( ),
            "order"                     => array(
                'location_id'           => $location_id,
                'line_items'            => $line_items,
                'reference_id'          => (string) $this->order_id,
                'fulfillments'          => array(
                    array(
                        'shipment_details'  => array(
                            'recipient'     => array(
                                'address'       => array(
                                    'address_line_1'	=> (string) $this->user->shipping->address_line_1,
                                    'address_line_2'	=> (string) $this->user->shipping->address_line_2,
                                    'locality'			=> (string) $this->user->shipping->city,
                                    'administrative_district_level_1'	=> (string) $this->user->shipping->state,
                                    'postal_code'		=> (string) $this->user->shipping->zip,
                                    'country'			=> strtoupper( (string) $this->user->shipping->country )
                                ),
                                'display_name'  => (string) $this->user->shipping->first_name . ' ' . $this->user->shipping->last_name,
                                'email_address' => (string) $this->user->email,
                                'phone_number'  => (string) $this->user->shipping->phone
                            ),
                            'shipping_note' => $shipping_method
                        ),
                        'type'              => 'SHIPMENT',
                        'state'             => 'PROPOSED'
                    )
                )
            )
        );
        
        $service_charges = array( );
        
        if( $this->order_totals->shipping_total > 0 ){
            $service_charge = array(
                'amount_money'  => array(
                    'amount'        => (int) number_format( $this->order_totals->shipping_total * 100, 0, '', '' ),
                    'currency'      => (string) get_option( 'ec_option_square_currency' )
                ),
                'name'              => (string) $GLOBALS['language']->get_text( 'cart_totals', 'cart_totals_shipping' ),
                'calculation_phase' => 'SUBTOTAL_PHASE',
                'applied_taxes'     => array( ),
                'taxable'           => (bool) !get_option( 'ec_option_no_vat_on_shipping' )
            );
            if( !get_option( 'ec_option_no_vat_on_shipping' ) ){
                $this->cart->vat_subtotal += $this->order_totals->shipping_total;
                for( $j=0; $j<count( $tax_items ); $j++ ){
                    if( $tax_items[$j][3] == 'vat' ){
                        $service_charge['applied_taxes'][] = array(
                            'tax_uid'   => (string) 'tax-'.$j
                        );

                    }

                }
            }
            $service_charges[] = $service_charge;
        }
        
        if( $this->order_totals->tip_total > 0 ){
            $tip_charge = array(
                'amount_money'  => array(
                    'amount'        => (int) number_format( $this->order_totals->tip_total * 100, 0, '', '' ),
                    'currency'      => (string) get_option( 'ec_option_square_currency' )
                ),
                'name'              => (string) $GLOBALS['language']->get_text( 'cart_totals', 'cart_totals_tip' ),
                'calculation_phase' => 'TOTAL_PHASE',
                'applied_taxes'     => array( ),
                'taxable'           => (bool) false
            );
            $service_charges[] = $tip_charge;
        }
        
        if( count( $service_charges ) ){
            $json_arr['order']['service_charges'] = $service_charges;
        }
        
        if( $this->order_totals->discount_total > 0 ){
            $json_arr['order']['discounts'] = array(
                array(
                    'amount_money'      => array(
                        'amount'        => $this->order_totals->discount_total * 100,
                        'currency'      => (string) get_option( 'ec_option_square_currency' ),
                        'name'          => $GLOBALS['language']->get_text( 'cart_totals', 'cart_totals_discounts' )
                    )
                )
            );
        }
        
        if( count( $tax_items ) ){
            $taxcount=0;
            $json_arr['order']['taxes']         = array( );
            foreach( $tax_items as $tax_item ){
                $json_arr['order']['taxes'][]   = array(
                    'applied_money'             => array(
                        'amount'                => ( $tax_item[3] == 'tax' ) ? (int) ( $this->cart->taxable_subtotal * 100 ) : (int) ( $this->cart->vat_subtotal * 100 ),
                        'currency'              => (string) get_option( 'ec_option_square_currency' ),
                    ),
                    'name'                      => (string) $tax_item[0],
                    'percentage'                => (string) $tax_item[1],
                    'scope'                     => 'LINE_ITEM',
                    'type'                      => (string) $tax_item[2],
                    'uid'                       => (string) 'tax-'.$taxcount
                );
                $taxcount++;
            }
            
        }
        
        return $json_arr;
    }
    
    function process_order_response( $response ){
		
		$response_arr = json_decode( $response );
		
		// Check for errors
        if( isset( $response_arr->errors ) && count( $response_arr->errors ) > 0 ){
			return false;
		
        // Check for problems between totals
        }else if( $response_arr->order->total_money->amount != (integer) number_format( $this->order_totals->grand_total * 100, 0, "", "" ) ){
            return false;
        
        // Success, send back order id
        }else{
			return $response_arr->order->id;
            
		}
			
	}
	
	function get_location_id( ){
		$access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
		$location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
		
        $headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
        $url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/locations" : "https://connect.squareup.com/v2/locations";
        
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, false ); 
		curl_setopt($ch, CURLOPT_HTTPGET, true );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
		$response = curl_exec($ch);
		if( $response === false )
			$this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
		else
			$this->mysqli->insert_response( 0, 0, "Square Location Response", print_r( $response, true ) );
		
		curl_close ($ch);
		
		$response_arr = json_decode( $response );
		
        if( !$location_id && isset( $response_arr->locations ) && count( $response_arr->locations ) > 0 ){
            if( get_option( 'ec_option_square_is_sandbox' ) ){
                update_option( 'ec_option_square_sandbox_location_id', $response_arr->locations[0]->id );
            }else{
                update_option( 'ec_option_square_location_id', $response_arr->locations[0]->id );
            }
        }
		
		return $response_arr->locations[0]->id;
	}
	
	function set_currency( ){
		$locations = $this->get_locations( );
		if( count( $locations ) > 0 ){
			$found = false;
			for( $i=0; $i<count( $locations ); $i++ ){
				if( $locations[$i]->id == get_option( 'ec_option_square_location_id' ) ){
					$found = true;
					update_option( 'ec_option_square_currency', $locations[$i]->currency );
				}
			}
			if( !$found ){
				update_option( 'ec_option_square_currency', $locations[0]->currency );
			}
		}else{
			update_option( 'ec_option_square_currency', 'USD' );
		}
	}
	
	function get_locations( ){
		$access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
		$location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
		
        $headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/locations" : "https://connect.squareup.com/v2/locations";
        
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, false ); 
		curl_setopt($ch, CURLOPT_HTTPGET, true );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
		$response = curl_exec($ch);
		if( $response === false )
			$this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
		else
			$this->mysqli->insert_response( 0, 0, "Square Locations Response", print_r( $response, true ) );
		
		curl_close ($ch);
		
		$response_arr = json_decode( $response );
		
        if( !$location_id && isset( $response_arr->locations ) && count( $response_arr->locations ) > 0 ){
            if( get_option( 'ec_option_square_is_sandbox' ) ){
                update_option( 'ec_option_square_sandbox_location_id', $response_arr->locations[0]->id );
            }else{
                update_option( 'ec_option_square_location_id', $response_arr->locations[0]->id );
            }
        }
		
		return $response_arr->locations;
	}
	
	function refund_charge( $transaction_id, $refund_amount ){
		
		if( get_option( 'ec_option_square_application_id' ) == '' ){
			$this->renew_token( );
		}
		
		$ids = json_decode( $transaction_id );
        
        // V2
        if( isset( $ids->payment_id ) ){
            return $this->refund_charge_payment( $ids->payment_id, $refund_amount );
        
        // V1
        }else{
            $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
            $gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/locations/" . $location_id . "/transactions/" . $ids->transaction_id . "/refund" : "https://connect.squareup.com/v2/locations/" . $location_id . "/transactions/" . $ids->transaction_id . "/refund";
            $gateway_data = array( 	"idempotency_key"	=> uniqid( ),
                                    "tender_id"			=> $ids->tender_id,
                                    "amount_money"		=> array(
                                        "amount"			=> (integer) number_format( $refund_amount * 100, 0, "", "" ),
                                        "currency"			=> get_option( 'ec_option_square_currency' )
                                    )
                            );

            $headr = array();
            $headr[] = 'Accept: application/json';
            $headr[] = 'Content-Type: application/json';
            $headr[] = 'Authorization: Bearer ' . $access_token;
            $headr[] = 'Square-Version: 2019-10-23';

            $ch = curl_init( );
            curl_setopt($ch, CURLOPT_URL, $gateway_url );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
            curl_setopt($ch, CURLOPT_POST, true ); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
            curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
            curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
            $response = curl_exec($ch);
            if( $response === false )
                $this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
            else
                $this->mysqli->insert_response( 0, 0, "Square Refund Response", print_r( $response, true ) );

            curl_close ($ch);

            $response_arr = json_decode( $response );

            if( isset( $response_arr->errors ) && count( $response_arr->errors ) > 0 ){
                return false;
            }else{
                return true;
            }
        }
	}
    
    function refund_charge_payment( $payment_id, $refund_amount ){
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
            $location_id = $this->get_location_id( );
        }
        
        $gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/refunds" : "https://connect.squareup.com/v2/refunds";
        $gateway_data = array( 	"idempotency_key"	=> uniqid( ),
                                "payment_id"			=> $payment_id,
                                "amount_money"		=> array(
                                    "amount"			=> (integer) number_format( $refund_amount * 100, 0, "", "" ),
                                    "currency"			=> get_option( 'ec_option_square_currency' )
                                )
                        );

        $headr = array();
        $headr[] = 'Accept: application/json';
        $headr[] = 'Content-Type: application/json';
        $headr[] = 'Authorization: Bearer ' . $access_token;
        $headr[] = 'Square-Version: 2019-10-23';

        $ch = curl_init( );
        curl_setopt($ch, CURLOPT_URL, $gateway_url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
        curl_setopt($ch, CURLOPT_POST, true ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
        curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
        $response = curl_exec($ch);
        if( $response === false )
            $this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
        else
            $this->mysqli->insert_response( 0, 0, "Square Refund Payment Response", print_r( $response, true ) );

        curl_close ($ch);

        $response_arr = json_decode( $response );

        if( isset( $response_arr->errors ) && count( $response_arr->errors ) > 0 ){
            return false;
        }else{
            return true;
        }
    }
	
	function renew_token( ){
        
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        $refresh_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_refresh_token' ) : get_option( 'ec_option_square_sandbox_refresh_token' );
        $ch = curl_init( );
        $url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.wpeasycart.com/square-sandbox/refresh.php?access_token=" . $access_token . "&refreshv2=true" : "https://connect.wpeasycart.com/square/refresh.php?access_token=" . $access_token . "&refreshv2=true";
        if( $refresh_token && $refresh_token != '' ){
            $url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.wpeasycart.com/square-sandbox/refresh.php?refresh_token=" . $refresh_token : "https://connect.wpeasycart.com/square/refresh.php?refresh_token=" . $refresh_token;
        }
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec( $ch );
        if( $response === false) {
            $response = file_get_contents( $url );
        }

        if( $response === false )
            ( get_option( 'ec_option_square_is_sandbox' ) ) ? $this->mysqli->insert_response( 0, 1, "SQUARE SANDBOX RENEW TOKEN ERROR", curl_error( $ch ) ) : $this->mysqli->insert_response( 0, 1, "SQUARE RENEW TOKEN ERROR", curl_error( $ch ) );
        else
            ( get_option( 'ec_option_square_is_sandbox' ) ) ? $this->mysqli->insert_response( 0, 0, "Square Sandbox Renew Token Response", print_r( $response, true ) ) : $this->mysqli->insert_response( 0, 0, "Square Renew Token Response", print_r( $response, true ) );

        curl_close( $ch );
        if( $response ){
            $json = json_decode( $response );
            $response_obj = json_decode( $response );

            if( isset( $response_obj->access_token ) && $response_obj->access_token && strlen( $response_obj->access_token ) > 0 ){
                $access_token = preg_replace( "/[^A-Za-z0-9 \-\._\~\+\/]/", '', $response_obj->access_token );
                ( get_option( 'ec_option_square_is_sandbox' ) ) ? update_option( 'ec_option_square_sandbox_access_token', $access_token ) : update_option( 'ec_option_square_access_token', $access_token );
            }

            if( isset( $response_obj->expires_at ) && $response_obj->expires_at && strlen( $response_obj->expires_at ) > 0 ){
                $expires = preg_replace( "/[^A-Za-z0-9 \:\-]/", '', $response_obj->expires_at );
                ( get_option( 'ec_option_square_is_sandbox' ) ) ? update_option( 'ec_option_square_sandbox_token_expires', $expires ) : update_option( 'ec_option_square_token_expires', $expires );
            }

            if( isset( $response_obj->refresh_token ) && $response_obj->refresh_token && strlen( $response_obj->refresh_token ) > 0 ){
                $refresh_token = preg_replace( "/[^A-Za-z0-9 \-\._\~\+\/]/", '', $response_obj->refresh_token );
                ( get_option( 'ec_option_square_is_sandbox' ) ) ? update_option( 'ec_option_square_sandbox_refresh_token', $refresh_token ) : update_option( 'ec_option_square_refresh_token', $refresh_token );
            }
        }
	}
    
    function get_modifiers( $cursor = false, $depth = 0 ){
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
		
		$gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/catalog/search" : "https://connect.squareup.com/v2/catalog/search";
        
        $gateway_data = array(
            'object_types'  => array( 'MODIFIER' ),
            'limit'         => 5
        );
		if( $cursor ){
			 $gateway_data['cursor'] = $cursor;
        }
		$headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)10);
		$response = curl_exec($ch);
		if( $response === false ){
			$response = 'error';
			$this->mysqli->insert_response( 0, 1, "SQUARE Modifers CURL ERROR", curl_error( $ch ) );
        }else{
			$this->mysqli->insert_response( 0, 0, "Square Modifier Response", print_r( $response, true ) );
        }
    
		curl_close ($ch);
		
		if( $response == 'error' && $depth < 5 ){
            sleep(3);
            return $this->get_modifiers( $cursor, $depth+1 );
        }else if( $response == 'error' ){
            return false;
        }
		
		return json_decode( $response );
		
    }
    
    function get_modifier_items( $cursor = false, $depth = 0 ){
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
		
		$gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/catalog/search" : "https://connect.squareup.com/v2/catalog/search";
        
        $gateway_data = array(
            'object_types'  => array( 'MODIFIER_LIST' ),
            'limit'         => 5
        );
		if( $cursor ){
			 $gateway_data['cursor'] = $cursor;
        }
		$headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)10);
		$response = curl_exec($ch);
		if( $response === false ){
			$response = 'error';
			$this->mysqli->insert_response( 0, 1, "SQUARE Modifer List CURL ERROR", curl_error( $ch ) );
        }else{
			$this->mysqli->insert_response( 0, 0, "Square Modifier List Response", print_r( $response, true ) );
        }
        
		curl_close ($ch);
		
		if( $response == 'error' && $depth < 5 ){
            sleep(3);
            return $this->get_modifier_items( $cursor, $depth+1 );
        }else if( $response == 'error' ){
            return false;
        }
		
		return json_decode( $response );
		
    }
	
	function get_catalog( $cursor = false, $depth = 0 ){
		
		$access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
        
		$gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/catalog/search" : "https://connect.squareup.com/v2/catalog/search";
        
        $gateway_data = array(
            'object_types'  => array( 'ITEM', 'CATEGORY' ),
            'limit'         => 5
        );
		if( $cursor ){
			 $gateway_data['cursor'] = $cursor;
        }
		$headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)10);
		$response = curl_exec($ch);
		if( $response === false ){
			$response = 'error';
			$this->mysqli->insert_response( 0, 1, "SQUARE Catalog CURL ERROR", curl_error( $ch ) );
        }else{
			$this->mysqli->insert_response( 0, 0, "Square Catalog Response", print_r( $response, true ) );
        }
        
		curl_close ($ch);
		
		if( $response == 'error' && $depth < 5 ){
            sleep(3);
            return $this->get_catalog( $cursor, $depth+1 );
        }else if( $response == 'error' ){
            return false;
        }
		
		return json_decode( $response );
		
	}
    
    function insert_option( $object, $sync = false ){
        if( $this->allowed_at_location( $object ) && !$object->is_deleted ){
			global $wpdb;
            if( $sync ){
                $option = $wpdb->get_row( $wpdb->prepare( "SELECT FROM ec_option WHERE stripe_id = %s", $object->id ) );
                if( $option ){
                    return $this->update_option( $object, $option );
                }
            }
            
            $option_name = $object->modifier_list_data->name;
            $selection_type = $object->modifier_list_data->selection_type;
            $option_type = 'basic-combo';
            if( $selection_type == 'MULTIPLE' ){
                // Some day handle this?
            }
            
            $wpdb->query( $wpdb->prepare( "INSERT INTO ec_option( option_name, option_label, option_type, square_id ) VALUES( %s, %s, %s, %s )", $option_name . " Variation", $option_name, $option_type, $object->id ) );
            $option_id = $wpdb->insert_id;
            foreach( $object->modifier_list_data->modifiers as $modifier ){
                $this->insert_option_item( $modifier, $option_id, $sync );
            }
            
            return array( 'success' => 'option-inserted' );
        }
    }
    
    function update_option( $object, $option ){
        global $wpdb;
        $wpdb->query( $wpdb->prepare( "UPDATE ec_option SET option_name = %s, option_label = %s WHERE option_id = %d", $object->name . " Modifier", $object->name, $option->option_id ) );
        return array( 'success' => 'option-updated' );
    }
    
    function insert_option_item( $object, $option_id, $sync = false ){
        if( $this->allowed_at_location( $object ) && !$object->is_deleted ){
			global $wpdb;
            if( $sync ){
                $optionitem = $wpdb->get_row( $wpdb->prepare( "SELECT FROM ec_optionitem WHERE stripe_id = %s", $object->id ) );
                if( $optionitem ){
                    return $this->update_option_item( $object, $optionitem );
                }
            }
            $optionitem_name = $object->modifier_data->name;
            $optionitem_price = $object->modifier_data->price_money->amount;
            $initially_selected = $object->modifier_data->on_by_default;
            $sort_order = $object->modifier_data->ordinal;
            
            $wpdb->query( $wpdb->prepare( "INSERT INTO ec_optionitem( optionitem_name, optionitem_price, optionitem_initially_selected, optionitem_order, option_id, square_id ) VALUES( %s, %s, %d, %d, %d, %s )", $optionitem_name, $optionitem_price / 100, $initially_selected, $sort_order, $option_id, $object->id ) );
            return array( 'success' => 'optionitem-inserted' );
        }
    }
    
    function update_option_item( $object, $optionitem ){
        global $wpdb;
        $wpdb->query( $wpdb->prepare( "UPDATE ec_optionitem SET optionitem_name = %s, optionitem_price = %s, optionitem_initially_selected = %d, optionitem_order = %d WHERE optionitem_id = %d", $optionitem_name, $optionitem_price / 100, $initially_selected, $sort_order, $optionitem->optionitem_id ) );
        return array( 'success' => 'optionitem-updated' );
    }
	
	function insert_category( $object, $sync = false ){
		if( $this->allowed_at_location( $object ) && !$object->is_deleted ){
			global $wpdb;
		
			$featured_category = 1;
			$category_name = stripslashes_deep( $object->category_data->name );
			$priority = 0;
			$parent_id = 0;
			$image = "";
			$short_description = "";
			$square_id = $object->id;
            
            if( $sync ){
                $category = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ec_category WHERE square_id = %s", $square_id ) );
                if( $category ){
                    return $this->update_category( $object, $category );
                }
            }
            
            $wpdb->query( $wpdb->prepare( "INSERT INTO ec_category( featured_category, category_name, parent_id, image, short_description, priority, square_id ) VALUES( %d, %s, %d, %s, %s, %d, %s )", $featured_category, $category_name, $parent_id, $image, $short_description, $priority, $square_id ) );
            $category_id = $wpdb->insert_id;
            
			$post = array(	
				'post_content'	=> "[ec_store groupid=\"" . $category_id . "\"]",
				'post_status'	=> "publish",
				'post_title'	=> $GLOBALS['language']->convert_text( $category_name ),
				'post_type'		=> "ec_store"
			);
			$post_id = wp_insert_post( $post );
			$wpdb->query( $wpdb->prepare( "UPDATE ec_category SET post_id = %d WHERE category_id = %d", $post_id, $category_id ) );
			
			return array( 'success' => 'category-inserted' );
		}
	}
    
    function update_category( $object, $category ){
        global $wpdb;
		
        $featured_category = 1;
        $category_name = stripslashes_deep( $object->category_data->name );
        $priority = 0;
        $parent_id = 0;
        $image = "";
        $short_description = "";
        $square_id = $object->id;

        $wpdb->query( $wpdb->prepare( "UPDATE ec_category SET category_name = %s WHERE square_id = %s", $category_name, $square_id ) );
        
        $post = array(
            'ID'            => $category->post_id,
            'post_content'	=> "[ec_store groupid=\"" . $category->category_id . "\"]",
            'post_status'	=> "publish",
            'post_title'	=> $GLOBALS['language']->convert_text( $category_name ),
            'post_type'		=> "ec_store"
        );
        wp_update_post( $post );

        return array( 'success' => 'category-updated' );
    }
	
	function insert_product( $object, $sync = false ){
		if( $this->allowed_at_location( $object ) && !$object->is_deleted ){
			global $wpdb;
			$square_id = $object->id;
            
            if( $sync ){
                $product = $wpdb->get_row( $wpdb->prepare( "SELECT product_id, post_id, option_id_1, model_number FROM ec_product WHERE square_id = %s", $square_id ) );
                if( $product ){
                    return $this->update_product( $object, $product );
                }
            }
            
            $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
			if( !$location_id ){
                $location_id = $this->get_location_id( );
            }
            
			$activate_in_store = 1;
			$post_status = ( $activate_in_store ) ? 'publish' : 'private';
			
			$title = $object->item_data->name;
			$description = $object->item_data->description;
			$image1 = $this->get_image_url( $object->image_id );
            $option_items = array( );
			if( $object->item_data->variations )
				$option_items = $object->item_data->variations;
			$is_giftcard = 0;
			$is_shippable = $is_taxable = 1;
			if( $object->product_type == "GIFT_CARD" ){
				$is_giftcard = 1;
			}
			$model_number = rand( 10000000, 99999999 );
            if( $object->item_data->variations[0]->item_variation_data->sku != '' ){
                $model_number = $object->item_data->variations[0]->item_variation_data->sku;
            }
			$base_price = 0;
			$show_stock_quantity = $use_optionitem_quantity_tracking = 0;
            
            if( count( $object->item_data->variations ) > 0 ){
            
                for( $i=0; $i<count( $object->item_data->variations ); $i++ ){

                    if( $this->allowed_at_location( $object->item_data->variations[$i] ) && !$object->item_data->variations[$i]->is_deleted ){

                        if( $base_price == 0 || $base_price > $object->item_data->variations[$i]->item_variation_data->price_money->amount ){
                            $base_price = $object->item_data->variations[$i]->item_variation_data->price_money->amount;
                        }

                        if( isset( $object->item_data->variations[$i]->item_variation_data->location_overrides ) ){
                            for( $j=0; $j<count( $object->item_data->variations[$i]->item_variation_data->location_overrides ); $j++ ){
                                if( $object->item_data->variations[$i]->item_variation_data->location_overrides[$j]->location_id == $location_id ){
                                    if( $object->item_data->variations[$i]->item_variation_data->location_overrides[$j]->track_inventory ){
                                        $use_optionitem_quantity_tracking = 1;
                                    }
                                }
                            }
                        }

                    }
                }
            }
			
			if( $object->product_type == "GIFT_CARD" || $object->product_type == "APPOINTMENTS_SERVICE" ){
				$is_shippable = 0;
			}
			
			$category_stripe_id = $object->item_data->category_id;
			
			// Get a default manufacturer
			$manufacturer_id = $wpdb->get_var( "SELECT manufacturer_id FROM ec_manufacturer" );
			
			// Create Post Slug
			$post_slug = preg_replace( '/(\-+)/', '-', preg_replace( "/[^A-Za-z0-9\-]/", '', str_replace( ' ', '-', stripslashes_deep( strtolower( $title ) ) ) ) );
			while( substr( $post_slug, -1 ) == '-' ){
				$post_slug = substr( $post_slug, 0, strlen( $post_slug ) - 1 );
			}
			while( substr( $post_slug, 0, 1 ) == '-' ){
				$post_slug = substr( $post_slug, 1, strlen( $post_slug ) );
			}
			if( $post_slug == '' ){
				$post_slug = rand( 1000000, 9999999 );
			}
			
			// Get URL
			$store_page = get_permalink( get_option( 'ec_option_storepage' ) );
			if( strstr( $store_page, '?' ) )									$guid = $store_page . '&model_number=' . $model_number;
			else if( substr( $store_page, strlen( $store_page ) - 1 ) == '/' )	$guid = $store_page . $post_slug;
			else																$guid = $store_page . '/' . $post_slug;
			
			$guid = strtolower( $guid );
			$post_slug_orig = $post_slug;
			$guid_orig = $guid;
			$guid = $guid . '/';
			
			/* Fix for Duplicate GUIDs */
			$i=1;
			while( $guid_check = $wpdb->get_row( $wpdb->prepare( "SELECT " . $wpdb->prefix . "posts.guid FROM " . $wpdb->prefix . "posts WHERE " . $wpdb->prefix . "posts.guid = %s", $guid ) ) ){
				$guid = $guid_orig . '-' . $i . '/';
				$post_slug = $post_slug_orig . '-' . $i;
				$i++;
			}
            
            /* Fix duplicate model number */
            $model_number_orig = $model_number;
			$i=1;
			while( $model_check = $wpdb->get_row( $wpdb->prepare( "SELECT model_number FROM ec_product WHERE ec_product.model_number = %s", $model_number ) ) ){
				$model_number = $model_number_orig . '-' . $i;
				$i++;
			}
			
			/* Manually Insert Post */
			$wpdb->query( $wpdb->prepare( "INSERT INTO " . $wpdb->prefix . "posts( post_content, post_status, post_title, post_name, guid, post_type, post_excerpt, post_date, post_date_gmt, post_modified, post_modified_gmt, comment_status ) VALUES( %s, %s, %s, %s, %s, %s, %s, NOW( ), UTC_TIMESTAMP( ), NOW( ), UTC_TIMESTAMP( ), 'closed' )", "[ec_store modelnumber=\"" . $model_number . "\"]", $post_status, $GLOBALS['language']->convert_text( $title ), $post_slug, $guid, "ec_store", '' ) );
			$post_id = $wpdb->insert_id;
			
			// Insert product
			$wpdb->query( $wpdb->prepare( "INSERT INTO ec_product( activate_in_store, show_on_startup, post_id, manufacturer_id, title, model_number, description, price, image1, is_giftcard, is_shippable, is_taxable, show_stock_quantity, square_id ) VALUES( %d, %d, %d, %d, %s, %s, %s, %s, %s, %d, %d, %d, 0, %s )", $activate_in_store, 1, $post_id, $manufacturer_id, $title, $model_number, $description, $base_price / 100, $image1, $is_giftcard, $is_shippable, $is_taxable, $square_id ) );
			$product_id = $wpdb->insert_id;
            
            // Maybe insert option set
			$option_id = 0;
            $stock_quantity = 0;
			if( count( $option_items ) > 1 ){
				$optionitem_added_count = 0;
				$wpdb->query( $wpdb->prepare( "INSERT INTO ec_option( option_name, option_label, option_type ) VALUES( %s, %s, 'basic-combo' )", $title . " Variation", $title ) );
				$option_id = $wpdb->insert_id;
				foreach( $option_items as $optionitem ){
					if( $this->allowed_at_location( $optionitem ) && !$optionitem->is_deleted ){
						$option_item_quantity = 0;
						$price = 0;
                        $optionitem_model_number = $optionitem->item_variation_data->sku;
                        if( $optionitem->item_variation_data->sku == $model_number ){
                            $optionitem_model_number = '';
                        }
                        if( $optionitem->item_variation_data->price_money->amount > $base_price ){
							$price = $optionitem->item_variation_data->price_money->amount - $base_price;
						}
						$wpdb->query( $wpdb->prepare( "INSERT INTO ec_optionitem( option_id, optionitem_name, optionitem_price, optionitem_order, optionitem_model_number, square_id ) VALUES( %d, %s, %s, %d, %s, %s )", $option_id, $optionitem->item_variation_data->name, $price / 100, $optionitem_added_count, $optionitem_model_number, $optionitem->id ) );
                        $optionitem_id = $wpdb->insert_id;
                        if( $use_optionitem_quantity_tracking ){
                            $option_item_quantity = 10000;
                            if( isset( $optionitem->item_variation_data->location_overrides ) ){
                                for( $j=0; $j<count( $optionitem->item_variation_data->location_overrides[$j] ); $j++ ){
                                    if( $optionitem->item_variation_data->location_overrides[$j]->location_id == $location_id ){
                                        if( $optionitem->item_variation_data->location_overrides[$j]->track_inventory ){
                                            $option_item_quantity = $this->get_variance_stock_quantity( $optionitem->id );
                                        }
                                    }
                                }
                            }
                            $stock_quantity += $option_item_quantity;
                            $wpdb->query( $wpdb->prepare( "INSERT INTO ec_optionitemquantity( product_id, optionitem_id_1, quantity ) VALUES( %d, %d, %s )", $product_id, $optionitem_id, $option_item_quantity ) );
                        }
						$optionitem_added_count++;
					}
				}
				
				if( $optionitem_added_count == 0 ){
					$wpdb->query( $wpdb->prepare( "DELETE FROM ec_option WHERE option_id = %d", $option_id ) );
					$option_id = 0;
				}
            
            // When only 1 option item, we apply the price adjustment and quantity to the base product
			}else if( count( $option_items ) == 1 && $use_optionitem_quantity_tracking ){
                $show_stock_quantity = 1;
                $use_optionitem_quantity_tracking = 0;
                $stock_quantity = $this->get_variance_stock_quantity( $option_items[0]->id );
			}
            
            // Maybe add quantity data
            if( $use_optionitem_quantity_tracking && $option_id ){
                $wpdb->query( $wpdb->prepare( "UPDATE ec_product SET use_optionitem_quantity_tracking = 1, option_id_1 = %d, stock_quantity = %d WHERE product_id = %d", $option_id, $stock_quantity, $product_id ) );
            
            }else if( $show_stock_quantity ){
                $wpdb->query( $wpdb->prepare( "UPDATE ec_product SET show_stock_quantity = 1, option_id_1 = 0, stock_quantity = %d WHERE product_id = %d", $stock_quantity, $product_id ) );
                
            }
            
            // Maybe add Modifiers
            if( isset( $object->item_data->modifier_list_info ) ){
                $options = array( );
                if( $option_id != 0 ){
                    $options[] = $option_id;
                }
                foreach( $object->item_data->modifier_list_info as $modifier ){
                    $option_id = $wpdb->get_var( $wpdb->prepare( "SELECT option_id FROM ec_option WHERE square_id = %s", $modifier->modifier_list_id ) );
                    if( $option_id ){
                        $options[] = $option_id;
                    }
                }
                $option_id_1 = $option_id_2 = $option_id_3 = $option_id_4 = $option_id_5 = 0;
                if( count( $options ) > 0 ){
                    $option_id_1 = $options[0];
                }
                if( count( $options ) > 1 ){
                    $option_id_2 = $options[1];
                }
                if( count( $options ) > 2 ){
                    $option_id_3 = $options[2];
                }
                if( count( $options ) > 3 ){
                    $option_id_4 = $options[3];
                }
                if( count( $options ) > 4 ){
                    $option_id_5 = $options[4];
                }
                $use_quantity_tracking = ( $use_optionitem_quantity_tracking || $show_stock_quantity ) ? 1 : 0;
                $wpdb->query( $wpdb->prepare( "UPDATE ec_product SET option_id_1 = %d, option_id_2 = %d, option_id_3 = %d, option_id_4 = %d, option_id_5 = %d, use_optionitem_quantity_tracking = 0, show_stock_quantity = %d WHERE product_id = %d", $option_id_1, $option_id_2, $option_id_3, $option_id_4, $option_id_5, $use_quantity_tracking, $product_id ) );
            }
			
			// Maybe add product to category
			if( $category_stripe_id ){
				$category_id = $wpdb->get_var( $wpdb->prepare( "SELECT category_id FROM ec_category WHERE square_id = %s", $category_stripe_id ) );
				if( $category_id ){
					$wpdb->query( $wpdb->prepare( "INSERT INTO ec_categoryitem( category_id, product_id ) VALUES( %d, %d )", $category_id, $product_id ) );
				}
			}
		}
	}
    
    function update_product( $object, $product ){
        global $wpdb;
        $square_id = $object->id;

        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
            $location_id = $this->get_location_id( );
        }
        
        $title = $object->item_data->name;
        $description = $object->item_data->description;
        $image1 = $this->get_image_url( $object->image_id );
        $option_items = array( );
        if( $object->item_data->variations )
            $option_items = $object->item_data->variations;
        $base_price = 0;
        $show_stock_quantity = $use_optionitem_quantity_tracking = 0;
        
        $model_number = $product->model_number;
        if( $object->item_data->variations[0]->item_variation_data->sku != '' ){
            $model_number = $object->item_data->variations[0]->item_variation_data->sku;
        }

        if( count( $object->item_data->variations ) > 0 ){
            
            for( $i=0; $i<count( $object->item_data->variations ); $i++ ){
                
                if( $this->allowed_at_location( $object->item_data->variations[$i] ) && !$object->item_data->variations[$i]->is_deleted ){
                    
                    if( $base_price == 0 || $base_price > $object->item_data->variations[$i]->item_variation_data->price_money->amount ){
                        $base_price = $object->item_data->variations[$i]->item_variation_data->price_money->amount;
                    }
                    
                    if( isset( $object->item_data->variations[$i]->item_variation_data->location_overrides ) ){
                        for( $j=0; $j<count( $object->item_data->variations[$i]->item_variation_data->location_overrides ); $j++ ){
                            if( $object->item_data->variations[$i]->item_variation_data->location_overrides[$j]->location_id == $location_id ){
                                if( $object->item_data->variations[$i]->item_variation_data->location_overrides[$j]->track_inventory ){
                                    $use_optionitem_quantity_tracking = 1;
                                }
                            }
                        }
                    }
                    
                }
            }
        }

        $category_stripe_id = $object->item_data->category_id;

        /* Manually Update Post */
        $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "posts SET post_title = %s, post_modified = NOW( ), post_modified_gmt = UTC_TIMESTAMP( ) WHERE ID = %d", $GLOBALS['language']->convert_text( $title ), $product->post_id ) );
        
        // Update product
        $wpdb->query( $wpdb->prepare( "UPDATE ec_product SET model_number = %s, title = %s, description = %s, price = %s, image1 = %s, show_stock_quantity = 0 WHERE product_id = %d", $model_number, $title, $description, $base_price / 100, $image1, $product->product_id ) );
        $product_id = $product->product_id;
        
        // Maybe insert option set
        $option_id = 0;
        $stock_quantity = 0;
        $wpdb->query( $wpdb->prepare( "DELETE FROM ec_optionitemquantity WHERE product_id = %d", $product_id ) );
        if( count( $option_items ) > 1 ){
            $optionitem_added_count = 0;
            $option_id = $product->option_id_1;
            if( $option_id == 0 ){
                $wpdb->query( $wpdb->prepare( "INSERT INTO ec_option( option_name, option_label, option_type ) VALUES( %s, %s, 'basic-combo' )", $title . " Variation", $title ) );
				$option_id = $wpdb->insert_id;
            }
            $wpdb->query( $wpdb->prepare( "UPDATE ec_option SET option_name = %s, option_label = %s WHERE option_id = %d", $title . " Variation", $title, $option_id ) );
            foreach( $option_items as $optionitem ){
                if( $this->allowed_at_location( $optionitem ) && !$optionitem->is_deleted ){
                    $option_item_quantity = 0;
                    $price = 0;
                    $optionitem_model_number = $optionitem->item_variation_data->sku;
				    if( $optionitem->item_variation_data->sku == $model_number ){
                        $optionitem_model_number = '';
                    }
                    if( $optionitem->item_variation_data->price_money->amount > $base_price ){
                        $price = $optionitem->item_variation_data->price_money->amount - $base_price;
                    }
                    $find_optionitem = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ec_optionitem WHERE option_id = %d AND square_id = %s", $option_id, $optionitem->id ) );
                    if( $find_optionitem ){
                        $wpdb->query( $wpdb->prepare( "UPDATE ec_optionitem SET optionitem_name = %s, optionitem_price = %s, optionitem_order = %d, optionitem_model_number = %s WHERE option_id = %d AND square_id = %s", $optionitem->item_variation_data->name, $price / 100, $optionitem_added_count, $optionitem_model_number, $option_id, $optionitem->id ) );
                        $optionitem_id = $find_optionitem->optionitem_id;
                                                     
                    }else{
                        $wpdb->query( $wpdb->prepare( "INSERT INTO ec_optionitem( option_id, optionitem_name, optionitem_price, optionitem_order, optionitem_model_number, square_id ) VALUES( %d, %s, %s, %d, %s, %s )", $option_id, $optionitem->item_variation_data->name, $price / 100, $optionitem_added_count, $optionitem_model_number, $optionitem->id ) );
                        $optionitem_id = $wpdb->insert_id;
                    }
                    if( $use_optionitem_quantity_tracking ){
                        $option_item_quantity = 10000;
                        if( isset( $optionitem->item_variation_data->location_overrides ) ){
                            for( $j=0; $j<count( $optionitem->item_variation_data->location_overrides[$j] ); $j++ ){
                                if( $optionitem->item_variation_data->location_overrides[$j]->location_id == $location_id ){
                                    if( $optionitem->item_variation_data->location_overrides[$j]->track_inventory ){
                                        $option_item_quantity = $this->get_variance_stock_quantity( $optionitem->id );
                                    }
                                }
                            }
                        }
                        $stock_quantity += $option_item_quantity;
                        $wpdb->query( $wpdb->prepare( "INSERT INTO ec_optionitemquantity( product_id, optionitem_id_1, quantity ) VALUES( %d, %d, %s )", $product_id, $optionitem_id, $option_item_quantity ) );
                    }
                    $optionitem_added_count++;
                }
            }

            if( $optionitem_added_count == 0 ){
                $wpdb->query( $wpdb->prepare( "DELETE FROM ec_option WHERE option_id = %d", $option_id ) );
                $option_id = 0;
            }

        // When only 1 option item, we apply the price adjustment and quantity to the base product
        }else if( count( $option_items ) == 1 ){
            $model_number = $option_items[0]->item_variation_data->sku;
            $price = $option_items[0]->item_variation_data->price_money->amount / 100;
            if( $use_optionitem_quantity_tracking ){
                $show_stock_quantity = 1;
                $use_optionitem_quantity_tracking = 0;
                $stock_quantity = $this->get_variance_stock_quantity( $option_items[0]->id );
            }
        }
            
        // Maybe add quantity data
        if( $use_optionitem_quantity_tracking && $option_id ){
            $wpdb->query( $wpdb->prepare( "UPDATE ec_product SET use_optionitem_quantity_tracking = 1, option_id_1 = %d, stock_quantity = %d WHERE product_id = %d", $option_id, $stock_quantity, $product_id ) );

        }else if( $show_stock_quantity ){
            $wpdb->query( $wpdb->prepare( "UPDATE ec_product SET show_stock_quantity = 1, option_id_1 = 0, stock_quantity = %d WHERE product_id = %d", $stock_quantity, $product_id ) );

        }
        
        // Maybe add Modifiers
        if( isset( $object->item_data->modifier_list_info ) ){
            $options = array( );
            if( $option_id != 0 ){
                $options[] = $option_id;
            }
            foreach( $object->item_data->modifier_list_info as $modifier ){
                $option_id = $wpdb->get_var( $wpdb->prepare( "SELECT option_id FROM ec_option WHERE square_id = %s", $modifier->modifier_list_id ) );
                if( $option_id ){
                    $options[] = $option_id;
                }
            }
            $option_id_1 = $option_id_2 = $option_id_3 = $option_id_4 = $option_id_5 = 0;
            if( count( $options ) > 0 ){
                $option_id_1 = $options[0];
            }
            if( count( $options ) > 1 ){
                $option_id_2 = $options[1];
            }
            if( count( $options ) > 2 ){
                $option_id_3 = $options[2];
            }
            if( count( $options ) > 3 ){
                $option_id_4 = $options[3];
            }
            if( count( $options ) > 4 ){
                $option_id_5 = $options[4];
            }
            $use_quantity_tracking = ( $use_optionitem_quantity_tracking || $show_stock_quantity ) ? 1 : 0;
            $wpdb->query( $wpdb->prepare( "UPDATE ec_product SET option_id_1 = %d, option_id_2 = %d, option_id_3 = %d, option_id_4 = %d, option_id_5 = %d, use_optionitem_quantity_tracking = 0, show_stock_quantity = %d WHERE product_id = %d", $option_id_1, $option_id_2, $option_id_3, $option_id_4, $option_id_5, $use_quantity_tracking, $product_id ) );
        }
			
        // Maybe add product to category
        if( $category_stripe_id ){
            $category_id = $wpdb->get_var( $wpdb->prepare( "SELECT category_id FROM ec_category WHERE square_id = %s", $category_stripe_id ) );
            if( $category_id ){
                $wpdb->query( $wpdb->prepare( "INSERT INTO ec_categoryitem( category_id, product_id ) VALUES( %d, %d )", $category_id, $product_id ) );
            }
        }
	}
    
    function get_image_url( $id ){
        
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        $gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/catalog/object/" . $id : "https://connect.squareup.com/v2/catalog/object/" . $id;
        
        $headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, false );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)10);
		$response = curl_exec($ch);
		if( $response === false )
			$this->mysqli->insert_response( 0, 1, "SQUARE Image CURL ERROR", curl_error( $ch ) );
		else
			$this->mysqli->insert_response( 0, 0, "Square Image Response", $gateway_url . ' --- ' . print_r( $response, true ) );
		
		curl_close ($ch);
		
        $image = '';
		$response_data = json_decode( $response );
        if( isset( $response_data->object ) ){
            $image = $response_data->object->image_data->url;
        }
        return $image;
        
    }
    
    function get_variance_stock_quantity( $id ){
        
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        $location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
        if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
        
		$gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/inventory/" . $id . '?location_ids[]=' . $location_id : "https://connect.squareup.com/v2/inventory/" . $id . '?location_ids[]=' . $location_id;
        
        $headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, false );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)10);
		$response = curl_exec($ch);
		if( $response === false )
			$this->mysqli->insert_response( 0, 1, "SQUARE Inventory CURL ERROR", curl_error( $ch ) );
		else
			$this->mysqli->insert_response( 0, 0, "Square Inventory Response", $gateway_url . ' --- ' . print_r( $response, true ) );
		
		curl_close ($ch);
		
        $quantity = 0;
		$response_data = json_decode( $response );
        if( isset( $response_data->errors ) ){
            return 0;
            
        }else if( count( $response_data->counts ) > 0 ){
            $quantity = $response_data->counts[0]->quantity;
        }
        return $quantity;
        
    }
    
    function has_inventory_scope( ){
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
        
        $gateway_url = ( get_option( 'ec_option_square_is_sandbox' ) ) ? "https://connect.squareupsandbox.com/v2/inventory/batch-retrieve-changes" : "https://connect.squareup.com/v2/inventory/batch-retrieve-changes";
        
        $headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, false );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)10);
		$response = curl_exec($ch);
		if( $response === false )
			$this->mysqli->insert_response( 0, 1, "SQUARE Inventory CURL ERROR", curl_error( $ch ) );
		else
			$this->mysqli->insert_response( 0, 0, "Square Inventory Scope Response", $gateway_url . ' --- ' . print_r( $response, true ) );
		
		curl_close ($ch);
		
        $quantity = 0;
		$response_data = json_decode( $response );
        
        if( isset( $response_data->errors ) && count( $response_data->errors ) > 0 && $response_data->errors[0]->code == 'INSUFFICIENT_SCOPES' ){
            return false;
        }
        return true;
    }
	
	function allowed_at_location( $object ){
		$this_location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
		if( $this_location_id == '' ){
            $this_location_id = $this->get_location_id( );
        }
        
        if( isset( $object->absent_at_location_ids ) && in_array( $this_location_id, $object->absent_at_location_ids ) )
			return false;
		
		if( isset( $object->present_at_all_locations ) && $object->present_at_all_locations )
			return true;
			
		if( isset( $object->present_at_location_ids ) && in_array( $this_location_id, $object->present_at_location_ids ) )
			return true;
			
		return false;
	}
    
    function register_domain( ){
        
        $access_token = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_access_token' ) : get_option( 'ec_option_square_access_token' );
		$location_id = ( get_option( 'ec_option_square_is_sandbox' ) ) ? get_option( 'ec_option_square_sandbox_location_id' ) : get_option( 'ec_option_square_location_id' );
		if( !$location_id ){
			$location_id = $this->get_location_id( );
        }
        
        $domain = get_site_url( null, '', 'https' );
        $domain = str_replace( 'https://', '', str_replace( 'https://www.', '', $domain ) );
        
        $gateway_url = 'https://connect.squareup.com/v2/apple-pay/domains';
        $gateway_data = array( "domain_name" => $domain );
		
		$headr = array();
		$headr[] = 'Accept: application/json';
		$headr[] = 'Content-Type: application/json';
		$headr[] = 'Authorization: Bearer ' . $access_token;
		$headr[] = 'Square-Version: 2019-10-23';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, true ); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $gateway_data ) );
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
		$response = curl_exec($ch);
		if( $response === false )
			$this->mysqli->insert_response( 0, 1, "SQUARE CURL ERROR", curl_error( $ch ) );
		else
			$this->mysqli->insert_response( 0, 0, "Square Domain Registration Response", 'Registering ' . $domain . ' -- ' . print_r( $response, true ) );
		
		curl_close ($ch);
		
		$response_arr = json_decode( $response );
		
		if( isset( $response_arr->errors ) && count( $response_arr->errors ) > 0 ){
			return false;
		}else{
			return true;
		}
        
    }
	
}

?>