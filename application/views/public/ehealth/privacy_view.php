<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('public/ehealth/_parts/header');
?>
    <title><?php echo $this->config->item('site_title'); ?></title>
    </head>
    <body>

<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container-fluid">
        <!-- Load Navbar Header -->
        <?php $this->load->view('public/ehealth/_parts/navbar_header');?>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li ><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo lang('nav_home');?></a></li>
                <li class="active"><a href="<?php echo base_url('');?>/pages/privacy"><i class="fa fa-user-secret" aria-hidden="true"></i> Privacy</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-lock" aria-hidden="true"></i><span class="nav_log"> <?php echo lang('nav_login');?></span></a></li>
            </ul>
        </div>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="headline"><p class="headline_title">Privacy Policy</p></div>
        <div class="privacy_test">
            <ol>
                <li><strong>Permission-based Social Login</strong><br>

                    When choosing to log in to sites using their existing social profiles, users are shown a dialogue asking permission to access specific data points, such as their birthdays or locations, giving users total control over the information they share.
                </li>
                <li><strong>User Data Controls</strong><br>

                    When leveraging eHealth Application's forms for user registration and login, sites can easily expose functionality to their end users, allowing them to 1) download the data the site is storing in order to edit or delete that data as needed, and 2) delete their site account if they so choose.
                </li>
                <li><strong>Administrator Roles & Permissions</strong><br>
                    eHealth App provides robust Roles and Permissions functionality that enables administrators to control the features and data that can be accessed by internal users. An administrator can create user groups and assign access on a very granular level, including by site/app ID, specific service and even API, ensuring end user PII is protected.  </li>

            </ol>

        </div>
    </div>
</div>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>