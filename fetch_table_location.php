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
		 $query= "SELECT * FROM tables_save_location";
		 $result=mysql_query($query) or  die("not saving local position");
		  
		 while ($row = mysql_fetch_array($result)) {
     		  // echo $row['table_type_number'];
			   //echo $row['label'];
			  //echo $row['x_position'];
			  // echo $row['y_position'];
			  //  echo" <div id="clonediv1" class="ui-draggable dropped1" style="left: $row['x_position']px; top: $row['y_position']px;"> </div>    ";			
			 if($row['table_type_number']==1) {
			echo "<div id=\"clonediv{$row['id']}\"     class=\"ui-draggable dropped{$row['table_type_number']}\"
			style=\"left: {$row['x_position']}px; top: {$row['y_position']}px;\"> <img id=\"top_chair_square\" src=\"chair.svg\"><img id=\"left_chair_square\" src=\"chair-vertical.svg\"><img id=\"right_chair_square\" src=\"chair-vertical.svg\"><p style=\" margin: 0px; padding-top:41px; padding-left:46px;padding-right:46px;	padding-bottom: 41px;	font-size: 20px\">  {$row['label']} </p><img id=\"bottom_chair_square\" src=\"chair.svg\"> </div>";
						 }
			if($row['table_type_number']==2) {
			echo "<div id=\"clonediv{$row['id']}\"     class=\"ui-draggable dropped{$row['table_type_number']}\"
			style=\"left: {$row['x_position']}px; top: {$row['y_position']}px;\"><img id=\"top_chair_circle\" src=\"chair.svg\"><img id=\"left_chair_circle\" src=\"chair-vertical.svg\"><img id=\"right_chair_circle\" src=\"chair-vertical.svg\"> <p style=\"; margin: 0px; padding-top:41px; padding-left:46px;padding-right:46px;	padding-bottom: 41px;	font-size: 20px\">  {$row['label']} </p><img id=\"bottom_chair_circle\" src=\"chair.svg\"> </div>";
						 }
			if($row['table_type_number']==3) {
			echo "<div id=\"clonediv{$row['id']}\"     class=\"ui-draggable dropped{$row['table_type_number']}\"
			style=\"left: {$row['x_position']}px; top: {$row['y_position']}px;\">  </div>";
						 }
			if($row['table_type_number']==4) {
			echo "<div id=\"clonediv{$row['id']}\"     class=\"ui-draggable dropped{$row['table_type_number']}\"
			style=\"left: {$row['x_position']}px; top: {$row['y_position']}px;\"> </div>";
						 }			 			 
			if($row['table_type_number']==5) {
			echo "<div id=\"clonediv{$row['id']}\"     class=\"ui-draggable dropped{$row['table_type_number']}\"
			style=\"left: {$row['x_position']}px; top: {$row['y_position']}px;\"><img id=\"top1_chair_rect\" src=\"chair.svg\"/> <img id=\"top2_chair_rect\" src=\"chair.svg\"/><p style=\"display: inline-block; margin: 0px; padding-top:41px; padding-left:92px;padding-right:92px;	padding-bottom: 41px;	font-size: 20px\">  {$row['label']} </p><img id=\"bottom1_chair_rect\" src=\"chair.svg\"/> <img id=\"bottom2_chair_rect\" src=\"chair.svg\"/></div>";
						 }
  		 }
		
	 ?>