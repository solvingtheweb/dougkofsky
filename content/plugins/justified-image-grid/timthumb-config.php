<?php
	define ('BLOCK_EXTERNAL_LEECHERS', true); // Hotlinking protection
	define ('ALLOW_ALL_EXTERNAL_SITES', true); // Ability to load images from anywhere (Facebook, Flickr, Instagram, RSS etc.)
	define ('MAX_WIDTH', 2000);
	define ('MAX_HEIGHT', 2000);
	// Exception list to blocking external leechers (hotlinking sites) be explicit about the full hosts
	$ALLOWED_HOTLINKERS = array(
		'SAME_HOST', // SAME_HOST allows child sites (subdomains for WMPL, CDN) e.g. en.example.com or cdn.example.co.uk
		//'example.com', // allow example.com NOT subdomain.example.com or www.example.com
		//'*example.com', // allow subdomain.example.com and also example.com and www.example.com
		//'*.example.com', //  allow www.example.com NOT example.com
		'googleusercontent.com' // Google's cached view
	);
?>