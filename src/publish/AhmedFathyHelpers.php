<?php 
return [
	/* 
	| You Can Add Costom Definds And View Variables
	|
	*/
	// System Defines 
	'defines' => [
		'cp' => 'adminpanel/',
		'cpanel' => 'adminpanel',
		'upload_path' => public_path('upload').'/',
		'IMG' => public_url('public/assets/cpanel/img').'/',
		'upload_public_url' => public_url('public/upload').'/',
		'flugs_public_url' => public_url('public/assets/cpanel/img/settings/flags').'/',
		'flugs_path' => public_path('assets/cpanel/img/settings/flags').'/',
		'flugs_url' => public_url('assets/cpanel/img/settings/flags').'/',
		'NotficationSound' => public_url('public/assets/cpanel/sounds/notfication.mp3'),

	],

	// View Variables
	'viewShareVariables' => [
		'cpanel' => public_url('public/assets/cpanel').'/',
		'logo' => public_url('public/assets/cpanel/img/logo.png'),
		'icon' => public_url('public/assets/cpanel/img/favicon.png'),
	],


];