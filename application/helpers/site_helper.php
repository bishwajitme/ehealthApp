<?php

/**
 * Created by PhpStorm.
 * User: Bishwajit
 * Date: 10/22/2017
 * Time: 11:27 PM
 */

function exercise_total($dfile){

    $row = 1;
    $url = 'http://localhost/ehealth/themes/public/ehealth/data/'.$dfile.'csv';
    if (($handle = fopen( $url, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $row++;

            // print_r($data);

            for ($c=2; $c < $num; $c++) {
                if((($c+1)%3)==0){
                    $time_array[] = $data[$c];
                }

                //$total_time = $total_time + $data[$c]['2'];
            }

        }
        fclose($handle);
    }
    $total_time = 0;
    foreach ($time_array as $did) {
        $total_time = $total_time +  (int)$did;
    }

    echo $total_time / 60000.'Minutes';
}
