<?php
/* Plugin name: Justified Image Grid
   Author: Firsh
   Author URI: http://stateofbliss.us
   Plugin URI: http://justifiedgrid.com
   Version: 1.7.1
   Description: Aligns your images into a Flickr / Google style thumbnail-grid gallery
   Text Domain: jig_td
*/
if(!class_exists("JustifiedImageGrid")){
	class JustifiedImageGrid {
		const PAGE_NAME = 'justified-image-grid';
		const SETTINGS_NAME = 'jig_settings';
		protected $defaults = array(		'thumbs_spacing'			=> 4,
											'animation_speed'			=> 300,
											'row_height'				=> 190,
											'height_deviation'			=> 40,
											'mobile_row_height'			=> '',
											'mobile_height_dev'			=> '',
											'limit'						=> '',
											'hidden_limit'				=> '',
											'load_more'					=> 'off',
											'load_more_mobile'			=> 'no',
											'load_more_limit'			=> 50,
											'load_more_text'			=> 'Load more',
											'load_more_count_text'		=> '(*count* images remaining)',

											'load_more_css'				=> "border: 1px solid #d3d3d3;
padding: 10px;
text-align: center;
margin: 5px auto 15px;
max-width: 155px;
cursor: pointer;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
box-shadow: 0 0 7px rgba(0,0,0,0.08);
background: #fcfcfc;
background: -moz-linear-gradient(top,  #fcfcfc 0%, #f8f8f8 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fcfcfc), color-stop(100%,#f8f8f8));
background: -webkit-linear-gradient(top,  #fcfcfc 0%,#f8f8f8 100%);
background: -o-linear-gradient(top,  #fcfcfc 0%,#f8f8f8 100%);
background: -ms-linear-gradient(top,  #fcfcfc 0%,#f8f8f8 100%);
background: linear-gradient(to bottom,  #fcfcfc 0%,#f8f8f8 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#f8f8f8',GradientType=0 );",

											'load_more_hover_css'		=> "border: 1px solid #c6c6c6;
background: #f8f8f8;
background: -moz-linear-gradient(top,  #f8f8f8 0%, #eeeeee 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f8f8f8), color-stop(100%,#eeeeee));
background: -webkit-linear-gradient(top,  #f8f8f8 0%,#eeeeee 100%);
background: -o-linear-gradient(top,  #f8f8f8 0%,#eeeeee 100%);
background: -ms-linear-gradient(top,  #f8f8f8 0%,#eeeeee 100%);
background: linear-gradient(to bottom,  #f8f8f8 0%,#eeeeee 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#eeeeee',GradientType=0 );",
										
											'load_more_auto_width'		=> 'on',
											'load_more_device_fix'		=> 'off',
											'max_rows'					=> '',
											'custom_width'				=> '',
											'width_mode'				=> 'responsive_fallback',
											'shortcode_alias'			=> 'justified_image_grid',
											'take_over_gallery'			=> 'hide',
											'take_over_nextgen'			=> array(),
											'take_over_ng_post_inserts'	=> 'no',
											'last_row'					=> 'normal',
											'aspect_ratio'				=> '',
											'disable_cropping'			=> 'no',
											'randomize_width'			=> '',
											'link_target'				=> '_self',
											'media_attacher'			=> 'disable',
											'post_tags_categories'		=> 'disable',
											'orderby'					=> 'menu_order',
											'wrap_text'					=> 'no',
											'allow_animated_gifs'		=> 'no',
											'allow_transp_pngs'	=> 'no',
											'error_checking'			=> 'yes',
											'disable_mobile_hover'		=> 'no',
											'mouse_disable'				=> 'no',
											'jquery'					=> 'nochange',
											'jquery_location'			=> 'header',
											'link_class'				=> '',
											'link_rel'					=> 'auto',
											'link_title_field'			=> 'description',
											'img_alt_field'				=> 'title',
											'custom_link_follow'		=> 'yes',
											'jquery_mobile'				=> 'no',
											'caption'					=> 'fade',
											'mobile_caption'			=> 'same',
											'title_field'				=> 'title',
											'caption_field'				=> 'description',
											'caption_opacity'			=> 0.6,
											'caption_bg_color'			=> '#000',
											'caption_match_width'		=> 'no',
											'caption_text_color'		=> '#FFF',
											'caption_height'			=> 54,
											'caption_align'				=> 'css',
											'v_center_captions'			=> 'off',
											'custom_fonts'				=> 'yes',
											'caption_text_shadow'		=> '',
											'gradient_caption_bg'		=> 'no',
											'gradient_caption_bg_css'	=> "background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.75) 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.75)));
background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.75) 100%);
background: -o-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.75) 100%);
background: -ms-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.75) 100%);
background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.75) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#bf000000',GradientType=0 );",
											'caption_title_size'		=> '',
											'caption_desc_size'			=> '',
											'caption_title_css'			=> "font-size: 15px;
font-weight: bold;
text-align:left;",
											'caption_desc_css'			=> "font-size: 12px;
font-weight: normal;
text-align:left;",
											'nextgen_breadcrumb_css'	=> "font-size: 12px;
margin-bottom: 10px;",
											'nextgen_cf_link'			=> '',
											'nextgen_lightbox_gallery' 	=> 'no',
											'ng_count'					=> 'yes',
											'ng_lightbox_gallery'		=> 'no',
											'ng_intersect_tags'			=> 'no',
											'ng_description'			=> 'no',
											'ng_remove_scripts'			=> 'no',
											'download_link'				=> 'no',											
											'download_link_text'		=> "Download",
											'flickr_link'				=> 'no',
											'flickr_link_text'			=> 'View this photo on Flickr',
											'flickr_link_target'		=> '_blank',
											'overlay'					=> 'hovered',
											'mobile_overlay'			=> 'same',
											'overlay_color'				=> '#000',
											'overlay_opacity'			=> 0.2,
											'overlay_icon'				=> 'off',
											'overlay_icon_opacity'		=> 0.6,
											'overlay_icon_url'			=> '',
											'overlay_icon_retina'		=> '',
											'outer_shadow'				=> 'none',
											'inner_shadow'				=> 'none',
											'outer_border_width'		=> '0',
											'outer_border_color'		=> 'black',
											'middle_border_width'		=> '0',
											'middle_border_color'		=> 'white',
											'inner_border_width'		=> '0',
											'inner_border_color'		=> 'rgba(0,0,0,0.1)',
											'inner_border'				=> 'always',
											'inner_border_animate'		=> 'width',
											'specialfx'					=> 'off',
											'mobile_specialfx'			=> 'same',
											'specialfx_type'			=> 'desaturate',
											'specialfx_options'			=> '',
											'specialfx_blend'			=> 1,
											'filterby'					=> 'off',
											'filter_all_text'			=> 'All',
											'filter_style'				=> 'buttons',
											'filter_orderby'			=> 'appearance',
											'filter_custom_order'		=> '',
											'filter_min_count'			=> '',
											'filter_top_x'				=> '',
											'filter_all_button'			=> 'yes',
											'filter_multiple'			=> 'no',
											'filter_smallest_color'		=> '#A3A3A3',
											'filter_smallest_size'		=> '11',
											'filter_largest_color'		=> '#000000',
											'filter_largest_size'		=> '22',
											'filter_tag_css'			=> 'padding: 3px;
margin: 0 2px 2px 0;
line-height: 20px;',
											'filter_tag_hover_css'		=> 'background-color: #eee;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;',
											'filter_button_css'			=> "border: 1px solid #d3d3d3;
background: #f9f9f9;
float: left;
padding: 6px 8px;
margin: 5px 5px 0 0;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
transition: background-color 0.2s;",
											'filter_button_hover_css'	=> "background: #f0f0f0;
border: 1px solid #c6c6c6;",
											'lightbox'					=> 'prettyphoto',
											'lightbox_max_size'			=> 'large',
											'mobile_lightbox' 			=> 'photoswipe',
											'prettyphoto_social'		=> 'yes',
											'prettyphoto_deeplinking'	=> 'advanced_deeplinking',
											'prettyphoto_theme'			=> 'pp_default',
											'prettyphoto_analytics'		=> 'no',
											'prettyphoto_settings'		=> "
animation_speed: 'normal',
slideshow: 3500,
opacity: 0.6,
show_title: true,
counter_separator_label: '/',
overlay_gallery: false,
default_width: 960,
default_height: 540,
autoplay: true",
											'colorbox_settings'			=> "
speed: 350,
slideshowSpeed: 3500,
opacity: 0.6,
maxWidth: '100%',
max_height: '100%'",
											'photoswipe_settings'			=> '
allowUserZoom: true,
captionAndToolbarAutoHideDelay: 5000,
doubleTapSpeed: 300,
doubleTapZoomLevel: 2.5,
imageScaleMethod: "fit",
slideshowDelay: 3000,
slideSpeed: 250,
zIndex: 1000,
enableMouseWheel: false',
											'colorbox_design'			=> '1',
											'min_height'				=> 0,
											'loading_background'		=> '',
											'text_before'				=> '',
											'text_after'				=> '',
											'margin'					=> 0,
											'fb_app_id'					=> '',
											'fb_app_secret'				=> '',
											'fb_authed'					=> '',
											'facebook_caching'			=> 60,
											'facebook_overview_caching'	=> 43200,
											'facebook_image_size'		=> 'larger',
											'fb_lightbox_album'			=> 'no',
											'fb_overview_slug'			=> 'facebook-album',
											'fb_breadcrumb_css'			=> "font-size: 12px;
margin-bottom: 10px;",
											'fli_api_key'				=> '',
											'fli_added'					=> '',
											'flickr_caching'			=> 60,
											'flickr_too_small_images'	=> 'upscale',
											'flickr_allow_big_images'	=> 'no',
											'ig_client_id'				=> '',
											'ig_client_secret'			=> '',
											'ig_authed'					=> '',
											'instagram_caching'			=> 60,
											'instagram_link'			=> 'no',
											'instagram_link_text'		=> 'View this photo on Instagram',
											'instagram_link_target'		=> '_blank',
											'rss_links_to'				=> 'permalink',
											'rss_description'			=> 'none',
											'rss_excerpt_length'		=> 20,
											'rss_excerpt_ending'		=> ' [...]',
											'rss_link'					=> 'no',
											'rss_link_target'			=> '_blank',
											'rss_link_text'				=> 'Read more',
											'rss_caching'				=> '',
											'timthumb_path'				=> '',
											'cdn_host'					=> '',
											'external_caching'			=> 'infinite',
											'use_timthumb'				=> 'yes',
											'jig_activated'				=> '',
											'quality'					=> 90,
											'retina_ready'				=> 'yes',
											'retina_quality'			=> 'auto',
											'developer_link' 			=> 'hide',
											'developer_link_text' 		=> 'powered by Justified Image Grid',
											'envato_user' 				=> 'Firsh',
											'currently_selected_tab'	=> '',
											'shortcode_role'			=> 'unlimited',
											'add_to_sitemap'			=> 'enable',
											'custom_CSS'				=> '',
											'proper_uninstall'			=> 'nochange'
											),
			$presets = 	array(	// Default out of the box
								'1' => array(),
								// Author's favorite
								'2' => array(		'thumbs_spacing' => 1,
													'row_height' => 215,
													'height_deviation' => 65,
													'caption' => 'fade',
													'caption_bg_color' => '#000',
													'caption_text_color' => '#FFF',
													'overlay' => 'others',
													'overlay_color' => '#000',
													'overlay_opacity' => 0.5,
													'specialfx' => 'others',
													'lightbox' => 'colorbox',
													'link_title_field' => 'title'),
								
								// Flickr style
								'3' => array(		'thumbs_spacing' => 8,
													'row_height' => 230,
													'height_deviation' => 80,
													'overlay' => 'off',
													'caption' => 'mixed',
													'caption_opacity' => 1,
													'caption_bg_color' => 'rgba(0,0,0,0.6)',
													'caption_text_color' => '#FFF',
													'caption_text_shadow' => '1px 1px 0 black',
													'caption_title_css'		=> "font-size: 13px;
font-weight: bold;
text-align:left;",
													'caption_desc_css'		=> "font-size: 11px;
font-weight: normal;
text-align:left;",
													'animation_speed' => 250,
													'specialfx' => 'off'),
								// G+ style
								'4' => array(		'thumbs_spacing' => 6,
													'row_height' => 280,
													'height_deviation' => 55,
													'overlay' => 'off',
													'caption' => 'fade',
													'caption_opacity' => 1,
													'caption_bg_color' => 'rgba(0,0,0,0.35)',
													'caption_text_color' => '#FFF',
													'caption_text_shadow' => '0 0 2px black',
													'animation_speed' => 150,
													'specialfx' => 'off'),
								// Fixed height, no fancy 
								'5' => array(		'thumbs_spacing' => 5,
													'row_height' => 175,
													'height_deviation' => 0,
													'caption' => 'off',

													'overlay' => 'off',
													'specialfx' => 'off'),
								// Artistic zen
								'6' => array(		'thumbs_spacing' => 0,
													'row_height' => 240,
													'height_deviation' => 60,
													'overlay' => 'others',
													'mouse_disable' => 'yes',
													'overlay_color' => '#000',
													'overlay_opacity' => 0.5,
													'caption' => 'fade',
													'caption_bg_color' => 'rgba(0,0,0,0.25)',
													'caption_text_color' => '#FFF',
													'caption_opacity' => 1,
													'caption_text_shadow' => '0 0 2px black',
													'animation_speed' => 600,
													'lightbox' => 'colorbox',
													'specialfx' => 'everything',
													'link_title_field' => 'title'),
								// Color magic funky style
								'7' => array(		'thumbs_spacing' => 0,
													'row_height' => 250,
													'height_deviation' => 100,
													'overlay' => 'others',
													'overlay_color' => '#5E005E',
													'overlay_opacity' => 0.6,
													'caption' => 'slide',
													'caption_bg_color' => '#FFBB00',
													'caption_text_color' => '#000',
													'caption_text_shadow' => '0 1px 0 #FFEBB5',
													'caption_opacity' => 1,
													'caption_title_css'		=> "font-size: 18px;
font-weight: bold;
text-align:center;
text-transform:uppercase;",
													'caption_desc_css'		=> "font-size: 12px;
font-weight: normal;
text-align:center;
text-transform:uppercase;",
													'specialfx' => 'others'),
								// No links big images
								'8' => array(		'thumbs_spacing' => 1,
													'row_height' => 350,
													'height_deviation' => 50,
													'overlay' => 'others',
													'overlay_color' => '#000',
													'overlay_opacity' => 0.1,
													'caption' => 'fade',
													'caption_bg_color' => '#FFF',
													'caption_text_color' => '#000',
													'caption_opacity' => 0.7,
													'lightbox' => 'links-off',
													'specialfx' => 'off'),
								// Focus on the text
								'9' => array(		'thumbs_spacing' => 3,
													'row_height' => 250,
													'height_deviation' => 50,
													'caption' => 'mixed',
													'caption_text_color' => '#FFF',
													'caption_bg_color' => 'rgba(0,0,0,0.75)',
													'caption_opacity' => 1,
													'caption_title_css'		=> "font-size: 18px;
font-weight: bold;
text-align:left;
line-height:normal;",
													'caption_desc_css'		=> "font-size: 14px;
font-weight: normal;
text-align:left;
line-height:normal;",
													'overlay' => 'hovered',
													'overlay_opacity' => 0.6,
													'specialfx' => 'hovered'
													),
								// Hidden
								'10' => array(		'thumbs_spacing' => 5,
													'row_height' => 150,
													'height_deviation' => 50,
													'caption' => 'off',	
													'lightbox' => 'colorbox',
													'limit' => 10,
													'hidden_limit' => 100,
													'last_row' => 'hide',
													'overlay' => 'others',
													'overlay_color' => 'white',
													'overlay_opacity' => 0.5,
													'specialfx' => 'others'
													),
								// Magnifier blur
								'11' => array(		'caption' => 'off',
													'overlay' => 'hovered',
													'overlay_icon' => 'on',
													'overlay_icon_opacity' => 0.9,	
													'overlay_opacity' => 0.5,
													'specialfx' => 'hovered',
													'specialfx_type' => 'blur',
													'specialfx_blend' => 0.8
													),
								// Author’s other favorite
								'12' => array(		'thumbs_spacing' => 1,
													'caption_opacity' => 1,
													'caption_bg_color' => 'rgba(0,0,0,0.25)',
													'caption_text_color' => 'white',
													'caption_text_shadow' => "1px 1px 1px black",
													'overlay' => 'others',
													'overlay_color' => 'black',
													'overlay_opacity' => 0.6,
													'inner_shadow' => "0 0 30px black",
													'specialfx' => 'others',
													'specialfx_type' => 'sepia',
													'specialfx_blend' => 0.75
													),
								// Orton effect
								'13' => array(		'overlay' => 'hovered',
													'inner_border_width' => 1,
													'inner_border_color' => 'rgba(0,0,0,0.1)',
													'specialfx' => 'others',
													'specialfx_type' => 'blur',
													'specialfx_blend' => 0.3
													),
								// Animated border and glow
								'14' => array(		'thumbs_spacing' => 0,
													'overlay' => 'others',
													'inner_shadow' => "0 0 30px black",
													'inner_border_width' => 10,
													'inner_border_color' => 'white',
													'inner_border' => 'others',
													'inner_border_animate' => 'width',
													'specialfx' => 'hovered',
													'specialfx_type' => 'glow'
													),
								// Borders and shadow
								'15' => array(		'thumbs_spacing' => 15,
													'caption' => 'off',
													'overlay' => 'others',
													'overlay_color' => 'black',
													'overlay_opacity' => 0.2,
													'outer_shadow' => "0 0 3px rgba(0,0,0,0.2)",
													'inner_shadow' => "0 0 30px black",
													'outer_border_width' => 1,
													'outer_border_color' => '#c7c7c7',
													'middle_border_width' => 10,
													'middle_border_color' => 'white',
													'inner_border_width' => 1,
													'inner_border_color' => 'rgba(0,0,0,0.1)'
													),
								// Facebok inspired
								'16' => array(		'animation_speed' => 400,
													'caption' => 'slide',
													'overlay' => 'hovered',
													'mobile_overlay' => 'off',
													'overlay_color' => 'black',
													'overlay_icon' => 'on',
													'overlay_icon_opacity' => 0.5,
													'overlay_opacity' => 0.2,
													'inner_border_width' => 1,
													'inner_border_color' => 'rgba(0,0,0,0.1)'
													),
								// Vertical center
								'17' => array(		'caption' => 'fade',
													'caption_opacity' => 1,
													'caption_bg_color' => 'transparent',
													'caption_title_size' => '20px',
													'caption_desc_size' => '14px',
													'caption_align' => 'center',
													'v_center_captions' => 'yes',
													'caption_text_shadow' => '1px 1px 0 black',
													'overlay' => 'hovered',
													'overlay_color' => 'black',
													'overlay_opacity' => 0.6
													),
								// Vertical creative
								'18' => array(		'caption' => 'slide',
													'caption_opacity' => 1,
													'caption_bg_color' => 'rgba(0,0,0,0.8)',
													'caption_align' => 'center',
													'v_center_captions' => 'yes',
													'overlay' => 'hovered',
													'overlay_color' => 'purple',
													'overlay_opacity' => 0.3
													),
								// Caption fun, gray background
								'19' => array(		'caption' => 'mixed',
													'caption_match_width' => 'yes-rounded',
													'caption_align' => 'left',
													'overlay' => 'off',
													'loading_background' => '#eaeaea'
													),
								// Caption below the thumbs
								'20' => array(		'caption' => 'below',
													'caption_opacity' => 1,
													'caption_bg_color' => 'transparent',
													'caption_align' => 'center',
													'caption_text_color' => 'inherit',
													'thumbs_spacing' => 15,
													'outer_shadow' => "0 0 3px rgba(0,0,0,0.2)"
													)
			);


		// Hooks up the new settings page and its options, the shortcode, and loads the settings
		function JustifiedImageGrid($case = false){
			$this->default_settings = $this->defaults;
			$this->settings = $this->get_options();
			// settings that should not be included in a preset and could allow changing a value in the plugin's settings while selecting a preset in the shortcode
			$this->settings_override = array(	'fb_app_id' 				=> $this->settings['fb_app_id'],
												'fb_app_secret' 			=> $this->settings['fb_app_secret'],
												'fb_authed' 				=> $this->settings['fb_authed'],
												'facebook_caching'			=> $this->settings['facebook_caching'],
												'facebook_overview_caching'	=> $this->settings['facebook_overview_caching'],
												'facebook_image_size'		=> $this->settings['facebook_image_size'],
												'fb_lightbox_album'			=> $this->settings['fb_lightbox_album'],
												'fb_overview_slug'			=> $this->settings['fb_overview_slug'],
												'fli_api_key'				=> $this->settings['fli_api_key'],
												'fli_added'					=> $this->settings['fli_added'],
												'flickr_caching'			=> $this->settings['flickr_caching'],
												'flickr_too_small_images'	=> $this->settings['flickr_too_small_images'],
												'flickr_allow_big_images'	=> $this->settings['flickr_allow_big_images'],
												'ig_client_id'				=> $this->settings['ig_client_id'],
												'ig_client_secret'			=> $this->settings['ig_client_secret'],
												'ig_authed'					=> $this->settings['ig_authed'],
												'instagram_caching'			=> $this->settings['instagram_caching'],
												'rss_links_to'				=> $this->settings['rss_links_to'],
												'rss_description'			=> $this->settings['rss_description'],
												'rss_excerpt_length'		=> $this->settings['rss_excerpt_length'],
												'rss_excerpt_ending'		=> $this->settings['rss_excerpt_ending'],
												'rss_link'					=> $this->settings['rss_link'],
												'rss_link_target'			=> $this->settings['rss_link_target'],
												'rss_link_text'				=> $this->settings['rss_link_text'],
												'rss_caching'				=> $this->settings['rss_caching'],
												'lightbox_max_size'			=> $this->settings['lightbox_max_size'],
												'jquery'					=> $this->settings['jquery'],
												'jquery_location'			=> $this->settings['jquery_location'],
												'prettyphoto_social'		=> $this->settings['prettyphoto_social'],
												'prettyphoto_deeplinking'	=> $this->settings['prettyphoto_deeplinking'],
												'prettyphoto_theme'			=> $this->settings['prettyphoto_theme'],
												'prettyphoto_analytics'		=> $this->settings['prettyphoto_analytics'],
												'prettyphoto_settings'		=> $this->settings['prettyphoto_settings'],
												'colorbox_settings'			=> $this->settings['colorbox_settings'],
												'photoswipe_settings'		=> $this->settings['photoswipe_settings'],
												'colorbox_design'			=> $this->settings['colorbox_design'],
												'download_link'				=> $this->settings['download_link'],
												'download_link_text'		=> $this->settings['download_link_text'],
												'flickr_link'				=> $this->settings['flickr_link'],
												'flickr_link_text'			=> $this->settings['flickr_link_text'],
												'flickr_link_target'		=> $this->settings['flickr_link_target'],
												'instagram_link'			=> $this->settings['instagram_link'],
												'instagram_link_text'		=> $this->settings['instagram_link_text'],
												'instagram_link_target'		=> $this->settings['instagram_link_target'],
												'overlay_icon_url'			=> $this->settings['overlay_icon_url'],
												'overlay_icon_retina'		=> $this->settings['overlay_icon_retina'],
												'filter_all_text'			=> $this->settings['filter_all_text'],
												'filter_button_css'			=> $this->settings['filter_button_css'],
												'filter_button_hover_css'	=> $this->settings['filter_button_hover_css'],
												'filter_style'				=> $this->settings['filter_style'],
												'filter_orderby'			=> $this->settings['filter_orderby'],
												'filter_custom_order'		=> $this->settings['filter_custom_order'],
												'filter_min_count'			=> $this->settings['filter_min_count'],
												'filter_top_x'				=> $this->settings['filter_top_x'],
												'filter_all_button'			=> $this->settings['filter_all_button'],
												'filter_multiple'			=> $this->settings['filter_multiple'],
												'filter_smallest_color'		=> $this->settings['filter_smallest_color'],
												'filter_smallest_size'		=> $this->settings['filter_smallest_size'],
												'filter_largest_color'		=> $this->settings['filter_largest_color'],
												'filter_largest_size'		=> $this->settings['filter_largest_size'],
												'filter_tag_css'			=> $this->settings['filter_tag_css'],
												'filter_tag_hover_css'		=> $this->settings['filter_tag_hover_css'],
												'developer_link' 			=> $this->settings['developer_link'],
												'developer_link_text' 		=> $this->settings['developer_link_text'],
												'envato_user' 				=> $this->settings['envato_user'],
												'quality'					=> $this->settings['quality'],
												'retina_ready'				=> $this->settings['retina_ready'],
												'retina_quality'			=> $this->settings['retina_quality'],
												'timthumb_path'				=> $this->settings['timthumb_path'],
												'cdn_host'					=> $this->settings['cdn_host'],
												'external_caching'			=> $this->settings['external_caching'],
												'use_timthumb'				=> $this->settings['use_timthumb'],
												'nextgen_breadcrumb_css'	=> $this->settings['nextgen_breadcrumb_css'],
												'ng_remove_scripts'			=> $this->settings['ng_remove_scripts'],
												'ng_intersect_tags'			=> $this->settings['ng_intersect_tags'],
												'ng_description'			=> $this->settings['ng_description'],
												'fb_breadcrumb_css'			=> $this->settings['fb_breadcrumb_css'],
												'nextgen_cf_link'			=> $this->settings['nextgen_cf_link'],
												'load_more_css'				=> $this->settings['load_more_css'],
												'load_more_hover_css'		=> $this->settings['load_more_hover_css'],
												'take_over_gallery'			=> $this->settings['take_over_gallery'],
												'take_over_nextgen'			=> $this->settings['take_over_nextgen'],
												'shortcode_alias'			=> $this->settings['shortcode_alias'],
												'disable_mobile_hover'		=> $this->settings['disable_mobile_hover'],
												'mobile_caption'			=> $this->settings['mobile_caption'],
												'mobile_overlay'			=> $this->settings['mobile_overlay'],
												'mobile_specialfx'			=> $this->settings['mobile_specialfx'],
												'shortcode_role'			=> $this->settings['shortcode_role'],
												'media_attacher'			=> $this->settings['media_attacher'],
												'post_tags_categories'		=> $this->settings['post_tags_categories'],
												'jquery_mobile'				=> $this->settings['jquery_mobile'],
												'custom_link_follow'		=> $this->settings['custom_link_follow'],
												'add_to_sitemap'			=> $this->settings['add_to_sitemap'],
												'custom_CSS'				=> $this->settings['custom_CSS'],
												'proper_uninstall'			=> $this->settings['proper_uninstall']
												);
			if(!$case){
				if(!is_admin()){
					add_action('wp_print_scripts', array($this, 'jig_jquery_override'), 100);
				}
				add_action('admin_enqueue_scripts', array($this, 'jig_admin_scripts'));
				add_action('init', array($this, 'jig_init'), 100);

				add_action('plugins_loaded', array($this, 'jig_plugins_loaded'));
				if($this->settings['shortcode_alias'] !== ''){
					add_shortcode($this->settings['shortcode_alias'], array($this, 'jig_init_shortcode'));
				}
				if($this->settings['shortcode_alias'] !== 'justified_image_grid'){
					add_shortcode('justified_image_grid', array($this, 'jig_init_shortcode'));
				}
				add_filter("attachment_fields_to_edit", array($this, 'jig_image_attachment_fields_to_edit'), null, 2);
				add_filter("attachment_fields_to_save", array($this, 'jig_image_attachment_fields_to_save'), null , 2);

				if($this->settings['media_attacher'] == 'enable'){
					add_filter("manage_upload_columns", array($this, 'jig_upload_columns'));
					add_action("manage_media_custom_column", array($this, 'jig_media_custom_columns'), 0, 2);
				}
				if($this->settings['take_over_gallery'] === 'yes'){
					remove_shortcode('gallery');
					add_shortcode( 'gallery' , array($this, 'jig_take_over_gallery_shortcode') );
				}

				if($this->settings['take_over_ng_post_inserts'] === 'yes'){
					add_filter( 'the_content', array($this, 'jig_filter_ng2_post_inserts'));
				}

				if($this->settings['ng_remove_scripts'] === 'yes'){
					define('NGG_SKIP_LOAD_SCRIPTS', true);
					add_action('wp_print_styles', array($this,'remove_nextgen_styles'), 100);
				}
				if($this->settings['load_more_device_fix'] === 'on'){
					add_action('wp_head', array($this, 'jig_add_load_more_device_fix'));
				}
				if($this->settings['fb_overview_slug'] === ''){
					$this->settings['fb_overview_slug'] = 'facebook-album';
				}
				add_filter('run_ngg_resource_manager', array($this, 'kill_ngg_resource_manager'), 0, 1); 

				$this->settings['prettyphoto_settings'] = rtrim(trim(str_replace(',', ",\r\n", preg_replace("/(\r\n*)/",'',preg_replace("/((deeplinking|social_tools|theme):.*,?)/",'',$this->settings['prettyphoto_settings'])))),',');

				add_filter('widget_text', 'do_shortcode');
				add_filter('plugin_action_links_justified-image-grid/justified-image-grid.php', array($this, 'jig_add_settings_link'));

				add_action('template_redirect', array($this, 'jig_remove_redirect'), 1);
				add_action('init', array($this, 'jig_add_facebook_overview_endpoint'));  

				if($this->settings['add_to_sitemap'] === 'enable'){
					add_filter('wpseo_sitemap_urlimages', array($this, 'jig_add_xml_sitemap_images'), 10, 2);
				}


				// For Facebook individual like using prettyPhoto
				if($this->settings['prettyphoto_deeplinking'] == 'advanced_deeplinking' && isset($_GET['_escaped_fragment_'])) {
					if (!in_array($_SERVER['HTTP_USER_AGENT'], array(
					  		'facebookexternalhit/1.1 (+https://www.facebook.com/externalhit_uatext.php)',
					  		'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)'
						))) {
						// if this is not Facebook
					    $nice_URL = urldecode($_SERVER['REQUEST_URI']);
					    $nice_URL = str_replace("?_escaped_fragment_=", "#!", $nice_URL);
					    $nice_URL = 'http'.(is_ssl() ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$nice_URL;
					    $nice_URL = str_replace(array('[',']'), array('%5B','%5D'), $nice_URL);
					    $this->custom_redirect_URL = $nice_URL;
					    add_action('init', array($this, 'jig_wp_redirect'));  
					}else{
						// This is facebook, wp_head needs to be custom cleaned
						remove_action('wp_head', 'rel_canonical');
						add_action('wp_head', array($this, 'head_begin'), -1000);
						add_action('wp_head', array($this, 'head_end'), 1000); 
					}
				}
			}else{
				if($case == 'activate'){
					$this->activate_jig();				
				}elseif($case == 'uninstall'){
					$this->uninstall_jig();
				}
			}	
		}

		// Redirects visitor to the nice URL without _escaped_fragment_ sent by Facebook
		function jig_wp_redirect(){
			wp_redirect($this->custom_redirect_URL, 301 );
			exit;
		}

		// Removes canonical redirect ONLY if you are using an Overview Facebook album on the front page.
		function jig_remove_redirect(){
			if(get_query_var($this->settings['fb_overview_slug']) && is_front_page()){
				remove_filter('template_redirect', 'redirect_canonical');
			}
		}

		// Adds settings to the database along with a freshly activated setting
		function activate_jig(){
			$this->settings['jig_activated'] = "hot";
			update_option(self::SETTINGS_NAME,$this->settings);
		}

		// Removed settings depending on the proper_uninstall setting
		function uninstall_jig(){
			switch ($this->settings['proper_uninstall']) {
				case 'nochange':
				break;
				case 'full_removal':
					global $wpdb;	
					$tablename = $wpdb->prefix.'jig_ext_images';
					$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '!_transient_%jigfli!_%' ESCAPE '!'");
					$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '!_transient_%jigfb!_%' ESCAPE '!'");
					$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '!_transient_%jigig!_%' ESCAPE '!'");
					$wpdb->query("DROP TABLE $tablename");
				case 'partial_removal':
					delete_option(self::SETTINGS_NAME); // Remove settings
					flush_rewrite_rules();
				break;
			}		
		}

		// This will call the class in activation mode
		function on_activate(){
			new JustifiedImageGrid('activate');
		}
		// This will call the class in activation mode
		function on_uninstall(){
			new JustifiedImageGrid('uninstall');
		}

		function jig_admin_scripts($hook_suffix){
			//if($hook_suffix == 'settings_page_justified-image-grid'){
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_script('wp-color-picker');
			//}
		}
		function jig_init(){
			if($this->settings['post_tags_categories'] == 'enable'){
				$taxonomies = array('category', 'post_tag'); // add the 2 tax to ...
				foreach($taxonomies as $tax) {
					register_taxonomy_for_object_type($tax, 'attachment'); // add to post type attachment
				}
			}

			global $current_user;
			if(current_user_can('manage_options')){
				add_action('admin_menu', array($this, 'jig_init_settings_page'));
				add_action('admin_init', array($this, 'jig_init_options'));
			}

			switch ($this->settings['shortcode_role']) {
				case 'unlimited':
				break;
				case 'contributor':
					if(!(in_array('contributor',$current_user->roles,true)
						|| in_array('author',$current_user->roles,true)
						|| in_array('editor',$current_user->roles,true)
						|| in_array('administrator',$current_user->roles,true))){
						return;
					}
					break;
				case 'author':
					if(!(in_array('author',$current_user->roles,true)
						|| in_array('editor',$current_user->roles,true)
						|| in_array('administrator',$current_user->roles,true))){
						return;
					}
					break;
				case 'editor':
					if(!(in_array('editor',$current_user->roles,true)
						|| in_array('administrator',$current_user->roles,true))){
						return;
					}
					break;
				case 'administrator':
					if(!in_array('administrator',$current_user->roles,true)){
						return;
					}
					break;
			}
										
			// Add only in Rich Editor mode
			if ( get_user_option('rich_editing') == 'true') {
				// filter the tinyMCE buttons and add our own
				add_filter("mce_external_plugins", array($this, 'add_jig_shortcode_editor'));
				add_filter('mce_buttons', array($this, 'register_jig_shortcode_editor'));
				add_action('wp_ajax_jig_shortcode_editor', array($this, 'jig_shortcode_editor'));
			}


			if(!empty($this->settings['take_over_nextgen'])){
				if(class_exists('NextGEN_shortcodes')){
					add_filter( 'the_content', array($this, 'jig_war_rewrite_stubborn_shortcodes'), -1);
					foreach ($this->settings['take_over_nextgen'] as $shortcode_name) {
						remove_shortcode($shortcode_name);
						add_shortcode('jw_'.$shortcode_name, array($this, 'jig_take_over_nextgen_'.$shortcode_name.'_shortcode'));
					}
				}

			}
		}

		// Begins object buffer for filtering the WP head for Facebook Individual Like feature
		function head_begin(){
			$this->requestURI = str_replace("?_escaped_fragment_=", "#!", urldecode($_SERVER['REQUEST_URI']));
			if(preg_match("/(!.*\/(\d+?\/)?(https?:\/\/[\w\d\/.\-\?=]*\.(?:jpg|jpeg|png|gif|bmp)[\w\d\/.\-\?=]*)?)$/", $this->requestURI, $mediaURI) === 1){
				$this->custom_og_meta = "\t<meta property='og:image' content='".$mediaURI[3]."' />\n";
		   	}elseif(preg_match("/(!.*\/(\d+?\/)?(https?:\/\/[\w\d\/.\-\?=]*\.(?:jpg|jpeg|png|gif|bmp)[\w\d\/.\-\?=]*)?)$/", str_replace("_escaped_fragment_=", "#!", urldecode($_SERVER['QUERY_STRING'])), $mediaURI) === 1){
				$this->custom_og_meta = "\t<meta property='og:image' content='".$mediaURI[3]."' />\n";
		   	}
			ob_start(array($this, 'head_process'));
		}

		// Cleans the WP head
		function head_process($buffer){
			if(isset($this->custom_og_meta)){
				$pattern = '/(<link.+?rel=[\'"]canonical[\'"].+?>)|(<meta.+?property=[\'"]og:url[\'"].+?>)|(<meta.+?property=[\'"]og:image[\'"].+?>)/';
			}else{
				$pattern = '/(<link.+?rel=[\'"]canonical[\'"].+?>)|(<meta.+?property=[\'"]og:url[\'"].+?>)/';
			}
			$buffer = preg_replace($pattern, '<!-- Facebook Individual Like conflict removed by JIG: $0 -->', $buffer);
			return $buffer;
		}

		// Flushes the object buffer and adds custom tags for Facebook Individual Like feature
		function head_end(){
			ob_end_flush();
			if(isset($this->custom_og_meta)){
			        echo $this->custom_og_meta;
			}


			if(class_exists('C_NextGEN_Bootstrap')){ // NG2 routing problems
				$ngoptions = get_option('ngg_options');
				$ng_permalink_slug = $ngoptions['permalinkSlug'];
				if(strpos($this->requestURI,$ng_permalink_slug) !== false){
					$path_to_index = '';
					$index_pos = strpos($_SERVER["SCRIPT_NAME"],'/index.php');
					if($index_pos !== 0){
						$path_to_index = '/'.substr($_SERVER["SCRIPT_NAME"],1,$index_pos-1);
						$this->requestURI = $path_to_index.$this->requestURI.'#!'.$_GET['_escaped_fragment_'];
					}
				}
			}
			$og_url_meta_for_fb = 'http' . (is_ssl() ? 's' : '') . "://".$_SERVER['HTTP_HOST'] . $this->requestURI;
			echo "\t<meta property='og:url' content='".$og_url_meta_for_fb."' />
\t<link rel='canonical' href='".$og_url_meta_for_fb."' />";
		}


		// Replaces jQuery source
		function jig_jquery_override(){
			if($this->settings['jquery_location'] == 'header'){
				$footer = false;
			}else{
				$footer = true;
			}	
			if ($this->settings['jquery'] != 'nochange') {
				switch($this->settings['jquery']){
					case 'googlewp':
					case 'googleplugin':
					case 'google2wp':
					case 'google2plugin':
						wp_deregister_script('jquery');
						$fallback_url = $fallback_version = array();
						$fallback_url['googlewp'] = $fallback_url['google2wp'] = includes_url('/js/jquery/jquery.js');
						$fallback_url['googleplugin'] = $fallback_url['google2plugin'] = plugins_url('js/jquery-1.8.3.min.js', __FILE__);
						$fallback_version['googlewp'] = $fallback_version['google2wp'] = '1.10.2';
						$fallback_version['googleplugin'] = $fallback_version['google2plugin'] = '1.8.3';
						$protocol = is_ssl() ? 'https' : 'http';
						if($this->settings['jquery'] == 'google2wp' || $this->settings['jquery'] == 'google2plugin'){
							$url = $protocol . '://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js';
						}else{
							$url = $protocol . '://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js';
						}
						if (get_transient('google_jquery') == true) {	    
							wp_register_script('jquery', $url, array(), null, $footer);
						}else{
							$resp = wp_remote_head($url);
							if (!is_wp_error($resp) && 200 == $resp['response']['code']) {
								set_transient('google_jquery', true, 60 * 5);
								wp_register_script('jquery', $url, array(), null, $footer);
							} 
							else {
								set_transient('google_jquery', false, 60 * 5);
								$url = $fallback_url[$this->settings['jquery']];
								wp_register_script('jquery', $url, array(), $fallback_version[$this->settings['jquery']], $footer);
							}
						}
					break;
					case 'plugin':
						wp_deregister_script('jquery');
						$url = plugins_url('js/jquery-1.8.3.min.js', __FILE__);
						wp_register_script('jquery', $url, array(), '1.8.3', $footer);
					break;
					case 'forcewp':
						wp_deregister_script('jquery');
						wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), array(), '1.10.2');
					break;
				}
			}
			if(!$footer){
				wp_enqueue_script('jquery');
			}
		}

		// Loads the language file if found for the current locale
		function jig_plugins_loaded(){
			load_plugin_textdomain('jig_td', false, basename(dirname(__FILE__)) . '/languages/');
		}	

		// Adds a settings link to the plugins page in JIG's row	
		function jig_add_settings_link($links) {
			array_unshift($links, '<a href="options-general.php?page=justified-image-grid">'.__('Settings', 'jig_td').'</a>');
			return $links;
		}

		// Adds the new settings page
		function jig_init_settings_page(){
			add_options_page(
				__('Justified Image Grid', 'jig_td'),
				__('Justified Image Grid', 'jig_td'),
				'manage_options',
				self::PAGE_NAME,
				array($this, 'jig_build_settings_page')
			);
		}

		// Adds the new settings page
		function jig_build_settings_page(){
			wp_enqueue_script('jquery');
			?>	
			<div id="jigTopWrapper">
				<img id="jigLogo" src="<?php echo plugins_url('images/jig-logo.png', __FILE__); ?>" width="257" height="50" alt="<?php _e('Justified Image Grid', 'jig_td'); ?>" />
				<iframe id="jigLikeBox" src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fcodecanyon.net%2Fitem%2Fjustified-image-grid-premium-wordpress-gallery%2F2594251&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=recommend&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" allowTransparency="true"></iframe>
				<div id="jigColorHelper"><span id="jigColorHelperText"><?php _e("Use this tool to get color values for CSS settings:", "jig_td"); ?></span> <input type="text" value="" id="jigColorHelperField"  /></div>
			</div>
			<p class="jigLong">Version 1.7.1 - <a href="http://justifiedgrid.com/" target="_blank">Justified Image Grid website</a> | <a href="http://justifiedgrid.com/how-to-get-help/" target="_blank">How to get help?</a> | <a href="http://justifiedgrid.com/narrated-hd-tutorial-videos/" target="_blank">Tutorial videos</a> | <a href="http://codecanyon.net/item/justified-image-grid-premium-wordpress-gallery/2594251?ref=Firsh" target="_blank">The plugin on CodeCanyon</a> | <a href="http://codecanyon.net/downloads" target="_blank">Rate the plugin!</a>
				
			</p>
			<p class="jigLong"><?php echo sprintf(__("<strong>Use the Shortcode Editor in posts/pages to add galleries to your content.</strong><br/><br/>Refer to the right side help bubbles or the PDF documentation for more information. Here you can choose the global settings that every gallery will start with. You can override these settings on a per-gallery basis in the %s.", 'jig_td'),'<a href="http://justifiedgrid.com/shortcode-editor/" target="_blank">Shortcode Editor</a>'); ?></p>
			<p><strong><?php _e('Presets','jig_td'); ?>:</strong>
			<p class="jigLong"><?php _e("Clicking one of these will overwrite and apply the styling settings below. Use them as a base then fine-tune settings. You can't change the presets but build upon them!", 'jig_td'); ?></p>
	
			<script type="text/javascript">
					// Facebook
					// sends an AJAX request to fetch the access token and other data from the session
					var page_types = new Object;
					page_types['current_user'] = '<?php _e("current user", "jig_td"); ?>';
					page_types['page'] = '<?php _e("page", "jig_td"); ?>';
					page_types['other_user'] = '<?php _e("other user", "jig_td"); ?>';
					function jig_get_fb_access_token(code){
						if(typeof(code)==='undefined'){
							code = 'current';
						}else if (code == 'other'){
							code = jQuery('#jigFbOtherUserCode').val();
						}
						if(code == ''){
							jig_message_box("<?php _e('Enter the code!', 'jig_td'); ?>");
						}else{
							jig_fb_ajax_loading('show');
							jQuery.post(
								ajaxurl,
								{
									'action': 'jig_get_fb_access_token',
									'security': '<?php echo wp_create_nonce("jig_get_fb_access_token") ?>',
									'code' : code
								},
								function(data) {
									jig_fb_ajax_process(data);
									jig_waiting_for_access_token = false;
								},
								'json');
							}
					};
					function jig_add_fb_page(token){
						var page = jQuery('#jigAddFbPageInput').val();
						if(page.lastIndexOf('/') > -1){
							page = page.substr(page.lastIndexOf('/')+1);
							if(page.lastIndexOf('?') > -1){
								page = page.substr(0,page.lastIndexOf('?'));
							}
						}
						if(typeof(token)==='undefined'){
							token = '';
						}
						if(page == ''){
							jig_message_box("<?php _e('Enter the page!', 'jig_td'); ?>");
						}else{
							jig_fb_ajax_loading('show');
							jQuery.post(
								ajaxurl,
								{
									'action': 'jig_add_fb_page',
									'security': '<?php echo wp_create_nonce("jig_add_fb_page") ?>',
									'page' : page,
									'token' : token

								},
								function(data) {
									jig_fb_ajax_process(data);
								},
								'json');
						}
					}
					function jig_remove_fb_authed(element){
						var id = element.attr('id');
						id = id.substr(8)
						var user_name = element.find('.jigFbAuthedName').text();
						var type = element.attr('data-type');
						element.fadeOut(400, function(){jQuery(this).remove()})
						jQuery('#fbField'+id).remove()
						var authed_with = jQuery('#jigFbAuthedHidden input.jig_fb_field_access_token_owner_id[value="'+id+'"]')
						jig_message_box("<?php _e('The', 'jig_td'); ?> "+page_types[type]+': '+user_name+" <?php _e('is removed from the list.', 'jig_td'); ?>");

						if(authed_with.length != 0){
							authed_with.each(function(key,element){
								var page_name = jQuery(element).siblings('.jig_fb_field_user_name').val();
								var page_id = jQuery(element).siblings('.jig_fb_field_user_id').val();
								jQuery('#fbAuthed'+page_id).fadeOut(400, function(){jQuery(this).remove()})
								jQuery(element).parent().remove()
								jig_message_box("<?php _e('The page', 'jig_td'); ?> "+page_name+" <?php _e('is also removed because it required authentication from user', 'jig_td'); ?> "+user_name+'!');
							})
						}
					}
					function jig_verify_fb_authed(element){
						var id = element.attr('id');
						id = id.substr(8)
						var type = element.attr('data-type');
						var token = element.attr('data-access-token');
						jig_fb_ajax_loading('show');
						jQuery.post(
						ajaxurl,
						{
							'action': 'jig_verify_fb_authed',
							'security': '<?php echo wp_create_nonce("jig_verify_fb_authed") ?>',
							'token' : token,
							'user_id' : id

						},
						function(data) {
							if(!data['error']){
								jig_message_box('<?php _e("The authentication of", "jig_td"); ?> '+
									page_types[type]+': '+data['user_name']+
									' <?php _e("is valid. You can choose from", "jig_td"); ?> '+
									data['info']['album_count']+'.'+
									(data['info']['expires']
										? (data['access_token_owner_name'] && type == 'page' 
											? ' <?php _e("It has access from the", "jig_td"); ?> '+page_types[data['info']['owner_type']]+': '+data['access_token_owner_name']+'.' 
											: '')
										+' <?php _e("It will expire in", "jig_td"); ?> '+data['info']['time_remaining']+
										' <?php _e("which is on", "jig_td"); ?> '+
										jig_expires_date(parseFloat(data['info']['time_added'])+parseFloat(data['info']['expires']))+'.'
										: ''));

								var picture = element.find('.jigFbAuthedIcon')
								picture.html('<img src="'+data['picture']+'" />')
								var hiddenField = jQuery('#fbField'+id+' ')
								var pictureField = hiddenField.find('.jig_fb_field_picture')
								var settingName = jQuery('#jigFbAuthedHidden').attr('data-name');
								if(pictureField.length == 0){
									hiddenField.append('<input class="jig_fb_field_picture" type="hidden" name="'+settingName+'['+id+'][picture]" value="'+data['picture']+'" />')
								}else{
									hiddenField.find('.jig_fb_field_picture').val(data['picture'])
								}
							}else{
								jig_message_box(data['error']);
							}
							jig_fb_ajax_loading('hide');
						},
						'json');
					}

					function jig_fb_ajax_process(data){
						if(!data['error']){
							var existing = jQuery('#fbAuthed'+data['user_id']);
							if(existing.length == 0){
								jQuery('#jigFbAuthedPrototype')
									.clone()
									.attr({		'id':					'fbAuthed'+data['user_id'],
											 	'data-access-token': 	data['access_token'],
											 	'data-type':			data['type']  
											})
									.css('display','none')
									.appendTo(jQuery('#jigFbAuthed'))
									.find('.jigFbAuthedName')
									.html(data['user_name'])
									.siblings('.jigFbAuthedIcon')
									.html('<img src="'+data['picture']+'"/>')
									.siblings('.jigFbAccessFrom')
									.html((data['access_token_owner_name'] ?
											 	'<div class="jigFbAccessFromInner">(via  '+data['access_token_owner_name']+')</div>' : ''
									));
									jQuery('#fbAuthed'+data['user_id']).fadeIn(300)
								jQuery('#jigFbAuthedHidden').append(function(){
									var settingName = jQuery('#jigFbAuthedHidden').attr('data-name');
									var output = '<div id="fbField'+data['user_id']+'">';
									jQuery.each(data, function(index, value) { 
										if(index != 'info'){
											output += '<input class="jig_fb_field_'+index+'" type="hidden" name="'+settingName+'['+data['user_id']+']['+index+']" value="'+value+'" />';
										}
									});
									output += '</div>';

									jig_message_box('<?php _e("The authentication of", "jig_td"); ?> '+
										page_types[data['type']]+': '+data['user_name']+
										' <?php _e("is successful. You can choose from", "jig_td"); ?> '+
										data['info']['album_count']+'.'+
										(data['info']['expires']
											? (data['access_token_owner_name'] && data['type'] == 'page' 
												? ' <?php _e("It has access from the", "jig_td"); ?> '+page_types[data['info']['owner_type']]+': '+data['access_token_owner_name']+'.' 
												: '')
											+' <?php _e("It will expire in", "jig_td"); ?> '+data['info']['time_remaining']+
											' <?php _e("which is on", "jig_td"); ?> '+
											jig_expires_date(parseFloat(data['info']['time_added'])+parseFloat(data['info']['expires']))+'.'
											: ''));

									return output;
								})
							}else{
								existing.attr('data-access-token',data['access_token'])
									.removeClass('fbExpiredRedAlert')
									.find('.jigFbAuthedName')
									.html(data['user_name'])
									.siblings('.jigFbAuthedIcon')
									.html('<img src="'+data['picture']+'"/>')
									.siblings('.jigFbAccessFrom')
									.html((data['access_token_owner_name'] ?
											 	'<div class="jigFbAccessFromInner">(via  '+data['access_token_owner_name']+')</div>' : ''
									));
								var hiddenField = jQuery('#fbField'+data['user_id'])
								jQuery.each(data, function(index, value) { 
									if(index != 'info'){
										hiddenField.find('.jig_fb_field_'+index).val(value)
									}
								});
								var pictureField = hiddenField.find('.jig_fb_field_picture')
								var settingName = jQuery('#jigFbAuthedHidden').attr('data-name');
								if(pictureField.length == 0){
									hiddenField.append('<input class="jig_fb_field_picture" type="hidden" name="'+settingName+'['+data['user_id']+'][picture]" value="'+data['picture']+'" />')
								}else{
									hiddenField.find('.jig_fb_field_picture').val(data['picture'])
								}

								//when an existing user is updated with a new token, search for pages authed with this token and update too
								var existing_authed_with = jQuery('#jigFbAuthedHidden .jig_fb_field_access_token_owner_id[value="'+data['user_id']+'"]')

								if(existing_authed_with.length != 0){
									existing_authed_with.each(function(index,element){
										element = jQuery(element);
										jQuery('#fbAuthed'+element.siblings('.jig_fb_field_access_token').val(data['access_token']).siblings('.jig_fb_field_user_id').val()).attr('data-access-token', data['access_token']).removeClass('fbExpiredRedAlert')
										var page_name = element.siblings('.jig_fb_field_user_name').val();
										jig_message_box('<?php _e("The re-authentication of already existing", "jig_td"); ?> '+
											page_types['page']+': '+page_name+
											' <?php _e("is done. It was necessary due to the authorization change in ", "jig_td"); ?> '+
											page_types[data['type']]+': '+data['user_name']+'.');
									})
									
								}

								jig_message_box('<?php _e("The re-authentication of already existing", "jig_td"); ?> '+
										page_types[data['type']]+': '+data['user_name']+
										' <?php _e("is done. You can choose from", "jig_td"); ?> '+
										data['info']['album_count']+'.'+
										(data['info']['expires']
											? (data['access_token_owner_name'] && data['type'] == 'page' 
												? ' <?php _e("It has access from the", "jig_td"); ?> '+page_types[data['info']['owner_type']]+': '+data['access_token_owner_name']+'.' 
												: '')
											+' <?php _e("It will expire in", "jig_td"); ?> '+data['info']['time_remaining']+
											' <?php _e("which is on", "jig_td"); ?> '+
											jig_expires_date(parseFloat(data['info']['time_added'])+parseFloat(data['info']['expires']))+'.'
											: ''));

							}
							jQuery('#jigFbAuthManualBtn').addClass('jig_disable')
							jQuery('#jigAddFbPageInput').val('');
						}else{
							jig_message_box(data['error']);
						}
						jig_fb_ajax_loading('hide');
						jQuery(window).unbind('focus')
					}
					// End of Facebook part
					// Flickr				
					function jig_add_fli_user(token){
						var user = jQuery('#jigAddFliUserInput').val();
						if(user == ''){
							jig_message_box('<?php _e("Enter the user name or ID!", "jig_td"); ?>','fli');
						}else{
							jig_fli_ajax_loading('show');
							jQuery.post(
								ajaxurl,
								{
									'action': 'jig_add_fli_user',
									'security': '<?php echo wp_create_nonce("jig_add_fli_user") ?>',
									'user' : user
								},
								function(data) {
									jig_fli_ajax_process(data);
								},
								'json'
							);
						}
					}
					function jig_refresh_fli_user(element){
						var id = element.attr('id');
						alias = id.substr(8)
						user = jQuery("#fliField"+alias).find('.jig_fli_field_user_id').val()
						jig_fli_ajax_loading('show');
						jQuery.post(
							ajaxurl,
							{
								'action': 'jig_add_fli_user',
								'security': '<?php echo wp_create_nonce("jig_add_fli_user") ?>',
								'user' : user
							},
							function(data) {
								jig_fli_ajax_process(data);
							},
							'json'
						);
					}
					function jig_remove_fli_added(element){
						var id = element.attr('id');
						id = id.substr(8)
						var user_name = element.find('.jigFliAddedName').text();
						element.fadeOut(400, function(){jQuery(this).remove()})
						jQuery('#fliField'+id).remove()
						jig_message_box(user_name+" <?php _e('is removed from the list.', 'jig_td'); ?>", 'fli');
					}
					function jig_fli_ajax_process(data){
						if(!data['error']){
							data['user_alias'] = data['user_alias'].replace(/\s/g,'_');
							var existing = jQuery('#fliAdded'+data['user_alias']);
							if(existing.length == 0){
								jQuery('#jigFliAddedPrototype')
									.clone()
									.attr('id','fliAdded'+data['user_alias'])
									.css('display','none')
									.appendTo(jQuery('#jigFliAdded'))
									.find('.jigFliAddedName')
									.html(data['user_name'])
									.siblings('.jigFliAddedIcon').html('<img src="'+data['icon']+'"/>');
								jQuery('#fliAdded'+data['user_alias']).fadeIn(300)
								jQuery('#jigFliAddedHidden').append(function(){
									var settingName = jQuery('#jigFliAddedHidden').attr('data-name');
									var output = '<div id="fliField'+data['user_alias']+'">';
									jQuery.each(data, function(index, value) { 
										if(index != 'info'){
											output += '<input class="jig_fli_field_'+index+'" type="hidden" name="'+settingName+'['+data['user_alias']+']['+index+']" value="'+value+'" />';
										}
									});
									output += '</div>';
									jig_message_box('<?php _e("Successfully added ", "jig_td"); ?> '+data['user_name']+
										'.', 'fli');
									return output;
								})
							}else{
								existing.find('.jigFliAddedIcon').html('<img src="'+data['icon']+'"/>');
								jQuery('#fliField'+data['user_alias']).find(".jig_fli_field_icon").val(data['icon'])
								jig_message_box('<?php _e("User", "jig_td"); ?> '+data['user_name']+' <?php _e("has been refreshed", "jig_td"); ?>.', 'fli');
							}
							jQuery('#jigAddFliUserInput').val('');
						}else{
							jig_message_box(data['error'],'fli');
						}
						jig_fli_ajax_loading('hide');
					}
					// End of Flickr part
					//Instagram
					function jig_get_ig_access_token(){
						jig_ig_ajax_loading('show');
						jQuery.post(
							ajaxurl,
							{
								'action': 'jig_get_ig_access_token',
								'security': '<?php echo wp_create_nonce("jig_get_ig_access_token") ?>'
							},
							function(data) {
								jig_ig_ajax_process(data);
							},
							'json');
					};
					function jig_verify_ig_authed(element){
						var id = element.attr('id'),
							token = element.attr('data-access-token');
						id = id.substr(8)

						jig_ig_ajax_loading('show');
						jQuery.post(
						ajaxurl,
						{
							'action': 'jig_verify_ig_authed',
							'security': '<?php echo wp_create_nonce("jig_verify_ig_authed") ?>',
							'token' : token,
							'user_id' : id
						},
						function(data) {
							if(!data['error']){
								element.removeClass('igExpiredRedAlert');
								jig_message_box('<?php _e("The authentication of user", "jig_td"); ?>: '+
									data['full_name']+' ('+data['user_name']+') <?php _e("is valid.", "jig_td"); ?>','ig');

								var picture = element.find('.jigIgAuthedIcon'),						
									hiddenField = jQuery('#igField'+id+' '),
									pictureField = hiddenField.find('.jig_ig_field_picture'),
									validityField = hiddenField.find('.jig_ig_field_validity'),
									settingName = jQuery('#jigIgAuthedHidden').attr('data-name');
								picture.html('<img src="'+data['picture']+'" />');
								validityField.val('valid');
							}else{
								if(data['error_type'] == "OAuthAccessTokenException"){
									element.addClass('igExpiredRedAlert');
								}
								jig_message_box(data['error'],'ig');
							}
							jig_ig_ajax_loading('hide');
						},
						'json');
					}
					function jig_remove_ig_authed(element){
						var id = element.attr('id');
						id = id.substr(8)
						var user_name = element.find('.jigIgAuthedName').text();
						element.fadeOut(400, function(){jQuery(this).remove()})
						jQuery('#igField'+id).remove()
						jig_message_box("<?php _e('The user', 'jig_td'); ?>: "+user_name+" <?php _e('is removed from the list.', 'jig_td'); ?>",'ig');			
					}
					function jig_ig_ajax_process(data){
						if(typeof data['id'] === 'object'){
							data['error'] = "<?php _e('Generic error, most like SSL problem.', 'jig_td'); ?>";
						}
						if(!data['error']){
							var existing = jQuery('#igAuthed'+data['id']);
							if(existing.length == 0){
								jQuery('#jigIgAuthedPrototype')
									.clone()
									.attr({		'id':					'igAuthed'+data['id'],
											 	'data-access-token': 	data['access_token']
											})
									.css('display','none')
									.appendTo(jQuery('#jigIgAuthed'))
									.find('.jigIgAuthedName')
									.html(data['full_name']+' ('+data['user_name']+')')
									.siblings('.jigIgAuthedIcon')
									.html('<img src="'+data['picture']+'"/>');
									jQuery('#igAuthed'+data['id']).fadeIn(300)
								jQuery('#jigIgAuthedHidden').append(function(){
									var settingName = jQuery('#jigIgAuthedHidden').attr('data-name');
									var output = '<div id="igField'+data['id']+'">';
									jQuery.each(data, function(index, value) { 
										if(index != 'info'){
											output += '<input class="jig_ig_field_'+index+'" type="hidden" name="'+settingName+'['+data['id']+']['+index+']" value="'+value+'" />';
										}
									});
									output += '</div>';

									jig_message_box('<?php _e("The authentication of user", "jig_td"); ?>: '+data['full_name']+' ('+data['user_name']+')'+
										' <?php _e("is successful.", "jig_td"); ?>','ig');
									return output;
								})
							}else{
								existing.attr('data-access-token',data['access_token'])
									.removeClass('igExpiredRedAlert')
									.find('.jigIgAuthedName')
									.html(data['full_name']+' ('+data['user_name']+')')
									.siblings('.jigIgAuthedIcon')
									.html('<img src="'+data['picture']+'"/>');
								var hiddenField = jQuery('#igField'+data['id'])
								jQuery.each(data, function(index, value) { 
									hiddenField.find('.jig_ig_field_'+index).val(value)
								});


								jig_message_box('<?php _e("The re-authentication of already existing user", "jig_td"); ?>: '+data['full_name']+' ('+data['user_name']+')'+
										' <?php _e("is done.", "jig_td"); ?>','ig');

							}
							jQuery('#jigIgAuthManualBtn').addClass('jig_disable')
						}else{
							jig_message_box(data['error'],'ig');
						}
						jig_ig_ajax_loading('hide');
						jQuery(window).unbind('focus')
					}
					// End of Instagram part

					// Wipe settings from the database
					function jig_wipe_settings(){
						if(!confirm("<?php _e('Are you sure you wish to wipe all Justified Image Grid settings?', 'jig_td'); ?>")){
							return false;
						}
						var jigWipeSettingsButton = jQuery('#jigWipeSettingsButton');
						jigWipeSettingsButton.removeAttr('id').text("<?php _e('Please wait...', 'jig_td'); ?>");
						jQuery.post(
						ajaxurl,
						{
							'action': 'jig_wipe_settings',
							'security': '<?php echo wp_create_nonce("jig_wipe_settings") ?>'
						},
						function(data) {
							if(!data['error']){
								jigWipeSettingsButton.text(data['result']);
								var t=setTimeout(function(){
																location.reload();
															},3000);
							}else{
								jigWipeSettingsButton.text(data['error']);
							}
						},
						'json');
					}
					// Backup & import
					function jig_backup_settings(){
						var jigSettingsBackupText = jQuery('#jigSettingsBackupText').show().attr("disabled","disabled").val("<?php _e('Please wait...', 'jig_td'); ?>");
						jQuery.post(
						ajaxurl,
						{
							'action': 'jig_backup_settings',
							'security': '<?php echo wp_create_nonce("jig_backup_settings") ?>',
							'key' : jQuery('#encryption_key_backup').val()
						},
						function(data) {
							if(data['result']){
								jigSettingsBackupText.val(data['result']).removeAttr('disabled').select();
							}else{
								jigSettingsBackupText.val("<?php _e('There was an error creating the backup.', 'jig_td') ?>");
							}
						},
						'json');
					}
					function jig_import_settings(){
						var jigSettingsImportText 	= jQuery('#jigSettingsImportText'),
							encryrptedSettings 		= jigSettingsImportText.val();
						jigSettingsImportText.show().attr("disabled","disabled").val("<?php _e('Please wait...', 'jig_td'); ?>");
						jQuery.post(
						ajaxurl,
						{
							'action': 'jig_import_settings',
							'security': '<?php echo wp_create_nonce("jig_import_settings") ?>',
							'key' : jQuery('#encryption_key_import').val(),
							'encryrpted_settings' : encryrptedSettings
						},
						function(data) {
							if(!data['error']){
								jigSettingsImportText.val(data['result']);
								var t=setTimeout(function(){
																location.reload();
															},3000);
							}else{
								jigSettingsImportText.val(data['error']).removeAttr('disabled');
							}
						},
						'json');
					}
					// End Backup & import

					function jig_message_box(message, which){
						which = typeof which !== 'undefined' ? which : 'fb';
						switch(which){
							case 'fb':
								var entry = jQuery('<div class="jigFbAuthLogEntry">'+jig_timestamp()+message+'</div>'),
									box = jQuery('#jigFbAuthLog').prepend(entry);
								break;
							case 'fli':
								var entry = jQuery('<div class="jigFliAuthLogEntry">'+jig_timestamp()+message+'</div>'),
								 	box = jQuery('#jigFliAuthLog').prepend(entry);
								break;
							case 'ig':
								var entry = jQuery('<div class="jigIgAuthLogEntry">'+jig_timestamp()+message+'</div>'),
									box = jQuery('#jigIgAuthLog').prepend(entry);
								break;
						}
						var new_entry = box.find('div:first').slideDown(400)
							box.find('div').each(function(index, element){
								if(index != 0){							
									var targetOpacity = 1-index*0.2;
									if(targetOpacity > 0){
										jQuery(element).animate({opacity:targetOpacity}, 400)
										jQuery(element).text(jQuery(element).text());
									}else{
										jQuery(element).slideUp(400, function(){jQuery(this).remove()})
									}
								}
							});					
					}
					function jig_toggle_fb_app_help(){
						jQuery('#jigFbAppHelp').slideToggle(600);
					}
					function jig_toggle_fli_api_help(){
						jQuery('#jigFliApiHelp').slideToggle(600);
					}
					function jig_toggle_ig_app_help(){
						jQuery('#jigIgAppHelp').slideToggle(600);
					}

					function jig_purge_flickr_caching(){
							jQuery.post(
							ajaxurl,
							{
								'action': 'jig_purge_flickr_caching',
								'security': '<?php echo wp_create_nonce("jig_purge_flickr_caching") ?>'
							},
							function(data) {
								jQuery("#jigFliPurge").html(data['result']);
							},
							'json');
					}
					function jig_purge_facebook_caching(){
							jQuery.post(
							ajaxurl,
							{
								'action': 'jig_purge_facebook_caching',
								'security': '<?php echo wp_create_nonce("jig_purge_facebook_caching") ?>'
							},
							function(data) {
								jQuery("#jigFbPurge").html(data['result']);
							},
							'json');
					}
					function jig_purge_instagram_caching(){
							jQuery.post(
							ajaxurl,
							{
								'action': 'jig_purge_instagram_caching',
								'security': '<?php echo wp_create_nonce("jig_purge_instagram_caching") ?>'
							},
							function(data) {
								jQuery("#jigIgPurge").html(data['result']);
							},
							'json');
					}
					function jig_purge_external_caching(){
							jQuery.post(
							ajaxurl,
							{
								'action': 'jig_purge_external_caching',
								'security': '<?php echo wp_create_nonce("jig_purge_external_caching") ?>'
							},
							function(data) {
								jQuery("#jigExternalPurge").html(data['result']);
							},
							'json');
					}
					function jig_flush_rewrite_rules(){
							jQuery.post(
							ajaxurl,
							{
								'action': 'jig_flush_rewrite_rules',
								'security': '<?php echo wp_create_nonce("jig_flush_rewrite_rules") ?>'
							},
							function(data) {
								jQuery("#jigRewriteFlush").html(data['result']);
							},
							'json');
					}

					function jig_attempt_chmod(permission){
							jQuery.post(
							ajaxurl,
							{
								'action': 'jig_attempt_chmod',
								'security': '<?php echo wp_create_nonce("jig_attempt_chmod") ?>',
								'permission': permission
							},
							function(data) {						
								jQuery("#ttChmodFeedback").html(data['message'])
								jQuery("#ttChmodFeedback").slideDown(300);
								jig_on_demand_check_permissions();
							},
							'json');
					}
					function jig_on_demand_check_permissions(){
							jQuery.post(
							ajaxurl,
							{
								'action': 'jig_on_demand_check_permissions',
								'security': '<?php echo wp_create_nonce("jig_on_demand_check_permissions") ?>'
							},
							function(data) {
								jQuery("#ttWritable").html(data['writable']);
								jQuery("#ttPermissionCache").html(data['permission_cache']);
								jQuery("#ttPermissionPlugin").html(data['permission_plugin']);
								jQuery("#ttPermissionResults").slideDown(300)
							},
							'json');
					}
					function jig_timestamp() {
						var d=new Date();
						return '['+d.toLocaleTimeString()+'] ';
					}
					function jig_expires_date(s) {
						var d=new Date(s*1000);
						return d.toLocaleDateString()+" ("+d.toLocaleTimeString()+")";
					}
					function jig_fb_ajax_loading(direction){
						switch(direction){
							case 'show':
								jQuery('#jigFbLoadingAJAX').show()
								jQuery('#jigFb').css('opacity',0.1)
							break;
							case 'hide':
								jQuery('#jigFbLoadingAJAX').hide()
								jQuery('#jigFb').css('opacity',1)
							break;
							default:
						}
					}
					function jig_fli_ajax_loading(direction){
						switch(direction){
							case 'show':
								jQuery('#jigFliLoadingAJAX').show()
								jQuery('#jigFli').css('opacity',0.1)
							break;
							case 'hide':
								jQuery('#jigFliLoadingAJAX').hide()
								jQuery('#jigFli').css('opacity',1)
							break;
							default:
						}
					}
					function jig_ig_ajax_loading(direction){
						switch(direction){
							case 'show':
								jQuery('#jigIgLoadingAJAX').show()
								jQuery('#jigIg').css('opacity',0.1)
							break;
							case 'hide':
								jQuery('#jigIgLoadingAJAX').hide()
								jQuery('#jigIg').css('opacity',1)
							break;
							default:
						}
					}
					function jig_load_more_css_apply_light_skin(){
						jQuery('#load_more_css').val("border: 1px solid #d3d3d3;\npadding: 10px;\ntext-align: center;\nmargin: 5px auto 15px;\nmax-width: 155px;\ncursor: pointer;\n-webkit-border-radius: 2px;\n-moz-border-radius: 2px;\nborder-radius: 2px;\nbox-shadow: 0 0 7px rgba(0,0,0,0.08);\nbackground: #fcfcfc;\nbackground: -moz-linear-gradient(top,  #fcfcfc 0%, #f8f8f8 100%);\nbackground: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fcfcfc), color-stop(100%,#f8f8f8));\nbackground: -webkit-linear-gradient(top,  #fcfcfc 0%,#f8f8f8 100%);\nbackground: -o-linear-gradient(top,  #fcfcfc 0%,#f8f8f8 100%);\nbackground: -ms-linear-gradient(top,  #fcfcfc 0%,#f8f8f8 100%);\nbackground: linear-gradient(to bottom,  #fcfcfc 0%,#f8f8f8 100%);\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#f8f8f8',GradientType=0 );");
						jQuery('#load_more_hover_css').val("border: 1px solid #c6c6c6;\nbackground: #f8f8f8;\nbackground: -moz-linear-gradient(top,  #f8f8f8 0%, #eeeeee 100%);\nbackground: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f8f8f8), color-stop(100%,#eeeeee));\nbackground: -webkit-linear-gradient(top,  #f8f8f8 0%,#eeeeee 100%);\nbackground: -o-linear-gradient(top,  #f8f8f8 0%,#eeeeee 100%);\nbackground: -ms-linear-gradient(top,  #f8f8f8 0%,#eeeeee 100%);\nbackground: linear-gradient(to bottom,  #f8f8f8 0%,#eeeeee 100%);\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#eeeeee',GradientType=0 );");
					}
					function jig_load_more_css_apply_dark_skin(){
						jQuery('#load_more_css').val("border: 1px solid #252525;\npadding: 10px;\ntext-align: center;\nmargin: 5px auto 15px;\nmax-width: 155px;\ncursor: pointer;\n-webkit-border-radius: 2px;\n-moz-border-radius: 2px;\nborder-radius: 2px;\nbox-shadow: 0 0 7px rgba(255,255,255,0.08);\nbackground: #181818;\nbackground: -moz-linear-gradient(top,  #181818 0%, #070707 100%);\nbackground: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#181818), color-stop(100%,#070707));\nbackground: -webkit-linear-gradient(top,  #181818 0%,#070707 100%);\nbackground: -o-linear-gradient(top,  #181818 0%,#070707 100%);\nbackground: -ms-linear-gradient(top,  #181818 0%,#070707 100%);\nbackground: linear-gradient(to bottom,  #181818 0%,#070707 100%);\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#181818', endColorstr='#070707',GradientType=0 );");
						jQuery('#load_more_hover_css').val("border: 1px solid #2c2c2c;\nbackground: #1c1c1c;\nbackground: -moz-linear-gradient(top,  #1c1c1c 0%, #0d0d0d 100%);\nbackground: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1c1c1c), color-stop(100%,#0d0d0d));\nbackground: -webkit-linear-gradient(top,  #1c1c1c 0%,#0d0d0d 100%);\nbackground: -o-linear-gradient(top,  #1c1c1c 0%,#0d0d0d 100%);\nbackground: -ms-linear-gradient(top,  #1c1c1c 0%,#0d0d0d 100%);\nbackground: linear-gradient(to bottom,  #1c1c1c 0%,#0d0d0d 100%);\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1c1c1c', endColorstr='#0d0d0d',GradientType=0 );");
					}
					

					jQuery(document).ready(function(jQuery) {
						jig_waiting_for_access_token = false;
						// Facebook
						if(!(jQuery("#fb_app_id").val() != '' && jQuery("#fb_app_secret").val() != '')){
							jQuery('#jigFbWithAppOnly').html(<?php echo "'".'<div id="jigFbToAddUserHelpTitle">'.__('To add users', 'jig_td').':</div><ol><li>'.__('Create a Facebook App', 'jig_td').'</li><li>'.__('Fill out the App ID and App Secret fields', 'jig_td').'</li><li>'.__('Click Save Changes', 'jig_td').'</li></ol>'."'"; ?>)
						}
						jQuery('#jigFbAuthRequest').click(function(){
							jQuery('#jigFbAuthManualBtn').removeClass('jig_disable')
							jQuery(window).focus(function(){
								if(jig_waiting_for_access_token === false){
									jig_waiting_for_access_token = true;
									jig_get_fb_access_token();
								}
							})
						})
						jQuery('#jigFbAuthed').on("click", ".jigFbAuthedRemove", function(event){
							event.stopImmediatePropagation();
							jig_remove_fb_authed(jQuery(this).parent());
						})
						.on("click", ".jigFbAuthedElement", function(event){
							jig_verify_fb_authed(jQuery(this).closest('.jigFbAuthedElement'));
						});

						jQuery('#jigFb').on("click", "#jigAddFbPageInput", function(event){
							event.stopImmediatePropagation();
						})
						.on("keypress", "#jigAddFbPageInput", function(event){
							if(event.which == 13){
								event.preventDefault();
								jQuery(this).parent().click()
							}
						})
						.on("keypress", "#jigFbOtherUserCode", function(event){
							if(event.which == 13){
								event.preventDefault();
								jig_get_fb_access_token('other');
							}
						})	
						.on("click", "#jigFbAuthManualBtn", function(event){
							jig_get_fb_access_token();
						})	
						.on("click", "#jigFbOtherUserLoad", function(event){
							jig_get_fb_access_token('other');
						})	
						.on("click", "#jigAddFbPage", function(event){
							jig_add_fb_page();
						})	
						.on("click", "#jigFbOtherUserLink", function(event){
							jQuery(this).select();
						})
						.on("click", "#jigFbAuthRequest", function(event){
							jig_fb_ajax_loading('show');
						});
						jQuery('#jigFbOtherUserLink').val(jQuery('#jigFbOtherUserLink').attr('data-force'))
						jQuery('#jigFbOtherUserCode').val('')

						// Flickr
						if(!(jQuery("#fli_api_key").val() != '')){
							jQuery('#jigFliWithAppOnly').html(<?php echo "'".'<div id="jigFliToAddUserHelpTitle">'.__('To add users', 'jig_td').':</div><ol><li>'.__('Create a Flickr App', 'jig_td').'</li><li>'.__('Fill out the API key field', 'jig_td').'</li><li>'.__('Click Save Changes', 'jig_td').'</li></ol>'."'"; ?>)
						}
						jQuery('#jigFliAdded').on("click", ".jigFliAddedRemove", function(event){
							event.stopImmediatePropagation();
							jig_remove_fli_added(jQuery(this).parent());
						})
						jQuery('#jigFli').on("click", "#jigAddFliUserInput", function(event){
							event.stopImmediatePropagation();
						})
						.on("keypress", "#jigAddFliUserInput", function(event){
							if(event.which == 13){
								event.preventDefault();
								jQuery(this).parent().click()
							}
						})
						.on("click", "#jigAddFliUser", function(event){
							jig_add_fli_user();
						})	
						.on("click", ".jigFliAddedElement", function(event){
							jig_refresh_fli_user(jQuery(this).closest('.jigFliAddedElement'));
						});

						// Instagram
						if(!(jQuery("#ig_client_id").val() != '' && jQuery("#ig_client_secret").val() != '')){
							jQuery('#jigIgWithAppOnly').html(<?php echo "'".'<div id="jigIgToAddUserHelpTitle">'.__('To authenticate yourself', 'jig_td').':</div><ol><li>'.__('Register an Instagram app', 'jig_td').'</li><li>'.__('Fill out the Client ID and Client Secret fields', 'jig_td').'</li><li>'.__('Click Save Changes', 'jig_td').'</li></ol>'."'"; ?>)
						}
						jQuery('#jigIgAuthRequest').click(function(){
							jQuery('#jigIgAuthManualBtn').removeClass('jig_disable')
							jQuery(window).focus(function(){
								if(jig_waiting_for_access_token === false){
									jig_waiting_for_access_token = true;
									jig_get_ig_access_token();
								}
							})
						})
						jQuery('#jigIgAuthed').on("click", ".jigIgAuthedRemove", function(event){
							event.stopImmediatePropagation();
							jig_remove_ig_authed(jQuery(this).parent());
						})
						.on("click", ".jigIgAuthedElement", function(event){
							jig_verify_ig_authed(jQuery(this).closest('.jigIgAuthedElement'));
						});

						jQuery('#jigIg').on("click", "#jigIgAuthManualBtn", function(event){
							jig_get_ig_access_token();
						})	
						.on("click", "#jigIgAuthRequest", function(event){
							jig_ig_ajax_loading('show');
						});

						// General
						jQuery('#jig_backup_settings').on("click", "#jigSettingsBackupButton", function(event){
							jig_backup_settings();
						})
						.on("click", "#jigSettingsBackupText",function(event){
							jQuery(this).select();
						})

						jQuery('#jig_import_settings').on("click", "#jigSettingsImportButton", function(event){
							jig_import_settings();
						})
						.on("click", "#jigSettingsImportText",function(event){
							jQuery(this).select();
						})

						jQuery("#jigWipeSettingsButton").on("click", function(event){
							jig_wipe_settings();
						})

						jQuery('#jigSettingsBackupText').val('').removeAttr('disabled');
						jQuery('#jigSettingsImportText').val('').removeAttr('disabled');
						
						jQuery("#jig_general_settings, #jig_load_more, #jig_lightboxes, #jig_captions, #jig_overlay, #jig_specialfx, #jig_filtering, #jig_facebook, #jig_flickr, #jig_instagram, #jig_timthumb, #jig_rss, #jig_nextgen, #jig_developer_link").each( function(index, element){
							$this = jQuery(element);
							$this.addClass("jigTabHook").prev().addClass("jigTabTitle").next().next().addClass("jigSettingsTab").attr('id',function(){return $this.attr('id')+'_tab_content';})
						})
						function addMiniSection(setting, title){
							jQuery("#jigContext-"+setting).parent().parent().before('<tr class="jigMiniSection" valign="top"><td colspan="2">'+title+'</td></tr>');
						}
						

						jQuery(".jigHiddenInput").parent().parent().hide();
						addMiniSection('row_height',"<?php _e('Row behavior', 'jig_td'); ?>");
						addMiniSection('limit',"<?php _e('Thumbnail count and dimensions', 'jig_td'); ?>");
						addMiniSection('orderby',"<?php _e('Settings that affect the entire grid', 'jig_td'); ?>");
						addMiniSection('take_over_gallery',"<?php _e('Behavior of the plugin', 'jig_td'); ?>");
						addMiniSection('post_tags_categories',"<?php _e('Additional tools or utilities', 'jig_td'); ?>");
						addMiniSection('developer_link',"<?php _e('Developer link', 'jig_td'); ?>");
						addMiniSection('jquery',"<?php _e('Advanced', 'jig_td'); ?>");
						addMiniSection('proper_uninstall',"<?php _e('Backup and uninstall', 'jig_td'); ?>");
						
						addMiniSection('lightbox',"<?php _e('What to do when clicking on a thumbnail', 'jig_td'); ?>");
						addMiniSection('link_title_field',"<?php _e('What text to show inside the lightbox', 'jig_td'); ?>");
						addMiniSection('download_link',"<?php _e('Download link', 'jig_td'); ?>");
						addMiniSection('prettyphoto_social',"<?php _e('PrettyPhoto settings', 'jig_td'); ?>");
						addMiniSection('photoswipe_settings',"<?php _e('Other lightbox settings', 'jig_td'); ?>");

						addMiniSection('caption',"<?php _e('Caption appearance and style', 'jig_td'); ?>");
						addMiniSection('caption_align',"<?php _e('Align', 'jig_td'); ?>");
						addMiniSection('title_field',"<?php _e('What text to show on the top of thumbnails', 'jig_td'); ?>");
						addMiniSection('caption_title_css',"<?php _e('Extra', 'jig_td'); ?>");
						
						addMiniSection('overlay',"<?php _e('Overlay appearance and style', 'jig_td'); ?>");
						addMiniSection('overlay_icon',"<?php _e('Overlay icon on top of thumbnails', 'jig_td'); ?>");
						addMiniSection('outer_shadow',"<?php _e('Shadows', 'jig_td'); ?>");
						addMiniSection('outer_border_width',"<?php _e('Borders', 'jig_td'); ?>");

						addMiniSection('filterby',"<?php _e('Filtering behavior and style', 'jig_td'); ?>");
						addMiniSection('filter_button_css',"<?php _e('Settings for the Buttons style', 'jig_td'); ?>");
						addMiniSection('filter_smallest_color',"<?php _e('Settings for the Tag cloud style', 'jig_td'); ?>");

						jQuery(".jigTabButton").click(function(){
							var target = "#jig_"+jQuery(this).attr("id").substring(8);
							jQuery(".jigSelectedTab").removeClass("jigSelectedTab")
							jQuery(target).addClass("jigSelectedTab").prev().addClass("jigSelectedTab").next().next().addClass("jigSelectedTab")
							jQuery(".jigSelectedTabButton").removeClass("jigSelectedTabButton")
							jQuery(this).addClass("jigSelectedTabButton")
							jQuery('#currently_selected_tab').val(target+'|'+jQuery('#currently_selected_tab').data('generate-time'))
						})
						var currentlySelected = jQuery('#currently_selected_tab').val();
						if(currentlySelected){
							currentlySelected = "#jig_tab_"+currentlySelected.substring(5,currentlySelected.indexOf('|'));
							jQuery(currentlySelected).click();
						}else{
							jQuery("#jig_tab_general_settings").addClass("jigSelectedTabButton");
							jQuery("#jig_general_settings").addClass("jigSelectedTab").prev().addClass("jigSelectedTab").next().next().addClass("jigSelectedTab")

						}
						jQuery('form').show()
						jQuery('#jigColorHelperField').wpColorPicker();
					});

			</script>
			<style type="text/css">
				#jigTopWrapper{
					position: relative;
				}
				#jigLogo{
					margin-left: -7px;
					margin-top: 10px;
				}
				#jigLikeBox{
					top: 29px;
					position: absolute;
					left: 260px;
				}
				form{
					display: none;
				}
				.jigMiniSection{
					border-top: 1px solid #dedee3;
					border-bottom: 1px solid #dedee3;
				}
				.jigMiniSection td{
					text-align: center;
					font-size: 14px;
					font-weight: bold;
					background-color: #fff;
					padding: 20px 0 21px;
					color: #555;
				}
				.jigTabHook,
				.jigTabTitle,
				.jigSettingsTab{
					position:absolute;
					left:-9999px;
					top:-9999px;
				}
				.jigTabHook.jigSelectedTab,		
				.jigTabTitle.jigSelectedTab,
				.jigSettingsTab.jigSelectedTab{
					position:static;
					left:auto;
					top:auto;
				}
				#jig_load_more_tab_content textarea,
				#gradient_caption_bg_css{
					width: 680px;
				}
				#jig_general_settings_tab_content tr{
					border-left: 3px solid #8a00ff;
				}
				#jig_load_more_tab_content tr{
					border-left: 3px solid #00a8ff;
				}
				#jig_lightboxes_tab_content tr{
					border-left: 3px solid #ffc600;
				}
				#jig_captions_tab_content tr{
					border-left: 3px solid #ff0072;
				}
				#jig_overlay_tab_content tr{
					border-left: 3px solid #9958c3;
				}
				#jig_specialfx_tab_content tr{
					border-left: 3px solid #0feaea;
				}
				#jig_filtering_tab_content tr{
					border-left: 3px solid #c49bff;
				}
				#jig_facebook_tab_content tr{
					border-left: 3px solid #3b5998;
				}
				#jig_flickr_tab_content tr{
					border-left: 3px solid #0063dc;
				}
				#jig_instagram_tab_content tr{
					border-left: 3px solid #507ea2;
				}
				#jig_rss_tab_content tr{
					border-left: 3px solid #fe9900;
				}
				#jig_timthumb_tab_content tr{
					border-left: 3px solid #c21f1f;
				}
				#jig_nextgen_tab_content tr{
					border-left: 3px solid #b6e82a;
				}

				.form-table{
					background: none repeat scroll 0 0 #f7f7f7;
					border: 1px solid #DEDEE3;
					border-radius: 5px 5px 5px 5px;
					width: 98%;
				}
				h3{
					font-size: 18px;
	    			margin: 30px 0 0;
				}
				label{
					padding-left:5px;
				}
				.jigContextHelp{
					background: none repeat scroll 0 0 #FEFEFE;
					border: 1px solid #DFDFDF;
					border-radius: 5px 5px 5px 5px;
					color: #666;
					cursor: default;
					float: right;
					padding: 0 5px;
					text-align:right;
					max-width:400px;
				}
				.form-table tr{
					-webkit-transition:background-color 0.2s ease-in-out;  
					-moz-transition:background-color 0.2s ease-in-out;  
					-o-transition:background-color 0.2s ease-in-out;  
					transition:background-color 0.2s ease-in-out;  
				}
				.form-table tr:hover{
					background-color: #efefef;
				}
				.button-secondary{
					margin-bottom: 5px !important;
					text-align:left;
				}
				#jigFbLeft,
				#jigFbRight,
				#jigFliLeft,
				#jigFliRight,
				#jigIgLeft,
				#jigIgRight{
					float:left;
					width:50%;
				}
				.jigLong{
					width: 98%;
				}
				.jig_disable,
				.jigFbAuthLogEntry,
				#jigFbAuthedPrototype,
				.jigIgAuthLogEntry,
				#jigIgAuthedPrototype,
				.jigFliAuthLogEntry,
				#jigFliAddedPrototype,
				#ttPermissionResults,
				#ttChmodFeedback{
					display: none;
				}
				#jigAddFbPage,
				#jigFbAuthBtn,
				#jigFbAuthManualBtn,
				#jigFbOtherUserLoad,
				.jigFbAuthedElement,
				.jigFliAddedElement,
				#jigAddFliUser,
				#jigIgAuthBtn,
				#jigIgAuthManualBtn,
				.jigIgAuthedElement,
				.jigTabButton,
				#jigSettingsBackupButton,
				#jigSettingsImportButton,
				#jigWipeSettingsButton{
					margin: 5px 10px 5px 0;
					padding: 3px 8px;
					color: black;
					float: left;
					font-weight: normal;
					line-height: 24px;
					text-align: center;
					text-decoration: none;
					width: auto;
					background-color:#EEEEEE;		
					background-image: -ms-linear-gradient(top, #FFFFFF 0%, #DDDDDD 100%);
					background-image: -moz-linear-gradient(top, #FFFFFF 0%, #DDDDDD 100%);
					background-image: -o-linear-gradient(top, #FFFFFF 0%, #DDDDDD 100%);
					background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #FFFFFF), color-stop(1, #DDDDDD));
					background-image: -webkit-linear-gradient(top, #FFFFFF 0%, #DDDDDD 100%);
					background-image: linear-gradient(to bottom, #FFFFFF 0%, #DDDDDD 100%);		
					border: 1px solid #BBBBBB;
					border-radius: 3px 3px 3px 3px;
					cursor: pointer;
					font-size: 12px;
					min-height: 24px;
				}
				#jigFbAuthBtn{
					clear: both;
				}
				.jigEncryptionKeyContainer{
					float: left;
					margin: 8px 10px 0 -5px;
				}
				#jigSettingsBackupText,
				#jigSettingsImportText{
					clear: both;
					display: block;
					width: 100%;
				}
				#jigSettingsBackupText{
					display: none;
					margin: 5px 0 0;
				}
				#jigSettingsImportText{
					display: block;
					margin: 5px 0;

				}

				.jigTabButton.jigSelectedTabButton,
				.jigTabButton.jigSelectedTabButton:hover,
				.jigTabButton.jigSelectedTabButton:focus,
				.jigTabButton.jigSelectedTabButton:active{
					border: 2px solid #3B5A99;
					margin: 4px 9px 4px -1px;;
				}
				.jigFliAddedRemove{
					cursor: pointer;
				}
				#jigAddFbPage:hover,
				#jigFbAuthBtn:hover,
				#jigFbAuthManualBtn:hover,
				#jigFbOtherUserLoad:hover,
				.jigFbAuthedElement:hover,
				.jigFliAddedElement:hover,
				#jigAddFliUser:hover,
				#jigIgAuthBtn:hover,
				#jigIgAuthManualBtn:hover,
				.jigIgAuthedElement:hover,
				.jigTabButton:hover,
				#jigSettingsBackupButton:hover,
				#jigSettingsImportButton:hover,
				#jigWipeSettingsButton:hover{
					border:1px solid #555555;
				}
				.igExpiredRedAlert,
				.igExpiredRedAlert:hover,
				.fbExpiredRedAlert,
				.fbExpiredRedAlert:hover{
					border:1px solid red;
				}
				#jigFbAuthed,
				#jigFliAdded,
				#jigIgAuthed{
					border-bottom: 1px solid #DFDFDF;
					margin-bottom: 10px;
					padding-bottom: 10px;
				}
				#jigFbAuthLogTitle,
				#jigFliAuthLogTitle,
				#jigIgAuthLogTitle{
					font-weight: bold;
				}
				.jigFbAuthLogEntry,
				.jigFliAuthLogEntry,
				.jigIgAuthLogEntry
				{
					margin-top:6px;
				}
				#jigFbAuthLogWrapper,
				#jigFliAuthLogWrapper,
				#jigIgAuthLogWrapper{
					background: none repeat scroll 0 0 #FEFEFE;
					border: 1px solid #DFDFDF;
					border-radius: 5px 5px 5px 5px;
					margin-top: 5px;
					padding: 5px;
				}
				.jigFbAuthedName,
				.jigFbAccessFrom,
				.jigFbAuthedRemove,
				.jigFbAuthedIcon,
				.jigFliAddedName,
				.jigFliAddedRemove,
				.jigFliAddedIcon,
				.jigIgAuthedName,
				.jigIgAuthedRemove,
				.jigIgAuthedIcon{
					float:left;
				}
				.jigFliAddedIcon,
				.jigFbAuthedIcon,
				.jigIgAuthedIcon{
					height: 16px;
				}
				.jigFliAddedIcon img,
				.jigFbAuthedIcon img,
				.jigIgAuthedIcon img{
					min-height: 16px;
					width: 16px;
					margin-right: 10px;
					margin-top: 4px;
					display: block;
				}
				.jigFbAuthedRemove,
				.jigFliAddedRemove,
				.jigIgAuthedRemove{
					color: #666;
					font-weight: bold;
					margin-left:10px;
				}
				.jigFbAccessFrom{
					font-size:10px;
					color:#AAA;
				}
				.jigFbAccessFromInner{
					margin-left:7px;
				}
				.jigFbAuthedRemove:hover,
				.jigFliAddedRemove:hover,
				.jigIgAuthedRemove:hover{
					color:red;
				}
				#jigAddFbPageInput,
				#jigAddFliUserInput{
					margin-left: 7px;
				}
				#jigFbAuthOtherUserPanelTitle{
					clear: both;
					padding-top: 10px;
				}
				#jigFbWithAppOnly{
					padding-top: 10px;
					clear:both;
				}
				#jigFbAuthOtherUserPanelTitle,
				#jigFbToAddUserHelpTitle,
				#jigFliToAddUserHelpTitle
				{
					font-weight: bold;
					margin-top:12px;
				}
				#jigFbWrapper,
				#jigFliWrapper,
				#jigIgWrapper{
					position: relative;
				}
				#jigFbLoadingAJAX,
				#jigFliLoadingAJAX,
				#jigIgLoadingAJAX{			
					height: 100%;
					position: absolute;
					text-shadow: 0 1px white;
					width: 100%;
					z-index: 5;
					display: none;
				}
				#jigFbLoadingInner,
				#jigFliLoadingInner,
				#jigIgLoadingInner{
					background: url("<?php echo plugins_url('images/ajax-loader.gif', __FILE__); ?>") no-repeat left 30px;
					font-weight: bold;
					height: 55px;
					left: 50%;
					letter-spacing: 0.4px;
					line-height: 15px;
					margin: -30px 0 0 -120px;
					min-width: 215px;
					padding-left: 6px;
					position: absolute;
					text-align: left;
					text-transform: uppercase;
					top: 50%;
				}
				#jigIgLoadingInner{
					letter-spacing: 0.6px;
				}
				#jigFbLoadingInnerSmallText,
				#jigFliLoadingInnerSmallText,
				#jigIgLoadingInnerSmallText{
					color: #666;
					font-size: 10px;
					letter-spacing: 0;
				}
				#jigFbIcon{
					height: 50px;
					left: -55px;
					position: absolute;
					top: 0;
					width: 50px;
					background: url("<?php echo plugins_url('images/facebook-icon.png', __FILE__); ?>") no-repeat center center;
				}
				#jigFliIcon{
					height: 49px;
					left: -49px;
					position: absolute;
					top: 0;
					width: 50px;
					background: url("<?php echo plugins_url('images/flickr-icon.png', __FILE__); ?>") no-repeat center center;
				}
				#jigIgIcon{
					height: 49px;
					left: -49px;
					position: absolute;
					top: 0;
					width: 50px;
					background: url("<?php echo plugins_url('images/instagram-icon.png', __FILE__); ?>") no-repeat center center;
				}
				#jigFbAppHelp,
				#jigFliApiHelp,
				#jigIgAppHelp{
					display:none;
				}
				#jigFbAppHelpTitle,
				#jigFliApiHelpTitle,
				#jigIgAppHelpTitle
				{
					font-weight: bold;
				}
				#submitButton{
					background-color:#21759B;		
					background-image: -ms-linear-gradient(top, #0b7aac 0%, #039de3 100%);
					background-image: -moz-linear-gradient(top, #0b7aac 0%, #039de3 100%);
					background-image: -o-linear-gradient(top, #0b7aac 0%, #039de3 100%);
					background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #0b7aac), color-stop(1, #039de3));
					background-image: -webkit-linear-gradient(top, #0b7aac 0%, #039de3 100%);
					background-image: linear-gradient(to bottom, #0b7aac 0%, #039de3 100%);		
					border: 2px solid #00425f;
					border-radius: 3px 3px 3px 3px;
					color: #FFF;
					cursor: pointer;
					font-weight: bold;
					padding: 6px;
					text-shadow: 0 -1px 0 black;
					bottom: 5px;
					right: 5px;
					position: fixed;
					width: 200px;
					z-index: 1000;
				}
				#submitButton:hover{
					border: 2px solid #000;
				}
				.jig-clearfix:before,
				.jig-clearfix:after {
					content: "";
					display: table;
				}
				.jig-clearfix:after {
					clear: both;
				}
				.jig-clearfix {
					zoom: 1; /* For IE 6/7 (trigger hasLayout) */
				}
				#jigColorHelper{
					position: absolute;
					right: 10px;
					top: 16px;
				}
				#jigColorHelper a{
					outline:none;
				}
				#jigColorHelperText{
					vertical-align: 9px;
					padding-right: 10px;
				}
				#jigColorHelper .iris-picker{
					position: absolute;
				}
			</style>
			<form action="" method="post" id="jigPresetSelector" class="jigLong" onSubmit="if(!confirm('<?php _e('Are you sure you wish to apply the preset and overwrite your styling settings?', 'jig_td'); ?>')){return false;}">
				<?php wp_nonce_field('jig_presets','jig_presets_nonce'); ?>
				<input type="hidden" name="presets" value="1" />
				<input type="submit" name="preset1" class="button-secondary" value="<?php _e('Preset 1: Out of the box (default)', 'jig_td'); ?>" />
				<input type="submit" name="preset2" class="button-secondary" value="<?php _e("Preset 2: Author's favorite", 'jig_td'); ?>" />
				<input type="submit" name="preset3" class="button-secondary" value="<?php _e('Preset 3: Flickr style', 'jig_td'); ?>" />
				<input type="submit" name="preset4" class="button-secondary" value="<?php _e('Preset 4: Google+ style', 'jig_td'); ?>" />
				<input type="submit" name="preset5" class="button-secondary" value="<?php _e('Preset 5: Fixed height, no fancy', 'jig_td'); ?>" />
				<input type="submit" name="preset6" class="button-secondary" value="<?php _e('Preset 6: Artistic-zen', 'jig_td'); ?>" />
				<input type="submit" name="preset7" class="button-secondary" value="<?php _e('Preset 7: Color magic fancy style', 'jig_td'); ?>" />
				<input type="submit" name="preset8" class="button-secondary" value="<?php _e('Preset 8: Big images no click', 'jig_td'); ?>" />
				<input type="submit" name="preset9" class="button-secondary" value="<?php _e('Preset 9: Focus on the text', 'jig_td'); ?>" />
				<input type="submit" name="preset10" class="button-secondary" value="<?php _e('Preset 10: Hidden', 'jig_td'); ?>" />
				<input type="submit" name="preset11" class="button-secondary" value="<?php _e('Preset 11: Magnifier blur', 'jig_td'); ?>" />
				<input type="submit" name="preset12" class="button-secondary" value="<?php _e("Preset 12: Author's other favorite", 'jig_td'); ?>" />
				<input type="submit" name="preset13" class="button-secondary" value="<?php _e('Preset 13: Orton effect', 'jig_td'); ?>" />
				<input type="submit" name="preset14" class="button-secondary" value="<?php _e('Preset 14: Animated border and glow', 'jig_td'); ?>" />
				<input type="submit" name="preset15" class="button-secondary" value="<?php _e('Preset 15: Borders and shadow', 'jig_td'); ?>" />
				<input type="submit" name="preset16" class="button-secondary" value="<?php _e('Preset 16: Facebok inspired', 'jig_td'); ?>" />
				<input type="submit" name="preset17" class="button-secondary" value="<?php _e('Preset 17: Vertical center', 'jig_td'); ?>" />
				<input type="submit" name="preset18" class="button-secondary" value="<?php _e('Preset 18: Vertical creative', 'jig_td'); ?>" />
				<input type="submit" name="preset19" class="button-secondary" value="<?php _e('Preset 19: Caption fun, gray background', 'jig_td'); ?>" />
				<input type="submit" name="preset20" class="button-secondary" value="<?php _e('Preset 20: Caption below the thumbs', 'jig_td'); ?>" />
			</form>
			<p><strong><?php _e('Settings','jig_td'); ?>:</strong></p>
			<div id="jigTabs" class="jig-clearfix">
				<div class="jigTabButton" id="jig_tab_general_settings"><?php _e('General settings','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_load_more"><?php _e('Load more','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_filtering"><?php _e('Filtering','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_lightboxes"><?php _e('Lightboxes','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_captions"><?php _e('Captions','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_overlay"><?php _e('Overlay effects','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_specialfx"><?php _e('Special effects','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_nextgen"><?php _e('NextGEN','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_facebook"><?php _e('Facebook','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_flickr"><?php _e('Flickr','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_instagram"><?php _e('Instagram','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_rss"><?php _e('RSS','jig_td'); ?></div>
				<div class="jigTabButton" id="jig_tab_timthumb"><?php _e('TimThumb & CDN','jig_td'); ?></div>
			</div>
			<form method="post" action="options.php">
				<?php settings_fields(self::SETTINGS_NAME); ?>
				<?php do_settings_sections(self::PAGE_NAME); ?>
				<input id="submitButton" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
			</form>
	<?php
		}
		// updates and returns the defaults with settings from the database
		function get_options(){
			$saved_options = get_option(self::SETTINGS_NAME);
			if (!empty($saved_options)){
				foreach($this->default_settings as $key => $val){
					// if the user enters -1 it'll revert to the default value
					if(isset($saved_options[$key])){
						if($saved_options[$key] !== '-1'){
							$this->default_settings[$key] = $saved_options[$key];
						}
					}
				}
			}
			return $this->default_settings;
		}

		// Registers/adds the presets, sections, and settings fields.
		function jig_init_options(){
			if (isset($_POST['presets']) && check_admin_referer('jig_presets','jig_presets_nonce')){
				for ($i = 1; $i < 21; $i++) {
					if (isset($_POST['preset'.$i])){
						$preset_settings = $this->presets[$i];
						global $jig_preset_notice;
						$jig_preset_notice = "<div class='updated'><p><strong>".stripslashes($_POST['preset'.$i]).' '.__('has been successfully applied!')."</strong></p></div>"; 
						function print_preset_notice(){
							global $jig_preset_notice;
							echo $jig_preset_notice;
						}
						add_action('admin_notices', 'print_preset_notice');	
						break;
					}
				}
				update_option(self::SETTINGS_NAME, array_merge(array_merge($this->defaults, $this->settings_override), $preset_settings));
				$this->settings = $this->get_options();
			}  
			$this->jig_init_check_permissions();
			$this->jig_check_expired();
			register_setting(self::SETTINGS_NAME, self::SETTINGS_NAME);
			$this->social_gallery_plugin_data = $this->social_gallery_plugin_exists();
			global $current_user;

			// --------------------------------
			//    General settings section
			// --------------------------------
			add_settings_section(
				'jig_general_settings_section',						// Section ID  
				__('General settings', 'jig_td'),					// Section Title
				array($this, 'jig_print_general_settings_desc'),	// Callback for the description of the section
				self::PAGE_NAME										// Page to add the section to
			);  


			// -------------------------------- Row behavior --------------------------------

			// Target row height
			add_settings_field(
				'jig_row_height',									// Field ID
				__('Target row height', 'jig_td'),				// Field title 
				array($this, 'jig_print_text_input'),				// Field's callback
				self::PAGE_NAME,									// The field's parent page
				'jig_general_settings_section',						// The field's parent section
				array(	'id' => 'row_height',
						'label' => __('Desired row height in pixels, e.g. 200 (without px).', 'jig_td'))
			); 
			// Row height max deviation (+-)
			add_settings_field(
				'jig_height_deviation',
				__('Row height max deviation (+-)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'height_deviation',
						'label' => __('The row height will vary +/- by this value, e.g. 50 (without px).', 'jig_td'))
			); 
			// Max rows
			add_settings_field(
				'jig_max_rows',
				__('Max rows', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'max_rows',
						'label' => __('Only show up to this amount of rows. Leave empty, 0 or -1 for unlimited. Combined with a fixed row height (0 deviation), this can result a banner.', 'jig_td'))
			);
			// Incomplete last row
			add_settings_field(
				'jig_last_row',
				__('Incomplete last row', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'last_row',
						'help' => __('The last row is not always full - choose how to handle it. If incomplete, the last row will fit the available width, but only until the max height (Row height + Deviation) is reached. Otherwise an incomplete row is visible and is as tall as the desired row height. You can alter this behavior here.', 'jig_td'),
						'inputs' => array(
							'normal' => __('Normal: Try to fill width OR fall back to target height (visibly incomplete).', 'jig_td'),
							'hide' => __('Hide: Hide the incomplete row (the gallery forms a perfect justified block).', 'jig_td'),
							'flexible' => __('Flexible: Only when using Load More: same as hide, but allows the very last row to be orphan.', 'jig_td'),
							'match' => __("Match: Match the previous row's height (use for same shape images e.g. logo showcase).", 'jig_td'),
							'flexible-match' => __('Flexible-match: Only when using Load More: useful for same aspect ratio images - combines flexible and match.', 'jig_td')

						)
				)
			);
			// Mobile row height
			add_settings_field(
				'jig_mobile_row_height',									// Field ID
				__('Mobile row height', 'jig_td'),				// Field title 
				array($this, 'jig_print_text_input'),				// Field's callback
				self::PAGE_NAME,									// The field's parent page
				'jig_general_settings_section',						// The field's parent section
				array(	'id' => 'mobile_row_height',
						'label' => __('Same as "Target row height", but only for mobiles. Optional!', 'jig_td'))
			); 
			// Mobile row height deviation (+-)
			add_settings_field(
				'jig_mobile_height_dev',
				__('Mobile row height deviation (+-)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'mobile_height_dev',
						'label' => __('Same as "Row height max deviation", but for mobiles. Optional!', 'jig_td'))
			); 


			// -------------------------------- Thumbnail count and dimensions --------------------------------
			// Limit image count
			add_settings_field(
				'jig_limit',
				__('Limit image count', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'limit',
						'label' => __('Only show up to this number of images. Leave empty, 0 or -1 for unlimited. Flickr, Facebook and Instagram have a default limit of ~25.', 'jig_td'))
			);
			// Hidden limit
			add_settings_field(
				'jig_hidden_limit',
				__('Hidden limit', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'hidden_limit',
						'label' => __('More images can still be added to the lightbox, until the Hidden limit is reached. This will be the total number of images. E.g. a Limit of 3 and Hidden limit of 30 will show an extra 27 images only in the lightbox.', 'jig_td'))
			);
			// Spacing between the thumbnails
			add_settings_field(
				'jig_thumbs_spacing',
				__('Spacing between the thumbnails', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'thumbs_spacing',
						'label' => __('Enter a number like 0, 1, 4 or 10 (without px).', 'jig_td'))
			);	
			// Thumbnail aspect ratio
			add_settings_field(
				'jig_aspect_ratio',
				__('Thumbnail aspect ratio', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'aspect_ratio',
						'label' => __('Highly recommended to leave empty (for best results of the original layout). This crops your thumbnail to a fixed look. Enter a ratio like 1, 1:1 or 1/1 for square, 2.35:1 or 16:9 for wide, or just about any value you desire: 4/3, 3/4, 5:4, 4:5, 1.5, 0.5 or similar.', 'jig_td'))
			);
			// Disable cropping
			add_settings_field(
				'jig_disable_cropping',
				__('Disable cropping', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'disable_cropping',
							'help' => __("Use this to avoid cropping or to lock your selected aspect ratio. This lifts the restriction of a minimum height imposed by 'Row height deviation'.", 'jig_td'),
							'inputs' => array(
								'no' => __('No, respect the row height and allow some cropping.', 'jig_td'),
								'yes' => __('Yes, lock aspect ratio and use 50px minimum row height.', 'jig_td')
							)
					)
			);
			// Randomize thumbnail width
			add_settings_field(
				'jig_randomize_width',
				__('Randomize thumbnail width', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'randomize_width',
						'label' => __('A number (without px) to make images randomly cropped or extended within this range. If your images have the same aspect ratio, this will make the grid look more interesting and alive. For example, entering 50 will change image widths by up to +/- 25px.', 'jig_td'))
			);
			// -------------------------------- Settings that affect the entire grid --------------------------------
			// The order of the images
			add_settings_field(
				'jig_orderby',
				__('Order of the images', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'orderby',
							'help' => __('Choose the order the images appear in, only when images/posts are from WordPress. For Flickr, Facebook, Instagram or NextGEN, the order is set up in these 3rd party image sources. However, the random order here will work regardless of the image source.', 'jig_td'),
							'inputs' => array(
								'menu_order' => __('Menu order', 'jig_td'),
								'rand' => __('Random', 'jig_td'),
								'title_asc' => __('Title ascending', 'jig_td'),
								'title_desc' => __('Title descending', 'jig_td'),
								'date_asc' => __('Date ascending', 'jig_td'),
								'date_desc' => __('Date descending', 'jig_td'),
								'custom' => __('Custom order (forced menu_order for recent posts, best used with "Simple Custom Post Order" plugin)', 'jig_td')
							)
					)
			);

			// Width mode
			add_settings_field(
				'jig_width_mode',
				__('Width mode', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'width_mode',
							'help' => __('Set to Fixed if you are experiencing problems with tabs or having the "element is too thin" error. You must set a width value for the next setting if you selected any of the Fixed modes.', 'jig_td'),
							'inputs' => array(
								'responsive_fallback' => __('Responsive fallback, automatic.', 'jig_td'),
								'fixed' => __('Fixed: Non-responsive.', 'jig_td'),
								'fixed-mobile' => __('Fixed width for mobile - Responsive on desktop.', 'jig_td'),
								'fixed-desktop' => __('Fixed width for desktop - Responsive on mobile.', 'jig_td')
							)
					)
			);
			// Custom width
			add_settings_field(
				'jig_custom_width',
				__('Custom width (whole grid)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'custom_width',
						'label' => __('The width to use by the previous setting, leave empty or 0 for automatic width (the default, recommended). For example 1200 (without px).', 'jig_td'))
			);

			// Margin around gallery
			add_settings_field(
				'jig_margin',
				__('Margin around gallery', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'margin',
						'label' => __('A CSS shorthand margin value: 10px - all four sides, 0 10px - just the sides, 10px 0 - just the top and bottom. Without any quotes.', 'jig_td'))
			);
			// Animation speed
			add_settings_field(
				'jig_animation_speed',
				__('Animation speed', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'animation_speed',
						'label' => __('Used by every animation. In milliseconds: 200 is fast, 600 is slow.', 'jig_td'))
			);
			// Min-height to avoid "jumping"
			add_settings_field(
				'jig_min_height',
				__('Min height to avoid "jumping"', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'min_height',
						'label' => __('To avoid seeing the footer if you have no sidebar, e.g. 800 without px. Makes the grid take up some space even without images.', 'jig_td'))
			);
			// Background behind thumbnails
			add_settings_field(
				'jig_loading_background',
				__('Background behind thumbnails', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'loading_background',
						'label' => __("You could specify a grey color like Flickr #cccccc or #eaeaea or even a loader animation (animated gif). Accepts CSS background property. <br /> Example of an image on a light grey background:<br />url('http://full.path/to/image.png') center center no-repeat #eaeaea", 'jig_td'))
			);
			// Text to show before the grid
			add_settings_field(
				'jig_text_before',
				__('Text to show before the grid', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'text_before',
						'label' => __('Add text before every grid. HTML is accepted. Can be disabled on individual instances.', 'jig_td'))
			);
			// Text to show after the grid
			add_settings_field(
				'jig_text_after',
				__('Text to show after the grid', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'text_after',
						'label' => __('Add text after every instance. Otherwise same as previous setting.', 'jig_td'))
			);
			// -------------------------------- Behavior of the plugin --------------------------------
			// Take over (replace) [gallery] shortcodes
			add_settings_field(
				'jig_take_over_gallery',
				__('Take over and replace [gallery] WordPress gallery shortcodes', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'take_over_gallery',
							'help' => __('Choose yes if you wish to automatically use Justified Image Grid in place of your current galleries. Useful for already established posts.', 'jig_td'),
							'inputs' => array(
								'hide' => __('Hide [gallery] shortcodes after [justified_image_grid] shortcode.', 'jig_td'),
								'yes' => __('Yes, act in place of the [gallery] shortcode.', 'jig_td'),
								'no' => __('No, leave the [gallery] shortcode alone.', 'jig_td')
								
							)
					)
			);
			// Shortcode alias
			add_settings_field(
				'jig_shortcode_alias',
				__('Shortcode alias', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'shortcode_alias',
						'label' => __('<strong>Advanced setting!</strong> You can enter another, shorter name for the shortcode here, for example: jig or justified. Without brackets.', 'jig_td'))
			);
			// Allow animated GIFs
			add_settings_field(
				'jig_allow_animated_gifs',
				__('Allow animated GIFs', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'allow_animated_gifs',
							'help' => __("Animated GIFs are resized, but freezed by (TimThumb) or have bad frames (Jetpack Photon). If you allow animated GIFs, they won't be resized as thumbnails, and the 'Thumbnail aspect ratio' and 'Randomize thumbnail width' settings won't apply for them. However, they'll display properly!", 'jig_td'),
							'inputs' => array(
								'no' => __('No, resize and freeze them.', 'jig_td'),
								'yes' => __('Yes, let them display as-is.', 'jig_td')
							)
					)
			);
			// Allow transparent PNGs
			add_settings_field(
				'jig_allow_transp_pngs',
				__('Allow transparent PNGs', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'allow_transp_pngs',
							'help' => __("Images intentionally show up with white background to prevent some rendering problems. Only enable if you really want to use transparent PNGs.", 'jig_td'),
							'inputs' => array(
								'no' => __('No.', 'jig_td'),
								'yes' => __('Yes, let them display with transparency.', 'jig_td')
							)
					)
			);
			// Wrap text
			add_settings_field(
				'jig_wrap_text',
				__('Wrap text', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'wrap_text',
							'help' => __('Let the text flow to the right after the last image, useful for a single image.', 'jig_td'),
							'inputs' => array(
								'no' => __('No, clear the block.', 'jig_td'),
								'yes' => __('Yes, let the text wrap around JIG.', 'jig_td')
							)
					)
			);
			// Disable mobile hover interaction
			add_settings_field(
				'jig_disable_mobile_hover',
				__('Disable mobile hover interaction', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'disable_mobile_hover',
							'help' => __('Choose yes if you wish to avoid "double tapping" to open images.', 'jig_td'),
							'inputs' => array(
								'no' => __('No', 'jig_td'),
								'yes' => __('Yes', 'jig_td')
							)
					)
			);
			// Right click disable
			add_settings_field(
				'jig_mouse_disable',
				__('Disable right mouse menu', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'mouse_disable',
							'help' => __('Choose yes if you wish to disable right click menu (copy protection).', 'jig_td'),
							'inputs' => array(
								'no' => __('No', 'jig_td'),
								'yes' => __('Yes', 'jig_td')
							)
					)
			);
			// Error checking switch
			add_settings_field(
				'jig_error_checking',
				__('Error checking', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'error_checking',
							'help' => __('Yes to hide unloadable images from the grid, No to show them all.', 'jig_td'),
							'inputs' => array(
								'yes' => __('Yes', 'jig_td'),
								'no' => __('No', 'jig_td')
							)
					)
			);
			// Custom link default target
			add_settings_field(
				'jig_link_target',
				__("Custom link's target", 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'link_target',
							'help' => __('Choose where you wish to open custom links.', 'jig_td'),
							'inputs' => array(
								'_self' => __('Self: The same tab or same window.', 'jig_td'),
								'_blank' => __('Blank: A new tab or new window.', 'jig_td'),
								'video' => __('Lightbox: video / iframe / different image', 'jig_td')
							)
					)
			);
			// Follow mode for custom links (rel)
			add_settings_field(
				'jig_custom_link_follow',
				__('Follow mode for custom links (rel)', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'custom_link_follow',
							'help' => __('Tell search engines to follow the custom link to the external site.', 'jig_td'),
							'inputs' => array(
								'yes' => __('Yes: dofollow.', 'jig_td'),
								'no' => __('No: add nofollow.', 'jig_td')
							)
					)
			);

			// -------------------------------- Additional tools or utilities --------------------------------
			// WP image tags and categories
			add_settings_field(
				'jig_post_tags_categories',
				__('WP image tags and categories', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'post_tags_categories',
							'help' => sprintf(__('Enable to use tags and categories for images in the Media Library. Very simple, if you need more, get a plugin like %s or %s.', 'jig_td'),'<a href="http://wordpress.org/extend/plugins/media-library-assistant/" target="_blank">Media Library Assistant</a>','<a href="http://wordpress.org/extend/plugins/media-categories-2/" target="_blank">Media Categories</a>'),
							'inputs' => array(
								'disable' => __('Disable, do not change anything.', 'jig_td'),
								'enable' => __('Enable the ability to add post categories or tags to images.', 'jig_td')
							)
					)
			);
			// Media re-attacher
			add_settings_field(
				'jig_media_attacher',
				__('Media attacher utility', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'media_attacher',
							'help' => sprintf(__('Enable to attach/re-attach images to posts/pages in the Media Library.<br/>For a more complete solution, get the %s plugin.', 'jig_td'),'<a href="http://wordpress.org/extend/plugins/file-un-attach/" target="_blank">File Un-Attach</a>'),
							'inputs' => array(
								'disable' => __('Disable', 'jig_td'),
								'enable' => __('Enable: Move images between posts/pages in the Media Library.', 'jig_td')
							)
					)
			);
			// Add images to WordPress SEO XML Sitemap
			add_settings_field(
				'jig_add_to_sitemap',
				__('Add images to WordPress SEO XML Sitemap', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'add_to_sitemap',
							'help' => sprintf(__("Keep enabled to add images to the %s plugin's XML Sitemap. This improves your SEO.", 'jig_td'),'<a href="http://yoast.com/wordpress/seo/" target="_blank">WordPress SEO by Joost de Valk</a>'),
							'inputs' => array(
								'enable' => __('Yes, add images to the sitemap.', 'jig_td'),
								'disable' => __('No, do NOT add images to the sitemap.', 'jig_td')
							)
					)
			);
			// -------------------------------- Developer link --------------------------------

			// Show/hide developer link
			add_settings_field(
				'jig_developer_link',
				__('Show/hide developer link', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_general_settings_section',
					array(	'id' => 'developer_link',
							'help' => __('Choose Show if you agree to to have a small "Powered by" affiliate link to the Justified Image Grid page on CodeCanyon, below each gallery. This can be disabled for each grid individually where it is unwanted.<br/>I would appreciate it if you show the link.', 'jig_td'),
							'inputs' => array(
								'hide' => __('Hide: Do not show the developer link.', 'jig_td'),
								'show' => __('Show: I want to support this plugin, show the developer link!', 'jig_td')
							)
					)
			);
			// Link text
			add_settings_field(
				'jig_developer_link_text',
				__('Link text', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'developer_link_text',
						'label' => __('Enter the text for the link. The whole content becomes clickable.', 'jig_td'),
						'rows' => 1)
			);
			// Envato username
			add_settings_field(
				'jig_envato_user',
				__('Envato username for the referral link', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'envato_user',
						'label' => __('Enter your envato username to earn money! Receive 30% of the first purchase or deposit of each referred user. You do not need to activate anything else, you are automatically eligible.', 'jig_td'))
			);
			// -------------------------------- Advanced --------------------------------
			// jQuery source
			add_settings_field(
				'jig_jquery',
				__('jQuery source', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'jquery',
						'help' => sprintf(__("Choose where would you like to load %s from. Loading from Google CDN is protocol flexible. Change this ONLY if you experience errors, as this setting is powerful and will likely override other plugins' choices! If other plugins break or you are getting a red jQuery error then try these settings. Fallback means when google is down. While Justified Image Grid is compatible with any jQuery over v1.7, other scripts in your page may not be and can stop scripts on the page from working including JIG.", 'jig_td'), '<a href="http://jquery.com/" target="_blank">jQuery</a>'),
						'inputs' => array(
							'nochange' => __('No change, load the one already in use (often best).', 'jig_td'),
							'forcewp' => __('Try to force-load jQuery v1.10.2 that is bundled in WordPress.','jig_td'),
							'googlewp' => __('Latest jQuery v1.x from Google with local fallback to jQuery v1.10.2 in WordPress.', 'jig_td'),
							'googleplugin' => __('Latest jQuery v1.x from Google with local fallback to jQuery v1.8.3 by JIG.', 'jig_td'),
							'google2wp' => __("jQuery v2.0.3, fallback to WP's. Does not support Internet Explorer 6, 7, or 8.", 'jig_td'),
							'google2plugin' => __("jQuery v2.0.3, fallback to JIG's. Does not support Internet Explorer 6, 7, or 8.", 'jig_td'),
							'plugin' => __('Load jQuery v1.8.3 bundled with this plugin.', 'jig_td'),
							'legacy' => __('Force-load jQuery v1.8.3 bundled with this plugin only on pages where JIG is used (not recommended, last resort).', 'jig_td')
						)
				)
			);
			// jQuery load location
			add_settings_field(
				'jig_jquery_location',
				__('jQuery load location', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'jquery_location',
						'help' => __('Most reliable when jQuery source is changed. This is a sitewide setting! In a perfect world, footer would be best, however some scripts may get loaded in the header that would depend on jQuery. Use this wisely.', 'jig_td'),
						'inputs' => array(
							'header' => __('In the header (forced first - most compatible).', 'jig_td'),
							'footer' => __('In the footer (atomatic/lazy).', 'jig_td')
						)
				)
			);

			// Shortcode editor button minimum user role
			add_settings_field(
				'jig_shortcode_role',
				__('Shortcode editor button minimum user role', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'shortcode_role',
						'help' => sprintf(__('Show the shortcode editor button for only the chosen role and upwards.<br />Your role is: %s.', 'jig_td'), $current_user->roles[0]),
						'inputs' => array(
							'unlimited' => __('Do not apply a minimum role (unlimited, also good for Multisite).'),
							'contributor' => __('Contributor', 'jig_td'),
							'author' => __('Author', 'jig_td'),
							'editor' => __('Editor', 'jig_td'),
							'administrator' => __('Administrator', 'jig_td')
						)
				)
			);
			// Custom CSS
			add_settings_field(
				'jig_custom_CSS',
				__('Custom CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'custom_CSS',
						'label' => __("Extra CSS to style JIG beyond what's possible with the options.", 'jig_td'),
					'rows' => 6)
			);
			// -------------------------------- Backup and uninstall --------------------------------

			// On uninstall
			add_settings_field(
				'jig_proper_uninstall',
				__('On uninstall', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_general_settings_section',
				array(	'id' => 'proper_uninstall',
						'help' => __('Determine what happens the next time you uninstall the plugin. Caches are transients in wp_options table (used to cache Facebook, Flickr, Instagram) and a wp_jig_ext_images table (used to cache remote images from Jetpack Photon, RSS, very old NextGEN installations). This setting will reset on the next install.', 'jig_td'),
						'inputs' => array(
							'nochange' => __('No change: Keep settings and caches in the database (default, allows smooth updates).', 'jig_td'),
							'full_removal' => __('Full removal: Remove settings and caches from the database.', 'jig_td'),
							'partial_removal' => __('Partial removal: Remove settings from the database but keep the caches.', 'jig_td')
						)
				)
			);
			// Wipe settings
			add_settings_field(
				'jig_wipe_settings',
				__('Wipe settings', 'jig_td'),
				array($this, 'jig_print_wipe_settings'),
				self::PAGE_NAME,
				 'jig_general_settings_section'
			);
			// Backup settings
			add_settings_field(
				'jig_backup_settings',
				__('Backup settings', 'jig_td'),
				array($this, 'jig_print_backup_settings'),
				self::PAGE_NAME,
				 'jig_general_settings_section'
			);
			// Import settings
			add_settings_field(
				'jig_import_settings',
				__('Import settings', 'jig_td'),
				array($this, 'jig_print_import_settings'),
				self::PAGE_NAME,
				 'jig_general_settings_section'
			);

			// Hidden setting: currently selected tab
			add_settings_field(
				'jig_currently_selected_tab',									// Field ID
				__('Currently selected tab', 'jig_td'),				// Field title 
				array($this, 'jig_print_hidden_input'),				// Field's callback
				self::PAGE_NAME,									// The field's parent page
				'jig_general_settings_section',						// The field's parent section
				array(	'id' => 'currently_selected_tab',
						'label' => '')
			); 

			// --------------------------------
			//             Load more
			// --------------------------------
			add_settings_section(
				'jig_load_more_section',
				__('Load more', 'jig_td'),
				array($this, 'jig_print_load_more_desc'),
				self::PAGE_NAME
			);  
			// Load more
			add_settings_field(
				'jig_load_more',
				__('Load more (behavior)', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more',
						'help' => __("When off, the images are limited only by 'Hidden limit' and/or 'Limit'. Enable this to break down loading into smaller batches.", 'jig_td'),
						'inputs' => array(
							'off' => __('Off: All images are loaded in one go.', 'jig_td'),
							'click' => __("Click: You will need to click 'Load more' to show more images.", 'jig_td'),
							'scroll' => __('Infinite scroll: Load more images when scrolled to the bottom (the button is also visible).', 'jig_td')
						)
				)
			);
			// Load more only on mobile
			add_settings_field(
				'jig_load_more_mobile',
				__('Load more only on mobile', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more_mobile',
						'help' => __('Use this if you only want use Load More on mobile devices.', 'jig_td'),
						'inputs' => array(
							'no' => __('No: Not just mobiles,', 'jig_td'),
							'yes' => __('Yes: Only for mobile devices.', 'jig_td')
						)
				)
			);
			// Load more limit
			add_settings_field(
				'jig_load_more_limit',
				__('Load more limit (images per load)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more_limit',
						'label' => __("Set the amount of images to fetch initially, and then per load. This should be something smaller than the 'Limit' (if set). When you are using the Load more feature then the 'Hidden limit' is disabled.", 'jig_td'))
			);
			// Load more text
			add_settings_field(
				'jig_load_more_text',
				__('Load more text', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more_text',
						'label' => __("The text to show on the button, instead of 'Load more'.", 'jig_td'))
			);
			// Load more count text
			add_settings_field(
				'jig_load_more_count_text',
				__('Load more count text', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more_count_text',
						'label' => __('This changes the second line of text on the button. The remaining count, *count* gets replaced with the actual count. To turn off, clear the field.', 'jig_td'))
			);
			// Load more auto width
			add_settings_field(
				'jig_load_more_auto_width',
				__('Load more auto width', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more_auto_width',
						'help' => __("Automatically set the Load more button's width to smallest possible. Its width will depend on the text it contains.", 'jig_td'),
						'inputs' => array(
							'on' => __('On: Automatic width, overrides any CSS.', 'jig_td'),
							'off' => __('Off: Width is controlled by CSS.', 'jig_td')
						)
				)
			);
			// Load more infinite scroll device fix
			add_settings_field(
				'jig_load_more_device_fix',
				__('Load more infinite scroll device fix', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more_device_fix',
						'help' => sprintf(__('Enable this setting if you are having problems with the infinite scroll on mobile devices. This adds %s to the head of your pages.', 'jig_td'),'&lt;meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"&gt;'),
						'inputs' => array(
							'off' => __('Off', 'jig_td'),
							'on' => __('On', 'jig_td')
						)
				)
			);
			// Load more CSS
			add_settings_field(
				'jig_load_more_css',
				__('Load more CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more_css',
						'label' => sprintf(__('CSS settings for the Load more button.<br/>You can use %s to generate gradients<br/><strong>Click to reset to the %s or the %s.</strong>', 'jig_td'),'<a href="http://www.colorzilla.com/gradient-editor/" target="_blank">Gradient editor</a>','<a href="javascript:jig_load_more_css_apply_light_skin();">Light skin</a>','<a href="javascript:jig_load_more_css_apply_dark_skin();">Dark skin</a>'),
					'rows' => 18)
			);
			// Load more hover CSS
			add_settings_field(
				'jig_load_more_hover_css',
				__('Load more hover CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_load_more_section',
				array(	'id' => 'load_more_hover_css',
						'label' => sprintf(__('CSS settings for the Load more button, on mouse over.<br/>You can use %s to generate gradients.', 'jig_td'),'<a href="http://www.colorzilla.com/gradient-editor/" target="_blank">Gradient editor</a>'),
					'rows' => 9)
			);

			// --------------------------------
			//        Filtering
			// --------------------------------
			add_settings_section(
				'jig_filtering_section',
				__('Filtering', 'jig_td'),
				array($this, 'jig_print_filtering_desc'),
				self::PAGE_NAME
			);  

			$post_types_for_filtering = array();
			$taxonomies_for_filtering = array(	'off' => __('Nothing, turn filtering off.', 'jig_td'),
												'on' => __('Automatic (on): Choose a taxonomy automatically, this should work in most cases.', 'jig_td'));

			global $wp_post_types;
			if(isset($wp_post_types)){
				foreach ($wp_post_types as $post_type_name => $post_type_value) {
					if($post_type_name !== 'revision' && $post_type_name !== 'nav_menu_item' ){
						$post_types_for_filtering[$post_type_name] = $post_type_value->labels->name;
					}
				}
				unset($post_type_name);
			}else{
					$post_types_for_filtering = array(array('post','Posts'),array('page','Pages'));
			}
			foreach ($post_types_for_filtering as $post_type_name => $post_type_label) {
				$post_type_taxonomies = get_object_taxonomies($post_type_name, 'objects');
				if(!empty($post_type_taxonomies)){
					foreach ($post_type_taxonomies as $post_type_taxonomy_name => $post_type_taxonomy_value) {
						if(!isset($taxonomies_for_filtering[$post_type_taxonomy_name])){
							$taxonomies_for_filtering[$post_type_taxonomy_name] = $post_type_taxonomy_value->label.' ('.$post_type_taxonomy_name.') '.__('of', 'jig_td').' '.$post_type_label.' ('.$post_type_name.')';	
						}
					}
				}
			}
			// Filter by
			add_settings_field(
				'jig_filterby',
				__('Filter by', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_filtering_section',
					array(	'id' => 'filterby',
							'help' => __('Choose a taxonomy to filter the thumbnails by. The automatic option will select the Tag taxonomy for the following image sources: WordPress images and posts, NextGEN photos, Flickr and Instagram content. You only need the other options when you wish to filter WordPress content (likely Recent Posts with a custom Post type) by something else.<br/><br/>Categories and Tags of posts can be extended to WP images using General settings -> Additional tools or utilities -> WP image tags and categories<br/><br/>The other options are very useful if you have products to show off with something like WooCommerce, or you manage WP images using Media Library Assistant, as all the custom taxonomies are picked up and are ready to be used for filtering.', 'jig_td'),
							'inputs' => $taxonomies_for_filtering)
			);

			// Filter style
			add_settings_field(
				'jig_filter_style',
				__('Filter style', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_filtering_section',
					array(	'id' => 'filter_style',
							'help' => __('Choose how the filtering interface should look like.', 'jig_td'),
							'inputs' => array(
								'buttons' => __("Buttons: use equal-size simple buttons.", 'jig_td'),
								'tags' => __("Tag cloud: use dynamic size tags.", 'jig_td')
							)
					)
			);

			// Order filter terms by
			add_settings_field(
				'jig_filter_orderby',
				__('Order filter terms by', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_filtering_section',
					array(	'id' => 'filter_orderby',
							'help' => __('Set an order for the filter buttons or tags. This does not change the order of images.', 'jig_td'),
							'inputs' => array(
								'appearance' => __("In order of appearance in images", 'jig_td'),
								'title_asc' => __("Title ascending (A-Z)", 'jig_td'),
								'title_desc' => __("Title descending (Z-A)", 'jig_td'),
								'random' => __("Random", 'jig_td'),
								'popularity' => __("Popularity among images (top terms first)", 'jig_td'),
								'custom' => __("Custom (use the next setting)", 'jig_td')
							)
					)
			);

			// Filter terms custom order
			add_settings_field(
				'jig_filter_custom_order',
				__('Filter terms custom order', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_custom_order',
						'label' => __('Manually enter filter buttons or tags by name, comma separated, Case Sensitive! Only those that you specify will be used and in the exact order. This is a manual setting and requires you to know the term names, furthermore filter_orderby needs to be on custom. This setting is more useful in the shortcode editor, for each gallery.', 'jig_td')
					)
			);

			// Min count for term
			add_settings_field(
				'jig_filter_min_count',
				__('Min count for term', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_min_count',
						'label' => __('Only show those filter buttons or tags that have at least this number of images.', 'jig_td')
					)
			);

			// Top x terms
			add_settings_field(
				'jig_filter_top_x',
				__('Top x terms', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_top_x',
						'label' => __('Limit the number of filter buttons or tags to the top x (any number) that occur in the most images.', 'jig_td')
					)
			);

			// Use All button
			add_settings_field(
				'jig_filter_all_button',
				__('Use All button', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_filtering_section',
					array(	'id' => 'filter_all_button',
							'help' => __('Whether or not to use the All button. When not used, the first filter button or tag will be active instead of an All button.', 'jig_td'),
							'inputs' => array(
								'yes' => __("Yes", 'jig_td'),
								'no' => __("No", 'jig_td')
							)
					)
			);

			// Filter: "All" button/tag text
			add_settings_field(
				'jig_filter_all_text',
				__('Filter: "All" button/tag text', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_all_text',
						'label' => __('Change what appears on the "All" button/tag, e.g. "All posts" etc.', 'jig_td')
					)
			);

			// Allow multiple filters
			add_settings_field(
				'jig_filter_multiple',
				__('Allow multiple filters', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_filtering_section',
					array(	'id' => 'filter_multiple',
							'help' => __('Normally, the visitors can only select one term at a time. If this is set to OR, then all images matching any of the selected terms will be displayed. In case of AND, only images that match all selected terms will be shown.', 'jig_td'),
							'inputs' => array(
								'no' => __("No, just one filter term at a time", 'jig_td'),
								'or' => __("OR (expanding selection, union) - match images by either of the selected filter terms", 'jig_td'),
								'and' => __("AND (narrowing selection, intersect) - match images by all of the selected filter terms", 'jig_td')
							)
					)
			);

			// Filter button CSS
			add_settings_field(
				'jig_filter_button_css',
				__('Filter button CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_button_css',
						'label' => __('CSS settings for the base state of Filter buttons', 'jig_td'),
						'rows' => 9)
			);
			// Filter button hover and selected CSS
			add_settings_field(
				'jig_filter_button_hover_css',
				__('Filter button hover and selected CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_button_hover_css',
						'label' => __('CSS settings for the hover and selected state of Filter buttons.', 'jig_td'),
						'rows' => 2)
			);

			// Smallest tag's color
			add_settings_field(
				'jig_filter_smallest_color',
				__("Smallest tag's color", 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_smallest_color',
						'label' => __('HEX color value, something light is preferred. You can use the color picker in the top right corner. This will be used for the tag with the least associated items.', 'jig_td')
					)
			);
			// Smallest tag's font-size
			add_settings_field(
				'jig_filter_smallest_size',
				__("Smallest tag's font-size", 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_smallest_size',
						'label' => __('A number in px, something small is preferred. This will be used for the tag with the least associated items.', 'jig_td')
					)
			);
			// Largest tag's color
			add_settings_field(
				'jig_filter_largest_color',
				__("Largest tag's color", 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_largest_color',
						'label' => __('HEX color value, something dark is recommended. You can use the color picker in the top right corner. This will be used for the tag with the most associated items.', 'jig_td')
					)
			);
			// Largest tag's font-size
			add_settings_field(
				'jig_filter_largest_size',
				__("Largest tag's font-size", 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_largest_size',
						'label' => __('A number in px, something large is recommended. This will be used for the tag with the most associated items.', 'jig_td').'</a> <span>')
			);

			// Filter tag CSS
			add_settings_field(
				'jig_filter_tag_css',
				__('Filter tag CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_tag_css',
						'label' => __('CSS settings for the Filter tags.', 'jig_td'),
					'rows' => 3)
			);
			// Filter tag hover and selected CSS
			add_settings_field(
				'jig_filter_tag_hover_css',
				__('Filter tag hover and selected CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_filtering_section',
				array(	'id' => 'filter_tag_hover_css',
						'label' => __('CSS settings for the hover and selected state of Filter tags.', 'jig_td'),
					'rows' => 4)
			);

			// --------------------------------
			//             Lightboxes
			// --------------------------------
			add_settings_section(
				'jig_lightboxes_section',
				__('Lightboxes', 'jig_td'),
				array($this, 'jig_print_lightboxes_desc'),
				self::PAGE_NAME
			);  
			// Lightbox type
			add_settings_field(
				'jig_lightbox',
				__('Lightbox type', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'lightbox',
						'help' => __("Decide what happens when an image is clicked, like which lightbox to use. Refer to the documentation of paid plugins about compatibility settings, if any. Custom links will automatically skip the lightbox and can be set up in the image editor of WordPress. To use custom links with NextGEN you'll need the NGG Custom Fields plugin.", 'jig_td'),
						'inputs' => array(
							'prettyphoto' => 'prettyPhoto',
							'colorbox' => 'ColorBox',					
							'photoswipe' => 'PhotoSwipe',
							'foobox' => !(class_exists('fooboxV2') || class_exists('foobox')) ? __('FooBox (not active!) is purchased separately', 'jig_td').', <a href="http://justifiedgrid.com/foobox/" target="_blank">'.__('here', 'jig_td').'</a>.' : 'FooBox',
							'socialgallery' => $this->social_gallery_plugin_data[0] === false ?
								__('Social Gallery (not active!) is purchased separately', 'jig_td').', <a href="http://codecanyon.net/item/social-gallery-wordpress-photo-viewer-plugin/2665332?ref=Firsh" target="_blank">'.__("here", 'jig_td').'</a>.'
								: 'Social Gallery',
							'carousel' => (class_exists('Jetpack') && method_exists('Jetpack', 'get_active_modules') && in_array('carousel', Jetpack::get_active_modules()) && class_exists('Jetpack_Carousel')) === false ?
								__("Jetpack's Carousel for WP images ONLY (not active!) is installed separately, requires Jetpack", 'jig_td').', <a href="http://jetpack.me/support/carousel/" target="_blank">'.__("learn more", 'jig_td').'</a>.'
								: "Jetpack's Carousel ".__('for WP images ONLY.', 'jig_td'),
							'custom' => __("I already use a lightbox plugin so I'll set up the link class and/or rel accordingly.", 'jig_td'),
							'no' => __('No lightbox: The image will be opened by the browser. Disables link class and rel.', 'jig_td'),
							'new_tab' => __('New tab: Open by the browser on a new tab.', 'jig_td'),
							'attachment' => __('Attachment: Point images to the WP image attachment page.', 'jig_td'),
							'links-off' => __('Turn the links off, only show thumbnails. Disable pointer cursor and clickability.', 'jig_td')
						)
				)
			);
			// Mobile lightbox
			add_settings_field(
				'jig_mobile_lightbox',
				__('Mobile lightbox', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'mobile_lightbox',
						'help' => __('Choose to force a certain lightbox on mobile devices.', 'jig_td'),
						'inputs' => array(
							'photoswipe' => 'PhotoSwipe',
							'foobox' => !(class_exists('fooboxV2') || class_exists('foobox')) ? __('FooBox (not active!) is purchased separately', 'jig_td').', <a href="http://justifiedgrid.com/foobox/" target="_blank">'.__('here', 'jig_td').'</a>.' : 'FooBox',
							'no' => __('Same as desktop.', 'jig_td')
						)
				)
			); 
			
			// Link class
			add_settings_field(
				'jig_link_class',
				__('Link class(es)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'link_class',
						'label' => __("Class of the image's anchor tag.", 'jig_td'))
			);
			// Link rel
			add_settings_field(
				'jig_link_rel',
				__('Link rel', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'link_rel',
						'label' => __('This setting groups images together like gallery[modal]. Which usually means prev/next arrows. Make the field empty to ungroup or enter auto to group (also for proper prettyPhoto deeplinking).', 'jig_td'))
			);
			// Maximum size for lightbox (the image will link to this size)
			add_settings_field(
				'jig_lightbox_max_size',
				__('Maximum size for lightbox (the image will link to this size)', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'lightbox_max_size',
							'help' => __('Maximum size of the WP image that loads in the lightbox.', 'jig_td'),
							'inputs' => array(
								'large' => __('Large: This should be best for most cases.', 'jig_td'),
								'full' => __('Full: It can be too much as it will load the original size in the lightbox.', 'jig_td'),
								'medium' => __('Medium: If you wish to limit the lightbox to a relatively small size.', 'jig_td')
							)
					)
			);

			// WP field for link title (anchor tag's title attribute)
			add_settings_field(
				'jig_link_title_field',
				__("WP field for link title (anchor tag's title attribute)", 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'link_title_field',
							'help' => __('Choose a WP field as link title from the image details.', 'jig_td'),
							'inputs' => array(
								'description' => __('Description', 'jig_td'),
								'title' => __('Title', 'jig_td'),
								'caption' => __('Caption', 'jig_td'),
								'alternate' => __('Alternate Text', 'jig_td'),
								'off' => __('Off: Do not use', 'jig_td')
							)
					)		 
			);
			// WP field for img alt (image tag's alt attribute)
			add_settings_field(
				'jig_img_alt_field',
				__("WP field for img alt (image tag's alt attribute)", 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'img_alt_field',
							'help' => __('Choose a WP field as img alt from the image details.', 'jig_td'),
							'inputs' => array(
								'title' => __('Title', 'jig_td'),
								'description' => __('Description', 'jig_td'),
								'caption' => __('Caption', 'jig_td'),
								'alternate' => __('Alternate Text', 'jig_td'),
								'off' => __('Off: Do not use', 'jig_td')

							)
					)
			);

			// Download link for the image
			add_settings_field(
				'jig_download_link',
				__('Download link for the image', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'download_link',
							'help' => (in_array('curl', get_loaded_extensions()) ? __('A link that displays a browser dialog to download the photo.', 'jig_td') : '<span style="color:red">'.__("The necessary CURL library is missing, this won't work.", 'jig_td').'</span>'),
							'inputs' => array(
								'no' => __('No', 'jig_td'),
								'yes' => __('Yes: link title (the default position).', 'jig_td'),
								'alt' => __('Add to img alt.', 'jig_td')
							)
					)
			);
			// Text for the download link
			add_settings_field(
				'jig_download_link_text',
				__('Text for the download link', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'download_link_text',
						'label' => __('What text to display as the image download link.', 'jig_td'),
					'rows' => 1)
			);


			// prettyPhoto social tools
			add_settings_field(
				'jig_prettyphoto_social',
				__('prettyPhoto social tools', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'prettyphoto_social',
							'help' => __('Toggle Like, Tweet, Pin and +1 buttons in prettyPhoto.', 'jig_td'),
							'inputs' => array(
								'yes' => __('Yes: display the social sharing buttons.', 'jig_td'),
								'no' => __('No', 'jig_td')
							)
					)
			);
			// prettyPhoto deeplinking
			add_settings_field(
				'jig_prettyphoto_deeplinking',
				__('prettyPhoto deeplinking', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'prettyphoto_deeplinking',
							'help' => __("The advanced option uses several server-side logics to make individual Facebook like possible. The regular deeplinking doesn't work efficitently.", 'jig_td'),
							'inputs' => array(
								'advanced_deeplinking' => __('Advanced deeplinking: Allows individual like with thumbnail on FB, works with random image order, uses #! hashbang.', 'jig_td'),
								'deeplinking' => __('Deeplinking: Regular prettyPhoto deeplinking, the only benefit is short URLs.', 'jig_td'),
								'no' => __("No: Don't add #prettyPhoto to the URL of lightbox images.", 'jig_td')
							)
					)
			);
			// prettyPhoto theme
			add_settings_field(
				'jig_prettyphoto_theme',
				__('prettyPhoto theme', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'prettyphoto_theme',
							'help' => __('Choose one of the six built-in themes of prettyPhoto.', 'jig_td'),
							'inputs' => array(
								'pp_default' => __('Default theme', 'jig_td'),
								'light_rounded' => __('Light rounded', 'jig_td'),
								'dark_rounded' => __('Dark rounded', 'jig_td'),
								'light_square' => __('Light square', 'jig_td'),
								'dark_square' => __('Dark square', 'jig_td'),
								'facebook' => __('Facebook style', 'jig_td')
							)
					)
			);

			// prettyPhoto Google Analytics
			add_settings_field(
				'jig_prettyphoto_analytics',
				__('prettyPhoto Google Analytics', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'prettyphoto_analytics',
							'help' => __('You can track images viewed in the lightbox as events.', 'jig_td'),
							'inputs' => array(
								'no' => __('No', 'jig_td'),
								'yes' => __('Yes, track photo views as events.', 'jig_td')
							)
					)
			);

			// prettyPhoto JS settings
			add_settings_field(
				'jig_prettyphoto_settings',
				__('prettyPhoto JS settings', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'prettyphoto_settings',
						'label' => sprintf(__('Extra JavaScript settings for %s. Watch out for commas: every row ends with a comma except the last one!', 'jig_td'),'<a href=\"http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/documentation/\" target=\"_blank\">prettyPhoto</a>'),
						'rows' => 9)
			);

			// PhotoSwipe settings
			add_settings_field(
				'jig_photoswipe_settings',
				__('PhotoSwipe JS settings', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'photoswipe_settings',
						'label' => sprintf(__('Extra JavaScript settings for %s.', 'jig_td'), '<a href="http://www.photoswipe.com/" target="_blank">PhotoSwipe</a>'),
					'rows' => 9)
			);
			// ColorBox JS settings
			add_settings_field(
				'jig_colorbox_settings',
				__('ColorBox JS settings', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'colorbox_settings',
						'label' => sprintf(__('Extra JavaScript settings for %s.', 'jig_td'), '<a href="http://www.jacklmoore.com/colorbox" target="_blank">ColorBox</a>'),
					'rows' => 5)
			);
			// ColorBox design
			add_settings_field(
				'jig_colorbox_design',
				__('ColorBox design', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_lightboxes_section',
				array(	'id' => 'colorbox_design',
						'help' => __('Choose one of the five built-in themes of ColorBox.', 'jig_td'),
						'inputs' => array(
							'1' => '1: '.__('Default (striped background).', 'jig_td'),
							'2' => '2: '.__('White background, thin black border.', 'jig_td'),
							'3' => '3: '.__('Dark backround, dark frame, arrows in photo.', 'jig_td'),
							'4' => '4: '.__('Bright, round corners, shadow.', 'jig_td'),
							'5' => '5: '.__('Multiple frames from dark to light.', 'jig_td')
						)
				)
			);

			// jQuery mobile  - link rel external
			add_settings_field(
				'jig_jquery_mobile',
				__('jQuery mobile - link rel external', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_lightboxes_section',
					array(	'id' => 'jquery_mobile',
							'help' => __('Check this if you are using jQuery mobile (very mobile oriented themes), as this sets lightbox links to rel="external", when link rel is "auto", and the visitor is really on a mobile device.', 'jig_td'),
							'inputs' => array(
								'no' => __("No: don't use this.", 'jig_td'),
								'yes' => __('Yes: add rel external.', 'jig_td')
							)
					)
			);
			
			// --------------------------------
			//             Captions
			// --------------------------------
			add_settings_section(
				'jig_captions_section',
				__('Captions', 'jig_td'),
				array($this, 'jig_print_captions_desc'),
				self::PAGE_NAME
			);  
			// Caption style
			add_settings_field(
				'jig_caption',
				__('Caption style', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'caption',
							'help' => __('Choose how would you like the caption to appear.', 'jig_td'),
							'inputs' => array(
								'fade' => __('Fade in/out.', 'jig_td'),
								'slide' => __('Slide up/down.', 'jig_td'),
								'mixed' => __('Mixed: Title is always visible but the description slides in on hover.', 'jig_td'),
								'fixed' => __('Fixed: The whole caption is always visible.', 'jig_td'),
								'reverse-fade' => __('Reverse Fade (out/in).', 'jig_td'),
								'reverse-slide' => __('Reverse Slide (down/up).', 'jig_td'),
								'reverse-mixed' => __('Reverse Mixed: Title and description are always visible but the description slides out on hover.', 'jig_td'),
								'below' => __('Below the image (outside the thumbnail).', 'jig_td'),
								'off' => __('Off', 'jig_td')
							)
					)
			);
			// Mobile caption
			add_settings_field(
				'jig_mobile_caption',
				__('Mobile caption', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'mobile_caption',
							'help' => __('Caption behavior for mobile devices.', 'jig_td'),
							'inputs' => array(
								'same' => __('Same as desktop.', 'jig_td'),
								'fixed' => __('Fixed: The whole caption is always visible.', 'jig_td'),
								'below' => __('Below the image (outside the thumbnail).', 'jig_td'),
								'off' => __('Off', 'jig_td')
							)
					)
			);  

			// Caption opacity
			add_settings_field(
				'jig_caption_opacity',
				__('Caption opacity', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_captions_section',
				array(	'id' => 'caption_opacity',
						'label' => __('Opacity for the entire caption, enter a number between 0 and 1.', 'jig_td'))
			);
			// Caption background color
			add_settings_field(
				'jig_caption_bg_color',
				__('Caption background color', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_captions_section',
				array(	'id' => 'caption_bg_color',
						'label' => __('Enter any CSS color, or the word transparent. You can use the color picker in the top right corner. For opacity use rgba(0,0,0,0.3) but only when the Caption opacity is set to 1.', 'jig_td'))
			);		
			// Caption title's background matches text width
			add_settings_field(
				'jig_caption_match_width',
				__("Title background matches text width", 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'caption_match_width',
							'help' => __('The caption background extends over the full width of the thumbnail. With this setting you can have the caption title background only behind the text. This is not available for caption description.', 'jig_td'),
							'inputs' => array(
								'no' => __('No, display the caption background at full width.', 'jig_td'),
								'yes' => __('Yes, only show the background as far as the text goes.', 'jig_td'),
								'yes-rounded' => __('Yes, and also add some rounded corners (dossier style).', 'jig_td')
							)
					)
			); 
			// Caption text color
			add_settings_field(
				'jig_caption_text_color',
				__('Caption text color', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_captions_section',
				array(	'id' => 'caption_text_color',
						'label' => __('Any CSS color (HEX, name of the color) except rgba.', 'jig_td'))
			);
			// Caption height for "Below the image"
			add_settings_field(
				'jig_caption_height',
				__('Caption height for "Below the image"', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_captions_section',
				array(	'id' => 'caption_height',
						'label' => __('Set a uniform caption height that will only be used when caption is set to "Below the image". This helps making it look cool. Any excess text will be trimmed by ... characters or removed. Accepts a number without px.', 'jig_td'))
			);
			// Horizontal caption text-align
			add_settings_field(
				'jig_caption_align',
				__('Horizontal caption text-align', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'caption_align',
							'help' => __('Align both captions horizontally.', 'jig_td'),
							'inputs' => array(
								'css' => __('CSS: Respect the text-align settings below (Caption title CSS + Caption description CSS).', 'jig_td'),
								'left' => __('Left', 'jig_td'),
								'center' => __('Center', 'jig_td'),
								'right' => __('Right', 'jig_td')
							)
						)
			);
			
			// Vertically center captions
			add_settings_field(
				'jig_v_center_captions',
				__('Vertically center captions', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'v_center_captions',
							'help' => __('Makes captions appear in the middle of the image, compatible with all Caption styles. Try the different options to see which suits your needs.', 'jig_td'),
							'inputs' => array(
								'off' => __('Off: Display them at the bottom.', 'jig_td'),
								'yes' => __('Yes: (center both axes, animate from center, overrides text-align CSS).', 'jig_td'),
								'simple' => __("Simple: Same as 'Yes', but doesn't animate from center (slide and mixed styles).", 'jig_td'),
								'vertical_only' => __('Vertical only: (no horizontal centering, keeps text-align CSS, animate from center).', 'jig_td')
							)
						)
			);
			// Vertically center: I use custom fonts
			add_settings_field(
				'jig_custom_fonts',
				__('Vertically center: I use custom fonts', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'custom_fonts',
							'help' => __('If the vertical centering is not perfect, you are using custom fonts. So keep this option turned on! Otherwise you can disable this.', 'jig_td'),
							'inputs' => array(
								'yes' => __('Yes, I use custom fonts, apply a fix.', 'jig_td'),
								'no' => __("No, I don't use custom fonts.", 'jig_td')
							)
						)
			);
			// WP field to use for title (main caption)
			add_settings_field(
				'jig_title_field',
				__('WP field to use for title', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'title_field',
							'help' => __('Choose a WP field as title from the image details.', 'jig_td'),
							'inputs' => array(
								'title' => __('Title', 'jig_td'),
								'description' => __('Description', 'jig_td'),
								'caption' => __('Caption', 'jig_td'),
								'alternate' => __('Alternate Text', 'jig_td'),
								'off' => __('Off: Do not display.', 'jig_td')
						
							)
						)
			);
			// Field for caption
			add_settings_field(
				'jig_caption_field',
				__('WP field to use for caption (description)', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'caption_field',
							'help' => __('Choose a WP field as caption description from the image details.', 'jig_td'),
							'inputs' => array(
								'title' => __('Title', 'jig_td'),
								'description' => __('Description', 'jig_td'),
								'caption' => __('Caption', 'jig_td'),
								'alternate' => __('Alternate Text', 'jig_td'),
								'off' => __('Off: Do not display.', 'jig_td')
							)
					)
			);
			// Caption title CSS
			add_settings_field(
				'jig_caption_title_css',
				__('Caption title CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_captions_section',
				array(	'id' => 'caption_title_css',
						'label' => __('Extra CSS settings for the caption title.', 'jig_td'),
					'rows' => 3)
			);
			// Caption description CSS
			add_settings_field(
				'jig_caption_desc_css',
				__('Caption description CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_captions_section',
				array(	'id' => 'caption_desc_css',
						'label' => __('Extra CSS settings for the caption description.', 'jig_td'),
					'rows' => 3)
			);
			// Text shadow
			add_settings_field(
				'jig_caption_text_shadow',
				__('Text shadow', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_captions_section',
				array(	'id' => 'caption_text_shadow',
						'label' => __("Set shadow on the text of the caption. The CSS is like 1px 1px 0 black (x, y, blur, color - respectively). It's only applied when Caption opacity is set to 1. Doesn't work under IE10 so don't depend on it.", 'jig_td'))
			);
			// Gradient caption background
			add_settings_field(
				'jig_gradient_caption_bg',
				__('Gradient caption background', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_captions_section',
					array(	'id' => 'gradient_caption_bg',
							'help' => __('Use a Facebook-style gradient for the caption background. This sets caption opacity to 1, and is not compatible with "Title background matches text width" setting. The color will be determined by the CSS below and not the simple "Caption background color" above.', 'jig_td'),
							'inputs' => array(
								'no' => __('No, use the simple color options above.', 'jig_td'),
								'yes' => __('Yes, use the CSS gradient.', 'jig_td')
							)
					)
			);
			// CSS Gradient for caption background
			add_settings_field(
				'jig_gradient_caption_bg_css',
				__('CSS Gradient for caption background', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_captions_section',
				array(	'id' => 'gradient_caption_bg_css',
						'label' => sprintf(__('CSS settings for the gradient caption background. Fades to black by default.<br/>You can use %s to generate gradients.', 'jig_td'),'<a href="http://www.colorzilla.com/gradient-editor/" target="_blank">Gradient editor</a>'),
					'rows' => 8)
			);


			// --------------------------------
			//          Overlay effects
			// --------------------------------
			add_settings_section(
				'jig_overlay_section',
				__('Overlay effects', 'jig_td'),
				array($this, 'jig_print_overlay_desc'),
				self::PAGE_NAME
			);  
			// Overlay type
			add_settings_field(
				'jig_overlay',
				__('Overlay type', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_overlay_section',
					array(	'id' => 'overlay',
							'help' => __('Choose a behavior for the overlay.', 'jig_td'),
							'inputs' => array(
								'others' => __('Other images have colored overlay, hovered returns to normal.', 'jig_td'),
								'hovered' => __('Hovered image has color overlay, others do not.', 'jig_td'),
								'everything' => __('Everything has color overlay.', 'jig_td'),
								'off' => __('No overlay.', 'jig_td')
							)
					)
			);
			// Mobile overlay type
			add_settings_field(
				'jig_mobile_overlay',
				__('Mobile overlay type', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_overlay_section',
					array(	'id' => 'mobile_overlay',
							'help' => __('Overlay behavior for mobile devices.', 'jig_td'),
							'inputs' => array(
								'same' => __('Same as desktop.', 'jig_td'),
								'everything' => __('Everything has color overlay.', 'jig_td'),
								'off' => __('Off: No overlay.', 'jig_td')
							)
					)
			);

			
			// Overlay opacity
			add_settings_field(
				'jig_overlay_opacity',
				__('Overlay opacity', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'overlay_opacity',
						'label' => __('A number between 0 and 1.', 'jig_td'))
			);
			// Overlay color
			add_settings_field(
				'jig_overlay_color',
				__('Overlay color', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'overlay_color',
						'label' => __('Any CSS color (HEX, name of the color) except rgba.', 'jig_td'))
			);

			// Overlay icon in the middle
			add_settings_field(
				'jig_overlay_icon',
				__('Overlay icon', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_overlay_section',
					array(	'id' => 'overlay_icon',
							'help' => __('Enable to display an icon in the middle of the thumbnails.', 'jig_td'),
							'inputs' => array(
								'off' => __("Off: Don't display the icon in the overlay.", 'jig_td'),
								'on' => __('On: Display the icon.', 'jig_td')
							)
					)
			);
			// Overlay icon opacity
			add_settings_field(
				'jig_overlay_icon_opacity',
				__('Overlay icon opacity', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'overlay_icon_opacity',
						'label' => __('A number between 0 and 1.', 'jig_td'))
			);
			// Overlay icon URL
			add_settings_field(
				'jig_overlay_icon_url',
				__('Overlay icon URL', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'overlay_icon_url',
						'label' => __('Path to your icon or leave empty for the default magnifier icon.', 'jig_td'))
			);
			// Overlay icon retina URL
			add_settings_field(
				'jig_overlay_icon_retina',
				__('Overlay icon retina URL', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'overlay_icon_retina',
						'label' => __('2x size image of your Overlay icon. Default is the 2x version of the magnifier, or if set, the 1x version of your Overlay icon.', 'jig_td'))
			);

			// Outer shadow
			add_settings_field(
				'jig_outer_shadow',
				__('Outer shadow', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'outer_shadow',
						'label' => __('CSS3 shadow value (no quotes): 0 0 3px black', 'jig_td'))
			);
			// Inner shadow
			add_settings_field(
				'jig_inner_shadow',
				__('Inner shadow', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'inner_shadow',
						'label' => __('CSS3 shadow value (no quotes): 0 0 3px black', 'jig_td'))
			);

			// Outer (standard) border width
			add_settings_field(
				'jig_outer_border_width',
				__('Outer (standard) border width', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'outer_border_width',
						'label' => __('A number in pixels, without "px" - 0 to turn off.', 'jig_td'))
			);
			// Outer (standard) border color
			add_settings_field(
				'jig_outer_border_color',
				__('Outer (standard) border color', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'outer_border_color',
						'label' => __('Any CSS color value.', 'jig_td'))
			);

			// Middle (spacing) border width
			add_settings_field(
				'jig_middle_border_width',
				__('Middle (spacing) border width', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'middle_border_width',
						'label' => __('A number in pixels, without "px" - 0 to turn off.', 'jig_td'))
			);
			// Middle (spacing) border color
			add_settings_field(
				'jig_middle_border_color',
				__('Middle (spacing) border color', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'middle_border_color',
						'label' => __('Any CSS color value, this is usually white.', 'jig_td'))
			);

			// Inner (on-image) border width
			add_settings_field(
				'jig_inner_border_width',
				__('Inner (on-image) border width', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'inner_border_width',
						'label' => __('A number in pixels, without "px" - 0 to turn off.', 'jig_td'))
			);
			// Inner (on-image) border color
			add_settings_field(
				'jig_inner_border_color',
				__('Inner (on-image) border color', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_overlay_section',
				array(	'id' => 'inner_border_color',
						'label' => __('Any CSS color, especially recommended rgba(0,0,0,0.1) this is Facebook-style.', 'jig_td'))
			);
			// Inner (on-image) border behavior
			add_settings_field(
				'jig_inner_border',
				__('Inner border behavior', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_overlay_section',
					array(	'id' => 'inner_border',
							'help' => __('Control the inner border with the mouse or let it be static.', 'jig_td'),
							'inputs' => array(
								'always' => __('Always: The border is visible regardless of the mouse (the width must be larger than 0).', 'jig_td'),
								'others' => __('Others: The hovered image loses the inner border.', 'jig_td'),
								'hovered' => __('Hovered: Only the hovered image gains the inner border.', 'jig_td')
							)
					)
			);
			// Inner (on-image) border animation
			add_settings_field(
				'jig_inner_border_animate',
				__('Inner border animation', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_overlay_section',
					array(	'id' => 'inner_border_animate',
							'help' => __("The mouse controlled inner border's animation style.", 'jig_td'),
							'inputs' => array(
								'width' => __('Width animation only.', 'jig_td'),
								'opacity' => __('Opacity animation only.', 'jig_td'),
								'off' => __('Off: Shows/hides the inner border instantly.', 'jig_td')
							)
					)
			);
			

			// --------------------------------
			//        Special effects
			// --------------------------------
			add_settings_section(
				'jig_specialfx_section',
				__('Special effects', 'jig_td'),
				array($this, 'jig_print_specialfx_desc'),
				self::PAGE_NAME
			);  
			// Special effects behavior
			add_settings_field(
				'jig_specialfx',
				__('Special effects behavior', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_specialfx_section',
					array(	'id' => 'specialfx',
							'help' => __('Choose a behavior for the special effects like desaturation.', 'jig_td'),
							'inputs' => array(
								'off' => __('Turn special effects off.', 'jig_td'),
								'others' => __('Other images are processed, hovered returns to normal.', 'jig_td'),
								'hovered' => __('Hovered image gets processed, the others remain normal looking.', 'jig_td'),
								'everything' => __('Everything is processed, even on hover.', 'jig_td')
							)
					)
			);
			// Mobile special effects
			add_settings_field(
				'jig_mobile_specialfx',
				__('Mobile special effects', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_specialfx_section',
					array(	'id' => 'mobile_specialfx',
							'help' => __('Alternative behavior for special effects on mobile devices.<br/>Turn off if you have lots of images as it may decrease performance.', 'jig_td'),
							'inputs' => array(
								'same' => __('Same as desktop.', 'jig_td'),
								'off' => __('Turn special effects off.', 'jig_td'),
								'everything' => __('Everything is processed.', 'jig_td')
							)
					)
			);
			// Special effects type
			add_settings_field(
				'jig_specialfx_type',
				__('Special effects type', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_specialfx_section',
					array(	'id' => 'specialfx_type',
							'help' => __('Choose a special effect to apply.', 'jig_td'),
							'inputs' => array(
								'desaturate' => __('Desaturate', 'jig_td'),
								'blur' => __('Blur', 'jig_td'),
								'glow' => __('Glow', 'jig_td'),
								'sepia' => __('Sepia', 'jig_td'),
								'laplace_dark' => __('Laplace (edge detection), dark background.', 'jig_td'),
								'laplace_light' => __('Laplace, light background.', 'jig_td')
							)
					)
			);
			// Special effects blend
			add_settings_field(
				'jig_specialfx_blend',
				__('Special effects blend (opacity)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				 'jig_specialfx_section',
 				array(	'id' => 'specialfx_blend',
						'label' => __('Enter a value between 0.1 and 1 to control how much you see the special effect over the original image. For example, enter 0.5 when using "Blur" to have the Orton effect.', 'jig_td'))
			);
			// Special effects setting
			add_settings_field(
				'jig_specialfx_options',
				__('Special effects setting (override)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				 'jig_specialfx_section',
 				array(	'id' => 'specialfx_options',
						'label' => sprintf(__('Advanced setting, only use this if you are not happy with the default setting of a certain special effect. Refer to %1$s for the effects. Example (the default for "glow": amount:0.3,radius:0.2', 'jig_td'),'<a href="http://www.pixastic.com/lib/docs/" target="_blank">Pixastic documentation</a>'))
			);
			

			// --------------------------------
			//        NextGEN
			// --------------------------------
			add_settings_section(
				'jig_nextgen_section',
				__('NextGEN', 'jig_td'),
				array($this, 'jig_print_nextgen_desc'),
				self::PAGE_NAME
			);  
			// Take over and act in place of NextGEN shortcodes
			add_settings_field(
				'jig_take_over_nextgen',
				__('Take over and act in place of NextGEN shortcodes', 'jig_td'),
				array($this, 'jig_print_checkbox_input'),
				self::PAGE_NAME,
				'jig_nextgen_section',
				array(	'id' => 'take_over_nextgen',
						'help' => __('Use Justified Image Grid in place of your previously created NextGEN galleries, by selecting which ones you wish to take over. Not checking anything will leave the NextGEN shortcodes alone.', 'jig_td'),
						'inputs' => array(
							'ngg_images' => __('[ngg_images] - NG2 multipurpose shortcode.', 'jig_td'),
							'nggallery' => __('[nggallery] - Galleries.', 'jig_td'),
							'nggalbum' => __('[nggalbum] - Albums.', 'jig_td'),
							'album' => __('[album] - The other shortcode for albums.', 'jig_td'),
							'nggtags' => __('[nggtags] - Tag albums and tag galleries.', 'jig_td'),
							'random' => __('[random] - Random images.', 'jig_td'),
							'recent' => __('[recent] - Recent images.', 'jig_td'),
							'singlepic' => __('[singlepic] - Single pictures.', 'jig_td')
						)
					)
			);
			// Take over and act in place of NextGEN shortcodes
			add_settings_field(
				'take_over_ng_post_inserts',
				__('Take over NextGEN 2 post inserts', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_nextgen_section',
					array(	'id' => 'take_over_ng_post_inserts',
							'help' => __("Take over the inserted galleries that appear as images in the editor. They are used by NextGEN 2 instead of shortcodes. It's compatible with limit, but uses the global default sorting method and does not use exclusions.", 'jig_td'),
							'inputs' => array(
								'no' => __('No change, let them be.', 'jig_td'),
								'yes' => __('Yes, take over.', 'jig_td')
							)
					)
			);
			// Display album and photo count
			add_settings_field(
				'jig_ng_count',
				__('Display album and photo count', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_nextgen_section',
					array(	'id' => 'ng_count',
							'help' => __("Make the thumbnail's caption display the count of photos in a gallery. Also, the count of subalbums/galleries in albums.", 'jig_td'),
							'inputs' => array(
								'yes' => __('Yes: display the counters.', 'jig_td'),
								'no' => __('No: do not display the counters.', 'jig_td')
							)
					)
			);
			// Open galleries in lightbox
			add_settings_field(
				'jig_ng_lightbox_gallery',
				__('Open galleries in lightbox', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_nextgen_section',
					array(	'id' => 'ng_lightbox_gallery',
							'help' => __('In album views, open the galleries in the lightbox on the same page. Note: currently not compatible with Social Gallery lightbox.', 'jig_td'),
							'inputs' => array(
								'no' => __('No: open them on their own page.', 'jig_td'),
								'yes' => __('Yes: Open them in the lightbox.', 'jig_td')
							)
					)
			);
			// Show album/gallery description
			add_settings_field(
				'jig_ng_description',
				__('Show album/gallery description', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_nextgen_section',
					array(	'id' => 'ng_description',
							'help' => __('Choose yes if you wish to display gallery or album description (if any) between the breadcrumb and the grid.', 'jig_td'),
							'inputs' => array(
								'no' => __("No: Don't display the descriptions.", 'jig_td'),
								'yes' => __('Yes: Display the description between the breadcrumb and the grid.', 'jig_td')
							)
					)
			);
			// Intersect tags
			add_settings_field(
				'jig_ng_intersect_tags',
				__('Intersect tags', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_nextgen_section',
					array(	'id' => 'ng_intersect_tags',
							'help' => __('Choose yes if you wish to display tags combined, based on AND and not ANY. Only applies for NG tag galleries.', 'jig_td'),
							'inputs' => array(
								'no' => __("No: Display images that may only have one of the tags specified.", 'jig_td'),
								'yes' => __('Yes: Only show images for tags that have all the tags specified.', 'jig_td')
							)
					)
			);
			// Remove usually unnecessary NextGEN files from the page
			add_settings_field(
				'jig_ng_remove_scripts',
				__('Remove usually unnecessary NextGEN files from the page', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_nextgen_section',
					array(	'id' => 'ng_remove_scripts',
							'help' => __("To speed up loading, you can choose to disable NextGEN's scripts and styles. However, if you use NextGEN anywhere on the site without JIG or for any other reason you need those files, just let them load.", 'jig_td'),
							'inputs' => array(
								'no' => __("No: Let them load (I'm using NextGEN without JIG somewhere).", 'jig_td'),
								'yes' => __('Yes: Prevent its JS and CSS files from loading.', 'jig_td')
							)
					)
			);
			// NextGEN custom field for Links
			add_settings_field(
				'jig_nextgen_cf_link',
				__('NextGEN custom field for Links', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_nextgen_section',
				array(	'id' => 'nextgen_cf_link',
						'label' => sprintf(__('Enter the name of the custom field you set up for links with %s plugin (case sensitive). You should use the same field for images and galleries. The field will be in the gallery editing view in NextGEN.', 'jig_td'),'<a href="http://wordpress.org/plugins/nextgen-gallery-custom-fields/" target="_blank">NGG Custom Fields</a>'))
			);
			// NextGEN breadcrumb CSS
			add_settings_field(
				'jig_nextgen_breadcrumb_css',
				__('NextGEN breadcrumb CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_nextgen_section',
				array(	'id' => 'nextgen_breadcrumb_css',
						'label' => __('CSS settings for the breadcrumb.', 'jig_td'),
					'rows' => 5)
			);

			// --------------------------------
			//        Facebook
			// --------------------------------
			add_settings_section(
				'jig_facebook_section',
				__('Facebook', 'jig_td'),
				array($this, 'jig_print_facebook_desc'),
				self::PAGE_NAME
			); 
			// App ID
			add_settings_field(
				'jig_fb_app_id',
				__('App ID', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				 'jig_facebook_section',
 				array(	'id' => 'fb_app_id',
						'label' => __('The App ID of the application you have created on Facebook.', 'jig_td'))
			);
			// App Secret
			add_settings_field(
				'jig_fb_app_secret',
				__('App Secret', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				 'jig_facebook_section',
 				array(	'id' => 'fb_app_secret',
						'label' => __('The App Secret of the application you have created on Facebook.', 'jig_td'))
			);
			// Authorization manager for pages and profiles
			add_settings_field(
				'jig_fb_authed',
				__('Authorization manager for pages and profiles', 'jig_td'),
				array($this, 'jig_print_fb_authed'),
				self::PAGE_NAME,
				 'jig_facebook_section'
			);
			// Facebook caching time
			add_settings_field(
				'jig_facebook_caching',
				__('Facebook caching time', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_facebook_section',
				array(	'id' => 'facebook_caching',
						'label' => __('The time it takes to see the Facebook album change on the site. This greatly speeds up loading as the photo list for each album is cached, saving a request to Facebook each time the album is shown! Set in minutes: 4 hours is 240, a day is 1440, a week is 10080.', 'jig_td').'<br /><span id="jigFbPurge"><a href="javascript:jig_purge_facebook_caching()">'.__('Click here to purge the cache (includes the album covers as well).', 'jig_td').'</a> <span>')
			);
			// Facebook overview caching time
			add_settings_field(
				'jig_facebook_overview_caching',
				__('Facebook overview caching time', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_facebook_section',
				array(	'id' => 'facebook_overview_caching',
						'label' => __('Only used by the Facebook overview feature, this saves a lot of requests to get the individual album covers. This should be set to some very long time or you might experience a slowdown when using the overview feature. The default value, 43200 is four weeks because album covers rarely change! You can purge the cache using the link above.', 'jig_td'))
			);
			// Facebook image size in the lightbox
			add_settings_field(
				'jig_facebook_image_size',
				__('Facebook image size in the lightbox', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_facebook_section',
					array(	'id' => 'facebook_image_size',
							'help' => __("Select a preferred image size that opens in the lightbox. Normal is limited to 720px in width. Larger is the most useful, but if you need bigger, maximum will pull 4MP photos that are 2048px wide or tall at best. If the preferred image size is not available, you'll see the next best size.", 'jig_td'),
							'inputs' => array(
								'normal' => __('Normal', 'jig_td'),
								'larger' => __('Larger', 'jig_td'),
								'maximum' => __('Maximum', 'jig_td')
							)
					)
			);
			// Open albums in lightbox
			add_settings_field(
				'jig_fb_lightbox_album',
				__('Open albums in lightbox', 'jig_td'),
				array($this, 'jig_print_general_input'),
					self::PAGE_NAME,
					'jig_facebook_section',
					array(	'id' => 'fb_lightbox_album',
							'help' => __('Only when using the overview feature! Open Facebook albums in the lightbox (on the same page, instead of linking to separate pages). Note: currently not compatible with Social Gallery lightbox.', 'jig_td'),
							'inputs' => array(
								'no' => __('No: Open them on their own page.', 'jig_td'),
								'yes' => __('Yes: Open them in the lightbox.', 'jig_td')
							)
					)
			);
			// Facebook overview slug
			add_settings_field(
				'jig_fb_overview_slug',
				__('Facebook overview slug', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_facebook_section',
				array(	'id' => 'fb_overview_slug',
						'label' => __('<strong>Advanced setting!</strong> Make sure you know what you are doing as to not cause a conflict. Using the overview feature, this appears in the URL.', 'jig_td').'<br /><span id="jigRewriteFlush"><a href="javascript:jig_flush_rewrite_rules()">'.__('When changed you must click here to flush rewrite rules.', 'jig_td').'</a> <span>')
			);			
			// Facebook breadcrumb CSS
			add_settings_field(
				'jig_fb_breadcrumb_css',
				__('Facebook breadcrumb CSS', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_facebook_section',
				array(	'id' => 'fb_breadcrumb_css',
						'label' => __('CSS settings for the breadcrumb. This is only used when the overview is selected and the albums are not set to open in the lightbox.', 'jig_td'),
					'rows' => 5)
			);
			// --------------------------------
			//        Flickr
			// --------------------------------
			add_settings_section(
				'jig_flickr_section',
				__('Flickr', 'jig_td'),
				array($this, 'jig_print_flickr_desc'),
				self::PAGE_NAME
			); 
			// API Key
			add_settings_field(
				'jig_fli_api_key',
				__('API Key', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				 'jig_flickr_section',
 				array(	'id' => 'fli_api_key',
						'label' => __("Your Flickr API Key, it's mandatory if you wish to use this feature.", 'jig_td'))
			);
			// Add users
			add_settings_field(
				'jig_fli_added',
				__('Add users', 'jig_td'),
				array($this, 'jig_print_fli_added'),
				self::PAGE_NAME,
				 'jig_flickr_section'
			);
			// Flickr caching time
			add_settings_field(
				'jig_flickr_caching',
				__('Flickr caching time', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_flickr_section',
				array(	'id' => 'flickr_caching',
						'label' => __('The time it takes to see the Flickr content change on the site. This greatly speeds up loading as the photo list for each content is cached, saving a request to Flickr each time the album is shown! Set in minutes: 4 hours is 240, a day is 1440, a week is 10080.', 'jig_td').'<br /><span id="jigFliPurge"><a href="javascript:jig_purge_flickr_caching()">'.__('Click here to purge the cache.', 'jig_td').'</a> <span>')
			);
			// Link to the photo on Flickr
			add_settings_field(
				'jig_flickr_link',
				__('Link to the photo on Flickr', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_flickr_section',
				array(	'id' => 'flickr_link',
						'help' => __('Display a link back to the photo on Flickr in the lightbox.<br/>Highly recommended!', 'jig_td'),
						'inputs' => array(
							'no' => __('No', 'jig_td'),
							'yes' => __('Yes: link title (default position).', 'jig_td'),
							'alt' => __('Add to img alt.', 'jig_td')
						)
				)
			);
			// Flickr backlink text
			add_settings_field(
				'jig_flickr_link_text',
				__('Flickr backlink text', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_flickr_section',
				array(	'id' => 'flickr_link_text',
						'label' => __('What text to display as the Flickr backlink.', 'jig_td'),
					'rows' => 1)
			);
			// Flickr backlink target
			add_settings_field(
				'jig_flickr_link_target',
				__('Flickr backlink target', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_flickr_section',
				array(	'id' => 'flickr_link_target',
						'help' => __('Whether or not to open Flickr backlink on a new tab.', 'jig_td'),
						'inputs' => array(
							'_blank' => __('New tab (_blank).', 'jig_td'),
							'_self' => __('Navigate away (_self).', 'jig_td')
						)
				)
			);
			// Look for and allow hi-res photos
			add_settings_field(
				'jig_flickr_allow_big_images',
				__('Look for and allow hi-res photos', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_flickr_section',
				array(	'id' => 'flickr_allow_big_images',
						'help' => __('Controls the image size in the lightbox. When enabled, the plugin will look for image sizes larger than 1024px, namely 1600px and 2048px versions. You might not want this for any reason including performance or copyright issues. For consistent lightbox experience, if you do not have large versions of every image displayed then keep this disabled.', 'jig_td'),
						'inputs' => array(
							'no' => __('No, the largest image to look for is the 1024px version.', 'jig_td'),
							'yes' => __('Yes, look for image versions 1600px or 2048px.', 'jig_td')
						)
				)
			);
			// What to do with small images
			/*add_settings_field(
				'jig_flickr_too_small_images',
				__('What to do with small images', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_flickr_section',
				array(	'id' => 'flickr_too_small_images',
						'help' => __("Small images from Flickr won't be displayed and the plugin can tell you when these images are skipped and why. However, you can choose to display them anyway with upscaling but it's highly not recommended as it may result in blurry photos and unwanted behavior (Jetpack Photon generally doesn't upscale). If you are fine about them being skipped, just disregard them by hiding the notice.", 'jig_td'),
						'inputs' => array(
							'error' => __('Show an error when some images are not displayed because they are too small.', 'jig_td'),
							'upscale' => __('Allow upscaling of images that would otherwise be not displayed due to size.', 'jig_td'),
							'no' => __('Disregard small images and hide the notice.', 'jig_td')
						)
				)
			);*/

			// --------------------------------
			//        Instagram
			// --------------------------------
			add_settings_section(
				'jig_instagram_section',
				__('Instagram', 'jig_td'),
				array($this, 'jig_print_instagram_desc'),
				self::PAGE_NAME
			); 
			// Client ID
			add_settings_field(
				'jig_ig_client_id',
				__('Client ID', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				 'jig_instagram_section',
 				array(	'id' => 'ig_client_id',
						'label' => __("Instagram App's Client ID.", 'jig_td'))
			);
			// Client Secret
			add_settings_field(
				'jig_ig_client_secret',
				__('Client Secret', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				 'jig_instagram_section',
 				array(	'id' => 'ig_client_secret',
						'label' => __("Instagram App's Client Secret.", 'jig_td'))
			);
			// Authorization manager for Instagram
			add_settings_field(
				'jig_ig_authed',
				__('Authorization manager for Instagram', 'jig_td'),
				array($this, 'jig_print_ig_authed'),
				self::PAGE_NAME,
				 'jig_instagram_section'
			);
			// Instagram caching time
			add_settings_field(
				'jig_instagram_caching',
				__('Instagram caching time', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_instagram_section',
				array(	'id' => 'instagram_caching',
						'label' => __('The time it takes to see the Instagram content change on the site. This greatly speeds up loading as the photo list for each content type is cached, saving many requests to Instagram! Set in minutes: 4 hours is 240, a day is 1440, a week is 10080.', 'jig_td').'<br /><span id="jigIgPurge"><a href="javascript:jig_purge_instagram_caching()">'.__('Click here to purge the cache.', 'jig_td').'</a> <span>')
			);
			// Link to the photo on Instagram
			add_settings_field(
				'jig_instagram_link',
				__('Link to the photo on Instagram', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_instagram_section',
				array(	'id' => 'instagram_link',
						'help' => __('Display a link back to the photo on Instagram in the lightbox.<br/>Highly recommended!', 'jig_td'),
						'inputs' => array(
							'no' => __('No', 'jig_td'),
							'yes' => __('Yes: link title (default position).', 'jig_td'),
							'alt' => __('Add to img alt.', 'jig_td')
						)
				)
			);
			// Instagram backlink text
			add_settings_field(
				'jig_instagram_link_text',
				__('Instagram backlink text', 'jig_td'),
				array($this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				'jig_instagram_section',
				array(	'id' => 'instagram_link_text',
						'label' => __('What text to display as the Instagram backlink.', 'jig_td'),
					'rows' => 1)
			);
			// Instagram backlink target
			add_settings_field(
				'jig_instagram_link_target',
				__('Instagram backlink target', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_instagram_section',
				array(	'id' => 'instagram_link_target',
						'help' => __('Whether or not to open Instagram backlink on a new tab.', 'jig_td'),
						'inputs' => array(
							'_blank' => __('New tab (_blank).', 'jig_td'),
							'_self' => __('Navigate away (_self).', 'jig_td')
						)
				)
			);
			


			// --------------------------------
			//        RSS
			// --------------------------------
			add_settings_section(
				'jig_rss_section',
				__('RSS', 'jig_td'),
				array($this, 'jig_print_rss_desc'),
				self::PAGE_NAME
			);  

			// RSS links to
			add_settings_field(
				'jig_rss_links_to',
				__('RSS links to', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_rss_section',
				array(	'id' => 'rss_links_to',
						'help' => __('What should open when clicking on thumbnails from an RSS feed?', 'jig_td'),
						'inputs' => array(
							'permalink' => __('Permalink (the link of the feed item).', 'jig_td'),
							'image' => __('Image (lightbox, a gallery of RSS items).', 'jig_td')
						)
				)
			);
			// RSS description
			add_settings_field(
				'jig_rss_description',
				__('RSS description', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_rss_section',
				array(	'id' => 'rss_description',
						'help' => __('This controls what text to show as description on the thumbnails.', 'jig_td'),
						'inputs' => array(
							'none' => __('Nothing, just the title.', 'jig_td'),
							'description' => __('Description (full, can be too long).', 'jig_td'),
							'excerpt' => __('Excerpt: description cut to x words (automatic, HTML off).', 'jig_td'),
							'datetime' => __('Date and time.', 'jig_td'),
							'date' => __('Date only.', 'jig_td'),
							'nicetime' => __("Nice time (FB style 'ago').", 'jig_td')
						)
				)
			);
			// RSS exceprt length (words)
			add_settings_field(
				'jig_rss_excerpt_length',
				__('RSS exceprt length (words)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_rss_section',
				array(	'id' => 'rss_excerpt_length',
						'label' => __('Limit the length of automatic excerpt, defaults to 20 words.', 'jig_td'))
			);
			// RSS exceprt ending
			add_settings_field(
				'jig_rss_excerpt_ending',
				__('RSS exceprt ending', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_rss_section',
				array(	'id' => 'rss_excerpt_ending',
						'label' => __('Add this to the end of the auto excerpt like " [...]"', 'jig_td'))
			);
			// RSS lightbox backlink
			add_settings_field(
				'jig_rss_link',
				__('RSS lightbox backlink', 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_rss_section',
				array(	'id' => 'rss_link',
						'help' => __("This the RSS item's backlink in the lightbox, only used when RSS links to image, to provide a way of still going to the permalink.", 'jig_td'),
						'inputs' => array(
							'no' => __('No I really just want a gallery of RSS images.', 'jig_td'),
							'yes' => __('Yes: link title (the default position).', 'jig_td'),
							'alt' => __('Add to img alt.', 'jig_td')
						)
				)
			);
			// RSS lightbox backlink target
			add_settings_field(
				'jig_rss_link_target',
				__("RSS lightbox backlink target", 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_rss_section',
				array(	'id' => 'rss_link_target',
						'help' => __("Whether or not to open RSS lightbox backlink on a new tab. To control thumbnail click target, use the General settings -> Behavior of the plugin -> Custom link's target", 'jig_td'),
						'inputs' => array(
							'_blank' => __('New tab (_blank).', 'jig_td'),
							'_self' => __('Navigate away (_self).', 'jig_td')
						)
				)
			);
			// RSS lightbox backlink text
			add_settings_field(
				'jig_rss_link_text',
				__('RSS lightbox backlink text', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_rss_section',
				array(	'id' => 'rss_link_text',
						'label' => __('The text to show as RSS lightbox backlink, e.g. Read more, Go to story', 'jig_td'))
			);
			// RSS caching time
			add_settings_field(
				'jig_rss_caching',
				__('RSS caching time', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_rss_section',
				array(	'id' => 'rss_caching',
						'label' => __('By default the caching is 12 hours (set by WP), you can override that for this feature. Set in minutes.', 'jig_td'))
			);

			// --------------------------------
			//        TimThumb & CDN
			// --------------------------------
			add_settings_section(
				'jig_timthumb_section',
				__('TimThumb & CDN', 'jig_td'),
				array($this, 'jig_print_timthumb_desc'),
				self::PAGE_NAME
			);  
			// TimThumb quality
			add_settings_field(
				'jig_quality',
				__('TimThumb quality', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_timthumb_section',
				array(	'id' => 'quality',
						'label' => __('Enter a number between 0 and 100, 90 is good quality.', 'jig_td'))
			);
			// Retina ready
			add_settings_field(
				'jig_retina_ready',
				__("Retina ready", 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_timthumb_section',
				array(	'id' => 'retina_ready',
						'help' => __("Retina ready means the thumbnails will look crisp on modern mobile devices or other high resolution displays. The image resolution is multiplied by the device's pixel aspect ratio.", 'jig_td'),
						'inputs' => array(
							'yes' => __('Yes, load higher resolution thumbnails on HDPI displays.', 'jig_td'),
							'no' => __('No, just load normal resolution thumbnails on all devices.', 'jig_td')
						)
				)
			);
			// Retina quality
			add_settings_field(
				'jig_retina_quality',
				__('Retina quality', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_timthumb_section',
				array(	'id' => 'retina_quality',
						'label' => sprintf(__("This determines the thumbnails' file size. Same as TimThumb quality. Best set to auto, which will divide TimThumb quality by the pixel aspect ratio of the device (will use a minimum of 40 quality). In case of double sized images it'll serve half the normal quality. Similarly, it'll serve two-thirds quality for 1.5x images... This ensures that the filesize of thumbnails are not increased too much so the bandwidth usage is not doubled for mobile devices. The percieved quality will still be better, study shows: %s", 'jig_td'),'<a href="http://www.netvlies.nl/blog/design-interactie/retina-revolution" target="_blank">Retina revolution</a>')
					)
			);
			// Custom TimThumb path
			add_settings_field(
				'jig_timthumb_path',
				__('Custom TimThumb path (leave empty if unsure)', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_timthumb_section',
				array(	'id' => 'timthumb_path',
						'label' => __('Absolute path to your version of timthumb.php (full URL).', 'jig_td'))
			);
			// Replace site's hostname with
			$site_host = explode('/',str_replace(array('http://','https://'),'',site_url()));
			add_settings_field(
				'jig_cdn_host',
				__("Replace site's hostname with", 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_timthumb_section',
				array(	'id' => 'cdn_host',
						'label' => sprintf(__("Enter the hostname of your CDN (e.g. cdn.yourdomain.com), this will replace your site's hostname which is <strong>%s</strong>", 'jig_td'),$site_host[0]))
			);

			// External image caching time
			add_settings_field(
				'jig_external_caching',
				__('External image caching time', 'jig_td'),
				array($this, 'jig_print_text_input'),
				self::PAGE_NAME,
				'jig_timthumb_section',
				array(	'id' => 'external_caching',
						'label' => __('Set in days, but enter <strong>infinite</strong> to cache forever. Speeds up loading as the dimensions of external images only need to be grabbed for the first time, currently used by RSS Feeds, Jetpack Photon and very old NextGEN installations. Only set differently or purge in case you are experiencing problems.', 'jig_td').'<br /><span id="jigExternalPurge"><a href="javascript:jig_purge_external_caching()">'.__('Click here to purge the cache.', 'jig_td').'</a> <span>')
			);
			// Use TimThumb
			add_settings_field(
				'jig_use_timthumb',
				__("Use TimThumb", 'jig_td'),
				array($this, 'jig_print_general_input'),
				self::PAGE_NAME,
				'jig_timthumb_section',
				array(	'id' => 'use_timthumb',
						'help' => __("Advanced users only! Automatically disabled when using Jetpack Photon. 'No' disables automatic thumbnail creation and the normal sized images will be loaded and resized by the browser (most often a bad practice). This brings good quality at an enormous bandwidth cost, compared to TimThumb. Sharp but ugly pixelated browser scaling may appear. Fixed aspect ratio and randomize width features will not be available. Only disable TimThumb if you know what you are doing, for logos, tesing purposes or as a last resort.", 'jig_td'),
						'inputs' => array(
							'yes' => __('Yes: Use TimThumb (recommended).', 'jig_td'),
							'no' => __('No: Do not use TimThumb (not recommended).', 'jig_td')
						)
				)
			);
			

			add_action('wp_ajax_jig_fb_auth', array($this, 'jig_fb_auth'));
			add_action('wp_ajax_jig_get_fb_access_token', array($this, 'jig_get_fb_access_token'));
			add_action('wp_ajax_jig_add_fb_page', array($this, 'jig_add_fb_page'));
			add_action('wp_ajax_jig_get_fb_albums', array($this, 'jig_get_fb_albums'));
			add_action('wp_ajax_jig_get_fb_album_cover_on_demand', array($this, 'jig_get_fb_album_cover_on_demand'));		
			add_action('wp_ajax_jig_verify_fb_authed', array($this, 'jig_verify_fb_authed'));

			add_action('wp_ajax_jig_add_fli_user', array($this, 'jig_add_fli_user'));
			add_action('wp_ajax_jig_get_fli_types', array($this, 'jig_get_fli_types'));		
			add_action('wp_ajax_jig_get_fli_elements', array($this, 'jig_get_fli_elements'));	

			add_action('wp_ajax_jig_ig_auth', array($this, 'jig_ig_auth'));
			add_action('wp_ajax_jig_get_ig_access_token', array($this, 'jig_get_ig_access_token'));
			add_action('wp_ajax_jig_verify_ig_authed', array($this, 'jig_verify_ig_authed'));
			add_action('wp_ajax_jig_instagram_search_users', array($this, 'jig_instagram_search_users'));	
			add_action('wp_ajax_jig_instagram_search_tags', array($this, 'jig_instagram_search_tags'));	
			add_action('wp_ajax_jig_instagram_search_locations', array($this, 'jig_instagram_search_locations'));	

			add_action('wp_ajax_jig_attempt_chmod', array($this, 'jig_attempt_chmod'));
			add_action('wp_ajax_jig_on_demand_check_permissions', array($this, 'jig_on_demand_check_permissions'));
			add_action('wp_ajax_jig_purge_flickr_caching', array($this, 'jig_purge_flickr_caching'));
			add_action('wp_ajax_jig_purge_facebook_caching', array($this, 'jig_purge_facebook_caching'));
			add_action('wp_ajax_jig_purge_instagram_caching', array($this, 'jig_purge_instagram_caching'));
			add_action('wp_ajax_jig_purge_external_caching', array($this, 'jig_purge_external_caching'));
			add_action('wp_ajax_jig_flush_rewrite_rules', array($this, 'jig_flush_rewrite_rules'));
			add_action('wp_ajax_jig_wipe_settings', array($this, 'jig_wipe_settings'));
			add_action('wp_ajax_jig_backup_settings', array($this, 'jig_backup_settings'));
			add_action('wp_ajax_jig_import_settings', array($this, 'jig_import_settings'));
		} // end jig_init_options  

		// The sections' description
		function jig_print_general_settings_desc(){
			echo '<p id="jig_general_settings">'.__('General layout, appearance and behavior settings, utilities for your Justified Image Grid.', 'jig_td').'</p>';  
		} 

		function jig_print_load_more_desc(){
			echo '<p id="jig_load_more">'.__('Let the images load in batches, speeding up the page load, giving a smoother experience. It can happen manually by clicking a button or automatically scrolling.', 'jig_td').'</p>';  
		}

		function jig_print_lightboxes_desc(){
			echo '<p id="jig_lightboxes">'.__('The lightbox is the modal gallery window that opens your images.', 'jig_td').'</p>';
		} 

		function jig_print_captions_desc(){
			echo '<p id="jig_captions">'.__('Settings for the caption text over the thumbnails.', 'jig_td').'</p>';  
		} 

		function jig_print_overlay_desc(){
			echo '<p id="jig_overlay">'.__('Setup the looks of the color overlay. This is mainly used to darken/lighten the images on mouse over.', 'jig_td').'</p>';  
		}

		function jig_print_specialfx_desc(){
			echo '<p id="jig_specialfx" class="jigLong">'.__("Apply various special effects on the fly without extra bandwidth usage. It'll only work with images that reside on the same host as this site. This is solved for remote images by TimThumb, but it's disabled when you use Jetpack Photon. Choose the setting that best suits your needs.", 'jig_td').'</p>';  
		}


		function jig_print_filtering_desc(){
			echo '<p id="jig_filtering" class="jigLong">'.__("You can narrow the thumbnails shown with the plugin by any taxonomy.", 'jig_td').'</p>';  
		}

		function jig_print_nextgen_desc(){
			echo '<p id="jig_nextgen">'.__('Set up additional settings that change the NextGEN integration experience for Justified Image Grid.', 'jig_td').'</p>';  
		}

		function jig_print_facebook_desc(){
			echo '<div id="jig_facebook" class="jigLong"><p>'.
				__("You can load photos from Facebook on the fly. This means if an album changes on Facebook, it will automatically update on your site as well. Thus, the images are not copied here but served from Facebook's CDN. Please respect their service and do not abuse it by serving many images at once. So the thumbnails are cached and your content request to Facbook is cached as well. Content list caching is optional but advised.", 'jig_td').
				'</p><p>'.
				__('You only need to enter the App ID and App Secret if you are accessing profiles or restricted pages. If you want to load images from a public, unrestricted page, you can go ahead and just add it below (try it). In any other case you need to create a simple application on Facebook once. ', 'jig_td').
				'</p><p><a href="javascript:jig_toggle_fb_app_help();">'.
				__('How to set up an app?', 'jig_td').
				'</a></p><div id="jigFbAppHelp">'.
				'<div id="jigFbAppHelpTitle">'.__('Quick instructions for setting up a Facebook app', 'jig_td').':</div><ol>'.
				'<li>'.sprintf(__('Go to %1$s.', 'jig_td'), '<a href="https://developers.facebook.com/apps" target="_blank">Facebook Developers</a>').'</li>'.
				'<li>'.__('If this is your first time being on this page, you might need to click "Allow".', 'jig_td').'</li>'.
				'<li>'.__('Click "Create New App" in the top right corner.', 'jig_td').'</li>'.
				'<li>'.__('In the "Create New App" dialog, enter an "App Name" that is relevant to your site, then hit "Continue".', 'jig_td').'</li>'.
				'<li>'.__('You might need to complete a captcha security check and/or verify your Facebook account.', 'jig_td').'</li>'.
				'<li>'.__('Under the "Website with Facebook Login" area, add your site URL beginning with http or https and ending with the domain, then click "Save Changes" there.', 'jig_td').'</li>'.
				'<li>'.__('Copy the "App ID" and "App Secret" fields to the appropriate fields below.', 'jig_td').'</li>'.
				'<li>'.__('Click "Save Changes" here! You are done! Now you can add your profile or restricted pages.', 'jig_td').'</li>'.
				'<li>'.__('To add yourself: Click "Add current Facebook user", then on Facebook click "Go to App". Click "Save Changes" here!', 'jig_td').'</li>'.
				'</ol></div><p>'.
				__('Please keep in mind that the authorization (for loading albums from user profiles or pages that require age/location verification) EXPIRES after 2 months. The gallery will show a yellow alert in the WordPress administration area on all pages one week prior to expiration or a red one if it has expired. To renew you need to authorize the user again, which is done with just one click.', 'jig_td').
				'</p><p>'.
				__("To begin, add a page below. If you set up the App ID and App Secret you can add yourself or another user as well. Click on the added users/pages to verify their status. Hit X to remove them. Don't forget to save changes! You will be able to display content belonging to an added user on a per gallery basis in the in the Shortcode Editor, accessible when you edit a page or post.", 'jig_td').
				'</p></div>';  
		}

		function jig_print_flickr_desc(){
			echo '<div id="jig_flickr" class="jigLong"><p>'.
				__("You can load photos from Flickr on the fly. This means if your content changes on Flickr, it will update on your site as well. Thus, the images are not copied here, but served from Flickr's CDN. Please respect their service and do not abuse it by serving many images at once. So the thumbnails are cached and your content request to Flickr is cached as well. Content list caching is optional but advised.", 'jig_td').
				'</p><p>'.
				__('You must enter an API Key to use the this feature. This plugin does not support private images, so there is no need to authenticate either. You can load any public content from Flickr.', 'jig_td').
				'</p><p><a href="javascript:jig_toggle_fli_api_help();">'.
				__('How to get the API Key?', 'jig_td').
				'</a></p><div id="jigFliApiHelp">'.
				'<div id="jigFliApiHelpTitle">'.__('Quick instructions for getting the Flickr API Key', 'jig_td').':</div><ol>'.
				'<li>'.sprintf(__('Log in to Flickr, then go to %1$s.', 'jig_td'), '<a href="http://www.flickr.com/services/apps/create/apply/" target="_blank">Flickr Services</a>').'</li>'.
				'<li>'.__('Choose Non-Commercial or Commercial. In most cases Non-Commercial is fine and this help chooses that.', 'jig_td').'</li>'.
				'<li>'.__("Enter a name and a brief description of what you are using this for. The name can be your site's name. The description can be simple as it is automatically approved anyway.", 'jig_td').'</li>'.
				'<li>'.__('Tick the two checkboxes and hit Submit.', 'jig_td').'</li>'.
				'<li>'.__('Your API Key (the longer one) is created, copy it from Flickr to the field on this page.', 'jig_td').'</li>'.
				'<li>'.__('Click "Save Changes" here! You are done! Now you can add users.', 'jig_td').'</li>'.
				'<li>'.__('To add yourself: Enter your Flickr username (or NSID) below then click the button or hit enter. Click "Save Changes" here!', 'jig_td').'</li>'.
				'</ol><p>'.
				__("This product uses the Flickr API but is not endorsed or certified by Flickr.", 'jig_td').
				'</p></div><p>'.
				__("Once you have added some users (at least one), you'll be able to load images from their Photostream or Favorites. You can also access the Groups, Photosets, and Galleries belonging to a user. The tool select what content to display is the Shortcode Editor, accessible when you edit a page or post.", 'jig_td').
				'</p></div>'; 
		}

		function jig_print_instagram_desc(){
			echo '<div id="jig_instagram" class="jigLong"><p>'.
				__("You can display content from Instagram on the fly. This means that when new photos are added to Instagram, your site will reflect the change soon. So the images are not copied here, but are server from Instagram's CDN. Please respect their service and do not abuse it by serving many images at once. So the thumbnails are cached and your content request to Instagram is cached as well. Content list caching is optional but advised.", 'jig_td').
				'</p><p>'.
				__('You must to enter the Client ID and Client Secret if you wish to use the Instagram feature. You need to register a simple application on Instagram once. ', 'jig_td').
				'</p><p><a href="javascript:jig_toggle_ig_app_help();">'.
				__('How to register an app?', 'jig_td').
				'</a></p><div id="jigIgAppHelp">'.
				'<div id="jigIgAppHelpTitle">'.__('Instructions for registering an Instagram app', 'jig_td').':</div><ol>'.
				'<li>'.sprintf(__('Go to %1$s.', 'jig_td'), '<a href="http://instagram.com/developer/" target="_blank">Instagram Developers</a>').'</li>'.
				'<li>'.__('If this is your first time on Instagram you need to register an account first, which is ONLY available on mobile devices, in the Instagram app.', 'jig_td').'</li>'.
				'<li>'.__('Log-in to Instagram if you are not logged in already (top right corner).', 'jig_td').'</li>'.
				'<li>'.__('Click "Register Your Application or "Manage Clients" in the top right corner.', 'jig_td').'</li>'.
				'<li>'.__('Click "Register a New Client".', 'jig_td').'</li>'.
				'<li>'.__('On the "Register new OAuth Client" page, enter an "Application Name" that is relevant to your site (the title).', 'jig_td').'</li>'.
				'<li>'.__('Enter something as "Description", like "this is for my Instagram gallery".', 'jig_td').'</li>'.		
				'<li>'.__('Enter the absolute URL of your website in the "http://yourdomain.com" format into the "Website" field.', 'jig_td').'</li>'.
				'<li>'.__('Copy this URL into the "OAuth redirect_uri": ', 'jig_td').'<strong>'.admin_url('admin-ajax.php').'?action=jig_ig_auth</strong></li>'.
				'<li>'.__('Click "Register". You should see a green note, "Successfully registered"!', 'jig_td').'</li>'.
				'<li>'.__('Copy the "CLIENT ID" and "CLIENT SECRET" values to the appropriate fields below.', 'jig_td').'</li>'.
				'<li>'.__('Click "Save Changes" here! You are done! Now you can authorize yourself.', 'jig_td').'</li>'.
				'<li>'.__('To add yourself: Click "Add current Instagram user", then on Instagram click "Authorize". Click "Save Changes" here!', 'jig_td').'</li>'.
				'</ol><p>'.
				__("This product uses the Instagram API but is not endorsed or certified by Instagram.", 'jig_td').
				'</p></div><p>'.
				__("Please keep in mind that the authorization MAY EXPIRE in the future. The gallery will show a red alert in the WordPress administration area on all pages when this happens. To renew you need to authorize the user again, which is done with just one click on the 'Authorize current Instagram user' button. Note that just one authenticated user is enough to access all Instagram content you may possibly need. The ability to add multiple users is just a convenience. Click on a user to verify their status. Hit X to remove. Don't forget to save changes!", 'jig_td').
				' '.
				__("You will be able to select what content to display from Instagram on a per gallery basis in the Shortcode Editor, accessible when you edit a page or post.", 'jig_td').
				'</p></div>'; 
		}

		function jig_print_rss_desc(){
			echo '<p id="jig_rss">'.__("Use any RSS/Atom or other XML based feeds as an image source. Only feed items with images will be used. Note that most feeds only use small images, so you may need to decrease row height accordingly. You will have a better result with an image rich feed with larger images, e.g. feed from an image sharing site. The first visit to the JIG gallery with the RSS feed will be slow due to remote image dimensions caching, but after that everything should be smooth. If you don't see your newest additions to the feed, set a low caching time below.", 'jig_td').'</p>';  
		}

		function jig_print_timthumb_desc(){
			echo '<div id="jig_timthumb"><p><a href="javascript:jig_on_demand_check_permissions()">'.
				__('Click here to check permissions to write to the cache folder. This is vital for the plugin to be working correctly.', 'jig_td').'</a></p>'; 
				echo '<p id="ttPermissionResults">'.
				sprintf(__('The permission for the cache folder is: %1$s and it seems to be %2$s. The plugin folder permission is %3$s.', 'jig_td'), '<span id="ttPermissionCache"></span>', '<span id="ttWritable"></span>', '<span id="ttPermissionPlugin"></span>').
				'<br /><br /><a href="javascript:jig_attempt_chmod(\'0755\');">'.
				__('Click here to change the permission 0755 - It should fix it in most cases.', 'jig_td').
				'</a><br /><a href="javascript:jig_attempt_chmod(\'0777\');">'.
				__('As a last resort, click to try 0777 (not recommended).', 'jig_td').
				'</a></p><p id="ttChmodFeedback"></p>';
			echo '<p class="jigLong">'.sprintf(__("Tip: To avoid using TimThumb, just install the official WP plugin 'Jetpack' by Automattic and enable 'Photon'. Jetpack enables you to connect your blog to a WordPress.com account to use the powerful features normally only available to WordPress.com users. It's an excellent TimThumb alternative and will make your images load faster. Note that you won't be able to use special effects due to cross-domain security policies. It'll also make Justified Image Grid high resolution display or Retina-ready! Read more at: %s.", 'jig_td'),'<a href="http://jetpack.me/" target="_blank" rel="external nofollow">jetpack.me</a>').'</p></div>';
		}

		// Field callback functions
		function jig_print_text_input($args){
			extract($args);
			echo '<input id="'.$id.'" name="'.self::SETTINGS_NAME.'['.$id.']" type="text" value="'.$this->settings[$id].'" /><div class="jigContextHelp" id=jigContext-'.$id.'>'.$label.'</div>';
		}

		function jig_print_hidden_input($args){
			extract($args);
			$value = $this->settings[$id];
			$currentTime = time();
			if(strrpos($value, '|') !== false){ // If the time is set in the value check for its expiry
				$dbTime = (int) substr($value,strrpos($value, '|')+1);
				if($dbTime+600 < $currentTime){
					$value = '';
				}
			}
			echo '<input class="jigHiddenInput" id="'.$id.'" name="'.self::SETTINGS_NAME.'['.$id.']" type="text" data-generate-time="'.$currentTime.'" value="'.$value.'" /><div class="jigContextHelp" id=jigContext-'.$id.'>'.$label.'</div>';
		}
		
		function jig_print_textarea_input($args){
			extract($args);
			echo '<textarea cols="40" rows="'.$rows.'" id="'.$id.'" name="'.self::SETTINGS_NAME.'['.$id.']" >'.$this->settings[$id].'</textarea><div class="jigContextHelp" id=jigContext-'.$id.'>'.$label.'</div>';
		}

		function jig_print_general_input($args){
			extract($args);
			$name = self::SETTINGS_NAME.'['.$id.']';
			$output = '<div class="jigContextHelp" id=jigContext-'.$id.'>'.$help.'</div>';
			foreach ($inputs as $value => $label) {
				$output .= '<input type="radio" name="'.$name.'" id="'.$name.'-'.$value.'" value="'.$value.'" '.checked($this->settings[$id], $value, false).'/><label for="'.$name.'-'.$value.'">'.$label.'</label> <br />';
			}
			echo $output;
		}

		function jig_print_checkbox_input($args){
			extract($args);
			$name = self::SETTINGS_NAME.'['.$id.']';
			$output = '<div class="jigContextHelp" id=jigContext-'.$id.'>'.$help.'</div>';
			foreach ($inputs as $value => $label) {
				$output .= '<input type="checkbox" name="'.$name.'[]" id="'.$name.'-'.$value.'" value="'.$value.'" '.(in_array($value, $this->settings[$id]) ? 'checked' : '').'/><label for="'.$name.'-'.$value.'">'.$label.'</label> <br />';
			}
			echo $output;
		}

		function jig_print_fb_authed(){
			$id = 'fb_authed';
			$hidden = '';
			$output = '<div id="jigFbWrapper">
							<div id="jigFbLoadingAJAX">
								<div id="jigFbLoadingInner">'.
									__('communicating with Facebook', 'jig_td').
									'<br /><span id="jigFbLoadingInnerSmallText">'.__('please be patient, it takes a moment', 'jig_td').
									'</span>						
									<div id="jigFbIcon"></div>
								</div>
							</div>
							<div id="jigFb">';
			$output .= '<div id="jigFbAuthed" class="jig-clearfix">';
			$output .= '<div id="jigFbAuthedPrototype" class="jigFbAuthedElement"><div class="jigFbAuthedIcon"></div><div class="jigFbAuthedName"></div><div class="jigFbAccessFrom"></div><div class="jigFbAuthedRemove">X</div></div>';
			if($this->settings[$id] != ''){
				foreach ($this->settings[$id] as $key => $val){
					$expired = '';
					if(isset($val['access_token_owner_id'])){
						if($this->settings[$id][$val['access_token_owner_id']]['time_added']+$this->settings[$id][$val['access_token_owner_id']]['expires'] < time()){
							$expired = ' fbExpiredRedAlert';
						}
					}else if(isset($val['time_added'])){
						if($val['time_added']+$val['expires'] < time() ){
							$expired = ' fbExpiredRedAlert';
						}
					}
					
					$output .= '<div id="fbAuthed'.$val['user_id'].'" data-access-token="'.$val['access_token'].'" class="jigFbAuthedElement'.$expired.'" data-type="'.$val['type'].'"><div class="jigFbAuthedIcon">'.(isset($val['picture']) ? '<img src="'.$val['picture'].'" />' : '').'</div><div class="jigFbAuthedName">'.$val['user_name'].'</div><div class="jigFbAccessFrom">'.(isset($val['access_token_owner_name']) ? '<div class="jigFbAccessFromInner">(via  '.$val['access_token_owner_name'].')</div>' : '').'</div><div class="jigFbAuthedRemove">X</div></div>';
					$hidden .= '<div id="fbField'.$val['user_id'].'">';
					foreach ($val as $k => $v){
						$hidden .= '<input class="jig_fb_field_'.$k.'" type="hidden" name="'.self::SETTINGS_NAME.'['.$id.']['.$val['user_id'].']['.$k.']" value="'.$v.'" />';
					}
					$hidden .= '</div>';
				} 
			}
			$output .= '</div><div id="jigFbLeft">';
			$output .= '<div id="jigAddFbPage">'.__('Add a new Facebook page', 'jig_td').'<input type="text" id="jigAddFbPageInput" value="" /></div><div id="jigFbWithAppOnly">';

			$output .= '<a id="jigFbAuthRequest" href="'.admin_url('admin-ajax.php').'?action=jig_fb_auth" target="_blank"><div id="jigFbAuthBtn">'.__('Add current Facebook user', 'jig_td').'</div></a>';

			$output .= '<div id="jigFbAuthManualBtn" class="jig_disable">'.__('Manually load Facebook data', 'jig_td').'</div>';

			$output .= '<div id="jigFbAuthOtherUserPanelTitle">'.__('To add other user, complete the steps below', 'jig_td').':</div>';

			$output .= '<div id="jigFbAuthOtherUserPanel">
							<span>1. '.__('Send this link to the other user', 'jig_td').':</span><br />
							<input type="text" id="jigFbOtherUserLink" value="" data-force="https://www.facebook.com/dialog/oauth?client_id='.trim($this->settings['fb_app_id']).'&scope=user_photos&redirect_uri='.urlencode(plugins_url('fb-auth-other-user.php', __FILE__)).'" /><br />
							<span>2. '.__('Enter the code the user received', 'jig_td').':</span><br />
							<input type="text" id="jigFbOtherUserCode" value="" /><br />
							<div id="jigFbOtherUserLoad">'.__('Add other user', 'jig_td').'</div>
							
						</div>';

			$output .= '</div></div><div id="jigFbRight"><div id="jigFbAuthLogWrapper"><div id="jigFbAuthLogTitle">Message log:</div><div id="jigFbAuthLog"></div></div>';
			$output .= '<div id="jigFbAuthedHidden" data-name="'.self::SETTINGS_NAME.'['.$id.']">'.$hidden.'</div>';
			$output .= '</div></div>';
			echo $output;
		}

		function jig_print_fli_added(){
			$id = 'fli_added';
			$hidden = '';
			$output = '<div id="jigFliWrapper">
							<div id="jigFliLoadingAJAX">
								<div id="jigFliLoadingInner">'.
									__('communicating with Flickr API', 'jig_td').
									'<br /><span id="jigFliLoadingInnerSmallText">'.__('please be patient, it takes a moment', 'jig_td').
									'</span>						
									<div id="jigFliIcon"></div>
								</div>
							</div>
							<div id="jigFli">';
			$output .= '<div id="jigFliAdded" class="jig-clearfix">';
			$output .= '<div id="jigFliAddedPrototype" class="jigFliAddedElement"><div class="jigFliAddedIcon"></div><div class="jigFliAddedName"></div><div class="jigFliAddedRemove">X</div></div>';
			if($this->settings[$id] != ''){
				foreach ($this->settings[$id] as $key => $val){
					
					$output .= '<div id="fliAdded'.$val['user_alias'].'" class="jigFliAddedElement"><div class="jigFliAddedIcon"><img src="'.$val['icon'].'"/></div><div class="jigFliAddedName">'.$val['user_name'].'</div><div class="jigFliAddedRemove">X</div></div>';
					$hidden .= '<div id="fliField'.$val['user_alias'].'">';
					foreach ($val as $k => $v){
						$hidden .= '<input class="jig_fli_field_'.$k.'" type="hidden" name="'.self::SETTINGS_NAME.'['.$id.']['.$val['user_alias'].']['.$k.']" value="'.$v.'" />';
					}
					$hidden .= '</div>';
				} 
			}
			$output .= '</div><div id="jigFliLeft">';
			$output .= '<div id="jigFliWithAppOnly"><div id="jigAddFliUser">'.__('Add a new Flickr user', 'jig_td').'<input type="text" id="jigAddFliUserInput" value="" /></div>';
			$output .= '</div></div><div id="jigFliRight"><div id="jigFliAuthLogWrapper"><div id="jigFliAuthLogTitle">Message log:</div><div id="jigFliAuthLog"></div></div>';
			$output .= '<div id="jigFliAddedHidden" data-name="'.self::SETTINGS_NAME.'['.$id.']">'.$hidden.'</div>';
			$output .= '</div></div>';
			echo $output;
		}

		function jig_print_ig_authed(){
			$id = 'ig_authed';
			$hidden = '';
			$output = '<div id="jigIgWrapper">
							<div id="jigIgLoadingAJAX">
								<div id="jigIgLoadingInner">'.
									__('loading data from Instagram', 'jig_td').
									'<br /><span id="jigIgLoadingInnerSmallText">'.__('please be patient, it takes a moment', 'jig_td').
									'</span>						
									<div id="jigIgIcon"></div>
								</div>
							</div>
							<div id="jigIg">';
			$output .= '<div id="jigIgAuthed" class="jig-clearfix">';
			$output .= '<div id="jigIgAuthedPrototype" class="jigIgAuthedElement"><div class="jigIgAuthedIcon"></div><div class="jigIgAuthedName"></div><div class="jigIgAuthedRemove">X</div></div>';
			if($this->settings[$id] != ''){
				foreach ($this->settings[$id] as $key => $val){
					$expired = '';
					if(isset($val['validity']) && $val['validity'] === 'expired'){
							$expired = ' igExpiredRedAlert';
					}
					
					$output .= '<div id="igAuthed'.$val['id'].'" data-access-token="'.$val['access_token'].'" class="jigIgAuthedElement'.$expired.'"><div class="jigIgAuthedIcon">'.(isset($val['picture']) ? '<img src="'.$val['picture'].'" />' : '').'</div><div class="jigIgAuthedName">'.$val['full_name'].' ('.$val['user_name'].') </div><div class="jigIgAuthedRemove">X</div></div>';
					$hidden .= '<div id="igField'.$val['id'].'">';
					foreach ($val as $k => $v){
						$hidden .= '<input class="jig_ig_field_'.$k.'" type="hidden" name="'.self::SETTINGS_NAME.'['.$id.']['.$val['id'].']['.$k.']" value="'.$v.'" />';
					}
					$hidden .= '</div>';
				} 
			}
			$output .= '</div><div id="jigIgLeft"><div id="jigIgWithAppOnly">';

			$output .= '<a id="jigIgAuthRequest" href="'.admin_url('admin-ajax.php').'?action=jig_ig_auth" target="_blank"><div id="jigIgAuthBtn">'.__('Authorize current Instagram user', 'jig_td').'</div></a>';

			$output .= '<div id="jigIgAuthManualBtn" class="jig_disable">'.__('Manually load Instagram data', 'jig_td').'</div>';
	

			$output .= '</div></div><div id="jigIgRight"><div id="jigIgAuthLogWrapper"><div id="jigIgAuthLogTitle">Message log:</div><div id="jigIgAuthLog"></div></div>';
			$output .= '<div id="jigIgAuthedHidden" data-name="'.self::SETTINGS_NAME.'['.$id.']">'.$hidden.'</div>';
			$output .= '</div></div>';
			echo $output;
		}

		/*
		description of what happens ehere
		a field for key
		a button to extract settings
		a field to get the data

		*/
		function jig_print_wipe_settings(){
			$output = '<div class="jigContextHelp">'.__('This removes all JIG settings from the database and the plugin will start over using the default settings. It clears everything, including your 3rd party image source authorization data, but does not clear caches.', 'jig_td').'</div>';
			$output .= '<div id="jigWipeSettingsButton">'.__('Wipe all settings', 'jig_td').'</div>';
			echo $output;
		}

		
		function jig_print_backup_settings(){
			$output = '';
			$output .= '<div id="jig_backup_settings"><p>'.
				__('If you wish to back up your settings (without caches), you can do so here. You can optionally make your backup encrypted if you supply a key. You will only be able to import with the same key. The key is an arbitrary word like passwords. Encryption can secure your backup as it may include access tokens to image sources like Facebook. Click the button here to backup the settings that you can copy to a document on your computer.', 'jig_td').'</p>'; 
			$output .= '<div class="jigEncryptionKeyContainer"><label for="encryption_key">'.__('Encryption key', 'jig_td').':</label> <input id="encryption_key_backup" name="encryption_key_backup" type="text" value="" /></div>';
			$output .= '<div id="jigSettingsBackupButton">'.__('Generate settings backup', 'jig_td').'</div>';
			$output .= '<textarea cols="40" rows="1" id="jigSettingsBackupText" name="jigSettingsBackupText" ></textarea></div>';
			echo $output;
		}

		function jig_print_import_settings(){
			$output = '';
			$output .= '<div id="jig_import_settings"><p>'.
				__('If you wish to import a previous backup, you can do so here. All your current settings will be replaced with the backup. If your backup was encrypted you can only load it with your key.', 'jig_td').'</p>'; 
			$output .= '<textarea cols="40" rows="1" id="jigSettingsImportText" name="jigSettingsImportText" ></textarea>';
			$output .= '<div class="jigEncryptionKeyContainer"><label for="encryption_key">'.__('Encryption key', 'jig_td').':</label> <input id="encryption_key_import" name="encryption_key_import" type="text" value="" /></div>';
			$output .= '<div id="jigSettingsImportButton">'.__('Import backup', 'jig_td').'</div></div>';
			echo $output;
		}

		// Outputs an empty gallery, used to hide the default WP gallery when JIG is present
		function jig_blank_gallery($output, $attr) {
			return '';
		}

		// Outputs the Justified Image Grid instead of the WP Gallery
		function jig_take_over_gallery_shortcode($attr) {
			$output = '' ;
			if(function_exists('get_jig')){
				$output = get_jig($attr, 'return');
			}
			return $output;
		}

		// This removes NextGEN's style (only on demand)
		function remove_nextgen_styles() {
			wp_deregister_style('NextGEN');
			wp_dequeue_script('photocrati_ajax'); // NG2
		}

		// This prevents NGG resource manager
		function kill_ngg_resource_manager(){
			return false;
		}

		// The following functions take over NextGEN's shortcodes (only on demand), and replace their values to be JIG attributes
		function jig_take_over_nextgen_singlepic_shortcode($attr) {
			$output = '' ;
			if(function_exists('get_jig')){
				if(isset($attr['id'])){
					$output = get_jig(array('ng_pics' => '"'.$attr['id'].'"'), 'return');
				}			}
			return $output;
		}

		function jig_take_over_nextgen_album_shortcode($attr) {
			return $this->jig_take_over_nextgen_nggalbum_shortcode($attr);
		}

		function jig_take_over_nextgen_nggalbum_shortcode($attr) {
			$output = '' ;
			if(function_exists('get_jig')){
				if(isset($attr['id'])){
					$output = get_jig(array('ng_album' => '"'.$attr['id'].'"'), 'return');
				}
			}
			return $output;
		}

		function jig_take_over_nextgen_nggallery_shortcode($attr) {
			$output = '' ;
			if(function_exists('get_jig')){
				if(isset($attr['id'])){
					$output = get_jig(array('ng_gallery' => '"'.$attr['id'].'"'), 'return');
				}	
			}
			return $output;
		}

		function jig_take_over_nextgen_nggtags_shortcode($attr) {
			$output = '' ;
			if(function_exists('get_jig')){
				if(isset($attr['album'])){
					$output = get_jig(array('ng_tags_album' => '"'.$attr['album'].'"'), 'return');
				}
				if(isset($attr['gallery'])){
					$output = get_jig(array('ng_tags_gallery' => '"'.$attr['gallery'].'"'), 'return');
				}
			}
			return $output;
		}

		function jig_take_over_nextgen_random_shortcode($attr) {
			$output = '' ;
			if(function_exists('get_jig')){
				$parameters = array();
				if(isset($attr['max'])){
					$parameters['limit'] = $attr['max'];
				}
				if(isset($attr['id'])){
					$parameters['ng_random_images'] = $attr['id'];
				}else{
					$parameters['ng_random_images'] = 'yes';
				}
				$output = get_jig($parameters, 'return');			}
			return $output;
		}

		function jig_take_over_nextgen_recent_shortcode($attr) {
			$output = '' ;
			if(function_exists('get_jig')){
				$parameters = array();
				$parameters['ng_recent_images'] = 'yes';
				if(isset($attr['max'])){
					$parameters['limit'] = $attr['max'];
				}	
				$output = get_jig($parameters, 'return');
			}
			return $output;
		}

		function jig_take_over_nextgen_ngg_images_shortcode($attr) {
			$output = '' ;
			if(function_exists('get_jig')){
				$parameters = array();
				// mode selections (can't be combined currently)
				if(isset($attr['gallery_ids'])){
					$parameters['ng_gallery'] = $attr['gallery_ids'];
				}elseif(isset($attr['image_ids'])){
					$parameters['ng_pics'] = $attr['image_ids'];
				}elseif(isset($attr['album_ids'])){
					$parameters['ng_album'] = $attr['album_ids'];
				}elseif(isset($attr['tag_ids'])){
					$parameters['ng_tags_gallery'] = $attr['tag_ids'];
				}elseif(isset($attr['source']) && $attr['source'] == 'random'){
					$parameters['ng_random_images'] = 'yes';
				}elseif(isset($attr['source']) && $attr['source'] == 'recent'){
					$parameters['ng_recent_images'] = 'yes_exif';
				}

				// Limit the number of images
				if(isset($attr['images_per_page'])){
					$parameters['limit'] = $attr['images_per_page'];
				}elseif(isset($attr['maximum_entity_count'])){
					$parameters['limit'] = $attr['maximum_entity_count'];
				}


				$output = get_jig($parameters, 'return');
			}
			return $output;
		}

		function jig_filter_ng2_post_inserts($content){
			$content = preg_replace_callback ('%<img\s*?class=.ngg_displayed_gallery.*?nextgen-attach_to_post.*--(\d*?)?".*?/>%m', array($this, 'jig_filter_ng2_post_inserts_preg_callback'), $content);
			return $content;
		}

		function jig_war_rewrite_stubborn_shortcodes($content){
			$content = preg_replace_callback ('/(?<=\[)([a-z_]+?)(?= .*\])/m', array($this, 'jig_war_rewrite_stubborn_shortcodes_preg_callback'), $content);
			return $content;
		}


		function jig_war_rewrite_stubborn_shortcodes_preg_callback($matches){
			if(!empty($matches[1]) && in_array($matches[1], $this->settings['take_over_nextgen']) === true){
				return 'jw_'.$matches[1];
			}
			return $matches[0];
		}
		
		// Takes over NG2's post inserts that appear as an image in the post editor
		// convert them to a JIG shortcode and displays the chosen NG image source
		// supports limit, doesn't support exclusions
		function jig_filter_ng2_post_inserts_preg_callback($matches){
			if(is_numeric($matches[1]) && function_exists('get_jig')){
				$ng_displayed_gallery = get_post($matches[1]);
				if($ng_displayed_gallery->post_type === "displayed_gallery"){
					$attr = $this->jig_ng_unserialize($ng_displayed_gallery->post_content);

					if(!empty($attr['source']) && $attr['source'] == 'albums' && !empty($attr['container_ids'])){
						$parameters['ng_album'] = implode(',',$attr['container_ids']); // albums
					}elseif(!empty($attr['source']) && $attr['source'] == 'albums' && !empty($attr['slug'])){
						$parameters['ng_album'] = $attr['slug']; // only one slug is supported
					}elseif(!empty($attr['source']) && $attr['source'] == 'galleries' && !empty($attr['container_ids'])){
						$parameters['ng_gallery'] = implode(',',$attr['container_ids']); // galleries
					}elseif(!empty($attr['source']) && $attr['source'] == 'galleries' && !empty($attr['slug'])){
						$parameters['ng_gallery'] = $attr['slug']; // only one slug is supported
					}elseif(!empty($attr['source']) && $attr['source'] == 'tags' && !empty($attr['container_ids'])){
						$parameters['ng_tags_gallery'] = '"'.implode(',',$attr['container_ids']).'"'; // double quotes can't be used in tag names
					}elseif(!empty($attr['source']) && $attr['source'] == 'random_images'){
						$parameters['ng_random_images'] = 'yes'; // random
					}elseif(!empty($attr['source']) && $attr['source'] == 'recent_images'){
						$parameters['ng_recent_images'] = 'yes_exif'; // recent
					}


					if(!empty($attr['maximum_entity_count'])){
						$parameters['limit'] = $attr['maximum_entity_count'];
					}elseif(!empty($attr['display_settings']['images_per_page'])){
						$parameters['limit'] = $attr['display_settings']['images_per_page'];
					}
					return get_jig($parameters, 'return');		
				}
			}
			return $matches[0];
		}

		// adds required viewport meta to the head, if enabled
		function jig_add_load_more_device_fix(){
			echo '<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">';
		}

		// returns a number to set feed transiet cache lifetime to
		function jig_set_rss_cache(){
			return $this->rss_cache_override*60;
		}

		// since WP can return a false image size for wp_get_attachment_image_src which is influenced by content_width that themes can set, but JIG needs the physical image size, this callback function for the filter 'editor_max_image_size' helps get the real size
		function jig_bypass_editor_max_image_size(){
			return array($width, $height);
		}

		// Adds force_feed to simplepie
		function jig_add_force_rss($feed,$url){
			$feed->force_feed(true);
		}

		function jig_add_xml_sitemap_images($images, $post_id){
			global $jig_images_for_xml_sitemap;
			$jig_images_for_xml_sitemap = array();

			$return_images_for_sitemap = $images;
			$post_for_xml_sitemap = get_post($post_id);
			remove_all_shortcodes();
			if($this->settings['shortcode_alias'] !== ''){
				add_shortcode($this->settings['shortcode_alias'], array($this, 'jig_init_shortcode_for_xml_sitemap'));
			}
			if($this->settings['shortcode_alias'] !== 'justified_image_grid'){
				add_shortcode('justified_image_grid', array($this, 'jig_init_shortcode_for_xml_sitemap'));
			}
			do_shortcode($post_for_xml_sitemap->post_content);
						
			if(!empty($jig_images_for_xml_sitemap)){
				foreach ($jig_images_for_xml_sitemap as $image_element) {
					$image_data = array();
					$image_data['src'] = $image_element['url'];
					if(!empty($image_element['title'])){
						 $image_data['title'] = $image_element['title'];
					}
					if(!empty($image_element['description'])){
						 $image_data['alt'] = $image_element['description'];
					}elseif(!empty($image_element['caption'])){
						 $image_data['alt'] = $image_element['caption'];
					}elseif(!empty($image_element['alternate'])){
						 $image_data['alt'] = $image_element['alternate'];
					}
					$return_images_for_sitemap[] = $image_data;
	        	}
        	}
			return $return_images_for_sitemap;
		}

		function jig_init_shortcode_for_xml_sitemap($atts){
			$atts['for_xml_sitemap'] = 'yes';
			return $this->jig_init_shortcode($atts);
		}
		// the main function which is attached to a shortcode
		// prints inline CSS and JS + enqueues CSS and JS
		function jig_init_shortcode($atts){
			if($this->settings['take_over_gallery'] === 'hide'){
				remove_shortcode('gallery');
				add_shortcode( 'gallery' , array($this, 'jig_blank_gallery') );
			}

			global $justified_image_grid_instance;
			$justified_image_grid_instance++;
			$jig_id = $justified_image_grid_instance;

			global $post;  
			extract(shortcode_atts(array(
				"preset" => NULL
			), $atts));
			if(isset($preset)){
				$this->settings = array_merge(array_merge($this->defaults, $this->settings_override), $this->presets[$preset]);
			}
			extract(shortcode_atts(array(
				'ids'					=> '',
				'thumbs_spacing'		=> $this->settings['thumbs_spacing'],
				'animation_speed'		=> $this->settings['animation_speed'],			
				'row_height'			=> $this->settings['row_height'],
				'height_deviation'		=> $this->settings['height_deviation'],
				'mobile_row_height'		=> $this->settings['mobile_row_height'],
				'mobile_height_dev'		=> $this->settings['mobile_height_dev'],
				'limit'					=> $this->settings['limit'],
				'hidden_limit'			=> $this->settings['hidden_limit'],
				'load_more'				=> $this->settings['load_more'],
				'load_more_mobile'		=> $this->settings['load_more_mobile'],
				'load_more_limit'		=> $this->settings['load_more_limit'],
				'load_more_text'		=> $this->settings['load_more_text'],
				'load_more_count_text'	=> $this->settings['load_more_count_text'],
				'load_more_auto_width'	=> $this->settings['load_more_auto_width'],
				'max_rows'				=> $this->settings['max_rows'],
				'custom_width'			=> $this->settings['custom_width'],
				'width_mode'			=> $this->settings['width_mode'],
				'last_row'				=> $this->settings['last_row'],
				'aspect_ratio'			=> $this->settings['aspect_ratio'],
				'disable_cropping'		=> $this->settings['disable_cropping'],
				'randomize_width'		=> $this->settings['randomize_width'],
				'link_target'			=> $this->settings['link_target'],
				'orderby'				=> $this->settings['orderby'],
				'filterby'				=> $this->settings['filterby'],
				'filter_style'			=> $this->settings['filter_style'],
				'filter_all_text'		=> $this->settings['filter_all_text'],
				'filter_orderby'		=> $this->settings['filter_orderby'],
				'filter_custom_order'	=> $this->settings['filter_custom_order'],
				'filter_min_count'		=> $this->settings['filter_min_count'],
				'filter_top_x'			=> $this->settings['filter_top_x'],
				'filter_all_button'		=> $this->settings['filter_all_button'],
				'filter_multiple'		=> $this->settings['filter_multiple'],
				'allow_animated_gifs'	=> $this->settings['allow_animated_gifs'],	
				'allow_transp_pngs'=> $this->settings['allow_transp_pngs'],	
				'wrap_text'				=> $this->settings['wrap_text'],	
				'link_class'			=> $this->settings['link_class'],
				'link_rel'				=> $this->settings['link_rel'],	
				'link_title_field'		=> $this->settings['link_title_field'],
				'img_alt_field'			=> $this->settings['img_alt_field'],
				'prettyphoto_social'	=> $this->settings['prettyphoto_social'],
				'prettyphoto_theme'		=> $this->settings['prettyphoto_theme'],
				'prettyphoto_analytics'	=> $this->settings['prettyphoto_analytics'],
				'title_field'			=> $this->settings['title_field'],
				'custom_link_follow'	=> $this->settings['custom_link_follow'],
				'caption_field'			=> $this->settings['caption_field'],
				'caption'				=> $this->settings['caption'],
				'mobile_caption'		=> $this->settings['mobile_caption'],
				'caption_opacity'		=> $this->settings['caption_opacity'],
				'caption_bg_color'		=> $this->settings['caption_bg_color'],
				'caption_match_width'	=> $this->settings['caption_match_width'],
				'caption_text_color'	=> $this->settings['caption_text_color'],
				'caption_height'		=> $this->settings['caption_height'],
				'caption_title_size'	=> $this->settings['caption_title_size'],
				'caption_desc_size'		=> $this->settings['caption_desc_size'],
				'caption_align'			=> $this->settings['caption_align'],
				'v_center_captions'		=> $this->settings['v_center_captions'],
				'custom_fonts'			=> $this->settings['custom_fonts'],
				'caption_text_shadow'	=> $this->settings['caption_text_shadow'],
				'gradient_caption_bg'	=> $this->settings['gradient_caption_bg'],
				'overlay'				=> $this->settings['overlay'],
				'mobile_overlay'		=> $this->settings['mobile_overlay'],
				'overlay_color'			=> $this->settings['overlay_color'],
				'overlay_opacity'		=> $this->settings['overlay_opacity'],
				'overlay_icon'			=> $this->settings['overlay_icon'],
				'overlay_icon_opacity'	=> $this->settings['overlay_icon_opacity'],
				'overlay_icon_url'		=> $this->settings['overlay_icon_url'],
				'overlay_icon_retina'	=> $this->settings['overlay_icon_retina'],
				'outer_shadow'			=> $this->settings['outer_shadow'],
				'inner_shadow'			=> $this->settings['inner_shadow'],
				'outer_border_width'	=> $this->settings['outer_border_width'],
				'outer_border_color'	=> $this->settings['outer_border_color'],
				'middle_border_width'	=> $this->settings['middle_border_width'],
				'middle_border_color'	=> $this->settings['middle_border_color'],
				'inner_border_width'	=> $this->settings['inner_border_width'],
				'inner_border_color'	=> $this->settings['inner_border_color'],
				'inner_border'			=> $this->settings['inner_border'],
				'inner_border_animate'	=> $this->settings['inner_border_animate'],
				'desaturate'			=> '',
				'specialfx'				=> $this->settings['specialfx'],
				'mobile_specialfx'		=> $this->settings['mobile_specialfx'],
				'specialfx_type'		=> $this->settings['specialfx_type'],
				'specialfx_blend'		=> $this->settings['specialfx_blend'],
				'specialfx_options'		=> $this->settings['specialfx_options'],
				'lightbox'				=> $this->settings['lightbox'],
				'mobile_lightbox'		=> $this->settings['mobile_lightbox'],
				'lightbox_max_size'		=> $this->settings['lightbox_max_size'],
				'min_height'			=> $this->settings['min_height'],
				'loading_background'	=> $this->settings['loading_background'],
				'show_text_before'		=> 'yes',
				'show_text_after'		=> 'yes',
				'margin'				=> $this->settings['margin'],
				"retina_ready"			=> $this->settings['retina_ready'],
				'quality'				=> $this->settings['quality'],
				'retina_quality'		=> $this->settings['retina_quality'],
				'timthumb_path'			=> $this->settings['timthumb_path'],
				'use_timthumb'			=> $this->settings['use_timthumb'],
				'mouse_disable'			=> $this->settings['mouse_disable'],
				'disable_mobile_hover'	=> $this->settings['disable_mobile_hover'],			
				'error_checking'		=> $this->settings['error_checking'],		
				'id'					=> $post->ID,
				'nggallery'				=> '',
				'ngalbum'				=> '',
				'ng_gallery'			=> '',
				'ng_album'				=> '',
				'ng_pics'				=> '',
				'ng_tags_gallery'		=> '',
				'ng_tags_album'			=> '',
				'ng_recent_images'		=> '',
				'ng_random_images'		=> '',
				'ng_count'				=> $this->settings['ng_count'],
				'ng_lightbox_gallery'	=> $this->settings['ng_lightbox_gallery'],
				'ng_description'		=> $this->settings['ng_description'],
				'ng_intersect_tags'		=> $this->settings['ng_intersect_tags'],
				'ng_breadcrumb'			=> 'no',
				'ng_bc_separator'		=> 'default',
				'ng_bc_base'			=> 'You are here:',
				'ng_bc_home'			=> 'post_title',
				'ng_bc_home_text'		=> 'Home',
				'ng_bc_home_clickable'	=> 'yes',
				'ng_bc_last_clickable'	=> 'no',
				'ng_bc_top_level'		=> 'yes',
				'ng_bc_add_separator'	=> 'no',
				'nextgen_cf_link'		=> $this->settings['nextgen_cf_link'],
				'exclude'				=> '',
				'include'				=> '',
				'image_tags'			=> '',
				'image_categories'		=> '',
				'facebook_id'			=> '',
				'facebook_album'		=> '',
				'facebook_image_size'	=> $this->settings['facebook_image_size'],
				'facebook_caching'		=> $this->settings['facebook_caching'],
				'fb_lightbox_album'		=> $this->settings['fb_lightbox_album'],
				'fb_breadcrumb'			=> 'yes',
				'fb_bc_separator'		=> 'default',
				'fb_bc_home_text'		=> '',
				'flickr_user'			=> '',
				'flickr_photostream'	=> '',
				'flickr_favorites'		=> '',
				'flickr_group'			=> '',
				'flickr_photoset'		=> '',
				'flickr_gallery'		=> '',
				'flickr_caching'		=> $this->settings['flickr_caching'],
				'instagram_feed'		=> '',
				'instagram_recents'		=> '',
				'instagram_liked'		=> '',
				'instagram_tag'			=> '',
				'instagram_location'	=> '',
				'instagram_tag_filter'	=> '',
				'instagram_caching'		=> $this->settings['instagram_caching'],
				'instagram_link'		=> $this->settings['instagram_link'],
				'rss_url'				=> '',
				'rss_links_to'			=> $this->settings['rss_links_to'],
				'rss_description'		=> $this->settings['rss_description'],
				'rss_excerpt_length'	=> $this->settings['rss_excerpt_length'],
				'rss_excerpt_ending'	=> $this->settings['rss_excerpt_ending'],
				'rss_link'				=> $this->settings['rss_link'],
				'rss_link_text'			=> $this->settings['rss_link_text'],
				'rss_caching'			=> $this->settings['rss_caching'],
				'developer_link'		=> $this->settings['developer_link'],
				'download_link'			=> $this->settings['download_link'],
				'flickr_link'			=> $this->settings['flickr_link'],
				'recent_posts'			=> 'no',
				'post_ids'				=> '',
				'post_ids_exclude'		=> '',
				'recents_description'	=> 'nothing',
				'recents_exclude'		=> '',
				'recents_include'		=> '',
				'recents_tags'			=> '',
				'recents_filter_tax'	=> '',
				'recents_filter_term'	=> '',
				'recents_placeholder'	=> '',
				'recents_post_type'		=> 'post',
				'recents_link_to'		=> 'post',
				'recents_link'			=> 'no',
				'recents_link_text'		=> 'Read more',
				'recents_custom_links'	=> 'no',
				'recents_sticky'		=> '',
				'excerpt_length'		=> 20,
				'excerpt_ending'		=> ' [...]',
				'author_prefix'			=> 'by ',
				'recents_parent_id' 	=> '',
				'recents_tree_depth' 	=> '',
				'for_xml_sitemap'		=> 'no'
			), $atts));

			$notice_before = '';
			$notice_after = '';
	
			if($this->settings['text_before'] !== '' && $show_text_before === 'yes'){
				$notice_before .= $this->settings['text_before'];
			}
			if($this->settings['text_after'] !== '' && $show_text_after === 'yes'){
				$notice_after .= $this->settings['text_after'];
			}

			if($mobile_row_height !== '' || $mobile_height_dev !== ''){
				if(!class_exists("Mobile_Detect")){
					include 'mobiledetect.php';
				}			
				$detect = new Mobile_Detect();
				if($detect->isMobile()){
					$row_height = $mobile_row_height !== '' ? $mobile_row_height : $row_height;
					$height_deviation = $mobile_height_dev !== '' ? $mobile_height_dev : $row_height;
				}
			}


			$this->max_height = $max_height = $row_height+$height_deviation;

			$photon_activated = class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'photon', Jetpack::get_active_modules() ) && function_exists( 'jetpack_photon_url' );
			$carousel_activated = $lightbox == 'carousel' && class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'carousel', Jetpack::get_active_modules() ) && class_exists( 'Jetpack_Carousel' );
			if($lightbox == 'carousel' && $carousel_activated === false){
				$lightbox = 'prettyphoto';
			}

			if($filterby !== 'off'){
				global $justified_image_grid_filtering_css_needed;
				$justified_image_grid_filtering_css_needed = true;
			}

			$gallery_type = 'wp_post_gallery';
			if($hidden_limit) {
				$real_limit = $limit;
				$limit = $hidden_limit;
			}
			if($nggallery !== '' && $ng_gallery == ''){
				$ng_gallery = $nggallery;
			}
			if($ngalbum !== '' && $ng_album == ''){
				$ng_album = $ngalbum;
			}
			if($id != $post->ID){
				$gallery_type = 'wp_post_gallery';
			}elseif($recent_posts === 'yes'){
				$gallery_type = 'wp_recent_posts';
			}elseif($ng_gallery !== '' || $ng_album !== '' || $ng_pics !== '' || $ng_tags_gallery !== '' || $ng_tags_album !== '' || $ng_recent_images !== '' || $ng_random_images !== ''){
				$gallery_type = 'nextgen';
			}elseif($facebook_id && $facebook_album){
				$gallery_type = 'facebook';
			}elseif($flickr_photostream !== ''
				|| $flickr_favorites !== ''
				|| ($flickr_user !== '' 
					&& ($flickr_group !== ''
						|| $flickr_photoset !== ''
						|| $flickr_gallery !== ''))){
				$gallery_type = 'flickr';
			}elseif($instagram_feed !== ''
				|| $instagram_recents !== ''
				|| $instagram_liked !== ''
				|| $instagram_tag !== ''
				|| $instagram_location !== ''){
				$gallery_type = 'instagram';
			}elseif($rss_url !== ''){
				$gallery_type = 'rss';
			}

			if($for_xml_sitemap === 'yes' && ($gallery_type === 'flickr' || $gallery_type ==='facebook' || $gallery_type === 'instagram' || $gallery_type === 'rss')){
				return;
			}

			if($lightbox == 'carousel' && $gallery_type !== "wp_post_gallery" && $gallery_type !== "wp_recent_posts"){
				$lightbox = 'prettyphoto';
			}

			$disable_hover = 'no';
			if($mobile_lightbox !== 'no'
				|| $mobile_caption !== 'same'
				|| $mobile_overlay !== 'same'
				|| $mobile_specialfx !== 'same'
				|| $disable_mobile_hover !== 'no'
				|| $load_more_mobile == 'yes'
				){
				if(!class_exists("Mobile_Detect")){
					include 'mobiledetect.php';
				}			
				$detect = new Mobile_Detect();
				if ($detect->isMobile()) {
					if($mobile_lightbox !== 'no'){
						$lightbox = $mobile_lightbox;
					}
					if($mobile_caption !== 'same'){
						$caption = $mobile_caption;
					}
					if($mobile_overlay !== 'same'){
						$overlay = $mobile_overlay;
					}
					if($mobile_specialfx !== 'same'){
						$specialfx = $mobile_specialfx;
					}
					if($disable_mobile_hover !== 'no'){
						$disable_hover = $disable_mobile_hover;
					}
					if($this->settings['jquery_mobile'] == 'yes' && $link_rel == 'auto'){
						$link_rel .= ' external';
					}
				}elseif($load_more_mobile == 'yes'){
					$load_more = 'off';
				}
			}
			switch($gallery_type){
				case 'wp_post_gallery':
					add_filter('editor_max_image_size', array($this, 'jig_bypass_editor_max_image_size'));
					$order = 'ASC';
					switch($orderby){
						case 'title_asc':
							$orderby = 'title';
						break;
						case 'title_desc':
							$orderby = 'title';
							$order = 'DESC';
						break;
						case 'date_desc':
							$orderby = 'date';
							$order = 'DESC';
						break;
						case 'date_asc':
							$orderby = 'date';
						break;
						case 'custom':
							$orderby = 'menu_order';
						break;
						default:
					}
					if($limit === '' || $limit === '0'){
						$limit = -1;
					}
					// 'featured' word gets replaced with actual ID
					$exclude = str_replace('featured', get_post_thumbnail_id( $post->ID ), $exclude); 
					if($ids !== ''){ // if there is a list of image ids
						if($orderby === 'menu_order'){
							$orderby = 'post__in';
						}
						$args = array(
							'include' => $ids,
							'post_status' => 'inherit',
							'post_type' => 'attachment',
							'post_mime_type' => 'image',
							'order' => $order,
							'orderby' => $orderby
						); 
						$attachments = get_posts($args); // Fetch the images with a WP query
						if($orderby == 'rand'){
							$attachments = (array) $attachments;
							shuffle($attachments);
						}
						if($limit !== -1){
							$attachments = array_slice($attachments, 0, $limit);
						}
					}elseif($image_tags !== '' || $image_categories !== ''){
						$image_tags = str_replace (' ', '-', str_replace (', ', ',', $image_tags));
						$image_categories = str_replace (' ', '-', str_replace (', ', ',', $image_categories));
						$attachment_tax = get_object_taxonomies('attachment');
						if(empty($attachment_tax)){
							return __('Category or tag filtering for images is not enabled!', 'jig_td');
						}else if(in_array("attachment_category", $attachment_tax) && in_array("attachment_tag", $attachment_tax)){
							$args = array(
								'post_type'				=> 'attachment',	// get attachments  
								'post_mime_type'		=> 'image',			// but only images (partial mime type),
								'order'					=> $order,			// in ascending/descending order of
								'orderby'				=> $orderby,		// the set or the default: menu order (this is the order you set up with drag n drop, it IS available for image attachments)
								'post_status'			=> null, 			// for any status. 
								'exclude'				=> $exclude,
								'include'				=> $include,
								'numberposts'			=> $limit,
								'attachment_category'	=> $image_categories,
								'attachment_tag'		=> $image_tags
							); 
							$attachments = get_posts($args); // Fetch the images with a WP query
						}else{
							$args = array(
								'post_type'			=> 'attachment',	// get attachments  
								'post_mime_type'	=> 'image',			// but only images (partial mime type),
								'order'				=> $order,			// in ascending/descending order of
								'orderby'			=> $orderby,		// the set or the default: menu order (this is the order you set up with drag n drop, it IS available for image attachments)
								'post_status'		=> null, 			// for any status. 
								'exclude'			=> $exclude,
								'include'			=> $include,
								'numberposts'		=> $limit,
								'category_name'		=> $image_categories,
								'tag'				=> $image_tags
							); 
							$attachments = get_posts($args); // Fetch the images with a WP query
						}
						if(empty($attachments)){
							return __('No images found for your category or tag filters!', 'jig_td');
						}
					}elseif(strpos ($id, ',') === false){ // If only one post's attached images are to be fetched
						if($include === ''){
							// build the image list json object for JS
							$args = array(
								'post_parent'		=> $id,				// From this or that post,
								'post_type'			=> 'attachment',	// get attachments  
								'post_mime_type'	=> 'image',			// but only images (partial mime type),
								'order'				=> $order,			// in ascending/descending order of
								'orderby'			=> $orderby,		// the set or the default: menu order (this is the order you set up with drag n drop, it IS available for image attachments)
								'post_status'		=> null, 			// for any status. 
								'exclude'			=> $exclude,
								'include'			=> $include,
								'numberposts'		=> $limit
							); 
							$attachments = get_posts($args); // Fetch the images with a WP query
						}else{ // No post ID when include is used
							// build the image list json object for JS
							$args = array(
								'post_type'			=> 'attachment',	// get attachments  
								'post_mime_type'	=> 'image',			// but only images (partial mime type),
								'order'				=> $order,			// in ascending/descending order of
								'orderby'			=> $orderby,		// the set or the default: menu order (this is the order you set up with drag n drop, it IS available for image attachments)
								'post_status'		=> null, 			// for any status. 
								'include'			=> $include,
								'numberposts'		=> $limit
							); 
							$attachments = get_posts($args); // Fetch the images with a WP query
						}
					}elseif($id !== ''){ // If images from multiple posts are to be fetched
						$ids = explode(',', $id);
						$attachments = array();
						foreach($ids as $this_id){
							$args = array(
								'post_parent'		=> $this_id,		// From this or that post,
								'post_type'			=> 'attachment',	// get attachments  
								'post_mime_type'	=> 'image',			// but only images (partial mime type),
								'order'				=> $order,			// in ascending/descending order of
								'orderby'			=> $orderby,		// the set or the default: menu order (this is the order you set up with drag n drop, it IS available for image attachments)
								'post_status'		=> null, 			// for any status. 
								'exclude'			=> $exclude,
								'include'			=> $include,
								'numberposts'		=> $limit
							); 
							$attachments = array_merge($attachments, get_posts($args));
						}
						if($orderby == 'rand'){
							$attachments = (array) $attachments;
							shuffle($attachments);
						}
						if($limit > 0){
							$attachments = array_slice($attachments, 0, $limit);
						}
					}
					if ($attachments){ // If there are images attached to the post 
						$this->images = $url_hash_list = array(); // Create a new array for the images
						foreach ($attachments as &$attachment){ // Loop through each
							$image = $this->jig_wp_get_attachment_image_src($attachment->ID, $lightbox_max_size);
							if(!$image[1] || !$image[2]){
								$question_mark_in_url = strpos($image[0],'?');
								if($question_mark_in_url !== false){
									$image[3] = substr($image[0], 0, $question_mark_in_url);
									$url_hash_list[] = hash('md5',$image[3]);	
								}else{
									$url_hash_list[] = hash('md5',$image[0]);
								}
									
							}
							$attachment->jig_image_src = $image;
						}
						unset($attachment);
						// this prepopulates wp_cache with the dimensions, if found
						if(!$this->jig_query_ext_images($url_hash_list)){
							$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
						}
						
						foreach ($attachments as $attachment){ // Loop through each
							$image = $attachment->jig_image_src; // Get URL [0], width [1], and height [2]

							if(!$image[1] || !$image[2]){// If any of the dimensions are not a normal value
								$image = $this->jig_get_ext_imagesize($image);
							}
							if(!$image[1] || !$image[2]){
								continue;
							}

							$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
							$data['url'] = $image[0]; // Store the full URL value		
							$data['width'] = $image[1]/$image[2]*$max_height; // Calculate new width of TimThumb by getting the ratio and multiplying it with the set row height
							// Get title
							$d['title'] =  esc_attr(stripslashes($attachment->post_title));
							if($d['title'] != '') $data['title'] = $d['title'];
							// Get caption
							$d['caption'] =  esc_attr(stripslashes($attachment->post_excerpt));
							if($d['caption'] != '') $data['caption'] = $d['caption'];
							// Get description
							$d['description'] =  esc_attr(stripslashes($attachment->post_content));
							if($d['description'] != '') $data['description'] = $d['description'];
							// Get alternate
							$d['alternate'] =  esc_attr(stripslashes(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true)));
							if($d['alternate'] != '') $data['alternate'] = $d['alternate'];
							// Get link
							$d['link'] = esc_attr(stripslashes(get_post_meta($attachment->ID, '_jig_image_link', true)));
							if($d['link'] != '') {
								$data['link'] = $d['link'];
								// Get link target
								$meta_link_target = get_post_meta($attachment->ID, '_jig_image_link_target', true);
								if($meta_link_target !== '' && $meta_link_target !== 'default'){
									$data['link_target'] = $meta_link_target;
								}else{
									$data['link_target'] = $link_target;
								}
								$d['link_rel'] = array();
								if($data['link_target'] == '_blank'){
									$d['link_rel'][] = 'external';
								}
								if($custom_link_follow == 'no'){
									$d['link_rel'][] = 'nofollow';
								}
								$d['link_rel_imploded'] = implode(' ',$d['link_rel']);
								if($d['link_rel_imploded'] != '') $data['link_rel'] = $d['link_rel_imploded'];
							}else if($lightbox == 'attachment'){
								$data['link'] = get_attachment_link( $attachment->ID);
							}
							if($download_link != 'no'){
								$download_src = $this->jig_wp_get_attachment_image_src($attachment->ID, 'full');
								$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$download_src[0].'">'.$this->settings['download_link_text'].'</a>'));
							}
					
							if($carousel_activated){
								$data['carousel_data'] = $this->jig_add_carousel_data($attachment->ID, $link_title_field, $img_alt_field);
							}
							if($filterby == 'on'){
								$filterby = 'post_tag';
							}
							if($filterby !== 'off' && taxonomy_exists($filterby)){
								$d['filters'] = wp_get_object_terms($attachment->ID,$filterby);
								if(!empty($d['filters'])){
									foreach ($d['filters'] as $filter_term) {
										$data['filters'][] = array($filter_term->slug,$filter_term->name);
									}
								}
							}
							// Add to the main images array
							array_push($this->images, $data); 
						}
					}else{
						return sprintf(__('There are no photos with those IDs or post %1$s does not have any attached images!', 'jig_td'),$id);
					}
					remove_filter('editor_max_image_size', array($this, 'jig_bypass_editor_max_image_size'));
				break;
				case 'wp_recent_posts':
					add_filter('editor_max_image_size', array($this, 'jig_bypass_editor_max_image_size'));
					$order = 'ASC';
					switch($orderby){
						case 'menu_order':
							$orderby_original = 'menu_order';
						case 'date_desc':
							$orderby = 'date';
							$order = 'DESC';
						break;
						case 'title_asc':
							$orderby = 'title';
						break;
						case 'title_desc':
							$orderby = 'title';
							$order = 'DESC';
						break;
						case 'date_asc':
							$orderby = 'date';
						break;
						case 'custom':
							$orderby = 'menu_order';
							$order = 'DESC';
						break;
						default:
					}
					if($limit === ''){
						$limit = 50;
					}else if($limit === '0'){
						$limit = -1;
					}
					$cat = '';
					$tag = '';
					if($recents_exclude != ''){
						$recents_exclude = explode(',',str_replace (' ', '-', str_replace (', ', ',', $recents_exclude)));
						foreach ($recents_exclude as &$recents_exclude_cat) {
							if(!is_numeric($recents_exclude_cat)){
 								 $recents_exclude_cat = get_category_by_slug($recents_exclude_cat)->term_id;
							}
							$recents_exclude_cat = "-".$recents_exclude_cat;
						}
						$cat = implode(',',$recents_exclude);
					}elseif($recents_include != ''){
						$recents_include = explode(',',str_replace (' ', '-', str_replace (', ', ',', $recents_include)));
						foreach ($recents_include as &$recents_include_cat) {
							if(!is_numeric($recents_include_cat)){
 								 $recents_include_cat = get_category_by_slug($recents_include_cat)->term_id;
							}
						}
						$cat = implode(',',$recents_include);
					}
					if($recents_tags != ''){
						$tag = str_replace (' ', '-', str_replace (', ', ',', $recents_tags));
					}
					if($recents_tree_depth === '' || $recents_tree_depth === 0 || !is_numeric($recents_tree_depth)){
						$recents_tree_depth = 10;
					}
					$posts = array();
					$args = array(
						'post_type'			=> (strpos($recents_post_type,',') === false ? $recents_post_type : explode(',', $recents_post_type)),
						'order' 			=> $order,
						'orderby' 			=> $orderby,
						'post_status'		=> 'publish',
						'category'			=> $cat,
						'tag'				=> $tag,
						'numberposts'		=> $limit,
						'ignore_sticky_posts' => 1
					);
					if($recents_placeholder === ''){
						$args['meta_key'] = '_thumbnail_id';
					}
					if($post_ids !== ''){ // Regular recent posts call when the results are automatic, depending on settings
						$args['post__in'] = explode(',',$post_ids);
						if(isset($orderby_original)){
							$args['orderby'] = 'post__in';
						}
					}elseif($post_ids_exclude !== ''){ // Regular recent posts call when the results are automatic, depending on settings
						global $post;
						$post_ids_exclude = str_replace('current', $post->ID, $post_ids_exclude); 
						$args['post__not_in'] = explode(',',$post_ids_exclude);
					}
					if($recents_sticky === 'yes'){
						$args['post__in'] = get_option('sticky_posts');
					}elseif($recents_sticky === 'no'){
						unset($args['post__in']);
						$args['post__not_in'] = get_option('sticky_posts');
					}
					if($recents_filter_tax !== 'none' && !empty($recents_filter_term)){
						// this is the proper way to query for posts using a specific taxonomy
						$args['tax_query'] = array(
												array(
													'taxonomy' => $recents_filter_tax,
													'field' => 'slug',
													'terms' => str_replace (' ', '-', str_replace (', ', ',', $recents_filter_term))
												)
											);
					}
					if($recents_parent_id === ''){
						$posts = get_posts($args);
					}else{
						$args['post_parent'] = $recents_parent_id;
						$posts = $this->get_recents_recursive($args,$recents_tree_depth,0);
					}
					if($orderby == 'rand'){
						$posts = (array) $posts;
						shuffle($posts);
					}
					if ($posts){ // If there are images attached to the post  
						$this->images = $url_hash_list = array(); // Create a new array for the images
						foreach ($posts as &$post){ // Loop through each
							$post_thumbnail_id = get_post_thumbnail_id($post->ID);
							$image = $this->jig_wp_get_attachment_image_src($post_thumbnail_id, $lightbox_max_size);
							if($image == false && !empty($post_thumbnail_id) && class_exists('nggdb')){
								global $wpdb;
								$nggID = substr($post_thumbnail_id,4);
								$nggImage = $this->jig_ng_find_images($nggID,true);	
								if(!empty($nggImage)){
									$image = array();
									$image[0] = $nggImage->imageURL;
									$image[1] = $nggImage->meta_data['width'];
									$image[2] = $nggImage->meta_data['height'];
								}
							}
							if($image == false && $recents_placeholder !== ''){
								$image[0] = $recents_placeholder;
							}
							if(!$image[1] || !$image[2]){
								$url_hash_list[] = hash('md5',$image[0]);									
							}
							$post->jig_image_src = $image;
						}
						unset($post, $post_thumbnail_id);

						// this prepopulates wp_cache with the dimensions, if found
						if(!$this->jig_query_ext_images($url_hash_list)){
							$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
						}
						

						foreach ($posts as $post){ // Loop through each
							$image = $post->jig_image_src; // Get URL [0], width [1], and height [2]

							if(!$image[1] || !$image[2]){// If any of the dimensions are not a normal value
								$image = $this->jig_get_ext_imagesize($image);
							}
							if(!$image[1] || !$image[2]){
								continue;
							}

							$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed

							$data['url'] = $image[0]; // Store the full URL value		
							$data['width'] = $image[1]/$image[2]*$max_height; // Calculate new width of TimThumb 
							// Get title
							$d['title'] =  esc_attr(stripslashes($post->post_title));
							if($d['title'] != '') $data['title'] = $d['title'];
							// Get description
							switch($recents_description){
								case 'categories':
									$d['description'] = implode(", ", wp_get_post_categories( $post->ID , array('fields' => 'names')));
								break;
								case 'tags':
									$d['description'] = implode(", ", wp_get_post_tags( $post->ID , array('fields' => 'names')));
								break;
								case 'auto_excerpt':
									$d['description'] = $this->jig_the_excerpt($post, $excerpt_length, $excerpt_ending);
								break;
								case 'manual_excerpt':
									$d['description'] = esc_attr(stripslashes($post->post_excerpt));
								break;
								case 'auto_manual_excerpt':
									$d['description'] = esc_attr(stripslashes($post->post_excerpt));
									if($d['description'] == ''){
										$d['description'] = $this->jig_the_excerpt($post, $excerpt_length, $excerpt_ending);
									}
								break;
								case 'datetime':
									$d['description'] = date(get_option('date_format').' '.get_option('time_format'), strtotime($post->post_date)); 
								break;
								case 'date':
									$d['description'] = date(get_option('date_format'), strtotime($post->post_date)); 
								break;
								case 'nicetime':
									$d['description'] = $this->jig_nice_time($post->post_date);
								break;
								case 'author':
									if($author_prefix !== 'none'){
										$d['description'] = $author_prefix.get_userdata($post->post_author)->user_login;
									}else{
										$d['description'] = get_userdata($post->post_author)->user_login;
									}
									
								break;
								default:
								$d['description'] = '';
							}
							if($d['description'] != '') $data['description'] = esc_attr($d['description']);
							switch ($recents_link_to) {
								case 'post':
									// Get link
									$data['link'] = esc_attr(stripslashes(get_permalink($post->ID)));
									// Get link target
									$data['link_target'] = $link_target;
									break;
								case 'attachment':
									$data['link'] = get_attachment_link(get_post_thumbnail_id($post->ID));
									if(isset($meta_data)){
										$data['link'] = $data['url'];
									}
									break;
								case 'image':
								default:
									if($download_link != 'no'){
										$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
									}
									if($recents_link != 'no'){
										$data['lightbox_link'] = esc_attr(stripslashes('<a href="'.esc_attr(stripslashes(get_permalink($post->ID))).'" >'.$recents_link_text.'</a>'));
									}
									if($carousel_activated){
										$data['carousel_data'] = $this->jig_add_carousel_data($attachment->ID, $link_title_field, $img_alt_field);
									}
							}
							if($recents_custom_links == 'yes'){
								$d['link'] = esc_attr(stripslashes(get_post_meta(get_post_thumbnail_id($post->ID), '_jig_image_link', true)));
								if($d['link'] != '') {
									$data['link'] = $d['link'];
									// Get link target
									$meta_link_target = get_post_meta(get_post_thumbnail_id($post->ID), '_jig_image_link_target', true);
									if($meta_link_target !== '' && $meta_link_target !== 'default'){
										$data['link_target'] = $meta_link_target;
									}else{
										$data['link_target'] = $link_target;
									}
									$d['link_rel'] = array();
									if($data['link_target'] == '_blank'){
										$d['link_rel'][] = 'external';
									}
									if($custom_link_follow == 'no'){
										$d['link_rel'][] = 'nofollow';
									}
									$d['link_rel_imploded'] = implode(' ',$d['link_rel']);
									if($d['link_rel_imploded'] != '') $data['link_rel'] = $d['link_rel_imploded'];
								}
							}
							if(isset($post->recents_class)){
								$data['recents_class'] = $post->recents_class;
							}
							if($filterby == 'on'){
								$filterby = 'post_tag';
							}
							if($filterby !== 'off' && taxonomy_exists($filterby)){
								$d['filters'] = wp_get_object_terms($post->ID,$filterby);
								if(!empty($d['filters'])){
									foreach ($d['filters'] as $filter_term) {
										if($filter_term->slug !== 'uncategorized' ){
											$data['filters'][] = array($filter_term->slug,$filter_term->name);
										}
									}
								}
							}

							// Add to the main images array
							array_push($this->images, $data); 

						}
					}else{
						return sprintf(__('There are no recent posts with featured images.', 'jig_td'),$id);
					}
					remove_filter('editor_max_image_size', array($this, 'jig_bypass_editor_max_image_size'));
				break;
				case 'nextgen':
					if(!class_exists('nggGallery')){
						return __('NextGEN gallery is not installed/inactive!', 'jig_td');
					}
					$ngg_options = nggGallery::get_option('ngg_options');
					$ngg_options['galSort'] = ($ngg_options['galSort']) ? $ngg_options['galSort'] : 'pid';
					$ngg_options['galSortDir'] = ($ngg_options['galSortDir'] == 'DESC') ? 'DESC' : 'ASC';
					if(class_exists('C_NextGEN_Bootstrap')){
						$this->ng_version = 2;
					}else{
						$this->ng_version = 1;
					}
					$original_nextgen_limit = $limit;
					if($limit === '' || $limit === "0"){
						$limit = 1000;
					}
					if($ng_album !== ''){
						$ng_bc_home_album = $ng_album;					
					}
					global $wpdb, $jigNgConnect;
					$ng_gallerytag = false;
					if(!isset($jigNgConnect)){
						if($this->jig_ng_get_query_var('gallery') !== ''){
							$ng_gallery = $this->jig_ng_get_query_var('gallery'); // Doesn't matter if it's ID or slug
							$ng_album = '';
							$jigNgConnect = true;
						}else if($this->jig_ng_get_query_var('album') !== ''){
							$ng_album = $this->jig_ng_get_query_var('album'); // It's best if the album value is always an ID
							if(!is_numeric($ng_album)){
								$ng_album = $wpdb->get_var($wpdb->prepare("SELECT id FROM $wpdb->nggalbum WHERE slug = %s",$ng_album));
								if(empty($ng_album)){
									$ng_album = '';
								}
							}
							$ng_gallery = '';
							if($ng_album !== ''){
								$jigNgConnect = true;
							}
						}else if($this->jig_ng_get_query_var('gallerytag') !== ''){
							$ng_gallerytag = $this->jig_ng_get_query_var('gallerytag'); // Doesn't matter if it's ID or slug
							$ng_gallery = '';
							$ng_album = '';
							$jigNgConnect = true;
						    $ng_tags_gallery = $ng_gallerytag;
						}
					}else{
						return; // Another instance is serving the gallery from the URL parameters
					}
				   	
														
					if($ng_gallery !== ''){ // If a gallery is displayed
						$ng_gallery = str_replace(' ', '',$ng_gallery);
						$images = $this->jig_ng_get_galleries($ng_gallery, $ngg_options['galSort'], $ngg_options['galSortDir'], true, $limit);

						if(empty($images)){
							return sprintf(__('The NextGEN gallery with ID/slug: %1$s does not exist or is empty.', 'jig_td'),$ng_gallery);
						}

						if(!empty($images)){
							$this->images = $url_hash_list = array(); // Create a new array for the images
							foreach ($images as &$image) {
								if(!$image->meta_data['width'] || !$image->meta_data['height']){
									$url_hash_list[] = hash('md5',$image->imageURL);		
								}
								$image->jig_image_src = array($image->imageURL,$image->meta_data['width'],$image->meta_data['height']);
							}
							unset($image);
							// this prepopulates wp_cache with the dimensions, if found
							if(!$this->jig_query_ext_images($url_hash_list)){
								$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
							}
							if($orderby == 'rand'){
								$images = (array) $images;
								shuffle($images);
							}
							foreach ($images as $image) {
								if(!$image->jig_image_src[1] || !$image->jig_image_src[2]){// If any of the dimensions are not a normal value
									$image->jig_image_src = $this->jig_get_ext_imagesize($image->jig_image_src);
								}
								$image->meta_data['width'] = $image->jig_image_src[1];
								$image->meta_data['height'] = $image->jig_image_src[2];

								if($image->meta_data['width'] != 0 && $image->meta_data['height'] != 0){// If none of the dimensions are 0
									$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
									$data['url'] = $image->imageURL;
									$data['width'] = $image->meta_data['width']/$image->meta_data['height']*$max_height; // Calculate new width of TimThumb
									$d['title'] = esc_attr(stripslashes(nggGallery::i18n($image->alttext, 'pic_' . $image->pid . '_alttext')));
									if($d['title'] != '') $data['title'] = $d['title'];
									$d['description'] = esc_attr(stripslashes(nggGallery::i18n($image->description, 'pic_' . $image->pid . '_description')));

									//$d['description'] = ucwords(implode(', ', wp_get_object_terms($image->pid,'ngg_tag',array('fields' => 'names'))));

									if($d['description'] != '') $data['description'] = $d['description'];

									if($download_link != 'no'){
										$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
									}
									if(isset($image->ng_cf_link)){
										$data['link'] = $image->ng_cf_link;
										$data['link_target'] = $link_target;
									}
									if($filterby == 'on'){
										$d['filters'] = wp_get_object_terms($image->pid,'ngg_tag');
										if(!empty($d['filters'])){
											foreach ($d['filters'] as $filter_term) {
												$data['filters'][] = array($filter_term->slug,$filter_term->name);
											}
										}
									}
									if($ng_description == 'yes'){
										$ng_description = 'no';
										if($image->galdesc){
											$notice_before .= '<p class="jig-ngDescription">'.$image->galdesc.'</p>';
										}
									}
									array_push($this->images, $data); 
								}
							}
						}
					}else if($ng_album !== ''){ // If an album (or overview album) is displayed
						$albums = $wpdb->get_results("SELECT * FROM $wpdb->nggalbum");

						if(!empty($albums)){
							foreach($albums as $val){
								wp_cache_set($val->id, $val, 'jig_ng_albums');
							}
						}
						$album = $this->jig_ng_get_album($ng_album,$ngg_options['galSort'], $ngg_options['galSortDir']);
						if(!empty($album)){
							if($album->content_ids){
								if($ng_description == 'yes'){
									$ng_description = 'no';
									if($album->albumdesc){
										$notice_before .= '<p class="jig-ngDescription">'.$album->albumdesc.'</p>';
									}
								}
								$album_contents = $album->content_ids;
								if(!empty($album_contents)){
									$photo_count_by_gallery_id = array();
									if($album->id == 'all'){
										$album->slug = $album->id;
									}
									$album_contents_imploded = "'".implode("','",$album_contents)."'";
									$picturesCounter = $wpdb->get_results("SELECT galleryid, COUNT(*) as counter FROM $wpdb->nggpictures WHERE galleryid IN ( $album_contents_imploded ) AND exclude != 1 GROUP BY galleryid", OBJECT_K);
									if(!empty($picturesCounter)){
										foreach ($picturesCounter as $key => $value)
											$photo_count_by_gallery_id[$key] = $value->counter;
									}
									$this->images = $shadow_galleries = array();
									$counter = 0;
									if($orderby == 'rand'){
										$album_contents = (array) $album_contents;
										shuffle($album_contents);
									}
									foreach ($album_contents as $album_content) {
										// $album content can be a gallery on an album
										if(++$counter > $limit){
											break;
										}
										if(substr($album_content, 0, 1) != "a"){ // If it's a gallery
											$image = $this->ng_find_cover_image_for_gallery($album_content); // pass the gallery ID and get back a representative image that is processed
											if(!empty($image)){
												if($ng_lightbox_gallery == 'yes'){ // If gallery should be displayed as a lightbox
													$lightbox_images = $this->jig_ng_get_galleries($album_content, $ngg_options['galSort'], $ngg_options['galSortDir'], true, $limit);
													if(!empty($lightbox_images)){

														$shadow_galleries[] = $shadow_group_id = 'jigHiddenGalleryGroup-'.$album_content;
														$shadow_gallery = '<div class="jigHiddenGallery">';
														switch($lightbox){
															case 'prettyphoto':
															$shadow_rel = 'prettyPhoto[ngg-'.$album_content.']';
															break;
															case 'colorbox':
															$shadow_rel = 'colorBox[ngg-'.$album_content.']';
															break;
															default:
															$shadow_rel = 'ngg['.$album_content.']';
															break;
														}		
														foreach ($lightbox_images as $lightbox_image) {
															// Skip image from the hidden gallery if it's the same as the opener image
															if($lightbox_image->filename == $image->filename){
																continue;
															}

															$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
															$data['url'] = $lightbox_image->imageURL;
															$d['title'] = esc_attr(stripslashes(nggGallery::i18n($lightbox_image->alttext, 'pic_' . $lightbox_image->pid . '_alttext')));
															$d['description'] = esc_attr(stripslashes(nggGallery::i18n($lightbox_image->description, 'pic_' . $lightbox_image->pid . '_description')));
															$title_fragment = isset($d[$link_title_field]) ? $d[$link_title_field] : '';
															$alt_fragment = isset($d[$img_alt_field]) ? $d[$img_alt_field] : '';

															if($download_link != 'no'){
																$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
																if($download_link == 'yes'){
																	if($title_fragment !== ''){
																		$title_fragment .= ' - '.$data['download'];
																	}else{
																		$title_fragment = $data['download'];
																	}
																}else{
																	if($alt_fragment !== ''){
																		$alt_fragment .= ' - '.$data['download'];
																	}else{
																		$alt_fragment = $data['download'];
																	}
																}
															}

															$shadow_gallery .= '<a href="'.$data['url'].'" rel="'.$shadow_rel.'" title="'.$title_fragment.'" class="jig-link"><img src="data:image/gif;base64,R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw%3D%3D" alt="'.$alt_fragment.'" /></a>';
														}
														$shadow_gallery .= "</div>";
													}
												}

												$meta_data = $image->meta_data;
												$url_hash_list = array(); // Create a new array for the images
												if(!$meta_data['width'] || !$meta_data['height']){
													$url_hash_list[] = hash('md5',$image->imageURL);
												}
												$image->jig_image_src = array($image->imageURL,$meta_data['width'],$meta_data['height']);
												// this prepopulates wp_cache with the dimensions, if found
												if(!$this->jig_query_ext_images($url_hash_list)){
													$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
												}
												if(!$image->jig_image_src[1] || !$image->jig_image_src[2]){// If any of the dimensions are not a normal value
													$image->jig_image_src = $this->jig_get_ext_imagesize($image->jig_image_src);
												}
												$meta_data['width'] = $image->jig_image_src[1];
												$meta_data['height'] = $image->jig_image_src[2];
												if($meta_data['width'] != 0 && $meta_data['height'] != 0){// If none of the dimensions are 0
													$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
													$data['url'] = $image->jig_image_src[0];
													$data['width'] = $meta_data['width']/$meta_data['height']*$max_height; // Calculate new width of TimThumb
													$d['title'] =  esc_attr(nggGallery::i18n( stripslashes($image->title), 'gal_' . $image->gid . '_title'));
													if($d['title'] != '') $data['title'] = $d['title'];
													if($ng_count == 'yes'){
														$descriptionFragments = array($photo_count_by_gallery_id[$album_content].' '._n('Photo', 'Photos', $photo_count_by_gallery_id[$album_content], 'jig_td'));
														if($image->galdesc !== ''){
															$descriptionFragments[] = nggGallery::i18n(stripslashes($image->galdesc), 'gal_' . $image->gid.'_description');
														}
														$d['description'] = esc_attr(stripslashes(implode('<br />',$descriptionFragments)));
													}else{
														$d['description'] = esc_attr(nggGallery::i18n(stripslashes($image->galdesc), 'gal_' . $image->gid.'_description'));
													}													
													if($d['description'] != '') $data['description'] = $d['description'];
													if(isset($image->ng_cf_link)){
														$data['link'] = $image->ng_cf_link;
														$data['link_target'] = $link_target;
													}
													if(!isset($d['link'])){
														if($this->ng_version == 2){
															if(empty($image->pageid)){
																$d['link'] = $this->jig_ng_get_permalink(array('album'=>$album->slug,'gallery'=>$image->slug));
															}else{
																$d['link'] = get_permalink($image->pageid);
															}
														}else{
															if ($ngg_options['galNoPages']) {
																if($ngg_options['usePermalinks']){
																	$d['link'] = $this->jig_ng_get_permalink(array('album'=>$album->slug,'gallery'=>$image->slug));
																}else{
																	$d['link'] = $this->jig_ng_get_permalink(array('album'=>$album->id,'gallery'=>$image->gid));
																}
															}else{
																$d['link'] = get_permalink($image->pageid);
															}
														}
													}
												  	if($ng_lightbox_gallery == 'yes' && isset($shadow_gallery)){
												  		$d['link'] = NULL;
												  		$data['gallery']['html'] = $shadow_gallery;
												  		$data['gallery']['rel'] = $shadow_rel;
												  		$data['gallery']['id'] = $shadow_group_id;
												  		if(isset($data['title'])){
															$data['gallery']['title'] = $data['title'];
														}
														if(isset($data['description'])){
															$data['gallery']['description'] = $data['description'];
														}
														$d['title'] = esc_attr(stripslashes(nggGallery::i18n($image->alttext, 'pic_' . $image->pid . '_alttext')));
														if($d['title'] != ''){
															$data['title'] = $d['title'];
														}else{
															unset($data['title']);
														}
														$d['description'] = esc_attr(stripslashes(nggGallery::i18n($image->description, 'pic_' . $image->pid . '_description')));
														if($d['description'] != ''){
															$data['description'] = $d['description'];
														}else{
															unset($data['description']);
														}
														switch($lightbox){
															case 'foobox':
																$data['gallery']['lightbox_class'] = 'jigFooBoxConnect';
																break;
															case 'socialgallery':
																$data['gallery']['lightbox_class'] = 'jigSgConnect';
																break;
															default:
														}
												  	}
													if($download_link != 'no'){
														$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
													}
													if($d['link']){
														$data['link'] = $d['link'];
														$data['link_target'] = $link_target;
													}
													array_push($this->images, $data);
												}
											}											
										}else{ // If it's an album
											$cover_image = $this->jig_ng_find_subalbums($album_content, 'needed', true);
											if(!is_null($cover_image)){
												$meta_data = $cover_image->meta_data;
												$url_hash_list = array(); // Create a new array for the images
												if(!$meta_data['width'] || !$meta_data['height']){
													$url_hash_list[] = hash('md5',$cover_image->imageURL);									
												}
												$cover_image->jig_image_src = array($cover_image->imageURL,$meta_data['width'],$meta_data['height']);
												// this prepopulates wp_cache with the dimensions, if found
												if(!$this->jig_query_ext_images($url_hash_list)){
													$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
												}
												if(!$cover_image->jig_image_src[1] || !$cover_image->jig_image_src[2]){// If any of the dimensions are not a normal value
													$cover_image->jig_image_src = $this->jig_get_ext_imagesize($cover_image->jig_image_src);
												}
												$meta_data['width'] = $cover_image->jig_image_src[1];
												$meta_data['height'] = $cover_image->jig_image_src[2];
												if($meta_data['width'] != 0 && $meta_data['height'] != 0){// If none of the dimensions are 0
													$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
													$data['url'] = $cover_image->jig_image_src[0];
													$data['width'] = $meta_data['width']/$meta_data['height']*$max_height; // Calculate new width of TimThumb 
													$d['title'] =  esc_attr(stripslashes($cover_image->jig['name']));
													if($d['title'] != '') $data['title'] = $d['title'];
										
													if($ng_count == 'yes'){
														$descriptionFragments = $counterFragments = array();
														if($cover_image->jig['albumCount'] > 0){
															$counterFragments[] = $cover_image->jig['albumCount'].'&nbsp;'._n('Album', 'Albums', $cover_image->jig['albumCount'], 'jig_td');
														}
														if($cover_image->jig['galleryCount'] > 0){
															$counterFragments[] = $cover_image->jig['galleryCount'].'&nbsp;'._n('Gallery', 'Galleries', $cover_image->jig['galleryCount'], 'jig_td');
														}
														$descriptionFragments[] = implode(', ',$counterFragments);												
														if($cover_image->jig['albumdesc'] != ''){
															$descriptionFragments[] = $cover_image->jig['albumdesc'];
														}
														$d['description'] =  esc_attr(stripslashes(implode('<br />',$descriptionFragments)));
													}else{
														$d['description'] =  esc_attr(stripslashes($cover_image->jig['albumdesc']));
													}
													if($d['description'] != '') $data['description'] = $d['description'];

													if(empty($cover_image->pageid)){
														if($this->ng_version == 2){
															$d['link'] = $this->jig_ng_get_permalink(array('album'=>$cover_image->jig['slug'],'gallery'=>false));
														}else{
															if($ngg_options['usePermalinks']){
																$d['link'] = $this->jig_ng_get_permalink(array('album'=>$cover_image->jig['slug'],'gallery'=>false));
															}else{
																$d['link'] = $this->jig_ng_get_permalink(array('album'=>$cover_image->jig['id'],'gallery'=>false));
															}
														}
													}else{
														$d['link'] = get_permalink($cover_image->jig['pageid']);
														$data['link_target'] = $link_target;
													}

													if($d['link'] != '') $data['link'] = $d['link'];
													array_push($this->images, $data); 
												}
											}
										}									
									}
								}else{
									return sprintf(__('There is no content in the NextGEN album: "%1$s"!', 'jig_td'),stripcslashes($album->name));
								}
							}else{
								return sprintf(__('There is no content in the NextGEN album: "%1$s"!', 'jig_td'),stripcslashes($album->name));
							}
						}else{
							return sprintf(__('There is no NextGEN album with the ID: "%1$s"!', 'jig_td'),$ng_album);
						}
						
					}else if($ng_pics !== '' || $ng_recent_images !== '' || $ng_random_images !== ''){
						if($ng_pics){
							$images = $this->jig_ng_find_images($ng_pics);
						}else if($ng_recent_images){
							if($original_nextgen_limit === ''){
								$limit = 25;
							}
							$images = $this->jig_ng_get_recent_images($ng_recent_images, $limit);
							if($orderby == 'rand'){
								$images = (array) $images;
								shuffle($images);
							}
						}else if($ng_random_images){
							if($original_nextgen_limit === ''){
								$limit = 25;
							}
							$images = $this->jig_ng_get_random_images($limit, $ng_random_images);
						}
						if(!empty($images)){
							$this->images = $url_hash_list = array(); // Create a new array for the images
							foreach ($images as &$image) {

								if(!$image->meta_data['width'] || !$image->meta_data['height']){
									$url_hash_list[] = hash('md5',$image->imageURL);									
								}
								$image->jig_image_src = array($image->imageURL,$image->meta_data['width'],$image->meta_data['height']);
							}
							unset($image);
							if(!$this->jig_query_ext_images($url_hash_list)){
								$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
							}
							foreach ($images as $image) {

								if(!$image->jig_image_src[1] || !$image->jig_image_src[2]){// If any of the dimensions are not a normal value
									$image->jig_image_src = $this->jig_get_ext_imagesize($image->jig_image_src);
								}
								$image->meta_data['width'] = $image->jig_image_src[1];
								$image->meta_data['height'] = $image->jig_image_src[2];

								if($image->meta_data['width'] != 0 && $image->meta_data['height'] != 0){// If none of the dimensions are 0
									$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
									$data['url'] = $image->imageURL;
									$data['width'] = $image->meta_data['width']/$image->meta_data['height']*$max_height; // Calculate new width of TimThumb by getting the ratio and multiplying it with the set row height
									
									$d['title'] =  esc_attr(stripslashes(nggGallery::i18n($image->alttext, 'pic_' . $image->pid . '_alttext')));
									if($d['title'] != '') $data['title'] = $d['title'];
									$d['description'] =  esc_attr(stripslashes(nggGallery::i18n($image->description, 'pic_' . $image->pid . '_description')));
									if($d['description'] != '') $data['description'] = $d['description'];
									if($download_link != 'no'){
										$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
									}
									if(isset($image->ng_cf_link)){
										$data['link'] = $image->ng_cf_link;
										$data['link_target'] = $link_target;
									}

									if($filterby == 'on'){
										$d['filters'] = wp_get_object_terms($image->pid,'ngg_tag');
										if(!empty($d['filters'])){
											foreach ($d['filters'] as $filter_term) {
												$data['filters'][] = array($filter_term->slug,$filter_term->name);
											}
										}
									}
									array_push($this->images, $data); 
								}
							}
						}else{
							return __('There are no NextGEN images that could be displayed.', 'jig_td');
						}
					}else if($ng_tags_gallery){
						$this->ng_intersect_tags = $ng_intersect_tags;
						$images = $this->jig_ng_find_images_for_tags($ng_tags_gallery, ($orderby != 'rand' ? $ngg_options['galSort'] : 'RAND'), $ngg_options['galSortDir'], $limit);

						if(!empty($images)){
							$this->images = $url_hash_list = array(); // Create a new array for the images
							$counter = 0;
							$images = $this->jig_ng_process_images($images); // Very important, sets up the image objects, mimics NG
							foreach ($images as &$image) {
								if(++$counter > $limit){
									break;
								}
								if(!$image->meta_data['width'] || !$image->meta_data['height']){
									$url_hash_list[] = hash('md5',$image->imageURL);									
								}
								$image->jig_image_src = array($image->imageURL,$image->meta_data['width'],$image->meta_data['height']);
							}
							unset($image);
							if(!$this->jig_query_ext_images($url_hash_list)){
								$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
							}
							$counter = 0;
							foreach ($images as $image) {
								if(++$counter > $limit){
									break;
								}
								if(!$image->jig_image_src[1] || !$image->jig_image_src[2]){// If any of the dimensions are not a normal value
									$image->jig_image_src = $this->jig_get_ext_imagesize($image->jig_image_src);
								}
								$image->meta_data['width'] = $image->jig_image_src[1];
								$image->meta_data['height'] = $image->jig_image_src[2];
				
								if($image->meta_data['width'] != 0 && $image->meta_data['height'] != 0){ // If none of the dimensions are 0
									$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
									$data['url'] = $image->imageURL;
									$data['width'] = $image->meta_data['width']/$image->meta_data['height']*$max_height; // Calculate new width of TimThumb by getting the ratio and multiplying it with the set row height
									$d['title'] = esc_attr(stripslashes(nggGallery::i18n($image->alttext, 'pic_' . $image->pid . '_alttext')));
									if($d['title'] != '') $data['title'] = $d['title'];
									$d['description'] = esc_attr(stripslashes(nggGallery::i18n($image->description, 'pic_' . $image->pid . '_description')));							
									if($d['description'] != '') $data['description'] = $d['description'];
									if($download_link != 'no'){
										$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
									}
									if(isset($image->ng_cf_link)){
										$data['link'] = $image->ng_cf_link;
										$data['link_target'] = $link_target;
									}
									if($filterby == 'on'){
										$d['filters'] = wp_get_object_terms($image->pid,'ngg_tag');
										if(!empty($d['filters'])){
											foreach ($d['filters'] as $filter_term) {
												$data['filters'][] = array($filter_term->slug,$filter_term->name);
											}
										}
									}
									array_push($this->images, $data); 
								}
							}
						}else{
							return __('No images could be found with that tag.', 'jig_td');
						}
					}else if($ng_tags_album){
						$this->ng_intersect_tags = $ng_intersect_tags;
						$images = $this->jig_ng_find_images_for_tags($ng_tags_album, ($orderby != 'rand' ? $ngg_options['galSort'] : 'RAND'), $ngg_options['galSortDir'],$limit,true);

						if(!empty($images)){
							$this->images = $url_hash_list = array(); // Create a new array for the images
							$images = $this->jig_ng_process_images($images); // Very important, sets up the image objects, mimics NG

							foreach ($images as &$image) {
								if(!$image->meta_data['width'] || !$image->meta_data['height']){
									$url_hash_list[] = hash('md5',$image->imageURL);									
								}
								$image->jig_image_src = array($image->imageURL,$image->meta_data['width'],$image->meta_data['height']);
							}
							unset($image);
							if(!$this->jig_query_ext_images($url_hash_list)){
								$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
							}

							if($orderby == 'rand'){
								$images = (array) $images;
								shuffle($images);
							}
							foreach ($images as $image) {
								if($ng_lightbox_gallery == 'yes'){ // If gallery should be displayed as a lightbox
									$lightbox_images = $this->jig_ng_find_images_for_tags($image->slug, ($orderby != 'rand' ? $ngg_options['galSort'] : 'RAND'), $ngg_options['galSortDir'], $limit);
									if(!empty($lightbox_images)){
										$lightbox_images  = $this->jig_ng_process_images($lightbox_images ); // Very important, sets up the image objects, mimics NG
										$shadow_galleries[] = $shadow_group_id = 'jigHiddenGalleryGroup-'.$image->slug;
										$shadow_gallery = '<div class="jigHiddenGallery">';
										switch($lightbox){
											case 'prettyphoto':
											$shadow_rel = 'prettyPhoto[ngg-'.$image->slug.']';
											break;
											case 'colorbox':
											$shadow_rel = 'colorBox[ngg-'.$image->slug.']';
											break;
											default:
											$shadow_rel = 'ngg['.$image->slug.']';
											break;
										}

										foreach ($lightbox_images as $lightbox_image) {
											// Skip image from the hidden gallery if it's the same as the opener image
											if($lightbox_image->filename == $image->filename){
												continue;
											}
											$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
											$data['url'] = $lightbox_image->imageURL;
											$d['title'] = esc_attr(stripslashes(nggGallery::i18n($lightbox_image->alttext, 'pic_' . $lightbox_image->pid . '_alttext')));
											$d['description'] = esc_attr(stripslashes(nggGallery::i18n($lightbox_image->description, 'pic_' . $lightbox_image->pid . '_description')));

											$title_fragment = isset($d[$link_title_field]) ? $d[$link_title_field] : '';
											$alt_fragment = isset($d[$img_alt_field]) ? $d[$img_alt_field] : '';

											if($download_link != 'no'){
												$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
												if($download_link == 'yes'){
													if($title_fragment !== ''){
														$title_fragment .= ' - '.$data['download'];
													}else{
														$title_fragment = $data['download'];
													}
												}else{
													if($alt_fragment !== ''){
														$alt_fragment .= ' - '.$data['download'];
													}else{
														$alt_fragment = $data['download'];
													}
												}
											}
											$shadow_gallery .= '<a href="'.$data['url'].'" rel="'.$shadow_rel.'" title="'.$title_fragment.'" class="jig-link"><img src="data:image/gif;base64,R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw%3D%3D" alt="'.$alt_fragment.'" /></a>';
										}
										$shadow_gallery .= "</div>";
									}
								}

								if(!$image->jig_image_src[1] || !$image->jig_image_src[2]){// If any of the dimensions are not a normal value
									$image->jig_image_src = $this->jig_get_ext_imagesize($image->jig_image_src);
								}
								$image->meta_data['width'] = $image->jig_image_src[1];
								$image->meta_data['height'] = $image->jig_image_src[2];

								if($image->meta_data['width'] != 0 && $image->meta_data['height'] != 0){// If none of the dimensions are 0
									$data = $d = array(); // Create 2 arrays for this image one temporary and one that gets pushed
									$data['url'] = $image->imageURL;
									$data['width'] = $image->meta_data['width']/$image->meta_data['height']*$max_height; // Calculate new width of TimThumb
									$d['title'] =  esc_attr(stripslashes($image->name));
									if($d['title'] != '') $data['title'] = ucfirst(nggGallery::i18n($d['title'], 'tag_' . $d['title']));
									$d['description'] =  esc_attr(stripslashes($image->count.' '.__('Photos', 'nggallery')));
									if($d['description'] != '') $data['description'] = $d['description'];								
									$d['link'] = $this->jig_ng_get_permalink( array('gallerytag'=>$image->slug) );
									if($ng_lightbox_gallery == 'yes' && isset($shadow_gallery)){
										$d['link'] = NULL;
										$data['gallery']['html'] = $shadow_gallery;
										$data['gallery']['rel'] = $shadow_rel;
										$data['gallery']['id'] = $shadow_group_id;
										if(isset($data['title'])){
											$data['gallery']['title'] = $data['title'];
										}
										if(isset($data['description'])){
											$data['gallery']['description'] = $data['description'];
										}
										$d['title'] = esc_attr(stripslashes(nggGallery::i18n($image->alttext, 'pic_' . $image->pid . '_alttext')));
										if($d['title'] != ''){
											$data['title'] = $d['title'];
										}else{
											unset($data['title']);
										}
										$d['description'] = esc_attr(stripslashes(nggGallery::i18n($image->description, 'pic_' . $image->pid . '_description')));
										if($d['description'] != ''){
											$data['description'] = $d['description'];
										}else{
											unset($data['description']);
										}
										switch($lightbox){
											case 'foobox':
												$data['gallery']['lightbox_class'] = 'jigFooBoxConnect';
												break;
											case 'socialgallery':
												$data['gallery']['lightbox_class'] = 'jigSgConnect';
												break;
											default:
										}
									}
									if($download_link != 'no'){
										$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
									}
									if($d['link']){
										$data['link'] = $d['link'];
										$data['link_target'] = $link_target;
									}
									array_push($this->images, $data); 
								}
							}
						}else{
							return __('No images could be found with that tag.', 'jig_td');
						}
					}
					// NG custom breadcrumb
					$ng_bc_album_need = true;
					if($ng_breadcrumb == 'yes'){ // If the breadcrumb feature is enabled
						$query_gallery = $this->jig_ng_get_query_var('gallery');
						$query_album   = $this->jig_ng_get_query_var('album');
						$query_tags    = $this->jig_ng_get_query_var('gallerytag');
						$ng_breadcrumb_output = array();
						if($ng_bc_base !== '' && $ng_bc_base !== 'none'){
							$ng_breadcrumb_output[0] = $ng_bc_base.' ';
						}
						if(isset($ng_bc_home_album)){ // If there was an album id originally
							if($ng_bc_home_album !== 'all' && $ng_bc_home_album != "0"){ // And it was a single particular album
								// Get the album's name from the cache or the db
								$ng_bc_home_album_object = wp_cache_get($ng_bc_home_album, 'jig_ng_albums');
								if($ng_bc_home_album_object !== false){
									$ng_bc_home_output = stripcslashes(nggGallery::i18n($ng_bc_home_album_object->name, 'album_' . $ng_bc_home_album_object->id . '_name'));
								}else{
									$ng_bc_home_album_object = $wpdb->get_row($wpdb->prepare("SELECT name,slug,id FROM $wpdb->nggalbum WHERE id = %d",$ng_bc_home_album));
									$ng_bc_home_output = stripcslashes(nggGallery::i18n($ng_bc_home_album_object->name, 'album_' . $ng_bc_home_album_object->id . '_name'));
								}
								// If the original album is the same as the currently displayed album, don't show the album part of the breadcrumb
								if(!empty($query_album) && ($ng_bc_home_album_object->slug == $query_album || $ng_bc_home_album_object->id == $query_album)){
									$ng_bc_album_need = false;
								}
							}else{ // If the album was an overview
								$ng_bc_home_output = __('Album overview', 'jig_td');
							}
						}else{ // If the original shortcode wasn't an album, fall back to post title
							$ng_bc_home_output = $post->post_title;
						}
						switch($ng_bc_home){ // Different home styles
							case 'post_title':
								$ng_bc_home_output = $post->post_title;
							break;
							case 'custom_text':
								$ng_bc_home_output = $ng_bc_home_text;
							break;
							case 'album_name':
								// Leave $ng_bc_home_output as it is, it was previously created
							break;
							case 'none':
							default:
							$ng_bc_home_output = '';
						}
						
						if(( // Decide if it's clickable when only the home is shown
							$ng_bc_home !== 'none'
								&& $ng_bc_home_clickable == 'yes'
								&& empty($query_album)
								&& empty($query_gallery)
								&& empty($query_tags)
								&& $ng_bc_last_clickable == 'yes'
							) || (
							 // Decide if it's clickable when other path elements are shown
							$ng_bc_home !== 'none'
								&& $ng_bc_home_clickable == 'yes'
								&& (!empty($query_album) || !empty($query_gallery) || !empty($query_tags))
						)){


							// Get the current URL using WP Class 
							global $wp, $wp_rewrite;
							$ng_home_permalink = home_url(add_query_arg(array(),$wp->request));

							$ngoptions = get_option('ngg_options');
							$ng_permalink_slug = $ngoptions['permalinkSlug'];

							// If the permalink slug is in the URL, return the true base URL
							$slug_position = strripos($ng_home_permalink, $ng_permalink_slug);
							if($slug_position !== false){
								$ng_home_permalink = substr($ng_home_permalink, 0, $slug_position);
							}
							// Trailing slash it
							$ng_home_permalink = trailingslashit($ng_home_permalink);

							// If WP permalinks are off this makes the home element detect the origin page or post...
							global $query_string;
							if($wp_rewrite->using_permalinks() !== true && !empty($query_string)){
								$ng_home_permalink .= '?'.remove_query_arg(array('album','gallery','gallerytag'),$query_string);
								$ng_home_permalink = untrailingslashit(urldecode($ng_home_permalink));
							}

							$ng_breadcrumb_output[0] .= '<a href="'.$ng_home_permalink.'" >'.$ng_bc_home_output.'</a>';
						}else{ // If it's not clickable just show it as-is
							$ng_breadcrumb_output[0] .= $ng_bc_home_output;
						}

						// Album part
						if(!empty($query_album) && $query_album !== 'all' && $ng_bc_album_need === true){

							if(!is_numeric($query_album)){
								$album = $wpdb->get_row($wpdb->prepare("SELECT name,id FROM $wpdb->nggalbum WHERE slug = %s LIMIT 0,1",$query_album));
							}else{
								$album = $wpdb->get_row($wpdb->prepare("SELECT name,id FROM $wpdb->nggalbum WHERE id = %d LIMIT 0,1",$query_album));
							}

							$album_text = stripcslashes(nggGallery::i18n($album->name, 'album_' . $album->id . '_name'));
							if(empty($query_gallery) && $ng_bc_last_clickable == 'no'){
								$ng_breadcrumb_output[] = $album_text;
							}else{
								global $wp_query;
								$wp_query->set('gallery',false);

								$ng_breadcrumb_output[] = '<a href="'.$this->jig_ng_get_permalink(array('gallery'=>false,'album'=>$query_album,'nggpage'=>false)).'">'.$album_text.'</a>';
								$wp_query->set('gallery',$query_gallery);
								;
							}
						}

						// Gallery part
						if(!empty($query_gallery)){
							// Needed by the breadcrumb
							if(!is_numeric($query_album)){
								$gallery = $wpdb->get_row($wpdb->prepare("SELECT title,gid FROM $wpdb->nggallery WHERE slug = %s LIMIT 0,1",$query_gallery));
							}else{
								$gallery = $wpdb->get_row($wpdb->prepare("SELECT title,gid FROM $wpdb->nggallery WHERE gid = %d LIMIT 0,1",$query_gallery));
							}

							$gallery_text = nggGallery::i18n( stripslashes($gallery->title), 'gal_' . $gallery->gid . '_title');
							if($ng_bc_last_clickable == 'no'){
								$ng_breadcrumb_output[] = $gallery_text;
							}else{
								$ng_breadcrumb_output[] = '<a href="'.$this->jig_ng_get_permalink(array('album'=>(!empty($query_album)?$query_album:false),'gallery'=>(!empty($query_gallery)?$query_gallery:false))).'" >'.$gallery_text.'</a>';
							}
						}

						// Tags (gallery) part
						if(!empty($query_tags)){
							 $tagname = ucfirst($wpdb->get_var($wpdb->prepare("SELECT name FROM $wpdb->terms WHERE slug = %s", $query_tags)));
							if($ng_bc_last_clickable == 'no'){
								$ng_breadcrumb_output[] = nggGallery::i18n($tagname, 'tag_' . $tagname);
							}else{
								$ng_breadcrumb_output[] = '<a href="'.$this->jig_ng_get_permalink(array('gallerytag'=>$query_tags)).'" >'.nggGallery::i18n($tagname, 'tag_' . $tagname).'</a>';
							}
						}

						switch($ng_bc_separator){
								case 'default':
									$ng_bc_separator = ' &raquo;';
									break;
								case 'greater':
									$ng_bc_separator = ' &gt;';
									break;
								case 'comma':
									$ng_bc_separator = ',';
									break;
								case 'slash':
									$ng_bc_separator = ' /';
									break;
								case 'doubleslash':
									$ng_bc_separator = ' //';
									break;
								case 'minus':
									$ng_bc_separator = ' -';
									break;
								case 'plus':
									$ng_bc_separator = ' +';
									break;
								case 'arrow':
									$ng_bc_separator = ' &rarr;';
									break;
								case 'bslash':
									$ng_bc_separator = ' \\';
									break;
								case 'doublebslash':
									$ng_bc_separator = ' \\\\';
									break;
								case 'middledot':
									$ng_bc_separator = ' ·';
									break;
								case 'dobulecolon':
									$ng_bc_separator = ' ::';
									break;
								case 'numbersign':
									$ng_bc_separator = ' #';
									break;
						}

						// Join the breadcrumb parts together with the separator as a glue, with spaces
						$ng_breadcrumb_output_joined = implode($ng_bc_separator.' ', $ng_breadcrumb_output);
						// If an extra separator is needed at the end, add it
						if($ng_bc_add_separator == 'yes'){
							$ng_breadcrumb_output_joined .= $ng_bc_separator;
						}
						// Display it if this is the jig-connected NG instance or the top level is forced
						if(isset($jigNgConnect) || $ng_bc_top_level == 'yes'){
							$notice_before = '<div class="jig-ngBreadcrumb">'.$ng_breadcrumb_output_joined.'</div>'.$notice_before;
						}
					} // end of NG custom breadcrumb 
				break;
				case 'facebook':
					if(isset($this->settings['fb_authed'][$facebook_id])){
						$user = $this->settings['fb_authed'][$facebook_id];
						if($limit === "0"){
							$limit_parameter = "&limit=500";
						}else if($limit !== ''){
							$limit_parameter = "&limit=".$limit;
						}else{
							$limit_parameter = '';
						}

						if($facebook_album == 'overview' || $facebook_album == 'overview_only_albums'){
							$albums_url = "https://graph.facebook.com/".$facebook_id."/albums?fields=id,link,count,name,type,from".$limit_parameter.($user['access_token'] != 'public' ? '&access_token='.$user['access_token'] : '');
							if($facebook_caching > 0){
								if(get_transient('jigfb_'.md5($albums_url.$facebook_caching)) == true){
									$albums = get_transient('jigfb_'.md5($albums_url.$facebook_caching));
								}else{
									$albums = json_decode($this->file_get_contents_curl($albums_url));
									set_transient('jigfb_'.md5($albums_url.$facebook_caching), $albums, 60 * $facebook_caching);
								}			
							}else{
								$albums = json_decode($this->file_get_contents_curl($albums_url));
							}
							if(!empty($albums->data)){
								global $wp, $query_string, $wp_rewrite, $wp_query;
								if(get_query_var($this->settings['fb_overview_slug'])){					
									$facebook_album = get_query_var($this->settings['fb_overview_slug']);
									if($fb_breadcrumb == 'yes'){
										foreach ($albums->data as $key => $album) {
											if($album->id === $facebook_album){
												$album_name = $album->name;
												break;
											}
										}
										$fb_home_permalink = home_url(add_query_arg(array(),$wp->request));
										$slug_position = strripos($fb_home_permalink, $this->settings['fb_overview_slug']);
										if($slug_position !== false){
											$fb_home_permalink = substr($fb_home_permalink, 0, $slug_position);
										}
										if(substr($fb_home_permalink, -1) != '/'){
											$fb_home_permalink .= '/';
										}
										if($fb_home_permalink == home_url('/') && strlen($query_string) > 0 && strpos($query_string, $this->settings['fb_overview_slug']) !== false){
											$fb_home_permalink .= '?'.remove_query_arg($this->settings['fb_overview_slug'],$query_string);
										}
										switch($fb_bc_separator){
											case 'default':
												$fb_bc_separator = ' &raquo;';
												break;
											case 'greater':
												$fb_bc_separator = ' &gt;';
												break;
											case 'comma':
												$fb_bc_separator = ',';
												break;
											case 'slash':
												$fb_bc_separator = ' /';
												break;
											case 'doubleslash':
												$fb_bc_separator = ' //';
												break;
											case 'minus':
												$fb_bc_separator = ' -';
												break;
											case 'plus':
												$fb_bc_separator = ' +';
												break;
											case 'arrow':
												$fb_bc_separator = ' &rarr;';
												break;
											case 'bslash':
												$fb_bc_separator = ' \\';
												break;
											case 'doublebslash':
												$fb_bc_separator = ' \\\\';
												break;
											case 'middledot':
												$fb_bc_separator = ' ·';
												break;
											case 'dobulecolon':
												$fb_bc_separator = ' ::';
												break;
											case 'numbersign':
												$fb_bc_separator = ' #';
												break;
										}
										$notice_before .= '<div class="jig-fbBreadcrumb"><a href="'.$fb_home_permalink.'">'.($fb_bc_home_text === '' ? $albums->data[0]->from->name : $fb_bc_home_text).'</a> '.$fb_bc_separator.' '.$album_name.'</div>';
										$fb_bc_CSS_needed = true;
									}
								}else{
									$this->images = array(); // Create a new array for the images
									$found = 0;
									$facebook_overview_caching = $this->settings['facebook_overview_caching'];
									if($orderby == 'rand'){
										$albums->data = (array) $albums->data;
										shuffle($albums->data);
									}
									if($retina_ready == 'yes'){
										$calculated_max_height = $max_height*3;
									}else{
										$calculated_max_height = $max_height;
									}
									foreach ($albums->data as $key => $album) {
										if($facebook_album == 'overview_only_albums' && $album->type !== 'normal'){
											continue;
										}
										if(!empty($album->count) && !empty($album->link)){
											if($fb_lightbox_album == 'yes'){
												$subalbum_url = "https://graph.facebook.com/".$album->id."/photos?fields=images,source,height,width,name".$limit_parameter.($user['access_token'] != 'public' ? '&access_token='.$user['access_token'] : '');
											}else{
												$subalbum_url = "https://graph.facebook.com/".$album->id."/photos?fields=images&limit=10".($user['access_token'] != 'public' ? '&access_token='.$user['access_token'] : '');
											}
											if($facebook_overview_caching > 0){
												if(get_transient('jigfb_'.md5($subalbum_url.$facebook_overview_caching)) == true){
													$subalbum = get_transient('jigfb_'.md5($subalbum_url.$facebook_overview_caching));
												}else{
													$subalbum = json_decode($this->file_get_contents_curl($subalbum_url));
													set_transient('jigfb_'.md5($subalbum_url.$facebook_overview_caching), $subalbum, 60 * $facebook_overview_caching);
												}			
											}else{
												$subalbum = json_decode($this->file_get_contents_curl($subalbum_url));
											}

											if(!empty($subalbum->data)){
												$data = array(); // Create a new array for this image
												if(isset($album->name)){
													$data['title'] = esc_attr(stripslashes($album->name));
												}
												$data['description'] = $album->count.' '._n('Photo', 'Photos', $album->count, 'jig_td');

												$show_on_front = get_option('show_on_front');
												$page_on_front = get_option('page_on_front');
												$args[$this->settings['fb_overview_slug']] = $album->id;
												if ($wp_rewrite->using_permalinks()) {
													if(is_singular()){
														$post = &get_post(get_the_ID());
														$url = trailingslashit(get_permalink($post->ID)); 
														if ($show_on_front == 'page' && $page_on_front == get_the_ID()){
															$url = trailingslashit(home_url($post->page_name ? $post->page_name : $post->post_name));	
														}
													}else{
														$url = 'http'.(is_ssl() ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
													}
													$url .= $this->settings['fb_overview_slug'].'/' . $args[$this->settings['fb_overview_slug']];
													$data['link'] = $url;
												}else{			
													if (is_home()){
														$args['pageid'] = get_the_ID();
													}
													if ($show_on_front == 'page' && $page_on_front == get_the_ID()){
														$args['page_id'] = get_the_ID();
													}
													if(is_singular()){
														$query = htmlspecialchars(add_query_arg($args, get_permalink(get_the_ID())));
													}else{
														$query = htmlspecialchars(add_query_arg($args));
													}													
												    $data['link'] = $query;
												}
												if($fb_lightbox_album == 'yes'){
													$data['url'] = $subalbum->data[0]->source;
													$data['width'] = $subalbum->data[0]->width/$subalbum->data[0]->height*$max_height;
	
												}elseif($photon_activated || $aspect_ratio || $randomize_width > 0){
													$data['url'] = $subalbum->data[0]->images[0]->source;
													$data['width'] = $subalbum->data[0]->images[0]->width/$subalbum->data[0]->images[0]->height*$max_height;
												}else{
													for($i = count($subalbum->data[0]->images)-1; $i >= 0; $i--) {
														if($subalbum->data[0]->images[$i]->height >= $calculated_max_height){
															$data['url'] = $subalbum->data[0]->images[$i]->source;
															$data['width'] = $subalbum->data[0]->images[$i]->width/$subalbum->data[0]->images[$i]->height*$max_height;
															break;
														}
													}
													if(empty($data['url'])){
														$data['url'] = $subalbum->data[0]->images[0]->source;
														$data['width'] = $subalbum->data[0]->images[0]->width/$subalbum->data[0]->images[0]->height*$max_height;
													}
												}

												if($fb_lightbox_album == 'yes'){ // If gallery should be displayed as a lightbox

													$shadow_galleries[] = $shadow_group_id = 'jigHiddenGalleryGroup-'.$album->id;
													$shadow_gallery = '<div class="jigHiddenGallery">';
													switch($lightbox){
														case 'prettyphoto':
														$shadow_rel = 'prettyPhoto[fb-'.$album->id.']';
														break;
														case 'colorbox':
														$shadow_rel = 'colorBox[fb-'.$album->id.']';
														break;
														default:
														$shadow_rel = 'fb['.$album->id.']';
														break;
													}

													foreach ($subalbum->data as $subalbum_image) {
														// Skip image from the hidden gallery if it's the same as the opener image
														if($subalbum_image->id == $subalbum->data[0]->id){
															continue;
														}
														$shadow_data = $sd = array(); // Create 2 arrays for this image one temporary and one that gets pushed
														if($facebook_image_size == 'larger'){
															if($subalbum_image->images[0]->height < 2048 && $subalbum_image->images[0]->width < 2048){
																$shadow_data['url'] = $subalbum_image->images[0]->source;
															}else{
																$shadow_data['url'] = $subalbum_image->images[1]->source;
															}
														}else if($facebook_image_size == 'maximum'){													
															$shadow_data['url'] = $subalbum_image->images[0]->source;
														}else{
															$shadow_data['url'] = $subalbum_image->source;
														}
														$sd['title'] = esc_attr(stripslashes($album->name));
														if(isset($subalbum_image->name)){
															$sd['description'] = esc_attr(stripslashes($subalbum_image->name));
														}

														$title_fragment = isset($sd[$link_title_field]) ? $sd[$link_title_field] : '';
														$alt_fragment = isset($sd[$img_alt_field]) ? $sd[$img_alt_field] : '';

														if($download_link != 'no'){
															$shadow_data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$shadow_data['url'].'">'.$this->settings['download_link_text'].'</a>'));
															if($download_link == 'yes'){
																if($title_fragment !== ''){
																	$title_fragment .= ' - '.$shadow_data['download'];
																}else{
																	$title_fragment = $shadow_data['download'];
																}
															}else{
																if($alt_fragment !== ''){
																	$alt_fragment .= ' - '.$shadow_data['download'];
																}else{
																	$alt_fragment = $shadow_data['download'];
																}
															}
														}
														$shadow_gallery .= '<a href="'.$shadow_data['url'].'" rel="'.$shadow_rel.'" title="'.$title_fragment.'" class="jig-link"><img src="data:image/gif;base64,R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw%3D%3D" alt="'.$alt_fragment.'" /></a>';
														
													}
													$shadow_gallery .= "</div>";
													$data['link'] = NULL;
													if($facebook_image_size == 'larger'){
														$data['link_target'] = 'video';
														if($subalbum->data[0]->images[0]->height < 2048 && $subalbum->data[0]->images[0]->width < 2048){
															$data['link'] = $subalbum->data[0]->images[0]->source;
														}else{
															$data['link'] = $subalbum->data[0]->images[1]->source;
														}
													}else if($facebook_image_size == 'maximum'){
														$data['link_target'] = 'video';
														$data['link'] = $subalbum->data[0]->images[0]->source;
													}
													if(isset($data['title'])){
														$data['gallery']['title'] = $data['title'];
													}
													if(isset($data['description'])){
														$data['gallery']['description'] = $data['description'];
													}
													$data['gallery']['html'] = $shadow_gallery;
													$data['gallery']['rel'] = $shadow_rel;
													$data['gallery']['id'] = $shadow_group_id;
													switch($lightbox){
														case 'foobox':
															$data['gallery']['lightbox_class'] = 'jigFooBoxConnect';
															break;
														case 'socialgallery':
															$data['gallery']['lightbox_class'] = 'jigSgConnect';
															break;
														default:
													}
												}
												array_push($this->images, $data); // Add to the main images array
											}
										}		
										$found++;

									}
									if($found == 0){
										return __('There are no pictures in any of the albums.', 'jig_td');
									}
								}
							}else{
								return __('There are no albums.', 'jig_td');
							}
						}
						if($facebook_album == 'feed'){
							if(empty($user['access_token']) || (isset($user['access_token']) && $user['access_token'] == 'public')){
								$first_valid_access_token = '';
								foreach ($this->settings['fb_authed'] as $fb_user) {
									$first_valid_access_token = $fb_user['access_token'];
									break;
								}
							}else{
								$first_valid_access_token = $user['access_token'];
							}


							if($first_valid_access_token === ''){
								return __("No access token found, please authorize a Facebook user for the Facebook feed feature (even if it's just for a page).", 'jig_td');
							}

							$feed_url = "https://graph.facebook.com/".$facebook_id."/feed?fields=picture,message,object_id".$limit_parameter.'&access_token='.$first_valid_access_token;
							if($facebook_caching > 0){
								if(get_transient('jigfb_'.md5($feed_url.$facebook_caching)) == true){
									$photos = get_transient('jigfb_'.md5($feed_url.$facebook_caching));
								}else{
									$photos = json_decode($this->file_get_contents_curl($feed_url));
									set_transient('jigfb_'.md5($feed_url.$facebook_caching), $photos, 60 * $facebook_caching);
								}			
							}else{
								$photos = json_decode($this->file_get_contents_curl($feed_url));
							}

							if(!empty($photos->data)){
								$this->images = array(); // Create a new array for the images
								if($orderby == 'rand'){
									$photos->data = (array) $photos->data;
									shuffle($photos->data);
								}
								// Since this is just a request for the image sizes, it could be cached for a very very long time (as album covers)
								$facebook_overview_caching = $this->settings['facebook_overview_caching'];
								foreach ($photos->data as &$feed_post) {
									if(!(isset($feed_post->picture) && isset($feed_post->object_id))){
										continue; // It is not a photo object
									}else{
										$feed_url = "https://graph.facebook.com/".$feed_post->object_id."?fields=images,source,height,width".'&access_token='.$first_valid_access_token;
										if($facebook_overview_caching > 0){
											if(get_transient('jigfb_'.md5($feed_url.$facebook_overview_caching)) == true){
												$photo_object = get_transient('jigfb_'.md5($feed_url.$facebook_overview_caching));
											}else{
												$photo_object = json_decode($this->file_get_contents_curl($feed_url));
												set_transient('jigfb_'.md5($feed_url.$facebook_overview_caching), $photo_object, 60 * $facebook_overview_caching);
											}			
										}else{
											$photo_object = json_decode($this->file_get_contents_curl($feed_url));
										}
										if(isset($photo_object->images)){
											$data = array(); // Create a new array for this image
											if($facebook_image_size == 'larger'){
												$data['link_target'] = 'video';
												if($photo_object->images[0]->height < 2048 && $photo_object->images[0]->width < 2048){
													$data['link'] = $photo_object->images[0]->source;
												}else{
													$data['link'] = $photo_object->images[1]->source;
												}
											}else if($facebook_image_size == 'maximum'){
												$data['link_target'] = 'video';
												$data['link'] = $photo_object->images[0]->source;
											}
											if(isset($feed_post->message)){
												$data['title'] = esc_attr(stripslashes($feed_post->message));
											}

											$data['url'] = $photo_object->source; // Store the full URL value
											$data['width'] = $photo_object->width/$photo_object->height*$max_height; // Calculate new width of TimThumb by getting the ratio and multiplying it with the set row height

											if($download_link != 'no'){
												$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
											}
											array_push($this->images, $data); // Add to the main images array
										}									
									}
								}
								unset($feed_post, $photo_object);
							}
						}
						if($facebook_album !== 'overview' && $facebook_album !== 'overview_only_albums' && $facebook_album !== 'feed'){
							$photos_url = "https://graph.facebook.com/".$facebook_album."/photos?fields=source,height,width,name".($facebook_image_size == 'normal' ? '' : ',images').$limit_parameter.($user['access_token'] != 'public' ? '&access_token='.$user['access_token'] : '');
							if($facebook_caching > 0){
								if(get_transient('jigfb_'.md5($photos_url.$facebook_caching)) == true){
									$photos = get_transient('jigfb_'.md5($photos_url.$facebook_caching));
								}else{
									$photos = json_decode($this->file_get_contents_curl($photos_url));
									set_transient('jigfb_'.md5($photos_url.$facebook_caching), $photos, 60 * $facebook_caching);
								}			
							}else{
								$photos = json_decode($this->file_get_contents_curl($photos_url));
							}
							if(!empty($photos->data)){
								$this->images = array(); // Create a new array for the images
								if($orderby == 'rand'){
									$photos->data = (array) $photos->data;
									shuffle($photos->data);
								}
								foreach ($photos->data as $image) {
									$data = array(); // Create a new array for this image
									if(isset($image->name)){
										$data['title'] = esc_attr(stripslashes($image->name));
									}
									$data['url'] = $image->source; // Store the full URL value
									$data['width'] = $image->width/$image->height*$max_height; // Calculate new width of TimThumb by getting the ratio and multiplying it with the set row height
									if($facebook_image_size == 'larger'){
										$data['link_target'] = 'video';
										if($image->images[0]->height < 2048 && $image->images[0]->width < 2048){
											$data['link'] = $image->images[0]->source;
										}else{
											$data['link'] = $image->images[1]->source;
										}
									}else if($facebook_image_size == 'maximum'){
										$data['link_target'] = 'video';
										$data['link'] = $image->images[0]->source;
									}

									if($download_link != 'no'){
										$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
									}
									array_push($this->images, $data); // Add to the main images array

								}
							}else{
								return __('The requested album cannot be loaded at this time.', 'jig_td');
							}
						}
					}else{
						return __('That Facebook ID is unauthorized for use, please go to Settings and add it.', 'jig_td');
					}
				break;
				case 'flickr':
					if($limit === '0'){
						$limit_parameter = "&per_page=500";
					}else if($limit !== ''){
						$limit_parameter = "&per_page=".$limit;
					}else{
						$limit_parameter = "&per_page=25";
					}

					if($flickr_photostream !== ''){
						$photos_url_bit = 'flickr.people.getPublicPhotos&user_id='.$flickr_photostream;
					}elseif($flickr_favorites !== ''){
						$photos_url_bit = 'flickr.favorites.getPublicList&user_id='.$flickr_favorites;
					}elseif($flickr_group !== ''){
						$photos_url_bit = 'flickr.groups.pools.getPhotos&group_id='.$flickr_group;
					}elseif($flickr_photoset !== ''){
						$photos_url_bit = 'flickr.photosets.getPhotos&photoset_id='.$flickr_photoset;
					}elseif($flickr_gallery !== ''){
						$photos_url_bit = 'flickr.galleries.getPhotos&gallery_id='.$flickr_gallery;
					}
					$photos_url = 'http://api.flickr.com/services/rest?api_key='.trim($this->settings['fli_api_key']).'&format=php_serial&method='.$photos_url_bit.$limit_parameter.'&extras=description,tags,url_k,url_h,url_l,url_c,url_z,url_m,url_n,url_s,url_t';
					if($flickr_caching > 0){
						if(get_transient('jigfli_'.md5($photos_url.$flickr_caching)) == true){
							$photos = get_transient('jigfli_'.md5($photos_url.$flickr_caching));
						}else{
							$photos = unserialize($this->file_get_contents_curl($photos_url));
							set_transient('jigfli_'.md5($photos_url.$flickr_caching), $photos, 60 * $flickr_caching);
						}			
					}else{
						$photos = unserialize($this->file_get_contents_curl($photos_url));
					}

					if($photos['stat'] == "ok"){
						if($retina_ready == 'yes'){
							$calculated_max_height = $max_height*3;
						}else{
							$calculated_max_height = $max_height;
						}
						$this->images = array(); // Create a new array for the images
						if(isset($photos['photos']) && count($photos['photos']['photo']) > 0){
							if($orderby == 'rand'){
								$photos['photos']['photo'] = (array) $photos['photos']['photo'];
								shuffle($photos['photos']['photo']);
							}
							$too_small_flickr_images = 0;
							foreach ($photos['photos']['photo'] as $photo) {
								$data = array(); // Create a new array for this image
								if(isset($photo['height_t']) && $photo['height_t'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_t'];
									$data['width'] = $photo['width_t']/$photo['height_t']*$max_height;
								}elseif(isset($photo['height_s']) && $photo['height_s'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_s'];
									$data['width'] = $photo['width_s']/$photo['height_s']*$max_height;
								}elseif(isset($photo['height_n']) && $photo['height_n'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_n'];
									$data['width'] = $photo['width_n']/$photo['height_n']*$max_height;
								}elseif(isset($photo['height_m']) && $photo['height_m'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_m'];
									$data['width'] = $photo['width_m']/$photo['height_m']*$max_height;
								}elseif(isset($photo['height_z']) && $photo['height_z'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_z'];
									$data['width'] = $photo['width_z']/$photo['height_z']*$max_height;
								}elseif(isset($photo['height_c']) && $photo['height_c'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_c'];
									$data['width'] = $photo['width_c']/$photo['height_c']*$max_height;
								}elseif(isset($photo['height_l']) && $photo['height_l'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_l'];
									$data['width'] = $photo['width_l']/$photo['height_l']*$max_height;
								}elseif(isset($photo['height_h']) && $photo['height_h'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_h'];
									$data['width'] = $photo['width_h']/$photo['height_h']*$max_height;
								}elseif(isset($photo['height_k']) && $photo['height_k'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_k'];
									$data['width'] = $photo['width_k']/$photo['height_k']*$max_height;
								}else{
									$too_small_flickr_images++;
									if($this->settings['flickr_too_small_images'] !== 'upscale'){
										continue;
									}else{
										//$randomize_width = 0;
										$flickr_upscale_this = true;
									}
								}
								if($this->settings['flickr_allow_big_images'] === 'yes' && isset($photo['url_k'])){
									$data['url'] = $photo['url_k'];
								}elseif($this->settings['flickr_allow_big_images'] === 'yes' && isset($photo['url_h'])){
									$data['url'] = $photo['url_h'];
								}elseif(isset($photo['url_l'])){
									$data['url'] = $photo['url_l'];
								}elseif(isset($photo['url_c'])){
									$data['url'] = $photo['url_c'];
								}elseif(isset($photo['url_z'])){
									$data['url'] = $photo['url_z'];
								}elseif(isset($photo['url_m'])){
									$data['url'] = $photo['url_m'];
								}elseif(isset($photo['url_n'])){
									$data['url'] = $photo['url_n'];
								}elseif(isset($photo['url_s'])){
									$data['url'] = $photo['url_s'];
								}elseif(isset($photo['url_t'])){
									$data['url'] = $photo['url_t'];
								}else{
									unset($flickr_upscale_this);
									continue;
								}		
								if(isset($flickr_upscale_this))	{
									unset($flickr_upscale_this);
									$flickr_upscale_key = array_search($data['url'], $photo, true);
									if($flickr_upscale_key !== false){
										$flickr_upscale_key = substr($flickr_upscale_key, -1);
										$data['width'] = $photo['width_'.$flickr_upscale_key]/$photo['height_'.$flickr_upscale_key]*$max_height;
									}else{
										continue;
									}
								}
								if(isset($photo['title'])){
									$data['title'] = esc_attr(stripslashes($photo['title']));
								}
								if(isset($photo['description']['_content'])){
									$data['description'] = esc_attr(stripslashes($photo['description']['_content']));
								}
								if($download_link != 'no'){
									$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
								}
								if($flickr_link != 'no'){
									$data['lightbox_link'] = esc_attr(stripslashes('<a href="http://www.flickr.com/photos/'.$photo['owner'].'/'.$photo['id'].'" target="'.$this->settings['flickr_link_target'].'">'.$this->settings['flickr_link_text'].'</a>'));
								}
								if($filterby == 'on'){
									$d['filters'] = $photo['tags'];
									if(!empty($d['filters'])){
										$d['filters'] = explode(' ',($d['filters']));
										foreach ($d['filters'] as $filter_term) {
											$data['filters'][] = array($filter_term,ucfirst($filter_term));
										}
									}
								}
								array_push($this->images, $data);
							}
							if($too_small_flickr_images !== 0 && $this->settings['flickr_too_small_images'] == 'error'){
								$notice_after .= sprintf(__('Justified Image Grid: %d Flickr images are not shown because they are too small. Decrease row_height and height_deviation until all your photos show up. Tip: Start with a combined value of no larger than 200. Your current maximum height is %d (%d row_height + %d height_deviation).', 'jig_td'),$too_small_flickr_images,$calculated_max_height,$row_height,$height_deviation);
							}
						}elseif(isset($photos['photoset']) && count($photos['photoset']['photo'])){
							if($orderby == 'rand'){
								$photos['photoset']['photo'] = (array) $photos['photoset']['photo'];
								shuffle($photos['photoset']['photo']);
							}
							$too_small_flickr_images = 0;
							foreach ($photos['photoset']['photo'] as $photo) {
								$data = array(); // Create a new array for this image
								if(isset($photo['height_t']) && $photo['height_t'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_t'];
									$data['width'] = $photo['width_t']/$photo['height_t']*$max_height;
								}elseif(isset($photo['height_s']) && $photo['height_s'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_s'];
									$data['width'] = $photo['width_s']/$photo['height_s']*$max_height;
								}elseif(isset($photo['height_n']) && $photo['height_n'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_n'];
									$data['width'] = $photo['width_n']/$photo['height_n']*$max_height;
								}elseif(isset($photo['height_m']) && $photo['height_m'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_m'];
									$data['width'] = $photo['width_m']/$photo['height_m']*$max_height;
								}elseif(isset($photo['height_z']) && $photo['height_z'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_z'];
									$data['width'] = $photo['width_z']/$photo['height_z']*$max_height;
								}elseif(isset($photo['height_c']) && $photo['height_c'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_c'];
									$data['width'] = $photo['width_c']/$photo['height_c']*$max_height;
								}elseif(isset($photo['height_l']) && $photo['height_l'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_l'];
									$data['width'] = $photo['width_l']/$photo['height_l']*$max_height;
								}elseif(isset($photo['height_h']) && $photo['height_h'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_h'];
									$data['width'] = $photo['width_h']/$photo['height_h']*$max_height;
								}elseif(isset($photo['height_k']) && $photo['height_k'] >= $calculated_max_height){
									$data['thumbUrl'] = $photo['url_k'];
									$data['width'] = $photo['width_k']/$photo['height_k']*$max_height;
								}else{
									$too_small_flickr_images++;
									if($this->settings['flickr_too_small_images'] !== 'upscale'){
										continue;
									}else{
										//$randomize_width = 0;
										$flickr_upscale_this = true;
									}
									
								}
								if($this->settings['flickr_allow_big_images'] === 'yes' && isset($photo['url_k'])){
									$data['url'] = $photo['url_k'];
								}elseif($this->settings['flickr_allow_big_images'] === 'yes' && isset($photo['url_h'])){
									$data['url'] = $photo['url_h'];
								}elseif(isset($photo['url_l'])){
									$data['url'] = $photo['url_l'];
								}elseif(isset($photo['url_c'])){
									$data['url'] = $photo['url_c'];
								}elseif(isset($photo['url_z'])){
									$data['url'] = $photo['url_z'];
								}elseif(isset($photo['url_m'])){
									$data['url'] = $photo['url_m'];
								}elseif(isset($photo['url_n'])){
									$data['url'] = $photo['url_n'];
								}elseif(isset($photo['url_s'])){
									$data['url'] = $photo['url_s'];
								}elseif(isset($photo['url_t'])){
									$data['url'] = $photo['url_t'];
								}else{
									continue;
								}	
								if(isset($flickr_upscale_this))	{
									unset($flickr_upscale_this);
									$flickr_upscale_key = array_search($data['url'], $photo);
									if($flickr_upscale_key !== false){
										$flickr_upscale_key = substr($flickr_upscale_key, -1);
										$data['width'] = $photo['width_'.$flickr_upscale_key]/$photo['height_'.$flickr_upscale_key]*$max_height;
									}else{
										continue;
									}
								}
								if(isset($photo['title'])){
									$data['title'] = esc_attr(stripslashes($photo['title']));
								}
								if(isset($photo['description']['_content'])){
									$data['description'] = esc_attr(stripslashes($photo['description']['_content']));
								}
								if($download_link != 'no'){
									$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
								}
								if($flickr_link != 'no'){
									$data['lightbox_link'] = esc_attr(stripslashes('<a href="http://www.flickr.com/photos/'.$photos['photoset']['owner'].'/'.$photo['id'].'" target="'.$this->settings['flickr_link_target'].'">'.$this->settings['flickr_link_text'].'</a>'));
								}
								if($filterby == 'on'){
									$d['filters'] = $photo['tags'];
									if(!empty($d['filters'])){
										$d['filters'] = explode(' ',($d['filters']));
										foreach ($d['filters'] as $filter_term) {
											$data['filters'][] = array($filter_term,ucfirst($filter_term));
										}
									}
								}
								array_push($this->images, $data);
							}
							if($too_small_flickr_images !== 0 && $this->settings['flickr_too_small_images'] == 'error'){
								$notice_after .= sprintf(__('Justified Image Grid: %d Flickr images are not shown because they are too small. You can choose to hide this error or upscale them in Settings -> Flickr -> What to do with small images, or decrease row_height and height_deviation until all your photos show up. Tip: Start with a combined value of no larger than 200. Your current maximum height is %d (%d row_height + %d height_deviation).', 'jig_td'),$too_small_flickr_images,$calculated_max_height,$row_height,$height_deviation);
							}
						}else{
							return __('The requested photo source is not recognized.', 'jig_td');
						}

					}else{
						return __('The requested photo source cannot be loaded at this time.', 'jig_td').($photos['message'] ? ' '.$photos['message'] : '') ;
					}
				break;
				case 'instagram':
					$endpoint_url = 'https://api.instagram.com/v1';
					$first_valid_access_token = '';
					if(isset($this->settings['ig_authed']) && !empty($this->settings['ig_authed'])){
						foreach ($this->settings['ig_authed'] as $user) {
							$authed_user = $user['user_id'];
							$first_valid_access_token = $user['access_token'];
							break;
						}
					}
					if($first_valid_access_token === ''){
						return __('No access token found, please authorize an Instagram user.', 'jig_td');
					}
					if($instagram_feed !== ''){
						$authed_user = $instagram_feed;
						$endpoint_url .= '/users/self/feed?access_token='.$this->settings['ig_authed'][$instagram_feed]['access_token'];
					}elseif($instagram_recents !== ''){
						$endpoint_url .= '/users/'.$instagram_recents.'/media/recent?access_token='.$first_valid_access_token;
					}elseif($instagram_liked !== ''){
						$endpoint_url .= '/users/self/media/liked?access_token='.$this->settings['ig_authed'][$instagram_liked]['access_token'];
						$authed_user = $instagram_liked;
					}elseif($instagram_tag !== ''){
						$endpoint_url .= '/tags/'.$instagram_tag.'/media/recent?access_token='.$first_valid_access_token;
					}elseif($instagram_location !== ''){
						$endpoint_url .= '/locations/'.$instagram_location.'/media/recent?access_token='.$first_valid_access_token;
					}
										
					if($limit === '0'){
						$endpoint_url .= "&count=100";
						$limit = 100;
					}else if($limit !== ''){
						$endpoint_url .= "&count=".$limit;
						$limit = (int) $limit;
					}else{
						$endpoint_url .= "&count=20";
						$limit = 20;
					}
					$photos = $this->instagram_api_call($endpoint_url, $instagram_caching, $limit);

					if($limit !== '' && count($photos) > $limit){
						$photos = array_slice($photos, 0, $limit);
					}

					if(!isset($photos['message'])){
						$this->images = array(); // Create a new array for the images
						if(count($photos) > 0){
							if($orderby == 'rand'){
								$photos = (array) $photos;
								shuffle($photos);
							}
							if($retina_ready == 'yes'){
								$calculated_max_height = $max_height*3;
							}else{
								$calculated_max_height = $max_height;
							}
							foreach ($photos as $photo) {
								if(isset($photo->images) && ($photo->type == 'image' || $photo->type == 'video')){
									$data = array(); // Create a new array for this image
									if($photo->type == 'image'){
										$data['url'] = $photo->images->standard_resolution->url;
									}else{
										$data['link'] = $photo->link;
										$data['link_target'] = '_blank';
										$data['url'] = $photo->images->standard_resolution->url;
									}

									if($photo->images->thumbnail->height >= $calculated_max_height){
										$data['thumbUrl'] = $photo->images->thumbnail->url;
										$data['width'] = $photo->images->thumbnail->width/$photo->images->thumbnail->height*$max_height;
									}elseif($photo->images->low_resolution->height >= $calculated_max_height){
										$data['thumbUrl'] = $photo->images->low_resolution->url;
										$data['width'] = $photo->images->low_resolution->width/$photo->images->low_resolution->height*$max_height;
									}else{
										$data['width'] = $photo->images->standard_resolution->width/$photo->images->standard_resolution->height*$max_height;
									}	
									if(isset($photo->caption->text)){
										$data['title'] = esc_attr(stripslashes($photo->caption->text));
									}
							
									if($download_link != 'no'){
										$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
									}
									if($instagram_link != 'no'){
										$data['lightbox_link'] = esc_attr(stripslashes('<a href="'.$photo->link.'" target="'.$this->settings['instagram_link_target'].'">'.$this->settings['instagram_link_text'].'</a>'));
									}
									if($filterby == 'on' || $instagram_tag_filter){
										$d['filters'] = $photo->tags;
										if(!empty($d['filters'])){
											foreach ($d['filters'] as $filter_term) {
												$data['filters'][] = array($filter_term,ucfirst($filter_term));
											}
										}
									}
									array_push($this->images, $data);
								}
							}
						}else{
							return __('The requested photo source is empty.', 'jig_td');
						}

					}else{
						if(isset($photos['error_type']) && $photos['error_type'] == "OAuthAccessTokenException"){
							$this->settings['ig_authed'][$authed_user]['validity'] = 'expired';
							update_option(self::SETTINGS_NAME,$this->settings);
						}
						return __('The requested photo source cannot be loaded at this time.', 'jig_td').' '.$photos['message'];
					}
				break;
				case 'rss':
					if($limit === '0'){
						$limit = 0;
					}else if($limit !== ''){
						$limit = (int) $limit;
					}else{
						$limit = 0;
					}

					include_once(ABSPATH . WPINC . '/feed.php');

					$rss_url = explode(',',$rss_url); // Accept multiple URLs

					add_action('wp_feed_options', array($this, 'jig_add_force_rss'), 10,2);
					if(!is_numeric($rss_caching)){
						$rss = fetch_feed($rss_url);
					}else{
						$this->rss_cache_override = $rss_caching;
						add_filter('wp_feed_cache_transient_lifetime', array($this, 'jig_set_rss_cache'));
						$rss = fetch_feed($rss_url);
						remove_filter('wp_feed_cache_transient_lifetime', array($this, 'jig_set_rss_cache'));
					}
					remove_action('wp_feed_options', array($this, 'jig_add_force_rss'), 10,2);

					if(!is_wp_error($rss)){	
						$this->images = array(); // Create a new array for the images
						$rss_items = $rss->get_items(0,$rss->get_item_quantity($limit));
						if(count($rss_items) > 0){
							if($orderby == 'rand'){
								$rss_items = (array) $rss_items;
								shuffle($rss_items);
							}
							foreach ($rss_items as $rss_item_index => &$item) {
								$enclosure_links = $item->get_enclosures();
								if(!empty($enclosure_links)){
									// Gravatar images are skipped for WP
									if(isset($enclosure_links[0]) && strpos($enclosure_links[0]->get_link(), 'gravatar') === false){
										$enclosure_link = $enclosure_links[0]->get_link();
									}elseif(isset($enclosure_links[1]) && strpos($enclosure_links[1]->get_link(), 'gravatar') === false){
										$enclosure_link = $enclosure_links[1]->get_link();
									}
								}else{
									$enclosure_link = false;
								}
								//$enclosure_link = isset($enclosure_links[0]) ? $enclosure_links[0]->get_link() : false;
								if (!empty($enclosure_link)){
									$imageURL = $enclosure_link;
								}elseif($thumb = $item->get_item_tags(SIMPLEPIE_NAMESPACE_MEDIARSS, 'thumbnail')){
									$imageURL = $thumb[0]['attribs']['']['url'];
								}else{
		    						$text = html_entity_decode($item->get_content(), ENT_QUOTES, 'UTF-8');
		    						preg_match("/<img[^>]+\>/i", $text, $matches);
		    						preg_match('/src=[\'"]?([^\'" >]+)[\'" >]/', $matches[0], $link);
		    						$imageURL = urldecode($link[1]);
								}
								if(empty($imageURL)){ // if no image is found, skip that RSS item
									unset($rss_items[$rss_item_index]);
									continue;
								}
								$rss_parsed_imageURL = parse_url($imageURL);
								if(empty($rss_parsed_imageURL['host'])){ // Handle relative links in RSS
									$rss_parsed_url = parse_url($item->get_feed()->subscribe_url()); // get the current feed URL (needs to be like this because of multifeed)
									$imageURL = $rss_parsed_url['scheme'].'://'.$rss_parsed_url['host'].$imageURL;
								}
								$imageURL = str_replace(' ','%2B',$imageURL);
								$url_hash_list[] = hash('md5',$imageURL);									
								$item->jig_image_src = array($imageURL);
							}
							unset($item);
							if(!$this->jig_query_ext_images($url_hash_list)){
								$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
							}
							foreach ($rss_items as $item) {
								$item->jig_image_src = $this->jig_get_ext_imagesize($item->jig_image_src);
								if(!empty($item->jig_image_src[1]) && !empty($item->jig_image_src[2]) && $item->jig_image_src[1] > 16){
									$data = $d = array(); // Create a new array for this image
									$data['url'] = $item->jig_image_src[0];
									$data['width'] = $item->jig_image_src[1]/$item->jig_image_src[2]*$max_height;
									$data['title'] = esc_attr(stripslashes($item->get_title()));
									switch ($rss_description) {
										case 'none':
										break;
										case 'excerpt':
											// Excerpt is a controlled, textual story-based short description display that disallows html to aboid broken tags and has a fixed length
											$d['description'] = stripslashes(trim(strip_tags($item->get_description())));
											// This is stronger for matching individual words, as it disregards any whitespace between them and later recombines with single space
											preg_match_all('/\S+/m', $d['description'], $rss_words, PREG_PATTERN_ORDER);
											$rss_words = $rss_words[0];

											if (count($rss_words) > (int) $rss_excerpt_length) { // this checks if the length is really longer than desired (could be exactly that long or shorter)
													$d['description'] = implode(' ', array_slice($rss_words,0,(int) $rss_excerpt_length));
													if($rss_excerpt_ending !== 'none'){
														$d['description'] .= strtr($rss_excerpt_ending, array("(" => "[", ")" => "]"));
													}
											}
										break;
										case 'description':
											// regex removes the broken or unnecessary (p) and br tags in the beginning and the end as well as empty links, : at the end
											$d['description'] = stripslashes(
																	trim(
																		preg_replace('%<a[^>]*></a>%m', '',
																			preg_replace('%(^(<(br|/p|p></p)\s*+(/>|>))*+)|(((<(br|p></p)\s*+(/>|>))|:)*+$)%m', '',
																				strip_tags($item->get_description(),
																					'<font><span><i><b><strong><italic><br><br/><a>'
																				)
																			)
																		)
																	)
																);
										break;
										case 'datetime':
											$d['description'] = $item->get_date(get_option('date_format').' '.get_option('time_format'));
										break;
										case 'date':
											$d['description'] = $item->get_date((get_option('date_format'))); 
										break;
										case 'nicetime':
											$d['description'] = $this->jig_nice_time($item->get_date());
										break;
									}

									if(!empty($d['description'])) $data['description'] = esc_attr($d['description']);
									if($rss_links_to === 'permalink'){
										$data['link'] = $item->get_permalink();
										$data['link_target'] = $link_target;
										if($data['link_target'] == 'video' && $lightbox === 'prettyphoto' && preg_match('%(?:([^:/?#]+):)?(?://([^/?#]*))?([^?#]*\.(?:jpg|gif|png))(?:\?([^#]*))?(?:#(.*))?%m', $data['link']) !== 1){
											$data['link'] .= '?iframe=true';
										}
										$d['link_rel'] = array();
										if($data['link_target'] == '_blank'){
											$d['link_rel'][] = 'external';
										}
										if($custom_link_follow == 'no'){
											$d['link_rel'][] = 'nofollow';
										}
										$d['link_rel_imploded'] = implode(' ',$d['link_rel']);
										if($d['link_rel_imploded'] != '') $data['link_rel'] = $d['link_rel_imploded'];
									}
									if($download_link != 'no'){
										$data['download'] = esc_attr(stripslashes('<a href="'.plugins_url('download.php', __FILE__).'?file='.$data['url'].'">'.$this->settings['download_link_text'].'</a>'));
									}
									if($rss_link != 'no'){
										$data['lightbox_link'] = esc_attr(stripslashes('<a href="'.$item->get_permalink().'" target="'.$this->settings['rss_link_target'].'">'.$rss_link_text.'</a>'));
									}

									
									array_push($this->images, $data);
								}
							}
						}else{
							return __('The requested RSS feed is empty.', 'jig_td');
						}
					}else{
						$rss_sp_error_message = $rss->get_error_message();
						return __('The requested RSS feed cannot be loaded at this time.', 'jig_td').' '.(is_string($rss_sp_error_message) ? $rss_sp_error_message : $rss_sp_error_message[0]);
					}
				break;
			} // end of the big switch()
			if(empty($this->images)){		
				return __('Justified Image Grid error: there are no images to show, the items are empty.', 'jig_td');
			}
			if($link_rel){
				$link_rel = strtr($link_rel, array("(" => "[", ")" => "]"));
			}

			$borders_total = 0;
			if($outer_border_width !== 0 || $middle_border_width !== 0){
				$borders_total = (intval($outer_border_width)+intval($middle_border_width))*2;
			}
			$outer_border_CSS = '';
			$middle_border_color_CSS = '';
			$middle_border_width_CSS = '';
			$inner_border_CSS = '';
			$inner_border_display = '';
			$inner_border_width_fragment = $inner_border_width;
			if($inner_border === "hovered"){
				if($inner_border_animate === "width"){
					$inner_border_width_fragment = 0;
				}else{
					$inner_border_display = 'display:none;';
				}
			}
			if($inner_border_width !== '0'){
					$inner_border_CSS = 
							"#jig{$jig_id} .jig-border {
								bottom: 0;
								right: 0;
								left: 0;
								top: 0;
								position: absolute;
								margin:0;
								padding:0;
								z-index:auto;
								overflow:hidden;
								-webkit-transform: translateZ(0);
								border: {$inner_border_width_fragment}px solid {$inner_border_color}; /* 1px solid rgba(0, 0, 0, 0.9) */
								{$inner_border_display}
							}";
			}
			if($outer_border_width !== '0'){
				$outer_border_CSS = "border: {$outer_border_width}px solid {$outer_border_color};";
			}
			if($middle_border_width !== '0'){
				$middle_border_color_CSS = "background: {$middle_border_color};";
				$middle_border_width_CSS = "margin: {$middle_border_width}px;";
			}

			$outer_shadow_CSS = '';
			$inner_shadow_CSS = '';

			if($outer_shadow !== 'none'){
				$outer_shadow_CSS = "box-shadow: {$outer_shadow};";
			}
			if($inner_shadow !== 'none'){
				$inner_shadow_CSS = "box-shadow: {$inner_shadow} inset;";
			}
			$overlay_CSS = '';
			if($overlay != 'off'){
				$overlay_appearance_CSS = '';
				if($overlay == 'hovered'){
					$overlay_appearance_CSS .='display:none;';
				}
				$overlay_CSS = 
						"#jig{$jig_id} .jig-overlay {
							background:{$overlay_color};
							opacity: {$overlay_opacity};
							-moz-opacity: {$overlay_opacity};
							filter:alpha(opacity=".($overlay_opacity*100).");
							height:100%;
						}
						#jig{$jig_id} .jig-overlay-wrapper {
							{$overlay_appearance_CSS}
							position: absolute;
							bottom: 0;
							left: 0;
							right: 0;
							top: 0;
							-webkit-transform: translateZ(0);
							{$inner_shadow_CSS}
						}";
				if($overlay_icon === 'on'){
					$overlay_CSS .=
						"#jig{$jig_id} .jig-overlay-icon-wrapper {
							{$overlay_appearance_CSS}
							position: absolute;
							bottom: 0;
							left: 0;
							right: 0;
							top: 0;
						}";
					$overlay_icon_url_for_CSS = $overlay_icon_url ? $overlay_icon_url : plugins_url('images/magnifier.png', __FILE__);
					$overlay_CSS .="#jig{$jig_id} .jig-overlay-icon {
										background: url(".$overlay_icon_url_for_CSS.") no-repeat center center;
										opacity: {$overlay_icon_opacity};
										-moz-opacity: {$overlay_icon_opacity};
										filter:alpha(opacity=".($overlay_icon_opacity*100).");
										height:100%;
									}";

					if($retina_ready == 'yes'){
						$overlay_icon_retina_for_CSS = $overlay_icon_retina ? $overlay_icon_retina : ($overlay_icon_url ? $overlay_icon_url : plugins_url('images/magnifier@2x.png', __FILE__));
						if(!$this->jig_query_ext_images(array(hash('md5',$overlay_icon_url_for_CSS)))){
							$notice_after .= __('Cannot create database for caching external image dimensions.','jig_td');
						}
						$overlay_icon_image_for_CSS = $this->jig_get_ext_imagesize(array($overlay_icon_url_for_CSS));
						$ov_icon_px = $overlay_icon_image_for_CSS[1]."px ".$overlay_icon_image_for_CSS[2]."px";
						$overlay_CSS .= "@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 13/10), only screen and (min-resolution: 120dpi) {
												#jig{$jig_id} .jig-overlay-icon {
													background: url(".$overlay_icon_retina_for_CSS.") no-repeat center center;
															-webkit-background-size:".$ov_icon_px.";
															-moz-background-size:".$ov_icon_px.";
															-o-background-size:".$ov_icon_px.";
													 		background-size:".$ov_icon_px.";
												}
											}";
					}
						
				}
			}

			$nextgen_bc_CSS = '';
			if($ng_breadcrumb == 'yes'){
				$nextgen_bc_CSS = 
						'.jig-ngBreadcrumb {
							'.$this->settings['nextgen_breadcrumb_css'].'
						}';
			}

			$fb_bc_CSS = '';
			if(isset($fb_bc_CSS_needed)){
				$fb_bc_CSS = 
						'.jig-fbBreadcrumb {
							'.$this->settings['fb_breadcrumb_css'].'
						}';
			}
			$carousel_extra_CSS = '';
			if($lightbox == 'carousel'){
				$carousel_extra_CSS =
				'.jp-carousel-comment-post-success{
					width:auto !important;
				}';
			}
			$load_more_CSS_actual = '';
			if($load_more !== 'off'){
				$load_more_CSS_actual ="#jig{$jig_id} .jig-loadMoreButton{".($wrap_text == "no" ? '' : "
					float:left;
					margin-right: ".($thumbs_spacing*2)."px !important;")."
					".$this->settings['load_more_css']."
				}
				#jig{$jig_id} .jig-loadMoreButton:hover{
					".$this->settings['load_more_hover_css']."
				}";
			}
			$caption_CSS = '';


			if($caption != 'off'){
				$caption_appearance_CSS = $caption_desc_appearance_CSS = $image_container_additional_CSS = $caption_title_additional_CSS = $caption_desc_additional_CSS = '';
				if($caption == 'slide' || $caption == 'fade'){
					$caption_appearance_CSS = 'display:none;';
				}
				if($caption == 'below'){
					$caption_match_width = 'no';
					$v_center_captions = 'off';
				}
				if($gradient_caption_bg == 'yes'){
					$caption_match_width = 'no';
					$caption_opacity = 1;
				}
				if($caption == 'mixed'){
					$caption_desc_appearance_CSS = "#jig{$jig_id} .jig-caption-description-wrapper {display:none;}";
				}
				
				if($caption_title_size){
					$caption_title_additional_CSS .= 'font-size: '.$caption_title_size.' !important;
					line-height:normal;';
				}
				if($caption_desc_size){
					$caption_desc_additional_CSS .= 'font-size: '.$caption_desc_size.' !important;
					line-height:normal;';
				}
				if($v_center_captions == 'yes' || $v_center_captions == 'simple'){
					$caption_appearance_CSS .= 'text-align: center !important;';
					$caption_title_additional_CSS .= 'text-align: center !important;';
					$caption_desc_additional_CSS .= 'text-align: center !important;';
					$caption_align = 'center';
					//if($caption_match_width == 'yes-rounded') $caption_match_width = 'yes';
				}else if($caption_align !== 'css'){
					$caption_appearance_CSS .= 'text-align: '.$caption_align.' !important;';
					$caption_title_additional_CSS .= 'text-align: '.$caption_align.' !important;';
					$caption_desc_additional_CSS .= 'text-align: '.$caption_align.' !important;';
				}
				if($caption_match_width == 'no'){
					$caption_title_additional_CSS .= "padding:5px 0 5px;";
					$caption_desc_additional_CSS .= "padding-bottom: 5px;
													margin-top: -3px;";
				}else{
					$caption_title_additional_CSS .= "padding: 5px 7px 5px;
													vertical-align:bottom;
													background: {$caption_bg_color};
													display:inline-block;";
					if($caption_match_width == 'yes-rounded'){
						switch ($caption_align) {
							case 'center':
								$caption_title_additional_CSS .= "-webkit-border-top-left-radius: 5px;
																-webkit-border-top-right-radius: 5px;
																-moz-border-radius-topleft: 5px;
																-moz-border-radius-topright: 5px;
																border-top-left-radius: 5px;
																border-top-right-radius: 5px;";
							break;
							case 'right':
								$caption_title_additional_CSS .= "-webkit-border-top-left-radius: 5px;
																-moz-border-radius-topleft: 5px;
																border-top-left-radius: 5px;";
							break;
							case 'left':
							default:
								$caption_title_additional_CSS .= "-webkit-border-top-right-radius: 5px;
																-moz-border-radius-topright: 5px;
																border-top-right-radius: 5px;";

							break;
						}
					}
					$caption_desc_additional_CSS .= "padding: 3px 7px 5px;
													background: {$caption_bg_color};
													display:block;";
				}
				if($caption_match_width == 'no' && $caption !==  'below'){
					if($gradient_caption_bg == 'no'){
						$caption_appearance_CSS .= "background: {$caption_bg_color};";
					}
					$caption_appearance_CSS .= "padding:0 7px;";
				}else{
					if($caption !== 'below'){
						$caption_appearance_CSS .= "padding:0;";
					}else if($caption_bg_color == 'transparent' || $caption_bg_color == 'none') {
						switch ($caption_align) {
							case 'center':
								$caption_appearance_CSS .= "padding:0 7px;";
							break;
							case 'right':
								$caption_appearance_CSS .= "padding:0 0 0 7px;";
							break;
							case 'left':
							default:
								$caption_appearance_CSS .= "padding:0 7px 0 0;";
							break;
						}
					}else{
						$caption_appearance_CSS .= "padding:0 7px;";

					}
				}
				if($gradient_caption_bg == 'yes'){
					$caption_appearance_CSS .= $this->settings['gradient_caption_bg_css'];
				}
				if($caption_opacity == 1 && $caption_text_shadow != ''){
					$caption_appearance_CSS .= "text-shadow: {$caption_text_shadow};";
				}

				if($loading_background !== ''){
					$image_container_additional_CSS = "background: {$loading_background};";
				}


				$caption_CSS = 
						"#jig{$jig_id} .jig-caption-wrapper {
							max-height:100%;
							bottom: 0;
							right: 0;
							left: 0;".($caption !== 'below' ? 'position: absolute;' : "height:{$caption_height}px;background: {$caption_bg_color};")."							
							margin:0 auto;
							padding:0;
							z-index:100;
							overflow:hidden;
							opacity: {$caption_opacity};
							-moz-opacity: {$caption_opacity};
							filter:alpha(opacity=".($caption_opacity*100).");
							-webkit-transform: translateZ(0);
						}
						#jig{$jig_id} .jig-caption {
							{$caption_appearance_CSS}
							margin: 0;
						}
						#jig{$jig_id} .jig-caption-title {
							overflow: hidden;
							color:{$caption_text_color} !important;
							".$this->settings['caption_title_css']."
							{$caption_title_additional_CSS}
						}
						{$caption_desc_appearance_CSS}
						#jig{$jig_id} .jig-caption-description {
							overflow: hidden;
							color:{$caption_text_color} !important;
							".$this->settings['caption_desc_css']."
							{$caption_desc_additional_CSS}
						}
					
						#jig{$jig_id} .jig-alone{
							padding-top:5px !important;
							margin-top: 0 !important;
						}";
			}		
			$instance_css = "#jig{$jig_id} {
								padding:0;
								margin:{$margin};
								min-height:{$min_height}px;
								display: block !important;
								clear:both !important;
							}
							#jig{$jig_id} .jig-imageContainer {
								margin-right: {$thumbs_spacing}px;
								margin-bottom: {$thumbs_spacing}px;
								-webkit-user-select: none;
								float: left;	
								padding: 0;
								{$outer_border_CSS}
								{$middle_border_color_CSS}
								{$outer_shadow_CSS}
								{$image_container_additional_CSS}
							}".($allow_transp_pngs !== 'yes' ? '.justified-image-grid .jig-imageContainer img {
								background-color: white !important;
							}' : '')."
							#jig{$jig_id} .jig-overflow {
								position: relative; 
								overflow:hidden;
								vertical-align:baseline;
								{$middle_border_width_CSS}
							}
							{$caption_CSS}
							{$overlay_CSS}
							{$nextgen_bc_CSS}
							{$fb_bc_CSS}
							{$inner_border_CSS}
							{$load_more_CSS_actual}
							{$carousel_extra_CSS}
							#jig{$jig_id} .jig-clearfix:after { clear: ".($wrap_text == "no" ? "both" : "none")."; }";
		 
			if($this->settings['jquery'] !== 'legacy'){
				wp_enqueue_script('jquery');		
			}else{
				wp_register_script('jig-jq', plugins_url('js/jquery-1.8.3.min.js', __FILE__), array(), '1.8.3', true);
				wp_enqueue_script('jig-jq');		
			}
			
			$lightbox_JS = "window['jigAddLightbox{$jig_id}'] = function(){return}";
			$lightbox_class = $lightbox_narrow = '';
			if($ng_lightbox_gallery == 'yes' && isset($shadow_gallery)){ 
				$lightbox_class = '';
				$lightbox_narrow = '.jig-imageContainer ';
			}
			switch($lightbox){
				case 'prettyphoto':
        			if(!defined('JIG_SKIP_PRETTYPHOTO')){
        				global $jig_prettyphoto_activation_needed;
						$jig_prettyphoto_activation_needed = true;
						wp_register_script('jig-prettyphoto', plugins_url('js/jquery.prettyphoto.custom-min.js', __FILE__), 'jquery', '3.1.5.1.7.1', true);
						wp_enqueue_script('jig-prettyphoto');
						wp_register_style('jig-prettyphoto-style', plugins_url('css/prettyphoto.css', __FILE__), false, '3.1.5.1.7.1');
						wp_enqueue_style('jig-prettyphoto-style');
					}
					$lightbox_JS = "window['jigAddLightbox{$jig_id}'] = function(){
										if(typeof $.prettyPhoto === 'undefined' && typeof loadJustifiedImageGrid !== 'undefined'){
											loadJIGprettyPhoto($);
										}
										$('#jig{$jig_id} {$lightbox_narrow}a.jig-link').prettyPhoto({
											jig_call: true,".
											($prettyphoto_social == 'no' ? '
											social_tools: false,' : '').
											($prettyphoto_analytics == 'yes' ? '
											analytics: true,' : '').
											($this->settings['prettyphoto_deeplinking'] == 'advanced_deeplinking' ? '
											advanced_deeplinking: true,
											deeplinking: true,' : ($this->settings['prettyphoto_deeplinking'] == 'deeplinking' ? '
											advanced_deeplinking: false,
											deeplinking:true,' : '
											advanced_deeplinking: false,
											deeplinking:false,')).'
											theme: "'.$prettyphoto_theme.'",
											'.$this->settings['prettyphoto_settings']."
										});
									}";
				break;
				case 'colorbox':
					wp_deregister_script('colorbox');
					wp_register_script("colorbox", plugins_url('js/jquery.colorbox-min.js', __FILE__), 'jquery', '1.3.19', true);
					wp_enqueue_script("colorbox");
					wp_register_style('colorbox-style', plugins_url('css/colorbox'.$this->settings['colorbox_design'].'.css', __FILE__), false, '1.3.19');
					wp_enqueue_style('colorbox-style');
					$lightbox_JS = "window['jigAddLightbox{$jig_id}'] = function(){				
										$('#jig{$jig_id} {$lightbox_narrow}a.jig-link').colorbox({
											".$this->settings['colorbox_settings']."
										});
									}";
				break;
				case 'foobox':
					if(class_exists('fooboxV2') || class_exists('foobox')){
						$lightbox_class = 'jigFooBoxConnect';
						$lightbox_JS = "window['jigAddLightbox{$jig_id}'] = function(){
							window.FOOBOX.init();
						}";
					}
					break;
				case 'photoswipe':
					wp_deregister_script('klass');
					wp_register_script("klass", plugins_url('js/klass.min.js', __FILE__), 'jquery', '1.0', true);
					wp_enqueue_script("klass");
					wp_deregister_script('photoswipe');
					wp_register_script("photoswipe", plugins_url('js/code.photoswipe.jquery-3.0.5.min.js', __FILE__), 'jquery', '3.0.5', true);
					wp_enqueue_script("photoswipe");
					wp_register_style('photoswipe-style', plugins_url('css/photoswipe.css', __FILE__), false, '3.0.5');
					wp_enqueue_style('photoswipe-style');
					$lightbox_JS = "window['jigAddLightbox{$jig_id}'] = function(){";
					if(empty($shadow_galleries)){
						$shadow_galleries[] = '';
					}
					foreach ($shadow_galleries as $gallery_id) {
						$gallery_id_numeric = '_'.substr($gallery_id,strrpos($gallery_id,'-')+1);
						if($gallery_id !== ''){
							$gallery_id = '#'.$gallery_id.' ';
						}
						$lightbox_JS .= "if($('#jig{$jig_id} {$gallery_id}a.jig-link').length !== 0){
											if(typeof(JIGPhotoSwipeInstance{$jig_id}{$gallery_id_numeric}) != 'undefined' && JIGPhotoSwipeInstance{$jig_id}{$gallery_id_numeric} !== null) {
												window.Code.PhotoSwipe.unsetActivateInstance(JIGPhotoSwipeInstance{$jig_id}{$gallery_id_numeric});
												window.Code.PhotoSwipe.detatch(JIGPhotoSwipeInstance{$jig_id}{$gallery_id_numeric}); 
											}
											JIGPhotoSwipeInstance{$jig_id}{$gallery_id_numeric} = $('#jig{$jig_id} {$gallery_id}a.jig-link').photoSwipe({
												".$this->settings['photoswipe_settings']."
											});
											JIGPhotoSwipeResized = false;

											JIGPhotoSwipeInstance{$jig_id}{$gallery_id_numeric}.addEventHandler(window.Code.PhotoSwipe.EventTypes.onHide, function(e){
												$('.justified-image-grid').each(function( index ) {
													$(this).data('justifiedImageGrid').createGallery('resize');
												});
												JIGPhotoSwipeResized = true;
											});
											JIGPhotoSwipeInstance{$jig_id}{$gallery_id_numeric}.addEventHandler(window.Code.PhotoSwipe.EventTypes.onToolbarTap, function(e){
												if(e.toolbarAction === 'close'){
													if(JIGPhotoSwipeResized == false){
														$('.justified-image-grid').each(function( index ) {
															$(this).data('justifiedImageGrid').createGallery('resize');
														});
													}
												}
											});
										}else{
											return false;
										}
										";
									
					}
					$lightbox_JS .= "}";
				break;
				case 'socialgallery':
					$lightbox_class = 'jigSgConnect';
				break;
				case 'carousel':
					$lightbox_class = 'tiled-gallery gallery-caption';
					remove_all_filters( 'post_gallery', 1500 );
					$Jetpack_Carousel = new Jetpack_Carousel;
					add_filter( 'post_gallery', array( $Jetpack_Carousel, 'enqueue_assets' ), 1600, 2 );
					apply_filters('post_gallery', '', $attr);
					$link_title_field = 'title';
					$img_alt_field = 'description';

				break;
			}
			if($ng_lightbox_gallery == 'yes' && isset($shadow_gallery)){ 
				$lightbox_class = '';
			}


			// create a hidden container
			$noscript_output = '<noscript id="jig'.$jig_id.'-html" class="justified-image-grid-html">';
			$site_host = explode('/',str_replace(array('http://','https://'),'',site_url()));
			// calculate timthumb path, take CDN into account
			$timthumb_calculated_path = plugins_url('timthumb.php', __FILE__);
			if($timthumb_path){
				$timthumb_calculated_path = $timthumb_path;
			}else if($this->settings['cdn_host'] !== ''){
				$timthumb_calculated_path = str_replace($site_host[0], $this->settings['cdn_host'], $timthumb_calculated_path);
			}

			if($aspect_ratio){
				if(strrpos($aspect_ratio,':') !== false){
					$aspect_ratio_numbers = explode(':',$aspect_ratio);
					$aspect_ratio = (float) $aspect_ratio_numbers[0] / (float) $aspect_ratio_numbers[1];
				}elseif(strrpos($aspect_ratio,'/') !== false){
					$aspect_ratio_numbers = explode('/',$aspect_ratio);
					$aspect_ratio = (float) $aspect_ratio_numbers[0] / (float) $aspect_ratio_numbers[1];
				}
				if(is_numeric($aspect_ratio)){
					$aspect_ratio = round($aspect_ratio, 4);
					$max_width = round($max_height*$aspect_ratio);
				}else{
					$aspect_ratio = '';
				}
			}

			if($instagram_tag_filter !== ''){
				$instagram_tag_filter_exploded = explode(',',str_replace(array(', ','#'), array(',',''), $instagram_tag_filter));
				$instagram_tag_filter_count = count($instagram_tag_filter_exploded);	
			}

			// Post processing all images dataa
			foreach ($this->images as $image_index => &$image_element) {
				if($gallery_type == 'instagram' && $instagram_tag_filter !== ''){
					$matched_a_filter_in_image = false;
					if(isset($image_element['filters'])){
						foreach ($image_element['filters'] as $filter) {
							if(in_array($filter[0], $instagram_tag_filter_exploded)){
								$matched_a_filter_in_image = true;
								break;
							}
						}
						unset($filter);
					}
					if($matched_a_filter_in_image === false){
						unset($this->images[$image_index]);
						continue;
					}
					if($filterby == 'off'){
						unset($this->images[$image_index]['filters']);
					}
				}

				if(!$photon_activated){
					$image_element['width'] = floor($image_element['width']); // Calculate new width of TimThumb
				}else{
					$image_element['width'] = round($image_element['width']); // Calculate new width of Photon
				}

				$image_element['url'] = str_replace('+','%2B',$image_element['url']); // + in the filename drives timthumb crazy

				// This can allow animated gifs by not modifying the aspect ratio or width, just relays the img src as is
				if(!(($allow_animated_gifs === 'yes' && strpos($image_element['url'],'.gif') !== false) || $use_timthumb == 'no')){
					if($aspect_ratio){
						$image_element['width'] = $max_width;
					}

					if($randomize_width > 0){
						$randomize_width_only_this = $randomize_width;
						if($image_element['width']-$randomize_width/2 < $image_element['width']/2){
							$randomize_width_only_this = $image_element['width']/2;
						}
						mt_srand(intval(substr(base_convert(md5($image_element['url'].$max_height), 16, 10), -8),10));
						$randomize_width_only_this /= 2; 
						$image_element_original_width = $image_element['width'];
						$image_element['width'] -= mt_rand(-$randomize_width_only_this,$randomize_width_only_this);	
					}				
				}else{
					$image_element['photon'] = $image_element['url'];
					$skip_photon_for_animated_gif = true;
				}
				// Disregard custom links
				if($link_target == 'off'){
					unset($image_element['link'], $image_element['link_target']);
				}
				if($for_xml_sitemap === 'yes'){
					$sitemap_images[$image_index] = $image_element;
				}

				// rewrite URL to photon URL
				if($photon_activated && empty($skip_photon_for_animated_gif)){
					$photon_url = jetpack_photon_url($image_element['url']);
					// still serve the normal sized images from the social pages' CDNs
					if($gallery_type == 'wp_post_gallery' || $gallery_type == 'wp_recent_posts' || $gallery_type == 'nextgen'){
						$image_element['url'] = $photon_url; 
					}						
					if(strpos($photon_url,'?') === false){
						$image_element['photon'] = $photon_url.'?h='.$max_height;
						if($aspect_ratio || $randomize_width > 0){
							$image_element['photon'] = $photon_url.'?resize='.$image_element['width'].','.$max_height;
						}
					}else{
						$image_element['photon'] = substr($photon_url, 0, strpos($photon_url,'?')).'?h='.$max_height;
						if($aspect_ratio || $randomize_width > 0){
							$image_element['photon'] = substr($photon_url, 0, strpos($photon_url,'?')).'?resize='.$image_element['width'].','.$max_height;
						}
					}
					unset($photon_url);

					// or rewrite to CDN url
				}elseif($this->settings['cdn_host'] !== '' && $gallery_type !== 'flickr' && $gallery_type !== 'facebook' && $gallery_type !== 'rss'){					
					$image_element['url'] = str_replace($site_host[0], $this->settings['cdn_host'], $image_element['url']);		
					if($image_element['link']){
						$image_element['link'] = str_replace($site_host[0], $this->settings['cdn_host'], $image_element['link']);
					}
					if($for_xml_sitemap === 'yes'){
						$sitemap_images[$image_index] = $image_element;
					}
				}
				// make images findable by google
				$title_fragment = isset($image_element[$link_title_field]) ? $image_element[$link_title_field] : substr($image_element['url'],1+strrpos($image_element['url'],'/'));
				$alt_fragment = isset($image_element[$img_alt_field]) ? $image_element[$img_alt_field] : $title_fragment;
				if($title_fragment !== ''){
					$title_fragment = ' title="'.$title_fragment.'"';
				}

				if(!isset($image_element['photon'])){
					$image_src = !isset($image_element['thumbUrl']) ? $image_element['url'] : $image_element['thumbUrl'];
					$ext = '';
					if(strrpos($image_src, '.') > 2){
						$ext = "&f=".substr($image_src, strrpos($image_src, '.'));
					}
					if(!$aspect_ratio){
						$image_src = $timthumb_calculated_path."?src=".$image_src."&h=".$max_height."&q=".$quality.$ext;
					}else{
						$image_src = $timthumb_calculated_path."?src=".$image_src."&h=".$max_height."&w=".$image_element['width']."&q=".$quality.$ext;
					}
				}else{
					$image_src = $image_element['photon'];
				}

				$rel_fragments = array();
				if(isset($image_element['link_target']) && $image_element['link_target'] == '_blank'){
					$rel_fragments[] = 'external';
				}
				if(isset($image_element['link']) && isset($image_element['link_target']) && $custom_link_follow === 'no' && $image_element['link_target'] == '_blank'){
					$rel_fragments[] = 'nofollow';
				}
				$rel_fragment = ' rel="'.implode(' ',$rel_fragments).'"';

				// Filtering features
				if($filterby !== 'off'){
					if(isset($image_element['filters'])){
						foreach ($image_element['filters'] as &$filter) {
							// only adds unique tags to the filters for JS
							if(strpos($filter[0],'%') !== false){
								$filter[0] = md5($filter[0]);
							}
							$filters_for_JS[$filter[0]] = $filter[1];
							if(!empty($filters_for_JS_counter[$filter[0]])){
								$filters_for_JS_counter[$filter[0]]++;
							}else{
								$filters_for_JS_counter[$filter[0]] = 1;
							}
						}
						unset($filter);
					}
				}

				$noscript_output .= '<a href="'.(!isset($image_element['link']) ? $image_element['url'] : $image_element['link']).'"'.$title_fragment.$rel_fragment.'><img src="'.$image_src.'" alt="'.$alt_fragment.'" width="'.(!isset($image_element_original_width) ? $image_element['width'] : $image_element_original_width).'" height="'.$max_height.'" /></a>';
				unset($image_element_original_width);
				if(empty($image_element['width'])){
					unset($this->images[$image_index]);
				}
			} // end of 'post processing'

			if($filterby !== 'off'){
				if($filter_orderby == 'custom' && empty($filter_custom_order)){
					$filter_orderby = 'appearance';
				}
				$filters_for_JS = (array) $filters_for_JS;
				if($filter_orderby == 'popularity' || $filter_top_x !== '' || $filter_min_count !== ''){
					natcasesort($filters_for_JS_counter);
					$filters_for_JS_counter = array_reverse($filters_for_JS_counter);
				}
				$filters_for_JS_custom = array();
				switch ($filter_orderby) {
					case 'title_asc':
						natcasesort($filters_for_JS);
					break;
					case 'title_desc':
						natcasesort($filters_for_JS);
						$filters_for_JS = array_reverse($filters_for_JS);
					break;
					case 'random':
						$filters_for_JS = $this->shuffle_assoc($filters_for_JS);
					break;
					case 'custom':
						$filter_custom_order = explode(',',$filter_custom_order);
						$filters_for_JS_custom_key = '';
						foreach($filter_custom_order as $filter_name) {
							$filter_name = trim($filter_name);
							$filters_for_JS_custom_key = array_search($filter_name, $filters_for_JS);
							if($filters_for_JS_custom_key !== false){
								$filters_for_JS_custom[$filters_for_JS_custom_key] = $filter_name;
							}
						}
						$filters_for_JS = $filters_for_JS_custom;
					break;
					case 'popularity': // Order by the number of images with that tag
						foreach($filters_for_JS_counter as $filter_slug => $image_count_for_filter) {
							$filters_for_JS_custom[$filter_slug] = $filters_for_JS[$filter_slug];
						}
						unset($filter_slug, $image_count_for_filter);
						$filters_for_JS = $filters_for_JS_custom;
					break;
					case 'appearance':
					default:
					break;
				}

				if($filter_top_x !== ''){
					$filters_for_JS_custom = array_slice($filters_for_JS_counter, 0, (int) $filter_top_x);
					$filters_for_JS = array_intersect_key($filters_for_JS, $filters_for_JS_custom);
				}

				if($filter_min_count !== ''){
					$filters_for_JS_custom = array();
					foreach($filters_for_JS_counter as $filter_slug => $image_count_for_filter){
						if($image_count_for_filter >= $filter_min_count){
							$filters_for_JS_custom[$filter_slug] = $filters_for_JS[$filter_slug];
						}
					}
					unset($filter_slug, $image_count_for_filter);
					$filters_for_JS = $filters_for_JS_custom;
				}

				if($filter_all_button == 'yes'){
					$filters_for_JS = array_merge(array('all-items-nofilter' => $filter_all_text),$filters_for_JS);
				}
			}

			if(empty($this->images)){ //needs to be checked again
				return __('Justified Image Grid error: there are no images to show, the items are empty.', 'jig_td');
			}
			if($for_xml_sitemap === 'yes'){
				global $jig_images_for_xml_sitemap;
				if(empty($sitemap_images)){
					$jig_images_for_xml_sitemap = array_merge($jig_images_for_xml_sitemap, $this->images);
				}else{
					$jig_images_for_xml_sitemap = array_merge($jig_images_for_xml_sitemap, $sitemap_images);
				}
				return;
			}

			$noscript_output .= '</noscript>';

			$output = '';
			if($notice_before !== '') $output .= $notice_before;
			if(!$carousel_activated){
				$output .= '<div id="jig'.$jig_id.'" class="justified-image-grid jig-'.hash('md5',serialize($atts)).($lightbox_class == '' ? '' : ' '.$lightbox_class).'"><div class="jig-clearfix"></div>'.$noscript_output.'</div>';
			}else{
				$output .= Jetpack_Carousel::add_data_to_container('<div id="jig'.$jig_id.'" class="justified-image-grid jig-'.hash('md5',serialize($atts)).($lightbox_class == '' ? '' : ' '.$lightbox_class).'">');
							$output .= '<div class="jig-clearfix"></div></div>';
			}
			if($notice_after !== '') $output .= $notice_after;
			if($developer_link == 'show'){
				$output .= '<div class="jigDeveloperLink"><a href="http://codecanyon.net/item/justified-image-grid-premium-wordpress-gallery/2594251'.($this->settings['envato_user'] != '' ? '?ref='.$this->settings['envato_user'] : '').'" target="_blank" title="Justified Image Grid - Premium WordPress Gallery">'.$this->settings['developer_link_text'].'</a></div>';
			}
			$mouse_JS = '';
			if($mouse_disable == 'yes'){
				$mouse_JS = "$('#jig{$jig_id}').on('contextmenu', function(e){
								e.preventDefault();
								return false;
							});";
				if($lightbox == 'colorbox'){
					$mouse_JS .= '$("body").on("contextmenu", "#colorbox", function(e){
									e.preventDefault();
									return false;
								});';
				}else if($lightbox == 'foobox'){
					$mouse_JS .= '$("body").on("contextmenu", ".foobox-modal", function(e){
									e.preventDefault();
									return false;
								});';
				}
			}
			// legacy desaturation setting support
			if($desaturate !== ''){
				$specialfx = $desaturate;
				$specialfx_type = 'desaturate';
			}

			// remove desaturation if the thumbs are from another host as pixastic is not compatible with that
			if($this->settings['cdn_host'] !== '' || $photon_activated){
					$specialfx = 'off';
			}

			// A new object that'll hold all the settings, eventually will get passed to JS as JSON
			$this->JS_settings = array();

			// These settings have no defaults in the jQuery plugin
			$this->JS_settings['timthumb']			= $timthumb_calculated_path;
			$this->JS_settings['items']				= array_values((array) $this->images);

			// These settings have thes defaults in the jQuery plugin and only need to be included in the calling script, if they differ
			if($row_height != 190)						$this->JS_settings['targetHeight']		= (int) $row_height;
			if($height_deviation != 40)					$this->JS_settings['heightDeviation']	= (int) $height_deviation;
			if($aspect_ratio)							$this->JS_settings['aspectRatio']		= $aspect_ratio;
			if($disable_cropping !== 'no')				$this->JS_settings['disableCropping']	= $disable_cropping;
			if($randomize_width)						$this->JS_settings['randomizeWidth']	= $randomize_width;
			if($thumbs_spacing != 4)					$this->JS_settings['margins']			= (int) $thumbs_spacing;
			if($animation_speed != 300)					$this->JS_settings['animSpeed']			= (int) $animation_speed;
			if($max_rows)								$this->JS_settings['maxRows']			= (int) $max_rows;
			if($link_class)								$this->JS_settings['linkClass']			= $link_class;
			if($link_rel !== 'auto')					$this->JS_settings['linkRel']			= $link_rel;
			if($link_title_field !== 'description')		$this->JS_settings['linkTitleField']	= $link_title_field;
			if($img_alt_field !== 'title')				$this->JS_settings['imgAltField']		= $img_alt_field;
			if($wrap_text !== 'no')						$this->JS_settings['wrapText']			= $wrap_text;
			if($retina_ready !== 'yes')					$this->JS_settings['retinaReady']		= $retina_ready;
			if($quality != 90)							$this->JS_settings['quality']			= (int) $quality;
			if($retina_quality !== 'auto')				$this->JS_settings['retinaQuality']		= (int) $retina_quality;
			if($download_link !== 'no')					$this->JS_settings['downloadLink']		= $download_link;
			if($caption !== 'fade')						$this->JS_settings['caption']			= $caption;
			if($title_field !== 'title')				$this->JS_settings['titleField']		= $title_field;
			if($caption_field !== 'description')		$this->JS_settings['captionField']		= $caption_field;
			if($disable_hover !== 'no')					$this->JS_settings['disableHover']		= $disable_hover;
			if($lightbox !== 'prettyphoto')				$this->JS_settings['lightbox']			= $lightbox;
			if($overlay !== 'hovered')					$this->JS_settings['overlay']			= $overlay;
			if($overlay_icon !== 'off')					$this->JS_settings['overlayIcon']		= $overlay_icon;
			if($borders_total !== 0)					$this->JS_settings['bordersTotal']		= (int) $borders_total;
			if($specialfx !== 'off')					$this->JS_settings['specialFx']			= $specialfx;
			if($specialfx_type !== 'desaturate')		$this->JS_settings['specialFxType']		= $specialfx_type;
			if($specialfx_blend != 1)					$this->JS_settings['specialFxBlend']	= $specialfx_blend;
			if($specialfx_options !== '')				$this->JS_settings['specialFxOptions']	= explode(',', $specialfx_options);
			if($last_row !== 'normal')					$this->JS_settings['incompleteLastRow']	= $last_row;
			if($error_checking !== 'yes')				$this->JS_settings['errorChecking']		= $error_checking;

			// These have more complicated logic
			if($jig_id !== 1){
				$this->JS_settings['instance'] = $jig_id;
				$this->JS_settings['lightboxInit'] = 'jigAddLightbox'.$jig_id;
			}

			if($load_more !== 'off'){
				$this->JS_settings['limit']	= (int) $load_more_limit;
				$this->JS_settings['loadMore'] = $load_more;
				if($load_more_text !== 'Load more')							$this->JS_settings['loadMoreText']			= $load_more_text;
				if($load_more_count_text !== '(*count* images remaining)')	$this->JS_settings['loadMoreCountText']		= $load_more_count_text;
				if($load_more_auto_width !== 'on')							$this->JS_settings['loadMoreAutoWidth']		= $load_more_auto_width;
			}elseif($hidden_limit){
				if($real_limit){
					$this->JS_settings['limit']	= (int) $real_limit;
				}else{
					$this->JS_settings['limit']	= 0;
				}
			}

			if($custom_width){
				if($width_mode == 'responsive_fallback'){
					$this->JS_settings['fallbackWidth']	= (int) $custom_width;
				}elseif($width_mode == 'fixed'
					|| ($width_mode == 'fixed-mobile' && $detect->isMobile())
					|| ($width_mode == 'fixed-desktop' && !$detect->isMobile()) )
				{
					$this->JS_settings['fixedWidth'] = (int) $custom_width;
				}
			}

			if($caption !== 'off' && $v_center_captions !== 'off'){
				$this->JS_settings['verticalCenterCaptions'] = $v_center_captions;
				if($custom_fonts !== 'off')									$this->JS_settings['customFonts'] 			= $custom_fonts;
			}

			if($caption == 'below' && $caption_height != 54)				$this->JS_settings['captionHeight'] 		= (int) $caption_height;

			if($flickr_link !== 'no'){
				$this->JS_settings['lightboxLink'] = $flickr_link;
			}elseif($instagram_link !== 'no'){
				$this->JS_settings['lightboxLink'] = $instagram_link;
			}elseif($rss_link !== 'no'){
				$this->JS_settings['lightboxLink'] = $rss_link;
			}elseif($recents_link !== 'no'){
				$this->JS_settings['lightboxLink'] = $recents_link;
			}

			if($inner_border !== 'always'){
				$this->JS_settings['innerBorder'] = $inner_border;
				if($inner_border_animate !== 'width')						$this->JS_settings['innerBorderAnimate']	= $inner_border_animate;
			}
			if($inner_border_width !== '0')									$this->JS_settings['innerBorderWidth'] 	= (int) $inner_border_width;


			if(!empty($filters_for_JS)){
				$this->JS_settings['filters'] = $filters_for_JS;
				if($filter_multiple !== 'no')								$this->JS_settings['filterMultiple'] 		= $filter_multiple;
				if($filter_style !== 'buttons')								$this->JS_settings['filterStyle'] 			= $filter_style;

				if($this->settings['filter_smallest_color'] !== '#A3A3A3'){
					$this->JS_settings['filterSmallestColor'] = $this->settings['filter_smallest_color'];
				}	
				if($this->settings['filter_smallest_size'] != '11'){
					$this->JS_settings['filterSmallestSize'] = (int) $this->settings['filter_smallest_size'];
				}	
				if($this->settings['filter_largest_color'] !== '#000000'){
					$this->JS_settings['filterLargestColor'] = $this->settings['filter_largest_color'];
				}	
				if($this->settings['filter_largest_size'] != '22'){
					$this->JS_settings['filterLargestSize'] = (int) $this->settings['filter_largest_size'];
				}	
			}

			// convert all settings for JS to JSON
			$JS_settings_JSON = json_encode($this->JS_settings);
		
			$instance_js = "{$lightbox_JS}
							$('#jig{$jig_id}').justifiedImageGrid({$JS_settings_JSON});
							$(window).resize(function(){
								if(typeof resizeTo{$jig_id} !== 'undefined'){
									clearTimeout(resizeTo{$jig_id});
								}
								resizeTo{$jig_id} = setTimeout(function(){
									if($('#jig{$jig_id}').length !== 0){
										$('#jig{$jig_id}').data('justifiedImageGrid').createGallery('resize');
									}
								}, 100); 
							});
							{$mouse_JS}";
			global 	$justified_image_grid_js,
					$justified_image_grid_css,
					$justified_image_grid_ie_css,
					$justified_image_grid_filtering_css_needed,
					$jig_prettyphoto_activation_needed;
			$justified_image_grid_js .= $instance_js;

			$justified_image_grid_css .= $instance_css;
			$justified_image_grid_ie_css .= $this->jig_rgbaIE($caption_bg_color, $jig_id, $caption_match_width, $gradient_caption_bg);
			if(isset($jig_prettyphoto_activation_needed)){
				$js_print = "if(typeof $.prettyPhoto.JIG === 'undefined' && typeof loadJustifiedImageGrid !== 'undefined'){
								loadJIGprettyPhoto($);
							}".$justified_image_grid_js."
							if(typeof jigOtherPrettyPhotoIsPresent !== 'undefined'){
								$(document).ready(function(){
									setTimeout(function(){
										$(window).trigger('jigPrettyPhotoActivation');
									}, 50);
								});
							}else{
								$(window).trigger('jigPrettyPhotoActivation');
							}
						}";
			}else{
				$js_print = $justified_image_grid_js."}";
			}




			$css_print = '  .jigHiddenGallery{
								display:none !important;
							}
							.justified-image-grid .jig-imageContainer img, .justified-image-grid .jig-pixastic {
								position:absolute;
								top:0 !important;
								left:0 !important;
								margin: 0;
								padding: 0;
								border-style: none !important;
								vertical-align: baseline;
								max-width:none !important;
								max-height:none !important;
								radius: 0 !important;
								box-shadow: none !important;
								z-index: auto !important;
								-webkit-transform: translateZ(0);
								visibility: visible !important;
							}
							.justified-image-grid .jig-imageContainer a {
								margin: 0 !important;
								padding: 0 !important;
								position: static !important;
								display: inline;
							}
							.justified-image-grid a:link, .justified-image-grid a:hover, .justified-image-grid a:visited {
								text-decoration:none;
							}
							.justified-image-grid .jig-removeThis {
								visibility:hidden;
							}
							.justified-image-grid .jig-hiddenLink{
								display:none;
							}
							.jig-last {
								margin-right: 0 !important;
							}
							.jig-last:after {
								clear:both;
							}
							.justified-image-grid .tiled-gallery-caption{
								display: none !important;
							}
							.jigDeveloperLink{
								line-height: 10px;
							}
							.jigDeveloperLink a{
								font-size: 9px;
							}
							.jig-clearfix:before,
							.jig-clearfix:after {
							    content: "";
							    display: table;
							}
							.jig-clearfix:after {
							    clear: both;
							}
							.jig-clearfix {
							    zoom: 1; /* For IE 6/7 (trigger hasLayout) */
							}'.(isset($justified_image_grid_filtering_css_needed) ? "
							.jig-filterButtons,
							.jig-filterTags{
								margin-bottom: 10px;
								-webkit-touch-callout: none;
								-webkit-user-select: none;
								-khtml-user-select: none;
								-moz-user-select: none;
								-ms-user-select: none;
								user-select: none;
							}
							.jig-filterButton{
								cursor:pointer;	
								".$this->settings['filter_button_css']."
							}
							.jig-filterTag{
								float:left;
								cursor:pointer;
								".$this->settings['filter_tag_css']."
							}
							.jig-filterSingle .jig-filterButton.jig-filterButtonSelected:hover,
							.jig-filterSingle .jig-filterTag.jig-filterTagSelected:hover{
								cursor:default;
							}
							.jig-filterSingle .jig-filterButton:hover,
							.jig-filterButton.jig-filterButtonSelected,
							.jig-filterSingle .jig-filterButton.jig-filterButtonSelected:hover{
								".$this->settings['filter_button_hover_css']."
							}
							.jig-filterSingle .jig-filterTag:hover,
							.jig-filterTag.jig-filterTagSelected,
							.jig-filterSingle .jig-filterTag.jig-filterTagSelected:hover{
								".$this->settings['filter_tag_hover_css']."
							}" : "").
							$justified_image_grid_css.
							$this->settings['custom_CSS'];
				$this->dynamic_script = "<script type='text/javascript'>\r\n".$this->slib_compress_script("
							(function initJIG ($,ready) {
								if(typeof $.justifiedImageGrid !== 'undefined'){
									$js_print
								}else if(typeof $.justifiedImageGrid === 'undefined' && ready == true){
									if(typeof loadJustifiedImageGrid !== 'undefined'){
										loadJustifiedImageGrid($);
										initJIG($,true);
										return;
									}
									$('.justified-image-grid').html('<span style=\"color:red;font-weight:bold\">The Justified Image Grid JS is not loaded.</span>');
								}else{
									$(document).ready(function(){
										initJIG($,true);
									});
								}
						 	})(jQuery,false)")."\r\n</script>\r\n";
			
			$this->dynamic_style = "<style type='text/css'>\r\n".str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css_print)."\r\n</style>\r\n".($justified_image_grid_ie_css ? "<!--[if IE]><style type='text/css'>".
										str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $justified_image_grid_ie_css).
										'</style><![endif]-->' : '')."<!--[if lt IE 8]><style type='text/css'>.justified-image-grid .jig-overlay, .justified-image-grid .jig-overlay-icon-wrapper, .justified-image-grid .jig-overlay-icon {position:absolute;top:0;right:0;bottom:0;left:0;} .justified-image-grid .jig-imageContainer div {cursor: pointer;} .jig-caption-wrapper{margin:0 !important;}</style><![endif]-->\r\n";
			add_action('wp_print_footer_scripts', array($this, 'jig_print_style'), 100);
			add_action('wp_print_footer_scripts', array($this, 'jig_print_script'), 100);
			if($specialfx != 'off'){
				wp_enqueue_script('pixastic.custom.jig', plugins_url('js/pixastic.custom.jig.js', __FILE__), 'jquery', null, true);
			}
			if($caption == 'below'){
				wp_enqueue_script('dotdotdot', plugins_url('js/jquery.dotdotdot.min.js', __FILE__), 'jquery', '1.6.4', true);			
			}
			wp_enqueue_script('justified-image-grid', plugins_url('js/justified-image-grid-min.js', __FILE__), 'jquery', '1.7.1', true);
			return $output;
		}// end of jig_init_shortcode

		function slib_compress_script($buffer) {
			// JavaScript compressor by John Elliot <jj5@jj5.net>
			$replace = array(
				'#\'([^\n\']*?)/\*([^\n\']*)\'#' => "'\1/'+\'\'+'*\2'", // remove comments from ' strings
				'#\"([^\n\"]*?)/\*([^\n\"]*)\"#' => '"\1/"+\'\'+"*\2"', // remove comments from " strings
				'#/\*.*?\*/#s'            => "",      // strip C style comments
				'#[\r\n]+#'               => "\n",    // remove blank lines and \r's
				'#\n([ \t]*//.*?\n)*#s'   => "\n",    // strip line comments (whole line only)
				'#([^\\])//([^\'"\n]*)\n#s' => "\\1\n",
				                                      // strip line comments
				                                      // (that aren't possibly in strings or regex's)
				'#\n\s+#'                 => "\n",    // strip excess whitespace
				'#\s+\n#'                 => "\n",    // strip excess whitespace
				'#(//[^\n]*\n)#s'         => "\\1\n", // extra line feed after any comments left
				                                      // (important given later replacements)
				'#/([\'"])\+\'\'\+([\'"])\*#' => "/*" // restore comments in strings
			);

			$search = array_keys( $replace );
			$script = preg_replace( $search, $replace, $buffer );

			$replace = array(
				"&&\n" => "&&",
				"||\n" => "||",
				"(\n"  => "(",
				")\n"  => ")",
				"[\n"  => "[",
				"]\n"  => "]",
				"+\n"  => "+",
				",\n"  => ",",
				"?\n"  => "?",
				":\n"  => ":",
				";\n"  => ";",
				"{\n"  => "{",
				"\n]"  => "]",
				"\n)"  => ")",
				"\n}"  => "}",
				"\n\n" => "\n"
			);

			$search = array_keys( $replace );
			$script = str_replace( $search, $replace, $script );
			return trim($script);
		}


		// print the dynamic inline JS at the end of the footer scripts
		function jig_print_script(){
			echo $this->dynamic_script;
		}

		// print the dynamic inline CSS at the end of the footer scripts
		function jig_print_style(){
			echo $this->dynamic_style;
		}

		// recursive function to get recent posts
		function get_recents_recursive($args,$recents_tree_depth,$current_depth){
			$current_depth++;
			$elements = array();
			$children = get_posts($args);
			if(!empty($children)){
				$grandchildren = array();
				foreach ($children as $child => $value) {
					$value->recents_class = "jig-childPost jig-postDepth-".$current_depth;
					array_push($elements,$value);
					$args['post_parent'] = $value->ID;
					if($current_depth < $recents_tree_depth)
					$grandchildren = $this->get_recents_recursive($args,$recents_tree_depth,$current_depth);
					if(!empty($grandchildren)){
						foreach ($grandchildren as $grandchild => $grandchild_value) {
							$grandchild_value->recents_class = "jig-childPost jig-postDepth-".$current_depth;
							array_push($elements,$grandchild_value);
						}
					}
				}
				return $elements;
			}else{
				return array();
			}
		}

		// gets the dimensions either from DB or with CURL of a remote image
		// takes an array where [0] is image url (WP style) [1] and [2] would be width and height but they are unusable so far
		function jig_query_ext_images($url_hash_list){
			if(empty($url_hash_list)){
				return true;
			}
			global $wpdb;
			$original_show_errors = $wpdb->show_errors;
			$wpdb->show_errors(0);
			$tablename = $wpdb->prefix.'jig_ext_images';
			$url_hash_list = "('".implode("','",$url_hash_list)."')";
			$ext_images_data = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $tablename WHERE url_hash IN $url_hash_list", NULL));

			if(empty($ext_images_data)){
				if(strpos($wpdb->last_error, 'jig_ext_images') !== false){
						// if the last error is that the table doesn't exist
					if(!$wpdb->get_var("SHOW TABLES LIKE '$tablename'")){

						$sql = "CREATE TABLE $tablename (
						auid INT(11) NOT NULL AUTO_INCREMENT,
				        url_hash VARCHAR(40) NOT NULL,
						url TEXT NOT NULL,
						width INT(11) NOT NULL,
						height INT(11) NOT NULL,
						time_added BIGINT(20) NOT NULL,
						PRIMARY KEY auid (auid)
						);";

						require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
						dbDelta($sql);
					}

					if(!$wpdb->get_var("SHOW TABLES LIKE '$tablename'")){					
						return false;
					}

				}
				// otherwise the cache isn't created - a new check will be done with curl and it'll get inserted for next use
			}else{
				foreach ($ext_images_data as $key => $image_data) {
					wp_cache_set($image_data->url_hash, $image_data, 'jig_ext_images_data');
				}				
			}
			$wpdb->show_errors($original_show_errors);
			return true;
		}


		// gets the dimensions either from DB or with CURL of a remote image
		// takes an array where [0] is image url (WP style) [1] and [2] would be width and height but they are unusable so far
		function jig_get_ext_imagesize($image){
			$file_url = $image[0];
			if(isset($image[3])){
				$file_url = $image[3];
			}
			$image_data = wp_cache_get(hash('md5',$file_url), 'jig_ext_images_data');
			$ext_img_db_operation = false;
			if($image_data !== false){
				// if value exists in the cache
				if($this->settings['external_caching'] == 'infinite' || $image_data->time_added > time() - (int) $this->settings['external_caching']*86400){
					// it's not expired
					$image[1] = $image_data->width;
					$image[2] = $image_data->height;
				}else{
					$ext_img_db_operation = 'update';
				}		
			}else{
				$ext_img_db_operation = 'insert';
			}

			if($ext_img_db_operation !== false && in_array('curl', get_loaded_extensions())){
				//  the value doesnt exist in the cache
				$chi = curl_init();
				$c_timeout = 10; //The timeout, in seconds
				$c_max_filesize = 64000; //The max file size loaded into memory
				curl_setopt($chi, CURLOPT_URL, $file_url);
				curl_setopt($chi, CURLOPT_RETURNTRANSFER, 1);
				@curl_setopt($chi, CURLOPT_BUFFERSIZE, $c_max_filesize);
				curl_setopt($chi, CURLOPT_CONNECTTIMEOUT, $c_timeout);
				curl_setopt($chi, CURLOPT_TIMEOUT, $c_timeout);
				curl_setopt($chi, CURLOPT_FOLLOWLOCATION,false);
				$grabbed_img = @curl_exec($chi);
				curl_close($chi);
				$image[1] = $image[2] = false;
				if ($grabbed_img)
				{
					$grabbed_img = @imagecreatefromstring($grabbed_img);
					$image[1] = @imagesx($grabbed_img);
					$image[2]= @imagesy($grabbed_img);
					unset($grabbed_img, $chi);
				}
				if ($image[1] && $image[2])
				{
					global $wpdb;
					if($ext_img_db_operation == 'insert'){
						$wpdb->insert( 
							$wpdb->prefix.'jig_ext_images', 
							array( 
								'url_hash' => hash('md5',$file_url), 
								'url' => $file_url,
								'width' => $image[1],
								'height' => $image[2],
								'time_added' => time()
							), 
							array( 
								'%s', 
								'%s', 
								'%d', 
								'%d', 
								'%d' 
							) 
						);
					}else{
						// update
						$wpdb->update( 
							$wpdb->prefix.'jig_ext_images', 
							array( 
								'width' => $image[1],
								'height' => $image[2],
								'time_added' => time()
							), 
							array( 
								'url_hash' => hash('md5',$file_url)
							), 
							array( 
								'%d', 
								'%d', 
								'%d' 
							), 
							array( 
								'%s'
							) 
						);
					}
				}
			}
			return $image;
		}

		// registers the buttons for use
		function register_jig_shortcode_editor($buttons){
			array_push($buttons, "|", "jig_shortcode_editor");
			return $buttons;
		}	 
		
		// adds the button to the tinyMCE bar
		function add_jig_shortcode_editor($plugin_array){
			$plugin_array['jig_shortcode_editor'] = plugins_url('js/jig-shortcode-editor.js', __FILE__);
			return $plugin_array;
		}

		// loads the shortcode editor this way because of the translation of the strings
		function jig_shortcode_editor(){
			include 'jig-shortcode-editor.php';
			die();
		}

		// loads the FB auth page with ajaxurl, sets up a session if valid
		function jig_fb_auth(){
			$app_id = trim($this->settings['fb_app_id']);
			$app_secret = trim($this->settings['fb_app_secret']);
			$my_url = admin_url('admin-ajax.php').'?action=jig_fb_auth';
			session_start();
			if(empty($_REQUEST["code"])) {
				$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
				$dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
				. $app_id . "&scope=user_photos&redirect_uri=" . urlencode($my_url) . "&state="
				. $_SESSION['state'];
				echo("<script> top.location.href='" . $dialog_url . "'</script>");
				die();
			}

			if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
				$token_url = "https://graph.facebook.com/oauth/access_token?"
				. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
				. "&client_secret=" . $app_secret . "&code=" . $_REQUEST["code"];

				$response = $this->file_get_contents_curl($token_url);
				$params = null;
				parse_str($response, $params);

				$graph_url = "https://graph.facebook.com/me?fields=name,picture&access_token=" 
				. $params['access_token'];

				$user = json_decode($this->file_get_contents_curl($graph_url));
			     $_SESSION['fb_details'] = array(	'access_token' => $params['access_token'],
			     									'user_name' => $user->name,
			     									'expires' => (!empty($params['expires']) ? $params['expires'] : 5183990),
			     									'time_added' => time(),
			     									'user_id' => $user->id,
			     									'picture' => ($this->settings['timthumb_path'] ?
	     												$this->settings['timthumb_path'] :
	     												plugins_url('timthumb.php', __FILE__))
	     												.'?src='.(isset($user->picture->data->url) ? $user->picture->data->url : $user->picture).'&w=16&h=16&q=95',
			     									'type' => 'current_user');
				$_SESSION['fb_details']['info']['expires'] = $_SESSION['fb_details']['expires'];
				$_SESSION['fb_details']['info']['time_added'] =  $_SESSION['fb_details']['time_added'];
				$_SESSION['fb_details']['info']['time_remaining'] = $this->jig_time_left( $_SESSION['fb_details']['time_added']+$_SESSION['fb_details']['expires']);
			    $albums_url = "https://graph.facebook.com/me/albums?fields=id,link,count,from&limit=1000&access_token=".$params['access_token'];
				$albums = json_decode($this->file_get_contents_curl($albums_url));
				// if there is album data
				if(!empty($albums->data)){
					$found = 0;
					foreach ($albums->data as $key => $value) {
						if(!empty($value->count) && !empty($value->link)){
							$found++;
						}
					}
					if($found > 0){
						$_SESSION['fb_details']['info']['album_count'] = $found.' '._n('album', 'albums', $found, 'jig_td');
					}else{
						$_SESSION['fb_details']['info']['album_count'] = __('no albums so far, start adding some', 'jig_td');
					}
				}else{
					$_SESSION['fb_details']['info']['album_count'] = __('no albums so far, start adding some', 'jig_td');
				}
				echo("<script> window.close(); </script>");
			} else {
				 _e("The state does not match. You may be a victim of CSRF. Make sure that SESSIONS are enabled in your PHP environment (ask your hosting). It's more likely that this is the problem!", 'jig_td');
			}
		   die();
		}

		// used for Facebook auth: gets access token, name, and expiry from the session
		function jig_get_fb_access_token(){
			check_ajax_referer('jig_get_fb_access_token', 'security');
			$output = array();
			$code = $_REQUEST['code'];
			if($code == 'current'){
					if ( !session_id() )
						session_start();
					if(isset($_SESSION['fb_details'])){
						$output = $_SESSION['fb_details'];
						unset($_SESSION['fb_details']);
					}else{
						$output = array('error' => __("Access token acquisition wasn't successful. Please authorize yourself on Facebook then click 'Manually load Facebook data'. If you already closed the Facebook dialog, click 'Add current Facebook user' again.", 'jig_td'));
					}
			}else{
				$token_url = "https://graph.facebook.com/oauth/access_token?"
				. "client_id=" . trim($this->settings['fb_app_id']) . "&redirect_uri=" . urlencode(plugins_url('fb-auth-other-user.php', __FILE__))
				. "&client_secret=" . trim($this->settings['fb_app_secret']) . "&code=" . base64_decode($code);

				 $response = $this->file_get_contents_curl($token_url);
				$params = null;
				parse_str($response, $params);
				if(!empty($params['access_token'])){
					$graph_url = "https://graph.facebook.com/me?fields=name,picture&access_token=" 
					. $params['access_token'];
					 $user = json_decode($this->file_get_contents_curl($graph_url));
				    $output = array(	'access_token' => $params['access_token'],
	 									'user_name' => $user->name,
			     						'expires' => (!empty($params['expires']) ? $params['expires'] : 5183990),
	 									'time_added' => time(),
	 									'user_id' => $user->id,
	 									'picture' => ($this->settings['timthumb_path'] ?
	     												$this->settings['timthumb_path'] :
	     												plugins_url('timthumb.php', __FILE__))
	     												.'?src='.(isset($user->picture->data->url) ? $user->picture->data->url : $user->picture).'&w=16&h=16&q=95',
	 									'type' => 'other_user');
					$output['info']['expires'] = $output['expires'];
					$output['info']['time_added'] = $output['time_added'];
					$output['info']['time_remaining'] = $this->jig_time_left($output['time_added']+$output['expires']);
					$albums_url = "https://graph.facebook.com/me/albums?fields=id,link,count,from&limit=1000&access_token=".$params['access_token'];
					 $albums = json_decode($this->file_get_contents_curl($albums_url));
					// if there is album data
					if(!empty($albums->data)){
						$found = 0;
						foreach ($albums->data as $key => $value) {
							if(!empty($value->count) && !empty($value->link)){
								$found++;
							}
						}
						if($found > 0){
							$output['info']['album_count'] = $found.' '._n('album', 'albums', $found, 'jig_td');
						}else{
							$output['info']['album_count'] = __('no albums so far, start adding some', 'jig_td');
						}
					}else{
						$output['info']['album_count'] = __('no albums so far, start adding some', 'jig_td');
					}
				}else{
					$output = array('error' => __('Invalid code!', 'jig_td'));
				}
			}
			if(empty($output['access_token'])){
				$output = array('error' => __('SSL certificate problem, verify that the CA cert is OK: <a href="http://snippets.webaware.com.au/howto/stop-turning-off-curlopt_ssl_verifypeer-and-fix-your-php-config/" target="_blank">check this out for more information</a>', 'jig_td'));
			}
			echo json_encode($output);
			die();
		}

		// adds a Facebook page
		function jig_add_fb_page($token = '', $user_name = ''){
			check_ajax_referer('jig_add_fb_page', 'security');
			$output = array();
			$page = $_REQUEST['page'];		
			if($token == '' && $_REQUEST['token'] != ''){
				$token = $this->settings['fb_authed'][$_REQUEST['token']]['access_token'];
				$user_name = $this->settings['fb_authed'][$_REQUEST['token']]['user_name'];
			}
			if($page != ''){
				$albums_url = "https://graph.facebook.com/".$page."/albums?fields=id,link,count,from&limit=1000".($token != '' ? '&access_token='.$token : '');
				 $albums = json_decode($this->file_get_contents_curl($albums_url));
				// if there is album data
				if(!empty($albums->data)){
					$found = 0;
					foreach ($albums->data as $key => $value) {
						if(!empty($value->count) && !empty($value->link)){
							$found++;
						}
					}
					if($found > 0){
						$user_url = "https://graph.facebook.com/".$page."?fields=name,picture".($token != '' ? '&access_token='.$token : '');
						 $user = json_decode($this->file_get_contents_curl($user_url));
						$output = array(	
	     									'user_name' => $user->name,
	     									'user_id' => $user->id,
	     									'access_token' => 'public',
	     									'picture' => ($this->settings['timthumb_path'] ?
	     												$this->settings['timthumb_path'] :
	     												plugins_url('timthumb.php', __FILE__))
	     												.'?src='.(isset($user->picture->data->url) ? $user->picture->data->url : $user->picture).'&w=16&h=16&q=95',
											'type' => 'page');
						$output['info']['album_count'] = $found.' '._n('album', 'albums', $found, 'jig_td');	
						if($token != ''){
							$output['access_token'] = $token;
							if(isset($this->settings['fb_authed']) && $this->settings['fb_authed'] !== ''){
								foreach($this->settings['fb_authed'] as $key => $val){
									if($val['access_token'] === $token && $val['type'] != 'page'){
										$output['access_token'] = $token;
										$output['access_token_owner_name'] = $val['user_name'];
										$output['access_token_owner_id'] = $val['user_id'];
										$output['info']['expires'] = $val['expires'];
										$output['info']['time_added'] = $val['time_added'];
										$output['info']['time_remaining'] = $this->jig_time_left($val['time_added']+$val['expires']);
										$output['info']['owner_type'] = $val['type'];	
										break;
									}
								}
							}
						} 
						
					}else{
						$output = array('error' => __('No pictures in any album.', 'jig_td'));
					}
				}else{ // find out the reason why album data is missing
					$main_url = "https://graph.facebook.com/".$page.($token != '' ? '?access_token='.$token : '');
					 $main = json_decode($this->file_get_contents_curl($main_url));
					if($main === false || $main->error->message == "Unsupported get request." || $main->error->code == 4){
						$options = array();
						if(isset($this->settings['fb_authed'])){
							$last_token = '';
							$last_user_name = '';
							if(!empty($this->settings['fb_authed'])){
								foreach($this->settings['fb_authed'] as $key => $val){
									if($token != '' ){
										break;
									}
									if($val['type'] == 'page'){
										continue;
									}

									if($val['time_added']+$val['expires'] < time() ){
										continue;
									}
									$options[] = '<a href="javascript:jig_add_fb_page('.$val['user_id'].');">'.$val['user_name'].'</a> ';
									$last_token = $val['access_token'];
									$last_user_name = $val['user_name'];
								}
							}
							$options_count = count($options);
							if($options_count == 1){
								$this->jig_add_fb_page($last_token,$last_user_name);
							}else if($options_count == 0){
								if($token != '' ){
									$output = array('error' => sprintf(__('Demographically or geographically blocked for %1$s, maybe try again with another user.', 'jig_td'), $user_name));
								}else{
									$output = array('error' => __('Demographically or geographically blocked. Add a user first then try again.', 'jig_td'));
								}
							}else{
								$output = array('error' => __('Choose a user to access this page with', 'jig_td').' '.implode(" ".__('or', 'jig_td')." ", $options));
							}
						}
					}else{
						if(!empty($main->first_name)){
							$output = array('error' => __('Private user profile, use authorize other user instead.', 'jig_td'));
						}else if(!empty($main->error->message)){
							$output = array('error' => __('Invalid access/expired, please re-authenticate! The error from Facebook', 'jig_td').': '.$main->error->message);
						}else{
							$output = array('error' => __('No albums at all.', 'jig_td'));
						}					
					}
				}
			}else{
				$output = array('error' => __('Invalid page/not recognized.', 'jig_td'));
			}
			echo json_encode($output);
			die();
		}

		// verifies the status of authed FB items
		function jig_verify_fb_authed(){
			check_ajax_referer('jig_verify_fb_authed', 'security');
			$output = array();
			$token = $_REQUEST['token'];
			$user_id = $_REQUEST['user_id'];
			$albums_url = "https://graph.facebook.com/".$user_id."/albums?fields=id,link,count,from&limit=1000".($token != 'public' ? '&access_token='.$token : '');
			 $albums = json_decode($this->file_get_contents_curl($albums_url));

			if(!empty($albums->data)){
				$found = 0;
				foreach ($albums->data as $key => $value) {
					if(!empty($value->count) && !empty($value->link)){
						$found++;
					}
				}
				if($found > 0){
					$user_url = "https://graph.facebook.com/".$user_id."?fields=name,picture".($token != 'public' ? '&access_token='.$token : '');
					 $user = json_decode($this->file_get_contents_curl($user_url));
					$output = array(	
						'user_name' => $user->name,
						'picture' => ($this->settings['timthumb_path'] ?
	     												$this->settings['timthumb_path'] :
	     												plugins_url('timthumb.php', __FILE__))
	     												.'?src='.(isset($user->picture->data->url) ? $user->picture->data->url : $user->picture).'&w=16&h=16&q=95');	
					$output['info']['album_count'] = $found.' '._n('album', 'albums', $found, 'jig_td');
					if($token != 'public'){
							if(isset($this->settings['fb_authed']) && $this->settings['fb_authed'] !== ''){
								foreach($this->settings['fb_authed'] as $key => $val){
									if($val['access_token'] === $token && $val['type'] != 'page'){
										$output['access_token'] = $token;
										$output['access_token_owner_name'] = $val['user_name'];
										$output['access_token_owner_id'] = $val['user_id'];
										$output['info']['expires'] = $val['expires'];
										$output['info']['time_added'] = $val['time_added'];
										$output['info']['time_remaining'] = $this->jig_time_left($val['time_added']+$val['expires']);
										$output['info']['owner_type'] = $val['type'];							
										break;
									}
								}
							}
						} 
				
				}else{
					$output = array('error' => __('No pictures in any album.', 'jig_td'));
				}
			}else{ // find out the reason why album data is missing
				if(!isset($albums->error->message)){
					if($albums === false){
						$output = array('error' => __('Demographically or geographically blocked - please add this again and choose a user to authenticate with.', 'jig_td'));
					}else{
						$output = array('error' => __('No albums at all.', 'jig_td'));
					}
				}else{
					$output = array('error' => __('Invalid access/expired, please re-authenticate! The error from Facebook', 'jig_td').': '.$albums->error->message);
				}
			}
			echo json_encode($output);
			die();
		}

		// loads facebook albums for the shortcode editor
		function jig_get_fb_albums(){
			check_ajax_referer('jig_get_fb_albums', 'security');
			$token = $_REQUEST['token'];
			$user_id = $_REQUEST['user_id'];
			$output = array();
			$albums_url = "https://graph.facebook.com/".$user_id."/albums?fields=id,link,count,name&limit=1000".($token != 'public' ? '&access_token='.$token : '');
			$albums = json_decode($this->file_get_contents_curl($albums_url));

			if(!empty($albums->data)){
				$albums_count = count($albums->data);
				$found = 0;
				$output['elements'] = '';

				$output['elements'] .= '<div class="fbAlbum" id="overview">';
				$output['elements'] .= '<div class="fbAlbumLoading">'.__('loading image','jig_td').'</div>';
				$output['elements'] .= '<div class="fbAlbumPhoto"><img src="'.plugins_url('images/fb-overview-tile.jpg', __FILE__).'" /></div>';
				$output['elements'] .= '<div class="fbAlbumTitle">Overview with Timeline Photos, Cover Photos, Profile Pictures, Mobile uploads...</div>';
				$output['elements'] .= '<div class="fbAlbumCount">'.$albums_count.'</div></div>';

				$output['elements'] .= '<div class="fbAlbum" id="overview_only_albums">';
				$output['elements'] .= '<div class="fbAlbumLoading">'.__('loading image','jig_td').'</div>';
				$output['elements'] .= '<div class="fbAlbumPhoto"><img src="'.plugins_url('images/fb-overview-tile.jpg', __FILE__).'" /></div>';
				$output['elements'] .= '<div class="fbAlbumTitle">Overview with only normal albums</div>';
				$output['elements'] .= '<div class="fbAlbumCount">'.($albums_count-3).'</div></div>';

				$output['elements'] .= '<div class="fbAlbum" id="feed">';
				$output['elements'] .= '<div class="fbAlbumLoading">'.__('loading image','jig_td').'</div>';
				$output['elements'] .= '<div class="fbAlbumPhoto"><img src="'.plugins_url('images/fb-overview-tile.jpg', __FILE__).'" /></div>';
				$output['elements'] .= '<div class="fbAlbumTitle">Photos from feed (timeline + photos posted by others)</div>';
				$output['elements'] .= '<div class="fbAlbumCount">'.__('limited','jig_td').'</div></div>';	

				foreach ($albums->data as $key => $value) {
					if(!empty($value->count) && !empty($value->link)){
						$album_for_cover_url = "https://graph.facebook.com/".$value->id."/photos?fields=images".($token != 'public' ? '&access_token='.$token : '');
						$invisible = false;
						$img = false;
						if($found < 12){

							$album_for_cover = json_decode($this->file_get_contents_curl($album_for_cover_url));
							if(!empty($album_for_cover->data)){
								$img = '<div class="fbAlbumPhoto"><img src="'.($this->settings['timthumb_path'] ? $this->settings['timthumb_path'] : plugins_url('timthumb.php', __FILE__)).'?src='.$album_for_cover->data[0]->images[count($album_for_cover->data[0]->images)-4]->source.'&w=160&h=160&q=95" /></div>';
							}else{
								$invisible = true;
								$value->count = 0;
							}
						}
						if ($img != false){
							$output['elements'] .= '<div class="fbAlbum" id="'.$value->id.'"">';
							$output['elements'] .= '<div class="fbAlbumLoading">'.__('loading image','jig_td').'</div>';
							$output['elements'] .= $img;
						} else if($invisible == false){
							$output['elements'] .= '<div class="fbAlbum fbSkipImg fbImgFade" id="'.$value->id.'" data-album-for-cover-url="'.$album_for_cover_url.'">';
							$output['elements'] .= '<div class="fbAlbumToLoad">'.__('mouse over to load image','jig_td').'</div>';
						}else{
							$output['elements'] .= '<div class="fbAlbum fbNoImg" id="'.$value->id.'">';
							$output['elements'] .= '<div class="fbAlbumCantLoad">'.__('no photos in this album','jig_td').'</div>';
						}
						$output['elements'] .= '<div class="fbAlbumTitle">'.$value->name.'</div>';
						$output['elements'] .= '<div class="fbAlbumCount">'.$value->count.'</div></div>';				
						$found++;
					}
				}
				if($found == 0){
					$output = array('error' => __('No pictures in any album.', 'jig_td'));
				}
			}else{ // find out the reason why album data is missing
				if(!isset($albums->error->message)){
					if($albums === false){
						$output = array('error' => __('Demographically or geographically blocked - please add this again and choose a user to authenticate with.', 'jig_td'));
					}else{
						$output = array('error' => __('No albums at all.', 'jig_td'));
					}
				}else{
					$output = array('error' => __('Invalid access/expired, please re-authenticate! The error from Facebook', 'jig_td').': '.$albums->error->message);
				}
			}
			echo json_encode($output);
			die();
		}

		// gets the first picture of a facebook album
		function jig_get_fb_album_cover_on_demand(){
			check_ajax_referer('jig_get_fb_album_cover_on_demand', 'security');
			$album_for_cover_url = $_REQUEST['album_for_cover_url'];
			$album_for_cover = json_decode($this->file_get_contents_curl($album_for_cover_url));
			$output = array();
			$output['url'] = $album_for_cover_url;
			
			if(!empty($album_for_cover->data)){
				$output['img'] = '<div class="fbAlbumPhoto"><img src="'.($this->settings['timthumb_path'] ? $this->settings['timthumb_path'] : plugins_url('timthumb.php', __FILE__)).'?src='.$album_for_cover->data[0]->images[count($album_for_cover->data[0]->images)-4]->source.'&w=160&h=160&q=95" /></div>';
			}else{
				$output['error'] = 'empty';
			}
			echo json_encode($output);
			die();
		}

		// checks for expired auths
		function jig_check_expired(){
			if(isset($this->settings['fb_authed'])){
				if($this->settings['fb_authed'] !== ''){
					global $jig_fb_expired_notice;
					foreach($this->settings['fb_authed'] as $key => $val){
						if(!isset($val['time_added'])){
							continue;
						}
						$jig_fb_expires_time = $val['time_added']+$val['expires'];
						if(empty($val['expires']) || $jig_fb_expires_time > time()+604800){//7776000
							continue;
						}else if($jig_fb_expires_time > time()){
							$jig_fb_expired_notice .= "<div class='updated fade'><p><strong>".__('Justified Image Grid', 'jig_td').":</strong> ".sprintf(__('Facebook authorization for %1$s expires in %2$s. <a href="%3$s">Please re-authorize soon!</a>', 'jig_td'), $val['user_name'], $this->jig_time_left($jig_fb_expires_time), "options-general.php?page=justified-image-grid")."</p></div>";
						}else{
							$jig_fb_expired_notice .= "<div class='error fade'><p><strong>".__('Justified Image Grid', 'jig_td').":</strong> ".sprintf(__('Facebook authorization for %1$s has EXPIRED. <a href="%2$s">You have to re-authorize!</a>', 'jig_td'), $val['user_name'], "options-general.php?page=justified-image-grid")."</p></div>";
						}
					}
					function jig_print_fb_expired_notice(){
						global $jig_fb_expired_notice;
						echo $jig_fb_expired_notice;
					}
					add_action('admin_notices', 'jig_print_fb_expired_notice');		
				}		
			}
			if(isset($this->settings['ig_authed'])){
				if($this->settings['ig_authed'] !== ''){
					global $jig_ig_expired_notice;
					foreach($this->settings['ig_authed'] as $key => $val){
						if($val['validity'] === 'expired'){
							$jig_ig_expired_notice .= "<div class='error fade'><p><strong>".__('Justified Image Grid', 'jig_td').":</strong> ".sprintf(__('Istagram authorization for %1$s has EXPIRED. <a href="%2$s">You have to re-authorize!</a>', 'jig_td'), $val['full_name'].' ('.$val['user_name'].')', "options-general.php?page=justified-image-grid")."</p></div>";
						}
					}
					function jig_print_ig_expired_notice(){
						global $jig_ig_expired_notice;
						echo $jig_ig_expired_notice;
					}
					add_action('admin_notices', 'jig_print_ig_expired_notice');				
				}
			}
		}
		// adds a Flickr user
		function jig_add_fli_user(){
			check_ajax_referer('jig_add_fli_user', 'security');
			$output = array();
			$user = $_REQUEST['user'];
			$fli_api_key = trim($this->settings['fli_api_key']);
			if($user != ''){
				if(strrpos($user, 'flickr.com/') === false){
					$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.people.findByUsername&username=".$user;
					$rsp = unserialize($this->file_get_contents_curl($flickr_url));
					if($rsp['stat'] == "ok"){
						$nsid = $rsp['user']['id'];
					}else{
						$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.urls.lookupUser&url=http://www.flickr.com/people/".$user;
						$rsp = unserialize($this->file_get_contents_curl($flickr_url));
						if($rsp['stat'] == "ok"){
							$nsid = $rsp['user']['id'];
						}elseif($rsp['code'] == 100){
							$output = array('error' => sprintf(__("Can'The API key is not valid or not set. The Error from Flickr: %s (code %d)", 'jig_td'),'<a href="http://www.xflickr.com/fusr/" target="_blank">Flickr user nsid lookup</a>', $rsp['message'],$rsp['code']));
						}else{
							$output = array('error' => sprintf(__("Can't find the user. Try adding the profile URL or your NSID (%s). The error from Flickr: %s (code %d)", 'jig_td'),'<a href="http://www.xflickr.com/fusr/" target="_blank">Flickr user nsid lookup</a>', $rsp['message'],$rsp['code']));
						}
					}
					//get userid by name: flickr.people.findByUsername 
				}else{
					$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.urls.lookupUser&url=".$user;
					$rsp = unserialize($this->file_get_contents_curl($flickr_url));
					if($rsp['stat'] == "ok"){
						$nsid = $rsp['user']['id'];
					}else{
						$output = array('error' => sprintf(__("Can't find the user via that URL. Try adding username or NSID instead. The error from Flickr: %s (code %d)", 'jig_td'),$rsp->message,$rsp->code));
					}
				}
				if(isset($nsid)){
					$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.people.getInfo&user_id=".$nsid;
					$rsp = unserialize($this->file_get_contents_curl($flickr_url));
					if($rsp['stat'] == "ok"){
						$person = $rsp['person'];
						$output = array(	
	     									'user_name' => $person['username']['_content'],
	     									'user_id' => $person['nsid'],
	     									'user_alias' => (isset($person['path_alias']) ? $person['path_alias'] : $person['username']['_content']),
	     									'icon' => ($this->settings['timthumb_path'] ?
	     												$this->settings['timthumb_path'] :
	     												plugins_url('timthumb.php', __FILE__))
	     												.'?src='.($person['iconserver'] > 0 ?
	     													"http://farm".$person['iconfarm'].".staticflickr.com/".$person['iconserver']."/buddyicons/".$person['id'].".jpg" :
	     													"http://www.flickr.com/images/buddyicon.gif")
	     												.'&w=16&h=16&q=95'
	     								);
					}elseif($rsp['code'] == 100){
						$output = array('error' => sprintf(__("The API key is not valid or not set. The Ehe error from Flickr: %s (code %d)", 'jig_td'),'<a href="http://www.xflickr.com/fusr/" target="_blank">Flickr user nsid lookup</a>', $rsp['message'],$rsp['code']));
					}else{
						$output = array('error' => sprintf(__("Can't find the user. Try adding the profile URL or your NSID (%s). The error from Flickr: %s (code %d)", 'jig_td'),'<a href="http://www.xflickr.com/fusr/" target="_blank">Flickr user nsid lookup</a>', $rsp['message'],$rsp['code']));
					}
				}
			}else{
				$output = array('error' => __('Invalid user/not recognized.', 'jig_td'));
			}
			echo json_encode($output);
			die();
		}

		// loads Flickr types available for a given user
		function jig_get_fli_types(){
			check_ajax_referer('jig_get_fli_types', 'security');
			$user_id = $_REQUEST['user_id'];
			$output = array();
			$output['elements'] = '';
			$fli_api_key = trim($this->settings['fli_api_key']);

			// check for the photostream (public photos)
			$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.people.getPublicPhotos&per_page=1&user_id=".$user_id;
			$rsp = unserialize($this->file_get_contents_curl($flickr_url));
			if($rsp['photos']['total'] > 0){
				// got photos
				$output['elements'] .= '<div class="updateButton fliTypeBtn fliPhotostreamBtn">Photostream</div>';
			}elseif($rsp['stat'] == 'fail'){
				echo json_encode(array('error' => sprintf(__("Error from Flickr: %s (code %d)", 'jig_td'),$rsp['message'],$rsp['code'])));
				die();
			}

			// check for favorites
			$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.favorites.getPublicList&per_page=1&user_id=".$user_id;
			$rsp = unserialize($this->file_get_contents_curl($flickr_url));
			if($rsp['photos']['total'] > 0){
				// got favs
				$output['elements'] .= '<div class="updateButton fliTypeBtn fliFavoritesBtn">Favorites</div>';

			}

			// check for groups
			$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.people.getPublicGroups&user_id=".$user_id;
			$rsp = unserialize($this->file_get_contents_curl($flickr_url));
			if(count($rsp['groups']['group']) > 0){
				// got groups
				$output['elements'] .= '<div class="updateButton fliTypeBtn" id="fliGroupSelector">Group pool (+)</div>';
			}

			// check for 
			$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.photosets.getList&per_page=1&user_id=".$user_id;
			$rsp = unserialize($this->file_get_contents_curl($flickr_url));
			if($rsp['photosets']['total'] > 0){
				// got photosets
				$output['elements'] .= '<div class="updateButton fliTypeBtn" id="fliPhotosetSelector">Photoset (+)</div>';
			}
			// check for galleries
			$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.galleries.getList&per_page=1&user_id=".$user_id;
			$rsp = unserialize($this->file_get_contents_curl($flickr_url));
			if($rsp['galleries']['total'] > 0){
				// got groups
				$output['elements'] .= '<div class="updateButton fliTypeBtn" id="fliGallerySelector">Gallery (+)</div>';
			}

			if($output['elements'] == ''){
				$output['error'] .= '<div id="fliError">'.__("You don't have any resource on Flickr that this plugin could load!","jig_td").'</div>';
			}
				
			echo json_encode($output);
			die();
		}


		// loads Flickr elements to choose from given a certain type
		function jig_get_fli_elements(){
			check_ajax_referer('jig_get_fli_elements', 'security');
			$user_id = $_REQUEST['user_id'];
			$type = $_REQUEST['type'];
			$output = array();
			$output['elements'] = '';
			$fli_api_key = trim($this->settings['fli_api_key']);

			switch($type){
				case 'group':
					$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.people.getPublicGroups&user_id=".$user_id;
					$rsp = unserialize($this->file_get_contents_curl($flickr_url));
					if(isset($rsp['groups']['group'])){
						$found = 0;
						foreach ($rsp['groups']['group'] as $group) {
							if($group['pool_count'] > 0){
								$img = false;
								$icon = ($group['iconserver'] > 0 ? 'http://farm'.$group['iconfarm'].'.staticflickr.com/'.$group['iconserver'].'/buddyicons/'.$group['nsid'].'.jpg' : 'http://www.flickr.com/images/buddyicon.gif');
								if($found < 20){
									$img = '<div class="fliElementPhoto"><img src="'.$icon.'" /></div>';
								}
								if ($img != false){
									$output['elements'] .= '<div class="fliElement fliGroup" id="'.$group['nsid'].'">';
									$output['elements'] .= '<div class="fliElementLoading">'.__('loading','jig_td').'</div>';
									$output['elements'] .= $img;
								} else {
									$output['elements'] .= '<div class="fliElement fliGroup fliSkipImg fliImgFade" id="'.$group['nsid'].'" data-cover="'.$icon.'">';
									$output['elements'] .= '<div class="fliElementToLoad">'.__('hover','jig_td').'</div>';
								}
								$output['elements'] .= '<div class="fliElementTitle"><p>'.$group['name'].'</p></div></div>';			
								$found++;
							}
						}
					}
				break;
				case 'photoset':
					$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.photosets.getList&per_page=500&user_id=".$user_id;
					$rsp = unserialize($this->file_get_contents_curl($flickr_url));
					if($rsp['photosets']['total'] > 0){
						$found = 0;
						foreach ($rsp['photosets']['photoset'] as $photoset) {
							if($photoset['photos'] > 0){
								$img = false;
								$cover = 'http://farm'.$photoset['farm'].'.staticflickr.com/'.$photoset['server'].'/'.$photoset['primary'].'_'.$photoset['secret'].'_q.jpg';
								if($found < 10){
									$img = '<div class="fliElementPhoto"><img src="'.$cover.'" /></div>';
								}
								if ($img != false){
									$output['elements'] .= '<div class="fliElement" id="'.$photoset['id'].'">';
									$output['elements'] .= '<div class="fliElementLoading">'.__('loading image','jig_td').'</div>';
									$output['elements'] .= $img;
								} else {
									$output['elements'] .= '<div class="fliElement fliSkipImg fliImgFade" id="'.$photoset['id'].'" data-cover="'.$cover.'">';
									$output['elements'] .= '<div class="fliElementToLoad">'.__('mouse over to load','jig_td').'</div>';
								}
								$output['elements'] .= '<div class="fliElementTitle">'.$photoset['title']['_content'].'</div>';
								$output['elements'] .= '<div class="fliElementCount">'.$photoset['photos'].'</div></div>';				
								$found++;
							}
						}
					}
				break;
				case 'gallery':
					$flickr_url = "http://api.flickr.com/services/rest?api_key=".$fli_api_key."&format=php_serial&method=flickr.galleries.getList&per_page=500&user_id=".$user_id;
					$rsp = unserialize($this->file_get_contents_curl($flickr_url));
					if($rsp['galleries']['total'] > 0){
						$found = 0;
						foreach ($rsp['galleries']['gallery'] as $gallery) {
							if($gallery['count_photos'] > 0){
								$img = false;
								$cover = 'http://farm'.$gallery['primary_photo_farm'].'.staticflickr.com/'.$gallery['primary_photo_server'].'/'.$gallery['primary_photo_id'].'_'.$gallery['primary_photo_secret'].'_q.jpg';
								if($found < 10){
									$img = '<div class="fliElementPhoto"><img src="'.$cover.'" /></div>';
								}
								if ($img != false){
									$output['elements'] .= '<div class="fliElement" id="'.$gallery['id'].'">';
									$output['elements'] .= '<div class="fliElementLoading">'.__('loading image','jig_td').'</div>';
									$output['elements'] .= $img;
								} else {
									$output['elements'] .= '<div class="fliElement fliSkipImg fliImgFade" id="'.$gallery['id'].'" data-cover="'.$cover.'">';
									$output['elements'] .= '<div class="fliElementToLoad">'.__('mouse over to load','jig_td').'</div>';
								}
								$output['elements'] .= '<div class="fliElementTitle">'.$gallery['title']['_content'].'</div>';
								$output['elements'] .= '<div class="fliElementCount">'.$gallery['count_photos'].'</div></div>';				
								$found++;
							}
						}
					}
				break;
			}

			if($output['elements'] == ''){
				$output['error'] = '<div id="fliError">'.__("You don't have resources of this type on Flickr!","jig_td").'</div>';
			}
				
			echo json_encode($output);
			die();
		}

		// loads the IG auth page with ajaxurl, sets up a session if valid
		function jig_ig_auth(){
			$client_id = trim($this->settings['ig_client_id']);
			$client_secret = trim($this->settings['ig_client_secret']);
			$my_url = admin_url('admin-ajax.php').'?action=jig_ig_auth';
			session_start();
			if(empty($_REQUEST["code"])) {
				$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
				$dialog_url = "https://api.instagram.com/oauth/authorize/?client_id=" 
				. $client_id . "&redirect_uri=" . urlencode($my_url) . "&response_type=code&state="
				. $_SESSION['state'];
				echo("<script> top.location.href='" . $dialog_url . "'</script>");
				die();
			}
			if(!empty($_REQUEST["error"]) && !empty($_REQUEST["error_reason"]) && !empty($_REQUEST["error_description"])){
				echo ($_REQUEST["error_description"]);
				die();
			}
			if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
				$response = $this->file_get_contents_curl_post('https://api.instagram.com/oauth/access_token', http_build_query(array(
							'client_id' => $client_id,
							'client_secret' => $client_secret,
							'grant_type' => 'authorization_code',
							'redirect_uri' => $my_url,
							'code' => $_REQUEST["code"]
							)));

				$json_response = json_decode($response);
				$user = $json_response->user;

				$_SESSION['ig_details'] = array(	'access_token' => $json_response->access_token,
 									'user_name'		=> $user->username,
 									'full_name'		=> trim(preg_replace("/[^\w\s]+/", "", $user->full_name)),
 									'validity'		=> 'valid',
 									'id' 			=> $user->id,
 									'picture' 		=> ($this->settings['timthumb_path'] ?
											$this->settings['timthumb_path'] :
											plugins_url('timthumb.php', __FILE__))
											.'?src='.$user->profile_picture.'&w=16&h=16&q=95');			
				echo("<script> window.close(); </script>");
			} else {
				 _e("The state does not match. You may be a victim of CSRF.", 'jig_td');
			}
		   die();
		}

		// used for Instagram auth: gets access token, name, and details from the session
		function jig_get_ig_access_token(){
			check_ajax_referer('jig_get_ig_access_token', 'security');
			$output = array();
			if ( !session_id() )
				session_start();
			if(isset($_SESSION['ig_details'])){
				$output = $_SESSION['ig_details'];
				unset($_SESSION['ig_details']);
			}else{
				$output = array('error' => __("Access token acquisition wasn't successful. Please authorize yourself on Instagram then click 'Manually load Instagram data'. If you already closed the Instagram dialog, click 'Add current Instagram user' again.", 'jig_td'));
			}
			echo json_encode($output);
			die();
		}


		// verifies the status of authed Instagram users
		function jig_verify_ig_authed(){
			check_ajax_referer('jig_verify_ig_authed', 'security');
			$output = array();
			$token = $_REQUEST['token'];
			$user_id = $_REQUEST['user_id'];
			
			$user_url = "https://api.instagram.com/v1/users/".$user_id."?access_token=".$token;
			$user = json_decode($this->file_get_contents_curl($user_url));
			if(!empty($user->data)){
				$output = array(	
					'full_name'		=> trim(preg_replace("/[^\w\s]+/", "", $user->data->full_name)),
					'user_name'		=> $user->data->username,
					'validity'		=> 'valid',
					'picture'		=> ($this->settings['timthumb_path'] ?
													$this->settings['timthumb_path'] :
													plugins_url('timthumb.php', __FILE__))
													.'?src='.$user->data->profile_picture.'&w=16&h=16&q=95');	
		
			}else{ 
				if(isset($user->meta->error_message) && isset($user->meta->error_type)){
					if($user->meta->error_type == "OAuthAccessTokenException"){
						$this->settings['ig_authed'][$user_id]['validity'] = 'expired';
						update_option(self::SETTINGS_NAME,$this->settings);
						$output = array('error' 		=> __('Error', 'jig_td').': '.$user->meta->error_type.' Code: '.$user->meta->code.', '.$user->meta->error_message,
										'error_type'	=> "OAuthAccessTokenException");

					}else{
						$output = array('error' => __('Error', 'jig_td').': '.$user->meta->error_type.' Code: '.$user->meta->code.', '.$user->meta->error_message);
					}					
				}else{
					$output = array('error' => __('Server Error (is SSL set up properly on your server?)', 'jig_td').$user);
				}
			}
			echo json_encode($output);
			die();
		}

		// provides Instagram user search results for the shortcode editor
		function jig_instagram_search_users(){
			check_ajax_referer('jig_instagram_search_users', 'security');
			$output = array();
			$search_value = urlencode($_REQUEST['search_value']);
			if($search_value === ''){
				$output = array('error' => __('Empty search query.', 'jig_td'));
				echo json_encode($output);
				die();
			}
			$first_valid_access_token = '';
			if(isset($this->settings['ig_authed']) && !empty($this->settings['ig_authed'])){
				foreach ($this->settings['ig_authed'] as $user) {
					$authed_user = $user['id'];
					$first_valid_access_token = $user['access_token'];
					break;
				}
			}
			if($first_valid_access_token === ''){
				$output = array('error' => __('No access token found, please authorize an Instagram user.', 'jig_td'));
				echo json_encode($output);
				die();
			}

			$search_url = "https://api.instagram.com/v1/users/search?q=".$search_value."&access_token=".$first_valid_access_token;
			$search_result = json_decode($this->file_get_contents_curl($search_url));
			if(!empty($search_result->data)){
				$output['elements'] = array();
				array_push($output['elements'], '<div id="igSelectUserText">'.__('Select an Instagram user below or search again', 'jig_td').'</div>');
				foreach ($search_result->data as $key => $user) {
					array_push($output['elements'], '<div class="updateButton igSmallBtn igNameBtn" data-instagram-user-id="'.$user->id.'">
														<img src="'.($this->settings['timthumb_path'] ?
															$this->settings['timthumb_path'] :
															plugins_url('timthumb.php', __FILE__))
															.'?src='.$user->profile_picture.'&w=16&h=16&q=95">'
														.$user->full_name.' ('.$user->username.')</div>');
				}
			}else{ 
				if(isset($search_result->meta->error_message)){
					if(isset($search_result->meta->error_type) && $search_result->meta->error_type == "OAuthAccessTokenException"){
						$this->settings['ig_authed'][$authed_user]['validity'] = 'expired';
						update_option(self::SETTINGS_NAME,$this->settings);
					}
					$output = array('error' => __('Error', 'jig_td').': '.$search_result->meta->error_type.' Code: '.$search_result->meta->code.', '.$search_result->meta->error_message);
				}else if($search_result === NULL){
					$output = array('error' => __('Connection/CURL problem, please try again.', 'jig_td'));
				}else if(count($search_result->data) === 0) {
					$output = array('error' => __('No users found.', 'jig_td'));
				}else{
					$output = array('error' => __('Server Error (is SSL set up properly on your server?)', 'jig_td').$search_result);

				}
			}
			echo json_encode($output);
			die();
		}

		// provides Instagram tag search results for the shortcode editor
		function jig_instagram_search_tags(){
			check_ajax_referer('jig_instagram_search_tags', 'security');
			$output = array();
			$search_value = urlencode($_REQUEST['search_value']);
			if($search_value === ''){
				$output = array('error' => __('Empty search query.', 'jig_td'));
				echo json_encode($output);
				die();
			}
			$first_valid_access_token = '';
			if(isset($this->settings['ig_authed']) && !empty($this->settings['ig_authed'])){
				foreach ($this->settings['ig_authed'] as $user) {
					$authed_user = $user['id'];
					$first_valid_access_token = $user['access_token'];
					break;
				}
			}
			if($first_valid_access_token === ''){
				$output = array('error' => __('No access token found, please authorize an Instagram user.', 'jig_td'));
				echo json_encode($output);
				die();
			}
			$search_url = "https://api.instagram.com/v1/tags/search?q=".$search_value."&access_token=".$first_valid_access_token;
			$search_result = json_decode($this->file_get_contents_curl($search_url));
			if(!empty($search_result->data)){
				$output['elements'] = array();
				if(count($search_result->data) > 1){
					array_push($output['elements'], '<div id="igSelectUserText">'.__('Your desired tag exists in variations on Instagram. The most relevant is selected for use.', 'jig_td').'</div>');
				}else{
					array_push($output['elements'], '<div id="igSelectUserText">'.__('Your desired tag exists on Instagram and is now selected for use.', 'jig_td').'</div>');
				}
				foreach ($search_result->data as $key => $tag) {
					array_push($output['elements'], '<div class="updateButton igSmallBtn igTagBtn" data-instagram-tag="'.$tag->name.'">'.$tag->name.'</div>');
				}
			}else{ 
				if(isset($search_result->meta->error_message)){
					if(isset($search_result->meta->error_type) && $search_result->meta->error_type == "OAuthAccessTokenException"){
						$this->settings['ig_authed'][$authed_user]['validity'] = 'expired';
						update_option(self::SETTINGS_NAME,$this->settings);
					}
					$output = array('error' => __('Error', 'jig_td').': '.$search_result->meta->error_type.' Code: '.$search_result->meta->code.', '.$search_result->meta->error_message);
				}else if($search_result === NULL){
					$output = array('error' => __('Connection/CURL problem, please try again.', 'jig_td'));
				}else if(count($search_result->data) === 0) {
					$output = array('error' => __('There is no such tag.', 'jig_td'));
				}else{
					$output = array('error' => __('Server Error (is SSL set up properly on your server?)', 'jig_td').$search_result);

				}
			}
			echo json_encode($output);
			die();
		}

		// provides Instagram loaction search results for the shortcode editor
		function jig_instagram_search_locations(){
			check_ajax_referer('jig_instagram_search_locations', 'security');
			$output = array();
			$foursquareid = urlencode($_REQUEST['foursquareid']);
			if($foursquareid === ''){
				$output = array('error' => __("Can't search for empty coordinates.", 'jig_td'));
				echo json_encode($output);
				die();
			}
			$first_valid_access_token = '';
			if(isset($this->settings['ig_authed']) && !empty($this->settings['ig_authed'])){
				foreach ($this->settings['ig_authed'] as $user) {
					$authed_user = $user['id'];
					$first_valid_access_token = $user['access_token'];
					break;
				}
			}
			if($first_valid_access_token === ''){
				$output = array('error' => __('No access token found, please authorize an Instagram user.', 'jig_td'));
				echo json_encode($output);
				die();
			}
			$search_url = "https://api.instagram.com/v1/locations/search?foursquare_v2_id=".$foursquareid."&access_token=".$first_valid_access_token;
			$search_result_raw = $this->file_get_contents_curl($search_url);
			$search_result = json_decode($search_result_raw);
			if(!empty($search_result->data)){
				$output['elements'] = array();
				array_push($output['elements'], '<div id="igSelectUserText">'.__('Your desired location exists on Instagram and is now selected for use.', 'jig_td').'</div>');
				foreach ($search_result->data as $key => $location) {
					array_push($output['elements'], '<div class="updateButton igSmallBtn igLocationBtn" data-instagram-location-id="'.$location->id.'">'.$location->name.'</div>');
				}
			}else{ 
				if(isset($search_result->meta->error_message)){
					if(isset($search_result->meta->error_type) && $search_result->meta->error_type == "OAuthAccessTokenException"){
						$this->settings['ig_authed'][$authed_user]['validity'] = 'expired';
						update_option(self::SETTINGS_NAME,$this->settings);
					}
					$output = array('error' => __('Error', 'jig_td').': '.$search_result->meta->error_type.' Code: '.$search_result->meta->code.', '.$search_result->meta->error_message);
				}else if($search_result === NULL){
					$output = array('error' => __('Connection/CURL problem, please try again.', 'jig_td'));
				}else if(count($search_result->data) === 0) {
					$output = array('error' => __('There is no Instagram place at that location.', 'jig_td'));
				}else{
					$output = array('error' => __('Server Error (is SSL set up properly on your server?)', 'jig_td').$search_result);

				}
			}
			echo json_encode($output);
			die();
		}
		// Without foursquare
		/*function jig_instagram_search_locations(){
			check_ajax_referer('jig_instagram_search_locations', 'security');
			$output = array();
			$lat = urlencode($_REQUEST['lat']);
			$lng = urlencode($_REQUEST['lng']);
			if($lat === '' || $lng === ''){
				$output = array('error' => __("Can't search for empty coordinates.", 'jig_td'));
				echo json_encode($output);
				die();
			}
			$first_valid_access_token = '';
			if(isset($this->settings['ig_authed']) && !empty($this->settings['ig_authed'])){
				foreach ($this->settings['ig_authed'] as $user) {
					$authed_user = $user['id'];
					$first_valid_access_token = $user['access_token'];
					break;
				}
			}
			if($first_valid_access_token === ''){
				$output = array('error' => __('No access token found, please authorize an Instagram user.', 'jig_td'));
				echo json_encode($output);
				die();
			}
			$search_url = "https://api.instagram.com/v1/locations/search?lat=".$lat."&lng=".$lng."&distance=5000&access_token=".$first_valid_access_token;
			$search_result_raw = $this->file_get_contents_curl($search_url);
			$search_result = json_decode($search_result_raw);
			if(!empty($search_result->data)){
				$output['elements'] = array();
				array_push($output['elements'], '<div id="igSelectUserText">'.__('Choose the desired place', 'jig_td').'</div>');

				foreach ($search_result->data as $key => $location) {
					array_push($output['elements'], '<div class="updateButton igSmallBtn igLocationBtn" data-instagram-location-id="'.$location->id.'">'.$location->name.'</div>');
				}
			}else{ 
				if(isset($search_result->meta->error_message)){
					if(isset($search_result->meta->error_type) && $search_result->meta->error_type == "OAuthAccessTokenException"){
						$this->settings['ig_authed'][$authed_user]['validity'] = 'expired';
						update_option(self::SETTINGS_NAME,$this->settings);
					}
					$output = array('error' => __('Error', 'jig_td').': '.$search_result->meta->error_type.' Code: '.$search_result->meta->code.', '.$search_result->meta->error_message);
				}else if($search_result === NULL){
					$output = array('error' => sprintf(__('Connection/CURL problem, please try again. The search URL was this: %s, please note that the Location search API may be down. The result from Instagram was: %s', 'jig_td'),'<a href="'.$search_url.'" target="_blank">Instagram API link</a>',$search_result_raw));
				}else if(count($search_result->data) === 0) {
					$output = array('error' => __('There is no Instagram place at that location.', 'jig_td'));
				}else{
					$output = array('error' => __('Server Error (is SSL set up properly on your server?)', 'jig_td').$search_result);

				}
			}
			echo json_encode($output);
			die();
		}*/
		


		// Recursive function to call Instagram API and ensure that the desired amount of photos is fetched!
		function instagram_api_call($endpoint_url = '', $instagram_caching = 0, $limit = '', $photos_count = 0){	
			if($instagram_caching > 0){
				$cached_value = get_transient('jigig_'.md5($endpoint_url.$instagram_caching));
				if(!empty($cached_value) == true){
					$results = $cached_value;
				}else{
					$results = $this->file_get_contents_curl($endpoint_url);
					set_transient('jigig_'.md5($endpoint_url.$instagram_caching), $results, 60 * $instagram_caching);
				}			

			}else{
				$results = $this->file_get_contents_curl($endpoint_url);
			}
			$results = json_decode($results);
			if(!isset($results->data) || (isset($results->data) && empty($results->data))){
				if(isset($results->meta) && isset($results->meta->error_type) && isset($results->meta->error_message)){
					return array('message'		=> __('Error', 'jig_td').': '.$results->meta->error_type.' Code: '.$results->meta->code.', '.$results->meta->error_message,
								'error_type'	=> $results->meta->error_type,
								'code'			=> $results->meta->code,
								'error_message'	=> $results->meta->error_message);
				}elseif(isset($results->data) && empty($results->data)){
					return array('message' => __('No Instagram content found.', 'jig_td'));
				}else{
					return array('message' => __('Generic Instagram error.', 'jig_td'));
				}			
			}
			$photos = $results->data;
			$photos_count += count($photos);

			if($limit !== '' && (int) $photos_count < (int) $limit && isset($results->pagination->next_url)){
				$additional_photos = $this->instagram_api_call($results->pagination->next_url, $instagram_caching, $limit, $photos_count);
				if(!isset($additional_photos['message'])){
					$photos = array_merge($photos, $additional_photos);
				}
			}
			return $photos;
		}

		// Returns images data for use, much more lightweight than NG's own method, doesn't use additional unnecessary DB queries (only for NGG CF, if used)
		function jig_ng_process_images($images){
			$images = (object) $images; // some get_row results are arrays
			foreach ( $images as &$image) {
				$meta_data = $this->jig_ng_unserialize((string) $image->meta_data);
				$image->meta_data = array();
				$image->imageURL			= site_url().'/'.$image->path.'/'.$image->filename;
				$image->meta_data['width']	= $meta_data['width'];
				$image->meta_data['height']	= $meta_data['height'];

			}
			unset($image);
			if($this->settings['nextgen_cf_link'] !== '' && function_exists('nggcf_get_field')){ // If NGG Custom Fields plugin is installed and a custom field is set in JIG
				$image_ids = array();
				foreach ($images as $image) {
					$image_ids[] = $image->pid;
				}
				$image_ids = implode(',',$image_ids); // Store each image id as a comma separated list (string) for use IN sql

				global $wpdb;
            	$nggcf_field_values = $wpdb->prefix.'nggcf_field_values';
            	$nggcf_fields = $wpdb->prefix.'nggcf_fields';
            	// Query the tables of NGG Custom Fields plugin, for all images at once, this eliminates the very inefficient one query per image
				$custom_links = $wpdb->get_results("	SELECT vals.pid, vals.field_value, cols.field_name
														FROM $nggcf_field_values AS vals
														LEFT JOIN $nggcf_fields AS cols ON vals.fid = cols.id
														WHERE vals.pid IN ( $image_ids )
														AND cols.ngg_type = 1", OBJECT_K);

				foreach ($images as $pid => &$image) { // Add a ng_cf_link value to the image objects where applicable
					if(isset($custom_links[$pid]) && $custom_links[$pid]->field_name === $this->settings['nextgen_cf_link']){
						$image->ng_cf_link = $custom_links[$pid]->field_value;
					}
				}
			}
			return $images;
		}

		/* Recursive album walker for NextGEN:
		   gets first found previewpic for cover picture
		   counts subalbums and subgalleries
		   protection against infinite recursion
		   the end result is an $image object that has additional data in JIG array */
		function jig_ng_find_subalbums($parent_album_id, $cover_picture, $count = false){
			global $wpdb;
			$parent_album = wp_cache_get(substr($parent_album_id, 1) , 'jig_ng_albums');
			if($cover_picture === 'needed'){
				if($parent_album->previewpic > 0){ // The album had previewpic set already
					//$cover_picture = $wpdb->get_row($wpdb->prepare("SELECT filename,meta_data,galleryid FROM $wpdb->nggpictures WHERE pid = %d",$parent_album->previewpic));
					$cover_picture = $this->jig_ng_find_images($parent_album->previewpic, true);
					if(empty($cover_picture)){ // The preview picture is obsolete
						$cover_picture = 'needed';
					}
				}
			}

			if($parent_album->sortorder){ // If the album is not empty
				$parent_album_contents = $this->jig_ng_unserialize($parent_album->sortorder);
				$galleries = $sub_albums = array();
				foreach($parent_album_contents as $parent_album_element_ID){
					if(is_numeric($parent_album_element_ID)){
						//$galleries[] = wp_cache_get($parent_album_element_ID, 'jig_ng_galleries'); 
						$galleries[] = $parent_album_element_ID;
					}else{
						$sub_albums[] = $parent_album_element_ID;
					}
				}
				if($cover_picture === 'needed'){ // If cover picture is not found yet, try to get one from the galleries
					if(!empty($galleries)){
						foreach($galleries as $gallery){
							$cover_picture = $this->ng_find_cover_image_for_gallery($gallery);
							/*$cover_picture = $wpdb->get_row($wpdb->prepare("SELECT filename,meta_data,galleryid FROM $wpdb->nggpictures WHERE pid = %d",$gallery->previewpic));	// Try to get previewpic from gallery
							if(empty($cover_picture)){ // If preview pic wasn't set try to grab first image
								$cover_picture = $wpdb->get_row($wpdb->prepare("SELECT filename,meta_data,galleryid FROM $wpdb->nggpictures WHERE exclude != 1 AND galleryid = %d ORDER by pid DESC limit 0,1",$gallery->gid));
							}*/
							if(!empty($cover_picture)){ // Gallery had (?) a previewpic set
								break;																
							}else{ // Gallery has no pics
								$cover_picture = 'needed';
							}
						}
					}
				}

				if($cover_picture === 'needed'){ // If cover picture is still not found yet
					if(!empty($sub_albums)){
						foreach($sub_albums as $sub_album){
							if($sub_album !== $parent_album_id){ // Protection against infinite recursion
								$cover_picture = $this->jig_ng_find_subalbums($sub_album, 'needed'); // Recursive call of this function
							}else{ // It would have been the same album in the same album .. (infinitely)
								$cover_picture = NULL;
							}
							if($cover_picture !== NULL){ // The recursive function call found a preview picture
								break;
							}else{ // The recursive function call could not find a picture, this album won't be shown
								$cover_picture = 'needed';
							}
						}						
					}
				}

				if($cover_picture !== 'needed' && !empty($cover_picture)){ // If there is a cover picture (should be)
					if($count === true){ // And this is not a recursively called function but the main one, include extra data for the album
						$cover_picture->jig['galleryCount'] = count($galleries);
						$cover_picture->jig['albumCount'] = count($sub_albums);
						$cover_picture->jig['slug'] = $parent_album->slug;
						$cover_picture->jig['id'] = $parent_album->id;
						$cover_picture->jig['pageid'] = $parent_album->pageid;
						$cover_picture->jig['name'] = nggGallery::i18n($parent_album->name, 'album_' . $parent_album->id . '_name');
						$cover_picture->jig['albumdesc'] = nggGallery::i18n($parent_album->albumdesc, 'album_' . $parent_album->id . '_albumdesc');	
					}
					return $cover_picture;
				}else{ // This album won't be shown!
					return NULL;
				}
			}else{
				//$notice_after .= sprintf(__('There is no content in the NextGEN album: "%1$s"!', 'jig_td'),stripcslashes($parent_album->name));
				return NULL;
			}
		}

		// Gets NG specific information from the URL, works with NG1 and NG2, in place of get_query_var
		function jig_ng_get_query_var($var_name){
			if($this->ng_version == 2){
				$ngoptions = get_option('ngg_options');
				$ng_permalink_slug = $ngoptions['permalinkSlug'];
				$request_uri = $_SERVER['REQUEST_URI'];
				if($var_name === 'gallery'){
					if (preg_match('%/'.$ng_permalink_slug.'/(?!tags)([-\w]+)/(?:([-\w]+))/?%m', $request_uri, $matches)) {
						$value = $matches[2];
					}else{
						$value = '';
					}
				}elseif($var_name === 'album'){
					if (preg_match('%/'.$ng_permalink_slug.'/(?!tags)([-\w]+)(?:/([-\w]+))?%m', $request_uri, $matches)) {
						$value = $matches[1];
					}else{
						$value = '';
					}
				}elseif($var_name === 'gallerytag'){
					if (preg_match('%/'.$ng_permalink_slug.'/tags/([-\w]+)%m', $request_uri, $matches)) {
						$value = $matches[1];
					}else{
						$value = '';
					}
				}
			}else{
				$value = get_query_var($var_name);
			}
			if(empty($value)){
				$value = '';
			}
			return esc_attr($value);
		}

		// Provides simple way of generating the links for NG albums or galleries, works with NG2 (custom) or NG1 (legacy passthrough)
		function jig_ng_get_permalink($path_elements){
			if($this->ng_version == 2){
				global $wp_rewrite;
				$ngoptions = get_option('ngg_options');
				$ng_permalink_slug = $ngoptions['permalinkSlug'];
				$index_pos = strpos($_SERVER["SCRIPT_NAME"],'/index.php');
				if($index_pos === 0){
					$path_to_index = '';
				}else{
					$path_to_index = '/'.substr($_SERVER["SCRIPT_NAME"],1,$index_pos-1);
				}
				if($wp_rewrite->using_permalinks() === true){ // If permalinks are ON
					$qmark_pos = strpos($_SERVER["REQUEST_URI"],'?');
					if($qmark_pos !== false){
						// query string needs to be dropped else not found error comes up (this only applies because NG is not set up to handle that) - even original NG goes crazy if permalinks are on and a query string is added to the URL (just something like utm_source) - this is not the same query string that WP uses internally to get the post by id
						$query_string_from_request_uri = urldecode(substr($_SERVER["REQUEST_URI"],$qmark_pos));

						$pure_request_uri = substr($_SERVER["REQUEST_URI"],0,$qmark_pos);
					}else{
						$pure_request_uri = $_SERVER["REQUEST_URI"];
						$query_string_from_request_uri = '';
					}
					$slug_pos = strpos($pure_request_uri,$ng_permalink_slug); // The URL may already have the NG slug in it (subalbums)
					if($slug_pos !== false){
						$pure_request_uri = $path_to_index.substr($pure_request_uri,0,$slug_pos);
					}
					$path_to_add = $ng_permalink_slug.'/';

					if(!empty($path_elements['gallerytag'])){
						$path_to_add .= 'tags/'.$path_elements['gallerytag'];
					}elseif(!empty($path_elements['gallery']) && !empty($path_elements['album'])){
						$path_to_add .= $path_elements['album'].'/'.$path_elements['gallery'];
					}elseif(!empty($path_elements['album'])){
						$path_to_add .= $path_elements['album'];
					}
					// Have to trailing slash before the query string to avoid not found error [that happens with NG 2]!
					$link = trailingslashit('http'.(is_ssl() ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$pure_request_uri.$path_to_add).$query_string_from_request_uri;
				}else{ // If permalinks are OFF
					// NG adds the path again, not sure why		
					$path_to_add = $path_to_index.'/'.$ng_permalink_slug.'/';

					if(!empty($path_elements['gallerytag'])){
						$path_to_add .= 'tags/'.$path_elements['gallerytag'];
					}elseif(!empty($path_elements['gallery']) && !empty($path_elements['album'])){
						$path_to_add .= $path_elements['album'].'/'.$path_elements['gallery'];
					}elseif(!empty($path_elements['album'])){
						$path_to_add .= $path_elements['album'];
					}
					$query_string = $_SERVER['QUERY_STRING'] ? '?'. $_SERVER['QUERY_STRING'] : '';

					$link = trailingslashit('http'.(is_ssl() ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER["SCRIPT_NAME"].$path_to_add).$query_string;
				}

			}else{
				$nggRewrite = new nggRewrite();
				$link = $nggRewrite->get_permalink($path_elements);
			}
			return $link;
		}

		// Used for getting multiple galleries or single gallery instead of using the NG class
		function jig_ng_get_galleries($gallery_ids, $order_by = 'sortorder', $order_dir = 'ASC', $exclude = true, $limit = 0) {
			global $wpdb;
			// init the gallery as empty array
			$gallery = array();

			// Check for the exclude setting
			$exclude_clause = ($exclude) ? ' AND tt.exclude<>1 ' : '';

			// Say no to any other value
			$order_dir		= ( $order_dir == 'DESC') ? 'DESC' : 'ASC';
			$order_by		= ( empty($order_by) ) ? 'sortorder' : $order_by;
			$order_clause	= "ORDER BY ABS(p.{$order_by}) {$order_dir}, p.{$order_by} {$order_dir}";

			// Should we limit this query ?
			$limit_by  = ( $limit > 0 ) ? 'LIMIT 0,' . intval($limit) : '';
			if(is_numeric($gallery_ids) || strpos($gallery_ids,',') !== false){ // Gallery IDs
				$images = $wpdb->get_results("	SELECT p.* , g.*
												FROM $wpdb->nggallery AS g
												INNER JOIN $wpdb->nggpictures AS p
												ON g.gid = p.galleryid
												WHERE g.gid	IN ( $gallery_ids )
												AND p.exclude<>1
												$order_clause
												$limit_by", OBJECT_K);
			}else{ // 1 Gallery slug (from the query var) multiple slugs are not supported
				$images = $wpdb->get_results($wpdb->prepare("	SELECT p.* , g.*
																FROM $wpdb->nggallery AS g
																INNER JOIN $wpdb->nggpictures AS p
																ON g.gid = p.galleryid
																WHERE g.slug = %s
																AND p.exclude<>1
																$order_clause
																$limit_by",$gallery_ids), OBJECT_K);
			}

			if(!empty($images)){
				$images = $this->jig_ng_process_images($images); // Very important, sets up the image objects, mimics NG
			}
			return $images;		
		}

		// Gets an album and sorts its contents according to the default sorting settings for NG2
		function jig_ng_get_album($ng_album, $order_by = 'sortorder', $order_dir = 'ASC'){
			global $wpdb;

			$comma_pos = strpos($ng_album, ',');
			// If the album value is a numeric ID
			if(is_numeric($ng_album) && $ng_album != 0){
				$album = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->nggalbum WHERE id = %d", $ng_album));
			}elseif($ng_album == 'all' || (is_numeric($ng_album) && $ng_album == 0) || $comma_pos !== false){
				// If the album value is all or 0 (Overview albums is needed)
				$album = new stdClass();
				$album->id = 'all';
				$album->name = __('Album overview','nggallery');
				$album->albumdesc  = __('Album overview','nggallery');
				$album->previewpic = 0;
				if($comma_pos === false){
					$album->sortorder = serialize($wpdb->get_col("SELECT gid FROM $wpdb->nggallery"));
				}else{ // Multiple album ids
					$albums = $wpdb->get_col("SELECT sortorder FROM $wpdb->nggalbum WHERE id IN ( $ng_album )");
					$album->sortorder = array();
					foreach ($albums as $single_album) {
						$album->sortorder = array_merge($album->sortorder, $this->jig_ng_unserialize($single_album));
					}
					$album->sortorder = serialize(array_unique($album->sortorder));
				}
			}else{
				$album = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->nggalbum WHERE slug = %s", $ng_album));
			}

			if($album){
				if(!empty($album->sortorder)){
					// Get a bunch of gallery and album ids, albums start with an 'a'
					// need to sort them by the global sorting order
					$album->content_ids = $this->jig_ng_unserialize($album->sortorder);
					// This extends album sorting by allowing ID and Alttext (Title) based sorting (set as the global default sorting in NG)
					if($order_by == 'pid'){ // and date
						$order_by = 'id';
						$query_needed = true;
					}elseif($order_by == 'alttext'){
						$order_by = 'name';
						$query_needed = true;
					}elseif(($order_by !== 'sortorder' && $order_dir == 'ASC')
							|| ($order_by == 'sortorder' && $order_dir == 'DESC')){
						// NG has a weird logic of sorting the custom ordered album entries, but this is it
						$album->content_ids = array_reverse($album->content_ids); // have to reverse the custom order
						$query_needed = false;
					}
					if($query_needed === true){
						$order_dir		= ($order_dir == 'DESC') ? 'DESC' : 'ASC';
						$order_clause	= "ORDER BY ABS({$order_by}) {$order_dir}, {$order_by} {$order_dir}";
						$album_ids = $gallery_ids = $modified_sortortder = array();
						foreach ($album->content_ids as $id) {
							if(strpos($id,'a') !== false){
								$album_ids[] = substr($id, 1);
							}else{
								$gallery_ids[] = $id;
							}
						}
						$album_ids = implode(',', $album_ids);
						$gallery_ids = implode(',', $gallery_ids);
						if(!empty($album_ids) && !empty($gallery_ids)){
							$sorted_ids = $wpdb->get_results("	SELECT id, name, 1 as album
																FROM $wpdb->nggalbum
																WHERE id IN ( $album_ids )
																UNION
																SELECT gid, title, 0 as album
																FROM $wpdb->nggallery
																WHERE gid =  ( $gallery_ids )
																$order_clause");
						}elseif(!empty($album_ids)){
							$sorted_ids = $wpdb->get_results("	SELECT id, name, 1 as album
																FROM $wpdb->nggalbum
																WHERE id IN ( $album_ids )
																$order_clause");
						}elseif(!empty($gallery_ids)){
							$sorted_ids = $wpdb->get_results("	SELECT gid as id, title as name, 0 as album
																FROM $wpdb->nggallery
																WHERE gid IN ( $gallery_ids )
																$order_clause");
						}
						if(!empty($sorted_ids)){
							foreach ($sorted_ids as $sorted_id) {
								if($sorted_id->album == '1'){
									$modified_sortortder[] = 'a'.$sorted_id->id;
								}else{
									$modified_sortortder[] = $sorted_id->id;
								}							
							}
						}
						$album->content_ids = $modified_sortortder;
					}
				}
				$album->albumdesc  = stripslashes($album->albumdesc);
				$album->name       = stripslashes($album->name);
				return $album;
			}
			return false;
		}

		// Find image(s) - single or multiple - based in ids
		function jig_ng_find_images($ng_pics, $single = false) {
			global $wpdb;
			$images = $wpdb->get_results("	SELECT p.* , g.*
											FROM $wpdb->nggallery AS g
											INNER JOIN $wpdb->nggpictures AS p
											ON g.gid = p.galleryid
											WHERE p.pid	IN ( $ng_pics )
											ORDER BY FIELD(p.pid, $ng_pics)", OBJECT_K);
			if(!empty($images)){
				$images = $this->jig_ng_process_images($images); // Very important, sets up the image objects, mimics NG
				if($single === true){
					foreach ($images as $image) {
						$single_image = $image;
						break;
					}
					$images = $single_image;
				}
			}
			
			return $images;
		}

		// Gets recent NextGEN images 
		function jig_ng_get_recent_images($ng_recent_images, $limit = 0){
			global $wpdb;

			if($ng_recent_images === 'yes'){
				$order_clause = "ORDER BY p.pid DESC";
			}else if($ng_recent_images === 'yes_exif'){
				$order_clause = "ORDER BY imagedate DESC";
			}
			$limit_by  = ( $limit > 0 ) ? 'LIMIT 0,' . intval($limit) : '';

			$images = $wpdb->get_results("	SELECT g.*, p.*
											FROM $wpdb->nggallery AS g
											INNER JOIN $wpdb->nggpictures AS p
											ON g.gid = p.galleryid
											WHERE p.exclude <>1
											$order_clause
											$limit_by");
			if(!empty($images)){
				$images = $this->jig_ng_process_images($images); // Very important, sets up the image objects, mimics NG
			}
			return $images;	
		}

		// Gets random NextGEN images (can be from a specified gallery)
		function jig_ng_get_random_images($limit, $gallery_ids){
			global $wpdb;

			if ($gallery_ids === 'yes'){
				$where_clause = "WHERE p.exclude <>1";
			}else{
				$where_clause = "WHERE g.gid IN ( $gallery_ids ) AND p.exclude <>1";
			}
			$limit_by  = ( $limit > 0 ) ? 'LIMIT 0,' . intval($limit) : '';

			$images = $wpdb->get_results("	SELECT g.*, p.*
											FROM $wpdb->nggallery AS g
											INNER JOIN $wpdb->nggpictures AS p
											ON g.gid = p.galleryid
											$where_clause
											ORDER by rand()
											$limit_by");
			if(!empty($images)){
				$images = $this->jig_ng_process_images($images); // Very important, sets up the image objects, mimics NG
			}
			return $images;	

		}

		// Find images that belong to certaing tag(s) in NextGEN gallery
		function jig_ng_find_images_for_tags($tags, $order_by, $order_dir, $limit = 0, $album = false) {
			global $wpdb;
			// Remove unnecessary spaces around commas, and wrap them in single quotes
			$tags = "'".implode("','",explode(',',str_replace (', ', ',', esc_sql($tags))))."'";
			// Get tag (term) IDs from the DB using matching for either name or slug
			//$term_ids = $wpdb->get_col($wpdb->prepare("SELECT term_id FROM $wpdb->terms WHERE taxonomy = ngg_tag AND slug IN ({$tags}) OR name IN ({$tags}) ORDER BY FIELD(slug, $tags), FIELD(name, $tags)", NULL));
			$term_ids = $wpdb->get_col($wpdb->prepare("	SELECT t.term_id FROM $wpdb->terms as t
														INNER JOIN $wpdb->term_taxonomy as tt ON tt.term_id = t.term_id
														WHERE tt.taxonomy='ngg_tag'
														AND ( t.slug IN ({$tags})
															OR t.name IN ({$tags}) )
														ORDER BY FIELD(t.slug, {$tags}), FIELD(t.name, {$tags})", NULL));
			if(empty($term_ids)){ // Will display an error message later, but when the specified tag(s) are not found, can't continue
				return false;
			}

			if($album === false){ // Tag gallery mode
				if($this->ng_intersect_tags == "no"){
		            $id_list = get_objects_in_term($term_ids, 'ngg_tag');
					if(empty($id_list)){ // Will display an error message later, but when the specified tag(s) are not found, can't continue
						return false;
					}
				}else{
					$term_ids_imploded = implode(',',$term_ids);
					$id_list_to_process = $wpdb->get_results("	SELECT tr.object_id,tt.term_id
													FROM $wpdb->term_relationships AS tr
													INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
													WHERE tt.taxonomy IN ('ngg_tag')
													AND tt.term_id IN ( $term_ids_imploded )
													ORDER BY tr.object_id ASC");
					if(empty($id_list_to_process)){ // Will display an error message later, but when the specified tag(s) are not found, can't continue
						return false;
					}
					$count_for_id = $id_list = array();
					foreach ($id_list_to_process as $row) {
						if(empty($count_for_id[$row->object_id])){
							$count_for_id[$row->object_id] = 1;
						}else{
							$count_for_id[$row->object_id]++;
						}
					}
					asort($count_for_id);
					$term_count = count($term_ids);
					foreach ($count_for_id as $object_id => $count) {
						if($count == $term_count){
							$id_list[] = $object_id;
						}
					}
				}
				$id_list = implode(',',$id_list);
				// Order clause that used by final query to get the images
				$order_dir		= $order_dir == 'DESC' ? 'DESC' : 'ASC';
				$order_by		= empty($order_by) ? 'pid' : $order_by;
		    	$order_clause	= $order_by !== 'RAND' ? "ORDER BY ABS('p.{$order_by}') {$order_dir}, p.{$order_by} {$order_dir}" : 'ORDER BY rand()';
		    	$limit_by  = ( $limit > 0 ) ? 'LIMIT 0,' . intval($limit) : '';
		    	if(empty($id_list)){
		    		return false;
		    	}
				$images = $wpdb->get_results("	SELECT p.* , g.*
												FROM $wpdb->nggallery AS g
												INNER JOIN $wpdb->nggpictures AS p ON g.gid = p.galleryid
												WHERE p.pid	IN ( $id_list )
												AND p.exclude <>1
												$order_clause
												$limit_by", OBJECT_K);
				
			}else{ // Create albums for tags (seemingly missing feature in NG2)
				// Tag album mode
				// This query finds a random NGG image ID for each tag 
				// OBJECT_K discards duplicate term_id values and since the order is rand(), it does everything in one query!
				// this is built upon nggTags::get_album_images and get_objects_in_term but modified and combined to suit the current needs
				// the result is the image ids object for each tag album
				// many joins are also needed for mainly the count value and the name of the tag (album)
				// may be a complex query but it's still better that it's just one query
				// compared to NG's one query for each tag (with similar complexity)
				$term_ids_string = implode(',',$term_ids);

				$images_raw = $wpdb->get_results("	SELECT tt.term_id, p.* , g.*, t.*, tt.*
												FROM $wpdb->term_relationships AS tr
												INNER JOIN $wpdb->nggpictures AS p ON (tr.object_id = p.pid)
												INNER JOIN $wpdb->nggallery AS g ON (g.gid = p.galleryid)
												INNER JOIN $wpdb->term_taxonomy AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
												INNER JOIN $wpdb->terms AS t ON (tt.term_id = t.term_id)
												WHERE tt.taxonomy = 'ngg_tag'
												AND tt.term_id IN ( $term_ids_string )
												AND p.exclude <>1
												ORDER BY rand()",OBJECT_K);
				// Put them back in the manually specified order 
				$images = array();
				foreach ($term_ids as $id) {
					$images[$id] = $images_raw[$id];
				}
			}
			return $images;
		}

		function ng_find_cover_image_for_gallery($gallery_id){
			global $wpdb;
			// There is a manually set preview pic
			$images = $wpdb->get_results("	SELECT p.* , g.*
											FROM $wpdb->nggallery AS g
											INNER JOIN $wpdb->nggpictures AS p
											ON g.previewpic = p.pid
											WHERE g.gid = $gallery_id");
			if(empty($images)){ // If no preview pic is present, choose the latest pic in that gallery
				$images = $wpdb->get_results("	SELECT p.* , g.*
												FROM $wpdb->nggallery AS g
												INNER JOIN $wpdb->nggpictures AS p
												ON g.gid = p.galleryid
												WHERE p.galleryid = $gallery_id
												AND p.exclude <>1
												ORDER by p.pid DESC limit 0,1");
			}
			if(!empty($images)){
				$images = $this->jig_ng_process_images($images); // Very important, sets up the image objects, mimics NG
				foreach ($images as $image) {
					$cover_image = $image;
					break;
				}
			}

			return $cover_image;
		}
											


		// Used for NG database data unserialization because, in theory, they SOMETIMES store data base64-encoded and json-encoded
		function jig_ng_unserialize($serialized_value)
		{
			$unserialized = @unserialize($serialized_value);
			if($unserialized === false){
				if (is_string($serialized_value))
				{
					$unserialized = stripcslashes($serialized_value);

					if (strlen($serialized_value) > 1)
					{
						$unserialized = json_decode(base64_decode($unserialized), TRUE);
					}
				}
			}
			return $unserialized;
		}

		// If the plugin was freshly activated, check writability of the thumbnails cache folder and flush rewrite rules
		function jig_init_check_permissions(){
			if($this->settings['jig_activated'] == "hot"){
				$this->jig_install_check_permissions();
				$this->settings['jig_activated'] = "cold";
				update_option(self::SETTINGS_NAME,$this->settings);
				flush_rewrite_rules();
			}
		}

		// calculate time left until FB Auth expiry for admin notice 
		function jig_time_left($endtime) { 
			$time_left = $endtime - time(); 
			if($time_left > 0) { 
				$days = floor($time_left / 86400); 
				$time_left = $time_left - $days * 86400; 
				$hours = floor($time_left / 3600); 
				$time_left = $time_left - $hours * 3600; 
				$minutes = floor($time_left / 60); 
			} else { 
				return 'expired'; 
			} 
			if($days > 0){
				return $days.' '._n('day', 'days', $days, 'jig_td').' '.$hours.' '._n('hour', 'hours', $hours, 'jig_td');
			}else{
				return $hours.' '._n('hour', 'hours', $hours, 'jig_td') .' '.$minutes.' '._n('minute', 'minutes', $minutes, 'jig_td') ;
			}
		}

		function jig_nice_time($date){
			if(empty($date)){
				return "No date provided";
			}
			$periods = array(	__('second','jig_td'),
								__('minute','jig_td'),
								__('hour','jig_td'),
								__('day','jig_td'),
								__('week','jig_td'),
								__('month','jig_td'),
								__('year','jig_td'),
								__('decade','jig_td'));
			$periods_plural = array(	__('seconds','jig_td'),
										__('minutes','jig_td'),
										__('hours','jig_td'),
										__('days','jig_td'),
										__('weeks','jig_td'),
										__('months','jig_td'),
										__('years','jig_td'),
										__('decades','jig_td'));
			$lengths = array("60","60","24","7","4.35","12","10");
			 
			$now = time();
			$unix_date = strtotime($date);
			 
			// check validity of date
			if(empty($unix_date)){
				return "Bad date";
			}
			 
			// is it future date or past date
			if($now > $unix_date){
				$difference = $now - $unix_date;
				$tense = __('ago','jig_td');
			}else{
				$difference = $unix_date - $now;
				$tense = __('from now','jig_td');
			}
			 
			for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++){
				$difference /= $lengths[$j];
			}
			 
			$difference = round($difference);
			 
			$period = $periods[$j];
			if($difference != 1) {
				$period = $periods_plural[$j];
			}
			 
			return $difference.' '.$period.' '.$tense;
		}

		// help IE with rgba for caption backgrounds
		function jig_rgbaIE($color, $jig_id, $caption_match_width, $gradient_caption_bg){
			if($gradient_caption_bg == 'yes'){
				// The gradient is already added in a crossbrowser way but haslayout needs to be triggered
				return "#jig{$jig_id} .jig-caption { 
							background:transparent;
							zoom: 1;
						}";
			}elseif(preg_match("/(.*?)rgba\((\d+)[, ]{1,2}(\d+)[, ]{1,2}(\d+)[, ]{1,2}([.\d]{1,4})\)/i", $color, $e)){
				$e[5] = $e[5]*255;
				for($i = 2; $i<6; $i++){
					$e[$i] = dechex(($e[$i] <= 0)?0:(($e[$i] >= 255)?255:$e[$i]));
					$e[$i] = ((strlen($e[$i]) < 2)?'0':'').$e[$i];
				}
				$hex = $e[5].$e[2].$e[3].$e[4];
				if($caption_match_width == 'no'){
					return "#jig{$jig_id} .jig-caption { 
								background:transparent;
								filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#{$hex},endColorstr=#{$hex});
								zoom: 1;
							}";
				}else{
					return "#jig{$jig_id} .jig-caption-title { 
						background:transparent;
						filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#{$hex},endColorstr=#{$hex});
						zoom: 1;
						*display:inline;
					}
					#jig{$jig_id} .jig-caption-description { 
						background:transparent;
						filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#{$hex},endColorstr=#{$hex});
						zoom: 1;
					}";
				}
			}
			return;
		}

		// attempts to fix chmod issues
		function jig_attempt_chmod(){
			check_ajax_referer('jig_attempt_chmod', 'security');
			$permission = $_REQUEST['permission'];
			$output = array();
			$output['message'] = '';
			if(chmod(dirname(__FILE__), ($permission == "0755" ? 0755 : 0777))){
				$output['message'] .= sprintf(__('Plugin folder %s chmod is <strong>successful</strong> to %s.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__).'</span>)',$permission);
			}else{
				$output['message'] .= sprintf(__('Plugin folder %s chmod <strong>failed</strong>.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__).'</span>)');
			}
			if(chmod(dirname(__FILE__)."/timthumb.php", ($permission == "0755" ? 0755 : 0777))){
				$output['message'] .= sprintf(__('File %s chmod is <strong>successful</strong> to %s.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__)."/timthumb.php".'</span>)',$permission);
			}else{
				$output['message'] .= sprintf(__('File %s chmod <strong>failed</strong>.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__)."/timthumb.php".'</span>)');
			}
			if(chmod(dirname(__FILE__)."/cache", ($permission == "0755" ? 0755 : 0777))){
				$output['message'] .= sprintf(__('Cache folder %s chmod is <strong>successful</strong> to %s.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__)."/cache".'</span>)',$permission);
			}else{
				$output['message'] .= sprintf(__('Cache folder %s chmod <strong>failed</strong>.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__)."/cache".'</span>)');
			}
			if(chmod(dirname(__FILE__)."/cache/index.html", ($permission == "0755" ? 0755 : 0777))){
				$output['message'] .= sprintf(__('File %s chmod is <strong>successful</strong> to %s.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__)."/cache/index.html".'</span>)',$permission);
			}else{
				$output['message'] .= sprintf(__('File %s chmod <strong>failed</strong>.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__)."/cache/index.html".'</span>)');
			}
			if(chmod(dirname(__FILE__)."/cache/timthumb_cacheLastCleanTime.touch", ($permission == "0755" ? 0755 : 0777))){
				$output['message'] .= sprintf(__('File %s chmod is <strong>successful</strong> to %s.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__)."/cache/timthumb_cacheLastCleanTime.touch".'</span>)',$permission);
			}else{
				$output['message'] .= sprintf(__('File %s chmod <strong>failed</strong>.<br/>','jig_td'),'(<span style="color:#888">'.dirname(__FILE__)."/cache/timthumb_cacheLastCleanTime.touch".'</span>)');
			}			
			echo json_encode($output);
			die();
		}

		// checks if cache folder is writable for real
		function jig_cache_writable(){
			$file = dirname(__FILE__)."/cache/".time().'.txt';
			$stream = @fopen($file, 'w');
			if($stream){
				fclose($stream);
				unlink($file);
				return true;
			}else{
				return false;
			}	
		}

		// checks permissions on the cache folder and the plugin folder
		function jig_install_check_permissions(){
			$fixed = false;
			if(!$this->jig_cache_writable()){
				$plugin_chmod = chmod(dirname(__FILE__), 0755);
				$timthumb_chmod = chmod(dirname(__FILE__)."/timthumb.php", 0755);
				$cache_chmod = chmod(dirname(__FILE__)."/cache", 0755);
				$index_chmod = chmod(dirname(__FILE__)."/cache/index.html", 0755);
				$touch_chmod = chmod(dirname(__FILE__)."/cache/timthumb_cacheLastCleanTime.touch", 0755);
				if($plugin_chmod && $cache_chmod && $index_chmod && $touch_chmod && $timthumb_chmod){
					$fixed = true;
				};
			}
			if(!$this->jig_cache_writable()){
				if($fixed){
					function timthumb_big_problem(){
						echo "<div class='error fade'><p>".__('The thumbnails cache folder is not writable! <a href="options-general.php?page=justified-image-grid">Click here to go to the settings where you can fix this.</a> Unless you do so your images might not appear and the plugin could only generate whitespace!', 'jig_td')." ".__('The plugin was trying to fix it but the 0755 permission was not enough.', 'jig_td')."</p></div>";
					}
					add_action('admin_notices', 'timthumb_big_problem');
				}else{
					function timthumb_problem(){
						echo "<div class='error fade'><p> ".__('The thumbnails cache folder is not writable! <a href="options-general.php?page=justified-image-grid">Click here to go to the settings where you can fix this.</a> Unless you do so your images might not appear and the plugin could only generate whitespace!', 'jig_td')."</p></div>";
					}
					add_action('admin_notices', 'timthumb_problem');
				}
			}else{
				if($fixed){
					function timthumb_fixed(){
						echo "<div class='updated fade'><p> ".__('The thumbnails cache folder was not writable! This was automatically fixed for you.', 'jig_td')."</p></div>";
					}
					add_action('admin_notices', 'timthumb_fixed');
				}else{
					function timthumb_perfect(){
						echo "<div class='updated fade'><p> ".__('The thumbnails cache folder was tested and it is writable!', 'jig_td')."</p></div>";
					}
					add_action('admin_notices', 'timthumb_perfect');
				}
			}
			if(!in_array('curl', get_loaded_extensions())){
				function jig_no_curl(){
						echo "<div class='updated fade'><p> ".__("The CURL library is missing on your server, this will affect the following features: Jetpack Photon, Download link!", 'jig_td')."</p></div>";
					}
				add_action('admin_notices', 'jig_no_curl');
			}
		}

		// checks folder permissions on demand, returns nice output
		function jig_on_demand_check_permissions(){
			check_ajax_referer('jig_on_demand_check_permissions', 'security');
			$output = array();
			if($this->jig_cache_writable()){
				$output['writable'] = '<span style="font-weight:bold; color:green;">writable</span>';
			}else{
				$output['writable'] = '<span style="font-weight:bold; color:red;">not writable</span>';
			}
			$output['permission_plugin'] = substr(sprintf('%o', fileperms(dirname(__FILE__))), -4);
			$output['permission_cache'] = substr(sprintf('%o', fileperms(dirname(__FILE__)."/cache")), -4);
			echo json_encode($output);
			die();
		}

		// removes flickr caching transients from wp-options
		function jig_purge_flickr_caching(){
			check_ajax_referer('jig_purge_flickr_caching', 'security');
			$output = array();
			global $wpdb;
			if($wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '!_transient_%jigfli!_%' ESCAPE '!'") !== false){
				$output['result'] = __('Cache purged.','jig_td');
			}else{
				$output['result'] = __('Error purging the cache.','jig_td');
			}
			echo json_encode($output);
			die();
		}

		// removes facebook caching transients from wp-options
		function jig_purge_facebook_caching(){
			check_ajax_referer('jig_purge_facebook_caching', 'security');
			$output = array();
			global $wpdb;
			if($wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '!_transient_%jigfb!_%' ESCAPE '!'") !== false){
				$output['result'] = __('Cache purged.','jig_td');
			}else{
				$output['result'] = __('Error purging the cache.','jig_td');
			}
			echo json_encode($output);
			die();
		}

		// removes instagram caching transients from wp-options
		function jig_purge_instagram_caching(){
			check_ajax_referer('jig_purge_instagram_caching', 'security');
			$output = array();
			global $wpdb;
			if($wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '!_transient_%jigig!_%' ESCAPE '!'") !== false){
				$output['result'] = __('Cache purged.','jig_td');
			}else{
				$output['result'] = __('Error purging the cache.','jig_td');
			}
			echo json_encode($output);
			die();
		}

		// removes external image caching table contents
		function jig_purge_external_caching(){
			check_ajax_referer('jig_purge_external_caching', 'security');
			$output = array();
			global $wpdb;
			$tablename = $wpdb->prefix.'jig_ext_images';
			if($wpdb->query("DELETE FROM $tablename") !== false){ // Don't drop it
				$output['result'] = __('Cache purged.','jig_td');
			}else{
				$output['result'] = __('Error purging the cache.','jig_td');
			}
			echo json_encode($output);
			die();
		}

		// flushes rewrite rules when needed
		function jig_flush_rewrite_rules(){
			check_ajax_referer('jig_flush_rewrite_rules', 'security');
			$output = array();
			flush_rewrite_rules();
			$output['result'] = __('Rewrite rules flushed.','jig_td');
			echo json_encode($output);
			die();
		}

		// Removes the options from the database, full reset, the plugin will rebuild it for itself
		function jig_wipe_settings(){
			check_ajax_referer('jig_wipe_settings', 'security');
			$output = array();
			if(delete_option(self::SETTINGS_NAME) === true){
				$output['result'] = __('Settings have been completely wiped! The page will reload in 3 seconds.','jig_td');
			}else{
				$output['error'] = __('There was a problem removing the settings, perhaps they were already wiped?','jig_td');
			}
			echo json_encode($output);
			die();
		}
		// Exports all settings encrypted or unencrypted, for the user to store as a backup
		function jig_backup_settings(){
			check_ajax_referer('jig_backup_settings', 'security');
			$output = array();
			$key = trim($_REQUEST['key']);
			$decryrpted_settings = serialize(get_option(self::SETTINGS_NAME));
			if(!empty($key) && function_exists('mcrypt_encrypt')){
				$encrypted_settings = 'y'.base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $decryrpted_settings, MCRYPT_MODE_CBC, md5(md5($key))));
			}else{
				$encrypted_settings = 'n'.base64_encode($decryrpted_settings);
			}
			$output['result'] = $encrypted_settings;
			echo json_encode($output);
			die();
		}

		// Imports settings, using an encrypted or unencrypted string supplied by the user (from a backup)
		function jig_import_settings(){
			check_ajax_referer('jig_import_settings', 'security');
			$output = array();
			$key = trim($_REQUEST['key']);
			$encryrpted_settings = trim($_REQUEST['encryrpted_settings']);
			$it_is_encrypted = substr($encryrpted_settings,0,1) === 'y' ? true : false;
			$encryrpted_settings = substr($encryrpted_settings, 1);
			if(!empty($key) && $it_is_encrypted === true && function_exists('mcrypt_decrypt')){
				$decryrpted_settings = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encryrpted_settings), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
			}else{
				$decryrpted_settings = base64_decode($encryrpted_settings);
			}
			$decryrpted_settings = unserialize($decryrpted_settings);
			if($decryrpted_settings !== false){
				update_option(self::SETTINGS_NAME,$decryrpted_settings);
				$output['result'] = __('Settings were successfully imported! The page will reload in 3 seconds.','jig_td');
			}else{
				$output['error'] = __('There was a problem importing settings','jig_td').': ';
				if($it_is_encrypted === true){
					if(empty($key)){
						$output['error'] .= __('it is encrypted but no key was supplied.','jig_td');
					}else{
						if(function_exists('mcrypt_decrypt')){
							$output['error'] .= __('it is encrypted, a key was supplied but it is invalid - if it is valid then the data is corrupted.','jig_td');
						}else{
							$output['error'] .= __('it is encrypted, a key was supplied but the mcrypt PHP library is missing.','jig_td');
						}
					}
				}else{
					$output['error'] .= __('it is not encrypted but the data is invalid.','jig_td');
				}
			}
			echo json_encode($output);
			die();
		}

		// Custom excerpt getter
		function jig_the_excerpt($post, $excerpt_length, $excerpt_ending) {
			$text = strip_shortcodes($post->post_content);
			$text = apply_filters('the_content', $text);
			$text = str_replace('\]\]\>', ']]&gt;', $text);
			$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
			$text = strip_tags($text);
			$words = explode(' ', $text, $excerpt_length + 1);
			if (count($words) > $excerpt_length) {
					array_pop($words);
					$text = implode(' ', $words);
					if($excerpt_ending !== 'none'){
						$text .= strtr($excerpt_ending, array("(" => "[", ")" => "]"));
					}
			}
			return $text;
		}

		// Detects SocialGallery
		function social_gallery_plugin_exists(){
			$exists = false; $version = 0;
			if (get_option('socialGallery_reg')){
			        $exists = true; $version = '<2.0';      
			}
			if (is_array(get_option('sgpsettings'))) {
			        $exists = true; $version = '2.0+';
			} 
			if (class_exists('SocialGallerySettings')){
			        $exists = true; $version = '2.1+';
			}
			return array($exists,$version);
		}


		// adds custom link functionality to gallery images
		function jig_image_attachment_fields_to_edit($form_fields, $post){
			$form_fields["jig_image_link"] = array(
				"label" => __('JIG Link', 'jig_td'),
				"input" => "text",
				"value" => get_post_meta($post->ID, "_jig_image_link", true),
				"helps" => __('Use this when creating a gallery with Justified Image Grid and you wish to point the image link to a custom URL', 'jig_td'),
			);
			$form_fields["jig_image_link_target"] = array(
				"label" => __('JIG target', 'jig_td'),
				"input" => "html",
				"html" => "<div style='padding-top:5px; font-weight:bold;'><input style='width:auto;' type='radio' ".checked(get_post_meta($post->ID, "_jig_image_link_target", true), '',false).checked(get_post_meta($post->ID, "_jig_image_link_target", true), 'default',false)." value='default' id='attachments[{$post->ID}][jig_image_link_target]' name='attachments[{$post->ID}][jig_image_link_target]'><label style='margin: 0 5px;' for='attachments[{$post->ID}][jig_image_link_target]'>default</label>
				<input style='width:auto;' type='radio' ".checked(get_post_meta($post->ID, "_jig_image_link_target", true), '_blank',false)." value='_blank' id='attachments[{$post->ID}][jig_image_link_target]-blank' name='attachments[{$post->ID}][jig_image_link_target]'><label style='margin: 0 5px;' for='attachments[{$post->ID}][jig_image_link_target]-blank'>_blank</label><br />
				<input style='width:auto;' type='radio' ".checked(get_post_meta($post->ID, "_jig_image_link_target", true), '_self',false)." value='_self' id='attachments[{$post->ID}][jig_image_link_target]-self' name='attachments[{$post->ID}][jig_image_link_target]'><label style='margin: 0 5px;' for='attachments[{$post->ID}][jig_image_link_target]-self'>_self</label>
				<input style='width:auto;' type='radio' ".checked(get_post_meta($post->ID, "_jig_image_link_target", true), 'video',false)." value='video' id='attachments[{$post->ID}][jig_image_link_target]-video' name='attachments[{$post->ID}][jig_image_link_target]'><label style='margin: 0 5px;' for='attachments[{$post->ID}][jig_image_link_target]-video'>Lightbox: video / iframe / another image</label></div>"
			);
			return $form_fields;
		}

		// saves it
		function jig_image_attachment_fields_to_save($post, $attachment){
			if(isset($attachment['jig_image_link'])){
				update_post_meta($post['ID'], '_jig_image_link', $attachment['jig_image_link']);
			}
			if(isset($attachment['jig_image_link_target'])){
				update_post_meta($post['ID'], '_jig_image_link_target', $attachment['jig_image_link_target']);
			}
			return $post;
		}


		// allow reattachment of images to new pages/posts
		function jig_upload_columns($columns){
			unset($columns['parent']);
			$columns['better_parent'] = "Parent";
			return $columns;
		}
		function jig_media_custom_columns($column_name, $id){
			$post = get_post($id);
			if($column_name != 'better_parent')
				return;
			if($post->post_parent > 0){
				if(get_post($post->post_parent)){
					$title =_draft_or_post_title($post->post_parent);
				}
				echo '<strong><a href="'.get_edit_post_link( $post->post_parent ).'">'.$title.'</a></strong>, '.get_the_time(__('Y/m/d'))."<br />
				<a class=\"hide-if-no-js\" onclick=\"findPosts.open('media[]','".$post->ID."');return false;\" href=\"#the-list\">".__('Re-Attach','jig-td').'</a>';
			}else{
				echo __('(Unattached)','jig_td')."<br /><a class=\"hide-if-no-js\" onclick=\"findPosts.open('media[]','".$post->ID."');return false;\" href=\"#the-list\">".__('Attach','jig_td').'</a>';
			}
		}

		// returns absolute URL for attachment image (the WP function may not always do that)
		function jig_wp_get_attachment_image_src($id,$size){
			$src = wp_get_attachment_image_src($id,$size);
			if(!empty($src[0]) && substr($src[0],0,1) === '/'){
				$src[0] = 'http'.(is_ssl() ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$src[0];
			}
			return $src;
		}

		// Add data for Carousel
		function jig_add_carousel_data($attachment_id, $link_title_field, $img_alt_field){

			$attachment_id   = intval( $attachment_id );
			$orig_file       = $this->jig_wp_get_attachment_image_src( $attachment_id, 'full' );
			$orig_file       = isset( $orig_file[0] ) ? $orig_file[0] : wp_get_attachment_url( $attachment_id );
			$meta            = wp_get_attachment_metadata( $attachment_id );
			$size            = isset( $meta['width'] ) ? intval( $meta['width'] ) . ',' . intval( $meta['height'] ) : '';
			$img_meta        = ( ! empty( $meta['image_meta'] ) ) ? (array) $meta['image_meta'] : array();
			$comments_opened = intval( comments_open( $attachment_id ) );

			$medium_file_info = $this->jig_wp_get_attachment_image_src( $attachment_id, 'medium' );
			$medium_file      = isset( $medium_file_info[0] ) ? $medium_file_info[0] : '';

			$large_file_info  = $this->jig_wp_get_attachment_image_src( $attachment_id, 'large' );
			$large_file       = isset( $large_file_info[0] ) ? $large_file_info[0] : '';

			$attachment       = get_post( $attachment_id );

			// Get title
			$d['title'] =  esc_attr(stripslashes($attachment->post_title));
			$d['caption'] =  esc_attr(stripslashes($attachment->post_excerpt));
			$d['description'] =  esc_attr(stripslashes($attachment->post_content));
			$d['alternate'] =  esc_attr(stripslashes(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true)));

			$attachment_title = $d[$img_alt_field] ? wptexturize($d[$img_alt_field]) : '';
			$attachment_desc = $d[$link_title_field] ? wpautop(wptexturize($d[$link_title_field])) : '';

			//$attachment_title = wptexturize( $attachment->post_title );
			//$attachment_desc  = wpautop( wptexturize( $attachment->post_content ) );

			if ( ! empty( $img_meta ) ) {
				foreach ( $img_meta as $k => $v ) {
					if ( 'latitude' == $k || 'longitude' == $k )
						unset( $img_meta[$k] );
				}
			}

			$img_meta = json_encode( array_map( 'strval', $img_meta ) );


			return sprintf(
				'data-attachment-id="%1$d" data-orig-file="%2$s" data-orig-size="%3$s" data-comments-opened="%4$s" data-image-meta="%5$s" data-image-title="%6$s" data-image-description="%7$s" data-medium-file="%8$s" data-large-file="%9$s" ',
				$attachment_id,
				esc_attr( $orig_file ),
				$size,
				$comments_opened,
				esc_attr( $img_meta ),
				$attachment_title,
				$attachment_desc,
				esc_attr( $medium_file ),
				esc_attr( $large_file )
			);
		}

		// Add facebook overview to URLs
		function jig_add_facebook_overview_endpoint() {  
			add_rewrite_endpoint($this->settings['fb_overview_slug'], EP_PERMALINK | EP_DATE | EP_YEAR | EP_MONTH | EP_DAY | EP_ROOT | EP_COMMENTS | EP_SEARCH | EP_CATEGORIES | EP_TAGS | EP_AUTHORS | EP_PAGES);  
		}

		// Shuffle an accociative array
		function shuffle_assoc($list) { 
			if (!is_array($list)){
				return $list;
			}
			$keys = array_keys($list); 
			shuffle($keys); 
			$random = array(); 
			foreach ($keys as $key) { 
				$random[$key] = $list[$key]; 
			}
			return $random; 
		} 
		/**
	     * Basic cURL wrapper function for PHP
	     * @link http://snipplr.com/view/51161/basic-curl-wrapper-function-for-php/
	     * @param string $url URL to fetch
	     * @param array $curlopt Array of options for curl_setopt_array
	     * @return string
	     */
		function file_get_contents_curl($url, $curlopt = array()){		
			if(in_array('curl', get_loaded_extensions())){
				$ch = curl_init();
				$default_curlopt = array(
				CURLOPT_URL => $url,
				//CURLOPT_SSL_VERIFYPEER => false, // REMOVE THIS ON LIVE SERVER
				CURLOPT_TIMEOUT => 15,
				CURLOPT_CONNECTTIMEOUT => 15,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => false,
				CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.13) Gecko/20101203 AlexaToolbar/alxf-1.54 Firefox/3.6.13 GTB7.1"
				);
				$curlopt = array(CURLOPT_URL => $url) + $curlopt + $default_curlopt;
				curl_setopt_array($ch, $curlopt);
				$response = curl_exec($ch);
				if($response === false)
					trigger_error(curl_error($ch));
				curl_close($ch);
				return $response;
			}else{
				return file_get_contents($url);
			}
		}

		function file_get_contents_curl_post($url, $post_fields){		
			if(in_array('curl', get_loaded_extensions())){
				$ch = curl_init();
				$curlopt = array(
					CURLOPT_URL => $url,
					//CURLOPT_SSL_VERIFYPEER => false, // REMOVE THIS ON LIVE SERVER
					CURLOPT_POST => true,
					CURLOPT_TIMEOUT => 10,
					CURLOPT_CONNECTTIMEOUT => 10,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_FOLLOWLOCATION => false,
					CURLOPT_POSTFIELDS => $post_fields
				);
				curl_setopt_array($ch, $curlopt);
				$response = curl_exec($ch);
				if($response === false){
					trigger_error(curl_error($ch));
				}
				curl_close($ch);
				return $response;
			}else{
				  $params = array('http' => array(
				              'method' => 'POST',
				              'content' => $post_fields
				            ));
				  $ctx = stream_context_create($params);
				  $fp = @fopen($url, 'rb', false, $ctx);
				  if (!$fp) {
				    throw new Exception("Problem with $url, $php_errormsg");
				  }
				  $response = @stream_get_contents($fp);
				  if ($response === false) {
				    throw new Exception("Problem reading data from $url, $php_errormsg");
				  }
				  return $response;
			}
		}
	}
}

if (class_exists("JustifiedImageGrid")){
	global $justified_image_grid_js, $justified_image_grid_css, $justified_image_grid_ie_css, $justified_image_grid_instance;
	if(!isset($justified_image_grid_instance)){
		$justified_image_grid_instance = 0;
		$justified_image_grid_js = "
		if(typeof $.JIGminVersion !== 'undefined' && $.JIGminVersion('1.7') == false){
			$.JIGminVersion('1.7',true);
			return;
		}else{";
		$justified_image_grid_css = '';
		$justified_image_grid_ie_css = '';
	}
	$justified_image_grid = new JustifiedImageGrid();
	if(!function_exists('get_jig')){
		function get_jig($atts = '', $output_mode = 'echo'){
			$output = '';
			if(empty($atts)){
				$output =  do_shortcode('[justified_image_grid]');
			}elseif(!is_array($atts)){
				$output =  do_shortcode($atts);
			}elseif(count($atts) > 0){
				$sc = '[justified_image_grid';
				foreach ($atts as $key => $value) {
					$sc .= ' '.$key.'='.$value;
				}
				$sc .= ']';
				$output =  do_shortcode($sc);
			}	
			if($output_mode === 'echo'){
				echo $output;
			}else{
				return $output;
			}
		}
	}
}
register_activation_hook(__FILE__, array('JustifiedImageGrid', 'on_activate'));
register_uninstall_hook(__FILE__, array('JustifiedImageGrid', 'on_uninstall'));