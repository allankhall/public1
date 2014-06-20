<?php

require_once("pictureData.php");
require_once("userData.php");
require_once("constants.php");

class uploader_functions {
	

	public function __construct() {
	}
		
	public function uploadPic($instID, $picDTA){
		try{
			$picture = $picDTA->fileData;
			file_put_contents( 'images/' . $picDTA->fileName, $picture);
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
	
	  	public function getPictureURI($instrument_id){
   			$instruments = array();
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM picture WHERE instrument_id = '$instrument_id'")or die(mysql_error()); 
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
	
}
?>
