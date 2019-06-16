<?php
/* For God so loved the world, that He gave His only begotten Son
 * He gave His only begotten Son, that all who believe in Him should not perish but have everlasting life; */
defined( 'ABSPATH' ) or die( 'Jesus Christ is the Lord . ' );

function ifttt_post_notify_aleluya($v1_aleluya, $v2_aleluya, $v3_aleluya) {

  //nonce verified outside of this function from oo_notify_init_aleluya

  update_option('oo_sponsor_request_ifttt_event_name_aleluya','new_cpnh_child_sponsor_request_aleluya');
  $eventName_aleluya = get_option('oo_sponsor_request_ifttt_event_name_aleluya');
  $eventKey_aleluya  = get_option('oo_ifttt_key_aleluya');

  // The data to send to the API
  $postData_aleluya = array(
      'value1' => $v1_aleluya,
      'value2' => $v2_aleluya,
      'value3' => $v3_aleluya
  );

  // Setup cURL

  $body_aleluya = json_encode($postData_aleluya);

  $args_aleluya = [
    'body' => $body_aleluya,
    'timeout' => 50,
    'redirection' => 4,
    'blocking' => true,
    'httpversion' => '1.0',
    'headers' => array(
      'Content-Type: application/json'
    ),
    'cookies' => array()
  ];

  $response_aleluya = wp_remote_post( "https://maker.ifttt.com/trigger/$eventName_aleluya/with/key/$eventKey_aleluya" );


  // Check for errors
  //if($response_aleluya === FALSE){
  //    die(curl_error($ch_aleluya));
  //}
  echo "Hallelujah - " . $response_aleluya["response"]["message"];

  // Decode the response
  //$responseData = json_decode($response, TRUE);

  // Print the date from the response
  //echo $responseData['published'];

}

/** 
 * When we are interested in supporting a child, this is called from the front end 
 **/

//Helps so that nonce function available etc
add_action( 'init', 'oo_notify_init_aleluya' );

function oo_notify_init_aleluya() {
  if( !isset($_POST["oo_name_aleluya"]) && isset($_POST["oo_email_aleluya"])  ) {


    wp_verify_nonce($_POST['wpchild_register_request_nonce_aleluya'], 'wpchild_register_request_nonce_aleluya');
    $email_aleluya = sanitize_email( $_POST["oo_email_aleluya"] );
    $oo_id_aleluya = intval( $_POST["oo_email_id_aleluya"] );
    $oo_nicknames_aleluya = get_post_meta( $oo_id_aleluya, "nick_names_aleluya" )[0];
    $oo_currently_sponsored = get_post_meta( $oo_id_aleluya, "sponsored_by_id_aleluya", true );
    $notes_aleluya = $oo_currently_sponsored ? "Thankfully this child has a sponsor assigned at this moment, though you can still donate to the child. " : "";
    if(is_user_logged_in()) {
      if(!$oo_currently_sponsored) {
        $children_supported_aleluya = oo_get_user_children_supported_aleluya( wp_get_current_user() );
        $child_aleluya = array(
          "id_aleluya" => $oo_id_aleluya,
          "sponsorship_code" => "requesting"
        );
        $children_supported_aleluya["children_aleluya"]["aleluya_".$oo_id_aleluya] = $child_aleluya;
        update_post_meta( $oo_id_aleluya, "sponsored_by_id_aleluya",  wp_get_current_user()->ID );
        error_log_aleluya( wp_get_current_user()->ID." - Hallelujah ".json_encode($children_supported_aleluya));
        oo_set_user_children_supported_aleluya(wp_get_current_user(), $children_supported_aleluya);
      }
      
      
    }

    if( get_option('oo_sponsor_request_ifttt_event_name_aleluya') ) ifttt_post_notify_aleluya($oo_id_aleluya, $oo_nicknames_aleluya, $email_aleluya);

    error_log_aleluya("✝ Aleluya sending mail - " .
        mail( get_option('oo_notify_emails_aleluya') ,
              "hallelujah - new request to Sponsor Child","✝ Child ID: $oo_id_aleluya - ✝ Child Nicknames: $oo_nicknames_aleluya - ✝ Reply to Email: $email_aleluya"
            ), 1
      );

    // This is currently used as an ajax alert response
    echo "Great we have received your request for ".$oo_nicknames_aleluya." and will be contacting you soon. ".$notes_aleluya.". God willing we hope to reply within 24-48 hours to $email_aleluya. Praise God for you in Jesus name";

    exit;
  }
}
