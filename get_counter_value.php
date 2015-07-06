<?php

$connection=mysql_connect("localhost","root","");
		if(!$connection)
		{
			die("error in connection Fetch Table Location " . mysql_error());	
		}
	
		$db=mysql_select_db("zomato",$connection);
		if(!$db)
		{
			die( "error in db" . mysql_error());
		}
		 $query= "SELECT MAX(id) FROM tables_save_location";
		 $result=mysql_query($query) or  die("not saving local position");
		 $label=mysql_result($result, 0);
			echo $label;  
	 ?>