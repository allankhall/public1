<?php


require_once("userData.php");
require_once("constants.php");
require_once("pictureData2.php");

class uploaderFunctions {
	

	public function __construct() {
	}
		
	public function uploadPic($instID, $picDTA){
		//getusernamefromsession
		$picID;
		$myUser = new userData();
    	$myUser = unserialize($_SESSION["user"]);
    	$username = $myUser->username;
		//insert into with username+inst_id+pic_id
		try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			//insert default pic then get pic id
			$result = mysql_query("INSERT INTO picture (instrument_id,filename,root_path)
			VALUES ($instID, 'bass.jpg','pic/')")or die(mysql_error());  
             $picID = mysql_insert_id();
             

            $result = mysql_query("UPDATE picture SET root_path = 'images/', filename = CONCAT('$username', $picID, '$picDTA->fileName') where picture_id = $picID")
             or die(mysql_error());
             
             $result = mysql_query("SELECT CONCAT (root_path, filename) as path FROM picture WHERE picture_id = $picID") or die(mysql_error());
			$row = mysql_fetch_array( $result );
    		if($row){
    			$path = $row["path"];
   			
    		}  

    	}catch(Exception $e){
    		throw ($e);
    	    	}
    	
   	mysql_close($con);
    /*	return $registered;*/
		//put file to server
		try{
			$picture = $picDTA->fileData;
		//	file_put_contents( 'images/' . $picDTA->fileName, $picture);
		file_put_contents( $path, $picture);
			return true;	
		}catch (Exception $e){
                  throw new Exception($e->getMessage());			
		}
	}


	public function uploadSightingPic($sightingID, $picDTA){
		//getusernamefromsession

		//insert into with sightingid+file
		try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			//insert default pic then get pic id
			$result = mysql_query("INSERT INTO sightingpic (sighting_id,filename,root_path)
			VALUES ($sightingID, CONCAT('report', $sightingID, '$picDTA->fileName'),'pic/')")or die(mysql_error());  
             mysql_query("update sighting set status = 'active' where sighting_id = '$sightingID'");
    	}catch(Exception $e){
    		throw ($e);
    	    	}
    	
   	mysql_close($con);
    /*	return $registered;*/
		//put file to server
		try{
			$picture = $picDTA->fileData;
		//	file_put_contents( 'images/' . $picDTA->fileName, $picture);
		$path = 'pic/'.'report'.$sightingID.$picDTA->fileName;
		file_put_contents( $path, $picture);
			return true;	
		}catch (Exception $e){
                  throw new Exception($e->getMessage());			
		}
	}
	
/*
	public function getName(){
		$myUser = new userData();
    	$myUser = unserialize($_SESSION["user"]);
    	$username = $myUser->username;
    	return $username;
	}
	*/
	
	/*  	public function getPictureURI($instrument_id){
   			$instruments = array();
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT filename FROM picture WHERE instrument_id = '$instrument_id'")or die(mysql_error()); 
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
   		 }*/
	
	  	public function getPictureURI($instrument_id){
   			$instruments = array();
   		$instID;
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT CONCAT(root_path, filename) as uri, picture_id, instrument_id FROM picture WHERE instrument_id = '$instrument_id'")or die(mysql_error()); 
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    		//	array_push($instruments, $row["filename"]);
    		$picData = new pictureData2();
    		$picData->fullPath = $row["uri"];
    		$picData->picID = $row["picture_id"];
    		$picData->instrumentID->$row["instrument_id"];
    		$instID->instrumentID->$row["instrument_id"];
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
    		$picData->instrumentID = $instID;
    		array_push($instruments,$picData);
    		return $instruments;
   		 }

   	public function deletePicture($picID){
   		$success = false;
			 try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT CONCAT(root_path, filename) as uri FROM picture WHERE picture_id = '$picID'")or die(mysql_error()); 
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    		//	array_push($instruments, $row["filename"]);
    		unlink($row["uri"]);
    		mysql_query("DELETE FROM picture WHERE picture_id = '$picID'")or die(mysql_error());
			$success = true;
    		}
    		}catch(Exception $e){
    	//	throw ($e);
    		}
    		mysql_close($con);
    		return $success;
	}
	
	public function deleteInstrumentPics($instrumentID){
			 try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT CONCAT(root_path, filename) as uri, picture_id FROM picture WHERE instrument_id = '$instrumentID'")or die(mysql_error()); 
    		while($row = mysql_fetch_array($result)){
    		unlink($row["uri"]);
    		$picID = $row["picture_id"];
    		mysql_query("DELETE FROM picture WHERE picture_id = '$picID'")or die(mysql_error());
    		}
    		}catch(Exception $e){
    	//	throw ($e);
    		}
    		mysql_close($con);
    		return;
		
	}
	
	
	public function canUpload($instrumentID){
		    $canUpload = true;
		    return $canUpload;
			$numberOfPics;
			 try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT count(*) as quantity FROM picture WHERE instrument_id = '$instrumentID'")or die(mysql_error()); 
    		while($row = mysql_fetch_array($result)){
			$numberOfPics = $row["quantity"];
    		}
    		}catch(Exception $e){
    	//	throw ($e);
    		}
    		mysql_close($con);
    		if($numberOfPics > 10){
    			$canUpload = false;
    		}
    		return $canUpload;
		
	}
}
?>
