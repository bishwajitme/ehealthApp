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
				<li><a href="<?php echo base_url();?>"><i class="fa fa-lock" aria-hidden="true"></i><span class="nav_log"> <?php echo lang('nav_login');?></span></a></li>
			</ul>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">
		<div class="headline">
			<p class="headline_title">eHealth Application for PD Patient Data Management</p>
			<p class="headline_explanation">This App is designed for managing data of Parkinsons Disease (PD) patients, physicians and researchers. In order to access the application, you must have to login first using your Social account. Since this project has implemented for final assignment of 4ME302 course, I have only used social login features as assignment's original requirements. I have made <strong>Role</strong> section automatic based on provider( Facebook - Patient, Twitter - Physician, Google - Researcher ).</p>
		</div><hr/>
        <p class="sub_headline_title">Log in via </p>
		<div class="icons-container">
            <div class="row">
	            <?php foreach($providers as $provider => $data) {?>
	            <div class="col-sm-4 col-md-4">
	            	<a href="<?php echo base_url('social/login/'.$provider); ?>" class="btn ehealth_social ehealth_btn ehealth_<?php echo strtolower($provider);?>"><span class="separator"></span><i class="socicon socicon-<?php echo strtolower($provider);?>"></i><span class="soc_title"><?php echo $provider;?></span></a>
	            </div>
	            <?php } ?>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>