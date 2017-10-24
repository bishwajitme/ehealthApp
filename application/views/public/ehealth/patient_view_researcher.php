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
        $patient_id = $_GET['userid'];
        $doctor_url = 'http://vhost11.lnu.se:20090/final/getFilterData.php?parameter=User_IDpatient&value=';
        $doctor_url = $doctor_url.$patient_id;
        $physician_array = simplexml_load_file($doctor_url);
foreach ($physician_array as $usid) {

    $user_patient_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=User&id=';
    $user_patient_url = $user_patient_url.$usid->User_IDpatient;
    $user_patient_array = simplexml_load_file($user_patient_url);
    $user_patient_array = json_decode(json_encode($user_patient_array),TRUE);
    foreach ( $user_patient_array as $userID) {
        $patient_Name = $userID['username'];
        $organization_id = $userID['Organization'];
        $role_id = $userID['Role_IDrole'];
    }
}
        ?>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo lang('nav_home');?></a></li>
                <li class="active"><a href="<?php echo base_url();?>/social/patients/?userid=<?php echo $patient_id ;?>"><i class="fa fa-users" aria-hidden="true"></i> Patient</a></li>

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

                    <a href="<?php echo base_url('themes/public/ehealth/img/yoda.png');?>" class="popup_image">
                        <img src="<?php echo base_url('themes/public/ehealth/img/yoda.png');?>" alt="<?php echo lang('profile_user_picture');?>" class="img-circle img-responsive" /></a>

            </div>
            <div class="col-sm-9 user_profile_right">
                <?php

                $role_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Role&id=';
                $role_url = $role_url.$role_id;
                $user_role_array = simplexml_load_file($role_url);
                $user_role_array = json_decode(json_encode($user_role_array),TRUE);
                foreach ( $user_role_array as $urole) {
                    $role_Name = $urole['name'];
                }
                $org_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Organization&id=';
                $org_url = $org_url.$organization_id;
                $user_org_array = simplexml_load_file($org_url);
                $user_org_array = json_decode(json_encode($user_org_array),TRUE);
                foreach ( $user_org_array as $uorg) {
                    $org_Name = $uorg['name'];
                }




               if (!empty($_SESSION['userData']['username'])) { echo '<p><span class="col-xs-4"><b>'.lang('profile_user_name').'</b></span><span class="col-xs-1">:</span><span class="col-xs-7">'.$patient_Name.'</span></p>';}
                echo '<p><span class="col-xs-4"><b>Role</b></span><span class="col-xs-1">:</span><span class="col-xs-7">'.$role_Name .'</span></p>';
               if (!empty($org_Name)) { echo '<p><span class="col-xs-4"><b>Organization Name</b></span><span class="col-xs-1">:</span><span class="col-xs-7" style="text-transform:none;">'.$org_Name.'</span></p>';}

                ?>
            </div>

        </div>
        <!-- '''''''''''''''''''''''''''''''''''''''''''''''''' -->

        <div class="col-sm-12 physician patient_details">
            <div class="col-sm-8">
                <div class="subheading"><h3>Connected Patient Data</h3></div>



                <?php


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
            $spiral_session_no = 0;
            foreach ($data_file as $datafile) {
                $data_url = $datafile['dataurl'];
                $spiral_session_no = substr($data_url, -1);


                $data["note"]= $this->Sociall_model->get_test_note($spiral_session_no, $_SESSION['userData']['userID']);
                if(count($data["note"])>=1) {
                    $notetext = '';
                    $commenter_did = '';
                    $dedit = '';
                    foreach ($data["note"] as $utnote) {
                        $commenter_did = (int)$utnote->User_IDmed;
                        if ($commenter_did === $_SESSION['userData']['userID']) {
                            $dedit = '<a href="' . base_url('social/add_annotation') . '?noteID=' . $utnote->noteID . '&session_id=' . $spiral_session_no . '">Edit</a>';
                        }
                            $notetext .= $utnote->note . ' (by User id: <strong>' . $utnote->User_IDmed . '</strong>) ' . $dedit . '<br>';


                    }
                }
                else {


                    /* retrieve annotation for session */
                    $note_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Note';
                    $note_array = simplexml_load_file($note_url);
                    //  $note_array = json_decode(json_encode($note_array),TRUE);
                    $notetext = '';
                    $note_id = 1;
                    foreach ($note_array as $nid) {
                        $test_session_id = $nid->Test_Session_IDtest_session;
                        if ($test_session_id == $spiral_session_no) {
                            $commenter_id = $nid->User_IDmed;
                            $edit = "";
                            if ($commenter_id == $_SESSION['userData']['userID']) {
                                $edit = '<a href="' . base_url('social/add_annotation') . '?noteID=' . $note_id . '&session_id=' . $spiral_session_no . '">Edit</a>';
                            }
                            $notetext .= $nid->note . ' (by User id: <strong>' . $commenter_id . '</strong>) ' . $edit . '<br>';

                        } else {
                            $notetext = '';
                            $commenter_id = '';
                        }
                        $note_id = $note_id + 1;
                    }
                }


                if($data_url == 'data1'|| $data_url == 'data3' || $data_url == 'data5'){
                    echo ' <div class="col-sm-6"> <div class="subheading"><h3>Data Visualization for '.$datafile['patient_Name'].'</h3><p> Session ID: '.substr($data_url, -1).'</p>';
                    if($notetext != ""){
                        echo'<p class="annotation">Comments: '.$notetext.'</p>';
                    }
                    else{
                        echo '<a href="'.base_url('social/add_annotation').'?session_id='.$spiral_session_no.'">Add Comment</a>';
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
                $tsession_no = substr($data_url, -1);


                $data_tap["note"]= $this->Sociall_model->get_test_note($tsession_no, $_SESSION['userData']['userID']);
                if(count($data["note"])>=1) {
                    $notetext = '';
                    foreach ($data_tap["note"] as $utnote) {
                        $commenter_id = $utnote->User_IDmed;
                        if ($commenter_id == $_SESSION['userData']['userID']) {
                            $dedit = '<a href="' . base_url('social/add_annotation') . '?noteID=' . $utnote->noteID . '&session_id=' . $session_no . '">Edit</a>';
                        }
                        $notetext .= $utnote->note.' (by User id: <strong>'.  $utnote->User_IDmed .'</strong>) '.$dedit.'<br>';

                    }
                }
                else {

                    /* retrieve annotation for session */
                    $note_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=Note';
                    $note_array = simplexml_load_file($note_url);
                    //  $note_array = json_decode(json_encode($note_array),TRUE);
                    $notetext = '';
                    foreach ($note_array as $nid) {
                        $test_session_id = $nid->Test_Session_IDtest_session;
                        if ($test_session_id == $tsession_no) {
                            $commenter_id = $nid->User_IDmed;
                            $edit = "";
                            $note_id = 1;
                            if ($commenter_id == $_SESSION['userData']['userID']) {
                                $edit = '<a href="' . base_url('social/add_annotation') . '?noteID=' . $note_id . '&session_id=' . $tsession_no . '">Edit</a>';
                            }
                            $notetext .= $nid->note . ' (by User id: <strong>' . $commenter_id . '</strong>) ' . $edit . '<br>';
                        } else {
                            $notetext = '';
                            $commenter_id = '';
                        }
                        $note_id = $note_id + 1;
                    }

                }

                if($data_url == 'data2'|| $data_url == 'data4' || $data_url == 'data6'){
                    echo ' <div class="col-sm-6"> <div class="subheading"><h3>Data Visualization for '.$tapping_patient_name.'</h3><p> Session ID: '.substr($data_url, -1).'</p>';
                    if($notetext != ""){
                        echo'<p class="annotation">Comments: '.$notetext.'</p>';
                    }
                    else{
                        echo '<a href="'.base_url('social/add_annotation').'?session_id='.$session_no.'">Add Comment</a>';
                    }

                    echo'</div>';
                    echo'<p class="download_file"><a target="_blank" href="vhost11.lnu.se:20090/final/'.$data_url.'.csv">Download Data File</a></p>';
                    echo ' <div id="chart'.$data_url.'"></div></div>';
                }
            }

            ?>


        </div>
        <br/>
        <!-- ................ Begin Google Map Settings ................ -->
        <div class="subheading"><h3>Geographic Location of <?php echo $patient_Name; ?></h3></div>

        <div id="map" class="col-sm-8"></div>
        <script>

            function initMap() {

                var locations = [
                    <?php
                    $location_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=User&id=';
                    $location_url = $location_url.$patient_id;
                    $user_location = simplexml_load_file($location_url);
                    $index = 0;
                    $user_id = 0;
                    foreach ($user_location as $patient) {
                        $user_id = $user_id+1;
                        if(!empty($patient->Lat)) {
                            echo "[" . "'". $user_id ."', ". "'". $patient->username ."', " . $patient->Lat . ", " . $patient->Long . ", " . $index ."], ";
                            $index +=1;
                        }
                    }
                    ?>
                ];
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 6,
                    center: new google.maps.LatLng(58.49669, 14.59776),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                var infowindow = new google.maps.InfoWindow({});

                var marker, i;

                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                        map: map
                    });

                    google.maps.event.addListener(marker, 'click', (function (marker, i) {

                        return function () {
                            infowindow.setContent(locations[i][1]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            }   </script>


        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->google_map_api; ?>&callback=initMap">
        </script>


    </div>
</div>



<br/>
<br/>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>