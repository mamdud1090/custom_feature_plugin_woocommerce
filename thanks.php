<?php

	/* Plugin Name: Show thank you meassage
	   Author name: Md. Mamdudur Rahman

	*/



function top_selling_item(){

	echo do_shortcode('[products limit="3" columns="3" best_selling="true" ]');

	 echo "Thank you so much...!!! You can try our top selling products.....";
}

add_action('woocommerce_order_details_after_customer_details','top_selling_item');




global $top_selling_item, $wpdb;

$table = "{$wpdb->prefix}wc_product_meta_lookup";

$top_selling_item = $wpdb->get_results( "SELECT sku, total_sales FROM {$table} ORDER BY 'total_sales'  DESC LIMIT 3" );

// 	var_dump($top_selling_item);







// global $max_id, $wpdb ;
// $table = "{$wpdb->prefix}wc_product_meta_lookup";
// // $max_id = $wpdb->get_results( "SELECT sku, MAX(total_sales) FROM {$table} " );
// $max_id = $wpdb->get_results( "SELECT sku, total_sales FROM {$table}  ORDER BY 'total_sales' DESC limit 3");
// print_r($max_id);
// }
// add_action('woocommerce_order_details_after_customer_details', 'order_get_id' ); 


?>





