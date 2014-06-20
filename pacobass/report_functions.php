<?php
/*
 * Created on Dec 19, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
 require_once("userData.php");
require_once("constants.php");
require_once("instrumentData.php");
require_once("reportData.php");

class report_functions{
	
	public function __construct() {
	}
	
		public function createReport($reportD){
			/*
			 * $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
			*	$phpdate = strtotime( $mysqldate );
			 */
			
		//get logged in user from session and add instrument
		$myUser = new userData();
    	$myUser = unserialize($_SESSION["user"]);
    	$username = $myUser->username;
    	$userid = $myUser->userID;
    	$report = new reportData();
    	$report = $reportD;
    	$success = false;
    	//$mydate1  = new DateTime();
    	//$mydate1 = $report->dateStolen;
    	//$mydate = date('Y-m-d H:i:s',$reportD->dateStolen);
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query(
					"INSERT INTO report " .
					"(instrument_id, user_id, description, date_stolen, status, city, state, country, zip, reward, reward_bool, address_line_1, address_line_2) " .
					"VALUES ( '$report->instrumentid', '$userid', '$report->description'," .
					" '$report->dateStolen', 'active', '$report->city', '$report->state', '$report->country'," .
					"'$report->zip', '$report->reward', '$report->rewardBool','$report->addressLine1', '$report->addressLine2') "
					)or die(mysql_error());
			mysql_close($con);
			$success = true;
    	}catch(Exception $e){
    		
    	} 
    	return $success;
	}
	
	
			public function getReport($instrumentid){
			/*
			 * $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
			*	$phpdate = strtotime( $mysqldate );
			 */
			
		//get logged in user from session and add instrument
		$myReport = new reportData();
    	//$mydate1  = new DateTime();
    	//$mydate1 = $report->dateStolen;
    	//$mydate = date('Y-m-d H:i:s',$reportD->dateStolen);
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			$result = mysql_query("SELECT * FROM report WHERE instrument_id = '$instrumentid' and status = 'active'")or die(mysql_error());  
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    			$myReport->instrumentid = $row["instrument_id"];
    			$myReport->reportid = $row["report_id"];
    			$myReport->userid = $row["user_id"];
    			$myReport->dateStolen = $row["date_stolen"];
    			$myReport->dateRecovered = $row["date_recovered"];
    			$myReport->status = $row["status"];
    			$myReport->description = $row["description"];
    			$myReport->city = $row["city"];
    			$myReport->state = $row["state"];
    			$myReport->country = $row["country"];
    			$myReport->zip = $row["zip"];
    			$myReport->reward = $row["reward"];
    			$myReport->rewardBool = $row["reward_bool"];
    			$myReport->addressLine1 = $row["address_line_1"];
    			$myReport->addressLine2 = $row["address_line_2"];
    		}
    		}catch(Exception $e){
    		}
    		mysql_close($con);
    		return $myReport;	
	}
	
	public function checkActive($instrumentid, $reportid){
		$onlyOne = true;
			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			$result = mysql_query("SELECT * FROM report WHERE instrument_id = '$instrumentid' and status = 'active'")or die(mysql_error());  
    		while($row = mysql_fetch_array($result)){
    			if($row["report_id"] != $reportid){
    				$onlyOne = false;
    			}

    		}
    		}catch(Exception $e){
    			$onlyOne = false;
    		}
    		mysql_close($con);
		return $onlyOne;
	}
	
	public function updateReport($reportD){

    	$success = false;


    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("Update report SET date_stolen = '$reportD->dateStolen', status = '$reportD->status'," .
					"city = '$reportD->city', state = '$reportD->state', date_recovered = $reportD->dateRecovered," .
					"country = '$reportD->country', zip = '$reportD->zip', description = '$reportD->description'" .
					"address_line_1 ='$reportD->addressLine1', address_line_2 = '$reportD->addressLine2'".
					"where report_id = '$reportD->reportid'")or die(mysql_error());
			mysql_close($con);
			$success = true;
    	}catch(Exception $e){
    		
    	} 
    	return $success;
	}
	
	
}
?>
