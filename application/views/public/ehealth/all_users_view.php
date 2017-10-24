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
				<li class="active"><a href="<?php echo base_url('users');?>"><i class="fa fa-users" aria-hidden="true"></i> <?php echo lang('nav_all_users');?></a></li>                
            
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
			<p class="headline_title">All Users</p>
			<p class="headline_explanation">All successfully created users are showing here. I will add filtering option in the future. This section will only be accessed by Logged in users only.</p>
		</div>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>"><?php echo lang('nav_home');?></a></li>
			<li class="active"><?php echo lang('nav_all_users');?></li>
		</ol>
	
		<div class="col-sm-12 total_users"><?php echo lang('gen_total_users');?> <?php echo $this->db->count_all('user'); ?></div>
		<div class="col-sm-12 users_content">

			<?php foreach ($social_users as $get_social_users) { ?>
			<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="thumbnail">
				<div class="inner-triangle" onclick="document.getElementById('sendprofile_<?php echo $get_social_users->userID;?>').submit();"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>

				<form action="<?php echo base_url('user_profile'); ?>" id="sendprofile_<?php echo $get_social_users->userID; ?>" method="post">
				<input type="hidden" name="user_id" value="<?php echo $get_social_users->userID; ?>" />
				<input type="hidden" name="user_email" value="<?php echo $get_social_users->email; ?>" />
				<?php
					$csrf = array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					);
				?>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				</form>

				<!-- ............. Circle Image ............. -->
					<?php
				if (!empty($get_social_users->photoURL))
						{ ?>
						<a href="<?php echo $get_social_users->photoURL;?>" class="popup_image">
						<img src="<?php echo $get_social_users->photoURL;?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>
						<?php } 
				else
					{
					if ($get_social_users->gender == 'male') { ?>
						<a href="<?php echo base_url('themes/public/ehealth/img/user_male.png');?>" class="popup_image">
						<img src="<?php echo base_url('themes/public/ehealth/img/user_male.png');?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>	

						<?php }
					else if ($get_social_users->gender == 'female') { ?>

						<a href="<?php echo base_url('themes/public/ehealth/img/user_female.png');?>" class="popup_image">
						<img src="<?php echo base_url('themes/public/ehealth/img/user_female.png');?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>
						<?php }
					else
					{ ?>

					<a href="<?php echo base_url('themes/public/ehealth/img/yoda.png');?>" class="popup_image">
					<img src="<?php echo base_url('themes/public/ehealth/img/yoda.png');?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>	
						<?php }
				} ?>

				<div class="caption">
					<p class="display_name">
					<?php
						if (!empty($get_social_users->name))
							{
									echo $get_social_users->name;
							}
						?>
					</p>				
					<p class="role_name"><?php
                        $role_name = $this->Sociall_model->get_role_name($get_social_users->role_ID);
                        echo $role_name; ?></p>
					<p class="last_login">
						<?php
							if ($get_social_users->ip_address==$this->sess_ip_address AND $get_social_users->identifier==$this->sess_identifier) {
								echo  '<i class="fa fa-circle" aria-hidden="true"></i> '.lang("profile_you_are_online");
							}
							else
							{
								echo 'Last active: '.date('Y-m-d H:i', $get_social_users->modified_date);
							}
						?>
					</p>
				</div>
			</div>		
			</div>
			<?php } ?>
		<div id="pagination" class="col-xs-12 text-center"><?php echo $this->pagination->create_links(); ?></div>
		</div>
	</div>
</div>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>