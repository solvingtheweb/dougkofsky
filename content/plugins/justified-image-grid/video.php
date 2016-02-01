<?php
	// Loaded as part of a template redirect, that's how it has access to WP functions
	if(empty($_GET["file"])){
		echo 'Video file is not specified.';
		die();
	}
	$jig_settings = get_option('jig_settings');

	// Defaults for these settings if they are not yet in the database
	if(empty($jig_settings['video_area_background'])){
		$jig_settings['video_area_background'] = 'transparent';
	}
	if(empty($jig_settings['video_autoplay'])){
		$jig_settings['video_autoplay'] = 'yes';
	}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title><?php _e('Justified Image Grid video player', 'jig_td'); ?></title>
	<link rel='stylesheet' id='mediaelement-css'  href='<?php echo includes_url("js/mediaelement/mediaelementplayer.min.css"); ?>' type='text/css' media='all' />
	<link rel='stylesheet' id='wp-mediaelement-css'  href='<?php echo includes_url("js/mediaelement/wp-mediaelement.css"); ?>' type='text/css' media='all' />
	<script type='text/javascript' src='<?php echo includes_url("js/jquery/jquery.js"); ?>'></script>
	<script type='text/javascript'>
		/* <![CDATA[ */
		$ = jQuery;
		var _wpmejsSettings = {"pluginPath":"<?php echo str_replace('/', '\/', includes_url('js/mediaelement/', 'relative')); ?>"};
		function inIframe () {
		    try {
		        return window.self !== window.top;
		    } catch (e) {
		        return true;
		    }
		}
		function canPlay(){
			var player = new MediaElementPlayer('#jigVideoPlayer');
			<?php if($jig_settings['video_autoplay'] == 'yes') { echo 'player.play();'; } ?> // autoplay or not
		}
		$(document).ready(function() {
			//in iframe, only if same host
			try{
				if(inIframe() === true && "<?php echo site_url(); ?>".indexOf(window.top.location.host) != -1){
					canPlay();
					return;
				}
			} catch (e){}
			
			// if referrer is the same site
			<?php if(isset($_SERVER["HTTP_REFERER"])){?>
			
			var hostMatchPattern = new RegExp('^https?:\/\/'+window.location.host+'/', 'i');
			if(hostMatchPattern.test("<?php echo esc_attr($_SERVER['HTTP_REFERER']); ?>") != -1){
				canPlay();
				return
			}
			<?php }else{
				echo '// (no referrer)';
			} ?>


			// content is hosted on the site
			if(<?php echo '"'.esc_attr($_GET['file']).'".indexOf("'.site_url().'") != -1'.(!empty($_GET["poster"]) ? ' && "'.esc_attr($_GET['poster']).'".indexOf("'.site_url().'") != -1' : ''); ?>){
				canPlay();
				return
			}

			/*	in case it's in a lightbox(iframe) but called from another site or it's not in a lightbox(iframe)
				and has no referrer or it's not the main site
				and the content is not hosted on the main site
			*/
			
			jQuery('video').hide().each(function () {
				this.pause();
				$(this).attr('data-src',$(this).attr('src')).attr('src','')
			});
			jQuery('body').append('<div class="securityNotice"><strong>Security notice</strong><br />Video player is only accessible from a lightbox and on the same host.<br />Otherwise it has to have the parent site as the referrer or the video and its poster hosted on the same site.</div>');

		});
		/* ]]> */
	</script>
	<script type='text/javascript' src='<?php echo includes_url("js/mediaelement/mediaelement-and-player.min.js"); ?>'></script>
	<script type='text/javascript' src='<?php echo includes_url("js/mediaelement/wp-mediaelement.js"); ?>'></script>
	<style type="text/css">
		html, body, div, span, applet, object, iframe, img, embed, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}
		body {
			line-height: 1;
		}
		html, body{
			overflow: hidden;
			width: 100%;
			height: 100%;
		}
		video{
			max-width: 100%;
			max-height: 100%;
		}
		.mejs-container, .mejs-embed, .mejs-embed body{
			background: <?php echo $jig_settings['video_area_background']; ?>; /* player background */
		}
		.mejs-controls .mejs-button button:focus{
			outline: none;
		}
		.mejs-controls .mejs-time-rail .mejs-time-loaded {
			background: #676767;
		}
		.me-cannotplay{
			height: auto !important;
			max-height: 100%;
		}
		.securityNotice {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			font-size: 16px;
			text-align: center;
		    font: small arial,sans-serif;
		   	color:#b71c1c;
		   	line-height: 1.8;
		}
	</style>
</head>

<body>
	<video id="jigVideoPlayer" height="100%" width="100%"  <?php echo !empty($_GET["poster"]) ? 'poster="'.esc_attr($_GET["poster"]).'"' : ''; ?> src="<?php echo esc_attr($_GET["file"]); ?>">
	</video>
</body>
</html>