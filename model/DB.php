<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author User
 */
class DB {
    public static function getDBConnection(){
        $host='localhost';
        $dbname='planetarydb';
        $user='root';
        $password='';
        $db=new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
                      $db->query("SET NAMES 'utf8';");
$db->query("SET CHARACTER SET 'utf8';");
$db->query("SET SESSION collation_connection = 'utf8_general_ci';");
       return $db;
        
    }
}
