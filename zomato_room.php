<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-script-type" content="text/javascript" />
    <meta http-equiv="content-style-type" content="text/css" />
    <title>Zomato Resturant Tables Arrangement</title>
    <meta name="description" content="tables" />
    <script src="jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	  //  google.load("jquery", "1.4.2");
		//google.load("jqueryui", "1.7.2");
	</script>

	<link rel="stylesheet" type="text/css" href="style.css" media="all" />
	<script type="text/javascript">
					
	 var  counter=0;
	 var  label=0;
	    var x2 = new XMLHttpRequest();
        x2.onreadystatechange = function() {
            if (x2.readyState == 4 && x2.status == 200) {
                iteration = x2.responseText;
            }
        }
        x2.open("GET", "get_counter_value.php", true);
        x2.send();  
		
	$(window).load(function() { 
   		 $("#frame").load("fetch_table_location.php");
							//for(i=1;i<4;i++) {
								//			name= "#clonediv"+i;	
								//			console.log(name); 
											i=0;
											setInterval(function() {
											$("#clonediv"+i++).draggable({       
											//obstacle:".ui-draggable dropped+i",
											//preventCollision: true, 
											containment: 'parent',
											stop:function(ev, ui) {
											var pos=$(ui.helper).offset();
											str=$(this).attr("id");
											var id_no=str.replace(/^\D+/g, "")
											str2= $(this).attr("class");
											table_type =str2.replace(/^\D+|\D+$/g, "")  //table id perfect 
											console.log(table_type);
											$.post("save_table_location.php",{id:id_no, x_left: pos.left, y_top: pos.top });
											}
											}) ;
											
											$("#clonediv"+i).selectable();
											$("p").selectable();
											
											$("#delete").click(function() {
													$('p .ui-selected').hide();
												});  
											 }, 100);
						//	}
		 
		 var x = new XMLHttpRequest();
        x.onreadystatechange = function() {
            if (x2.readyState == 4 && x2.status == 200) {
                counter = x.responseText;
            }
        }
        x.open("GET", "get_counter_value.php", true);
        x.send();
		
		 var x1 = new XMLHttpRequest();
        x1.onreadystatechange = function() {
            if (x1.readyState == 4 && x1.status == 200) {
                label = x1.responseText;
            }
        }
        x1.open("GET", "get_label_value.php", true);
        x1.send();

		});
			 
    $(document).ready(function(){
        counter = 0;
		label=0;
        //Make element draggable
		$(".drag").draggable({
            helper:'clone',
            containment: 'frame',
            //When first dragged     --   illusion
            stop:function(ev, ui) {
            	var pos=$(ui.helper).offset();
            	objName = "#clonediv"+counter
            	$(objName).css({"left":pos.left,"top":pos.top});
            	$(objName).removeClass("drag");
				
                $(objName).draggable({       
                	containment: 'parent',
                    stop:function(ev, ui) {
                    	var pos=$(ui.helper).offset();
						str=$(this).attr("id");
						var id_no=str.replace(/^\D+/g, "")
                    	console.log(id_no);  //comes cloning attributes   // gives  id 
						console.log(pos.left)
                        console.log(pos.top)
						str2= $(this).attr("class");
                        table_type =str2.replace(/^\D+|\D+$/g, "")  //table id perfect 
						console.log(table_type);
						$.post("save_table_location.php",{id:id_no, x_left: pos.left, y_top: pos.top });
                    }
                }); 
				
            }	
        });
		
        //Make element droppable    -first it should come here
        $("#frame").droppable({
			drop: function(ev, ui) {
				if (( ui.helper.attr('id').search(/drag[0-9]/) != -1 )  ){
					expression = ui.helper.attr('id').search(/drag([0-9])/)
                    expr = RegExp.$1
				    if(expr == 1 || expr == 2 || expr == 5)    { label++;  } 
					counter++; 
					var element=$(ui.draggable).clone();    //cloning starting actual
					element.addClass("tempclass");
					$(this).append(element); 
					$(".tempclass").attr("id","clonediv"+counter);
					$("#clonediv"+counter).removeClass("tempclass");
	
					//Get the dynamically item id
					droppedNumber = ui.helper.attr('id').search(/drag([0-9])/)
					itemDropped = "dropped" + RegExp.$1

					console.log(itemDropped)
					var pos=$(ui.helper).offset();
					//console.log($(this).attr("id"));
					var table_type = RegExp.$1;
					var x = pos.left;
					var y = pos.top;
					console.log(pos.left)   // first time dropping coordinates 
                    console.log(pos.top) 
					//if( table_type ==1 || table_type ==2 ||  table_type ==5 ) 
					//element.append('<span style= "left:' +  x + "px" + '; top: ' +  y + "px"  + '"> '  +  label + '</span>');
					//element.append('<div style= "left:' +  0 + "px" + '; top: ' +  0 + "px"  + '"> '  +  label + '</div>');
					$("#clonediv"+counter).addClass(itemDropped);
					if( table_type ==1 )    {
						element.prepend('<img id="top_chair_square" src="chair.svg"/>');
						element.append('<img id="left_chair_square" src="chair-vertical.svg"/>');
						element.append('<img id="right_chair_square" src="chair-vertical.svg"/>');
					element.append('<p style= "margin: 0px; padding-top:' +  41 + "px" + '; padding-left:' +  46 + "px" + ';padding-right:' +  46 + "px" + '	;padding-bottom: ' +  41 + "px"  +  ';	font-size: ' +  20 + "px"  +'"> '  +  label + '</p>');
					element.append('<img id="bottom_chair_square" src="chair.svg"/>');
					$.post("save_table_location.php",{id:counter,label:label, table_type_number: table_type , x_left: pos.left, y_top: pos.top });   }
					else if( table_type ==2 )   { 
						element.prepend('<img id="top_chair_circle" src="chair.svg"/>');
						element.append('<img id="left_chair_circle" src="chair-vertical.svg"/>');
						element.append('<img id="right_chair_circle" src="chair-vertical.svg"/>');
						element.append('<p style= "margin: 0px; padding-top:' +  41 + "px" + '; padding-left:' +  46 + "px" + ';padding-right:' +  46 + "px" + ';	padding-bottom: ' +  41 + "px"  +  ';	font-size: ' +  20 + "px"  + '"> '  +  label + '</p>');
					element.append('<img id="bottom_chair_circle" src="chair.svg"/>');
					$.post("save_table_location.php",{id:counter,label:label, table_type_number: table_type , x_left: pos.left, y_top: pos.top });   }				else if( table_type ==5 )  {
						element.prepend('<img id="top1_chair_rect" src="chair.svg"/>');
						element.append('<img id="top2_chair_rect" src="chair.svg"/>');
					element.append('<p style= "margin: 0px; padding-top:' +  41 + "px" + '; padding-left:' +  92 + "px" + ';padding-right:' +  92 + "px" + ';	padding-bottom: ' +  41 + "px"  +  ';	font-size: ' +  20 + "px"  + '"> '  +  label + '</p>');
					element.append('<img id="bottom1_chair_rect" src="chair.svg"/>');
					element.append('<img id="bottom2_chair_rect" src="chair.svg"/>');
					$.post("save_table_location.php",{id:counter,label:label, table_type_number: table_type , x_left: pos.left, y_top: pos.top }); }	            
					 else  {
					$.post("save_table_location.php",{id:counter,label:0, table_type_number: table_type , x_left: pos.left, y_top: pos.top });   
					 }
				}
        	}
        });
		
    $("#save").click(function() {   
        // $.post("fetch_table_location.php",{save_the_final_data: 12});
        $("#frame").load("fetch_table_location.php");
		
		i=0;
		setInterval(function() {
		$("#clonediv"+i++).draggable({  
		containment: 'parent',
		stop:function(ev, ui) {
		console.log(clonediv+i);
		var pos=$(ui.helper).offset();
		str=$(this).attr("id");
		var id_no=str.replace(/^\D+/g, "")
		str2= $(this).attr("class");
		table_type =str2.replace(/^\D+|\D+$/g, "")  //table id perfect 
		console.log(table_type);
		$.post("save_table_location.php",{id:id_no, x_left: pos.left, y_top: pos.top });
		}
		})  }, 100);
    });
		 
  });
	</script>

</head>
<!--<body onload="$("#frame").load("fetch_table_location.php");">-->
<body> 
<div>
<span id="title"><h2>Zomato: Restaurant Tables Arrangement
<!--<button id="load" class="load_button" type="submit"> Load</button> -->
<button id="save" class="save_button" type="submit"> Save</button>
</h2>  
</span>
</div>
<div id="wrapper">
	<div id="options">
		<div id="drag1" class="drag"></div> 
		<div id="drag2" class="drag"></div> 
		<div id="drag3" class="drag"></div>
        <div id="drag4" class="drag"></div> 
        <div id="drag5" class="drag"></div>
        <div id="section1">
        <input id="enter_table_num" class="enter_table" type="number" onkeyup="display_table_num(this.value)"/>
        <p id="table_selected"></p>
        <button id="delete" class="delete_button" type="submit"> Delete</button>
        </div>
	</div>
	<div id="frame">
	</div>
</div>
</body>
<script>
	function display_table_num(str)  {
		if(isNaN(str)) alert("sdfgdsfg");
		else document.getElementById("table_selected").innerHTML=str;
	}
</script>
</html>