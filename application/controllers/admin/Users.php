<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
	/*--------------------------------------------------------------*/
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
	}

	/*--------------------------------------------------------------*/
	public function index()
	{
		// Check Administrator Login
		if ($this->is_online AND $this->sess_identifier==$this->admin_identifier) 
		{
			/* ------------------------- All Users ------------------------- */
		    $segment = $this->uri->segment(4);

			// Base settings for pagination
			$config['base_url']         = base_url('admin/users/index');
			$config['total_rows']       = $this->db->get('cisociall_users')->num_rows();
			$config['per_page']         = 12;
			$config['num_links']        = 4;

		    //Bootstrap settings for pagination
		    $config['full_tag_open']    = '<ul class="pagination">';
		    $config['full_tag_close'] 	= '</ul>';
		    $config['first_link']       = false;
		    $config['last_link']        = false;
		    $config['first_tag_open'] 	= '<li>';
		    $config['first_tag_close']  = '</li>';
		    $config['prev_link']        = '&laquo';
		    $config['prev_tag_open']    = '<li class="prev">';
		    $config['prev_tag_close'] 	= '</li>';
		    $config['next_link']        = '&raquo';
		    $config['next_tag_open']    = '<li>';
		    $config['next_tag_close'] 	= '</li>';
		    $config['last_tag_open']    = '<li>';
		    $config['last_tag_close'] 	= '</li>';
		    $config['cur_tag_open']     = '<li class="active"><a href="#">';
		    $config['cur_tag_close']    = '</a></li>';
		    $config['num_tag_open']     = '<li>';
		    $config['num_tag_close']    = '</li>';

			$this->pagination->initialize($config);

		    $data["admin_all_users"] = $this->cisociall_model->get_all_users_orderby_modified_desc($config['per_page'], $segment);

			// Load admin view page
			$this->load->view('public/ehealth/admin_users_view', $data);
		}
		else
		{
			$this->load->view('public/ehealth/admin_error_view');
		}
	}
	
	/* ---------------------------------------------------------------------- */
	public function activate($id)
	{
		// Check Administrator Login
		if ($this->is_online AND $this->sess_identifier==$this->admin_identifier)
		{
			$this->cisociall_model->activate($id);
			redirect('admin/users');
		}
		else
		{
			redirect('admin');
		}	
	}

	/* ---------------------------------------------------------------------- */
	public function deactivate($id)
	{
		// Check Administrator Login
		if ($this->is_online AND $this->sess_identifier==$this->admin_identifier)
		{
			$this->cisociall_model->deactivate($id, $this->sess_identifier, $this->admin_identifier);
			redirect('admin/users');
		}
		else
		{
			redirect('admin');
		}	
	}
	/* ---------------------------------------------------------------------- */
} // Class End