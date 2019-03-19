<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/DB.php';
class News {

    public static function getNews(){
       $db=DB::getDBConnection();
      
       $resList=$db->query('SELECT * FROM news');
       $newsList=array();
       $i=0;
              while($row =$resList->fetch()){
				  $newsList[$i]['id']=$row['id'];
                   $newsList[$i]['header']=$row['header'];
                   $newsList[$i]['text']=$row['text'];
                   $newsList[$i]['date']=$row['date'];
				   $newsList[$i]['preview_text']=$row['preview_text'];
                   $i++;
               }
               
               return $newsList;          
    }

    public static function getNewsById($id){
        $db=DB::getDBConnection();
        $resList=$db->query('SELECT * FROM news WHERE id='.$id);
        $newsList=array();
        $i=0;
               while($row =$resList->fetch()){
                   $newsList[$i]['id']=$row['id'];
                    $newsList[$i]['header']=$row['header'];
                    $newsList[$i]['text']=$row['text'];
                    $newsList[$i]['date']=$row['date'];
                    $newsList[$i]['preview_text']=$row['preview_text'];
                    $i++;
                }
                return $newsList;          
     }
	//DELETE FROM `souvenir_order` WHERE `souvenir_order`.`id` = 8
	public static function createNews($jsonParams){
	   $postParams=json_decode($jsonParams);
       $db=DB::getDBConnection();
	   $header=$postParams->newsHeader;
	   $text=$postParams->newsMainText;
	   $date=$postParams->date;
	   $preview_text=$postParams->newsPreviewText;
       $resList=$db->query("INSERT INTO news (id, header, text, date, preview_text) VALUES ('null', '$header', '$text', '$date', '$preview_text')");             
            return "created";          
    }
}
