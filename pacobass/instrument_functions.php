<?php
/*
 * Created on Dec 12, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//session_start();
require_once ("userData.php");
require_once("constants.php");
require_once("instrumentData.php");
require_once("pictureData2.php");
class instrument_functions{

	public function __construct() {
	}
	
	public function addInstrument($serial, $nickname, $description){
		//get logged in user from session and add instrument
		$serial = addslashes($serial);
		$description = addslashes($description);
		$nickname = addslashes($nickname);
		$myUser = new userData();
    	$myUser = unserialize($_SESSION["user"]);
    	$username = $myUser->username;
    	$userid = $myUser->userID;
    	$success = false;
    	$description = addslashes($description);
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("INSERT INTO instrument (user_id, serial, nickname, long_descr) VALUES ( '$userid', '$serial', '$nickname', '$description') ")or die(mysql_error());
			mysql_close($con);
			$success = true;
    	}catch(Exception $e){
    		
    	} 
    	return $success;
	}
	
	
	public function updateInstrument($instrumentid, $serial, $nickname, $description){
		//get logged in user from session and add instrument
		$serial = addslashes($serial);
		$description = addslashes($description);
		$nickname = addslashes($nickname);
    	$success = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("UPDATE instrument SET serial = '$serial', nickname = '$nickname', long_descr = '$description' WHERE instrument_id = '$instrumentid' ")or die(mysql_error());
			mysql_close($con);
			$success = true;
    	}catch(Exception $e){
    		
    	} 
    	return $success;
	}
	
	  	public function getAllInstruments(){
	  	$myUser = new userData();
    	$myUser = unserialize($_SESSION["user"]);
    	$userid = $myUser->userID;
   			$instruments = array();
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM instrument WHERE user_id = '$userid'")or die(mysql_error());  
			$instrument = new instrumentData();
			//$row = mysql_fetch_array( $result );
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    			$instrument = new instrumentData();
    			$instrument->instrumentid = $row["instrument_id"];
    			$instrument->userid = $row["user_id"];
    			$instrument->nickname = $row["nickname"];
    			$instrument->serial = $row["serial"];
    			$instrument->description = $row["long_descr"];
    			$instrument->stolen = $row["stolen"];
    			array_push($instruments, $instrument);
    		}
    		}catch(Exception $e){
    		throw ($e);
    		}
    		mysql_close($con);
    		return $instruments;	
   		 }
   		 
	  	public function getInstrument($instrumentid){
	
   			$instrument = new instrumentData();
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM instrument WHERE instrument_id = '$instrumentid'")or die(mysql_error());  
			$instrument = new instrumentData();
			//$row = mysql_fetch_array( $result );
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    			
    			$instrument->instrumentid = $row["instrument_id"];
    			$instrument->userid = $row["user_id"];
    			$instrument->nickname = $row["nickname"];
    			$instrument->serial = $row["serial"];
    			$instrument->description = $row["long_descr"];
    			$instrument->stolen = $row["stolen"];
    			
    		}
    		}catch(Exception $e){
    		throw ($e);
    		}
    		mysql_close($con);
    		return $instrument;	
   		 }
   		 
   public function deleteInstrument($instrumentid)
    {
    	$success = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("DELETE FROM instrument WHERE instrument_id = '$instrumentid'")or die(mysql_error());
			mysql_close($con);
			$success = true;
    	}catch(Exception $e){
    		throw($e);
    	} 
    	return $success; 
    }
    
    	public function isStolen($instrumentid){
    	$stolen = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			$result = mysql_query("SELECT * FROM report WHERE instrument_id = '$instrumentid' and status = 'active'")or die(mysql_error());

			while($row = mysql_fetch_array($result)){
    			$stolen = true;
			}
			mysql_close($con);
    	}catch(Exception $e){
    		
    	} 
    	
    	return $stolen;
	}
	
	
	public function getTestString(){
		return;
	}
	
/*	  	public function getPictureURI($instrumentid){
   			$instruments = array();
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM picture WHERE instrument_id = '$instrumentid'")or die(mysql_error()); 
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    			array_push($instruments, $row["filename"]);
    		}
    		}catch(Exception $e){
    		throw ($e);
    		}
    		mysql_close($con);
    		array_push($instruments, "pic/addpic.jpg");
    		return $instruments;
   		 }
	*/
	
	 /* 	public function getPictureURI($instrument_id){
   			$instruments = array();
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT CONCAT(root_path, filename) as uri, picture_id FROM picture WHERE instrument_id = '$instrument_id'")or die(mysql_error()); 
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    		//	array_push($instruments, $row["filename"]);
    		$picData = new pictureData2();
    		$picData->fullPath = $row["uri"];
    		$picData->picID = $row["picture_id"];
    		array_push($instruments,$picData);
    		}
    		}catch(Exception $e){
    	//	throw ($e);
    		}
    		mysql_close($con);
    	//	array_push($instruments, "pic/addpic.jpg");
    	$picData = new pictureData2();
    		$picData->fullPath = "pic/addpic.jpg";
    		$picData->picID = 0;
    		array_push($instruments,$picData);
    		return $instruments;
   		 }
	*/
		  	public function getPictureURI($instrument_id, $addPic){
   			$instruments = array();
   			$serial;
   			 try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT serial FROM instrument WHERE instrument_id = '$instrument_id'")or die(mysql_error()); 
    		while($row = mysql_fetch_array($result)){
    		$serial = $row["serial"];
    		}
    		}catch(Exception $e){
    	//	throw ($e);
    		}
    		mysql_close($con);
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT CONCAT(root_path, filename) as uri, picture_id FROM picture WHERE instrument_id = '$instrument_id'")or die(mysql_error()); 
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    		//	array_push($instruments, $row["filename"]);
    		$picData = new pictureData2();
    		$picData->fullPath = $row["uri"];
    		$picData->picID = $row["picture_id"];
    		$picData->instrumentID=$instrument_id;
    		$picData->serial = $serial;
    		array_push($instruments,$picData);
    		}
    		}catch(Exception $e){
    	//	throw ($e);
    		}
    		mysql_close($con);
    	//	array_push($instruments, "pic/addpic.jpg");
    	if ($addPic){
    		$picData = new pictureData2();
    		$picData->fullPath = "pic/addpic.jpg";
    		$picData->picID = 0;
    		$picData->instrumentID = $instrument_id;
    		$picData->serial = "0";
    		array_push($instruments,$picData);
    	}
    		return $instruments;
   		 }
	
}
?>
