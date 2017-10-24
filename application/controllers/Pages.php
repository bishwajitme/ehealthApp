<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{
/*--------------------------------------------------------------*/
    public function __construct()
        {
            parent::__construct();
        }
    public function privacy()
        {
        $this->load->view('public/ehealth/privacy_view');
        }

    public function tos()
    {
        $this->load->view('public/ehealth/tos_view');
    }

    }