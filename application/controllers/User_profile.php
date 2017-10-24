<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile extends MY_Controller 
{
	/*--------------------------------------------------------------*/
	public function index()
	{
		$user_id 	= $this->input->post('user_id');
		$user_email = $this->input->post('user_email');
		
		// If user open this page directly without user card link, redirect all users page
		if (!$user_id) {
			redirect('users');
		}
		else
		{
			// Check if email is empty or not
			if ($user_email != '') {
				// If email is not null, get All Related Accounts
				$data["related_accounts"] 	= $this->Sociall_model->get_related_accounts($user_email, $user_id);
			}
			else
			{
				$data["related_accounts"] 	= 'NULL';
			}
			// Get User Profile
			$data["user_detail"]			= $this->Sociall_model->get_user_profile($user_id);
			$this->load->view('public/ehealth/user_profile_view',$data);
		}
	}
	/*--------------------------------------------------------------*/
} // Class End