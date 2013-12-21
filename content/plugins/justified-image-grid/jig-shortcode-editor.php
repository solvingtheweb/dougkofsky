<?php
	// this file is loaded in the modal window of tinyMCE
global $wp_version;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Justified Image Grid shortcode editor</title>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo includes_url( 'js/tinymce/tiny_mce_popup.js' ).'?ver='.$wp_version; ?>"></script> 
		<style type="text/css">
			body{
				overflow-y:scroll;
			}
			/* Main */
			label, .normalname, .minihelp, .minihelpNarrow {
				display: block;
				float: left;
				margin: 3px 0 5px 8px;
			}
			label {
				color: #3B5A99;
				width: 125px;
				text-align: right;
			}
			.checkboxLabel{
				color: inherit;
				text-align: left;
				width: auto;
				margin: 0;
			}
			.darkBlue{
				color:#3B5A99;
			}
			.rssRegularLink {
				color: #0092EE;
			}
			.rssFeedLink {
				color: #ee9700;
			}
			.rssHelpList li{
				font-weight: bold;
			}
			.rssHelpList ul li{
				font-weight: normal;
			}
			#jigColorHelperField{
				display: block;
				float: left;
				width: 70px;
			}
			#jigColorHelperPick{
				float: left;
				height: auto;
				padding: 2px 5px;
				font-weight: normal;
				width: auto;
				margin-left: 6px;
				text-shadow: 1px 1px white;
			}
			#jigColorHelper{
				float: right;
			}

			.tabHeadings{
				clear: both;
				color: #666666;
				float: left;
				font-size: 12px;
				font-weight: bold;
				padding-top: 14px;
				width: 68px;
			}
			.normalname {
				width: 185px;
			}
			.minihelp {
				color: #666;
				width: 405px;
			}
			.minihelpCheckbox {
				position: absolute;
				right: 18px;
				width: 300px;
			}
			.minihelpNarrow{
				color: #666;
				width: 400px;
			}
			#igLocationPanel .minihelpNarrow{
				width: auto;
			}
			.longHelp{
				margin:3px 8px 5px;
				color: #666;
			}
			#ngBcRow .longHelp{
				color: #000;
			}
			.ngBcHelp{
				color:#666;
				font-size: 9px;
			}
			#insert {
				float: left;
				font-size: 14px;
				margin: 10px 0;
				text-align: center;
				text-decoration: none;
				width: 175px;
			}
			#templateTagButton,
			.fbSourceBtn,
			.fliSourceBtn,
			.fliTypeBtn,
			.igSourceBtn,
			.tabButton,
			.igSmallBtn,
			.rssSmallBtn {
				color: #666;
				display: block;
				float: left;
				font-weight: normal;
				line-height: 24px;
				margin: 3px 0 5px 8px;
				padding: 0 6px;
				text-align: center;
				text-decoration: none;
				width: auto;
			}
			#rssButtons{
				padding-left: 193px;
			}
			#igNameContainer,
			#igTagContainer,
			#igLocationContainer{
				float:left;
				margin: -8px 0 5px 2px;
			}
			#igSelectUserText{
				margin: 3px 0 5px 6px;
			}
			.igSmallBtn.igNameBtn,
			.igSmallBtn.igTagBtn,
			.igSmallBtn.igLocationBtn
			{
				clear: none;
				float: left;
				height: 21px;
				line-height: 21px;
				margin: 5px;
			}
			#fbRow,
			#fliRow,
			#igRow{
				margin-bottom:4px;
			}
			#templateTagButton:hover {
				color:#000;
			}
			#insertButtonParent{
				background: none repeat scroll 0 0 #F1F1F1;
				border-top: 1px solid #dedee3;
				bottom: 0;
				right: 0;
				left: 0;
				height: 43px;
				position: fixed;
				padding-left: 8px;
				width: 100%;
				z-index: 10;
			}
			#bottomSpacer{
				height: 50px;
			}
			#hint{
				color: green;
				margin-bottom: 15px;
			}
			select,
			input,
			textarea,
			#templateTag,
			#doShortcode { 
				padding: 3px 5px;
				border: 1px solid #dedee3;
				border-radius: 3px 3px 3px 3px;
				width: 112px;
				margin: 0 0 0 8px;
				display: block;
				float: left;
			}
			input,
			textarea{
				width: 100px;
			}
			.checkbox{
				width: auto;
				margin: 0 6px 6px 0;
				clear: both;
			}

			.checkboxes {
				display: block;
				float: left;
				margin: 3px 0 0 8px;
				padding: 0;
			}
			#templateTag,
			#doShortcode{
				width:233px;
				background:white;
			}
			#templateTagHelp,
			#templateTagContainer,
			#doShortcodeHelp,
			#doShortcodeContainer{
				display:none;
			}
			h3 {
				color: #000000;
				margin: 0;
				padding: 0 0 10px;
				font-size:13px;
			}
			.jig_settings_group,
			.jig_settings_group_load_more,
			.jig_settings_group_filtering,
			.jig_settings_group_recents,
			.jig_settings_group_facebook,
			.jig_settings_group_flickr,
			.jig_settings_group_nextgen,
			.jig_settings_group_instagram,
			.jig_settings_group_rss{
				background: none repeat scroll 0 0 #F7F7F7;
				border: 1px solid #dedee3;
				border-radius: 6px 6px 6px 6px;
				margin-bottom: 15px;
				padding-bottom: 4px;
			}
			.row {
				clear: both;
				padding: 5px 0;
				height: 20px;
			}
			.flexirow{
				clear: both;
				padding: 5px 0;
				position:relative;
			}
			/* Facebook/Flickr */
			#fbHelp,
			#fliHelp,
			#igHelp,
			#recentsHelp,
			.rssHelp{
				margin:3px 8px 0;
			}
			#fbLoadingAJAX,
			#fliLoadingAJAX,
			#igLoadingAJAX{
				background: rgba(247,247,247,0.8);
				height: 100%;
				position: absolute;
				width: 100%;
				text-shadow: 0 1px white;
				display:none;
				z-index: 5;
			}
			#fbLoadingInner,
			#fliLoadingInner,
			#igLoadingInner{
				background: url("<?php echo plugins_url('images/ajax-loader.gif', __FILE__); ?>") no-repeat left 31px;
				font-size: 10px;
				font-weight: bold;
				margin-left: 350px;
				padding: 5px 0 0 5px;
				height: 50px;
				text-transform: uppercase;
				position: relative;
			}
			#igLoadingInner{
				padding-top:3px;
			}
			#fbLoadingInnerSmallText,
			#fliLoadingInnerSmallText,
			#igLoadingInnerSmallText{
				line-height: 16px;
				color: #666666;
				font-size: 8px;
				letter-spacing: 0.1px;
			}
			#igLoadingInnerSmallText{
				letter-spacing: 0;
			}
			#fbIcon,
			#fliIcon,
			#igIcon{
				position: absolute;
				height: 50px;
				left: -55px;
				position: absolute;
				top: 3px;
				width: 50px;
				background: url("<?php echo plugins_url('images/facebook-icon.png', __FILE__); ?>") no-repeat;
			}
			#fliIcon{
				background: url("<?php echo plugins_url('images/flickr-icon.png', __FILE__); ?>") no-repeat;
				top:4px;
				left:-50px;
			}
			#igIcon{
				background: url("<?php echo plugins_url('images/instagram-icon.png', __FILE__); ?>") no-repeat;
				left:-50px;
			}
			.fbBlue{
				color:#3B5A99;
			}
			#fbAlbums,
			#fliElements{
				padding: 10px 0 0 1px;
			}
			.fbAlbum,
			.fliElement{
				border: 1px solid black;
				float: left;
				height: 160px;
				margin: 5px;
				position: relative;
				width: 160px;
				background-color:#EEEEEE;				
				background-image: -ms-linear-gradient(bottom right, #DDDDDD 0%, #FFFFFF 100%);
				background-image: -moz-linear-gradient(bottom right, #DDDDDD 0%, #FFFFFF 100%);
				background-image: -o-linear-gradient(bottom right, #DDDDDD 0%, #FFFFFF 100%);
				background-image: -webkit-gradient(linear, right bottom, left top, color-stop(0, #DDDDDD), color-stop(1, #FFFFFF));
				background-image: -webkit-linear-gradient(bottom right, #DDDDDD 0%, #FFFFFF 100%);
				background-image: linear-gradient(to top left, #DDDDDD 0%, #FFFFFF 100%);
				cursor:pointer;
				border-radius:3px;
				overflow:hidden;
			}
			.fbAlbum:hover,
			.fliElement:hover{
				border: 2px solid black;
				margin: 4px;
			}
			.fliElement{
				width:150px;
				height: 150px;
			}
			.fliGroup{
				width: 203px;
				height:50px;
				border-radius: 3px;
				overflow:hidden;
			}
			.fliGroup.fliElement{
				border-width:1px;
				border-color:#bbb;
				border-style:solid;
				border: 1px solid #bbb;
			}
			.fliGroup.fliElement:hover{
				border-color:#555;
				margin:5px;
			}
			.fbAlbum.fbNoImg,
			.fliElement.fliNoImg{
				cursor:default;
				opacity: 0.8;
				-moz-opacity: 0.8;
				filter:alpha(opacity=80);
			}
			.fbAlbumToLoad,
			.fbAlbumLoading,
			.fbAlbumCantLoad,
			.fbAlbumError,
			.fliElementToLoad,
			.fliElementLoading,
			.fliElementCantLoad,
			.fliElementError{
				color: #999999;
				font-size: 10px;
				padding-top: 68px;
				padding-left: 5px;
				padding-right: 5px;
				position: absolute;
				text-align: center;
				width: 150px;
			}
			.fliGroup .fliElementToLoad,
			.fliGroup .fliElementLoading,
			.fliGroup .fliElementCantLoad,
			.fliGroup .fliElementError{
				color: #BBB;
				font-size: 10px;
				padding-top: 16px;
				padding-left: 0;
				padding-right: 0;
				position: absolute;
				text-align: center;
				width: 50px;
			}
			.fbAlbumError,
			.fliElementError{
				padding-top: 60px;
			}
			.fbAlbumPhoto,
			.fliElementPhoto{
				position: absolute;
			}
			.fliGroup .fliElementPhoto{
				padding: 1px;
			}
			.fbImgFade img,
			.fliImgFade img{
				display:none;
			}
			.fbAlbumTitle,
			.fliElementTitle{
				background: rgba(0, 0, 0, 0.6);
				bottom: 0;
				color: white;
				left: 0;
				padding: 5px;
				position: absolute;
				right: 0;
				text-align: center;
				text-shadow:1px 1px rgba(0,0,0,0.6);
			}
			.fliGroup .fliElementTitle{
				background: none;
				color: black;
				height: 40px;
				left:50px;
				top: auto;
				bottom: auto;
				right: auto;
				text-align: left;
				text-shadow: 1px 1px #FFF;
				border-left-color:inherit;
				border-left-style:inherit;
				border-left-width:inherit;
			}
			.fliGroup .fliElementTitle p{
				height: 100%;
				margin: 0;
				padding: 0;
				overflow: hidden;
				line-height: 12px
			}
			.fbAlbumCount,
			.fbMouseIndicator,
			.fbLoadingIndicator,
			.fliElementCount,
			.fliMouseIndicator,
			.fliLoadingIndicator
			{
				background: rgba(0, 0, 0, 0.6);
				border-radius: 7px 7px 7px 7px;
				color: white;
				margin: 5px;
				padding: 5px 8px;
				position: absolute;
				right: 0;
				text-align: center;
				top: 0;
				text-shadow:1px 1px rgba(0,0,0,0.6);
			}
			.fbMouseIndicator,
			.fbLoadingIndicator,
			.fliMouseIndicator,
			.fliLoadingIndicator{
				left:0;
				right: auto;
			}
			#fbSources,
			#fliSources,
			#fliTypes,
			#igSources{
				padding:0 4px;
			}
			#igSources{
				border-bottom:1px dashed #dedee3;
				padding-bottom:10px;
			}
			#fliTypes,
			#fbAlbums,
			.dashedRow,
			.generalDashedRow{
				border-top:1px dashed #dedee3;
				padding-top:10px;
				margin-top:10px;
			}
			.generalDashedRow{
				font-size: 12px;
    			text-align: center;
    			font-weight: bold;
    			padding-bottom: 13px;
    			padding-top: 12px;
			}
			#igRecentsPanel,
			#igTagPanel,
			#igLocationPanel{
				display: none;
			}
			.igPanelsRow{
				display: none;
				border-bottom:1px dashed #dedee3;
				margin-bottom: 9px;
			}
			#instagramLocationSearch{
				width:390px;
			}
			#fbError,
			#fliError,
			#igError{
				margin:0 6px 0;
				color:red;
				font-weight: bold;
			}

			.fbSourceBtn,
			.fliSourceBtn,
			.fliTypeBtn,
			.igSourceBtn,
			.tabButton,
			.igSmallBtn,
			.rssSmallBtn{
				padding: 3px 8px 4px;
				margin: 5px;
				color:black;
				text-shadow:1px 1px white;
			}
			.igSmallBtn{
				clear: both;
				height: 21px;
				line-height: 21px;
				margin: -8px 0 0;
			}
			.fbSourceBtn img,
			.fliSourceBtn img,
			.igSourceBtn img,
			.igSmallBtn img{
				float: left;
				height: 16px;
				margin-right: 10px;
				margin-top: 4px;
				width: 16px;
			}
			.fbSelected,
			.fbSelected:hover,
			.fbSelected:active,
			.fbSelected:focus,
			.fliSelected,
			.fliSelected:hover,
			.fliSelected:active,
			.fliSelected:focus,
			.igSelected,
			.igSelected:hover,
			.igSelected:active,
			.igSelected:focus,
			.fliGroup.fliElement.fliSelectedElement,
			.fliGroup.fliElement.fliSelectedElement:hover,
			.fliGroup.fliElement.fliSelectedElement:active,
			.fliGroup.fliElement.fliSelectedElement:focus,
			.selectedTabButton,
			.selectedTabButton:hover,
			.selectedTabButton:active,
			.selectedTabButton:focus,
			.igSmallBtn.igNameBtn.igSelected,
			.igSmallBtn.igNameBtn.igSelected:hover,
			.igSmallBtn.igNameBtn.igSelected:active,
			.igSmallBtn.igNameBtn.igSelected:focus,
			.igSmallBtn.igTagBtn.igSelected,
			.igSmallBtn.igTagBtn.igSelected:hover,
			.igSmallBtn.igTagBtn.igSelected:active,
			.igSmallBtn.igTagBtn.igSelected:focus,
			.igSmallBtn.igLocationBtn.igSelected,
			.igSmallBtn.igLocationBtn.igSelected:hover,
			.igSmallBtn.igLocationBtn.igSelected:active,
			.igSmallBtn.igLocationBtn.igSelected:focus
			{
				border: 2px solid #3B5A99;
				margin:4px;
			}
			.fliGroup.fliSelectedElement .fliElementTitle{
				border-left:1px solid #bbb;
			}
			.fliGroup.fliSelectedElement:hover .fliElementTitle{
				border-left:1px solid #555;
			}

			.fbSelectedAlbum,
			.fbSelectedAlbum:hover,
			.fliSelectedElement,
			.fliSelectedElement:hover{
				border: 3px solid #3B5A99;
				margin:3px;
			}
			/* Flickr */
			/* Rest */
			.long_select {
				width: 220px;
			}
			.long_input {
				width: 210px;
			}
			.minihelpShort {
				width: 295px;
			}
			#jigTabs{
				margin-bottom: 10px;
			}
			#inputShortcodeBlock{
				margin-bottom: 10px;
			}
			#shortcodeLabel,
			#inputShortcode{
				display:block;
				float:left;
				font-size: 13px;
			}
			#shortcodeLabel{
				font-weight: bold;
				margin-top: 4px;
			}
			#inputShortcode{
				width:590px;
				left: 257px;
				position: absolute;
			}
			#outputShortcodeLabel{
				float: left;
				font-size: 14px;
				margin: 14px 10px 10px;
				width: 192px;
    		}
    		#outputShortcode{
				width: 466px;
				right: 16px;
				position: absolute;
				top: 12px;
    		}
			.jigTabTitle,
			.jigSettingsTab{
				position:absolute;
				left:-9999px;
				top:-9999px;
			}
			.jigTabTitle.selectedTab,
			.jigSettingsTab.selectedTab{
				position:static;
				left:auto;
				top:auto;
			}
			#jig_general_settings_tab_content{
				border-left: 3px solid #8a00ff;
			}
			#jig_load_more_tab_content{
				border-left: 3px solid #00a8ff;
			}
			#jig_filtering_tab_content{
				border-left: 3px solid #FF0000;
			}
			#jig_lightboxes_tab_content{
				border-left: 3px solid #ffc600;
			}
			#jig_captions_tab_content{
				border-left: 3px solid #ff0072;
			}
			#jig_overlay_tab_content{
				border-left: 3px solid #9958c3;
			}
			#jig_specialfx_tab_content{
				border-left: 3px solid #0feaea;
			}
			#facebook{
				border-left: 3px solid #3b5998;
			}
			#flickr{
				border-left: 3px solid #0063dc;
			}
			#instagram{
				border-left: 3px solid #507ea2;
			}
			#jig_rss_tab_content{
				border-left: 3px solid #fe9900;
			}
			#jig_nextgen_tab_content{
				border-left: 3px solid #b6e82a;
			}
			#jig_recent_posts_tab_content{
				border-left: 3px solid #fe00b3;
			}
			#jig_template_tag_tab_content{
				border-left: 3px solid #399c9d;				
			}
			.clearfix:after {
				content: ".";
				display: block;
				clear: both;
				visibility: hidden;
				line-height: 0;
				height: 0;
			}
			.clearfix {
				display: inline-block;
			}
			html[xmlns] .clearfix {
				display: block;
			}
			* html .clearfix {
				height: 1%;
			}
		</style>
		<!--[if IE]> <style type='text/css'>
			.fbAlbumCount, .fbMouseIndicator, .fbLoadingIndicator, .fliElementCount, .fliMouseIndicator, .fliLoadingIndicator, .fbAlbumTitle, .fliElementTitle { background:transparent; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000); zoom: 1; }
			.fbLoadingAJAX, .fliLoadingAJAX, .igLoadingAJAX, { background:transparent; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#CCF7F7F7,endColorstr=#CCF7F7F7); zoom: 1; }
		 </style> <![endif]-->

	</head>
	<body>
		<div id="jig-sc-editor" style="display:none;">
			<form action="/" method="get" accept-charset="utf-8">
				<div id="inputShortcodeBlock" class="clearfix">
					<div id="shortcodeLabel"><?php _e('Enter shortcode to edit (optional)', 'jig_td'); ?>:</div>
					<input type="text" name="inputShortcode" id="inputShortcode" value='' />
				</div>
				<div id="jigTabs" class="clearfix">
					<div class="tabHeadings"><?php _e('Settings', 'jig_td'); ?>:</div>
					<div class="updateButton tabButton selectedTabButton" id="jigTabGeneralSettings"><?php _e('General settings', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabLoadMore"><?php _e('Load more', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabFiltering"><?php _e('Filtering', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabLightboxes"><?php _e('Lightboxes', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabCaptions"><?php _e('Captions', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabOverlayEffects"><?php _e('Overlay effects', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabSpecialEffects"><?php _e('Special effects', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabTemplateTag"><?php _e('Template Tag', 'jig_td'); ?></div>

					<div class="tabHeadings"><?php _e('Sources', 'jig_td'); ?>:</div>
					<div class="updateButton tabButton" id="jigTabNextGEN"><?php _e('NextGEN', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabRecentPosts"><?php _e('Recent posts', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabFacebook"><?php _e('Facebook', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabFlickr"><?php _e('Flickr', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabInstagram"><?php _e('Instagram', 'jig_td'); ?></div>
					<div class="updateButton tabButton" id="jigTabRSS"><?php _e('RSS', 'jig_td'); ?></div>


				</div>
				<div id="jigColorHelper">
					<input type="text" value="<?php _e('Select color', 'jig_td'); ?>" id="jigColorHelperField" />
					<div id="jigColorHelperPick" class="updateButton"><?php _e('Pick', 'jig_td'); ?></div>
				</div>
				<h3 class="jigTabTitle selectedTab" id="jigGeneralSettings"><?php _e('General settings', 'jig_td'); ?></h3>
				<div id="jig_general_settings_tab_content" class="jigSettingsTab selectedTab jig_settings_group clearfix">

					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e("Override the plugin's settings", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Preset', 'jig_td'); ?></div>
						<label>preset</label>
						<select name="preset" class="long_select">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="1"><?php _e('Preset 1: Out of the box', 'jig_td'); ?></option>
							<option value="2"><?php _e("Preset 2: Author's favorite", 'jig_td'); ?></option>
							<option value="3"><?php _e('Preset 3: Flickr style', 'jig_td'); ?></option>
							<option value="4"><?php _e('Preset 4: Google+ style', 'jig_td'); ?></option>
							<option value="5"><?php _e('Preset 5: Fixed height, no fancy', 'jig_td'); ?></option>
							<option value="6"><?php _e('Preset 6: Artistic-zen', 'jig_td'); ?></option>
							<option value="7"><?php _e('Preset 7: Color magic fancy style', 'jig_td'); ?></option>
							<option value="8"><?php _e('Preset 8: Big images no click', 'jig_td'); ?></option>
							<option value="9"><?php _e('Preset 9: Focus on the text', 'jig_td'); ?></option>
							<option value="10"><?php _e('Preset 10: Hidden', 'jig_td'); ?></option>
							<option value="11"><?php _e('Preset 11: Magnifier blur', 'jig_td'); ?></option>
							<option value="12"><?php _e("Preset 12: Author's other favorite", 'jig_td'); ?></option>
							<option value="13"><?php _e('Preset 13: Orton effect', 'jig_td'); ?></option>
							<option value="14"><?php _e('Preset 14: Animated border and glow', 'jig_td'); ?></option>
							<option value="15"><?php _e('Preset 15: Borders and shadow', 'jig_td'); ?></option>
							<option value="16"><?php _e('Preset 16: Facebok inspired', 'jig_td'); ?></option>
							<option value="17"><?php _e('Preset 17: Vertical center', 'jig_td'); ?></option>
							<option value="18"><?php _e('Preset 18: Vertical creative', 'jig_td'); ?></option>
							<option value="19"><?php _e('Preset 19: Caption fun, gray background', 'jig_td'); ?></option>
							<option value="20"><?php _e('Preset 20: Caption below the thumbs', 'jig_td'); ?></option>
						</select>
						<div class="minihelp minihelpShort"><?php _e('Choose one of the 20 presets.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="longHelp"><?php _e("Note: Selecting a preset here will cause this instance to disregard your choices from the plugin's settings page (except some core settings).", 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('WordPress image sources - Media Library', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e("IDs", 'jig_td'); ?></div>
						<label>ids</label>
						<input type="text" name="ids" value='' />
						<div class="minihelp"><?php _e("Enter image IDs, comma separated. Just copy from the [gallery] shortcode (can be accessed on the text editor tab).", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Other post/page ID', 'jig_td'); ?></div>
						<label>id</label>
						<input type="text" name="id" value='' />
						<div class="minihelp"><?php _e('Use this to show images attached to another page/post: postID, a number which you can get by looking at the URL bar when editing it).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Exclude these images', 'jig_td'); ?></div>
						<label>exclude</label>
						<input type="text" name="exclude" value='' />
						<div class="minihelp"><?php _e('This is only used when you display images attached to the post/page. You can get the ID by looking at the Permalink of each image in the Media Library. Add them here, separated by a comma. For example: 21,featured,652 (you can use the word "featured").', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Include these images', 'jig_td'); ?></div>
						<label>include</label>
						<input type="text" name="include" value='' />
						<div class="minihelp"><?php _e('Includes only these from the attached images of the page/post. Opposite of exclude so you can only use one of these two settings.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Image categories', 'jig_td'); ?></div>
						<label>image_categories</label>
						<input type="text" name="image_categories" value='' />
						<div class="minihelp"><?php _e('Enter category slugs, comma separated. You can only use this when "WP image tags and categories" is enabled in the Settings. Can be combined with the "Image tags" setting.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Image tags', 'jig_td'); ?></div>
						<label>image_tags</label>
						<input type="text" name="image_tags" value='' />
						<div class="minihelp"><?php _e('Enter tag slugs, comma separated. The same restriction applies as with "Image categories". Can be combined with "Image categories".', 'jig_td'); ?></div>
					</div>

					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Row behavior', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Target row height', 'jig_td'); ?></div>
						<label>row_height</label>
						<input type="text" name="row_height" value='' />
						<div class="minihelp"><?php _e('Desired row height in pixels, e.g. 200 (without px).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Row height max deviation (+-)', 'jig_td'); ?></div>
						<label>height_deviation</label>
						<input type="text" name="height_deviation" value='' />
						<div class="minihelp"><?php _e('The row height will vary +/- by this value, e.g. 50 (without px).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Max rows', 'jig_td'); ?></div>
						<label>max_rows</label>
						<input type="text" name="max_rows" value='' />
						<div class="minihelp"><?php _e('Only show up to this amount of rows. 0 to force unlimited. Combined with a fixed row height (0 deviation), this can result a banner.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Incomplete last row', 'jig_td'); ?></div>
						<label>last_row</label>
						<select name="last_row">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="normal"><?php _e('Normal: Try to fill width OR fall back to target height (visibly incomplete).', 'jig_td'); ?></option>
							<option value="hide"><?php _e('Hide: Form a perfect justified block.', 'jig_td'); ?></option>
							<option value="flexible"><?php _e('Flexible: For Load More: only allow the very last row to be orphan.', 'jig_td'); ?></option>
							<option value="match"><?php _e("Match previous row's height, useful for same aspect ratio photos.", 'jig_td'); ?></option>
							<option value="flexible-match"><?php _e('Flexible Match: For Load More: combines Flexible and Match.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('The last row is not always full - choose how to handle it.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Mobile row height', 'jig_td'); ?></div>
						<label>mobile_row_height</label>
						<input type="text" name="mobile_row_height" value='' />
						<div class="minihelp"><?php _e('Same as "Target row height", but only for mobiles. Optional!', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Mobile row height deviation (+-)', 'jig_td'); ?></div>
						<label>mobile_height_dev</label>
						<input type="text" name="mobile_height_dev" value='' />
						<div class="minihelp"><?php _e('Same as "Row height max deviation", but for mobiles. Optional!', 'jig_td'); ?></div>
					</div>

					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Thumbnail count and dimensions', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Limit image count *', 'jig_td'); ?></div>
						<label>limit</label>
						<input type="text" name="limit" value='' />
						<div class="minihelp"><?php _e('Only show up to this number of images. Set 0 for unlimited.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Hidden limit *', 'jig_td'); ?></div>
						<label>hidden_limit</label>
						<input type="text" name="hidden_limit" value='' />
						<div class="minihelp"><?php _e('More images can still be added to the lightbox, until the Hidden limit.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Spacing between the thumbnails', 'jig_td'); ?></div>
						<label>thumbs_spacing</label>
						<input type="text" name="thumbs_spacing" value='' />
						<div class="minihelp"><?php _e('Enter a number like 0, 1, 4 or 10 (without px).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Thumbnail aspect ratio', 'jig_td'); ?></div>
						<label>aspect_ratio</label>
						<input type="text" name="aspect_ratio" value='' />
						<div class="minihelp"><?php _e('To crop your thumbs enter a ratio: 1, 1:1 or 1/1 (square) 2.35:1 or 16:9 (wide), 4/3, 1.5 or similar - to lock it, look at the next setting.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Disable cropping', 'jig_td'); ?></div>
						<label>disable_cropping</label>
						<select name="disable_cropping">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="no"><?php _e('No, respect the row height and allow some cropping.', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes, lock aspect ratio and use 50px minimum row height.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Use this to avoid cropping or to lock your selected aspect ratio.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Randomize thumbnail width ', 'jig_td'); ?></div>
						<label>randomize_width</label>
						<input type="text" name="randomize_width" value='' />
						<div class="minihelp"><?php _e('A number (without px) to make images randomly cropped or extended within this range.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="longHelp"><?php _e('* Note: Facebook, Flickr and Instagram have a default limit of ~25 and a maximum of 500. Enter something other than 0 to show more.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Settings that affect the entire grid', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Order by', 'jig_td'); ?></div>
						<label>orderby</label>
						<select name="orderby">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="menu_order"><?php _e('Menu order', 'jig_td'); ?></option>
							<option value="rand"><?php _e('Random', 'jig_td'); ?></option>
							<option value="title_asc"><?php _e('Title ascending', 'jig_td'); ?></option>
							<option value="title_desc"><?php _e('Title descending', 'jig_td'); ?></option>
							<option value="date_asc"><?php _e('Date ascending', 'jig_td'); ?></option>
							<option value="date_desc"><?php _e('Date descending', 'jig_td'); ?></option>
							<option value="custom"><?php _e('Force menu order for recent posts', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('The order of images (only for images from WP, except Random).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Width mode', 'jig_td'); ?></div>
						<label>width_mode</label>
						<select name="width_mode">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="responsive_fallback"><?php _e('Responsive fallback, automatic', 'jig_td'); ?></option>
							<option value="fixed"><?php _e('Non-responsive, fixed', 'jig_td'); ?></option>
							<option value="fixed-mobile"><?php _e('Fixed width for mobile - Responsive on desktop', 'jig_td'); ?></option>
							<option value="fixed-desktop"><?php _e('Fixed width for desktop - Responsive on mobile', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Set to Fixed if you have the "element is too thin" error. You must set a width at the next setting if you selected any of the Fixed modes.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Custom width (whole grid)', 'jig_td'); ?></div>
						<label>custom_width</label>
						<input type="text" name="custom_width" value='' />
						<div class="minihelp"><?php _e('The width to use by "Width mode", (empty is default). Without px.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Margin around gallery', 'jig_td'); ?></div>
						<label>margin</label>
						<input type="text" name="margin" value='' />
						<div class="minihelp"><?php _e('A CSS margin value e.g. 10px (around) or 0 10px (sides only).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Animation speed', 'jig_td'); ?></div>
						<label>animation_speed</label>
						<input type="text" name="animation_speed" value='' />
						<div class="minihelp"><?php _e('For every animation, in milliseconds: 200 is fast, 600 is slow.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Min height to avoid "jumping"', 'jig_td'); ?></div>
						<label>min_height</label>
						<input type="text" name="min_height" value='' />
						<div class="minihelp"><?php _e('To avoid seeing the footer if you have no sidebar, e.g. 500 (without px). Makes the grid take up some space even without images.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Background behind thumbnails', 'jig_td'); ?></div>
						<label>loading_background</label>
						<input type="text" name="loading_background" value='' />
						<div class="minihelp"><?php _e('You could specify a grey color like Flickr #cccccc or #eaeaea or even a loader animation. Accepts CSS background property.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Show custom text before', 'jig_td'); ?></div>
						<label>show_text_before</label>
						<select name="show_text_before">
								<option value="default" selected="selected"><?php _e('default (yes)', 'jig_td'); ?></option>
								<option value="no"><?php _e('No', 'jig_td'); ?></option>

						</select>
						<div class="minihelp"><?php _e('Leave unchanged to allow custom text or disable.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Show custom text after', 'jig_td'); ?></div>
						<label>show_text_after</label>
						<select name="show_text_after">
								<option value="default" selected="selected"><?php _e('default (yes)', 'jig_td'); ?></option>
								<option value="no"><?php _e('No', 'jig_td'); ?></option>

						</select>
						<div class="minihelp"><?php _e('You can set these before & after texts in the settings.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Behavior of the plugin', 'jig_td'); ?></div>
					</div>					
					<div class="row">
						<div class="normalname"><?php _e('Allow animated GIFs', 'jig_td'); ?></div>
						<label>allow_animated_gifs</label>
						<select name="allow_animated_gifs">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="no"><?php _e('No, resize and freeze them.', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes, let them display as-is.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Show animated GIFs as-is, animated, not freezed nor broken.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Allow transparent PNGs', 'jig_td'); ?></div>
						<label>allow_transp_pngs</label>
						<select name="allow_transp_pngs">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="no"><?php _e('No.', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes, let them display with transparency.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Only enable if you really want to use transparent PNGs.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Wrap text', 'jig_td'); ?></div>
						<label>wrap_text</label>
						<select name="wrap_text">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="no"><?php _e('No, clear the block.', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes, let the text wrap around JIG.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Let the text flow to the right after the last image, e.g. single images.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Disable mobile hover interaction', 'jig_td'); ?></div>
						<label>disable_mobile_hover</label>
						<select name="disable_mobile_hover">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="no"><?php _e('No', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose yes if you wish to avoid "double tapping" to open images.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Disable right mouse menu', 'jig_td'); ?></div>
						<label>mouse_disable</label>
						<select name="mouse_disable">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="no"><?php _e('No', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose yes if you wish to disable right click menu (prevent copy).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e("Error checking", 'jig_td'); ?></div>
						<label>error_checking</label>
						<select name="error_checking">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes', 'jig_td'); ?></option>
							<option value="no"><?php _e('No', 'jig_td'); ?></option>					
						</select>
						<div class="minihelp"><?php _e('Yes to hide unloadable images from the grid, No to show them all.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e("Custom link's target", 'jig_td'); ?></div>
						<label>link_target</label>
						<select name="link_target">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="_self"><?php _e('Self: The same tab or same window.', 'jig_td'); ?></option>
							<option value="_blank"><?php _e('Blank: A new tab or new window.', 'jig_td'); ?></option>					
							<option value="video"><?php _e('Lightbox: video / iframe / different image.', 'jig_td'); ?></option>					
							<option value="off"><?php _e('Off: Disregard custom links.', 'jig_td'); ?></option>					
						</select>
						<div class="minihelp"><?php _e('Choose where you wish to open custom links.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Follow mode for custom links', 'jig_td'); ?></div>
						<label>custom_link_follow</label>
						<select name="custom_link_follow">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: dofollow', 'jig_td'); ?></option>
								<option value="no"><?php _e('No: add nofollow', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Tell search engines to follow the custom link to the external site.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Developer link', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Display developer link', 'jig_td'); ?></div>
						<label>developer_link</label>
						<select name="developer_link">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="show"><?php _e('Show', 'jig_td'); ?></option>
								<option value="hide"><?php _e('Hide', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Show a "Powered by" affiliate link. Set this up in the settings.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('TimThumb', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('TimThumb quality', 'jig_td'); ?></div>
						<label>quality</label>
						<input type="text" name="quality" value='' />
						<div class="minihelp"><?php _e('Leave empty or enter a number between 0 and 100.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Retina ready', 'jig_td'); ?></div>
						<label>retina_ready</label>
						<select name="retina_ready">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes, load higher resolution thumbnails on HDPI displays.', 'jig_td'); ?></option>
								<option value="no"><?php _e('No, just load normal resolution thumbnails on all devices.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('The thumbnails will look crisp on modern mobile devices or other high resolution displays.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Retina quality', 'jig_td'); ?></div>
						<label>retina_quality</label>
						<input type="text" name="retina_quality" value='' />
						<div class="minihelp"><?php _e("This determines the thumbnails' file size. Same as TimThumb quality. Best set to auto (or empty), which will divide TimThumb quality by the pixel aspect ratio of the device.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Custom TimThumb path', 'jig_td'); ?></div>
						<label>timthumb_path</label>
						<input type="text" name="timthumb_path" value='' />
						<div class="minihelp"><?php _e('Absolute path (full URL), most likely just leave it empty.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Use TimThumb', 'jig_td'); ?></div>
						<label>use_timthumb</label>
						<select name="use_timthumb">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: Use TimThumb (recommended).', 'jig_td'); ?></option>
								<option value="no"><?php _e('No: Do not use TimThumb (not recommended).', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Only disable TimThumb if you know what you are doing, for logos, tesing purposes or as a last resort.', 'jig_td'); ?></div>
					</div>
				</div>
				<h3 class="jigTabTitle" id="jigLoadMore"><?php _e('Load more', 'jig_td'); ?></h3>
				<div id="jig_load_more_tab_content" class="jigSettingsTab jig_settings_group_load_more clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Load more (behavior)', 'jig_td'); ?></div>
						<label>load_more</label>
						<select name="load_more">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off: All images are loaded in one go.', 'jig_td'); ?></option>
								<option value="click"><?php _e("Click: 'Load more' button.", 'jig_td'); ?></option>
								<option value="scroll"><?php _e('Infinite Scroll (+ the button).', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Enable this to break down loading into smaller batches.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Load more only on mobile', 'jig_td'); ?></div>
						<label>load_more_mobile</label>
						<select name="load_more_mobile">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e('No: Not just mobiles.', 'jig_td'); ?></option>
								<option value="yes"><?php _e("Yes: Only for mobile devices.", 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("Use this if you only want use Load More on mobile devices.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Load more limit (per load)', 'jig_td'); ?></div>
						<label>load_more_limit</label>
						<input type="text" name="load_more_limit" value='' />
						<div class="minihelp"><?php _e("Amount of images to fetch initially, then per load. This should be something smaller than the 'Limit' (if set).", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Load more text', 'jig_td'); ?></div>
						<label>load_more_text</label>
						<input type="text" name="load_more_text" value='' />
						<div class="minihelp"><?php _e("The text to show on the button, instead of 'Load more'.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Load more count text', 'jig_td'); ?></div>
						<label>load_more_count_text</label>
						<input type="text" name="load_more_count_text" value='' />
						<div class="minihelp"><?php _e("Second line of the button, *count* is replaced with the actual remaining count. To turn off, enter the word: none.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Load more auto width', 'jig_td'); ?></div>
						<label>load_more_auto_width</label>
						<select name="load_more_auto_width">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="on"><?php _e('On: Automatic width, overrides any CSS.', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off: Width is controlled by CSS.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("Automatically set the Load more button's width to smallest possible.", 'jig_td'); ?></div>
					</div>
					<div class="flexirow">
						<div class="longHelp"><?php _e("Tip: Set the 'General settings -> Incomplete last row' setting to be 'flexible' (last_row=flexible), as it'll hide the orphan rows except the last when there is no more images to display. It's been designed for this Load More feature.", 'jig_td'); ?></div>
					</div>
				</div>

				<h3 class="jigTabTitle" id="jigFiltering"><?php _e('Filtering', 'jig_td'); ?></h3>
				<div id="jig_filtering_tab_content" class="jigSettingsTab jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Filter by', 'jig_td'); ?></div>
						<label>filterby</label>
						<select name="filterby">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="off"><?php _e('Nothing, turn filtering off.', 'jig_td'); ?></option>
							<option value="on"><?php _e('Automatic (on): Choose a tag taxonomy automatically, this should work in most cases.', 'jig_td'); ?></option>

						<?php
							$post_types_for_filtering = $taxonomies_for_filtering = array();
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
							$taxonomies_as_options = '';
							foreach ($post_types_for_filtering as $post_type_name => $post_type_label) {
								$post_type_taxonomies = get_object_taxonomies($post_type_name, 'objects');
								if(!empty($post_type_taxonomies)){
									foreach ($post_type_taxonomies as $post_type_taxonomy_name => $post_type_taxonomy_value) {
										if(!$taxonomies_for_filtering[$post_type_taxonomy_name]){
											$taxonomies_for_filtering[$post_type_taxonomy_name] = true;	
											$taxonomies_as_options .= '<option value="'.$post_type_taxonomy_name.'">'.$post_type_taxonomy_value->label.' ('.$post_type_taxonomy_name.')</option>';
										}
									}
								}
							}
							echo $taxonomies_as_options;
						?>
						</select>
						<div class="minihelp"><?php _e('Choose a taxonomy to filter the thumbnails, more info in the settings.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Filter style', 'jig_td'); ?></div>
						<label>filter_style</label>
						<select name="filter_style">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="buttons"><?php _e('Buttons', 'jig_td'); ?></option>
							<option value="tags"><?php _e('Tag cloud', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose how the filtering interface should look like.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Order filter terms by', 'jig_td'); ?></div>
						<label>filter_orderby</label>
						<select name="filter_orderby">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="appearance"><?php _e('In order of appearance in images', 'jig_td'); ?></option>
							<option value="title_asc"><?php _e('Title ascending (A-Z)', 'jig_td'); ?></option>
							<option value="title_desc"><?php _e('Title descending (Z-A)', 'jig_td'); ?></option>
							<option value="random"><?php _e('Random', 'jig_td'); ?></option>
							<option value="popularity"><?php _e('Popularity among images (top terms first)', 'jig_td'); ?></option>
							<option value="custom"><?php _e('Custom (use the next setting)', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Set an order for the filter buttons or tags. This does not change the order of images.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Filter terms custom order ', 'jig_td'); ?></div>
						<label>filter_custom_order</label>
						<input type="text" name="filter_custom_order" value='' />
						<div class="minihelp"><?php _e('Manually enter filter buttons or tags by name, comma separated, Case Sensitive! Only those that you specify will be used and in the exact order. This is a manual setting and requires you to know the term names, furthermore filter_orderby needs to be on custom.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Min count for term', 'jig_td'); ?></div>
						<label>filter_min_count</label>
						<input type="text" name="filter_min_count" value='' />
						<div class="minihelp"><?php _e('Only show those filter buttons or tags that have at least this number of images.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Top x terms', 'jig_td'); ?></div>
						<label>filter_top_x</label>
						<input type="text" name="filter_top_x" value='' />
						<div class="minihelp"><?php _e('Limit the number of filter buttons or tags to the top x (any number) that occur in the most images.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Use All button', 'jig_td'); ?></div>
						<label>filter_all_button</label>
						<select name="filter_all_button">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes', 'jig_td'); ?></option>
							<option value="no"><?php _e('No', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Whether or not to use the All button. When not used, the first filter button or tag will be active instead of an All button.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Filter: "All" button/tag text', 'jig_td'); ?></div>
						<label>filter_all_text</label>
						<input type="text" name="filter_all_text" value='' />
						<div class="minihelp"><?php _e('Change what appears on the "All" button/tag, e.g. "All posts" etc.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Allow multiple filters', 'jig_td'); ?></div>
						<label>filter_multiple</label>
						<select name="filter_multiple">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="no"><?php _e('No', 'jig_td'); ?></option>
							<option value="or"><?php _e('OR (expanding selection, union)', 'jig_td'); ?></option>
							<option value="and"><?php _e('AND (narrowing selection, intersect)', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Normally, the visitors can only select one term at a time. If this is set to OR, then all images matching any of the selected terms will be displayed. In case of AND, only images that match all selected terms will be shown.', 'jig_td'); ?></div>
					</div>
				</div>

				<h3 class="jigTabTitle" id="jigLightboxes"><?php _e('Lightboxes', 'jig_td'); ?></h3>
				<div id="jig_lightboxes_tab_content" class="jigSettingsTab jig_settings_group clearfix">
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('What to do when clicking on a thumbnail', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Lightbox type', 'jig_td'); ?></div>
						<label>lightbox</label>
						<select name="lightbox">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="prettyphoto">prettyPhoto</option>
							<option value="colorbox">ColorBox</option>
							<option value="photoswipe">PhotoSwipe</option>
							<?php if (class_exists('fooboxV2') || class_exists('foobox')) echo '<option value="foobox">FooBox</option>'; ?>
							<?php if ($this->social_gallery_plugin_data[0] !== false) echo '<option value="socialgallery">Social Gallery</option>'; ?>
							<?php if((class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'carousel', Jetpack::get_active_modules() ) && class_exists( 'Jetpack_Carousel' )) === true )
								echo '<option value="carousel">Jetpack\'s Carousel  for WP images ONLY.</option>'; ?>
							<option value="custom"><?php _e('Custom', 'jig_td'); ?></option>
							<option value="no"><?php _e('No: Open by the browser', 'jig_td'); ?></option>
							<option value="new_tab"><?php _e('New tab: Open by the browser', 'jig_td'); ?></option>
							<option value="attachment"><?php _e('Attachment page', 'jig_td'); ?></option>
							<option value="links-off"><?php _e('Links-off', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Decide what happens when an image is clicked.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Mobile lightbox', 'jig_td'); ?></div>
						<label>mobile_lightbox</label>
						<select name="mobile_lightbox">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="photoswipe">PhotoSwipe</option>
							<?php if (class_exists('fooboxV2') || class_exists('foobox')) echo '<option value="foobox">FooBox</option>'; ?>
							<option value="no"><?php _e('Same as desktop.', 'jig_td'); ?></option>					
						</select>
						<div class="minihelp"><?php _e("Choose to force a certain lightbox on mobile devices.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Link class(es)', 'jig_td'); ?></div>
						<label>link_class</label>
						<input type="text" name="link_class" value='' />
						<div class="minihelp"><?php _e("Class of the image's anchor tag.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Link rel', 'jig_td'); ?></div>
						<label>link_rel</label>
						<input type="text" name="link_rel" value='' />
						<div class="minihelp"><?php _e("This groups images together (prev/next arrows). Can't use [] square brackets here, so format it like this: gallery(modal) or just leave empty for the automatic, best results. It can be set to auto as well.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Maximum size for lightbox', 'jig_td'); ?></div>
						<label>lightbox_max_size</label>
						<select name="lightbox_max_size">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="large"><?php _e('Large', 'jig_td'); ?></option>
							<option value="full"><?php _e('Full', 'jig_td'); ?></option>
							<option value="medium"><?php _e('Medium', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Maximum size of the WP image that loads in the lightbox.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Download link for the image', 'jig_td'); ?></div>
						<label>download_link</label>
						<select name="download_link">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e('No', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: link title (the default position).', 'jig_td'); ?></option>
								<option value="alt"><?php _e('Add to img alt.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('A link that displays a browser dialog to download the photo.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('What text to show inside the lightbox', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('WP field for link title *', 'jig_td'); ?></div>
						<label>link_title_field</label>
						<select name="link_title_field">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="description"><?php _e('Description', 'jig_td'); ?></option>
							<option value="title"><?php _e('Title', 'jig_td'); ?></option>
							<option value="caption"><?php _e('Caption', 'jig_td'); ?></option>
							<option value="alternate"><?php _e('Alternate', 'jig_td'); ?></option>
							<option value="off"><?php _e('Off: Do not use', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose a WP field as link title from the image details.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('WP field for img alt *', 'jig_td'); ?></div>
						<label>img_alt_field</label>
						<select name="img_alt_field">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="title"><?php _e('Title', 'jig_td'); ?></option>
								<option value="description"><?php _e('Description', 'jig_td'); ?></option>
								<option value="caption"><?php _e('Caption', 'jig_td'); ?></option>
								<option value="alternate"><?php _e('Alternate', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off: Do not use', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose a WP field as img alt from the image details.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="longHelp"><?php _e('* Note: NextGEN, Facebook, Flickr title/description (or equivalent) fields act in place of WP Title and Description fields.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('PrettyPhoto settings', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('prettyPhoto social tools', 'jig_td'); ?></div>
						<label>prettyphoto_social</label>
						<select name="prettyphoto_social">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: display the social sharing buttons.', 'jig_td'); ?></option>
								<option value="no"><?php _e('No', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Toggle Like, Tweet, Pin and +1 buttons in prettyPhoto.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('prettyPhoto theme', 'jig_td'); ?></div>
						<label>prettyphoto_theme</label>
						<select name="prettyphoto_theme">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="pp_default"><?php _e('Default theme', 'jig_td'); ?></option>
								<option value="light_rounded"><?php _e('Light rounded', 'jig_td'); ?></option>
								<option value="dark_rounded"><?php _e('Dark rounded', 'jig_td'); ?></option>
								<option value="light_square"><?php _e('Light square', 'jig_td'); ?></option>
								<option value="dark_square"><?php _e('Dark square', 'jig_td'); ?></option>
								<option value="facebook"><?php _e('Facebook style', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose one of the six built-in themes of prettyPhoto.', 'jig_td'); ?></div>
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('prettyPhoto Google Analytics', 'jig_td'); ?></div>
						<label>prettyphoto_analytics</label>
						<select name="prettyphoto_analytics">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes, track photo views as events.', 'jig_td'); ?></option>
								<option value="no"><?php _e('No', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('You can track images viewed in the lightbox as events.', 'jig_td'); ?></div>
					</div>				
				</div>
				<h3 class="jigTabTitle" id="jigCaptions"><?php _e('Captions', 'jig_td'); ?></h3>
				<div id="jig_captions_tab_content" class="jigSettingsTab jig_settings_group clearfix">
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Caption appearance and style', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Caption style', 'jig_td'); ?></div>
						<label>caption</label>
						<select name="caption">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="fade"><?php _e('Fade', 'jig_td'); ?></option>
								<option value="slide"><?php _e('Slide', 'jig_td'); ?></option>
								<option value="mixed"><?php _e('Mixed', 'jig_td'); ?></option>
								<option value="fixed"><?php _e('Fixed', 'jig_td'); ?></option>
								<option value="reverse-fade"><?php _e('Reverse Fade', 'jig_td'); ?></option>
								<option value="reverse-slide"><?php _e('Reverse Slide', 'jig_td'); ?></option>
								<option value="reverse-mixed"><?php _e('Reverse Mixed', 'jig_td'); ?></option>
								<option value="below"><?php _e('Below the image', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose how would you like the caption to appear. Reverse does the opposite, shows all text then fades/slides them out on mouse over.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Mobile caption', 'jig_td'); ?></div>
						<label>mobile_caption</label>
						<select name="mobile_caption">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="same"><?php _e('Same as desktop.', 'jig_td'); ?></option>							
								<option value="fixed"><?php _e('Fixed - Whole caption is always visible.', 'jig_td'); ?></option>
								<option value="below"><?php _e('Below the image', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Caption behavior for mobile devices.', 'jig_td'); ?></div>
					</div>					
					<div class="row">
						<div class="normalname"><?php _e('Caption opacity', 'jig_td'); ?></div>
						<label>caption_opacity</label>
						<input type="text" name="caption_opacity" value='' />
						<div class="minihelp"><?php _e('Opacity for the entire caption, enter a number between 0 and 1.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Caption background color', 'jig_td'); ?></div>
						<label>caption_bg_color</label>
						<input type="text" name="caption_bg_color" value='' />
						<div class="minihelp"><?php _e('Enter any CSS color, or the word transparent. You can use the color picker in the top right corner. For opacity use rgba(0,0,0,0.3) but only when the Caption opacity is set to 1.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e("Title bg matches text width", 'jig_td'); ?></div>
						<label>caption_match_width</label>
						<select name="caption_match_width">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e('No, display the caption background at full width.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes, only show the background as far as the text goes.', 'jig_td'); ?></option>
								<option value="yes-rounded"><?php _e('Yes, and also add some rounded corners (dossier style).', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Show the caption title background only behind the text.', 'jig_td'); ?></div>
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('Caption text color', 'jig_td'); ?></div>
						<label>caption_text_color</label>
						<input type="text" name="caption_text_color" value='' />
						<div class="minihelp"><?php _e('Any CSS color (HEX, name of the color) except rgba.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Caption height only for the "Below the image" style', 'jig_td'); ?></div>
						<label>caption_height</label>
						<input type="text" name="caption_height" value='' />
						<div class="minihelp"><?php _e('Set a uniform caption height that will only be used when caption is set to "Below the image". Accepts a number without px.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Caption title size', 'jig_td'); ?></div>
						<label>caption_title_size</label>
						<input type="text" name="caption_title_size" value='' />
						<div class="minihelp"><?php _e('Any CSS font-size, e.g. 16px, leave empty to use the global CSS.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Caption description size', 'jig_td'); ?></div>
						<label>caption_desc_size</label>
						<input type="text" name="caption_desc_size" value='' />
						<div class="minihelp"><?php _e('Any CSS font-size, e.g. 12px, leave empty to use the global CSS.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Align', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Horizontal caption text-align', 'jig_td'); ?></div>
						<label>caption_align</label>
						<select name="caption_align">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="css"><?php _e('CSS: Respect the text-align settings below (Caption title CSS + Caption description CSS).', 'jig_td'); ?></option>
								<option value="left"><?php _e('Left', 'jig_td'); ?></option>
								<option value="center"><?php _e('Center', 'jig_td'); ?></option>
								<option value="right"><?php _e('Right', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Align both captions horizontally.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Vertically center captions', 'jig_td'); ?></div>
						<label>v_center_captions</label>
						<select name="v_center_captions">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off: Display them at the bottom.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: (center both axes, animate from center, overrides text-align CSS).', 'jig_td'); ?></option>
								<option value="simple"><?php _e("Simple: Same as 'Yes', but doesn't animate from center (slide and mixed styles).", 'jig_td'); ?></option>
								<option value="vertical_only"><?php _e('Vertical only: (no horizontal centering, keeps text-align CSS, animate from center).', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Makes captions appear in the middle of the image.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Vertically center: Custom fonts', 'jig_td'); ?></div>
						<label>custom_fonts</label>
						<select name="custom_fonts">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes, I use custom fonts, apply a fix.', 'jig_td'); ?></option>
								<option value="no"><?php _e("No, I don't use custom fonts.", 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('If the vertical centering is not perfect, you are using custom fonts.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('What text to show on the top of thumbnails', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('WP field to use for title (main) *', 'jig_td'); ?></div>
						<label>title_field</label>
						<select name="title_field">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="title"><?php _e('Title', 'jig_td'); ?></option>
								<option value="description"><?php _e('Description', 'jig_td'); ?></option>
								<option value="caption"><?php _e('Caption', 'jig_td'); ?></option>
								<option value="alternate"><?php _e('Alternate', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off: Do not display.', 'jig_td'); ?></option>

						</select>
						<div class="minihelp"><?php _e('Choose a WP field as title from the image details.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('WP field to use for caption *', 'jig_td'); ?></div>
						<label>caption_field</label>
						<select name="caption_field">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="title"><?php _e('Title', 'jig_td'); ?></option>
								<option value="description"><?php _e('Description', 'jig_td'); ?></option>
								<option value="caption"><?php _e('Caption', 'jig_td'); ?></option>
								<option value="alternate"><?php _e('Alternate', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off: Do not display.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose a WP field as caption description from the image details.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="longHelp"><?php _e('* Note: NextGEN, Facebook, Instagram, Flickr title/description (or equivalent) fields act in place of WP Title and Description fields.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Extra', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Text shadow', 'jig_td'); ?></div>
						<label>caption_text_shadow</label>
						<input type="text" name="caption_text_shadow" value='' />
						<div class="minihelp"><?php _e("Set shadow on the text of the caption. Example: 1px 1px 0 black<br/>(x, y, blur, color - respectively). It's only applied when Caption opacity is set to 1. Doesn't work under IE10 so don't depend on it.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Gradient caption background', 'jig_td'); ?></div>
						<label>gradient_caption_bg</label>
						<select name="gradient_caption_bg">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e('No, use the simple color options.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes, use the CSS gradient (set up in the settings).', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Use a Facebook-style gradient for the caption background.', 'jig_td'); ?></div>
					</div>

				</div>
				<h3 class="jigTabTitle" id="jigOverlayEffects"><?php _e('Overlay effects', 'jig_td'); ?></h3>
				<div id="jig_overlay_tab_content" class="jigSettingsTab jig_settings_group clearfix">
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Overlay appearance and style', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overlay type', 'jig_td'); ?></div>
						<label>overlay</label>
						<select name="overlay">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="others"><?php _e('Others', 'jig_td'); ?></option>
								<option value="hovered"><?php _e('Hovered', 'jig_td'); ?></option>
								<option value="everything"><?php _e('Everything has color overlay', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose a behavior for the overlay.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Mobile overlay type', 'jig_td'); ?></div>
						<label>mobile_overlay</label>
						<select name="mobile_overlay">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="same"><?php _e('Same as desktop.', 'jig_td'); ?></option>
								<option value="everything"><?php _e('Everything has color overlay.', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off: No overlay.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Overlay behavior for mobile devices.', 'jig_td'); ?></div>
					</div>					
					<div class="row">
						<div class="normalname"><?php _e('Overlay opacity', 'jig_td'); ?></div>
						<label>overlay_opacity</label>
						<input type="text" name="overlay_opacity" value='' />
						<div class="minihelp"><?php _e('A number between 0 and 1.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overlay color', 'jig_td'); ?></div>
						<label>overlay_color</label>
						<input type="text" name="overlay_color" value='' />
						<div class="minihelp"><?php _e('Any CSS color (HEX, name of the color) except rgba.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Overlay icon on top of thumbnails', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overlay icon', 'jig_td'); ?></div>
						<label>overlay_icon</label>
						<select name="overlay_icon">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="off"><?php _e("Off: Don't display the icon in the overlay.", 'jig_td'); ?></option>
								<option value="on"><?php _e("On: Display the icon.", 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Enable to display an icon in the middle of the thumbnails.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overlay icon opacity', 'jig_td'); ?></div>
						<label>overlay_icon_opacity</label>
						<input type="text" name="overlay_icon_opacity" value='' />
						<div class="minihelp"><?php _e('A number between 0 and 1.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overlay icon URL', 'jig_td'); ?></div>
						<label>overlay_icon_url</label>
						<input type="text" name="overlay_icon_url" value='' />
						<div class="minihelp"><?php _e('Path to your icon or leave empty for the default magnifier icon.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overlay icon retina URL', 'jig_td'); ?></div>
						<label>overlay_icon_retina</label>
						<input type="text" name="overlay_icon_retina" value='' />
						<div class="minihelp"><?php _e('2x size image of your Overlay icon. Default is the 2x version of the magnifier, or if set, the 1x version of your Overlay icon.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Shadows', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Outer shadow', 'jig_td'); ?></div>
						<label>outer_shadow</label>
						<input type="text" name="outer_shadow" value='' />
						<div class="minihelp"><?php _e('CSS3 shadow value: "0 0 3px black" - may decrease performance.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Inner shadow', 'jig_td'); ?></div>
						<label>inner_shadow</label>
						<input type="text" name="inner_shadow" value='' />
						<div class="minihelp"><?php _e('CSS3 shadow value: "0 0 30px black" - only when overlay is in use.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Borders', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Outer (standard) border width', 'jig_td'); ?></div>
						<label>outer_border_width</label>
						<input type="text" name="outer_border_width" value='' />
						<div class="minihelp"><?php _e('A number in pixels, without "px" - 0 to turn off, empty for default.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Outer (standard) border color', 'jig_td'); ?></div>
						<label>outer_border_color</label>
						<input type="text" name="outer_border_color" value='' />
						<div class="minihelp"><?php _e('Any CSS color value.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Middle (spacing) border width', 'jig_td'); ?></div>
						<label>middle_border_width</label>
						<input type="text" name="middle_border_width" value='' />
						<div class="minihelp"><?php _e('A number in pixels, without "px" - 0 to turn off, empty for default.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Middle (spacing) border color', 'jig_td'); ?></div>
						<label>middle_border_color</label>
						<input type="text" name="middle_border_color" value='' />
						<div class="minihelp"><?php _e('Any CSS color, usually white, also affects tile background color.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Inner (on-image) border width', 'jig_td'); ?></div>
						<label>inner_border_width</label>
						<input type="text" name="inner_border_width" value='' />
						<div class="minihelp"><?php _e('A number in pixels, without "px" - 0 to turn off, empty for default.', 'jig_td'); ?></div>
					</div>				
					<div class="row">
						<div class="normalname"><?php _e('Inner (on-image) border color', 'jig_td'); ?></div>
						<label>inner_border_color</label>
						<input type="text" name="inner_border_color" value='' />
						<div class="minihelp"><?php _e('Any CSS color, especially recommended rgba(0,0,0,0.1) this is Facebook-style.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Inner border behavior', 'jig_td'); ?></div>
						<label>inner_border</label>
						<select name="inner_border">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="always"><?php _e('Always', 'jig_td'); ?></option>
								<option value="others"><?php _e('Others', 'jig_td'); ?></option>
								<option value="hovered"><?php _e('Hovered', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Control the inner border with the mouse or let it be static.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Inner border animate', 'jig_td'); ?></div>
						<label>inner_border_animate</label>
						<select name="inner_border_animate">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="width"><?php _e('Width only', 'jig_td'); ?></option>
								<option value="opacity"><?php _e('Opacity only', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("The mouse controlled inner border's animation style.", 'jig_td'); ?></div>
					</div>			
				</div>
				<h3 class="jigTabTitle" id="jigSpecialEffects"><?php _e('Special effects', 'jig_td'); ?></h3>
				<div id="jig_specialfx_tab_content" class="jigSettingsTab jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Special effects behavior', 'jig_td'); ?></div>
						<label>specialfx</label>
						<select name="specialfx">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
								<option value="others"><?php _e('Others', 'jig_td'); ?></option>
								<option value="hovered"><?php _e('Hovered', 'jig_td'); ?></option>
								<option value="everything"><?php _e('Everything', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose a behavior for the special effects like desaturation.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Mobile special effects', 'jig_td'); ?></div>
						<label>mobile_specialfx</label>
						<select name="mobile_specialfx">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="same"><?php _e('Same as desktop', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
								<option value="everything"><?php _e('Everything', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Alternative behavior for special effects on mobile devices. Turn off if you have lots of images as it may decrease performance.', 'jig_td'); ?></div>
					</div>					
					<div class="row">
						<div class="normalname"><?php _e('Special effects type', 'jig_td'); ?></div>
						<label>specialfx_type</label>
						<select name="specialfx_type">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="desaturate"><?php _e('Desaturate', 'jig_td'); ?></option>
								<option value="blur"><?php _e('Blur', 'jig_td'); ?></option>
								<option value="glow"><?php _e('Glow', 'jig_td'); ?></option>
								<option value="sepia"><?php _e('Sepia', 'jig_td'); ?></option>
								<option value="laplace_dark"><?php _e('Laplace dark (edge detection).', 'jig_td'); ?></option>
								<option value="laplace_light"><?php _e('Laplace light (edge detection).', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose a special effect to apply.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Special effects blend', 'jig_td'); ?></div>
						<label>specialfx_blend</label>
						<input type="text" name="specialfx_blend" value='' />
						<div class="minihelp"><?php _e('Enter a value between 0.1 and 1 to control how much you see the special effect over the original image.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Special effects options', 'jig_td'); ?></div>
						<label>specialfx_options</label>
						<input type="text" name="specialfx_options" value='' />
						<div class="minihelp"><?php echo sprintf(__('Advanced setting, refer to JIG documentation and the %1$s docs. Example (default for glow): amount:0.3,radius:0.2', 'jig_td'),'<a href="http://www.pixastic.com/lib/docs/" target="_blank">Pixastic</a>'); ?></div>
					</div>
				</div>

				<h3 class="jigTabTitle" id="jigNextGEN"><?php _e('NextGEN', 'jig_td'); ?></h3>
				<div id="jig_nextgen_tab_content" class="jigSettingsTab jig_settings_group_nextgen clearfix" id="nextgen">
					<?php
					global $wpdb;

					if(isset($wpdb->nggallery) !== false){		
						$galleries = $wpdb->get_results("SELECT gid,title FROM $wpdb->nggallery LIMIT 0,1000");
						$albums = $wpdb->get_results("SELECT id,name FROM $wpdb->nggalbum LIMIT 0,1000");
					?>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('What images to show from NextGEN gallery (choose one)', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Gallery ID', 'jig_td'); ?></div>
						<label>ng_gallery</label>
						<select name="ng_gallery" class="long_select abilityToMorph">
							<?php
						if(!empty($galleries)){
							echo '<option class="noCheckboxForThis" value="">'.__('I want to use multiple (switch to checkboxes)', 'jig_td').'</option>';
							echo '<option value="default" selected="selected" class="noCheckboxForThis">'.__('Do not use.', 'jig_td').'</option>';
							foreach($galleries as $val){
								echo '<option value="'.$val->gid.'">'.stripcslashes($val->gid.' - '.$val->title).'</option>';
							}
						}else{
							echo '<option value="default" selected="selected">'.__('No galleries.', 'jig_td').'</option>';
						}
						?>
						</select>
						<div class="minihelp minihelpShort"><?php _e('Choose a NextGEN gallery.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Album ID', 'jig_td'); ?></div>
						<label>ng_album</label>
						<select name="ng_album" class="long_select abilityToMorph">								
							<?php
						if(!empty($albums)){
							echo '<option class="noCheckboxForThis" value="">'.__('I want to use multiple (switch to checkboxes)', 'jig_td').'</option>';
							echo '<option value="default" selected="selected" class="noCheckboxForThis">'.__('Do not use.', 'jig_td').'</option>';
							if(!empty($galleries)){
								echo '<option class="noCheckboxForThis" value="all" >'.__('Overview album (all galleries).', 'jig_td').'</option>';
							}
							foreach($albums as $val){
								echo '<option value="'.$val->id.'">'.stripcslashes($val->id.' - '.$val->name).'</option>';
							}
						}else{
							echo '<option value="default" selected="selected">'.__('No albums.', 'jig_td').'</option>';
							if(!empty($galleries)){
								echo '<option value="all" >'.__('Overview album (all galleries).', 'jig_td').'</option>';
							}

						}

						?>
						</select>
						<div class="minihelp minihelpShort"><?php _e('OR choose a NextGEN album.', 'jig_td'); ?></div>
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('Single picture(s) by ID', 'jig_td'); ?></div>
						<label>ng_pics</label>
						<input type="text" name="ng_pics" value='' />
						<div class="minihelp"><?php _e("OR image IDs, comma separated if more than one.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Tags gallery', 'jig_td'); ?></div>
						<label>ng_tags_gallery</label>
						<input type="text" name="ng_tags_gallery" value='' />
						<div class="minihelp"><?php _e("OR tag(s), comma separated, to be displayed as a gallery.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Tags album', 'jig_td'); ?></div>
						<label>ng_tags_album</label>
						<input type="text" name="ng_tags_album" value='' />
						<div class="minihelp"><?php _e("OR tag(s), comma separated, to be displayed as an album.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Use recent images', 'jig_td'); ?></div>
						<label>ng_recent_images</label>
						<select name="ng_recent_images">
								<option value="default" selected="selected"><?php _e('Do not use.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: by upload date (NG 1.9.x style).', 'jig_td'); ?></option>
								<option value="yes_exif"><?php _e('Yes: by image/exif date (NG 2 style).', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('OR show the 25 most recent images regardless of gallery. You can modify the limit in the general settings.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Use random images', 'jig_td'); ?></div>
						<label>ng_random_images</label>
						<select name="ng_random_images" class="abilityToMorph">
								<option value="default" selected="selected" class="noCheckboxForThis"><?php _e('Do not use.', 'jig_td'); ?></option>
								<option value="yes" class="noCheckboxForThis"><?php _e('Yes: all random images.', 'jig_td'); ?></option>					
								<?php
								if(!empty($galleries)){
									echo '<option class="noCheckboxForThis" value="">'.__('I want to use multiple (switch to checkboxes)', 'jig_td').'</option>';
									foreach($galleries as $val){
										echo '<option value="'.$val->gid.'">'.stripcslashes($val->gid.' - '.$val->title).'</option>';
									}
								}
								?>
						</select>
						<div class="minihelp"><?php _e("Show random images regardless of gallery or from a specific one. Don't forget to limit, which is applied <b>after</b> the randomization. The default limit is 25, which you can modify in the general settings.", 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Behavior options', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Display album and photo count', 'jig_td'); ?></div>
						<label>ng_count</label>
						<select name="ng_count">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="yes"><?php _e("Yes: display the counters.", 'jig_td'); ?></option>
								<option value="no"><?php _e("No: do not display the counters.", 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("Make the thumbnail's caption display the count of photos in a gallery. Also, the count of subalbums/galleries in albums.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Open galleries in lightbox', 'jig_td'); ?></div>
						<label>ng_lightbox_gallery</label>
						<select name="ng_lightbox_gallery">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e("No: open them on their own page.", 'jig_td'); ?></option>
								<option value="yes"><?php _e("Yes: Open them in the lightbox.", 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('In album views, open the galleries in the lightbox on the same page.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Show album/gallery description', 'jig_td'); ?></div>
						<label>ng_description</label>
						<select name="ng_description">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e("No", 'jig_td'); ?></option>
								<option value="yes"><?php _e("Yes", 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Display gallery or album description (if any) between the breadcrumb and the grid.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Intersect tags', 'jig_td'); ?></div>
						<label>ng_intersect_tags</label>
						<select name="ng_intersect_tags">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e("No, match ANY of the chosen tags", 'jig_td'); ?></option>
								<option value="yes"><?php _e("Yes, match ALL of the chosen tags", 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Tag match mode for NG tag galleries.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Settings for the built-in JIG Breadcrumb for NextGEN', 'jig_td'); ?></div>
					</div>
					<div class="row" id="ngBcRow">
						<div class="longHelp"><?php _e('Breadcrumb example: <span class="ngBcHelp">base:</span> You are here: <span class="ngBcHelp">home:</span> Overview <span class="ngBcHelp">separator:</span> &raquo; <span class="ngBcHelp">album:</span> Colors <span class="ngBcHelp">separator:</span> &raquo; <span class="ngBcHelp">gallery, last element:</span> Orange <span class="ngBcHelp">additional separator:</span> &raquo; ', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Breadcrumb', 'jig_td'); ?></div>
						<label>ng_breadcrumb</label>
						<select name="ng_breadcrumb">
								<option value="default" selected="selected"><?php _e('Do not use.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: use the breadcrumb.', 'jig_td'); ?></option>

						</select>
						<div class="minihelp"><?php _e('Show a path to the current gallery. Set up with the settings below.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Separator character', 'jig_td'); ?></div>
						<label>ng_bc_separator</label>
						<select name="ng_bc_separator">
								<option value="default" selected="selected">&raquo;</option>
								<option value="greater">&gt;</option>
								<option value="comma">,</option>
								<option value="slash">/</option>
								<option value="doubleslash">//</option>
								<option value="miuns">-</option>
								<option value="plus">+</option>
								<option value="arrow">&rarr;</option>
								<option value="bslash">\</option>
								<option value="doublebslash">\\</option>
								<option value="middledot">·</option>
								<option value="dobulecolon">::</option>
								<option value="numbersign">#</option>
						</select>
						<div class="minihelp"><?php _e('This is the character that separates path elements.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Base element: custom text', 'jig_td'); ?></div>
						<label>ng_bc_base</label>
						<input type="text" name="ng_bc_base" value='' />
						<div class="minihelp"><?php _e("This is the first, non-clickable text of the breadcrumb, default is 'You are here:', to turn off, enter the word: none.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Home element', 'jig_td'); ?></div>
						<label>ng_bc_home</label>
						<select name="ng_bc_home">
								<option value="default" selected="selected"><?php _e('Post title.', 'jig_td'); ?></option>
								<option value="custom_text"><?php _e('Custom text.', 'jig_td'); ?></option>
								<option value="album_name"><?php _e('Album name (automatic).', 'jig_td'); ?></option>
								<option value="none"><?php _e('Do not use.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('This is the second, optionally-clickable text that is the gallery home.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Home element: custom text', 'jig_td'); ?></div>
						<label>ng_bc_home_text</label>
						<input type="text" name="ng_bc_home_text" value='' />
						<div class="minihelp"><?php _e("This is for the 'Custom text' from above, default is Home.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Home element: clickable', 'jig_td'); ?></div>
						<label>ng_bc_home_clickable</label>
						<select name="ng_bc_home_clickable">
								<option value="default" selected="selected"><?php _e('Clickable', 'jig_td'); ?></option>
								<option value="no"><?php _e('Not clickable.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("When clickable, the home element links back to the original page.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Last element: clickable', 'jig_td'); ?></div>
						<label>ng_bc_last_clickable</label>
						<select name="ng_bc_last_clickable">
								<option value="default" selected="selected"><?php _e('Not clickable.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Clickable', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("The last (current) element in the breadcrumb can be a link.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Show top level breadcrumb', 'jig_td'); ?></div>
						<label>ng_bc_top_level</label>
						<select name="ng_bc_top_level">
								<option value="default" selected="selected"><?php _e('Yes', 'jig_td'); ?></option>
								<option value="no"><?php _e('No', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("Show breadcrumb on the top level page: When only the base and home elements are visible. This is when no albums or galleries are in the breadcrumb path. The breacrumb may be unncessary then.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Add separator at the end', 'jig_td'); ?></div>
						<label>ng_bc_add_separator</label>
						<select name="ng_bc_add_separator">
								<option value="default" selected="selected"><?php _e('No', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("Show an additional separator at the very end of the breadcrumb.", 'jig_td'); ?></div>
					</div>
					<?php }else{ ?>
					<div class="row">
						<div class="normalname"><?php _e('NextGEN is not installed!', 'jig_td'); ?></div>
					</div>
					<?php }; ?>
				</div>
				
				<h3 class="jigTabTitle" id="jigRecentPosts"><?php _e('Recent posts', 'jig_td'); ?></h3>
				<div id="jig_recent_posts_tab_content" class="jigSettingsTab jig_settings_group_recents clearfix">
					<div class="flexirow">
						<div id="recentsHelp"><?php _e("Create a gallery of posts by their featured images. They'll automatically link to the posts. You are not limited to posts, nor the order or the number of pictures is written in stone. The automatic excerpt helps you when you do not have a manual one so you can have both: manual excerpt when set, automatic otherwise. You can create a homepage banner with this feature.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Use recent posts', 'jig_td'); ?></div>
						<label>recent_posts</label>
						<select name="recent_posts">
								<option value="default" selected="selected"><?php _e('Do not use.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: use recent posts.', 'jig_td'); ?></option>

						</select>
						<div class="minihelp"><?php _e('Choose yes if you wish to create a grid of recent posts.', 'jig_td'); ?></div>
					</div>
					
					<div class="row">
						<div class="normalname"><?php _e('Post IDs', 'jig_td'); ?></div>
						<label>post_ids</label>
						<input type="text" name="post_ids" value='' />
						<div class="minihelp"><?php _e('Optionally, you can manually specify posts by IDs, comma separated. You need to select the appropriate post type as well.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Post type', 'jig_td'); ?></div>
						<label>recents_post_type</label>
						<select name="recents_post_type" class="abilityToMorph">
							<option class="noCheckboxForThis" value=""><?php _e('I want to use multiple (switch to checkboxes)', 'jig_td'); ?></option>
							<?php
							global $wp_post_types;
							if(isset($wp_post_types)){
								foreach ($wp_post_types as $post_type => $post_type_value) {
									if($post_type !== 'attachment' && $post_type !== 'revision' && $post_type !== 'nav_menu_item'){
										if($post_type !== 'post'){
											echo '<option value="'. $post_type. '">'.$post_type_value->labels->name.' ('.$post_type.')</option>';
										}else{
											echo '<option selected="selected" class="selectedByDefault" value="post">Post (post)</option>';
										}
									}
								}
							}else{
								echo '<option selected="selected" value="post">post</option><option value="page">page</option>';
							}
							?>				
						</select>
						<div class="minihelp"><?php _e("The custom post types/pages must still have featured images!", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Display in the description', 'jig_td'); ?></div>
						<label>recents_description</label>
						<select name="recents_description">
								<option value="default" selected="selected"><?php _e('Nothing.', 'jig_td'); ?></option>
								<option value="auto_excerpt"><?php _e('Auto excerpt only.', 'jig_td'); ?></option>
								<option value="manual_excerpt"><?php _e('Manual excerpt only.', 'jig_td'); ?></option>
								<option value="auto_manual_excerpt"><?php _e('Auto or manual excerpt.', 'jig_td'); ?></option>
								<option value="categories"><?php _e('Categorie(s), comma separated.', 'jig_td'); ?></option>
								<option value="tags"><?php _e('Tag(s), comma separated.', 'jig_td'); ?></option>
								<option value="datetime"><?php _e('Date and time.', 'jig_td'); ?></option>
								<option value="date"><?php _e('Date only.', 'jig_td'); ?></option>
								<option value="nicetime"><?php _e("Nice time (FB style 'ago').", 'jig_td'); ?></option>
								<option value="author"><?php _e('Author name.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Choose what to display on the thumbnails under the post title.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Word count for auto excerpt', 'jig_td'); ?></div>
						<label>excerpt_length</label>
						<input type="text" name="excerpt_length" value='' />
						<div class="minihelp"><?php _e('Limit the length of automatic excerpt, defaults to 20 words.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Ending for auto excerpt', 'jig_td'); ?></div>
						<label>excerpt_ending</label>
						<input type="text" name="excerpt_ending" value='' />
						<div class="minihelp"><?php _e('Add this to the end of the auto excerpt like - Read more...<br />Converts ( ) to [ ], defaults to [...], enter <strong>none</strong> to have no ending.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Prefix for author name', 'jig_td'); ?></div>
						<label>author_prefix</label>
						<input type="text" name="author_prefix" value='' />
						<div class="minihelp"><?php _e('This is before the name, e.g. "written by ", defaults to "by ". Only if author name is selected above. Enter <strong>none</strong> to have no ending.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Exclude posts by ID', 'jig_td'); ?></div>
						<label>post_ids_exclude</label>
						<input type="text" name="post_ids_exclude" value='' />
						<div class="minihelp"><?php _e("Don't show these posts (specify IDs, comma separated). Use the word 'current' to automatically exclude the current post (for example, related posts). Not compatible with the post_ids setting.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Exclude category', 'jig_td'); ?></div>
						<label>recents_exclude</label>
						<input type="text" name="recents_exclude" value='' />
						<div class="minihelp"><?php _e('Show posts from all WP categories except these OR...', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Include category', 'jig_td'); ?></div>
						<label>recents_include</label>
						<input type="text" name="recents_include" value='' />
						<div class="minihelp"><?php _e("Only show posts from these categories. Both exclude and include take comma separated list of category slugs or IDs. This is the built-in WP Category taxonomy, may not be applicable for custom post types.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Filter by tag', 'jig_td'); ?></div>
						<label>recents_tags</label>
						<input type="text" name="recents_tags" value='' />
						<div class="minihelp"><?php _e('Enter comma separated WP tag slugs to filter by. This can be combined with the categories above.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Filter by taxonomy', 'jig_td'); ?></div>
						<label>recents_filter_tax</label>
						<select name="recents_filter_tax">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<?php
								echo $taxonomies_as_options;
							?>
						</select>
						<div class="minihelp"><?php _e('Choose a taxonomy to filter recent posts by.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Taxonomy filter term', 'jig_td'); ?></div>
						<label>recents_filter_term</label>
						<input type="text" name="recents_filter_term" value='' />
						<div class="minihelp"><?php _e('Enter the term(s) for your taxonomy (comma separated slugs).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Placeholder image', 'jig_td'); ?></div>
						<label>recents_placeholder</label>
						<input type="text" name="recents_placeholder" value='' />
						<div class="minihelp"><?php _e('To still show posts without a featured image, specify the full URL of a desired placeholder image (upload to the media library).', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Click on a thumbnail links to', 'jig_td'); ?></div>
						<label>recents_link_to</label>
						<select name="recents_link_to">
							<option selected="selected" value="post"><?php _e('The post.', 'jig_td'); ?></option>
							<option value="image"><?php _e('The image (opens in the lightbox).', 'jig_td'); ?></option>					
							<option value="attachment"><?php _e('The WP attachment page of the image.', 'jig_td'); ?></option>					
						</select>
						<div class="minihelp"><?php _e('Link to the posts like a regular slider or you can create a gallery of their featured images, opening them in the lightbox.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Link to the post from lightbox', 'jig_td'); ?></div>
						<label>recents_link</label>
						<select name="recents_link">
							<option selected="selected" value="no"><?php _e('No, just a gallery of post images.', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes: link title (the default position).', 'jig_td'); ?></option>
							<option value="alt"><?php _e('Add to img alt.', 'jig_td'); ?></option>			
						</select>
						<div class="minihelp"><?php _e('Provides a way of still going to the permalink, only used when Click on a thumbnail links to an image.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Lightbox link text', 'jig_td'); ?></div>
						<label>recents_link_text</label>
						<input type="text" name="recents_link_text" value='' />
						<div class="minihelp"><?php _e("The text for the permalink in the lightbox, e.g. Read more, Go to post.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Use custom links', 'jig_td'); ?></div>
						<label>recents_custom_links</label>
						<select name="recents_custom_links">
							<option selected="selected" value="no"><?php _e('No', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes', 'jig_td'); ?></option>					
						</select>
						<div class="minihelp"><?php _e('Use the JIG Link of featured images, can override recents_link_to.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Use sticky posts', 'jig_td'); ?></div>
						<label>recents_sticky</label>
						<select name="recents_sticky">
							<option selected="selected" value="default"><?php _e('No preference', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes: Only sticky posts', 'jig_td'); ?></option>					
							<option value="no"><?php _e('No: Do not display sticky posts at all', 'jig_td'); ?></option>					
						</select>
						<div class="minihelp"><?php _e('Only usable when displaying regular WP posts. Narrow thumbnails to the sticky posts or exclude them.', 'jig_td'); ?></div>
					</div>					
					<div class="row">
						<div class="normalname"><?php _e('Parent post ID', 'jig_td'); ?></div>
						<label>recents_parent_id</label>
						<input type="text" name="recents_parent_id" value='' />
						<div class="minihelp"><?php _e("Use if you wish to display children of a page, only when using pages.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Tree depth', 'jig_td'); ?></div>
						<label>recents_tree_depth</label>
						<input type="text" name="recents_tree_depth" value='' />
						<div class="minihelp"><?php _e("When displaying children of a page, you can set the level of descendants. It's like 1 or 3 levels deep, default is 10 levels which is a practical limit. Enter a number.", 'jig_td'); ?></div>
					</div>
				</div>
				<h3 class="jigTabTitle" id="jigFacebook"><?php _e('Facebook', 'jig_td'); ?></h3>
				<div class="jigSettingsTab jig_settings_group_facebook clearfix" id="facebook">
					<div class="flexirow">
						<div id="fbHelp"><?php _e("If you don't have any Profiles or Pages below, go to the settings and authorize/add some. Once added, you can select one and view the album list. You'll need to choose an album or the overview to display. Don't edit the Facebook IDs (<span class=\"fbBlue\">facebook_id</span> and <span class=\"fbBlue\">facebook_album</span>) manually. You can set the order on Facebook, or use the random order in JIG. You might want to limit how many images to load (e.g. for Wall Photos), using the <span class=\"fbBlue\">limit</span> in the general settings above. The default limit is 25 when nothing is set.", 'jig_td'); ?></div>	
					</div>
					<div id="fbRow" class="flexirow">
						<div id="fbLoadingAJAX">
							<div id="fbLoadingInner">
								<?php _e('loading albums from Facebook', 'jig_td'); ?><br />
								<span id="fbLoadingInnerSmallText"><?php _e('please be patient, this can take a while', 'jig_td'); ?></span>
								<div id="fbIcon"></div>
							</div>
						</div>
						<div id="fbSources" class="clearfix">
							<div class="updateButton fbSourceBtn fbSelected" id="fbOffBtn"><?php _e('Do not use Facebook', 'jig_td'); ?></div>
							<?php 
								if(isset($this->settings['fb_authed']) && $this->settings['fb_authed'] != ""){
									foreach($this->settings['fb_authed'] as $key => $val){
										echo '<div class="updateButton fbSourceBtn" data-access-token="'.$val['access_token'].'" id="'.$val['user_id'].'">'.(isset($val['picture']) ? '<img src="'.$val['picture'].'" />' : '').$val['user_name'].'</div>';
									}
								}
							?>
						</div>
						<div id="fbAlbums" class="clearfix"></div>
						<input type="hidden" name="facebook_id" value='' />
						<input type="hidden" name="facebook_album" value='' />
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('Facebook caching time', 'jig_td'); ?></div>
						<label>facebook_caching</label>
						<input type="text" name="facebook_caching" value='' />
						<div class="minihelp"><?php  _e('The time it takes to see the Facebook album change on the site. This greatly speeds up loading as the photo list for each album is cached, saving a request to Facebook! Set in minutes: 4 hours is 240, a day is 1440, a week is 10080.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Image size in the lightbox', 'jig_td'); ?></div>
						<label>facebook_image_size</label>
						<select name="facebook_image_size">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="normal"><?php _e('Normal (720px wide)', 'jig_td'); ?></option>
								<option value="larger"><?php _e('Larger (most useful)', 'jig_td'); ?></option>
								<option value="maximum"><?php _e('Maximum (up to 4MP - 2048px)', 'jig_td'); ?></option>

						</select>
						<div class="minihelp"><?php _e('Select a preferred image size that opens in the lightbox.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Open albums in lightbox', 'jig_td'); ?></div>
						<label>fb_lightbox_album</label>
						<select name="fb_lightbox_album">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e('No: Open them on their own page.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: Open them in the lightbox.', 'jig_td'); ?></option>

						</select>
						<div class="minihelp"><?php _e('Only when using the overview feature! Open Facebook albums in the lightbox (on the same page, instead of linking to separate pages). Note: currently not compatible with Social Gallery lightbox.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overview mini-breadcrumb', 'jig_td'); ?></div>
						<label>fb_breadcrumb</label>
						<select name="fb_breadcrumb">
								<option value="default" selected="selected"><?php _e('Yes: use the breadcrumb.', 'jig_td'); ?></option>
								<option value="no"><?php _e('Do not use', 'jig_td'); ?></option>

						</select>
						<div class="minihelp"><?php _e('Show title of current Facebook album and a link back to the overview. This is only used when the overview is selected and the albums are not set to open in the lightbox.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Breadcrumb home text', 'jig_td'); ?></div>
						<label>fb_bc_home_text</label>
						<input type="text" name="fb_bc_home_text" value='' />
						<div class="minihelp"><?php  _e('You can override the home element page/profile name with custom text. ', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Breadcrumb separator character', 'jig_td'); ?></div>
						<label>fb_bc_separator</label>
						<select name="fb_bc_separator">
								<option value="default" selected="selected">&raquo;</option>
								<option value="greater">&gt;</option>
								<option value="comma">,</option>
								<option value="slash">/</option>
								<option value="doubleslash">//</option>
								<option value="miuns">-</option>
								<option value="plus">+</option>
								<option value="arrow">&rarr;</option>
								<option value="bslash">\</option>
								<option value="doublebslash">\\</option>
								<option value="middledot">·</option>
								<option value="dobulecolon">::</option>
								<option value="numbersign">#</option>
						</select>
						<div class="minihelp"><?php _e('This is the character that separates path elements in the Facebook breadcrumb (previous setting).', 'jig_td'); ?></div>
					</div>
				</div>
				<h3 class="jigTabTitle" id="jigFlickr"><?php _e('Flickr', 'jig_td'); ?></h3>
				<div class="jigSettingsTab jig_settings_group_flickr clearfix" id="flickr">
					<div class="flexirow">
						<div id="fliHelp"><?php _e("If you don't have any users below, go to the settings and add some. Once added, you can select one then a content source: Photostream, Favorites, Groups, Photosets, and Galleries. They may open a third set of options where you need to select exactly which Group, Photoset, or Gallery you wish to use. Don't to edit the Flickr attributes manually in the shortcode. You can set the order on Flickr, or use the random order in JIG. Titles/captions for photos from Flickr are recognized as Title and Description fields. You might want to limit how many images to load (e.g. for Photostreams), using the <span class=\"fbBlue\">limit</span> in the general settings above. The default limit is 25 when nothing is set.", 'jig_td'); ?></div>	
					</div>
					<div id="fliRow" class="flexirow">
						<div id="fliLoadingAJAX">
							<div id="fliLoadingInner">
								<?php _e('loading user data from Flickr', 'jig_td'); ?><br />
								<span id="fliLoadingInnerSmallText"><?php _e('please be patient, this can take a while', 'jig_td'); ?></span>
								<div id="fliIcon"></div>
							</div>
						</div>
						<div id="fliSources" class="clearfix">
							<div class="updateButton fliSourceBtn fliSelected" id="fliOffBtn"><?php _e('Do not use Flickr', 'jig_td'); ?></div>
							<?php 
								if(isset($this->settings['fli_added']) && $this->settings['fli_added'] != ""){
									foreach($this->settings['fli_added'] as $key => $val){
										echo '<div class="updateButton fliSourceBtn" id="'.$val['user_id'].'">'.(isset($val['icon']) ? '<img src="'.$val['icon'].'" />' : '').$val['user_name'].'</div>';
									}
								}
							?>
						</div>
						<div id="fliTypes" class="clearfix"></div>
						<div id="fliElements" class="clearfix"></div>
						<input type="hidden" name="flickr_photostream" value='' />
						<input type="hidden" name="flickr_favorites" value='' />
						<input type="hidden" name="flickr_user" value='' />
						<input type="hidden" name="flickr_group" value='' />
						<input type="hidden" name="flickr_photoset" value='' />
						<input type="hidden" name="flickr_gallery" value='' />
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('Flickr caching time', 'jig_td'); ?></div>
						<label>flickr_caching</label>
						<input type="text" name="flickr_caching" value='' />
						<div class="minihelp"><?php  _e('The time it takes to see the Flickr content change on the site. This greatly speeds up loading as the photo list for each content is cached, saving a request to Flickr each time the album is shown! Set in minutes: 4 hours is 240, a day is 1440, a week is 10080.', 'jig_td'); ?></div>
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('Link to the photo on Flickr', 'jig_td'); ?></div>
						<label>flickr_link</label>
						<select name="flickr_link">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e('No', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: link title (default position).', 'jig_td'); ?></option>
								<option value="alt"><?php _e('Add to img alt.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Display a link back to the photo on Flickr in the lightbox.<br/>Highly recommended!', 'jig_td'); ?></div>
					</div>	
				</div>
				<h3 class="jigTabTitle" id="jigInstagram"><?php _e('Instagram', 'jig_td'); ?></h3>
				<div class="jigSettingsTab jig_settings_group_instagram clearfix" id="instagram">
					<div class="flexirow">
						<div id="igHelp"><?php _e("If you don't have any Users below, please go to the settings and add yourself. Once added, you can select various content sources from Instagram. You'll have access the Your feed, Your recent photos, Photos you like, Someone else's recent photos, Photos by a tag and last but not least photos that are from a specific Location! Please don't edit the Instagram attributes manually in the shortcode. You might want to limit how many images to load, using the <span class=\"fbBlue\">limit</span> in the general settings above. The default limit is about 20 when nothing is set.", 'jig_td'); ?></div>	
					</div>
					<div id="igRow" class="flexirow">
						<div id="igLoadingAJAX">
							<div id="igLoadingInner">
								<?php _e('loading data from Instagram', 'jig_td'); ?><br />
								<span id="igLoadingInnerSmallText"><?php _e('please wait, this can take a little time', 'jig_td'); ?></span>
								<div id="igIcon"></div>
							</div>
						</div>
						<div id="igSources" class="clearfix">
							<div class="updateButton igSourceBtn igSelected" id="igOffBtn"><?php _e('Do not use Instagram', 'jig_td'); ?></div>
							<?php 
								if(isset($this->settings['ig_authed']) && $this->settings['ig_authed'] != ""){
									foreach($this->settings['ig_authed'] as $key => $val){
										echo '<div class="updateButton igSourceBtn igFeedBtn" data-instagram-user-id="'.$val['id'].'">'.(isset($val['picture']) ? '<img src="'.$val['picture'].'" />' : '').__('Feed of', 'jig_td').' '.$val['full_name'].' ('.$val['user_name'].')</div>';
									}
									foreach($this->settings['ig_authed'] as $key => $val){
										echo '<div class="updateButton igSourceBtn igRecentsBtn" data-instagram-user-id="'.$val['id'].'">'.(isset($val['picture']) ? '<img src="'.$val['picture'].'" />' : '').__('Recent pictures of', 'jig_td').' '.$val['full_name'].' ('.$val['user_name'].')</div>';
									}
									foreach($this->settings['ig_authed'] as $key => $val){
										echo '<div class="updateButton igSourceBtn igLikedBtn" data-instagram-user-id="'.$val['id'].'">'.(isset($val['picture']) ? '<img src="'.$val['picture'].'" />' : '').__('Liked by', 'jig_td').' '.$val['full_name'].' ('.$val['user_name'].')</div>';
									}
									echo '<div class="updateButton igSourceBtn igAnyRecentsBtn">'.__('Recent pictures of any user (+)', 'jig_td').' </div>';

									echo '<div class="updateButton igSourceBtn igByTagBtn">'.__('By tag (+)', 'jig_td').' </div>';
									echo '<div class="updateButton igSourceBtn igByLocationBtn" data-instagram-type="location">'.__('By location (+)', 'jig_td').' </div>';
								}
							?>
						</div>
					</div>
					<div class="flexirow igPanelsRow">
						<div id="igRecentsPanel" class="clearfix">
							<div class="flexirow">
								<div class="normalname"><?php _e('Search for Instagram users', 'jig_td'); ?></div>
								<label>name</label>
								<input id="instagramUserSeach" type="text" name="instagram_user_search" value='' />
								<div class="minihelpNarrow"><div class="updateButton igSmallBtn" id="igSearchUsers"><?php _e('Search user', 'jig_td'); ?></div></div>
							</div>
							<div class="flexirow">
								<div id="igNameContainer"></div>
							</div>
							<div class="row">
								<div class="normalname"><?php _e("User ID", 'jig_td'); ?></div>
								<label>instagram_recents</label>
								<input type="text" id="igSelectedUser" name="instagram_recents_helper" value='' disabled readonly />
								<div class="minihelpNarrow"><?php _e('This is the user ID of your selected user.', 'jig_td'); ?></div>
							</div>
						</div>
						<div id="igTagPanel" class="clearfix">
							<div class="flexirow">
								<div class="normalname"><?php _e('Search for Instagram tags', 'jig_td'); ?></div>
								<label>tag</label>
								<input id="instagramTagSeach" type="text" name="instagram_tag_search" value='' />
								<div class="minihelpNarrow"><div class="updateButton igSmallBtn" id="igSearchTags"><?php _e('Search tag', 'jig_td'); ?></div></div>
							</div>
							<div class="flexirow">
								<div id="igTagContainer"></div>
							</div>
							<div class="row">
								<div class="normalname"><?php _e("Tag slug", 'jig_td'); ?></div>
								<label>instagram_tag</label>
								<input type="text" id="igSelectedTag" name="instagram_tag" value='' disabled readonly />
								<div class="minihelpNarrow"><?php _e('This is your selected tag.', 'jig_td'); ?></div>
							</div>
						</div>
						<div id="igLocationPanel" class="clearfix">
							<div class="flexirow">
								<div class="longHelp"><?php echo sprintf(__("How to search for locations? Go to %s and find your desired place. Then copy-paste the URL of the page here.<br />Or just enter the code from the URL, for example %s for Times Square.", 'jig_td'),'<a href="http://worldc.am/" target="_blank">Worldcam</a>','49b7ed6df964a52030531fe3'); ?></div>
							</div>
							<div class="flexirow">
								<div class="normalname"><?php _e('Search for Instagram locations', 'jig_td'); ?></div>
								<label>location</label>
								<input id="instagramLocationSearch" type="text" name="instagram_location_search" value='' />
								<div class="minihelpNarrow"><div class="updateButton igSmallBtn" id="igSearchLocations"><?php _e('Search location', 'jig_td'); ?></div></div>
							</div>
							<div class="flexirow">
								<div id="igLocationContainer"></div>
							</div>
							<div class="row">
								<div class="normalname"><?php _e("Location ID", 'jig_td'); ?></div>
								<label>instagram_location</label>
								<input type="text" id="igSelectedLocation" name="instagram_location" value='' disabled readonly />
								<div class="minihelpNarrow"><?php _e("This is your selected location's ID.", 'jig_td'); ?></div>
							</div>
						</div>
						<input type="hidden" name="instagram_feed" value='' />
						<input type="hidden" name="instagram_recents" value='' />
						<input type="hidden" name="instagram_liked" value='' />
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('Instagram tag filter', 'jig_td'); ?></div>
						<label>instagram_tag_filter</label>
						<input type="text" name="instagram_tag_filter" value='' />
						<div class="minihelp"><?php  _e('Only show Instagram photos that are tagged with at least one of these tags, comma separated, lowercase.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Instagram caching time', 'jig_td'); ?></div>
						<label>instagram_caching</label>
						<input type="text" name="instagram_caching" value='' />
						<div class="minihelp"><?php  _e('The time it takes to see the Instagram content change on the site. This greatly speeds up loading as the photo list for each content type is cached, saving many requests to Instagram! Set in minutes: 4 hours is 240, a day is 1440, a week is 10080.', 'jig_td'); ?></div>
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('Link to the photo on Instagram', 'jig_td'); ?></div>
						<label>instagram_link</label>
						<select name="instagram_link">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e('No', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: link title (default position)', 'jig_td'); ?></option>
								<option value="alt"><?php _e('Add to img alt', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('Display a link back to the photo on Instagram in the lightbox.<br/>Highly recommended!', 'jig_td'); ?></div>
					</div>	
				</div>	


				<h3 class="jigTabTitle" id="jigRSS"><?php _e('RSS', 'jig_td'); ?></h3>
				<div id="jig_rss_tab_content" class="jigSettingsTab jig_settings_group_rss clearfix">
					<div class="flexirow">
						<div class="rssHelp"><?php _e("Feeds are the most flexible and fun image sources. Scroll down for a tool to convert regular links of popular sites to feed URLs. The only limitation is that the feed items need to have an image in order to show up. Advanced users can create a custom feed and connect it to JIG. Note: If the feed images are small, you need to decrease row height and deviation to avoid upscaling.", 'jig_td'); ?></div>	
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Feed URL(s)', 'jig_td'); ?></div>
						<label>rss_url</label>
						<textarea name="rss_url" class="long_input" rows="2" cols="50"></textarea>
						<div class="minihelp minihelpShort"><?php  _e('Specify the URL of the RSS/Atom feed you wish to use. Can combine multiple feeds and sorts them by date - put a comma between URLs in that case.', 'jig_td'); ?></div>
					</div>	
					<div class="row">
						<div class="normalname"><?php _e('RSS links to', 'jig_td'); ?></div>
						<label>rss_links_to</label>
						<select name="rss_links_to">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="permalink"><?php _e('Permalink (the link of the feed item).', 'jig_td'); ?></option>
								<option value="image"><?php _e('Image (lightbox, a gallery of RSS items).', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("What should open when clicking on thumbnails from an RSS feed? Go to General -> Behavior of the plugin -> <strong>Custom link's target</strong> to open permalink in the lightbox (iframe, videos) or on a new tab.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('RSS description', 'jig_td'); ?></div>
						<label>rss_description</label>
						<select name="rss_description">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="none"><?php _e('Nothing, just the title.', 'jig_td'); ?></option>
								<option value="description"><?php _e('Description (full, can be too long).', 'jig_td'); ?></option>
								<option value="excerpt"><?php _e('Excerpt: description cut to x words (automatic, HTML off).', 'jig_td'); ?></option>
								<option value="datetime"><?php _e('Date and time.', 'jig_td'); ?></option>
								<option value="date"><?php _e('Date only.', 'jig_td'); ?></option>
								<option value="nicetime"><?php _e("Nice time (FB style 'ago').", 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('This controls what text to show as description on the thumbnails.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('RSS exceprt length (words)', 'jig_td'); ?></div>
						<label>rss_excerpt_length</label>
						<input type="text" name="rss_excerpt_length" value='' />
						<div class="minihelp"><?php  _e('Limit the length of automatic excerpt, defaults to 20 - word count.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('RSS exceprt ending', 'jig_td'); ?></div>
						<label>rss_excerpt_ending</label>
						<input type="text" name="rss_excerpt_ending" value='' />
						<div class="minihelp"><?php  _e('Add this to the end of the auto excerpt like - Read more... or " [...]"<br />Converts ( ) to [ ], defaults to [...], enter <strong>none</strong> to have no ending."', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('RSS lightbox backlink', 'jig_td'); ?></div>
						<label>rss_link</label>
						<select name="rss_link">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="no"><?php _e('No I really just want a gallery of RSS images.', 'jig_td'); ?></option>
								<option value="yes"><?php _e('Yes: link title (the default position).', 'jig_td'); ?></option>
								<option value="alt"><?php _e('Add to img alt.', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("This the RSS item's backlink in the lightbox, only used when RSS links to image, to provide a way of still going to the permalink.", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('RSS lightbox backlink text', 'jig_td'); ?></div>
						<label>rss_link_text</label>
						<input type="text" name="rss_link_text" value='' />
						<div class="minihelp"><?php  _e('The text to show as RSS lightbox backlink, e.g. Read more, Go to story etc.', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('RSS caching time', 'jig_td'); ?></div>
						<label>rss_caching</label>
						<input type="text" name="rss_caching" value='' />
						<div class="minihelp"><?php  _e('By default the caching is 12 hours (set by WP), you can override that for this feature. Set in minutes.', 'jig_td'); ?></div>
					</div>
					<div class="row generalDashedRow">
						<div class="longHelp"><?php _e('Tool to get the Feed URL from popular sites', 'jig_td'); ?></div>
					</div>
					<div class="flexirow">
						<div class="rssHelp"><?php _e("Enter the regular link to your desired site (following the format of <span class='rssRegularLink'>regular links</span> below), and get the <span class='rssFeedLink'>feed URLs</span> generated for you. Then you can easily add it to the Feed URL(s) - <span class='darkBlue'>rss_url</span> setting above. It's often not trivial how to get <span class='rssFeedLink'>feed URLs</span>, so this should be of help.", 'jig_td'); ?></div>
					</div>
					<div class="flexirow">
							<div class="normalname"><span class="rssRegularLink"><?php _e('Regular link', 'jig_td'); ?></span></div>
							<input type="text" class="long_input" id="rssRegularLinkField" value='' />
							<div class="minihelp"><?php _e('Enter a regular link according to the blue examples below.', 'jig_td'); ?></div>
					</div>
					<div class="flexirow">
							<div class="normalname"><span class="rssFeedLink"><?php _e('Feed URL', 'jig_td'); ?></span></div>
							<input type="text" class="long_input" id="rssFeedUrlField" value='' />
							<div class="minihelp"><?php _e('This is the Feed URL that is based on your regular link.', 'jig_td'); ?></div>
					</div>
					<div class="flexirow" id="rssButtons">
							<div id="rssGenerateButton" class="updateButton rssSmallBtn"><?php _e('Generate Feed URL', 'jig_td'); ?></div>
							<div id="rssSetButton" class="updateButton rssSmallBtn"><?php _e('Set it as', 'jig_td'); ?> <span class="darkBlue">rss_url</span></div>
							<div id="rssAppendButton" class="updateButton rssSmallBtn"><?php _e('Append to', 'jig_td'); ?> <span class="darkBlue">rss_url</span></div>
					</div>
					<div class="flexirow">
						<div class="rssHelp">
							<?php _e('Sites available for this tool with example links (<span class="rssRegularLink">regular links</span>, <span class="rssFeedLink">feed URLs</span> - the tool converts regular links to feed urls)', 'jig_td'); ?>:
							<ul class="rssHelpList">
								<li><?php _e('Youtube', 'jig_td'); ?>
									<ul>
										<li><?php _e("User's recent videos (channel)", 'jig_td'); ?>: <span class="rssRegularLink">http://www.youtube.com/user/TaylorSwiftVEVO</span></li>
									</ul>
								</li>
								<li><?php _e("Vimeo", 'jig_td'); ?>
									<ul>
										<li><?php _e("User's videos", 'jig_td'); ?>: <span class="rssRegularLink">http://vimeo.com/terjes/videos</span></li>
										<li><?php _e("User's likes", 'jig_td'); ?>: <span class="rssRegularLink">http://vimeo.com/terjes/likes</span></li>
										<li><?php _e("Channels", 'jig_td'); ?>: <span class="rssRegularLink">http://vimeo.com/channels/hdmusicvideos</span></li>
										<li><?php _e("Groups", 'jig_td'); ?>: <span class="rssRegularLink">http://vimeo.com/groups/travelhd</span></li>
										<li><?php _e("Subscriptions, Shares and Watch Later feeds can be found in your own profile, left side at the bottom", 'jig_td'); ?></li>
									</ul>
								</li>
								<li><?php _e("500px", 'jig_td'); ?>
									<ul>
										<li><?php _e("User's photos", 'jig_td'); ?>: <span class="rssRegularLink">http://500px.com/mikc84</span></li>
										<li><?php _e("User's favorites", 'jig_td'); ?>: <span class="rssRegularLink">http://500px.com/hoobie/favorites</span></li>
										<li><?php _e("Actual feed URLs", 'jig_td'); ?>:
											<ul>
												<li><?php _e("Popular Photos", 'jig_td'); ?>: <span class="rssFeedLink">http://feed.500px.com/500px-best</span></li>
												<li><?php _e("Editors' Choice", 'jig_td'); ?>: <span class="rssFeedLink">http://feed.500px.com/500px-editors</span></li>
												<li><?php _e("Upcoming Photos", 'jig_td'); ?>: <span class="rssFeedLink">http://feed.500px.com/500px-upcoming</span></li>
												<li><?php _e("Fresh Photos", 'jig_td'); ?>: <span class="rssFeedLink">http://feed.500px.com/500px-fresh</span></li>
												<li><?php _e("500px Blog", 'jig_td'); ?>: <span class="rssFeedLink">http://feed.500px.com/500px-blog</span></li>
											</ul>
										</li>
									</ul>
								</li>
								<li><?php _e("Pinterest", 'jig_td'); ?>
									<ul>
										<li><?php _e("A user's pins", 'jig_td'); ?>: <span class="rssRegularLink">http://pinterest.com/iewachka/pins/</span></li>
										<li><?php _e("Pins from a board of a user", 'jig_td'); ?>: <span class="rssRegularLink">http://pinterest.com/iewachka/pretty-kitchens</span></li>
									</ul>
								</li>
								<li><?php _e("deviantART", 'jig_td'); ?>
									<ul>
										<li><?php _e("For best results, find the RSS icon, it's on the left of the pagination just after the images. It's for user deviations (favorites, favorites: collections, galleries, gallery folders, category galleries) and group deviations (favorites: collections or gallery folders).", 'jig_td'); ?></li>
										<li><?php _e("All new deviations by user (featured only need and id that can't be figured out)", 'jig_td'); ?>: <span class="rssRegularLink">http://trichardsen.deviantart.com/gallery/</span></li>
										<li><?php _e("A gallery of a user or group", 'jig_td'); ?>: <span class="rssRegularLink">http://trichardsen.deviantart.com/gallery/37519255</span></li>
										<li><?php _e("A category gallery of a user", 'jig_td'); ?>: <span class="rssRegularLink">http://trichardsen.deviantart.com/gallery/?catpath=%2Fphotography%2Fconceptual</span></li>									
										<li><?php _e("A set of favorites by user or group", 'jig_td'); ?>: <span class="rssRegularLink">http://natureweb.deviantart.com/favourites/47112653</span></li>
									</ul>
								</li>
								<li><?php _e("Stumbleupon", 'jig_td'); ?>
									<ul>
										<li><?php _e("A user's likes", 'jig_td'); ?>: <span class="rssRegularLink">http://www.stumbleupon.com/stumbler/lowebrady</span></li>
										<li><?php _e("A channel", 'jig_td'); ?>: <span class="rssRegularLink">http://www.stumbleupon.com/channel/TED</span></li>
									</ul>
								</li>
								<li><?php _e("Imgur", 'jig_td'); ?>
									<ul>
										<li><?php _e("A /r category", 'jig_td'); ?>: <span class="rssRegularLink">http://imgur.com/r/aww</span></li>
										<li><?php _e("Front page actual feed URL", 'jig_td'); ?>: <span class="rssFeedLink">http://feeds.feedburner.com/ImgurGallery?format=xml</span></li>
									</ul>
								</li>
								<li><?php _e("Tumblr", 'jig_td'); ?>
									<ul>
										<li><?php _e("Append /rss to tumblr blogs that are on their own domain.", 'jig_td'); ?></li>
										<li><?php _e("A blog's recent posts", 'jig_td'); ?>: <span class="rssRegularLink">http://cute-kittens.tumblr.com</span></li>
									</ul>
								</li>
								<li><?php _e("WordPress", 'jig_td'); ?>
									<ul>
										<li><?php _e("Append /feed/ to WordPress blogs that are on their own domain. Gravatars are skipped and the posts must have featured images!", 'jig_td'); ?></li>
										<li><?php _e("A blog's recent posts", 'jig_td'); ?>: <span class="rssRegularLink">http://suzywalker.wordpress.com/</span></li>
										<li><?php _e("Add /feed to post list views like tags, categories etc.", 'jig_td'); ?>: <span class="rssRegularLink">http://suzywalker.wordpress.com/category/photography/macro/</span></li>
									</ul>
								</li>
							</ul>
							<?php _e('The RSS feature is not limited to the list, this is just an easier way to convert your <span class="rssRegularLink">regular links</span> to <span class="rssFeedLink">feed URLs</span> for a few, selected popular sites. Use of the tool is optional and the <span class="rssFeedLink">feed URL</span> is subject to change by the sites without notification.', 'jig_td'); ?>
						</div>
					</div>
				</div>
				<h3 class="jigTabTitle" id="jigTemplateTag"><?php _e('Template Tag', 'jig_td'); ?></h3>
				<div id="jig_template_tag_tab_content" class="jigSettingsTab jig_settings_group clearfix">
					<div class="row">
						<div id="templateTagButton" class="updateButton"><?php _e('Generate template tag (optional / advanced users)', 'jig_td'); ?></div>
					</div>
					<div class="row" id="templateTagContainer">
						<div class="normalname"><?php _e('Template tag', 'jig_td'); ?>:</div>
						<div id="templateTag"></div>
						<div id="templateTagHelp" class="minihelp"><?php _e('add this to a PHP file of your template', 'jig_td'); ?></div>
						
					</div>
					<div class="row" id="doShortcodeContainer">
						<div class="normalname"><?php _e('Do shortcode', 'jig_td'); ?>:</div>
						<div id="doShortcode"></div>
						<div id="doShortcodeHelp" class="minihelp"><?php _e('OR add this, whichever you like better (they do the same thing)', 'jig_td'); ?></div>
					</div>
				</div>
				<div id="bottomSpacer"></div>
				<div id="insertButtonParent">					
					<div id="insert" style="display: block; line-height: 24px"><?php _e('Create shortcode', 'jig_td'); ?></div>
					<div id="outputShortcodeLabel"><?php _e('Then copy your shortcode', 'jig_td'); ?>:</div>
					<input type="text" name="outputShortcode" id="outputShortcode" value='' />
				</div>
			</form>
		</div>
		<div id="jig-sc-editor-loading"><img src="<?php echo plugins_url('images/ajax-loader.gif', __FILE__); ?>" width="220" height="19" alt="loading"/></div>



		<script type="text/javascript">
			(function($){
				var shortcodes = [	"preset",
								"ids",
								"thumbs_spacing",
								"animation_speed",
								"row_height",
								"height_deviation",
								"mobile_row_height",
								"mobile_height_dev",
								"link_class",
								"link_rel",
								"link_title_field",
								"img_alt_field",
								"prettyphoto_social",
								"prettyphoto_theme",
								"prettyphoto_analytics",
								"download_link",
								"custom_link_follow",
								"load_more",
								"load_more_limit",
								"load_more_text",
								"load_more_count_text",
								"load_more_auto_width",
								"title_field",
								"caption_field",
								"caption",
								"mobile_caption",
								"caption_opacity",
								"caption_bg_color",
								"caption_match_width",
								"caption_text_color",
								"caption_height",
								"caption_title_size",
								"caption_desc_size",
								"caption_align",
								"v_center_captions",
								"custom_fonts",
								"caption_text_shadow",
								"gradient_caption_bg",
								"overlay",
								"mobile_overlay",
								"overlay_color",
								"overlay_icon",
								"overlay_icon_opacity",
								"overlay_icon_url",
								"overlay_icon_retina",
								"overlay_opacity",
								"outer_shadow",
								"inner_shadow",
								"outer_border_width",
								"outer_border_color",
								"middle_border_width",
								"middle_border_color",
								"inner_border_width",
								"inner_border_color",
								"inner_border",
								"inner_border_animate",
								"specialfx",
								"mobile_specialfx",
								"specialfx_type",
								"specialfx_options",
								"specialfx_blend",
								"lightbox",
								"mobile_lightbox",
								"lightbox_max_size",
								"min_height",
								"loading_background",
								"show_text_before",
								"show_text_after",
								"margin",
								"timthumb_path",
								"quality",
								"retina_ready",
								"retina_quality",
								"use_timthumb",
								"orderby",
								"filterby",
								"filter_style",
								"filter_all_text",
								"filter_orderby",
								"filter_custom_order",
								"filter_min_count",
								"filter_top_x",
								"filter_all_button",
								"filter_multiple",
								"allow_animated_gifs",
								"allow_transp_pngs",
								"wrap_text",
								"limit",
								"hidden_limit",
								"max_rows",
								"custom_width",
								"width_mode",
								"last_row",
								"aspect_ratio",
								"disable_cropping",
								"force_aspect_ratio",
								"randomize_width",
								"disable_mobile_hover",
								"mouse_disable",
								"error_checking",
								"id",
								"image_tags",
								"image_categories",
								"link_target",
								"nggallery",
								"ngalbum",
								"ng_gallery",
								"ng_album",
								"ng_pics",
								"ng_tags_gallery",
								"ng_tags_album",
								"ng_recent_images",
								"ng_random_images",
								"ng_count",
								"ng_lightbox_gallery",
								"ng_description",
								"ng_intersect_tags",
								"ng_breadcrumb",
								"ng_bc_separator",
								"ng_bc_base",
								"ng_bc_home",
								"ng_bc_home_text",
								"ng_bc_home_clickable",
								"ng_bc_last_clickable",
								"ng_bc_top_level",
								"ng_bc_add_separator",
								"exclude",
								"include",
								"facebook_id",
								"facebook_album",
								"facebook_caching",
								"facebook_image_size",
								"fb_lightbox_album",
								"fb_breadcrumb",
								"fb_bc_separator",
								"fb_bc_home_text",
								"flickr_user",
								"flickr_photostream",
								"flickr_favorites",
								"flickr_group",
								"flickr_photoset",
								"flickr_gallery",
								"instagram_feed",
								"instagram_recents",
								"instagram_liked",
								"instagram_tag",
								"instagram_location",
								"instagram_tag_filter",
								"instagram_caching",
								"rss_url",
								"rss_links_to",
								"rss_description",
								"rss_excerpt_length",
								"rss_excerpt_ending",
								"rss_link",
								"rss_link_text",
								"rss_caching",
								"developer_link",
								"recent_posts",
								"recents_description",
								"excerpt_length",
								"excerpt_ending",
								"author_prefix",
								"post_ids_exclude",
								"recents_exclude",
								"recents_include",
								"recents_tags",
								"recents_filter_tax",
								"recents_filter_term",
								"recents_placeholder",
								"recents_link_to",
								"recents_link",
								"recents_link_text",
								"recents_custom_links",
								"recents_sticky",
								"recents_post_type",
								"post_ids",
								"recents_parent_id",
								"recents_tree_depth"],
				sc_length = shortcodes.length,
				facebook = new Array(),
				flickr = new Array(),
				instagram = new Array(),
				originalValueForMorphable = new Array(),
				sc_name = 'justified_image_grid',
				instagramTimeout,
				shortcodeLoadCounter = 0;
				function init() {
					/* Facebook */
					$("#facebook").on("click", ".fbSourceBtn", function(event){
						if(!$('#fbOffBtn').hasClass('fbSelected') && $(event.target).attr('id') !== $('.fbSelected').attr('id')){
							$("#facebook input[name='facebook_album']").val('')
						}
						var btn = $(this);
						var id = btn.attr('id');				
						$(".fbSelected").removeClass("fbSelected");
						btn.addClass("fbSelected");
						if(btn.attr('id') != 'fbOffBtn'){
							$("#fbLoadingAJAX").show()
							$("#fbSources").css('visibility','hidden')
							var token = btn.attr('data-access-token');
							$("#facebook input[name='facebook_id']").val(id);
						}else{
							return;
						}
						$.post(
						"<?php echo admin_url('admin-ajax.php'); ?>",
						{
							'action': 'jig_get_fb_albums',
							'security': '<?php echo wp_create_nonce("jig_get_fb_albums") ?>',
							'token' : token,
							'user_id' : id

						},
						function(data) {
							if(data['elements']){
								$("#fbAlbums").html(data['elements'])
								$("#"+$("#facebook input[name='facebook_album']").val()).click();
							}else if(data['error']){
								$("#fbAlbums").html('<div id="fbError">'+data['error']+'</div>');
							}
							$("#fbLoadingAJAX").hide()
							$("#fbSources").css('visibility','visible')

						},
						'json').error(function(){
							$("#fbAlbums").html('<div id="fbError"><?php _e("AJAX error. Check browser console for more information.","jig_td"); ?></div>');
							$("#fbLoadingAJAX").hide()
							$("#fbSources").css('visibility','visible')
						});
					});
					$("#facebook").on("click", ".fbAlbum:not(.fbNoImg,.fbSelectedAlbum)", function(event){
						var btn = $(this);
						var id = btn.attr('id');
						var token = btn.attr('data-access-token');
						$(".fbSelectedAlbum").removeClass("fbSelectedAlbum");
						btn.addClass("fbSelectedAlbum");
						$("#facebook input[name='facebook_album']").val(id);
						if(btn.find('.fbAlbumLoading').length < 1){
							loadFacebookAlbumCover(btn);
						}
					});
					$("#fbSources").on("click", "#fbOffBtn", function(event){
						$('#fbAlbums').empty()
						$('#jig-sc-editor .jig_settings_group_facebook input[name="facebook_id"]').val('');
						$('#jig-sc-editor .jig_settings_group_facebook input[name="facebook_album"]').val('');
					});


					$("#facebook").on("mouseenter mouseleave", ".fbSkipImg", function(event){
						var $this = $(this), showImg;
						event.stopImmediatePropagation();
						if(event.type === "mouseenter"){
							if($this.find('.fbMouseIndicator').length < 1){
								$this.append('<div class="fbMouseIndicator fbStandby">!</div>')
								showImg = setTimeout(function(){
									if($this.find('.fbLoading').length < 1){
										loadFacebookAlbumCover($this);
									}
								}, 500); 
							}
						}else{
							$this.find('.fbStandby').remove()
							if(showImg !== false){
								clearTimeout(showImg);
							}
						}
					});
					/* end of Facebook */

					/* Flickr */
					$("#flickr").on("click", ".fliSourceBtn", function(event){
						$("#fliRow input").val('');
						var btn = $(this);
						var id = btn.attr('id');
						$(".fliSourceBtn.fliSelected").removeClass("fliSelected");
						btn.addClass("fliSelected");
						if(btn.attr('id') != 'fliOffBtn'){
							$("#fliLoadingAJAX").show();
							$("#fliSources, #fliTypes").css('visibility','hidden');					
						}else{
							$('#fliTypes, #fliElements').empty()
							return;
						}
						$.post(
						"<?php echo admin_url('admin-ajax.php'); ?>",
						{
							'action': 'jig_get_fli_types',
							'security': '<?php echo wp_create_nonce("jig_get_fli_types") ?>',
							'user_id' : id

						},
						function(data) {
							var AJAXhideNecessary = true;
							$('#fliTypes, #fliElements').empty()
							if(data['elements']){
								$("#fliTypes").html(data['elements'])
								if(flickr !== undefined){
									if(flickr['flickr_user']){
										if(flickr['flickr_group']){
											$("#fliGroupSelector").click();
											AJAXhideNecessary = false;
										}else if(flickr['flickr_photoset']){
											$("#fliPhotosetSelector").click();
											AJAXhideNecessary = false;
										}else if(flickr['flickr_gallery']){
											$("#fliGallerySelector").click();
											AJAXhideNecessary = false;
										}								
									}else if(flickr['flickr_photostream']){
										$(".fliPhotostreamBtn").click();
										flickr = undefined;
									}else if(flickr['flickr_favorites']){
										$(".fliFavoritesBtn").click();
										flickr = undefined;
									}
								}
							}else if(data['error']){
								$("#fliTypes").html('<div id="fliError">'+data['error']+'</div>');
							}
							if(AJAXhideNecessary == true){
								$("#fliLoadingAJAX").hide()
								$("#fliSources, #fliTypes").css('visibility','visible')
							}
						},
						'json').error(function(){
							$("#fliTypes").html('<div id="fliError"><?php _e("AJAX error. Check browser console for more information.","jig_td"); ?></div>');
							$("#fliLoadingAJAX").hide()
							$("#fliSources, #fliTypes").css('visibility','visible')
						});
					});
					
					$("#fliSources").on("click", "#fliOffBtn", function(event){
						$('#fliTypes, #fliElements').empty()
						$("#fliRow input").val('')
					});
					$("#fliTypes").on("click", ".fliPhotostreamBtn", function(event){
						$(".fliTypeBtn.fliSelected").removeClass("fliSelected");
						$(this).addClass("fliSelected");
						$('#fliElements').empty()
						$("#fliRow input").val('')
						$('#flickr input[name="flickr_photostream"]').val($('.fliSourceBtn.fliSelected').attr('id'))
					})
					.on("click", ".fliFavoritesBtn", function(event){
						$(".fliTypeBtn.fliSelected").removeClass("fliSelected");
						$(this).addClass("fliSelected");
						$('#fliElements').empty()
						$("#fliRow input").val('')
						$('#flickr input[name="flickr_favorites"]').val($('.fliSourceBtn.fliSelected').attr('id'))
					})
					.on("click", "#fliGroupSelector, #fliPhotosetSelector, #fliGallerySelector", function(event){
						$(".fliTypeBtn.fliSelected").removeClass("fliSelected");
						$(this).addClass("fliSelected");
						$("#fliRow input").val('')
						var id = $('.fliSourceBtn.fliSelected').attr('id'),
							type = $(this).attr('id');
						type = type.substring(3,type.length-8).toLowerCase()
						$("#fliLoadingAJAX").show()
						$("#fliSources, #fliTypes").css('visibility','hidden')
						$.post(
						"<?php echo admin_url('admin-ajax.php'); ?>",
						{
							'action': 'jig_get_fli_elements',
							'security': '<?php echo wp_create_nonce("jig_get_fli_elements") ?>',
							'user_id' : id,
							'type' : type
						},
						function(data) {
							if(data['elements']){
								$("#fliElements").html(data['elements'])
								if(flickr !== undefined && flickr['flickr_user']){
									if(flickr['flickr_'+type]){
										$("#"+flickr['flickr_'+type]).click();
									}
									flickr = undefined;
								}
							}else if(data['error']){
								$("#fliElements").html('<div id="fliError">'+data['error']+'</div>');
							}
							$("#fliLoadingAJAX").hide()
							$("#fliSources, #fliTypes").css('visibility','visible')

						},
						'json').error(function(){
							$("#fliElements").html('<div id="fliError"><?php _e("AJAX error. Check browser console for more information.","jig_td"); ?></div>');
							$("#fliLoadingAJAX").hide()
							$("#fliSources, #fliTypes").css('visibility','visible')
						})
						
					});

					$("#fliElements").on("click", ".fliElement:not(.fliNoImg,.fliSelectedElement)", function(event){
						var btn = $(this);
						$(".fliSelectedElement").removeClass("fliSelectedElement");
						btn.addClass("fliSelectedElement");
						var type = $('.fliTypeBtn.fliSelected').attr('id');
						type = type.substring(3,type.length-8).toLowerCase()
						var id = btn.attr('id');
						$('#flickr input[name="flickr_'+type+'"]').val(id)
						var sourceId = $('.fliSourceBtn.fliSelected').attr('id');
						$('#flickr input[name="flickr_user"]').val(sourceId)
						if(btn.find('.fliElementLoading').length < 1){
							loadFlickrElementCover(btn);
						}
					});
					$("#flickr").on("mouseenter mouseleave", ".fliSkipImg", function(event){
						var $this = $(this), showImg;
						event.stopImmediatePropagation();
						if(event.type === "mouseenter"){
							if($this.find('.fliMouseIndicator').length < 1){
								$this.append('<div class="fliMouseIndicator fliStandby">!</div>')
								showImg = setTimeout(function(){
									if($this.find('.fliLoading').length < 1){
										loadFlickrElementCover($this);
									}
								}, 500); 
							}
						}else{
							$this.find('.fliStandby').remove()
							if(showImg !== false){
								clearTimeout(showImg);
							}
						}
					});
					/* end of Flickr */

					/* Instagram */
					$("#instagram").on("click", ".igSourceBtn", function(event){

						$(".igPanelsRow input").val('');
						var btn = $(this),
							id = btn.attr('data-instagram-user-id');
						$(".igSourceBtn.igSelected").removeClass("igSelected");
						btn.addClass("igSelected");
						$('#igRecentsPanel, #igTagPanel, #igLocationPanel, .igPanelsRow').hide();
						//$('#instagram input').val('');
						if(btn.hasClass('igFeedBtn')){
							$('#instagram input[name="instagram_feed"]').val(id)
						}else if(btn.hasClass('igRecentsBtn')){
							$('#instagram input[name="instagram_recents"]').val(id)
						}else if(btn.hasClass('igLikedBtn')){
							$('#instagram input[name="instagram_liked"]').val(id)
						}else if(btn.hasClass('igAnyRecentsBtn')){
							if(instagram['instagram_recents']){
								$('#instagram input[name="instagram_recents_helper"],#instagram input[name="instagram_recents"]').val(instagram['instagram_recents'])
							}
							$('.igPanelsRow, #igRecentsPanel').show();
							$('#instagramUserSeach').focus()
						}else if(btn.hasClass('igByTagBtn')){
							if(instagram['instagram_tag']){
								$('#instagram input[name="instagram_tag"]').val(instagram['instagram_tag'])
							}
							$('.igPanelsRow, #igTagPanel').show();
							$('#instagramTagSeach').focus()
						}else if(btn.hasClass('igByLocationBtn')){
							if(instagram['instagram_location']){
								$('#instagram input[name="instagram_location"]').val(instagram['instagram_location'])
							}
							$('.igPanelsRow, #igLocationPanel').show();
							$('#instagramLocationSearch').focus()
						}
						instagram = new Array();
					})
					$("#instagram").on("click", "#igSearchUsers", function(event){
						if(typeof instagramTimeout !== 'undefined'){
							clearTimeout(instagramTimeout);
						}
						$("#igLoadingAJAX").show()
						$("#igSources").css('visibility','hidden')		
						var search_value = $('#instagramUserSeach').val();
						$.post(
							"<?php echo admin_url('admin-ajax.php'); ?>",
							{
								'action': 'jig_instagram_search_users',
								'security': '<?php echo wp_create_nonce("jig_instagram_search_users") ?>',
								'search_value' : search_value

							},
							function(data) {
								$('#igNameContainer').empty()
								if(data['elements']){
									$("#igNameContainer").html(data['elements'])
								
								}else if(data['error']){
									$("#igNameContainer").html('<div id="igError">'+data['error']+'</div>');
								}
								$("#igLoadingAJAX").hide()
								$("#igSources").css('visibility','visible')

							},
							'json').error(function(){
								$("#igNameContainer").html('<div id="igError"><?php _e("AJAX error. Check browser console for more information.","jig_td"); ?></div>');
								$("#igLoadingAJAX").hide()
								$("#igSources").css('visibility','visible')
							});
					}).on("keypress", "#instagramUserSeach", function(event){
						if(typeof instagramTimeout !== 'undefined'){
							clearTimeout(instagramTimeout);
						}
						if(event.which == 13){
							event.preventDefault();
							$('#igSearchUsers').click();
						}else {
							instagramTimeout = setTimeout(function(){
								$('#igSearchUsers').click()
							}, 2000);
						}
					}).on("click", ".igNameBtn", function(event){
						var $this = $(this);
						$(".igNameBtn.igSelected").removeClass("igSelected");
						$this.addClass("igSelected");
						$('#igSelectedUser, #instagram input[name="instagram_recents"]').val($this.attr('data-instagram-user-id'));
					}).on("click", "#igOffBtn", function(event){
						$('#jig-sc-editor .jig_settings_group_instagram input').val('');
					});

					$("#instagram").on("click", "#igSearchTags", function(event){
						if(typeof instagramTimeout !== 'undefined'){
							clearTimeout(instagramTimeout);
						}
						$("#igLoadingAJAX").show()
						$("#igSources").css('visibility','hidden')		
						var search_value = $('#instagramTagSeach').val();
						$.post(
							"<?php echo admin_url('admin-ajax.php'); ?>",
							{
								'action': 'jig_instagram_search_tags',
								'security': '<?php echo wp_create_nonce("jig_instagram_search_tags") ?>',
								'search_value' : search_value

							},
							function(data) {
								$('#igTagContainer').empty()
								if(data['elements']){
									$("#igTagContainer").html(data['elements']);
									$(".igTagBtn:first").click();
								}else if(data['error']){
									$("#igTagContainer").html('<div id="igError">'+data['error']+'</div>');
								}
								$("#igLoadingAJAX").hide()
								$("#igSources").css('visibility','visible')

							},
							'json').error(function(){
								$("#igTagContainer").html('<div id="igError"><?php _e("AJAX error. Check browser console for more information.","jig_td"); ?></div>');
								$("#igLoadingAJAX").hide()
								$("#igSources").css('visibility','visible')
							});
					}).on("keypress", "#instagramTagSeach", function(event){
						if(typeof instagramTimeout !== 'undefined'){
							clearTimeout(instagramTimeout);
						}
						if(event.which == 13){
							event.preventDefault();
							$('#igSearchTags').click();
						}else {
							instagramTimeout = setTimeout(function(){
								$('#igSearchTags').click()
							}, 2000);
						}
					}).on("click", ".igTagBtn", function(event){
						var $this = $(this);
						$(".igTagBtn.igSelected").removeClass("igSelected");
						$this.addClass("igSelected");
						$('#igSelectedTag').val($this.attr('data-instagram-tag'));
					})


					$("#instagram").on("click", "#igSearchLocations", function(event){
						$("#igLoadingAJAX").show()
						$("#igSources").css('visibility','hidden')	
						var locationSearch = $('#instagramLocationSearch').val(),
							foursquareid,
							matches;
						if(locationSearch.indexOf('worldc.am') !== -1){
							matches = locationSearch.match(/\/([[\w]+)\/?$/);
							if(matches.length > 0){
								foursquareid = matches[1];
							}
						}else{
							foursquareid = locationSearch.replace(' ','')
						}
						$.post(
							"<?php echo admin_url('admin-ajax.php'); ?>",
							{
								'action': 'jig_instagram_search_locations',
								'security': '<?php echo wp_create_nonce("jig_instagram_search_locations") ?>',
								'foursquareid' : foursquareid

							},
							function(data) {
								$('#igLocationContainer').empty()
								if(data['elements']){
									$("#igLocationContainer").html(data['elements']);
									$(".igLocationBtn:first").click();
								}else if(data['error']){
									$("#igLocationContainer").html('<div id="igError">'+data['error']+'</div>');
								}
								$("#igLoadingAJAX").hide()
								$("#igSources").css('visibility','visible')

							},
							'json').error(function(){
								$("#igLocationContainer").html('<div id="igError"><?php _e("AJAX error. Check browser console for more information.","jig_td"); ?></div>');
								$("#igLoadingAJAX").hide()
								$("#igSources").css('visibility','visible')
							});
					}).on("click", ".igLocationBtn", function(event){
						var $this = $(this);
						$(".igLocationBtn.igSelected").removeClass("igSelected");
						$this.addClass("igSelected");
						$('#igSelectedLocation').val($this.attr('data-instagram-location-id'));
					})
					// Without foursquare
					/*$("#instagram").on("click", "#igSearchLocations", function(event){
						$("#igLoadingAJAX").show()
						$("#igSources").css('visibility','hidden')	
						var locationSearch = $('#instagramLocationSearch').val(),
							coords,
							lat,
							lng;
						if(locationSearch.indexOf('maps.google') !== -1){
							coords = locationSearch.match(/([-.0-9]+),([-.0-9]+)/g);
							if(coords.length > 0){
								coords = coords[0].split(','); 
								lat = coords[0];
								lng = coords[1];
							}
						}else{
							locationSearch = locationSearch.replace(' ','');
							coords = locationSearch.split(','); 
							lat = coords[0];
							lng = coords[1];
						}
						$.post(
							"<?php echo admin_url('admin-ajax.php'); ?>",
							{
								'action': 'jig_instagram_search_locations',
								'security': '<?php echo wp_create_nonce("jig_instagram_search_locations") ?>',
								'lat' : lat,
								'lng' : lng

							},
							function(data) {
								$('#igLocationContainer').empty()
								if(data['elements']){
									$("#igLocationContainer").html(data['elements']);
								}else if(data['error']){
									$("#igLocationContainer").html('<div id="igError">'+data['error']+'</div>');
								}
								$("#igLoadingAJAX").hide()
								$("#igSources").css('visibility','visible')

							},
							'json').error(function(){
								$("#igLocationContainer").html('<div id="igError"><?php _e("AJAX error. Check browser console for more information.","jig_td"); ?></div>');
								$("#igLoadingAJAX").hide()
								$("#igSources").css('visibility','visible')
							});
					}).on("click", ".igLocationBtn", function(event){
						var $this = $(this);
						$(".igLocationBtn.igSelected").removeClass("igSelected");
						$this.addClass("igSelected");
						$('#igSelectedLocation').val($this.attr('data-instagram-location-id'));
					})*/
					



					
					/* end of Instagram*/

					/* RSS */
					var rssAppendButtonClickable = true;
					$("#jig_rss_tab_content").on("click", "#rssGenerateButton", function(event){
						generateFeedURL();					
					})
					.on("click", "#rssSetButton", function(event){
						$('#jig-sc-editor textarea[name="rss_url"]').val($("#rssFeedUrlField").val());
					})
					.on("click", "#rssAppendButton", function(event){
						if(rssAppendButtonClickable == true){
							var rssUrlValue = $('#jig-sc-editor textarea[name="rss_url"]').val();
							if($('#rssFeedUrlField').hasClass('invalidRssUrl')){
								return;
							}
							if(rssUrlValue == ""){
								$('#jig-sc-editor textarea[name="rss_url"]').val($("#rssFeedUrlField").val());
							}else{
								$('#jig-sc-editor textarea[name="rss_url"]').val(rssUrlValue+","+$("#rssFeedUrlField").val());
							}
							$("#rssAppendButton").css({'opacity':0.5,'cursor':'auto'});
							rssAppendButtonClickable = false;
						}
						var rssAppendButtonTimeout = setTimeout(function(){
							$("#rssAppendButton").css({'opacity':1,'cursor':'pointer'});
							rssAppendButtonClickable = true;
						}, 2000); 


					})


					/* end of RSS */

					loadShortcode();
					window.setTimeout(function(){
							$("#inputShortcode").focus();
					}, 1); // Weird jQuery 1.9 bug fix for IE
					$("#inputShortcode").on('keyup change',loadShortcode); // Multiple loads will be prevented but .one() is not applicable
					$("#outputShortcode").click(function(){
						$(this).select();
					})
					$("#insert").click(function(){
						generateShortcode()
						window.setTimeout(function(){
							$("#outputShortcode").focus().select();
						}, 1); // Weird jQuery 1.9 bug fix for IE
						
					})
					$("#templateTagButton").click(templateTag)
				} // end of init
				function generateFeedURL(){
					var regularLink = $("#rssRegularLinkField").val(),
						feedUrl = '',
						errorMessage = '';
						siteRegexp = /http(?:s)?:\/\/(?:[\w\-]+\.)*([\w\-]{1,63})(?:\.(?:\w{3}|\w{2}))(?:$|\/)/m,
						match = siteRegexp.exec(regularLink); // first match the domain
						if (match != null) {
							domain = match[1].toLowerCase();
							// then for each with a switch match the possible supported urls and build the custom link
							switch(domain){
								case 'youtube':
									//User's recent videos (channel)
									var youtubeMatch = /^(?:.*?)youtube\.com\/user\/([^\/?#\s]*)\/?/m.exec(regularLink);
									if (youtubeMatch != null) {
										feedUrl = "http://gdata.youtube.com/feeds/base/users/"+youtubeMatch[1]+"/uploads?alt=rss&v=2&orderby=published&client=ytapi-youtube-profile";
									}

								case 'vimeo':
									// User's videos or User's likes
									if (/^(?:.*?)vimeo\.com\/([^\/]*?)\/(videos|likes)\/?$/m.test(regularLink)) {
										feedUrl = feedAppend(regularLink,'rss');
									}
									// Channels or Groups
									else if (/^(?:.*?)vimeo\.com\/(channels|groups)\/([^\/]*?)\/?$/m.test(regularLink)) {
										feedUrl = feedAppend(regularLink,'videos/rss');
									}
								break;
								case '500px':
									// User's photos or User's favorites
									if (/^(?:.*?)500px\.com\/([^\/]*?)(\/favorites)?\/?$/m.test(regularLink)) {
										feedUrl = feedAppend(regularLink,'rss');
									}
								break;
								case 'pinterest':
									// A user's pins
									var pinMatch = /^(?:.*?)pinterest\.com\/([^\/]*?)\/pins\/?$/m.exec(regularLink);
									if (pinMatch != null) {
										feedUrl = "http://pinterest.com/"+pinMatch[1]+"/feed.rss";
									}
									// Pins from a board of a user
									else if (/^(?:.*?)pinterest\.com\/([^\/]*?)\/(?!pins|likes)([^\/]*?)\/?$/m.test(regularLink)) {
										feedUrl = feedAppend(regularLink,'rss');
									}
								break;
								case 'deviantart':
									var deviantartGalMatch = /^(?:.*?)\/\/([^.]*?)\.deviantart\.com\/gallery(?:\/(\d+?)|\/\?catpath=%2F(.*))?\/?$/m.exec(regularLink);
									if (deviantartGalMatch != null) { // Galleries
										// All new deviations by user (featured only need and id that can't be figured out)
										if(deviantartGalMatch[2] == null && deviantartGalMatch[3] == null){ // Overview
											feedUrl = "http://backend.deviantart.com/rss.xml?q=gallery%3A"+deviantartGalMatch[1]+"&type=deviation";
										}
										// A gallery of a user or group
										else if(!isNaN(deviantartGalMatch[2])){ // Gallery ID
											feedUrl = "http://backend.deviantart.com/rss.xml?q=gallery%3A"+deviantartGalMatch[1]+"%2F"+deviantartGalMatch[2]+"&type=deviation";
										}
										// A category gallery of a user
										else if(deviantartGalMatch[3] != null){ // Category path
											feedUrl = "http://backend.deviantart.com/rss.xml?q=gallery%3A"+deviantartGalMatch[1]+"+in%3A"+deviantartGalMatch[3]+"+sort%3Atime&type=deviation";

										}
									}else{ // Favorites
										var deviantartFavMatch = /^(?:.*?)\/\/([^.]*?)\.deviantart\.com\/favourites\/(\d+?)\/?$/m.exec(regularLink);
										if (deviantartFavMatch != null) {
											feedUrl = "http://backend.deviantart.com/rss.xml?q=favby%3A"+deviantartFavMatch[1]+"%2F"+deviantartFavMatch[2]+"&type=deviation";
										} 
									}

								break;
								case 'stumbleupon':
									// A user's likes
									var stumbleuponMatch = /^(?:.*?)stumbleupon\.com\/(stumbler\/[^\/]*?)\/?$/m.exec(regularLink);
									if (stumbleuponMatch != null) {
										feedUrl = feedAppend("http://www.stumbleupon.com/rss/"+stumbleuponMatch[1],"likes");
									}else{ // A channel
										stumbleuponMatch = /^(?:.*?)stumbleupon\.com\/(channel\/[^\/]*?)\/?$/m.exec(regularLink);
										if (stumbleuponMatch != null) {
										feedUrl = feedAppend("http://www.stumbleupon.com/rss/"+stumbleuponMatch[1],"content");
										}
									}
								break;
								case 'imgur':
									if (/^(?:.*?)imgur\.com\/r\/[^\/]*?\/?$/m.test(regularLink)) { // A /r category
										feedUrl = feedAppend(regularLink,'rss');
									}else if (/^(?:.*?)imgur\.com\/?$/m.test(regularLink)) { // Front page
										feedUrl = "http://feeds.feedburner.com/ImgurGallery?format=xml";
									}
								break;
								case 'tumblr':
									if (/^(?:.*?)\/\/(?!www).*\.tumblr\.com\/?$/m.test(regularLink)) {
										feedUrl = feedAppend(regularLink,"rss");
									}
								break;
								case 'wordpress':
									// Any wordpress URL
									if (/^(?:.*?)\/\/(?!www).*\.wordpress\.com.*/m.test(regularLink)) {
										feedUrl = feedAppend(regularLink,"feed");
									}
								break;
								default:
									errorMessage = "<?php _e('The site is not supported by this tool.', 'jig_td'); ?>"
							}
						}else{
							errorMessage = "<?php _e('Seems like an invalid link.', 'jig_td'); ?>"
						}
						if(feedUrl !== ''){
							$('#rssFeedUrlField').val(feedUrl);
							$("#rssFeedUrlField").select();
							$('#rssFeedUrlField').removeClass('invalidRssUrl')
						}else if(errorMessage !== ''){
							$('#rssFeedUrlField').val(errorMessage);
							$('#rssFeedUrlField').addClass('invalidRssUrl')
						}else{
							$('#rssFeedUrlField').val("<?php _e('The regular link is not supported.', 'jig_td'); ?>");
							$('#rssFeedUrlField').addClass('invalidRssUrl')
						}


					//
				}
				function feedAppend(base,toAppend){
					if(base.charAt(base.length-1) !== '/'){
						return base+'/'+toAppend;
					}else{
						return base+toAppend;
					}
				}
				function addUserTextValues(settingName,settingValue){
					var output = '';
					if(settingValue !== '' && settingValue != 'default' && settingValue != undefined){
						if(settingValue.indexOf(' ') > -1
							&& settingValue.substr(0,1) !== '"'
							&& settingValue.substr(settingValue.length-1,1) !== '"'
							&& settingValue.substr(0,1) !== "'"
							&& settingValue.substr(settingValue.length-1,1) !== "'" )
						{
							output = ' '+settingName+'="'+settingValue+'"';
						}else{
							output = ' '+settingName+'='+settingValue;
						}
					}
					return output;
				}
				function loadShortcode(){
					var sc = $("#inputShortcode").val(),
						sc_name_matches = sc.match(/(?!\[)(justified_image_grid<?php echo ($this->settings['take_over_gallery'] === 'yes' ? '|gallery' : '' ).($this->settings['shortcode_alias'] !== 'justified_image_grid' && $this->settings['shortcode_alias'] !== '' ? '|'.$this->settings['shortcode_alias'] : '' );?>)(?=\s)/g),
						matches = sc.match(/([a-z_]*?)=(.*?)(?= (?:[a-z_]*?)=|\])/mg);


					if(matches){
						shortcodeLoadCounter++;
						if(shortcodeLoadCounter > 1){ // It only needs to load the shortcode ONCE! Then the field goes gray anyway.
							return;
						}
						var matches_length = matches.length;
						for(var i = 0; i<matches_length; i++){
							var attr = [],
								options = [];
							attr[0] = matches[i].substring(0,matches[i].indexOf('='));
							attr[1] = matches[i].substring(matches[i].indexOf('=')+1);
							if(attr[0] == "facebook_id" || attr[0] == "facebook_album"){
								facebook[attr[0]] = attr[1];
							}if(attr[0].indexOf('instagram') !== -1){
								instagram[attr[0]] = attr[1];
							}else{
								switch(attr[0]){
									case "flickr_user":
									case "flickr_photostream":
									case "flickr_favorites":
									case "flickr_group":
									case "flickr_photoset":
									case "flickr_gallery":
										flickr[attr[0]] = attr[1].replace(/@/g,"\\@");
										break;
									case "nggallery":
										attr[0] = "ng_gallery";
										break;
									case "ngalbum":
										attr[0] = "ng_album";
										break;
								}
							}
							$('#jig-sc-editor input[name="'+attr[0]+'"]').val(attr[1]);
							$('#jig-sc-editor select[name="'+attr[0]+'"]').val(attr[1]);

							if(attr[0] == 'rss_url'){
								$('#jig-sc-editor textarea[name="rss_url"]').val(attr[1]);
							}
							if(attr[0] == 'ng_gallery'
								|| attr[0] == 'ng_album'
								|| attr[0] == 'ng_random_images'
								|| attr[0] == 'recents_post_type'
								){ // or other checkboxes ||
								originalValueForMorphable[attr[0]] = [];
								if(attr[1].indexOf(',') !== -1){
									$('#jig-sc-editor select[name="'+attr[0]+'"]').val('').change();
									options = attr[1].split(',');
									$.each(options, function(index, value) {
										originalValueForMorphable[attr[0]].push(value) ;
										$('#jig-sc-editor input[name="'+attr[0]+'[]"][value="'+value+'"]').attr('checked',true);
									});
								}else{
									originalValueForMorphable[attr[0]] = [attr[1]];
								}
							}					
						}
						if(!$.isEmptyObject(facebook) ){
							loadFacebookValues();
						}else if(!$.isEmptyObject(flickr) ){
							loadFlickrValues();
						}else if(!$.isEmptyObject(instagram) ){
							loadInstagramValues();
						}
						$("#inputShortcode").attr("disabled", true); 						
					}
					if(sc_name_matches){
						sc_name = sc_name_matches[0];
					}
				}
				function generateShortcode() {
					var output = '['+sc_name;
					for(var i = 0; i<sc_length; i++){
						var val = $('#jig-sc-editor .jig_settings_group input[name="'+shortcodes[i]+'"]').val();
						if (val == undefined){
							val = $('#jig-sc-editor .jig_settings_group select[name="'+shortcodes[i]+'"] option:selected').val(); 
						}
						output += addUserTextValues(shortcodes[i],val);
					}

					var load_more = $('#jig-sc-editor .jig_settings_group_load_more select[name="load_more"] option:selected').val(),
						recent_posts = $('#jig-sc-editor .jig_settings_group_recents select[name="recent_posts"] option:selected').val();

					if(load_more !== 'default'){
						output += ' load_more='+load_more;
						if(load_more !== 'off'){
							var load_more_limit = $('#jig-sc-editor .jig_settings_group_load_more input[name="load_more_limit"]').val(),
								load_more_text = $('#jig-sc-editor .jig_settings_group_load_more input[name="load_more_text"]').val(),
								load_more_count_text = $('#jig-sc-editor .jig_settings_group_load_more input[name="load_more_count_text"]').val(),
								load_more_auto_width = $('#jig-sc-editor .jig_settings_group_load_more select[name="load_more_auto_width"] option:selected').val(),
								load_more_mobile = $('#jig-sc-editor .jig_settings_group_load_more select[name="load_more_mobile"] option:selected').val();
								
							output += addUserTextValues('load_more_text',load_more_text);
							output += addUserTextValues('load_more_count_text',load_more_count_text);
							if(load_more_auto_width !== 'default'){
								output += ' load_more_auto_width='+load_more_auto_width;
							}
							if(load_more_mobile !== 'default'){
								output += ' load_more_mobile='+load_more_mobile;
							}
							if(load_more_limit !== ''){
								output += ' load_more_limit='+load_more_limit;
							}
						}
					}

					if(recent_posts !== 'default'){
						var recents_description = $('#jig-sc-editor .jig_settings_group_recents select[name="recents_description"] option:selected').val(),
							author_prefix = $('#jig-sc-editor .jig_settings_group_recents input[name="author_prefix"]').val(),
							post_ids_exclude = $('#jig-sc-editor .jig_settings_group_recents input[name="post_ids_exclude"]').val(),
							recents_exclude = $('#jig-sc-editor .jig_settings_group_recents input[name="recents_exclude"]').val(),
							recents_include = $('#jig-sc-editor .jig_settings_group_recents input[name="recents_include"]').val(),
							recents_tags = $('#jig-sc-editor .jig_settings_group_recents input[name="recents_tags"]').val(),
							recents_filter_tax = $('#jig-sc-editor .jig_settings_group_recents select[name="recents_filter_tax"] option:selected').val(),
							recents_filter_term = $('#jig-sc-editor .jig_settings_group_recents input[name="recents_filter_term"]').val(),
							recents_placeholder = $('#jig-sc-editor .jig_settings_group_recents input[name="recents_placeholder"]').val(),
							post_ids = $('#jig-sc-editor .jig_settings_group_recents input[name="post_ids"]').val(),
							recents_post_type = $('#jig-sc-editor .jig_settings_group_recents select[name="recents_post_type"] option:selected').val() || $('#jig-sc-editor .jig_settings_group_recents input[name="recents_post_type[]"]:checked').map(function () {return this.value;}).get().join(","),
							recents_link_to = $('#jig-sc-editor .jig_settings_group_recents select[name="recents_link_to"] option:selected').val(),
							recents_link = $('#jig-sc-editor .jig_settings_group_recents select[name="recents_link"] option:selected').val(),
							recents_link_text = $('#jig-sc-editor .jig_settings_group_recents input[name="recents_link_text"]').val(),
							recents_custom_links = $('#jig-sc-editor .jig_settings_group_recents select[name="recents_custom_links"] option:selected').val(),
							recents_sticky = $('#jig-sc-editor .jig_settings_group_recents select[name="recents_sticky"] option:selected').val(),
							excerpt_ending = $('#jig-sc-editor .jig_settings_group_recents input[name="excerpt_ending"]').val(),
							excerpt_length = $('#jig-sc-editor .jig_settings_group_recents input[name="excerpt_length"]').val(),
							recents_parent_id = $('#jig-sc-editor .jig_settings_group_recents input[name="recents_parent_id"]').val(),
							recents_tree_depth = $('#jig-sc-editor .jig_settings_group_recents input[name="recents_tree_depth"]').val();

							output += ' recent_posts='+recent_posts;
							if(recents_description != 'default'){
								output += ' recents_description='+recents_description;
								if(recents_description == 'auto_excerpt' || recents_description == 'auto_manual_excerpt'){
									output += addUserTextValues('excerpt_ending',excerpt_ending);
									if(excerpt_length !== ''){
										output += ' excerpt_length='+excerpt_length;
									}
								}
							}
							output += addUserTextValues('author_prefix',author_prefix);
							if(recents_exclude !== ''){
								output += ' recents_exclude='+recents_exclude;
							}else if(recents_include != ''){
								output += ' recents_include='+recents_include;
							}
							output += addUserTextValues('recents_tags',recents_tags);
							if(recents_filter_tax != 'default'){
								output += addUserTextValues('recents_filter_tax',recents_filter_tax);
								output += addUserTextValues('recents_filter_term',recents_filter_term);
							}
							if(recents_placeholder !== ''){
								output += ' recents_placeholder='+recents_placeholder;
							}
							if(recents_post_type !== 'post' && recents_post_type !== ''){
								output += ' recents_post_type='+recents_post_type;
							}
							output += addUserTextValues('post_ids',post_ids);
							output += addUserTextValues('post_ids_exclude',post_ids_exclude);

							if(recents_link_to !== 'post'){
								output += ' recents_link_to='+recents_link_to;
							}
							if(recents_link !== 'no'){
								output += addUserTextValues('recents_link',recents_link);
							}
							output += addUserTextValues('recents_link_text',recents_link_text);
							if(recents_custom_links !== 'no'){
								output += ' recents_custom_links='+recents_custom_links;
							}
							if(recents_sticky !== 'default'){
								output += ' recents_sticky='+recents_sticky;
							}
							if(recents_parent_id !== ''){
								output += ' recents_parent_id='+recents_parent_id;
							}
							if(recents_tree_depth !== ''){
								output += ' recents_tree_depth='+recents_tree_depth;
							}							
					}else{

						var facebook_id = $('#jig-sc-editor .jig_settings_group_facebook input[name="facebook_id"]').val(),
						facebook_album = $('#jig-sc-editor .jig_settings_group_facebook input[name="facebook_album"]').val(),
						facebook_caching = $('#jig-sc-editor .jig_settings_group_facebook input[name="facebook_caching"]').val(),
						fb_bc_home_text = $('#jig-sc-editor .jig_settings_group_facebook input[name="fb_bc_home_text"]').val(),
						facebook_image_size = $('#jig-sc-editor .jig_settings_group_facebook select[name="facebook_image_size"] option:selected').val(),
						fb_lightbox_album = $('#jig-sc-editor .jig_settings_group_facebook select[name="fb_lightbox_album"] option:selected').val(),
						fb_breadcrumb = $('#jig-sc-editor .jig_settings_group_facebook select[name="fb_breadcrumb"] option:selected').val(),
						fb_bc_separator = $('#jig-sc-editor .jig_settings_group_facebook select[name="fb_bc_separator"] option:selected').val();

						if(facebook_id != "" && facebook_album != ""){
							output += ' facebook_id='+facebook_id+' facebook_album='+facebook_album;
							if(facebook_caching != '' && facebook_caching != 'default' && facebook_caching != undefined){
								output += ' facebook_caching='+facebook_caching;
							}
							if(facebook_image_size != '' && facebook_image_size != 'default' && facebook_image_size != undefined){
								output += ' facebook_image_size='+facebook_image_size;
							}
							if(facebook_album == "overview" || facebook_album == "overview_only_albums"){
								if(fb_breadcrumb !== 'default'){
									output += ' fb_breadcrumb='+fb_breadcrumb;
								}else{
									if(fb_bc_separator !== 'default'){
										output += ' fb_bc_separator='+fb_bc_separator;
									}
									if(fb_lightbox_album !== 'default'){
										output += ' fb_lightbox_album='+fb_lightbox_album;
									}
									output += addUserTextValues('fb_bc_home_text',fb_bc_home_text);
								}
							}
						}else{
							if($.isEmptyObject(flickr)){
								var flickr_user = $('#jig-sc-editor .jig_settings_group_flickr input[name="flickr_user"]').val(),
									flickr_photostream = $('#jig-sc-editor .jig_settings_group_flickr input[name="flickr_photostream"]').val(),
									flickr_favorites = $('#jig-sc-editor .jig_settings_group_flickr input[name="flickr_favorites"]').val(),
									flickr_group = $('#jig-sc-editor .jig_settings_group_flickr input[name="flickr_group"]').val(),
									flickr_photoset = $('#jig-sc-editor .jig_settings_group_flickr input[name="flickr_photoset"]').val(),
									flickr_gallery = $('#jig-sc-editor .jig_settings_group_flickr input[name="flickr_gallery"]').val(),
									flickr_caching = $('#jig-sc-editor .jig_settings_group_flickr input[name="flickr_caching"]').val(),
									flickr_link = $('#jig-sc-editor .jig_settings_group_flickr select[name="flickr_link"] option:selected').val();
							}else{
								var flickr_user = flickr['flickr_user'] ?
										flickr['flickr_user'].replace(/\\@/g,"@") : '',
									flickr_photostream = flickr['flickr_photostream'] ?
										flickr['flickr_photostream'].replace(/\\@/g,"@") : '',
									flickr_favorites = flickr['flickr_favorites'] ?
										flickr['flickr_favorites'].replace(/\\@/g,"@") : '',
									flickr_group = flickr['flickr_group'] ?
										flickr['flickr_group'].replace(/\\@/g,"@") : '',
									flickr_photoset = flickr['flickr_photoset'] ?
										flickr['flickr_photoset'].replace(/\\@/g,"@") : '',
									flickr_gallery = flickr['flickr_gallery'] ?
										flickr['flickr_gallery'].replace(/\\@/g,"@") : '';
							}
							if(flickr_user != "" || flickr_photostream != "" || flickr_favorites != "" ){
								var ol = output.length;
								if(flickr_user != ""){
									if(flickr_group != ""){
										output += ' flickr_user='+flickr_user+' flickr_group='+flickr_group;
									}else if(flickr_photoset != ""){
										output += ' flickr_user='+flickr_user+' flickr_photoset='+flickr_photoset;
									}else if(flickr_gallery != ""){
										output += ' flickr_user='+flickr_user+' flickr_gallery='+flickr_gallery;
									}
								}
								if(flickr_photostream != ""){
									output += ' flickr_photostream='+flickr_photostream;
								}else if(flickr_favorites != ""){
									output += ' flickr_favorites='+flickr_favorites;
								}
								if(output.length > ol && flickr_caching != '' && flickr_caching != 'default' && flickr_caching != undefined){
									output += ' flickr_caching='+flickr_caching;
								}
								if(output.length > ol && flickr_link != '' && flickr_link != 'default' && flickr_link != undefined){
									output += ' flickr_link='+flickr_link;
								}
							}else{
								var instagram_feed = $('#jig-sc-editor .jig_settings_group_instagram input[name="instagram_feed"]').val(),
									instagram_recents = $('#jig-sc-editor .jig_settings_group_instagram input[name="instagram_recents"]').val(),
									instagram_liked = $('#jig-sc-editor .jig_settings_group_instagram input[name="instagram_liked"]').val(),
									instagram_tag = $('#jig-sc-editor .jig_settings_group_instagram input[name="instagram_tag"]').val(),
									instagram_location = $('#jig-sc-editor .jig_settings_group_instagram input[name="instagram_location"]').val(),
									instagram_tag_filter = $('#jig-sc-editor .jig_settings_group_instagram input[name="instagram_tag_filter"]').val(),
									instagram_caching = $('#jig-sc-editor .jig_settings_group_instagram input[name="instagram_caching"]').val(),
									instagram_link = $('#jig-sc-editor .jig_settings_group_instagram select[name="instagram_link"] option:selected').val();
								if(instagram_feed != "" || instagram_recents != "" || instagram_liked != "" || instagram_tag != "" || instagram_location != "" ){
									ol = output.length;
									if(instagram_feed != ""){
										output += ' instagram_feed='+instagram_feed;
									}else if(instagram_recents != ""){
										output += ' instagram_recents='+instagram_recents;
									}else if(instagram_liked != ""){
										output += ' instagram_liked='+instagram_liked;
									}else if(instagram_tag != ""){
										output += ' instagram_tag='+instagram_tag;
									}else if(instagram_location != ""){
										output += ' instagram_location='+instagram_location;
									}
									if(output.length > ol){
										output += addUserTextValues('instagram_caching',instagram_caching);
										output += addUserTextValues('instagram_link',instagram_link);
										output += addUserTextValues('instagram_tag_filter',instagram_tag_filter);
									}
								}else{

									var rss_url = $('#jig-sc-editor .jig_settings_group_rss textarea[name="rss_url"]').val(),
										rss_links_to = $('#jig-sc-editor .jig_settings_group_rss select[name="rss_links_to"] option:selected').val(),
										rss_description = $('#jig-sc-editor .jig_settings_group_rss select[name="rss_description"] option:selected').val(),
										rss_excerpt_length = $('#jig-sc-editor .jig_settings_group_rss input[name="rss_excerpt_length"]').val(),
										rss_excerpt_ending = $('#jig-sc-editor .jig_settings_group_rss input[name="rss_excerpt_ending"]').val(),
										rss_link = $('#jig-sc-editor .jig_settings_group_rss select[name="rss_link"] option:selected').val(),
										rss_link_text = $('#jig-sc-editor .jig_settings_group_rss input[name="rss_link_text"]').val(),
										rss_caching = $('#jig-sc-editor .jig_settings_group_rss input[name="rss_caching"]').val();
									if(rss_url != ''){
										output += ' rss_url='+rss_url;
										output += addUserTextValues('rss_links_to',rss_links_to);
										output += addUserTextValues('rss_description',rss_description);
										if(rss_excerpt_length != ""){
											output += ' rss_excerpt_length='+rss_excerpt_length;
										}
										output += addUserTextValues('rss_excerpt_ending',rss_excerpt_ending);
										output += addUserTextValues('rss_link',rss_link);
										output += addUserTextValues('rss_link_text',rss_link_text);
										if(rss_caching != ""){
											output += ' rss_caching='+rss_caching;
										}
									}else{
										<?php
										if(isset($wpdb->nggallery) !== false){		
										?>
										var ng_gallery = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_gallery"] option:selected').val() || $('#jig-sc-editor .jig_settings_group_nextgen input[name="ng_gallery[]"]:checked').map(function () {return this.value;}).get().join(","),
											ng_album = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_album"] option:selected').val() || $('#jig-sc-editor .jig_settings_group_nextgen input[name="ng_album[]"]:checked').map(function () {return this.value;}).get().join(","),
											ng_pics = $('#jig-sc-editor .jig_settings_group_nextgen input[name="ng_pics"]').val(),
											ng_tags_gallery = $('#jig-sc-editor .jig_settings_group_nextgen input[name="ng_tags_gallery"]').val(),
											ng_tags_album = $('#jig-sc-editor .jig_settings_group_nextgen input[name="ng_tags_album"]').val(),
											ng_recent_images = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_recent_images"] option:selected').val(),
											ng_random_images = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_random_images"] option:selected').val() || $('#jig-sc-editor .jig_settings_group_nextgen input[name="ng_random_images[]"]:checked').map(function () {return this.value;}).get().join(","),
											ng_count = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_count"] option:selected').val(),
											ng_lightbox_gallery = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_lightbox_gallery"] option:selected').val(),
											ng_description = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_description"] option:selected').val(),
											ng_intersect_tags = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_intersect_tags"] option:selected').val();
										if((ng_gallery !== 'default' && ng_gallery !== '')
												|| (ng_album !== 'default' && ng_album !== '')
												|| ng_pics !== ''
												|| ng_tags_gallery !== ''
												|| ng_tags_album !== ''
												|| ng_recent_images !== 'default'
												|| (ng_random_images !== 'default' && ng_random_images !== '')
											){
											if(ng_pics !== ''){
												output += ' ng_pics='+ng_pics;
											}else if(ng_recent_images !== 'default'){
												output += ' ng_recent_images='+ng_recent_images;
											}else if(ng_random_images !== 'default' && ng_random_images !== ''){
												output += ' ng_random_images='+ng_random_images;
											}else if(ng_tags_gallery !== ''){
												output += addUserTextValues('ng_tags_gallery',ng_tags_gallery);
												if(ng_intersect_tags !== 'default'){
													output += ' ng_intersect_tags='+ng_intersect_tags;
												}
											}else{
												if(ng_gallery !== 'default' && ng_gallery !== ''){
													output += ' ng_gallery='+ng_gallery;
												}else if(ng_album !== 'default' && ng_album !== ''){
													output += ' ng_album='+ng_album;
												}else if(ng_tags_album !== ''){
													output += addUserTextValues('ng_tags_album',ng_tags_album);									
												}
												

												var ng_breadcrumb = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_breadcrumb"] option:selected').val();
												if(ng_breadcrumb !== 'default'){
													output += ' ng_breadcrumb='+ng_breadcrumb;
													var ng_bc_separator = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_bc_separator"] option:selected').val(),
														ng_bc_base = $('#jig-sc-editor .jig_settings_group_nextgen input[name="ng_bc_base"]').val(),
														ng_bc_home = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_bc_home"] option:selected').val(),
														ng_bc_home_text = $('#jig-sc-editor .jig_settings_group_nextgen input[name="ng_bc_home_text"]').val(),
														ng_bc_home_clickable = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_bc_home_clickable"] option:selected').val(),
														ng_bc_last_clickable = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_bc_last_clickable"] option:selected').val(),
														ng_bc_top_level = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_bc_top_level"] option:selected').val(),
														ng_bc_add_separator = $('#jig-sc-editor .jig_settings_group_nextgen select[name="ng_bc_add_separator"] option:selected').val();
													if(ng_bc_separator !== 'default'){
														output += ' ng_bc_separator='+ng_bc_separator;
													}
													output += addUserTextValues('ng_bc_base',ng_bc_base);
													if(ng_bc_home !== 'default'){
														output += ' ng_bc_home='+ng_bc_home;
													}
													output += addUserTextValues('ng_bc_home_text',ng_bc_home_text);
													if(ng_bc_home_clickable !== 'default'){
														output += ' ng_bc_home_clickable='+ng_bc_home_clickable;
													}
													if(ng_bc_last_clickable !== 'default'){
														output += ' ng_bc_last_clickable='+ng_bc_last_clickable;
													}
													if(ng_bc_top_level !== 'default'){
														output += ' ng_bc_top_level='+ng_bc_top_level;
													}
													if(ng_bc_add_separator !== 'default'){
														output += ' ng_bc_add_separator='+ng_bc_add_separator;
													}
												}
											}
											if(ng_count !== 'default'){
												output += ' ng_count='+ng_count;
											}
											if(ng_lightbox_gallery !== 'default'){
												output += ' ng_lightbox_gallery='+ng_lightbox_gallery;
											}
											if(ng_description !== 'default'){
												output += ' ng_description='+ng_description;
											}
										}
										<?php }; ?>
									}
								}
							}
						}
					}
				

					output += ']';
					$("#outputShortcode").val(output)
				}
				function loadFacebookValues(){
					$("#"+facebook['facebook_id']).click();
				}
				function loadFacebookAlbumCover(element){
					element.find('.fbMouseIndicator').removeClass('fbStandby').addClass('fbLoading').text("<?php _e('loading', 'jig_td'); ?>")
					$.post(
								"<?php echo admin_url('admin-ajax.php'); ?>",						
								{
									'action': 'jig_get_fb_album_cover_on_demand',
									'security': '<?php echo wp_create_nonce("jig_get_fb_album_cover_on_demand") ?>',
									'album_for_cover_url' : element.attr('data-album-for-cover-url')
								},
								function(data) {
									if(data['img']){
										element.removeClass('fbSkipImg').find('.fbAlbumToLoad').after(data['img']);
										element.find('img').load(function(){									
														$(this).fadeIn(300);
														element.find('.fbMouseIndicator').fadeOut(300,function(){$(this).remove()})
										}).error(function(){
											element.find('.fbMouseIndicator').fadeOut(300,function(){$(this).remove()})
											element.addClass('fbNoImg')
											.find('.fbAlbumToLoad').removeClass('fbAlbumToLoad').addClass('fbAlbumError').text("<?php _e('error loading cover photo, album is now disabled to prevent further errors', 'jig_td'); ?>").siblings('.fbAlbumCount').text("0");
											if(element.hasClass('fbSelectedAlbum')){
												element.removeClass("fbSelectedAlbum");
												$("#facebook input[name='facebook_album']").val('');
											}
										})
									}else if(data['error'] == 'empty'){
										element.removeClass('fbSkipImg').addClass('fbNoImg')
										.find('.fbAlbumToLoad').removeClass('fbAlbumToLoad').addClass('fbAlbumCantLoad').text("<?php _e('no photos in this album', 'jig_td'); ?>").siblings('.fbAlbumCount').text("0");
										if(element.hasClass('fbSelectedAlbum')){
											element.removeClass("fbSelectedAlbum");
											$("#facebook input[name='facebook_album']").val('');
										}
										element.find('.fbMouseIndicator').remove()
									}							
								},
								'json').error(function(){
											element.find('.fbMouseIndicator').fadeOut(300,function(){$(this).remove()})
											element.addClass('fbNoImg')
											.find('.fbAlbumToLoad').removeClass('fbAlbumToLoad').addClass('fbAlbumError').text("<?php _e('AJAX error, album is now disabled to prevent further errors', 'jig_td'); ?>").siblings('.fbAlbumCount').text("0");
											if(element.hasClass('fbSelectedAlbum')){
												element.removeClass("fbSelectedAlbum");
												$("#facebook input[name='facebook_album']").val('');
											}
											element.find('.fbMouseIndicator').remove()
										});
				}
				function loadFlickrValues(){
					if(flickr['flickr_user']){
						$("#"+flickr['flickr_user']).click()
						if($("#"+flickr['flickr_user']).length == 0){
							flickr = undefined;
						}
					}else if(flickr['flickr_favorites']){
						$("#"+flickr['flickr_favorites']).click()
						if($("#"+flickr['flickr_favorites']).length == 0){
							flickr = undefined;
						}
					}else if(flickr['flickr_photostream']){
						$("#"+flickr['flickr_photostream']).click()
						if($("#"+flickr['flickr_photostream']).length == 0){
							flickr = undefined;
						}
					}
				}
				function loadFlickrElementCover(element){
					element.find('.fliMouseIndicator').removeClass('fliStandby').addClass('fliLoading').text("...");
					var img = '<div class="fliElementPhoto"><img src="'+element.attr('data-cover')+'" /></div>';
					element.removeClass('fliSkipImg').find('.fliElementToLoad').after(img);
					element.find('img').load(function(){									
									$(this).fadeIn(300);
									element.find('.fliMouseIndicator').fadeOut(300,function(){$(this).remove()});
					}).error(function(){
						element.find('.fliMouseIndicator').fadeOut(300,function(){$(this).remove()});
						element.addClass('fliNoImg')
						.find('.fliElementToLoad').removeClass('fliElementToLoad').addClass('fliElementError').text("<?php _e('error', 'jig_td'); ?>").siblings('.fliElementCount').text("0");
						if(element.hasClass('fliSelectedElement')){
							element.removeClass("fliSelectedElement");
							$("#fliRow input").val('');
						}
					})
				}
				function loadInstagramValues(){
					if(instagram['instagram_feed']){
						$('.igFeedBtn').click();
					}else if(instagram['instagram_recents']){
						if($('.igRecentsBtn').attr('data-instagram-user-id') == instagram['instagram_recents']){
							$('.igRecentsBtn').click();
						}else{
							$('.igAnyRecentsBtn').click();
						}
					}else if(instagram['instagram_liked']){
						$('.igLikedBtn').click();
					}else if(instagram['instagram_tag']){
						$('.igByTagBtn').click();
					}else if(instagram['instagram_location']){
						$('.igByLocationBtn').click();
					}
				}
				function templateTag(){
					if($('#jig-sc-editor input[name="id"]').val() != ''
						|| $('input[name="ids"]').val() != ''
						|| $('input[name="include"]').val() != ''
						|| ($('input[name="facebook_id"]').val() != ''
							&& $('input[name="facebook_album"]').val() != '')
						|| ($('input[name="flickr_user"]').val() != ''
							&& ($('input[name="flickr_group"]').val() != ''
								||  $('input[name="flickr_photoset"]').val() != ''
								||  $('input[name="flickr_gallery"]').val() != '')
							)
						|| $('input[name="flickr_photostream"]').val() != ''
						|| $('input[name="flickr_favorites"]').val() != ''
						|| $('select[name="recent_posts"] option:selected').val() == "yes"
						|| ($('input[name="ng_pics"]').length !== 0 // Only if NextGEN is installed!
							&& ($('select[name="ng_gallery"] option:selected').val() != "default"
								|| $('select[name="ng_album"] option:selected').val() != "default"
								|| $('select[name="ng_recent_images"] option:selected').val() != "default"
								|| $('select[name="ng_random_images"] option:selected').val() != "default"
								|| $('input[name="ng_pics"]').val() != ''
								|| $('input[name="ng_tags_gallery"]').val() != ''
								|| $('input[name="ng_tags_album"]').val() != ''
								// Multi-selection for NG
								|| $('input[name="ng_gallery[]"]:checked').length > 0 
								|| $('input[name="ng_album[]"]:checked').length > 0
								|| $('input[name="ng_random_images[]"]:checked').length > 0
								)
							)
						|| $('textarea[name="rss_url"]').val() != ''
						){
						generateShortcode();
						var shortcode = $("#outputShortcode").val();

						var matches = shortcode.match(/([a-z_]*?)=([\d\sa-zA-Z\-_'\/"(),.@!?#:]*)(?= [a-z_]*?|])/g)
						if(matches){
							var outputTemplateTag = 'get_jig(array(';
							var matches_length = matches.length;
							for(var i = 0; i<matches_length; i++){
								var attr = matches[i].split("=");
								outputTemplateTag += "'"+attr[0]+"' => '"+attr[1]+"', ";
							}
							outputTemplateTag = outputTemplateTag.substring(0,outputTemplateTag.length-2);
							outputTemplateTag += '));'

							var quotes = {" '\"'":" '\"", "'\"'":"\"'"};

							for (var val in quotes)
							    outputTemplateTag = outputTemplateTag.replace(new RegExp(val, "g"), quotes[val]);

							$("#templateTagContainer").show().find("#templateTag").text('<'+'?php '+outputTemplateTag+' ?'+'>').next().show()
							$("#doShortcodeContainer").show().find("#doShortcode").text('<'+"?php echo do_shortcode('"+shortcode+"'); ?"+'>').next().show()
						}

					}else{
						$("#templateTagContainer").show().find("#templateTag").text("<?php _e('Please set up IDs (images) or an ID (post/page) in the General settings or use the Recent posts feature, otherwise the template tag will not work as it has no image source. You can also use Facebook, Flickr, NextGEN, Instagram or RSS feeds instead.', 'jig_td'); ?>").next().hide()
						$("#doShortcodeContainer").hide().next().hide()
					}
				}
				$('.abilityToMorph').change(function(){ // Changes option to checkboxes input where multiple options are available and requested
					if($(this).val() === ''){
						$(this).siblings('.minihelp').removeClass('minihelpShort').addClass('minihelpCheckbox');
						var groupName = $(this).attr('name');
						$(this).wrap('<div class="checkboxes" />');
						$(this).find('option').each(function(){
							var $this = $(this),
								val = $this.attr('value'),
								id = groupName+'['+val+']';

							if(val === ''){
								$this.unwrap();
								$this.remove();
								return;
							}
							if($this.hasClass('noCheckboxForThis')){
								$this.remove();
								return;
							}
							var checked = '';
							if(typeof originalValueForMorphable[groupName] !== 'undefined'){
								if($.inArray(val, originalValueForMorphable[groupName]) > -1){
									checked = ' checked';
								}
							}else if($this.hasClass('selectedByDefault')){
								checked = ' checked';
							}
							$(this).after('<input type="checkbox" class="checkbox" id="'+id+'" name="'+groupName+'[]"'+checked+' value="'+val+'"><label class="checkboxLabel" for="'+id+'">'+$this.text()+'</label>');
							$this.remove();
						})
					}
				})
				$(".tabButton").click(function(){
					var target = "#jig"+$(this).attr("id").substring(6);
					$(".selectedTab").removeClass("selectedTab");
					$(target).addClass("selectedTab").next().addClass("selectedTab");
					$(".selectedTabButton").removeClass("selectedTabButton");
					$(this).addClass("selectedTabButton");
				})
				
				$(window).load(function(){
					$('#jig-sc-editor-loading').hide();
					$('#jig-sc-editor').show();
					$('#jigColorHelperPick').click(function(event){
						tinyMCEPopup.pickColor(event,'jigColorHelperField');
						parent.jQuery('#mceModalBlocker').css('z-index',parent.jQuery('#mceModalBlocker').css('z-index')-1);
					})
					
					init();
				})
			})(jQuery)
		</script>
	</body>
</html>