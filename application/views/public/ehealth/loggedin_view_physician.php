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
			<p class="headline_title"><?php echo lang('headline_you_are_loggedin');?></p>
		</div>

		<div class="alert alert-success loggedin_note"><?php echo lang('view_loggedin_alert');?></div>
		
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
                <div class="subheading"><h3>Connected Patient Data</h3></div>



                <?php
                $doctor_url = 'http://vhost11.lnu.se:20090/final/getFilterData.php?parameter=User_IDmed&value=';
                $doctor_url = $doctor_url.$_SESSION['userData']['userID'];
                $physician_array = simplexml_load_file($doctor_url);
               // $physician_array = json_decode(json_encode($physician_array),TRUE);
                $counter = 1;
                ?>

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['table']});
                    google.charts.setOnLoadCallback(drawTable);

                    function drawTable() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Patient Name');
                        data.addColumn('string', 'Therapy Name');
                        data.addColumn('string', 'Medicine Name');
                        data.addColumn('string', 'Dosage');
                        data.addColumn('number', 'Date');
                        data.addColumn('boolean', 'Completed');

                        <?php
                        $data_file = array();
                        $session_no = 0;
                        foreach ($physician_array as $pid) {

                        $medi_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Medicine&id=';
                        $medi_url = $medi_url.$pid->medicineID;
                        $medi_array = simplexml_load_file($medi_url);
                        $medi_array = json_decode(json_encode($medi_array),TRUE);
                        foreach ( $medi_array as $medi) {
                            $medicine_Name = $medi['name'];
                        }
                        $therapy_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Therapy_List&id=';
                        $therapy_url = $therapy_url.$pid->therapy_listID;
                        $therapy_array = simplexml_load_file($therapy_url);
                        $therapy_array = json_decode(json_encode($therapy_array),TRUE);
                        foreach ( $therapy_array as $thepID) {
                            $therapy_Name = $thepID['name'];
                            $therapy_Dosage = $thepID['Dosage'];
                        }

                        $user_patient_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=User&id=';
                        $user_patient_url = $user_patient_url.$pid->User_IDpatient;
                        $user_patient_array = simplexml_load_file($user_patient_url);
                        $user_patient_array = json_decode(json_encode($user_patient_array),TRUE);
                        foreach ( $user_patient_array as $userID) {
                            $patient_Name = $userID['username'];
                        }
                        $session_no = $session_no+1;
                        $dataobject = json_decode(json_encode($pid->DataURL),TRUE);
                        $data_file[] = [
                            "patient_Name" => $patient_Name,
                            "session_no" => $session_no,
                            "dataurl" =>  $dataobject[0],
                        ];

                            ?>
                        data.addRows([
                            [ <?php echo "'" . $patient_Name . "'";?>, <?php echo "'" . $therapy_Name . "'";?>, <?php echo "'" . $medicine_Name . "'";?>, <?php echo "'" . $therapy_Dosage . "'";?>, {v: <?php echo $counter; ?>, f: <?php echo "'" . $pid->test_datetime . "'";?>}, true],
                        ]);
                        <?php $counter +=1; } ?>
                        var table = new google.visualization.Table(document.getElementById('patient_data'));

                        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
                    }
                </script>
                <div id="patient_data"></div>









            </div>
            <br class="clear">
            <?php
echo '<div class="subheading"><h2>Spiral Exercise Data Visualization</h2></div>';
foreach ($data_file as $datafile) {
    $data_url = $datafile['dataurl'];
    $session_no = $datafile['session_no'];

    /* retrieve annotation for session */
    $note_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Note';
    $note_array = simplexml_load_file($note_url);
  //  $note_array = json_decode(json_encode($note_array),TRUE);

    foreach ($note_array as $nid) {
        $test_session_id = $nid->Test_Session_IDtest_session;
      if($test_session_id ==  $session_no) {
          $notetext= $nid->note;
          $commenter_id = $nid->User_IDmed;
      }
      else{
          $notetext = '';
          $commenter_id = '';
      }
    }

if($data_url == 'data1'|| $data_url == 'data3' || $data_url == 'data5'){
    echo ' <div class="col-sm-6"> <div class="subheading"><h3>Data Visualization for '.$datafile['patient_Name'].'</h3><p> Session ID: '.$session_no.'</p>';
   if($commenter_id == $_SESSION['userData']['userID']){
    echo'<p class="annotation">Comments: '.$notetext.' (by Physician: '.$_SESSION['userData']['username'].')</p>';
    }
echo'</div>';
    echo'<p class="download_file"><a target="_blank" href="http://vhost11.lnu.se:20090/final/'.$data_url.'.csv">Download Data File</a></p>';
    echo ' <div id="chart'.$data_url.'"></div></div>';
}
}

            ?>
            <br class="clear">

            <?php
            echo '<div class="subheading"><h2>Tapping Exercise Data Visualization</h2></div>';
            foreach ($data_file as $tdatafile) {
                $tapping_patient_name = $tdatafile['patient_Name'];
                $data_url = $tdatafile['dataurl'];
                $session_no = $tdatafile['session_no'];

                /* retrieve annotation for session */
                $note_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Note';
                $note_array = simplexml_load_file($note_url);
                //  $note_array = json_decode(json_encode($note_array),TRUE);

                foreach ($note_array as $nid) {
                    $test_session_id = $nid->Test_Session_IDtest_session;
                    if($test_session_id ==  $session_no) {
                        $notetext = $nid->note;
                        $commenter_id = $nid->User_IDmed;
                    }
                    else{
                        $notetext = '';
                        $commenter_id = '';
                    }
                }

                if($data_url == 'data2'|| $data_url == 'data4' || $data_url == 'data6'){
                    echo ' <div class="col-sm-6"> <div class="subheading"><h3>Data Visualization for '.$tapping_patient_name.'</h3><p> Session ID: '.$session_no.'</p>';
                    if($commenter_id == $_SESSION['userData']['userID']){
                        echo'<p class="annotation">Comments: '.$notetext.' (by Physician: '.$_SESSION['userData']['username'].')</p>';
                    }
                    echo'</div>';
                    echo'<p class="download_file"><a target="_blank" href="http://vhost11.lnu.se:20090/final/'.$data_url.'.csv">Download Data File</a></p>';
                    echo ' <div id="chart'.$data_url.'"></div></div>';
                }
            }

            ?>



        </div>
        <br/>

	</div>
</div>



<br/>
<br/>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>