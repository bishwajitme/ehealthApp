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
                <li><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo lang('nav_home');?></a></li>
				<li><a href="<?php echo base_url('users');?>"><i class="fa fa-users" aria-hidden="true"></i> <?php echo lang('nav_all_users');?></a></li>
				<li class="active"><a href="<?php echo base_url('user_profile');?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo lang('nav_profile');?></a></li>               
            
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
			<p class="headline_explanation">This is the individual profile page. This page is only accessable by Physician and Researcher. Super admin can also get direct edit link from this page (future scope).</p>
		</div>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>"><?php echo lang('nav_home');?></a></li>
			<li><a href="<?php echo base_url('users');?>"><?php echo lang('nav_all_users');?></a></li>
			<li class="active"><?php echo lang('nav_profile');?></li>
			<li class="pull-right go_back"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> <?php echo lang('nav_back');?></a></li>
		</ol>

		<!-- ''''''''''''''''''''''''' User Profile ''''''''''''''''''''''''' -->
		<div class="col-sm-12 user_profile">
		<?php foreach ($user_detail as $get_user_detail) { ?>

			<div class="col-sm-3 user_profile_left">
			<!-- ............. Circle Image ............. -->
					<?php
			if (!empty($get_user_detail->photoURL))
				{ ?>
				<a href="<?php echo $get_user_detail->photoURL; ?>" class="popup_image">
				<img src="<?php echo $get_user_detail->photoURL;?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>
			<?php }  else {
					if ($get_user_detail->gender == 'male') { ?>
						<a href="<?php echo base_url('themes/public/ehealth/img/user_male.png');?>" class="popup_image">
						<img src="<?php echo base_url('themes/public/ehealth/img/user_male.png');?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>	
					<?php } else if ($get_user_detail->gender == 'female') { ?>
						<a href="<?php echo base_url('themes/public/ehealth/img/user_female.png');?>" class="popup_image">
						<img src="<?php echo base_url('themes/public/ehealth/img/user_female.png');?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>
					<?php } else { ?>
					<a href="<?php echo base_url('themes/public/ehealth/img/yoda.png');?>" class="popup_image">
					<img src="<?php echo base_url('themes/public/ehealth/img/yoda.png');?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>	
					<?php }
			} ?>
			</div>
			<div class="col-sm-9 user_profile_right">
			<?php
            $role_name = $this->Sociall_model->get_role_name($get_user_detail->role_ID);
           if ($get_user_detail->ip_address==$this->sess_ip_address AND $get_user_detail->identifier==$this->sess_identifier) { echo '<p><span class="col-xs-12"><i class="fa fa-circle" aria-hidden="true"></i> '.lang("profile_you_are_online").'</span></p>'; }
            if (!empty($get_user_detail->name)) { echo '<p><span class="col-xs-4"><b>Name</b></span><span class="col-xs-1">:</span><span class="col-xs-7">'.$get_user_detail->name.'</span></p>';}
            echo '<p class="role_name"><span class="col-xs-4"><b>Role</b></span><span class="col-xs-1">:</span><span class="col-xs-7">'.$role_name.'</span></p>';
            echo '<p><span class="col-xs-4"><b>Provider</b></span><span class="col-xs-1">:</span><span class="col-xs-7">'.$get_user_detail->provider_name.'</span></p>';
				if (!empty($get_user_detail->displayName)) { echo '<p><span class="col-xs-4"><b>'.lang('profile_user_name').'</b></span><span class="col-xs-1">:</span><span class="col-xs-7">'.$get_user_detail->displayName.'</span></p>';}
				if (!empty($get_user_detail->email)) { echo '<p><span class="col-xs-4"><b>Email</b></span><span class="col-xs-1">:</span><span class="col-xs-7" style="text-transform:none;">'.$get_user_detail->email.'</span></p>';}
				?>
			</div>
		<?php } ?>
		</div>
		<!-- '''''''''''''''''''''''''''''''''''''''''''''''''' -->


	</div>
</div>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>