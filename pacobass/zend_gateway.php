<?php
 error_reporting(E_ALL | E_STRICT); //optional
 //ini_set("include_path", ini_get("include_path").":/Applications/zend". ":/home1/odustcom". ":/home1/odustcom/Zend".":/Library/ZendFramework-1.11.6/library/Zend".":/Library/ZendFramework-1.11.6/library".":/Users/paco/Sites/pacobass".":/usr/lib/php".":amfobject");
 ini_set("include_path", ini_get("include_path").":/Applications/zend". ":/home1/odustcom". ":/home1/odustcom/Zend".":/Library/ZendFramework-prod/Library/Zend".":/Library/ZendFramework-prod/Library".":/Users/paco/Sites/pacobass".":/usr/lib/php".":amfobject");
 //echo ini_get("include_path");
 require_once "Zend/Amf/Server.php"; //the zendAMF server
 require_once "test_class.php"; 
 require_once "Session.php"; 
  require_once "instrument_functions.php"; //our test class
  require_once "report_functions.php"; //our test class
    require_once "reportFunctions.php"; //our test class
  require_once "uploaderFunctions.php";
  require_once "sightingFunctions.php";
 //require_once "pictureData.php";
 $server = new Zend_Amf_Server(); //declare the server
 Zend_Session::start();
//$server->setSession();
$server->setClass("test_class"); //load our test-class
$server->setClass("instrument_functions"); //load our test-class
$server->setClass("report_functions"); //load our test-class
$server->setClass("reportFunctions"); //load our test-class
$server->setClass("uploaderFunctions"); //load our test-class
$server->setClass("sightingFunctions"); //load our test-class
 //$server -> setClass("userData");
 	$server->setClassMap("userData", "userData");
 	$server->setClassMap("instrumentData", "instrumentData");
 	$server->setClassMap("reportData", "reportData");
 //		$server->setClassMap("pictureData", "pictureData");
 	$server->setClassMap("pictureData2", "pictureData2");
 	 	$server->setClassMap("pMarkerData", "pMarkerData");
 	 		$server->setClassMap("sightingData", "sightingData");
 	 	
 	
 	
 echo($server->handle()); // needed to start the server
 //echo $server -> handle();
// $server -> handle();
?>
