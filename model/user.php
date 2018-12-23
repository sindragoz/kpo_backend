<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/DB.php';
class User {

    public static function getSeatOrders($user_id){
       $db=DB::getDBConnection();
       //select user.id,login,name,role,shedule_id,booking,seat_order.id from user join seat_order on user_id=1 AND user.id=1
       $resList=$db->query('select login,name,role,id from user where id='.$user_id);
$userOrdersList=array();
       //$resList=$db->query('select * from roll');
       $i=0;
              while($row =$resList->fetch()){
                   //$userOrdersList[$i]=$row;
                   $userOrdersList[$i]['login']=$row['login'];
                   $userOrdersList[$i]['id']=$row['id'];
				   $userOrdersList[$i]['name']=$row['name'];
				   $userOrdersList[$i]['role']=$row['role'];
                   $i++;
               }
               
               return ($userOrdersList);          
    }
	
	public static function getUser($token){
			
		$db=DB::getDBConnection();
       //select user.id,login,name,role,shedule_id,booking,seat_order.id from user join seat_order on user_id=1 AND user.id=1
       $resList=$db->query("select * from user where token='$token'");
	   $userList=array();
       //$resList=$db->query('select * from roll');
       $i=0;
              while($row =$resList->fetch()){
                   $userList[$i]['login']=$row['login'];
                   $userList[$i]['id']=$row['id'];
				   $userList[$i]['name']=$row['name'];
				   $userList[$i]['email']=$row['email'];
				   $userList[$i]['role']=$row['role'];		   
                   $i++;
               }
		if($userList==null)
			return null;
	    return $userList;
    }
		
	public static function createUser($jsonParams){
		$postParams=json_decode($jsonParams);
       $db=DB::getDBConnection();
	   $id=$postParams->id;
	   $name=$postParams->name;
	   $login=$postParams->login;
	   $password=$postParams->password;
	   $email=$postParams->email;
	   $role=$postParams->role;
       $resList=$db->query("INSERT INTO user (name, login, password, email, id, role) VALUES ('$name', '$login', '$password', '$email', '$id', '1')");             
            return "created";          
    }
}
