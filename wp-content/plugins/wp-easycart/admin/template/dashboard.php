<?php do_action( 'wp_easycart_admin_dashboard_pre_chart' ); ?>
<?php $single_stats = wp_easycart_admin( )->get_single_stats( date( 'Y-m-d', strtotime( '-14 days' ) ), date( 'Y-m-d' ) ); ?>
<div id="ec_admin_chart" class="ec_admin_chart_holder ec_admin_chart_holder_active">
	<?php 
    global $wpdb;
    $products = $wpdb->get_results( "SELECT ec_product.title, ec_product.product_id FROM ec_product WHERE ec_product.activate_in_store = 1 ORDER BY ec_product.title ASC LIMIT 500" );
    if( count( $products ) >= 500 ){
    ?>
        <input type="text" style="max-width:300px; float:right;" name="product_filter" placeholder="<?php __( 'Enter a Product ID', 'wp-easycart' ); ?>" value="" onkeydown="wpeasycart_admin_update_chart_data( );" />
    <?php }else{ ?>
        <select id="product_filter" style="max-width:300px; float:right;" onchange="wpeasycart_admin_update_chart_data( );">
            <option value="0" selected="selected"><?php _e( 'No Product Filter', 'wp-easycart' ); ?></option>
            <?php foreach( $products as $product ){ ?>
            <option value="<?php echo $product->product_id; ?>"><?php echo $product->title; ?></option>
            <?php }?>
        </select>
    <?php }?>
    
	<div class="ec_admin_dashboard_chart_editor">
    
        <div id="wpeasycart_admin_report_range1" class="ec_admin_dashboard_chart_range_button">
            <div style="font-weight:bold; color:<?php echo get_option( 'ec_option_admin_color' ); ?>"><?php _e( 'Date Range', 'wp-easycart' ); ?></div>
            <i class="dashicons dashicons-calendar"></i>&nbsp;
            <span></span> 
            <i class="dashicons dashicons-arrow-down"></i>
        </div>
        
        <div id="wpeasycart_admin_report_range2" class="ec_admin_dashboard_chart_range_button">
            <div style="font-weight:bold; color:#AAA;"><?php _e( 'Compare to', 'wp-easycart' ); ?></div>
            <i class="dashicons dashicons-calendar"></i>&nbsp;
            <span></span> 
            <i class="dashicons dashicons-arrow-down"></i>
        </div>
        
        <div class="wpeasycart_admin_chart_export" onclick="wpeasycart_admin_export_report( );">
            <span class="dashicons dashicons-download" style="margin-right:5px;"></span> <?php _e( 'Export Report', 'wp-easycart' ); ?>
        </div>
        
        <select id="daily_filter" onchange="wpeasycart_admin_update_chart_data( );" style="float:right; border:none; margin-left:20px; margin-top:13px;">
            <option value="daily" selected="selected"><?php _e( 'Daily', 'wp-easycart' ); ?></option>
            <option value="weekly"><?php _e( 'Weekly', 'wp-easycart' ); ?></option>
            <option value="monthly"><?php _e( 'Monthly', 'wp-easycart' ); ?></option>
            <option value="yearly"><?php _e( 'Yearly', 'wp-easycart' ); ?></option>
        </select>
        
        <div class="wpeasycart_admin_chart_types" style="padding:3px 0; margin-top:15px;">
            <span class="dashicons dashicons-chart-line wpeasycart_admin_chart_type_line selected" onclick="wpeasycart_admin_update_chart_type( 'line' );" style="margin-right:5px;"></span>
            <span class="dashicons dashicons-chart-bar wpeasycart_admin_chart_type_bar" onclick="wpeasycart_admin_update_chart_type( 'bar' );"></span>
        </div>
	</div>
    
    <div class="ec_admin_dashboard_stat_items" style="float:left; width:100%;">
        
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item1">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Total Payments', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->gross_revenue->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change decrease" style="display:none"><span class="dashicons dashicons-arrow-down-alt"></span> -36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item2">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Shipping', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->shipping->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change increase" style="display:none"><span class="dashicons dashicons-arrow-up-alt"></span> +36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item3">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Taxes', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->tax->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change increase" style="display:none"><span class="dashicons dashicons-arrow-up-alt"></span> +36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item4">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Discount Total', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->discount->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change decrease" style="display:none"><span class="dashicons dashicons-arrow-down-alt"></span> -36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item5">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Refunds', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->refund->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change increase" style="display:none"><span class="dashicons dashicons-arrow-up-alt"></span> +36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item6">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Net Revenue', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->net_revenue->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change decrease" style="display:none"><span class="dashicons dashicons-arrow-down-alt"></span> -36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item7">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Order Count', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->orders->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change decrease" style="display:none"><span class="dashicons dashicons-arrow-down-alt"></span> -36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item8">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Items Sold', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->items->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change decrease" style="display:none"><span class="dashicons dashicons-arrow-down-alt"></span> -36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item9">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Unique Customers', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->customers->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change decrease" style="display:none"><span class="dashicons dashicons-arrow-down-alt"></span> -36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        <div class="ec_admin_dashboard_stat_item" id="ec_admin_dashboard_stat_item10">
            <div class="ec_admin_dashboard_stat_item_title"><?php _e( 'Abandoned Carts', 'wp-easycart' ); ?></div>
            <div class="ec_admin_dashboard_stat_item_total"><?php echo $single_stats->carts->set1; ?></div>
            <div class="ec_admin_dashboard_stat_item_change decrease" style="display:none"><span class="dashicons dashicons-arrow-down-alt"></span> -36.3%</div>
            <div class="ec_admin_dashboard_stat_item_prev_total" style="display:none"><?php _e( 'Previous Period', 'wp-easycart' ); ?><br />$0.00</div>
        </div>
        
    </div>
	
    <div style="float:left; width:100%;">
        <div class="ec_admin_dashboard_chart">
            <canvas id="ec_admin_chart_data_1" class="ec_admin_chart"></canvas>
        </div>
        <div class="ec_admin_dashboard_chart">
            <canvas id="ec_admin_chart_data_2" class="ec_admin_chart"></canvas>
        </div>
        <div class="ec_admin_dashboard_chart">
            <canvas id="ec_admin_chart_data_3" class="ec_admin_chart"></canvas>
        </div>
    </div>

</div>

<?php do_action( 'wp_easycart_admin_dashboard_post' ); ?>

<script type="text/javascript">
function get_currency_display( amount ){
    var display_amount = '';
    var show_currency_code = <?php echo ( $GLOBALS['currency']->get_symbol_location( ) ) ? 1 : 0; ?>;
    var currency_code = '<?php echo $GLOBALS['currency']->get_currency_code( ); ?>';
    var negative_location = <?php echo ( $GLOBALS['currency']->get_negative_location( ) ) ? 1 : 0; ?>;
    var symbol_location = <?php echo ( $GLOBALS['currency']->get_symbol_location( ) ) ?  1 : 0; ?>;
    var symbol = '<?php echo $GLOBALS['currency']->get_symbol( ); ?>';
    var decimal_length = <?php echo $GLOBALS['currency']->get_decimal_length( ); ?>;
    var decimal_symbol = '<?php echo $GLOBALS['currency']->get_decimal_symbol( ); ?>';
    var grouping_symbol = '<?php echo $GLOBALS['currency']->get_grouping_symbol( ); ?>';
    if( show_currency_code )
        display_amount += currency_code + ' ';
    if( amount < 0 && negative_location )
        display_amount += '-';
    if( symbol_location )
        display_amount += symbol;
    if( amount < 0 && !negative_location )
        display_amount += '-';
    if( amount < 0 )
        amount = amount * -1;
    display_amount += ec_admin_chart_number_format( amount, decimal_length, decimal_symbol, grouping_symbol );
    if( !symbol_location )
        display_amount += symbol;
    return display_amount;
}
function ec_admin_chart_number_format( number, decimals, dec_point, thousands_sep ){
    number = ( number + '' ).replace( /[^0-9+\-Ee.]/g, '' );
    var n = !isFinite( +number ) ? 0 : +number,
        prec = !isFinite( +decimals ) ? 0 : Math.abs( decimals ),
        sep = ( typeof thousands_sep === 'undefined' ) ? ',' : thousands_sep,
        dec = ( typeof dec_point === 'undefined' ) ? '.' : dec_point,
        s = '',
        toFixedFix = function ( n, prec ){
            var k = Math.pow( 10, prec );
            return '' + Math.round( n * k ) / k;
        };
    s = ( prec ? toFixedFix( n, prec ) : '' + Math.round( n ) ).split( '.' );
    if( s[0].length > 3 ){
        s[0] = s[0].replace( /\B(?=(?:\d{3})+(?!\d))/g, sep );
    }
    if( ( s[1] || '' ).length < prec ){
        s[1] = s[1] || '';
        s[1] += new Array( prec - s[1].length + 1 ).join( '0' );
    }
    return s.join( dec );
}
var start1 = moment( ).subtract( 13, 'days' );
var end1 = moment( );
function wpeasycart_admin_report_cb1( start, end ){
    jQuery( '#wpeasycart_admin_report_range1 span' ).html( start.format( 'MMMM D, YYYY' ) + ' - ' + end.format( 'MMMM D, YYYY' ) );
}
jQuery( '#wpeasycart_admin_report_range1' ).daterangepicker( {
	chosenLabel: 'Last 14 Days',
    startDate: start1,
    endDate: end1,
    ranges: {
       '<?php _e( 'Today', 'wp-easycart' ); ?>': [moment(), moment()],
       '<?php _e( 'Yesterday', 'wp-easycart' ); ?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       '<?php _e( 'Last 7 Days', 'wp-easycart' ); ?>': [moment().subtract(6, 'days'), moment()],
       '<?php _e( 'Last 14 Days', 'wp-easycart' ); ?>': [moment().subtract(13, 'days'), moment()],
       '<?php _e( 'Last 30 Days', 'wp-easycart' ); ?>': [moment().subtract(29, 'days'), moment()],
       '<?php _e( 'This Month', 'wp-easycart' ); ?>': [moment().startOf('month'), moment().endOf('month')],
       '<?php _e( 'Last Month', 'wp-easycart' ); ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
       '<?php _e( 'Last 3 Months', 'wp-easycart' ); ?>': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')],
       '<?php _e( 'Last 6 Months', 'wp-easycart' ); ?>': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')],
       '<?php _e( 'Last 12 Months', 'wp-easycart' ); ?>': [moment().subtract(11, 'month').startOf('month'), moment().endOf('month')],
       '<?php _e( 'This Quarter', 'wp-easycart' ); ?>': [moment().startOf('quarter'), moment().endOf('quarter')],
       '<?php _e( 'Last Quarter', 'wp-easycart' ); ?>': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
       '<?php _e( 'This Year', 'wp-easycart' ); ?>': [moment().startOf('year'), moment().endOf('year')],
       '<?php _e( 'Last 2 Years', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').startOf('year'), moment().endOf('year')],
       '<?php _e( 'Last 3 Years', 'wp-easycart' ); ?>': [moment().subtract(2, 'year').startOf('year'), moment().endOf('year')],
       '<?php _e( 'Last 5 Years', 'wp-easycart' ); ?>': [moment().subtract(4, 'year').startOf('year'), moment().endOf('year')]
    }
}, wpeasycart_admin_report_cb1 ).on( 'apply.daterangepicker', function( ev, picker ){
    wpeasycart_admin_report_update_range2( );
    wpeasycart_admin_update_chart_data( );
} );
wpeasycart_admin_report_cb1( start1, end1 );
jQuery( '#wpeasycart_admin_report_range1' ).data('daterangepicker').chosenLabel = 'Last 14 Days';
var start2 = moment().add(1, 'days');
var end2 = moment().add(1, 'days');
function wpeasycart_admin_report_cb2( start, end ){
    var selected_range = jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').chosenLabel;
    if( selected_range == '<?php _e( 'Disabled', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2 span' ).html( '<?php _e( 'Disabled', 'wp-easycart' ); ?>' );
    }else{
        jQuery( '#wpeasycart_admin_report_range2 span' ).html( start.format( 'MMMM D, YYYY' ) + ' - ' + end.format( 'MMMM D, YYYY' ) );
    }
}
wpeasycart_admin_report_update_range2( );
wpeasycart_admin_report_cb2( start2, end2 );
function wpeasycart_admin_report_update_range2( ){
    var selected_range = jQuery( '#wpeasycart_admin_report_range1' ).data('daterangepicker').chosenLabel;
    if( selected_range == '<?php _e( 'Last 7 Days', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(13, 'days'), moment().subtract(7, 'days')],
               '<?php _e( 'Last Month', 'wp-easycart' ); ?>': [moment().subtract(1, 'month').subtract( 6, 'days' ), moment().subtract(1, 'month')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract( 6, 'days' ), moment().subtract(1, 'year')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last 14 Days', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(27, 'days'), moment().subtract(14, 'days')],
               '<?php _e( 'Last Month', 'wp-easycart' ); ?>': [moment().subtract(1, 'month').subtract( 13, 'days' ), moment().subtract(1, 'month')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract( 13, 'days' ), moment().subtract(1, 'year')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last 30 Days', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(59, 'days'), moment().subtract(30, 'days')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract(29, 'days'), moment().subtract(1, 'year')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'This Month', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').startOf('month'), moment().subtract(1, 'year').endOf('month')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last Month', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(2, 'month').startOf('month'), moment().subtract(2, 'month').endOf('month')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract(1, 'month').startOf('month'), moment().subtract(1, 'year').subtract(1, 'month').endOf('month')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last 3 Months', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(5, 'month').startOf('month'), moment().subtract(3, 'month').endOf('month')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract(2, 'month').startOf('month'), moment().subtract(1, 'year').endOf('month')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last 6 Months', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(11, 'month').startOf('month'), moment().subtract(6, 'month').endOf('month')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract(5, 'month').startOf('month'), moment().subtract(1, 'year').endOf('month')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last 12 Months', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(23, 'month').startOf('month'), moment().subtract(12, 'month').endOf('month')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'This Quarter', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').startOf('quarter'), moment().subtract(1, 'year').endOf('quarter')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last Quarter', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(2, 'quarter').startOf('quarter'), moment().subtract(2, 'quarter').endOf('quarter')],
               '<?php _e( 'Last Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'year').subtract(1, 'quarter').endOf('quarter')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'This Year', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last 2 Years', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(3, 'year').startOf('year'), moment().subtract(2, 'year').endOf('year')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last 3 Years', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(5, 'year').startOf('year'), moment().subtract(3, 'year').endOf('year')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else if( selected_range == '<?php _e( 'Last 5 Years', 'wp-easycart' ); ?>' ){
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Previous Period', 'wp-easycart' ); ?>': [moment().subtract(9, 'year').startOf('year'), moment().subtract(5, 'year').endOf('year')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }else{
        jQuery( '#wpeasycart_admin_report_range2' ).daterangepicker( {
            chosenLabel: '<?php _e( 'Disabled', 'wp-easycart' ); ?>',
            startDate: start2,
            endDate: end2,
            ranges: {
               '<?php _e( 'Disabled', 'wp-easycart' ); ?>': [moment().add(1, 'days'), moment().add(1, 'days')],
               '<?php _e( 'Yesterday', 'wp-easycart' ); ?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               '<?php _e( 'Last 7 Days, Previous Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract( 6, 'days' ), moment().subtract(1, 'year')],
               '<?php _e( 'Last Month', 'wp-easycart' ); ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
               '<?php _e( 'Last 3 Months, Previous Year', 'wp-easycart' ); ?>': [moment().subtract(1, 'year').subtract(3, 'month').startOf('month'), moment().subtract(1, 'year').endOf('month')],
               '<?php _e( 'Last Quarter', 'wp-easycart' ); ?>': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')]
            }
        }, wpeasycart_admin_report_cb2 ).on( 'apply.daterangepicker', function( ev, picker ){
            wpeasycart_admin_update_chart_data( );
        } );
    }
    jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').chosenLabel = '<?php _e( 'Disabled', 'wp-easycart' ); ?>';
    jQuery( '#wpeasycart_admin_report_range2 span' ).html( '<?php _e( 'Disabled', 'wp-easycart' ); ?>' );
}
var dashboard_data_sales = <?php echo wp_easycart_admin( )->get_stats( 'sales', date( 'Y-m-d', strtotime( '-14 days' ) ), date( 'Y-m-d' ) ); ?>;
var dashboard_data_items = <?php echo wp_easycart_admin( )->get_stats( 'items', date( 'Y-m-d', strtotime( '-14 days' ) ), date( 'Y-m-d' ) ); ?>;
var dashboard_data_abandoned = <?php echo wp_easycart_admin( )->get_stats( 'carts', date( 'Y-m-d', strtotime( '-14 days' ) ), date( 'Y-m-d' ) ); ?>;
var options_sales = {
	scaleBeginAtZero : true,
	scaleShowGridLines : true,
	scaleGridLineColor : "rgba(0,0,0,.90)",
	scaleGridLineWidth : 1,
	scaleShowHorizontalLines: true,
	scaleShowVerticalLines: true,
	barShowStroke : true,
	barStrokeWidth : 2,
	barValueSpacing : 5,
	barDatasetSpacing : 1,
    cubicInterpolationMode: 'default',
    bezierCurve: false,
	lineTension: 0,
	tooltips: {
		enabled: true,
		mode: 'single',
		callbacks: {
			title: function( tooltipItems, data ){
				return data.datasets[tooltipItems[0].datasetIndex].datalabels[tooltipItems[0].index];
			},
			label: function( tooltipItems, data ){
				return get_currency_display( tooltipItems.yLabel );
			}
		}
	},
    elements: {
        line: {
            tension: 0
        }
    }
};
var options_items = {
	scaleBeginAtZero : true,
	scaleShowGridLines : true,
	scaleGridLineColor : "rgba(0,0,0,.90)",
	scaleGridLineWidth : 1,
	scaleShowHorizontalLines: true,
	scaleShowVerticalLines: true,
	barShowStroke : true,
	barStrokeWidth : 2,
	barValueSpacing : 5,
	barDatasetSpacing : 1,
    cubicInterpolationMode: 'default',
    bezierCurve: false,
	lineTension: 0,
	tooltips: {
		enabled: true,
		mode: 'single',
		callbacks: {
			title: function( tooltipItems, data ){
				return data.datasets[tooltipItems[0].datasetIndex].datalabels[tooltipItems[0].index];
			},
			label: function( tooltipItems, data ){
				return tooltipItems.yLabel + ' <?php _e( 'Items', 'wp-easycart' ); ?>';
			}
		}
	},
    elements: {
        line: {
            tension: 0
        }
    }
};
var options_carts = {
	scaleBeginAtZero : true,
	scaleShowGridLines : true,
	scaleGridLineColor : "rgba(0,0,0,.90)",
	scaleGridLineWidth : 1,
	scaleShowHorizontalLines: true,
	scaleShowVerticalLines: true,
	barShowStroke : true,
	barStrokeWidth : 2,
	barValueSpacing : 5,
	barDatasetSpacing : 1,
    cubicInterpolationMode: 'default',
    bezierCurve: false,
	lineTension: 0,
	tooltips: {
		enabled: true,
		mode: 'single',
		callbacks: {
			title: function( tooltipItems, data ){
				return data.datasets[tooltipItems[0].datasetIndex].datalabels[tooltipItems[0].index];
			},
			label: function( tooltipItems, data ){
				return tooltipItems.yLabel + ' <?php _e( 'Abandoned Carts', 'wp-easycart' ); ?>';
			}
		}
	},
    elements: {
        line: {
            tension: 0
        }
    }
};
var ctx_1 = 'ec_admin_chart_data_1';
var chart1 = new Chart( ctx_1, {
    type: 'line',
    data: dashboard_data_sales,
    options: options_sales
} );
var ctx_2 = 'ec_admin_chart_data_2';
var chart2 = new Chart( ctx_2, {
    type: 'line',
    data: dashboard_data_items,
    options: options_items
} );
var ctx_3 = 'ec_admin_chart_data_3';
var chart3 = new Chart( ctx_3, {
    type: 'line',
    data: dashboard_data_abandoned,
    options: options_carts
} );
document.addEventListener( 'DOMContentLoaded', function( ){ // Fixing load display, sizing issue.
    wpeasycart_admin_update_chart_type( 'line' )
}, false );
function wpeasycart_admin_update_chart_type( type ){
    jQuery( '.wpeasycart_admin_chart_types > .dashicons' ).removeClass( 'selected' );
    jQuery( '.wpeasycart_admin_chart_types > .wpeasycart_admin_chart_type_' + type ).addClass( 'selected' );
    chart1.destroy( );
    chart1 = new Chart( ctx_1, {
        type: type,
        data: dashboard_data_sales,
        options: options_sales
    } );
    chart2.destroy( );
    chart2 = new Chart( ctx_2, {
        type: type,
        data: dashboard_data_items,
        options: options_items
    } );
    chart3.destroy( );
    chart3 = new Chart( ctx_3, {
        type: type,
        data: dashboard_data_abandoned,
        options: options_carts
    } );
}
function wpeasycart_admin_export_report( ){
	jQuery( '.wpeasycart_admin_chart_export > .dashicons' ).removeClass( 'dashicons-download' ).addClass( 'dashicons-image-rotate' );
    var start_date = jQuery( '#wpeasycart_admin_report_range1' ).data('daterangepicker').startDate.format( 'YYYY-MM-DD' );
	var end_date = jQuery( '#wpeasycart_admin_report_range1' ).data('daterangepicker').endDate.format( 'YYYY-MM-DD' );
	var start_date2 = 0;
    if(  jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').chosenLabel != '<?php _e( 'Disabled', 'wp-easycart' ); ?>' && jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').startDate ){
        start_date2 = jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').startDate.format( 'YYYY-MM-DD' );
    }
    var end_date2 = 0;
    if( jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').chosenLabel != '<?php _e( 'Disabled', 'wp-easycart' ); ?>' && jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').endDate ){
        end_date2 = jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').endDate.format( 'YYYY-MM-DD' );
    }
    var range = jQuery( '#daily_filter' ).val( );
    var product_filter = jQuery( '#product_filter' ).val( );
	var data = {
		action: 'ec_admin_create_report_export',
		start_date: start_date,
		end_date: end_date,
		start_date2: start_date2,
		end_date2: end_date2,
        range: range,
        product: product_filter
	};
    jQuery.ajax({url: ajax_object.ajax_url, type: 'post', data: data, success: function( response ){ 
		jQuery( '.wpeasycart_admin_chart_export > .dashicons' ).removeClass( 'dashicons-image-rotate' ).addClass( 'dashicons-download' );
        var reports = JSON.parse( response );
        var modal = '<div class="wpeasycart_admin_modal"><div class="wpeasycart_admin_modal_content">';
        modal += '<div class="wpeasycart_admin_modal_close" onclick="jQuery( this ).parent( ).parent( ).remove( )">X</div>';
        modal += '<a href="' + reports.report1 + '" target="_blank" class="wpeasycart_admin_download_report"><?php _e( 'Download Main Report', 'wp-easycart' ); ?></a>';
        if( reports.report2 ){
            modal += '<a href="' + reports.report2 + '" target="_blank" class="wpeasycart_admin_download_report"><?php _e( 'Download Compare Range Report', 'wp-easycart' ); ?></a>';
        }
        modal += '</div></div>';
        jQuery( 'body' ).append( modal );
    } } );
}
function wpeasycart_admin_update_chart_data( ){
	jQuery( '.wpeasycart_admin_chart_types' ).prepend( '<div class="dashicons dashicons-image-rotate"></div>' );
    var start_date = jQuery( '#wpeasycart_admin_report_range1' ).data('daterangepicker').startDate.format( 'YYYY-MM-DD' );
	var end_date = jQuery( '#wpeasycart_admin_report_range1' ).data('daterangepicker').endDate.format( 'YYYY-MM-DD' );
	var start_date2 = 0;
    if(  jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').chosenLabel != '<?php _e( 'Disabled', 'wp-easycart' ); ?>' && jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').startDate ){
        start_date2 = jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').startDate.format( 'YYYY-MM-DD' );
    }
    var end_date2 = 0;
    if( jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').chosenLabel != '<?php _e( 'Disabled', 'wp-easycart' ); ?>' && jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').endDate ){
        end_date2 = jQuery( '#wpeasycart_admin_report_range2' ).data('daterangepicker').endDate.format( 'YYYY-MM-DD' );
    }
    var range = jQuery( '#daily_filter' ).val( );
    var product_filter = jQuery( '#product_filter' ).val( );
	var data = {
		action: 'ec_admin_get_updated_stat_list',
		start_date: start_date,
		end_date: end_date,
		start_date2: start_date2,
		end_date2: end_date2,
        range: range,
        product: product_filter
	};
	jQuery.ajax({url: ajax_object.ajax_url, type: 'post', data: data, success: function( response ){ 
		jQuery( '.wpeasycart_admin_chart_types .dashicons-image-rotate' ).remove( );
    	var stats = JSON.parse( response );
		var single_stats = stats.single;
        dashboard_data_sales = JSON.parse( stats.sales );
		chart1.data = dashboard_data_sales;
		chart1.update( );
        dashboard_data_items = JSON.parse( stats.items );
		chart2.data = dashboard_data_items;
		chart2.update( );
        dashboard_data_abandoned = JSON.parse( stats.carts );
		chart3.data = dashboard_data_abandoned;
		chart3.update( );
		
		jQuery( '#ec_admin_dashboard_stat_item1 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.gross_revenue.set1 );
		jQuery( '#ec_admin_dashboard_stat_item2 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.shipping.set1 );
		jQuery( '#ec_admin_dashboard_stat_item3 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.tax.set1 );
		jQuery( '#ec_admin_dashboard_stat_item4 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.discount.set1 );
		jQuery( '#ec_admin_dashboard_stat_item5 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.refund.set1 );
		
		jQuery( '#ec_admin_dashboard_stat_item6 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.net_revenue.set1 );
		jQuery( '#ec_admin_dashboard_stat_item7 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.orders.set1 );
		jQuery( '#ec_admin_dashboard_stat_item8 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.items.set1 );
		jQuery( '#ec_admin_dashboard_stat_item9 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.customers.set1 );
		jQuery( '#ec_admin_dashboard_stat_item10 > .ec_admin_dashboard_stat_item_total' ).html( single_stats.carts.set1 );
		if( start_date2 ){
			if( single_stats.gross_revenue.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item1 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.gross_revenue.diff + '%' );
			}else if( single_stats.gross_revenue.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item1 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'decrease' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.gross_revenue.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item1 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.gross_revenue.diff + '%' );
			}
			
			if( single_stats.shipping.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item2 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.shipping.diff + '%' );
			}else if( single_stats.shipping.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item2 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'decrease' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.shipping.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item2 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.shipping.diff + '%' );
			}
			
			if( single_stats.tax.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item3 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.tax.diff + '%' );
			}else if( single_stats.tax.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item3 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.tax.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item3 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.tax.diff + '%' );
			}
			
			if( single_stats.discount.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item4 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.discount.diff + '%' );
			}else if( single_stats.discount.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item4 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.discount.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item4 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.discount.diff + '%' );
			}
			
			if( single_stats.refund.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item5 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'descrease' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.refund.diff + '%' );
			}else if( single_stats.refund.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item5 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.refund.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item5 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.refund.diff + '%' );
			}
			
			if( single_stats.net_revenue.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item6 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.net_revenue.diff + '%' );
			}else if( single_stats.net_revenue.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item6 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'decrease' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.net_revenue.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item6 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.net_revenue.diff + '%' );
			}
			
			if( single_stats.orders.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item7 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.orders.diff + '%' );
			}else if( single_stats.orders.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item7 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'decrease' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.orders.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item7 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.orders.diff + '%' );
			}
			
			if( single_stats.items.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item8 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.items.diff + '%' );
			}else if( single_stats.items.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item8 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'decrease' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.items.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item8 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.items.diff + '%' );
			}
			
			if( single_stats.customers.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item9 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.customers.diff + '%' );
			}else if( single_stats.customers.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item9 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'decrease' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.customers.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item9 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.customers.diff + '%' );
			}
			
			if( single_stats.carts.diff > 0 ){
				jQuery( '#ec_admin_dashboard_stat_item10 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'decrease' ).show( ).html( '<span class="dashicons dashicons-arrow-up-alt"></span>' + single_stats.carts.diff + '%' );
			}else if( single_stats.carts.diff < 0 ){
				jQuery( '#ec_admin_dashboard_stat_item10 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).addClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-arrow-down-alt"></span>' + single_stats.carts.diff + '%' );
			}else{
				jQuery( '#ec_admin_dashboard_stat_item10 > .ec_admin_dashboard_stat_item_change' ).removeClass( 'decrease' ).removeClass( 'increase' ).show( ).html( '<span class="dashicons dashicons-minus"></span>' + single_stats.carts.diff + '%' );
			}
			
			jQuery( '#ec_admin_dashboard_stat_item1 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.gross_revenue.set2 );
			jQuery( '#ec_admin_dashboard_stat_item2 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.shipping.set2 );
			jQuery( '#ec_admin_dashboard_stat_item3 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.tax.set2 );
			jQuery( '#ec_admin_dashboard_stat_item4 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.discount.set2 );
			jQuery( '#ec_admin_dashboard_stat_item5 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.refund.set2 );

			jQuery( '#ec_admin_dashboard_stat_item6 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.net_revenue.set2 );
			jQuery( '#ec_admin_dashboard_stat_item7 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.orders.set2 );
			jQuery( '#ec_admin_dashboard_stat_item8 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.items.set2 );
			jQuery( '#ec_admin_dashboard_stat_item9 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.customers.set2 );
			jQuery( '#ec_admin_dashboard_stat_item10 > .ec_admin_dashboard_stat_item_prev_total' ).show( ).html( single_stats.carts.set2 );
		}else{
			jQuery( '#ec_admin_dashboard_stat_item1 > .ec_admin_dashboard_stat_item_change' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item2 > .ec_admin_dashboard_stat_item_change' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item3 > .ec_admin_dashboard_stat_item_change' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item4 > .ec_admin_dashboard_stat_item_change' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item5 > .ec_admin_dashboard_stat_item_change' ).hide( );

			jQuery( '#ec_admin_dashboard_stat_item6 > .ec_admin_dashboard_stat_item_change' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item7 > .ec_admin_dashboard_stat_item_change' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item8 > .ec_admin_dashboard_stat_item_change' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item9 > .ec_admin_dashboard_stat_item_change' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item10 > .ec_admin_dashboard_stat_item_change' ).hide( );
			
			jQuery( '#ec_admin_dashboard_stat_item1 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item2 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item3 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item4 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item5 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );

			jQuery( '#ec_admin_dashboard_stat_item6 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item7 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item8 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item9 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
			jQuery( '#ec_admin_dashboard_stat_item10 > .ec_admin_dashboard_stat_item_prev_total' ).hide( );
		}
	} } );
}
</script>