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
        <div class="col-sm-12 social_loggedin patient">
            <?php
             echo '<div class="subheading"><h3>Your Prescribed Therapy</h3></div>';
            $url = 'http://vhost11.lnu.se:20090/final/getFilterData.php?parameter=User_IDpatient&value=';
            $url = $url.$_SESSION['userData']['userID'];
            $session_data = simplexml_load_file($url);
            $counter = 1;


            ?>

            <!-- Here I have used google Visualization to make the table
            https://developers.google.com/chart/interactive/docs/gallery/table -->
            <script type="text/javascript">
                google.charts.load('current', {'packages':['table']});
                google.charts.setOnLoadCallback(drawTable);

                function drawTable() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Test Id');
                    data.addColumn('string', 'Therapy Name');
                    data.addColumn('string', 'Medicine Name');
                    data.addColumn('string', 'Dosage');
                    data.addColumn('number', 'Date');
                    data.addColumn('boolean', 'Completed');
<?php
$data_file = array();
$session_no = 0;
foreach ($session_data as $pid) {

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
    [ <?php echo "'" . $pid->testID . "'";?>, <?php echo "'" . $therapy_Name . "'";?>, <?php echo "'" . $medicine_Name . "'";?>, <?php echo "'" . $therapy_Dosage . "'";?>, {v: <?php echo $counter; ?>, f: <?php echo "'" . $pid->test_datetime . "'";?>}, true],
    ]);
    <?php $counter +=1; } ?>
    var table = new google.visualization.Table(document.getElementById('patient_data'));

    table.draw(data, {showRowNumber: false, width: '100%', height: '100%'});
    }
    </script>
<div id="patient_data"></div>


            <!-- Youtube Data API V3 call to retreive all video items from a list
                       https://developers.google.com/chart/interactive/docs/gallery/table -->
            <?php
            $PlaylistID = 'PL5jg5UxfmH0iPoRulWl5YPI9DmXCZY-oW';
            $googleAPIkey = 'AIzaSyAdKiUHv76F2hrC2djU5ol8L6VMj-4aGhQ';
            $urlPlaylist = 'https://www.googleapis.com/youtube/v3/playlistItems?part=contentDetails&maxResults=10&playlistId=';
            $urlPlaylist = $urlPlaylist . $PlaylistID . '&key=' . $googleAPIkey;
            $exercise_jason = file_get_contents($urlPlaylist);
            $exercise_video_array = json_decode($exercise_jason, true);?>

            <div class="subheading"><h3>Exersice Videos</h3></div>
            <p class="exercise_description">Please follow the instuction videos and exercise everyday.</p>
                <?php
                foreach($exercise_video_array['items'] as $item){
                    $videoID = $item['contentDetails']['videoId'];

                $urlPly = "https://www.youtube.com/embed/".$videoID;
               echo '  <div class="col-sm-6 patient_exercise_video"><iframe width="100%" height="450" src='.$urlPly.' frameborder="0" allowfullscreen></iframe> </div>';
                }
                ?>



        </div>
    </div>
</div>



<?php $this->load->view('public/ehealth/_parts/footer'); ?>