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
                <li class="active"><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo lang('nav_home');?></a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url('social/logout');?>"><img src="<?php echo $this->sess_photoURL;?>" alt="<?php echo lang('profile_user_picture');?>" class="user_photo img-circle" /><span class="nav_log"><?php echo lang('nav_logout');?></span></a></li>
            </ul>
        </div>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="headline">
            <p class="headline_title">User Profile</p>
        </div>



        <!-- ''''''''''''''''''''''''' User Profile ''''''''''''''''''''''''' -->
        <div class="col-sm-12 social_loggedin">

            <div class="col-sm-3 user_profile_left">
                <!-- ''''''''''''''''''''''''' Circle Image ''''''''''''''''''''''''' -->
                <?php
                if (!empty($_SESSION['userData']['photoURL']))
                { ?>
                    <a href="<?php echo $_SESSION['userData']['photoURL']; ?>" class="popup_image">
                        <img src="<?php echo $_SESSION['userData']['photoURL'];?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>
                <?php }  else { ?>
                    <a href="<?php echo base_url('themes/public/ehealth/img/yoda.png');?>" class="popup_image">
                        <img src="<?php echo base_url('themes/public/ehealth/img/yoda.png');?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>
                <?php }
                ?>
            </div>
            <div class="col-sm-9 user_profile_right">
                <?php

                $role_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Role&id=';
                $role_url = $role_url.$_SESSION['userData']['role_ID'];
                $user_role_array = simplexml_load_file($role_url);
                $user_role_array = json_decode(json_encode($user_role_array),TRUE);
                foreach ( $user_role_array as $urole) {
                    $role_Name = $urole['name'];
                }
                $org_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Organization&id=';
                $org_url = $org_url.$_SESSION['userData']['organizationId'];
                $user_org_array = simplexml_load_file($org_url);
                $user_org_array = json_decode(json_encode($user_org_array),TRUE);
                foreach ( $user_org_array as $uorg) {
                    $org_Name = $uorg['name'];
                }




                echo '<p><span class="col-xs-12"><i class="fa fa-circle" aria-hidden="true"></i> '.lang("profile_you_are_online").'</span></p>';
                if (!empty($_SESSION['userData']['username'])) { echo '<p><span class="col-xs-4"><b>'.lang('profile_user_name').'</b></span><span class="col-xs-1">:</span><span class="col-xs-7">'.$_SESSION['userData']['username'].'</span></p>';}
                echo '<p><span class="col-xs-4"><b>Role</b></span><span class="col-xs-1">:</span><span class="col-xs-7">'.$role_Name .'</span></p>';
                if (!empty($_SESSION['userData']['email'])) { echo '<p><span class="col-xs-4"><b>'.lang('profile_email').'</b></span><span class="col-xs-1">:</span><span class="col-xs-7" style="text-transform:none;">'.$_SESSION['userData']['email'].'</span></p>';}
                if (!empty($org_Name)) { echo '<p><span class="col-xs-4"><b>Organization Name</b></span><span class="col-xs-1">:</span><span class="col-xs-7" style="text-transform:none;">'.$org_Name.'</span></p>';}

                ?>
            </div>

        </div>
        <!-- '''''''''''''''''''''''''''''''''''''''''''''''''' -->

        <div class="col-sm-12 physician patient_details">
            <div class="col-sm-8">
                <div class="subheading"><h3>you don't have enough permission to see this page</h3></div>

       <a href="<?php echo base_url(); ?>">Back to Profile page</a>



        </div>


    </div>
</div>



<br/>
<br/>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>