<?php
class wp_easycart_admin_online_docs{
	
	public function __construct( ){
		$this->admin_guide_url = 'http://docs.wpeasycart.com/wp-easycart-administrative-console-guide/';
		$this->admin_guide_section_url = 'http://docs.wpeasycart.com/wp-easycart-administrative-console-guide/?section=';
		$this->installation_guide_url = 'http://docs.wpeasycart.com/wp-easycart-installation-guide/?section=';
		$this->extension_guide_url = 'http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=';
	}
	
	//section (installation, settings, extensions...)
	//category (taxes, shipping rates, checkout, design, email, third party...)
	//panel (google adwords, deconetwork, taxcloud, amazon, order receipts...)
	public function print_docs_url($section, $category, $panel) {
		
		if ($section == 'products' ) {
			if ($category == 'products') {
				if( $panel == "importer" )
					return $this->admin_guide_section_url . $category . '-importer';
				else
					return $this->admin_guide_section_url . $category;
			} else if($category == 'inventory') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'option-sets') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'categories') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'menus') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'manufacturers') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'product-reviews') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'subscription-plans') {
				return $this->admin_guide_section_url . $category;
			}  else {
				////REGULAR GUIDE PAGE
				return $this->admin_guide_url ;
			}
		}
		
		
		if ($section == 'orders' ) {
			if ($category == 'order-management') {
				////Orders
				return $this->admin_guide_section_url . $category;
			} else if($category == 'subscriptions') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'manage-downloads') {
				return $this->admin_guide_section_url . $category;
			}  else {
				////REGULAR GUIDE PAGE
				return $this->admin_guide_url ;
			}
		}
		
		if ($section == 'users' ) {
			if ($category == 'user-accounts') {
				////users
				return $this->admin_guide_section_url . $category;
			} else if($category == 'user-roles') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'subscribers') {
				return $this->admin_guide_section_url . $category;
			}  else {
				////REGULAR GUIDE PAGE
				return $this->admin_guide_url ;
			}
		}
			
		if ($section == 'marketing' ) {	
			if($category == 'coupons') {
				////marketing
				return $this->admin_guide_section_url . $category;
			} else if($category == 'gift-cards') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'promotions') {
				return $this->admin_guide_section_url . $category;
			} else if($category == 'abandoned-carts') {
				return $this->admin_guide_section_url . $category;
			} else {
				////REGULAR GUIDE PAGE
				return $this->admin_guide_url ;
			}
		}
		if ($section == 'settings') {
			if($category == 'initial-setup') {
				////SETTINGS
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'product-settings') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'taxes') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'shipping-settings') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'shipping-rates') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'payment') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'checkout') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'accounts') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'additional-settings') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'language-editor') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'design') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'email-setup') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'third-party') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'cart-importer') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'countries') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'states-territories') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'per-page-options') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'price-points') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'log-entries') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'store-status') {
				////STORE STATUS
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'registration') {
				////REGISTRATION
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'gift-cards') {
				////MARKETING
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'coupons') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'promotions') {
				return $this->admin_guide_section_url . $category;	
			} else if($category == 'abandon-cart') {
				return $this->admin_guide_section_url . $category;	
			} else {
				////REGULAR GUIDE PAGE
				return $this->admin_guide_url ;
			}
		} else {
			////REGULAR GUIDE PAGE
			return $this->admin_guide_url ;
		}
	}
	
	public function print_vids_url($section, $category, $panel) {

		$videoID = false;
		
		if ($section == 'products' ) {
			if ($category == 'products') {
				if( $panel == "importer" ){
					$videoID = 'ua50lCD4ROA';
				} else {
					$videoID = 'eilsEkI0K1k';
				}

			} else if($category == 'option-sets') {
				 $videoID = '1ioVJNOQLOY';
			} else if($category == 'categories') {
				 $videoID = 'mnm78WSZHNU';
			} else if($category == 'menus') {
				 $videoID = 'mnm78WSZHNU';  
			} else if($category == 'manufacturers') {
				  
			} else if($category == 'product-reviews') {
				$videoID = 'MYf00vl09Mo'; 
			} else if($category == 'subscription-plans') {
				$videoID = 'Hsz674yulio';  
			}
		}
		
		
		if ($section == 'orders' ) {
			if ($category == 'order-management') {
				////Orders 
				 $videoID = 'CVqMvATLQqA';
			} else if($category == 'subscriptions') {
				 $videoID = 'Hsz674yulio';   
			} else if($category == 'manage-downloads') {
				 $videoID = 'cV45yjRC_BA'; 
			}
		}
		
		if ($section == 'users' ) {
			if ($category == 'user-accounts') {
				////users
				  
			} else if($category == 'user-roles') {
				  
			} else if($category == 'subscribers') {
				  
			}
		}
			
		if ($section == 'marketing' ) {	
			if($category == 'coupons') {
				////marketing
				  $videoID = 'Nz9bWUs_FlI';
			} else if($category == 'gift-cards') {
				  $videoID = 'Nz9bWUs_FlI';
			} else if($category == 'promotions') {
				  $videoID = 'Nz9bWUs_FlI';
			} else if($category == 'abandoned-carts') {
				  
			}
		}
		if ($section == 'settings') {
			if($category == 'initial-setup') {
				////SETTINGS
				if($panel == 'product-page') {
					 $videoID = '1GlbtKmWO7c';
				} else if ($panel == 'account-page') {
					 $videoID = '1GlbtKmWO7c';
				} else if ($panel == 'cart-page') {
					 $videoID = '1GlbtKmWO7c';
				} else if ($panel == 'demo-data') {
					 $videoID = '1GlbtKmWO7c';
				} else if ($panel == 'currency') {
					 
				} else if ($panel == 'goals') {
					 
				}
			} else if($category == 'product-settings') {
				if($panel == 'product-list') {
					 
				} else if ($panel == 'product-display') {
					 
				} else if ($panel == 'customer-review') {
					 
				} else if ($panel == 'product-details') {
					 
				} else if ($panel == 'price-display') {
					 $videoID = 'MYf00vl09Mo';
				}
			} else if($category == 'taxes') {
				if($panel == 'tax-by-state-setup') {
					 $videoID = 'puMTtiPc1dI';
				} else if ($panel == 'vat-setup') {
					 $videoID = 'puMTtiPc1dI';
				} else if ($panel == 'tax-by-country-setup') {
					 $videoID = 'puMTtiPc1dI';
				} else if ($panel == 'global-tax-setup') {
					 $videoID = 'puMTtiPc1dI';
				} else if ($panel == 'duty-tax-setup') {
					 $videoID = 'puMTtiPc1dI';
				} else if ($panel == 'canada-tax-setup') {
					 $videoID = 'puMTtiPc1dI';
				} else if ($panel == 'tax-cloud-setup') {
					 $videoID = 'puMTtiPc1dI';
				}
			} else if($category == 'shipping-settings') {
				if ($panel == 'usps') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'ups') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'fedex') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'dhl') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'canada-post') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'australia-post') {
					$videoID = '7VRk9PvE394';
				}

			} else if($category == 'shipping-rates') {
				if ($panel == 'shipping-method') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'country-list') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'state-list') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'shipping-zones') {
					$videoID = '7VRk9PvE394';
				} else if ($panel == 'shipping-basic-options') {
					$videoID = '7VRk9PvE394';
				}
				
			} else if($category == 'payment') {
				if($panel == 'accepted-cards') {
					 $videoID = 'jFnpZRiTVsM';
				} else if ($panel == 'live-gateway') {
					 $videoID = 'jFnpZRiTVsM';
				} else if ($panel == 'manual-bill') {
					 $videoID = 'jFnpZRiTVsM';
				} else if ($panel == 'third-party') {
					 $videoID = 'jFnpZRiTVsM';
				}
				 	
			} else if($category == 'checkout') {
				if($panel == 'settings') {
					 
				} else if ($panel == 'form-settings') {
					 
				} else if ($panel == 'stock-control') {
					 
				}
				 	
			} else if($category == 'accounts') {
				if($panel == 'settings') {
					 
				}	
			} else if($category == 'additional-settings') {
				if($panel == 'search-options') {
					 
				} else if ($panel == 'additional-options') {
					 
				}
			} else if($category == 'language-editor') {
				if($panel == 'current-language') {
					 $videoID = '_Pmjg8CGIk0';
				} else if ($panel == 'installed-languages') {
					 $videoID = '_Pmjg8CGIk0';
				} 	
			} else if($category == 'design') {
				if($panel == 'cart') {
					 $videoID = 'LiI4Ue8KlNQ';
				} else if ($panel == 'custom-css') {
					 $videoID = 'LiI4Ue8KlNQ';
				} else if ($panel == 'colors') {
					 $videoID = 'LiI4Ue8KlNQ';
				} else if ($panel == 'templates') {
					 $videoID = 'LiI4Ue8KlNQ';
				} else if ($panel == 'product') {
					 $videoID = 'LiI4Ue8KlNQ';
				} else if ($panel == 'product-details') {
					 $videoID = 'LiI4Ue8KlNQ';
				} else if ($panel == 'settings') {
					 $videoID = 'LiI4Ue8KlNQ';
				}
				 	
			} else if($category == 'email-setup') {
				if($panel == 'customer-email') {
					 
				} else if ($panel == 'email-settings') {
					 
				} else if ($panel == 'order-receipt-language') {
					 
				} else if ($panel == 'order-receipt') {
					 
				} 	
			} else if($category == 'third-party') {
				if($panel == 'amazon') {
					 
				} else if ($panel == 'deconetwork') {
					 
				} else if ($panel == 'google adwords') {
					 
				} else if ($panel == 'google-analytics') {
					 
				} else if ($panel == 'google-merchant') {
					 
				} 	
			} else if($category == 'cart-importer') {
				if($panel == 'woo') {
					 
				} else if ($panel == 'oscommerce') {
					 
				} 	
			} else if($category == 'manage-countries') {
				  	
			} else if($category == 'manage-states') {
				  	
			} else if($category == 'manage-per-page') {
				  	
			} else if($category == 'manage-price-points') {
				  	
			} else if($category == 'logs') {
				  	
			} else if($category == 'store-status') {
				  	
			} else if($category == 'registration') {
				 if($panel == 'registration') {
					$videoID = 'r3Q4FJiUwWY';
				} else if ($panel == 'none') {
					$videoID = 'r3Q4FJiUwWY';
				} else if ($panel == 'expired') {
					$videoID = 'r3Q4FJiUwWY';
				} 	
			}
		}
		
		if($videoID != false) {
			$video_script = '<script>';
			$video_script .= '	var wp_easycart_help_player;';
			$video_script .= '	var tag = document.createElement( "script" );';
			$video_script .= '	tag.src = "https://www.youtube.com/iframe_api";';
			$video_script .= '	var firstScriptTag = document.getElementsByTagName( "script" )[0];';
			$video_script .= '	firstScriptTag.parentNode.insertBefore( tag, firstScriptTag );';
				
			$video_script .= '	function onYouTubeIframeAPIReady( ){';
			$video_script .= '		wp_easycart_help_player = new YT.Player( "wp_easycart_admin_help_video_player", {';
			$video_script .= '			width: "100%",';
			$video_script .= '			height: "450",';
			$video_script .= '			videoId: "'.$videoID.'"';
			$video_script .= '		});';
			$video_script .= '	}';
				
			$video_script .= '	jQuery( ".ec_admin_help_video_container > .ec_admin_upsell_popup_close > a" ).on( "click", function( ){';
			$video_script .= '		wp_easycart_help_player.pauseVideo( ); wp_easycart_admin_close_video_help( ); return false;';
			$video_script .= '	} );';
			$video_script .= '</script>';
			
			
			
			$video_script .= ' <a href="https://www.youtube.com/watch?v='.$videoID.'"  onclick="wp_easycart_admin_open_video_help(); wp_easycart_help_player.playVideo( ); return false;" class="ec_help_icon_link"><div class="dashicons-before ec_help_icon dashicons-format-video"></div> ' . __( 'Video', 'wp-easycart' ) . '</a>';
			
			return $video_script;
		}
	}
	

		
}
