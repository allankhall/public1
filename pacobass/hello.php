<html>
<head>
<title>PHP Test</title>
</head>
<body>
<?php phpinfo(); ?>
<?php 
try{echo 'pp';
    		//connect to DB
   			$con = mysql_connect('localhost:/tmp/mysql.sock', 'root', '') or die(mysql_error());
			mysql_select_db('pacobass') or die(mysql_error()); 
			echo 'llll';
			$result = mysql_query("SELECT * FROM user WHERE username ='pacobass' and status = 'active'")or die(mysql_error());  
			
			$row = mysql_fetch_array( $result );
echo 'kkk';
    		if($row){
    			//save user to session
    			echo 'sgt';
    			echo $row["username"];
    		
    		}	
    				
    	}catch(Exception $e)
    	{echo 'shit';
    		throw ($e);
    	}
    	mysql_close($con);
    	?>
</body>
</html>
