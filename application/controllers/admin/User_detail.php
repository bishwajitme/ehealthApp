<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_detail extends MY_Controller
{
	/*--------------------------------------------------------------*/
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
	}

	/* ............................................................. */
	public function index()
	{
		// Check Administrator Login
		if ($this->is_online AND $this->sess_identifier==$this->admin_identifier) 
		{
			/* ------------------------- User Detail ------------------------- */
			$user_id 	= $this->input->post('user_id');
			$user_email = $this->input->post('user_email');
		
			// If user open this page directly without user card link, redirect all users page
			if (!$user_id) {
				redirect('admin/users');
			}
			else
			{
				// Check if email is empty or not
				if ($user_email != '') {
					// If email is not null, get All Related Accounts
					$data["related_accounts"] 	= $this->cisociall_model->get_related_accounts($user_email, $user_id);
				}
				else
				{
					$data["related_accounts"] 	= 'NULL';
				}
				// Get User Profile
				$data["user_detail"]			= $this->cisociall_model->get_user_profile($user_id);		
				$this->load->view('public/ehealth/admin_user_profile_view',$data);
			}
		}
		else
		{
			$this->load->view('public/ehealth/admin_error_view');
		}
	}
	/*--------------------------------------------------------------*/
} // Class End