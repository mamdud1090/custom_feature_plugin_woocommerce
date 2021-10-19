<?php

/* 

Plugin Name: Add New Section Checkout

Description: Add extra option in checkout page of woocommerce 

Author Name: Md. Mamdudur Rahman

Plugin URI:  http://link to your plugin homepage
Description: Describe what your plugin is all about in a few short sentences
Version:     1.0
Author URI:  http://link to your website
License:     GPL2 etc
License URI: http://link to your plugin license

*/

// add_action('woocommerce_admin_order_data_after_shipping_address','dolon_add_new_scetion');




function dolon_custom_woocommerce_fields($fields){
       ?>

	<label for="customer_gender">Gender:&nbsp; &nbsp; </label>
	<input type="radio" name="gender" value="male">&nbsp; Male &nbsp; &nbsp;
	<input type="radio" name="gender" value="female">&nbsp; Female

	<br><br><br>
	
	<label for="birthday">Birthday:&nbsp; &nbsp;</label>
  	<input type="date" id="birthday" name="birthday">

<?php
        return $fields;
    }

    
add_action( 'woocommerce_admin_order_data_after_shipping_address' ,'dolon_custom_woocommerce_fields' );



add_action('woocommerce_before_order_notes','dolon_custom_woocommerce_fields');



/* ====== Adding more custom fields ========== */
/*

/*

/*

*/


//  For Text Field option


function dolon_add_custom_field($new_field){

		woocommerce_form_field('buyer_code', array(

			'type'     	=> 'text',
			'class'		=>  array('buyer-code'),
			'required'	=> 'true',
			'label'    	=> 'Buyer Code:',
			'description'	=> 'Place your buyer code no.',
			'placeholder'	=> '35',

		), $new_field->get_value('buyer_code'));

	}

add_action('woocommerce_after_checkout_billing_form', 'dolon_add_custom_field');



//  For Radio Button Field option


function dolon_add_custom_field_customer_location($location){

		woocommerce_form_field('customer_location', array(

			'type'     	=> 'radio',
			'class'		=>  array('user-location'),
			'required'	=> 'true',
			'label'    	=> 'Your Location:',
			'options'	=>  array(

			'dhaka'         => 'Dhaka',
			'rajshahi'	=> 'Rajshahi',
			'chattogram'    => 'Chattogram',
			'khulna'	=> 'Khulna',
			'barial'        => 'Barisal',
			'sylhet'	=> 'Sylhet',

			),

		), $location->get_value('customer_location'));
	}

add_action('woocommerce_after_checkout_billing_form', 'dolon_add_custom_field_customer_location');



// Check the customer is foreigner or native. It is also for Radio Button Field.


function check_foreigner_options() {

		return array(

		'option_1' => 'Bangladeshi',
		'option_2' => 'Foreigner',
		'option_3' => 'Dual Citizen',
		);
}


function check_citizenship($citizen){

		woocommerce_form_field('citizen', array(

			'type'  	=> 'radio',
			'label'		=> 'Your Citizenship',
			'class'		=> array('customer-citizenship'),
			'options'	=> check_foreigner_options(),

 		), $citizen->get_value('citizen'));
}


add_action('woocommerce_after_checkout_billing_form', 'check_citizenship');




//  For Date Field option




function new_custom_birthdate($new_birthdate){

		woocommerce_form_field('new_birthdate', array(

		'label' 	=> 'Your new birthdate:',
		'type'		=> 'date',
		'required'	=> 'true',
		'class' 	=> array('new-birthdate'),

		), $new_birthdate->get_value('new_birthdate'));
}

add_action('woocommerce_after_checkout_billing_form', 'new_custom_birthdate');




	// Update check citizenship field with custom value


	
function custom_checkout_field_check_citizenship( $modified_citizen) {

    if ( isset($_POST['citizen']) && ! empty($_POST['citizen']) ) {

         $modified_citizen->update_meta_data( 'citizen', sanitize_text_field($_POST['citizen']) );
    }
}

add_action( 'woocommerce_checkout_create_order', 'custom_checkout_field_check_citizenship', 10, 2 );



/* ********Display Citizenship value in the thank you page******* */




function my_custom_citizenship_display_thank_you_page( $modified_citizen) {

    if( $check_citizenship = $modified_citizen->get_meta('citizen') ) {

        $value = check_foreigner_options()[$check_citizenship];

        echo '<p><strong>'.__('Your Citizenship is : ').'</strong> ' . $value . '</p>';
    }
}

add_action( 'woocommerce_order_details_after_customer_details', 'my_custom_citizenship_display_thank_you_page', 10, 1 );



// Display Citizenship field value on the Admin order edit page



function my_custom_citizenship_display_admin_order_page( $modified_citizen ) {

    if( $check_citizenship = $modified_citizen->get_meta('citizen') ) {

        $value = check_foreigner_options()[$check_citizenship];

        echo '<p><strong>'.__('Your itizenship is : ').'</strong> ' . $value . '</p>';
    }
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_citizenship_display_admin_order_page', 10, 1 );




/* *********Update New BirthDate custom field with value***** */



function custom_checkout_field_new_birthdate( $modified_birthdate) {

    if ( isset($_POST['new_birthdate']) && ! empty($_POST['new_birthdate']) ) {

         $modified_birthdate->update_meta_data( 'new_birthdate', sanitize_text_field($_POST['new_birthdate']) );
    }
}

add_action( 'woocommerce_checkout_create_order', 'custom_checkout_field_new_birthdate', 10, 2 );
	



/* ********Display new BirthDate in the thank you page******* */



function my_custom_new_birthdate_display_thank_you_page( $modified_new_birthdate) {

    if( $new_birthdate = $modified_new_birthdate->get_meta('new_birthdate') ) {

        // $value = check_foreigner_options()[$new_birthdate];
        echo '<p><strong>'.__('Your New Birth Date is : ').'</strong> ' . $new_birthdate . '</p>';
    }
}

add_action( 'woocommerce_order_details_after_customer_details', 'my_custom_new_birthdate_display_thank_you_page', 10, 1 );



/* *** Display custom new Birthdate in Admin order page**** */


function my_custom_new_birthdate_display_admin_order_page( $modified_new_birthdate ) {

    if( $new_birthdate = $modified_new_birthdate->get_meta('new_birthdate') ) {
        // $value = check_foreigner_options()[$check_citizenship];
        echo '<p><strong>'.__('Your itizenship is : ').'</strong> ' . $new_birthdate . '</p>';
    }
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_new_birthdate_display_admin_order_page', 10, 1 );


?>