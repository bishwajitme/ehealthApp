<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends MY_Controller 
{
	/*--------------------------------------------------------------*/
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('hybridauthlib', 'user_agent'));
	}

	/*--------------------------------------------------------------*/
	public function index()
	{
		// Delete old sessions before 10 Minutes
		$data["delete_old_sessions"] = $this->Sociall_model->delete_old_sessions();
		
		if ($this->is_online) 
		{
			//	$data["user_loggedin_detail"]	= $this->Sociall_model->already_login($this->sess_identifier);
                $loggin_user_id = $_SESSION['userData']['userID'];
                       if ($loggin_user_id == 1) {
                            $this->load->view('public/ehealth/loggedin_view_physician', $data);
                        }
                        if ($loggin_user_id == 2) {
                            $this->load->view('public/ehealth/loggedin_view_researcher', $data);
                        }
                        if ($loggin_user_id == 3 | $loggin_user_id == 4) {
                            $this->load->view('public/ehealth/loggedin_view_patient', $data);
                        }

		}
		// If it is not online: If logout or dont logged with any provider. 
		else
		{
			$data['providers'] = $this->hybridauthlib->getProviders();
			$this->load->view('public/ehealth/login_view', $data);
		}
	}

	/*--------------------------------------------------------------*/
	public function login($provider)
	{
		if ($this->is_online OR !$provider) 
		{
			redirect('social');	
		}
		// If it is not online: If logout or dont logged with any provider. 
		else
		{
			// Begin to Hybridauth login process.
			try
			{
				// If provider name setup in config/hybridauth file
				if ($this->hybridauthlib->providerEnabled($provider))
				{
					// If hybridauth login is completed.
					$service = $this->hybridauthlib->authenticate($provider);

					if ($service->isUserConnected())
					{
						// Get all data about provider
						$user_profile = $service->getUserProfile();

						$identifier_new = $user_profile->identifier;
                           if($provider == "Twitter"){
                               $userID = 1;
                           }
                       if($provider == "Facebook"){

                               if($identifier_new == 127162278042058){
                                   $userID = 4;
                               }
                               else{
                                   $userID = 3;
                               }
                        }
                        if($provider == "Google"){
                            $userID = 2;
                        }

                      $data_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=User&id=';
                        $data_url = $data_url.$userID;
                        $user_data_array = simplexml_load_file($data_url);
                        $user_data_array = json_decode(json_encode($user_data_array),TRUE);

					// Prepare this data for Database Input
                        foreach ( $user_data_array as $udata) {
                            $user_data['username'] = $udata['username'];
                            $user_data['name'] = $udata['username'];
                            $user_data['email'] = $udata['email'];
                            $user_data['role_ID'] = $udata['Role_IDrole'];
                            $user_data['organizationId'] = $udata['Organization'];
                        }

                        $user_data['userID']		    = $userID;
                        $user_data['identifier']		= $identifier_new;
                        $user_data['ip_address'] 		= $this->input->ip_address();
                        $user_data['provider_name']		= $provider;
                        $user_data['photoURL']			= $user_profile->photoURL;


						/* ------------------------------------------------------------ */


						// Insert or update user data in database
						$user_data_id = $userID;

							// Check user data insert or update status
							if (!empty($user_data_id))
							{
								// Add User is Online Session Value
								$user_data['is_online'] 		= TRUE;
								$data['userData'] 				= $user_data;
								// Create Session for this user
								$this->session->set_userdata('userData', $user_data);
							}
							else
							{
								$data['userData'] = array();
							}

						redirect('social');
					}
					else // Cannot authenticate user
					{
						show_error('Cannot authenticate user');
					}
				}
				else // This service is not enabled.
				{
					redirect('error_404');
				}
			}
			catch(Exception $e)
			{
				$error = 'Unexpected error';
				switch($e->getCode())
				{
					case 0 : $error = 'Unspecified error.'; break;
					case 1 : $error = 'Cisociall configuration error.'; break;
					case 2 : $error = 'Provider not properly configured.'; break;
					case 3 : $error = 'Unknown or disabled provider.'; break;
					case 4 : $error = 'Missing provider application credentials.'; break;
					case 5 : 
					         if (isset($service))
					         {
					         	$service->logout();
					         }
					         show_error('Authentification failed. User has cancelled the authentication or the provider refused the connection.');
						break;
					case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
						$service->logout();
					    break;
					case 7 : $error = 'User not connected to the provider.'; 
						$service->logout();
						break;
					case 8 : echo "Provider does not support this feature."; break;
				}

				if (isset($service))
				{
					$service->logout();
				}
				show_error('Error authenticating user.');
			}
		}
	}

	/*--------------------------------------------------------------*/
	public function endpoint()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			$_GET = $_REQUEST;
		}
		require_once (APPPATH.'/third_party/hybridauth/index.php');
	}

	/*--------------------------------------------------------------*/
	public function logout(){

		// Delete Cookies
		$this->load->helper('cookie');
		delete_cookie('cisociallsessions');

		// Delete Sessions
		$this->hybridauthlib->logoutAllProviders();
		$this->session->sess_destroy();

		redirect('social');
	}


    public function patients()
    {
        // Delete old sessions before 10 Minutes
       // $data["delete_old_sessions"] = $this->Sociall_model->delete_old_sessions();

        $loggin_user_id = $_SESSION['userData']['userID'];

       // echo "user: ".$patient_id ;
        if ($this->is_online)
        {
            //	$data["user_loggedin_detail"]	= $this->Sociall_model->already_login($this->sess_identifier);

            if ($loggin_user_id == 2) {
                $this->load->view('public/ehealth/patient_view_researcher');
            }
            else{
                $this->load->view('public/ehealth/no_permission');
        }

        }
        // If it is not online: If logout or dont logged with any provider.
        else
        {
            $data['providers'] = $this->hybridauthlib->getProviders();
            $this->load->view('public/ehealth/login_view', $data);
        }
    }

    /*--------------------------------------------------------------*/

    public function add_annotation()
    {
      //  $this->form_validation->set_rules('annotation', 'annotation', 'required');

                $this->load->view('public/ehealth/add_annotation');

    }
    public function submit_annotation(){
        $result = $this->Sociall_model->submit_annotation();
        redirect(base_url());
    }


	/*--------------------------------------------------------------*/
	public function delete()
	{
		$user_id 			= $this->uri->segment(3);
		$user_identifier 	= $this->uri->segment(4);

		if ($this->is_online AND $user_identifier=$this->sess_identifier) {
			$this->Sociall_model->delete_account($user_id, $user_identifier);
			redirect('social/logout');
		}
		else
		{
			redirect('social');
		}
	}
	/*--------------------------------------------------------------*/
} // Class End