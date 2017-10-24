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

        <div class="col-sm-12 researcher patient_details">
            <div class="col-sm-8">
                <div class="subheading"><h3>All Patient Data</h3></div>
                <?php
                $doctor_url = 'http://vhost11.lnu.se:20090/final/getFilterData.php?parameter=User_IDmed&value=1';
              //  $doctor_url = $doctor_url.$_SESSION['userData']['userID'];
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

                        <?php foreach ($physician_array as $pid) {

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




                <!-- ................ Begin Google Map Settings ................ -->
                <div class="subheading"><h3>Geographic overview of the patients</h3></div>

                <div id="map" class="col-sm-8"></div>
                <script>

                    function initMap() {

                        var locations = [
                            <?php
                            $location_url = 'http://vhost11.lnu.se:20090/final/getData.php?table=User';
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
                                    infowindow.setContent("<a href='/ehealth/social/patients/?userid=" + locations[i][0] +"'>" + locations[i][1] + "</a>");
                                    infowindow.open(map, marker);
                                }
                            })(marker, i));
                        }
                    }   </script>


                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->google_map_api; ?>&callback=initMap">
                </script>




            </div>
            <div class="col-sm-12">
                <div class="other_details">
                    <div class="subheading"><h3>Other Related Information (from RSS feed)</h3></div>

              <div class="rsscontainer">
             <?php
             $this->load->library('rssparser');                          // load library
             $this->rssparser->set_feed_url('https://www.news-medical.net/tag/feed/Parkinsons-Disease.aspx');  // get feed
             $this->rssparser->set_cache_life(0);                       // Set cache life time in minutes
             $rss = $this->rssparser->getFeed(10);
             foreach ($rss as $item)
             {
                 echo '<div class="rssItem">';
                 echo '<h4 class="rssTitle"><a target="_blank" href="'.$item['link'].'">'.$item['title'].'</a></h4>';
                 echo '<p class="date">'.substr($item['pubDate'], 4, -6).'</p>';
                 echo '<p class="description">'.$item['description'].'</p>';
                 echo '<p class="readmore"><a target="_blank" href="'.$item['link'].'">Read More</a></p>';
               echo '</div>';
             }
                   ?>
                    </div>
                </div>
            </div>

        </div>
        <br/>

    </div>
</div>



<br/>
<br/>

<?php $this->load->view('public/ehealth/_parts/footer'); ?>