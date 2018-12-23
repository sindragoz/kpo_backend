<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/DB.php';
class Auth {

    public static function Authorize($login,$password){
       $db=DB::getDBConnection();
       //select user.id,login,name,role,shedule_id,booking,seat_order.id from user join seat_order on user_id=1 AND user.id=1
	   $token = bin2hex(openssl_random_pseudo_bytes(16));
       $resList=$db->query("select * from user where login='$login' and password='$password'");
	   $userList=array();
       //$resList=$db->query('select * from roll');
       $i=0;
              while($row =$resList->fetch()){
                   $userList[$i]['login']=$row['login'];
                   $userList[$i]['id']=$row['id'];
				   $userList[$i]['name']=$row['name'];
				   $userList[$i]['name']=$row['name'];
				   $userList[$i]['role']=$row['role'];		   
                   $i++;
               }
		if($userList==null)
			return null;
		$id=$userList[0]['id'];
		$expiredDate= date("Y-m-d", strtotime("+7 days"));
		$db->query("UPDATE user SET token ='$token' , token_expiredAt = '$expiredDate' WHERE user.id = '$id'");
	    return $token;
    }
	
	public static function Unauthorize($token){
       $db=DB::getDBConnection();

       $resList=$db->query("select * from user where token='$token'");
	   $userList=array();
       $i=0;
              while($row =$resList->fetch()){
                   $userList[$i]['login']=$row['login'];
                   $userList[$i]['id']=$row['id'];
				   $userList[$i]['name']=$row['name'];
				   $userList[$i]['name']=$row['name'];
				   $userList[$i]['role']=$row['role'];		   
                   $i++;
               }
		if($userList==null)
			return "No user with this token";
		$id=$userList[0]['id'];
		$expiredDate= date("Y-m-d", strtotime("+7 days"));
		$db->query("UPDATE user SET token ='null' , token_expiredAt = 'null' WHERE user.id = '$id'");
	    return "unauthorized";
    }
	

	public static function isAuthorized($token){
		$db=DB::getDBConnection();
		$token_str=json_decode($token);
       //select user.id,login,name,role,shedule_id,booking,seat_order.id from user join seat_order on user_id=1 AND user.id=1
       $resList=$db->query("select * from user where token='$token_str'");
	   $userList=array();
       //$resList=$db->query('select * from roll');
       $i=0;
              while($row =$resList->fetch()){
                   $userList[$i]['token']=$row['token'];
               }
		if($userList==null)
			return false;
	    return true;
    }
}
