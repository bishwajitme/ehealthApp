<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends MY_Controller 
{
	/*--------------------------------------------------------------*/
	public function index()
	{
		$this->load->view('public/ehealth/error_404_view');
	}
	/*--------------------------------------------------------------*/
} // Class End