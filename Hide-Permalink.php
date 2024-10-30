<?php
/*
Plugin Name: Hide Permalink Until Title is Selected - Feature as Plugin for WordPress Core
Description: This Plugin is intended to be submitted as a core WordPress feature. It makes the Permalink row in that appears beneath TItles on the WordPress Admin only appear when you've selected or hovered over the title. This decreases the vertical length of the page and simplifies / cleans up the UI.
Author: WPPluginCo.com (@wppluginco) and Spencer Hill (@s3w47m88)
Author URI: https://www.wppluginco.com/
Version: 1.0.5
*/


add_action('admin_head', 'hputis_hidepermalink');

function hputis_hidepermalink() {
  echo '<style>
    #edit-slug-box {
 	display: block;
	margin-right:15px;
 }
 #titlediv:hover .inside {
 	height: 40px;
	
 }
 #titlediv .inside {
 	height: 0;
	overflow: hidden;
	transition: 0.3s ease-in;
        position: absolute;
        left: 0;
        top: 38px;
        z-index: 999999;
        width: 100%;
 }
 #edit-slug-box {
 	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	border-top: none;
 	line-height: 40px;
 	height: 38px;
 	outline: 0;
 	margin: 0;
 	background-color: #fff;
	}
	
	#edit-slug-box .button.button-small {
       margin: 7px !important;
    }
	
	#edit-slug-buttons .save {
		color: #FFF !important;
        background: #008ec2 !important;
        border-color: #006799 !important;
	}
	
	#edit-slug-buttons .cancel {
		padding: 0px 5px;
	}
	
	#titlediv .insidenew {
 	height: 40px !important;
	
 }
</style>';
  }
  

add_action('in_admin_footer', 'hputis_hideshowpermalink');
    
function hputis_hideshowpermalink () { 
$viewlinkhideshow = get_permalink(); ?>
<input id="hputislinkchange" type="hidden" value="<?php echo $viewlinkhideshow; ?>">

 <script type="text/javascript">
 jQuery( document ).ready(function() {
	 jQuery("#titlediv input").focus(function() {
      jQuery('#titlediv .inside').addClass("insidenew");       
      //return false;
    });
	
	jQuery("#titlediv input").blur(function() {
      jQuery('#titlediv .inside').removeClass("insidenew");       
      //return false;
    });
	 
	jQuery(window).bind("load", function() {
	      jQuery('#edit-slug-buttons').find('button').trigger('click');
		  jQuery("#edit-slug-buttons .save").html('Save');
		  jQuery("#edit-slug-buttons .cancel").removeClass("button-link");
		  jQuery("#edit-slug-buttons .cancel").addClass("button");
		  jQuery("#edit-slug-buttons .cancel").addClass("button-small");
		   var blahutlink = jQuery('#hputislinkchange').val();
		   var r = jQuery('<a href="' + blahutlink + '"  class="view button button-small" target="_blank">View</a>');
		  jQuery("#edit-slug-buttons").append(r);
		  jQuery("#new-post-slug").blur();
		  
		       var txt = jQuery('#title');  
                if (txt.val() != null && txt.val() != '') {  
                   jQuery('#titlediv .inside').show();
                } else {  
                     jQuery('#titlediv .inside').hide(); 
                }
		});
	   
	   jQuery( '#titlediv' ).on( 'focus', '#new-post-slug', function() {
		jQuery('#titlediv .inside').addClass("insidenew");  
	  });
	  
	   jQuery( '#titlediv' ).on( 'blur', '#new-post-slug', function() {
		jQuery('#titlediv .inside').removeClass("insidenew");  
	  });
	});

</script>
<?php
	}
?>
