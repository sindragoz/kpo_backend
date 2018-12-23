<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/DB.php';
class Souvenir {

    public static function getSouvenirs(){
       $db=DB::getDBConnection();
      
       $resList=$db->query('select *from souvenir');
	   $souvenirOrdersList=array();
       $i=0;
              while($row =$resList->fetch()){
                   $souvenirOrdersList[$i]['name']=$row['name'];
				   $souvenirOrdersList[$i]['id']=$row['id'];
				   $souvenirOrdersList[$i]['price']=$row['price'];
                   $i++;
               }
               
               return ($souvenirOrdersList);          
    }
}
