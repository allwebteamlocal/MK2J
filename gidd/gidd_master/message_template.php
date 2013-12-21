<?php
/** 
* intended to use for displaying messages from plugins & themes
* it can be useful for dummy pages for showing errors or succes
*/

function gidd_message_template( $msg = "" ){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?php echo bloginfo("name"); echo " | "; echo bloginfo("description"); ?>
	</title>
	<style type="text/css">
		body{ background: #efefef; font-family: arial, helvetica, sans-serif; font-size: 13px; line-height: 18px; }
		.message-content{ width: 450px; background: #fff; border: 1px solid #ccc; padding: 20px; margin: 0 auto; color: #444; }
		.message-content p{ margin: 0; margin-bottom: 5px; }
		.message-link{ text-align: center; }
	</style>
</head>

<body class="message-template custom">
	
	<br/><br />
	
	<div class="message-wrap">
	
		<!-- message -->
		<div class="message-content">
			<?php
			
				if ( $msg != "" ){
					if ( is_array( $msg ) ):
						foreach( $msg as $m ){				
							echo '<div class="msg-box">';
							echo $m;
							echo '</div>';				
						}
					else:
					
						echo '<div class="msg-box">';
						echo $msg;
						echo '</div>';
					
					endif;
				}
			
			?>
			
		</div>
		
		<!-- links -->
		<br /><br />
		<div class="message-link">
			<a class="msg-home-link" href="<?php echo home_url(); ?>">Back to Home</a>
		</div>
		
	</div>
	
</body>
</html>
<?php
}

/** end */