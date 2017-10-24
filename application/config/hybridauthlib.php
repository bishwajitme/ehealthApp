<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => 'index.php/social/endpoint',

		"providers" => array (
		/* ------------------------------------------------------------------------------------------ */
	        "Facebook" => array (
	          	"enabled" => true,
                "keys"    => array ( "id" => "913744255441675", "secret" => "9eb53f3b62590f256c79a81c08c37bfa" ),
	          	"scope"   => ['email','public_profile','user_friends']
	    	),
	    	
			"Google" => array (
				"enabled" => true,
                "keys"    => array ( "id" => "132999679067-2gt8kje8tacmq2j3td0oihmuaqmfu7m7.apps.googleusercontent.com", "secret" => "LjniaDWr4kn_Xw8QFCGpmQ0X" ),
				"redirect_uri"=>"http://demositestore.com/ehealth/index.php/social/endpoint?hauth.done=Google"
			),

			"Twitter" => array (
				"enabled" => true,
                "keys"    => array ( "key" => "0W3BWVPZWMRaq9KCeamMzmPt4", "secret" => "1mFZptvXFqs5WU7xbdWr99zSRKXbB7etFrl6GRXbfzZluiQN7t" )
			),
		/* ------------------------------------------------------------------------------------------ */
		),
	);