<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php   
		ob_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Save Table Location</title>
<?php



		$connection=mysql_connect("localhost","root","");
		if(!$connection)
		{
			die("error in connection Save Table Location " . mysql_error());	
		}
	
		$db=mysql_select_db("zomato",$connection);
		if(!$db)
		{
			die( "error in db" . mysql_error());
		}
		 $id=$_POST['id'];
		 $label=$_POST['label'];
		 $table_type_number=$_POST['table_type_number'];
		$x_left=$_POST['x_left'];
		$y_top=$_POST['y_top'];
		
		$id=mysql_real_escape_string($id);
		$label=mysql_real_escape_string($label);
		$table_type_number=mysql_real_escape_string($table_type_number);
		$x_left=mysql_real_escape_string($x_left);
		$y_top=mysql_real_escape_string($y_top);
		
		$query= "SELECT COUNT(id)
					 FROM tables_save_location 
					WHERE id = '$id' ";
		$result=mysql_query($query) ;
		$check=mysql_result($result, 0);
		if($check !=0)  {
		$query= "UPDATE tables_save_location	
						SET  x_position= '$x_left' , y_position= '$y_top'
						WHERE id= '$id' ";
		$result=mysql_query($query) or  die("not saving local position ");		
		}
		else {
			$query= "INSERT INTO tables_save_location	(id,label,table_type_number,x_position,y_position) VALUES( '$id', '$label','$table_type_number','$x_left','$y_top')";
		$result=mysql_query($query) ;
		}
		
		
		 /*if(isset($_POST['label'])  &&  isset($_POST['table_type_number'])) 
		{
		$query= "DELETE FROM tables_save_location WHERE  table_type_number='$table_type_number' AND 
		label='$label' AND label !=0 ";
		$result=mysql_query($query) or  die("not saving local position ");
		$query= "INSERT INTO tables_save_location	(id,table_type_number,label,x_position,y_position) VALUES( '$id','$table_type_number', '$label','$x_left','$y_top')";
		$result=mysql_query($query) or  die("not saving local position ");
		}
		
		else {  */
		
		//}
 ?>
</head>

<body>
</body>
</html>