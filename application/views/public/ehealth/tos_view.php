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
                <li class="active"><a href="<?php echo base_url('');?>/pages/tos"><i class="fa fa-cogs" aria-hidden="true"></i> TOS</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-lock" aria-hidden="true"></i><span class="nav_log"> <?php echo lang('nav_login');?></span></a></li>
            </ul>
        </div>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="headline"><p class="headline_title">Terms and Conditions</p></div>
        <div class="privacy_test">


            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae nisi non neque efficitur aliquam in sagittis odio. Nam scelerisque dolor nulla, ut lobortis risus aliquet cursus. Morbi sagittis scelerisque est, euismod sagittis magna consectetur ut. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc nec condimentum ex. Cras mattis mi sed nibh ullamcorper sagittis eu in leo. Nullam tristique dapibus ante, eget tempus arcu consectetur at.

            </p><p> In rutrum, lacus vitae porttitor sodales, felis enim interdum nulla, non congue ante tellus in orci. Sed facilisis commodo enim, ut tincidunt purus pretium a. Vestibulum eu nisi sem. Nullam condimentum eget velit vitae tempus. Curabitur pretium nulla nec dolor posuere auctor. Phasellus iaculis tortor eget sem volutpat porttitor. Donec hendrerit metus eu ipsum molestie posuere. Nulla pulvinar magna vel ipsum mattis viverra. Cras elementum lacus in tortor mattis, non malesuada tortor ultrices. Sed ut nibh nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non nibh a arcu dignissim aliquet.

            </p><p>Nullam ullamcorper lobortis elit eget elementum. Suspendisse vitae odio risus. Nunc posuere urna orci, quis cursus orci maximus sed. Suspendisse eu mollis ante, eget pellentesque orci. Curabitur ultricies nisi a hendrerit scelerisque. Sed massa tellus, suscipit at elit at, consectetur bibendum nulla. In molestie diam ac sapien ornare, at dapibus dolor feugiat. Proin nibh turpis, imperdiet in quam at, rutrum efficitur ipsum.

            </p><p>Vivamus viverra feugiat est, quis tempus urna tincidunt vitae. Quisque vulputate justo leo, et sollicitudin risus varius vel. Suspendisse eget lacus ante. Fusce eu tempor nisi. Maecenas ac sapien massa. Praesent mollis ornare tortor, eu blandit sapien gravida eget. Praesent et egestas ex. Vivamus a justo a est aliquam ornare. Nulla nec justo ut purus rutrum luctus. Nulla mattis luctus sapien eu vestibulum. Mauris id molestie eros.

            </p>
        </div>
    </div>
</div>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>