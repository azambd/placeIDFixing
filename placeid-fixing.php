<?php

#error_reporting(0);
set_time_limit(0);
//require_once '/var/www/html/rm/inc/central.config.php';
require_once '/var/www/html/rm/google-crawler/inc/central.config.php';


 $query_data_pname = mysqli_query($con, "SELECT * FROM `directories` WHERE `directory_name`='google.com' AND `google_crawled`=2 AND `link`!=''  ORDER BY client_id ASC LIMIT 100");

 while($rows_pname = mysqli_fetch_assoc($query_data_pname))
 {

  $id = $rows_pname['id'];
  $maps_link = $rows_pname['link'];

 $uniqueCodeGrab = parse_url($maps_link);
 // echo '<pre>';
 // print_r($uniqueCodeGrab);
 // echo '</pre>';
 // echo PHP_EOL;
 $uniqueCode = $uniqueCodeGrab['query'];

 #gpi location table:
 $gpiLocation = mysqli_query($con, "SELECT * FROM `gmb_locations` WHERE `maps_url` LIKE '%$uniqueCode'");
 $rowsLoc = mysqli_fetch_assoc($gpiLocation);
echo PHP_EOL;echo PHP_EOL;
 echo 'PlaceID:'. $placeID = $rowsLoc['placeId'];

 if($placeID){
echo PHP_EOL;echo PHP_EOL;
   echo $updatePI = "UPDATE `directories` SET `place_id`='$placeID', `google_crawled`=3 WHERE `directory_name`='google.com' AND `google_crawled`=2 AND `id`='$id'";

   mysqli_query($con, $updatePI);
   echo PHP_EOL;echo PHP_EOL;
 }

}

?>
