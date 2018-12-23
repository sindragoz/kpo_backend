<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/DB.php';
class Orders {

    public static function getSeatOrders($user_id){
       $db=DB::getDBConnection();
      
       $resList=$db->query('SELECT seat_order.id,booking,seat_price,hour,date FROM seat_order join shedule on user_id='.$user_id.' and shedule.id=shedule_id join day on day.id=shedule.day_id');
$seatOrderList=array();
       //$resList=$db->query('select * from roll');
       $i=0;
              while($row =$resList->fetch()){
				  $seatOrderList[$i]['id']=$row['id'];
                   $seatOrderList[$i]['booking']=$row['booking'];
                   $seatOrderList[$i]['seat_price']=$row['seat_price'];
                   $seatOrderList[$i]['date']=$row['date'];
				   $seatOrderList[$i]['hour']=$row['hour'];				   
                   $i++;
               }
               
               return ($seatOrderList);          
    }
	public static function getSouvenirOrders($user_id){
       $db=DB::getDBConnection();
      
       $resList=$db->query('select souvenir_order.id,isDelivered,deliver_date,price,name from souvenir_order join souvenir on souvenir_id=souvenir.id and user_id='.$user_id);
$souvenirOrderList=array();
       //$resList=$db->query('select * from roll');
       $i=0;
              while($row =$resList->fetch()){
				   $souvenirOrderList[$i]['id']=$row['id'];
                   $souvenirOrderList[$i]['isDelivered']=$row['isDelivered'];
                   $souvenirOrderList[$i]['deliver_date']=$row['deliver_date'];
                   $souvenirOrderList[$i]['price']=$row['price'];
				   $souvenirOrderList[$i]['name']=$row['name'];				   
                   $i++;
               }
               
               return ($souvenirOrderList);          
    }
	//DELETE FROM `souvenir_order` WHERE `souvenir_order`.`id` = 8
	public static function createSouvenirOrder($jsonParams){
		$postParams=json_decode($jsonParams);
       $db=DB::getDBConnection();
	   $souvenir_id=$postParams->souvenir_id;
	   $isDelivered=$postParams->isDelivered;
	   $user_id=$postParams->user_id;
	   $dateStr=$postParams->dateStr;
       $resList=$db->query("INSERT INTO souvenir_order (id, souvenir_id, isDelivered, deliver_date, user_id) VALUES ('null', '$souvenir_id', '$isDelivered', '$dateStr', '$user_id')");             
            return "created";          
    }
	public static function removeSouvenirOrder($jsonParams){
		$postParams=json_decode($jsonParams);
       $db=DB::getDBConnection();
	   $id=$postParams->id;
	   $resList=$db->query("DELETE FROM souvenir_order WHERE souvenir_order.id = '$id'");             
            return "created";          
    }
	
	public static function createSeatOrder($jsonParams){
		$postParams=json_decode($jsonParams);
       $db=DB::getDBConnection();
	   $booking=$postParams->booking;
	   $shedule_id=$postParams->shedule_id;
	   $user_id=$postParams->user_id;
       $resList=$db->query("INSERT INTO `seat_order` (id, booking, shedule_id, user_id) VALUES ('null', '$booking', '$shedule_id', '$user_id')");             
            return "created";          
    }
	public static function removeSeatOrder($jsonParams){
		$postParams=json_decode($jsonParams);
       $db=DB::getDBConnection();
	   $id=$postParams->id;
	   $resList=$db->query("DELETE FROM seat_order WHERE seat_order.id = '$id'");  
        return "created";          
    }
}
