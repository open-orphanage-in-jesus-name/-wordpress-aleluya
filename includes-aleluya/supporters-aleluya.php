<?php 
// For God so loved the world, that He gave His only begotten Son, that all who believe in Him should not perish but have everlasting life
defined( 'ABSPATH' ) or die( 'Jesus Christ is the Lord . ' );

function stripeCustSkMetaTag_aleluya() {
  return 'oo_stripe_'.hash('ripemd160', get_option('oo_stripe_sk_key_aleluya') ).'_customer_id_aleluya';
}


//Create or update Stripe customer
function stripeCreateOrUpdateCustomer_aleluya($user_id_aleluya) {

  if(! get_option('oo_stripe_sk_key_aleluya') ) return null;
  \Stripe\Stripe::setApiKey( get_option('oo_stripe_sk_key_aleluya') );

  $current_user_aleluya = get_user_by("id", $user_id_aleluya);

  $stripe_customer_id_aleluya = get_user_meta($user_id_aleluya, stripeCustSkMetaTag_aleluya())[0];

  $fields_aleluya = [
    "description" => "Open Orphanage Customer #".$user_id_aleluya." for ".$current_user_aleluya->user_login." - ".$current_user_aleluya->user_email." on ".get_site_url(),
    "email" => $current_user_aleluya->user_email,
    "name" => $current_user_aleluya->user_firstname." ".$current_user_aleluya->user_lastname,
    "address" => [
      "line1" => "", //only one required, hallelujah
      "line2" => "",
      "city" => "",
      "state" => "",
      "country" => "",
      "postal_code" => "",
    ]
  ];

  if(isset( $_POST['oo_stripe_token_aleluya'] )) {
    $token_aleluya = sanitize_text_field( $_POST['oo_stripe_token_aleluya'] ); //seems like the most apt method, we need base64 chars and underscore i think, while i can't see a particular danger right now with this field, sanitizing is a good overall practice.
    $fields_aleluya['source'] = $token_aleluya;
  }

  if( ! $stripe_customer_id_aleluya ) {
    $customer_aleluya = \Stripe\Customer::create([ $fields_aleluya ]);
    update_user_meta($user_id_aleluya, stripeCustSkMetaTag_aleluya() , $customer_aleluya->id);

  } else { 
    $customer_aleluya = \Stripe\Customer::update( $stripe_customer_id_aleluya, $fields_aleluya );

  }

  return $customer_aleluya;

}


/* If we have a stripe key, this will also create a stripe customer for that key, it creates a new customer for the same user if the key changes (for testing and live customers for example) */
add_action( 'user_register', 'oo_registration_save_aleluya', 10, 1 );
function oo_registration_save_aleluya( $user_id_aleluya ) {
  stripeCreateOrUpdateCustomer_aleluya($user_id_aleluya);
}







