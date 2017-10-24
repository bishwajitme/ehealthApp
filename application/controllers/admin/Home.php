<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
	/*--------------------------------------------------------------*/
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cisociall');
		$this->load->helper('number');
	}

	/*--------------------------------------------------------------*/
	public function index()
	{
		// Check Administrator Login
		if ($this->is_online AND $this->sess_identifier==$this->admin_identifier) 
		{
			/* ------------------------- Dashboard ------------------------- */
			$data['disk_totalspace']   			= $this->cisociall->disk_totalspace('/');
			$data['disk_freespace']   			= $this->cisociall->disk_freespace('/');
			$data['disk_usespace']   			= $this->cisociall->disk_usespace('/');
			$data['disk_freepercent']   		= $this->cisociall->disk_freepercent('/', FALSE);
			$data['disk_usepercent']   			= $this->cisociall->disk_usepercent('/', FALSE);
			$data['memory_usage']      			= $this->cisociall->memory_usage();
			$data['memory_peak_usage'] 			= $this->cisociall->memory_peak_usage(TRUE);
			$data['memory_used_percent'] 		= $this->cisociall->memory_used_percent(TRUE, FALSE);

			$data["google_total_users"] 		= $this->cisociall_model->count_provider_users('google');
			$data["facebook_total_users"] 		= $this->cisociall_model->count_provider_users('facebook');
			$data["twitter_total_users"] 		= $this->cisociall_model->count_provider_users('twitter');
			$data["instagram_total_users"] 		= $this->cisociall_model->count_provider_users('instagram');
			$data["linkedin_total_users"] 		= $this->cisociall_model->count_provider_users('linkedin');
			$data["vimeo_total_users"] 			= $this->cisociall_model->count_provider_users('vimeo');
			$data["foursquare_total_users"] 	= $this->cisociall_model->count_provider_users('foursquare');
			$data["dribbble_total_users"] 		= $this->cisociall_model->count_provider_users('dribbble');
			$data["odnoklassniki_total_users"] 	= $this->cisociall_model->count_provider_users('odnoklassniki');
			$data["vkontakte_total_users"] 		= $this->cisociall_model->count_provider_users('vkontakte');
			$data["yandex_total_users"] 		= $this->cisociall_model->count_provider_users('yandex');
			$data["mailru_total_users"] 		= $this->cisociall_model->count_provider_users('mailru');
			$data["px500_total_users"] 			= $this->cisociall_model->count_provider_users('px500');
			$data["twitchtv_total_users"] 		= $this->cisociall_model->count_provider_users('twitchtv');
			$data["bitbucket_total_users"] 		= $this->cisociall_model->count_provider_users('bitbucket');
			$data["github_total_users"] 		= $this->cisociall_model->count_provider_users('github');

			$data["top_providers"] 				= $this->cisociall_model->top_providers('5'); // Top 5 Providers
			$data["top_platforms"] 				= $this->cisociall_model->top_platforms('5'); // Top 5 Platforms
			$data["top_mobiles"] 				= $this->cisociall_model->top_mobiles('5'); // Top 5 Mobiles
			$data["top_browsers"] 				= $this->cisociall_model->top_browsers('5'); // Top 5 Browsers

			// Get All Social Users for Google Map in Admin Dashboard
			$data["all_users_for_google_map"] 	= $this->cisociall_model->get_all_users();

			// Load admin view page
			$this->load->view('public/ehealth/admin_home_view', $data);
		}
		else
		{
			$this->load->view('public/ehealth/admin_error_view');
		}
	}
	/*--------------------------------------------------------------*/
} // Class End