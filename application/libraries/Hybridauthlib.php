<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/third_party/hybridauth/Hybrid/Auth.php';

class Hybridauthlib extends Hybrid_Auth
{
	function __construct($config = array())
	{
		$ci =& get_instance();
		$ci->load->helper('url_helper');

		$config['base_url'] = site_url($config['base_url']);
		parent::__construct($config);
	}

	/**
	 * @deprecated
	 */
	public static function serviceEnabled($service)
	{
		return self::providerEnabled($service);
	}

	public static function providerEnabled($provider)
	{
		return isset(parent::$config['providers'][$provider]) && parent::$config['providers'][$provider]['enabled'];
	}
}