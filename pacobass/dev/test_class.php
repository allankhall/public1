<?php
	//session_start();
	//Zend_Session::start();
	require_once ("userData.php");
	require_once("constants.php");
class test_class {
	
	public function __construct() {
	}
	
//	
//	  save user to session and return username
//	  or return "anonymous" if authentication
//	  fails
//	  @public
//	  @param string username, string description 
//	  @return string usernamedescription
//	
    public function authenticate($username, $password){
    	$returnUser = "anonymous";
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM user WHERE username ='$username' and password = aes_encrypt('$password', \"AES_KEY\") and status = 'active'")or die(mysql_error());  
			$user = new userData();
			$row = mysql_fetch_array( $result );

    		if($row){
    			//save user to session
    			$user->username = $row["username"];
    			$user->lastName = $row["last_name"];
    			$user->firstName = $row["first_name"];
    			$user->email = $row["email"];
    			$user->userID = $row["user_id"];
    			$user->status = $row["status"];
    			$user->role = $row["role"];
    		//	**$_SESSION["user"]= serialize($user);
    			$returnUser = $username;
    		}	
    		$result2 = mysql_query("SELECT aes_decrypt(password, \"AES_KEY\") as decryptedPassword, username FROM user WHERE username ='$username'")or die(mysql_error());  
			$row2 = mysql_fetch_array( $result2 );
    		if($row2){
				$user->password = $row2["decryptedPassword"];    			
    		}
    	}catch(Exception $e){
    		throw ($e);
    	}
    	mysql_close($con);
    	$_SESSION["user"] = serialize($user);
    	return $returnUser;	
    }
    
//    
//     return user object from php session
//      @public
//      @return userData 
//   	 
    public function getUserData(){
    	return unserialize($_SESSION["user"]);		
    }
    
//    
//      destroy session
//      @public
//     
    public function logout(){
    	// Initialize the session.
	//	session_start();

		// Unset all of the session variables.
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
    		$params = session_get_cookie_params();
   		 	setcookie(session_name(), '', time() - 42000,
        			$params["path"], $params["domain"],
        			$params["secure"], $params["httponly"]
    		);
		}

	// Finally, destroy the session.
	session_destroy();
    }

//	
//	  generate random string
//	  @public
//	 
    public function generateKey()
    {
    	return sha1(microtime(true).mt_rand(10000,90000));
    }
    
//    
//      insert new user into database
//      generate activation key
//      send activation email
//      @public
//      @param string username, string password, string firstname, string lastname, string email
//     
    public function register($username, $password, $firstname, $lastname, $email)
    {
    	$success = false;
    	$activationCode = $this->generateKey();
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("INSERT INTO user (username, password, first_name, last_name, email, activation_key, role) VALUES ( '$username', aes_encrypt('$password', \"AES_KEY\"), '$firstname', '$lastname', '$email', '$activationCode', 'contributor')")or die(mysql_error());
			mysql_close($con);
			$success = true;
			$this->sendActivationEmail($activationCode, $email, $username);
    	}catch(Exception $e){
    		throw($e);
    	} 
    	return $success;
    }
    
    public function updateUser($newUser)
    {
    	
    	$success = false;
    	$uncryptedPassword = $newUser->password;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("UPDATE user SET first_name = '$newUser->firstName', last_name = '$newUser->lastName', password = aes_encrypt('$uncryptedPassword', \"AES_KEY\"), email = '$newUser->email' WHERE username = '$newUser->username'")or die(mysql_error());
			return true;
			mysql_close($con);
			$success = true;
    	}catch(Exception $e){
    		throw($e);
    	} 
    	return $success;
    }
    
      public function updateUserStatus($user, $body, $subject, $status)
    {
    	$username = $user->username;
    	
    	$success = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("UPDATE user SET status = '$status' WHERE username = '$username'")or die(mysql_error());
			mysql_close($con);
			$this->sendUpdateEmail($user, $body,$subject);
			$success = true;
    	}catch(Exception $e){
    		throw($e);
    	} 
    	return $success; 
    }
    
    public function updateUserRole($user, $body, $subject, $role)
    {
    	$username = $user->username;
    	
    	$success = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("UPDATE user SET role = '$role' WHERE username = '$username'")or die(mysql_error());
			mysql_close($con);
			$this->sendUpdateEmail($user, $body,$subject);
			$success = true;
    	}catch(Exception $e){
    		throw($e);
    	} 
    	return $success; 
    }
    
//    
//      check to see if username exists
//      @public
//      @param string username
//      @return boolean true if exists
//     
    public function userExists($username)
    {
    	$exists = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM user WHERE username ='$username'")or die(mysql_error());  
			$row = mysql_fetch_array( $result );
    		if($row){
    			$exists = true;
    		}
    	}catch(Exception $e){
    		throw ($e);
    	}
    	mysql_close($con);
    	return $exists;	
    	
    	
    }
    
//    
//     check to see if email is already registered
//     @public
//      @param string email
//      @return boolean treuy if registered
//     
   public function emailRegistered($email)
    {
    	$registered = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM user WHERE email ='$email'")or die(mysql_error());  
			$row = mysql_fetch_array( $result );
    		if($row){
    			$registered = true;
    		}
    	}catch(Exception $e){
    		throw ($e);
    	}
    	mysql_close($con);
    	return $registered;	
    	
    	
    }
    
//    
//     check to see if email is already registered
//     @public
//      @param string email
//      @return boolean treuy if registered
//     
   public function updateEmailRegistered($email)
    {
    	$myUser = new userData();
    	$myUser = unserialize($_SESSION["user"]);
    	$username = $myUser->username;
    	$registered = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM user WHERE email ='$email' AND username != '$username'")or die(mysql_error());  
			$row = mysql_fetch_array( $result );
    		if($row){
    			$registered = true;
    		}
    	}catch(Exception $e){
    		throw ($e);
    	}
    	mysql_close($con);
    	return $registered;	
    	
    	
    }
    

//    
//      send activation emai
//      @public
//      @param string key, string email to, string username
//     
    public function sendActivationEmail($key, $to, $username)
    {
    	try
    	{
    		$message = "From : allankhall.com admin\nTo:$to\nThis email address has been used to register an account at pacobass.com. To complete the registration go to the following url: \n http://pacobass.com/activation.php?code=$key&username=$username";
    		mail($to,"Account Activation at pacobass.com", stripslashes($message), "From: allan@allankhall.com");
    	}catch(Exception $e)
    	{
    		throw($e);
    	}
   	}
   	
//   	
//   	  send password to user
//   	  @public
//   	  @param string email
//   	  @return boolean true if password sent
//     
   	public function sendPassword($email)
   	{
   		$passwordFound = false;
   		$passwordResult = "";
   		try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT aes_decrypt(password, \"AES_KEY\") as decryptedPassword, username FROM user WHERE email ='$email'")or die(mysql_error());  
			$row = mysql_fetch_array( $result );

    		if($row){
    			$passwordResult = $row["decryptedPassword"];
                        $usernameResult = $row["username"];
    			$this->sendEmail($email, $passwordResult, $usernameResult);
    			$passwordFound = true;

    		}
    	}catch(Exception $e){
    		throw ($e);
    	}
    	mysql_close($con);
    	return $passwordFound;
   	}
   	
//   	
//   	  helper to send password
//   	  @private
//   	  @param string email to, string password, string username
//     
   	private function sendEmail($to, $password, $username){
   		  	try
    	{
    		$message = "From : allankhall.com admin\nTo:$to\nThe username for your account is : $username\nThe password for your account is : $password";
    		mail($to,"Forgotten Password at pacobass.com", stripslashes($message), "From: allan@allankhall.com");
    	}catch(Exception $e)
    	{
    		throw($e);
    	}
   	}
   	
   	public function emailUser($user,$body, $subject)
   	{
   		$sent = false;
   		try
   		{
   			$this->sendUpdateEmail($user, $body, $subject);
   			$sent = true;
   		}
   		catch(Exception $e)
   		{
   			$sent  = false;
   		}
   		return $sent;
   	}
   	
   	   private function sendUpdateEmail($user, $body, $subject){
   		  	try
    	{
    		$message = "From : allankhall.com admin\nTo:$user->firstName $user->lastName\n$body";
    		mail($user->email, "$subject", stripslashes($message), "From: allan@allankhall.com");
    	}catch(Exception $e)
    	{
    		throw($e);
    	}
   	}
   	
   	public function deleteUser($user, $body, $subject)
    {
    	$username = $user->username;
    	$success = false;
    	try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error());
			mysql_query("DELETE FROM user WHERE username = '$username'")or die(mysql_error());
			mysql_close($con);
			$this->sendUpdateEmail($user, $body,$subject);
			$success = true;
    	}catch(Exception $e){
    		throw($e);
    	} 
    	return $success; 
    }
   	
   	public function getAllUsers(){
   			$users = array();
   			try{
    		//connect to DB
   			$con = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
			mysql_select_db(DATABASE) or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM user WHERE true")or die(mysql_error());  
			$user = new userData();
			//$row = mysql_fetch_array( $result );
    		while($row = mysql_fetch_array($result)){
    			//save user to session
    			$user = new userData();
    			$user->username = $row["username"];
    			$user->lastName = $row["last_name"];
    			$user->firstName = $row["first_name"];
    			$user->email = $row["email"];
    			$user->userID = $row["user_id"];
    			$user->status = $row["status"];
    			$user->role = $row["role"];	
    			$result2 = mysql_query("SELECT aes_decrypt(password, \"AES_KEY\") as decryptedPassword, username FROM user WHERE username ='$user->username'")or die(mysql_error());  
				$row2 = mysql_fetch_array( $result2 );
    			if($row2){
					$user->password = $row2["decryptedPassword"];    			
    			}
    			array_push($users, $user);
    		}
    		}catch(Exception $e){
    		throw ($e);
    		}
    		mysql_close($con);
    		return $users;	
   		 }

}
?>