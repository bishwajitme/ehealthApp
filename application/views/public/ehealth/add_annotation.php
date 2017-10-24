<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('public/ehealth/_parts/header');
?>
    <title><?php echo $this->config->item('site_title'); ?></title>
    </head>
    <body>

<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container-fluid">
        <!-- Load Navbar Header -->
        <?php $this->load->view('public/ehealth/_parts/navbar_header');
        $note_id = "";
        $ses_id = $_GET['session_id'];
        if(isset($_GET['noteID'])) {
            $note_id = $_GET['noteID'];

            $data["note"]= $this->Sociall_model->get_test_note_by_ID($note_id);
            if(count($data["note"])>=1) {
                foreach ($data["note"] as $utnote) {
                     $notetext = $utnote->note;
                }
            }
            else {

            $note_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Note&id=';
            $note_url = $note_url . $note_id;
            $note_array = simplexml_load_file($note_url);
            $notetext = "";
            foreach ($note_array as $nid) {
                $commenter_id = $nid->User_IDmed;
                if ($commenter_id == $_SESSION['userData']['userID']) {
                    $notetext = $nid->note;
                } else {
                    $notetext = "";
                }
            }
        }
        }

        ?>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo lang('nav_home');?></a></li>
                <li class="active"><a href="<?php echo base_url();?>/social/add_annotation/"><i class="fa fa-users" aria-hidden="true"></i> Comments</a></li>

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
            <p class="headline_title">Add/Edit Comments</p>
        </div>




        <!-- '''''''''''''''''''''''''''''''''''''''''''''''''' -->

        <div class="col-sm-12 form">
            <div class="col-sm-8">

              <form action="<?php echo base_url('social/submit_annotation');?>" method="post" class="form-horizontal">
                  <div class="form-group">
                      <div class="col-md-9">
                          <input name="noteid" type="hidden" value="<?php echo $note_id; ?>">
                          <input name="sessionId" type="hidden" value="<?php echo $ses_id; ?>">
                          <input name="user_IDmed" type="hidden" value="<?php echo $_SESSION['userData']['userID']; ?>">
                      </div>
                  </div>

                  <div class="form-group">
                 <lebel for="note" class="col-md-3 text-right">Comments</lebel>
                 <div class="col-md-9">
                     <textarea name="annotation" value="" class="form-control" required><?php if($note_id>=1){echo $notetext; } ?></textarea>
                 </div>
           </div>
           <div class="form-group">
           <div class="col-md-9 text-right">
                     <input type="submit" name="Submit" value="Submit" class="btn btn-primary">
                 </div>
           </div>
              </form>

            </div>
        </div>
        <br/>
        <!-- ................ Begin Google Map Settings ................ -->


    </div>
</div>



<br/>
<br/>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>