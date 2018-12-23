<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/DB.php';
class Shedule {

    public static function getSheduleByDayId($day_id){
       $db=DB::getDBConnection();
      
       $resList=$db->query("select shedule.id,day_id,seat_count,seat_price,date,hour from shedule join day on day.id='$day_id' and day_id='$day_id'");
$sheduleList=array();
       //$resList=$db->query('select * from roll');
       $i=0;
              while($row =$resList->fetch()){
				  $sheduleList[$i]['id']=$row['id'];
				  $sheduleList[$i]['day_id']=$row['day_id'];
                   $sheduleList[$i]['date']=$row['date'];
                   $sheduleList[$i]['seat_count']=$row['seat_count'];
                   $sheduleList[$i]['seat_price']=$row['seat_price'];
				   $sheduleList[$i]['hour']=$row['hour'];
                   $i++;
               }
               
               return ($sheduleList);          
    }
	public static function createShedule($jsonParams){
	   $postParams=json_decode($jsonParams);
       $db=DB::getDBConnection();
	   $day_id=$postParams->day_id;
	   $seat_count=$postParams->seat_count;
	   $seat_price=$postParams->seat_price;
	   $hour=$postParams->hour;
       $resList=$db->query("INSERT INTO shedule (id, day_id, seat_count, seat_price, hour) VALUES ('null', '$day_id', '$seat_count', '$seat_price', '$hour')");             
            return "created";          
    }
}
