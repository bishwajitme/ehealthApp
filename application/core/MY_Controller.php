<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	/*--------------------------------------------------------------*/
	public function __construct()
	{
		parent::__construct();
		$this->config->load('configsocial'); // social Config Settings
		$this->load->database(); // Database 
		$this->load->model('Sociall_model'); // social Base Model
		$this->load->library(array('session', 'form_validation', 'rssparser'));
		$this->load->helper(array('url', 'form', 'language'));
		$this->lang->load('sociall');
		

		/* For is_online and admin login control */
		$this->admin_identifier = $this->config->item('admin_identifier');
		$this->google_map_api 	= $this->config->item('google_map_api');
		$this->is_online 		= $this->session->userdata('userData')['is_online'];
		$this->sess_ip_address 	= $this->session->userdata('userData')['ip_address'];
		$this->sess_identifier 	= $this->session->userdata('userData')['identifier'];
		$this->sess_photoURL 	= $this->session->userdata('userData')['photoURL'];
	}
	/*--------------------------------------------------------------*/
} // Class End

