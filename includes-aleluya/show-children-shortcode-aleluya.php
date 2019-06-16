<?php
/* For God so loved the world, that He gave His only begotten Son, that all who believe in Him should not perish but have everlasting life,
 * He gave His only begotten Son, that all who believe in Him should not perish but have everlasting life; */
defined( 'ABSPATH' ) or die( 'Jesus Christ is the Lord . ' );

$oo_child_register_js_aleluya_done = false;

add_action('wp_head', 'oo_child_register_js_aleluya');

function oo_child_register_js_aleluya() {
	global $oo_child_register_js_aleluya_done;
  if( $oo_child_register_js_aleluya_done ) return "";
  $oo_child_register_js_aleluya_done = true;
   /**
   * add a nonce for the registration
   */

  $wpchild_register_request_nonce_aleluya = wp_create_nonce('wpchild_register_request_nonce_aleluya');
  $str_aleluya = '<script> var wpchild_register_request_nonce_aleluya = "' .$wpchild_register_request_nonce_aleluya.'"; </script>';



  if( ! is_user_logged_in() ) {
    // If the user is not logged in, check to see if registrations are enabled
    //Thanks Jesus for Robert hue  @ https://wordpress.stackexchange.com/a/167834
    if ( ! get_option( 'users_can_register' ) ) {
      // If we cannot register, at least allow sending an email
      $str_aleluya .=<<<ALELUYA
        <script>
        var oo_children_aleluya = [];
        function oo_sponsor_button_clicked_aleluya(id_aleluya) {
          var email_aleluya = prompt('Please enter your email, we will use this to contact you regarding sponsoring the requested child:');

          if (!email_aleluya) return;
          var xhr_aleluya = new XMLHttpRequest();
          xhr_aleluya.open('POST', '/');
          xhr_aleluya.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          xhr_aleluya.onload = function() {
            if (xhr_aleluya.status === 200) {
                alert('Hallelujah: ' + xhr_aleluya.responseText);
            }
            else {
                alert('Hallelujah Request failed.  Returned status of ' + xhr_aleluya.status);
            }
          };
          xhr_aleluya.send(encodeURI(
            'oo_email_id_aleluya='+id_aleluya+
            '&oo_email_aleluya='+email_aleluya+
            '&wpchild_register_request_nonce_aleluya='+wpchild_register_request_nonce_aleluya
            )
          );
        }
        </script>
ALELUYA;

    } else {
      // Ok we can register so send to registration page
      $str_aleluya .=<<<ALELUYA
        <script>
        var oo_children_aleluya = [];
        function oo_sponsor_button_clicked_aleluya(id_aleluya) {
          alert('We will send you to the registration page, where you can create a user for yourself. If you already have a user then Log In Instead please.');
ALELUYA;
          $reg_url_aleluya = wp_registration_url();
          $reg_url_aleluya .= (( strpos($reg_url_aleluya, "?" ) === false ) ? '?' : '&' ) . 'child_id_aleluya=';
           $str_aleluya .='window.location="'.esc_url( $reg_url_aleluya ).'" + id_aleluya;';
          $str_aleluya .=<<<ALELUYA
        }
        </script>
ALELUYA;
    }

  } else {
    //If here, then we are logged in and we should assign the child to the user
    $email_aleluya = wp_get_current_user()->user_email;
    $profile_page_aleluya = get_edit_user_link(); ;
    //WIP
    $str_aleluya .=<<<ALELUYA
      <script>
      var oo_children_aleluya = [];
      function oo_sponsor_button_clicked_aleluya(id_aleluya) {
        var email_aleluya = "$email_aleluya";
        //alert('We are registering this child with you, please confirm your sponsorship and details in the back end. ');

        if (!email_aleluya) return;
        var xhr_aleluya = new XMLHttpRequest();
        xhr_aleluya.open('POST', '/');
        xhr_aleluya.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xhr_aleluya.onload = function() {
          if (xhr_aleluya.status === 200) {
              console.log('Hallelujah: ' + xhr_aleluya.responseText);
              window.location="$profile_page_aleluya";
          }
          else {
              window.location="$profile_page_aleluya";
          }
        };
          xhr_aleluya.send(encodeURI(
            'oo_email_id_aleluya='+id_aleluya+
            '&oo_email_aleluya='+email_aleluya+
            '&wpchild_register_request_nonce_aleluya='+wpchild_register_request_nonce_aleluya
            )
          );
      }
      </script>
ALELUYA;
    }

    $str_aleluya .=<<<ALELUYA
    <script>
    function oo_viewmore_button_clicked_aleluya(url_aleluya) {
      window.location=url_aleluya;
    }
    </script>
ALELUYA;
  echo $str_aleluya;
  return $str_aleluya;
}

// [oo_aleluya child_aleluya="child_aleluya-value"]
function oo_aleluya_func( $atts ) {
  global $child_fields_aleluya, $public_child_fields_aleluya, $oo_dir_aleluya, $oo_upload_url_aleluya;
  $a = shortcode_atts( array(
    'child_aleluya' => 'TODO 1 ALeluya',
    'filter_aleluya' => 'aleluya, something else',
  ), $atts );
  $str_aleluya = "";


  /**
   * First add the styles
   */
  $str_aleluya .=<<<ALELUYA
  <style>
    div.oo_children_aleluya { display:         flex;
  flex-wrap:       wrap;
	justify-content: center;
    }
    div.oo_children_aleluya td.label_aleluya { width:112px; font-weight:900; text-align: right;padding-right: 8px;}
    div.oo_children_aleluya td.content_aleluya {}
    div.oo_children_aleluya td { vertical-align: top; border:0px; padding: 0px; }
    div.oo_children_aleluya img.child_avatar_aleluya { display: inline-block; vertical-align:top;  height:224px; max-width:224px; width:224px;  border-radius: 4px; border: 1px solid black; padding: 1px;margin: 2px;}
    div.oo_children_aleluya .new_child_aleluya  { dispay: block-inline; max-width:256px; border-radius:8px; margin: 2px; padding-top:2px; border: 1px solid #888; display: block-inline; }
    div.oo_children_aleluya .oo_child_meta_aleluya, .oo_child_desc_aleluya  { margin:4px; padding: 0px; border: 0px; vertical-align: top; width: 240px; margin-top: 0px; display: inline-block;}
    div.oo_children_aleluya td.name_aleluya {text-align: center; font-weight: 900;font-size:larger;}
    div.oo_children_aleluya div.child_description_aleluya { line-height: 2.5ex;  text-align: justify; height: 10ex; min-height: 10ex; overflow: hidden;
    text-overflow: ellipsis;}
    td.label_aleluya, td.content_aleluya { padding:4px; }
    td.label_aleluya { font-weight:bolder;}
    div.oo_children_aleluya td.content_aleluya { font-weight: bolder;padding:4px; line-height: 2.5ex;  text-align: justify; height: 2.5ex; min-height: 2.5ex; overflow: hidden;
    text-overflow: ellipsis;}
    div.oo_children_aleluya td.child_img_holder_aleluya {text-align: center}
  </style>
ALELUYA;

	$str_aleluya .= oo_child_register_js_aleluya();
	$str_aleluya .= '<div class="oo_children_aleluya">';
 /* $str_aleluya .=<<<ALELUYA
<div class='oo_aleluya'>
  <div class='oo_chooser_aleluya'>
  <span class='oo_label_aleluya'>Sort By:</span><select><option>Recent</option><option>Age</option><option>Coming soon God Willing</option></select>
</div>
ALELUYA;
	*/


//Thanks You Jesus for Milo @ https://wordpress.stackexchange.com/q/191093
  $loop_aleluya = new WP_Query( array('post_type' => 'child_aleluya', 'posts_per_page'   => -1) );
  while ( $loop_aleluya->have_posts() ) :
    $loop_aleluya->the_post();
    $id_aleluya  = get_the_ID();

    $str_aleluya .= oo_child_minipagestats_htmlstr_aleluya($id_aleluya);
      //$str_aleluya.=get_the_meta();
  endwhile;

  $str_aleluya .= "</div><div style='clear:both'></div>";


  return $str_aleluya."<!--Jesus Christ is the Lord-->";
}
add_shortcode( 'oo_aleluya', 'oo_aleluya_func' );


function oo_child_minipagestats_htmlstr_aleluya($id_aleluya) {
  global $public_child_fields_aleluya,$oo_upload_url_aleluya;
  $newUrl_aleluya = $oo_upload_url_aleluya."thumbs-aleluya/".$id_aleluya."-192x192-aleluya.jpg";
  $nick_names_aleluya  = get_post_meta($id_aleluya, "nick_names_aleluya", true);
  $description_aleluya = get_post_meta($id_aleluya, "description_aleluya", true);
  $morelink_aleluya    = esc_url(get_post_permalink($id_aleluya));
  oo_make_child_thumb_aleluya($id_aleluya);

   $str_aleluya =<<<ALELUYA
  <table class='new_child_aleluya' align='center'>
    <tr><td class="child_img_holder_aleluya"><img class="child_avatar_aleluya" src="$newUrl_aleluya"/></td></tr>
    <tr><td colspan='2' class='name_aleluya'> $nick_names_aleluya </td></tr>
    <tr><td align='center'>
      <table class='oo_child_desc_aleluya'>
        <tr/><td>
          <div class="child_description_aleluya" >$description_aleluya</div><br/>
          <div class="show_content" align="center"><button class="btn btn-primary" onclick="oo_sponsor_button_clicked_aleluya($id_aleluya);">Sponsor this Child</button></div>
        </td></tr>
      </table>
    </tr></td>
    <tr><td align='center'>
      <table class='oo_child_meta_aleluya'>
ALELUYA;

    foreach($public_child_fields_aleluya as $cf_aleluya => $cf_desc_aleluya) {
      $cf_val_aleluya = get_post_meta($id_aleluya, $cf_aleluya)[0];
      $str_aleluya .=<<<ALELUYA
        <tr><td class='label_aleluya'>$cf_desc_aleluya: </td><td class='content_aleluya'>
        $cf_val_aleluya
        </td></tr>
ALELUYA;
    }
  $bd_val_aleluya = get_post_meta($id_aleluya, "birth_date_aleluya")[0] . "";
  $bd_date_aleluya = DateTime::createFromFormat('Y/n/j', $bd_val_aleluya);
  $now_aleluya    = new DateTime();

  $age_aleluya   = $bd_date_aleluya ? $now_aleluya->diff($bd_date_aleluya) : "";

  $str_aleluya .=<<<ALELUYA
    <tr><td class='label_aleluya'>Age: </td><td class='content_aleluya'> $age_aleluya->y </td></tr>
    </table>
  </tr></td>
  <tr><td>
    <div class="show_content" align="center">
      <button class="btn btn-secondary" onclick="oo_viewmore_button_clicked_aleluya('$morelink_aleluya');">
        More About this Child
      </button><br/><br/>
    </div>
  </tr></td>
  </table>
ALELUYA;

return $str_aleluya;


}


function oo_child_pagestats_htmlstr_aleluya($id_aleluya) {
  global $public_child_fields_aleluya,$oo_upload_url_aleluya;
  $newUrl_aleluya = $oo_upload_url_aleluya."thumbs-aleluya/".$id_aleluya."-512x512-aleluya.jpg";
  $nick_names_aleluya  = get_post_meta($id_aleluya, "nick_names_aleluya", true);
  $description_aleluya = get_post_meta($id_aleluya, "description_aleluya", true);
  $morelink_aleluya    = esc_url(get_post_permalink($id_aleluya));
  oo_make_child_thumb_aleluya($id_aleluya);
 $str_aleluya =<<<ALELUYA
  <style>
    div.oo_children_aleluya { display:         flex;
  flex-wrap:       wrap;
	justify-content: center;
    }
    div.oo_children_aleluya td.label_aleluya { width:112px; font-weight:900; text-align: right;padding-right: 8px;}
    div.oo_children_aleluya td.content_aleluya {}
    div.oo_children_aleluya td { vertical-align: top; border:0px; padding: 0px; }
    div.oo_children_aleluya img.child_avatar_aleluya { display: inline-block; vertical-align:top;  height:224px; max-width:224px; width:224px;  border-radius: 4px; border: 1px solid black; padding: 1px;margin: 2px;}
    div.oo_children_aleluya .new_child_aleluya  { dispay: block-inline; max-width:256px; border-radius:8px; margin: 2px; padding-top:2px; border: 1px solid #888; display: block-inline; }
    div.oo_children_aleluya .oo_child_meta_aleluya, .oo_child_desc_aleluya  { margin:4px; padding: 0px; border: 0px; vertical-align: top; width: 240px; margin-top: 0px; display: inline-block;}
    div.oo_children_aleluya td.name_aleluya {text-align: center; font-weight: 900;font-size:larger;}
    div.oo_children_aleluya div.child_description_aleluya { line-height: 2.5ex;  text-align: justify; height: 10ex; min-height: 10ex; overflow: hidden;
    text-overflow: ellipsis;}
    td.label_aleluya, td.content_aleluya { padding:4px; }
    td.label_aleluya, td.name_aleluya{ text-align:center;font-weight:bolder;}
    div.oo_children_aleluya td.content_aleluya { font-weight: bolder;padding:4px; line-height: 2.5ex;  text-align: justify; height: 2.5ex; min-height: 2.5ex; overflow: hidden;
    text-overflow: ellipsis;}
    div.oo_children_aleluya td.child_img_holder_aleluya {text-align: center}
  </style>
ALELUYA;


   $str_aleluya .=<<<ALELUYA
  <table class='new_child_aleluya' align='center'>
    <tr><td class="child_img_holder_aleluya" align="center" style="width:50%;background: url($newUrl_aleluya); background-size: cover;">&nbsp;</td>
    <td>
      <table>
        <tr><td colspan='2' class='name_aleluya' align="center"> $nick_names_aleluya </td></tr>
        <tr><td align='center'>
          <table class='oo_child_desc_aleluya'>
            <tr/><td>
              <div class="child_description_aleluya" >$description_aleluya</div><br/>
              <div class="show_content" align="center"><button class="btn btn-primary" onclick="oo_sponsor_button_clicked_aleluya($id_aleluya);">Sponsor this Child</button></div>
            </td></tr>
          </table>
        </tr></td>
        <tr><td align='center'>
          <table class='oo_child_meta_aleluya'>
ALELUYA;

    foreach($public_child_fields_aleluya as $cf_aleluya => $cf_desc_aleluya) {
      $cf_val_aleluya = get_post_meta($id_aleluya, $cf_aleluya)[0];
      $str_aleluya .=<<<ALELUYA
        <tr><td class='label_aleluya'>$cf_desc_aleluya: </td><td class='content_aleluya'>
        $cf_val_aleluya
        </td></tr>
ALELUYA;
    }
  $bd_val_aleluya = get_post_meta($id_aleluya, "birth_date_aleluya")[0] . "";
  $bd_date_aleluya = DateTime::createFromFormat('Y/n/j', $bd_val_aleluya);
  $now_aleluya    = new DateTime();

  $age_aleluya   = $bd_date_aleluya ? $now_aleluya->diff($bd_date_aleluya) : "";

  $str_aleluya .=<<<ALELUYA
      <tr><td class='label_aleluya'>Age: </td><td class='content_aleluya'> $age_aleluya->y </td></tr>
      </table>
    </tr></td>
    </table>
    </td></tr>
  </table>
ALELUYA;

return $str_aleluya;


}
//Thank You Jesus for https://www.wpbeginner.com/wp-tutorials/how-add-signature-ads-post-content-wordpress/
function oo_after_child_post_content_aleluya($in_content_aleluya){
    //if (is_single()) {
    if( get_post_type() == "child_aleluya" ) {
      $nick_names_aleluya   = get_post_meta( get_the_ID(), "nick_names_aleluya", true );

    error_log_aleluya("Praise Jesus - ".get_the_ID());
      //$fin_content_aleluya = oo_child_register_js_aleluya().'<button  class="btn btn-primary" onclick="oo_sponsor_button_clicked_aleluya(' .get_the_ID(). ');">Sponsor this Child</button>';
      $fin_content_aleluya = oo_child_register_js_aleluya();
      $fin_content_aleluya .= oo_donation_block_shortcode_aleluya_func( array( "heading_aleluya" => "p", "expandable_aleluya" => "yes", "purpose_aleluya" => $nick_names_aleluya ) );
      $fin_content_aleluya .= oo_child_pagestats_htmlstr_aleluya(get_the_ID());

      return $fin_content_aleluya . $in_content_aleluya;
    } else {
      return $in_content_aleluya;
    }

}
add_filter( "the_content", "oo_after_child_post_content_aleluya" );

