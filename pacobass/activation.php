<?php
/*
 * Created on Jan 2, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once("constants.php");
 $code = $_GET["code"];
 $user = $_GET["username"];
 try{ 
 	 $con = mysql_connect(SOCKET, USERNAME, PASSWORD) or die(mysql_error());
	 mysql_select_db(DATABASE) or die(mysql_error()); 
	mysql_query("UPDATE user SET status = 'active' WHERE username ='$username' and activation_key = '$code'")or die(mysql_error());   
    $result = mysql_query("SELECT * FROM user WHERE username ='$username' and status = 'active'")or die(mysql_error());  
    $row = mysql_fetch_array( $result );
    if($row){    ?>
         <h1>Your Account Has Been Activated</h1>
    <?php
     }else{
	?>
	      <h1>Your Account could not be activated</h1>
	<?php
    }
  }catch(Exception $e){}
?>