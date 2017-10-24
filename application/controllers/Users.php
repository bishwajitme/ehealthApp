<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
  /*--------------------------------------------------------------*/
  public function __construct()
  {
    parent::__construct();
    $this->load->library(array('hybridauthlib', 'pagination'));
  }

  /*--------------------------------------------------------------*/
  public function index()
  {
      if ($this->is_online) {

        $segment = $this->uri->segment(3);

    		// Base settings for pagination
    		$config['base_url']         = base_url('users/index');
    		$config['total_rows']       = $this->db->get('user')->num_rows();
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

        $data["social_users"] = $this->Sociall_model->get_all_users_orderby_modified_desc($config['per_page'], $segment);
    		$this->load->view('public/ehealth/all_users_view',$data);
      }
      else
      {
        $this->load->view('public/ehealth/all_users_alert_view');
      }
  }

  /*--------------------------------------------------------------*/
    public function provider($provider)
    {
      if ($this->is_online) {

          if (!$provider) {
            redirect('users');
          }
          else
          {
            if ($this->hybridauthlib->providerEnabled($provider))
            {
              $total_provider_user        = $this->Sociall_model->count_provider_users($provider);
              $segment                    = $this->uri->segment(4);
                          
              // Base settings for pagination
              $config['base_url']         = base_url('users/provider/'.$provider);
              $config['total_rows']       = $total_provider_user;
              $config['per_page']         = 12;
              $config['num_links']        = 4;

              //Bootstrap settings for pagination
              $config['full_tag_open']    = '<ul class="pagination">';
              $config['full_tag_close']   = '</ul>';
              $config['first_link']       = false;
              $config['last_link']        = false;
              $config['first_tag_open']   = '<li>';
              $config['first_tag_close']  = '</li>';
              $config['prev_link']        = '&laquo';
              $config['prev_tag_open']    = '<li class="prev">';
              $config['prev_tag_close']   = '</li>';
              $config['next_link']        = '&raquo';
              $config['next_tag_open']    = '<li>';
              $config['next_tag_close']   = '</li>';
              $config['last_tag_open']    = '<li>';
              $config['last_tag_close']   = '</li>';
              $config['cur_tag_open']     = '<li class="active"><a href="#">';
              $config['cur_tag_close']    = '</a></li>';
              $config['num_tag_open']     = '<li>';
              $config['num_tag_close']    = '</li>';

              $this->pagination->initialize($config);

              $data['get_provider']               = $provider;
              $data['get_total_provider_users']   = $total_provider_user;

              // Get Total Online Users
              $data["social_users_by_provider"]   = $this->Sociall_model->get_provider_users_for_pagination($config['per_page'],$provider, $segment);
              // Load view
              $this->load->view('public/ehealth/all_users_by_provider_view',$data);
            }
            else
            {
              redirect('users');
            }
          }
      }
      else
      {
        redirect('users');
      }
    }
  /*--------------------------------------------------------------*/
} // Class End