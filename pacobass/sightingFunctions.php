<?php


require_once("sightingData.php");
require_once("Akismet.class.php");
require_once("constants.php");
class sightingFunctions{
	
public function akismet_comment_check( $key, $data ) {
    $request = 'blog='. urlencode($data['blog']) .
               '&user_ip='. urlencode($data['user_ip']) .
               '&user_agent='. urlencode($data['user_agent']) .
               '&referrer='. urlencode($data['referrer']) .
               '&permalink='. urlencode($data['permalink']) .
               '&comment_type='. urlencode($data['comment_type']) .
               '&comment_author='. urlencode($data['comment_author']) .
               '&comment_author_email='. urlencode($data['comment_author_email']) .
               '&comment_author_url='. urlencode($data['comment_author_url']) .
               '&comment_content='. urlencode($data['comment_content']);
    
    $host = $http_host = $key.'.rest.akismet.com';
    $path = '/1.1/comment-check';
    $port = 80;
    $akismet_ua = "WordPress/3.1.1 | Akismet/2.5.3";
    $content_length = strlen( $request );
    $http_request  = "POST $path HTTP/1.0\r\n";
    $http_request .= "Host: $host\r\n";
    $http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $http_request .= "Content-Length: {$content_length}\r\n";
    $http_request .= "User-Agent: {$akismet_ua}\r\n";
    $http_request .= "\r\n";
    $http_request .= $request;
    $response = '';
    if( false != ( $fs = @fsockopen( $http_host, $port, $errno, $errstr, 10 ) ) ) {
         
        fwrite( $fs, $http_request );
 
        while ( !feof( $fs ) )
            $response .= fgets( $fs, 1160 ); // One TCP-IP packet
        fclose( $fs );
         
        $response = explode( "\r\n\r\n", $response, 2 );
    }
    if ( 'true' == $response[1] ){
       return true;
    }
    else
        return false;

}
	
		public function createReport($sightingD){
    		$report = new sightingData();
    		$report = $sightingD;
    		$resultStatus = "submitted";
    		$spam = false;
    		$last_inserted_row;
    		try{
    			//connect to DB
   				$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
				mysql_select_db(DATABASE) or die(mysql_error());
				$result = mysql_query("select * from blacklist where banned = 'Y' and ip = '$report->clientip'");
				while($row = mysql_fetch_array($result)){
					if ($row['banned'] == 'Y'){
						 $resultStatus = "banned";
					}
				}
			/*
				$akismet = new Akismet('http://pacobass.com' ,AKISMET_KEY);
				//$akismet->setCommentAuthor($name);
				//$akismet->setCommentAuthorEmail($email);
				//$akismet->setCommentAuthorURL($url);
				$akismet->setCommentContent($report->description);
				//$akismet->setPermalink(‘http://www.example.com/blog/alex/someurl/’);
				$isspam = $akismet->isCommentSpam();
				if($isspam){
					$spam = true;
					$resultStatus = "spam";
					mysql_query(
						"INSERT INTO blacklist " .
						"(ip, banned)" .
						"VALUES ( '$report->clientip', 'Y')"
						)or die(mysql_error());
				}
				*/
			
				
    		// Call to comment check
$data = array('blog' => 'http://pacobass.com',
              'user_ip' => '$report->clientip',
              'user_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6',
              'referrer' => 'http://www.google.com',
              'permalink' => 'http://pacobass.com/blog/post=1',
              'comment_type' => 'comment',
              'comment_author' => 'admin',
              'comment_author_email' => 'test@test.com',
              'comment_author_url' => 'http://www.test.com',
              'comment_content' => '$report->description');
if($this->akismet_comment_check(AKISMET_KEY, $data)){
					$spam = true;
					$resultStatus = "spam";
					mysql_query2(
						"INSERT INTO blacklist " .
						"(ip, banned)" .
						"VALUES ( '$report->clientip', 'Y')"
						)or die(mysql_error());
				}

// Passes back true (it's spam) or false (it's ham)

				if($resultStatus == "submitted"){
					$resultStatus = "awaitingpicture";
				}

				mysql_query(
					"INSERT INTO sighting " .
					"(userid, reportid, instrumentid, address_line1, address_line2, city, state, country, zip, description, lat, lng, date_reported, status) " .
					"VALUES ( '$report->userid', '$report->reportid', '$report->instrumentid'," .
					" '$report->addressLine1', '$report->addressLine2', '$report->city', '$report->state', '$report->country'," .
					"'$report->zip', '$report->description', '$report->lat','$report->lng',CURDATE(),'$resultStatus') "
					)or die(mysql_error());
					$last_inserted_row = mysql_insert_id();
				mysql_close($con);
    				
    		}catch(Exception $e){
    		
    		} 
    		return $last_inserted_row;
		}
		
	public function makeActive($sightingID){
		try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
 
             mysql_query("update sighting set status = 'active' where sightingid = '$sightingID'");
    	}catch(Exception $e){
    		throw ($e);
    	    	}
	}
	
	
  	public function getAllSightings($reportid){
   			$sightings = array();
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM sighting WHERE reportid = '$reportid' and status = 'active'")or die(mysql_error());  
			
			//$row = mysql_fetch_array( $result );
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    			$sightingTMP = new sightingData();
    			$sightingTMP->sightingid = $row["sightingid"];
    			$sightingTMP->userid = $row["userid"];
    			$sightingTMP->reportid = $row["reportid"];
    			$sightingTMP->instrumentid = $row["instrumentid"];
    			$sightingTMP->description = $row["description"];
    			$sightingTMP->addressLine1 = $row["address_line1"];
    			$sightingTMP->addressLine2 = $row["address_line2"];
    			$sightingTMP->city = $row["city"];
    			$sightingTMP->state = $row["state"];
    			$sightingTMP->country = $row["country"];
    			$sightingTMP->zip = $row["zip"];
    			$sightingTMP->status = $row["status"];
    			$sightingTMP->statusid= $row["statusid"];
    			$sightingTMP->reportDate = $row["date_reported"];
    			$sightingTMP->lat = $row["lat"];
    			$sightingTMP->lng = $row["lng"];
    			array_push($sightings, $sightingTMP);
    		}
    		}catch(Exception $e){
    		throw ($e);
    		}
    		mysql_close($con);
    		return $sightings;	
   		 }
		

		
		
	
}
?>