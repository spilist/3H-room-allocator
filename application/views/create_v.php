<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Room Allocator Test</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <style>
  #roomCanvas { width: 400px; height: 300px; padding: 0.5em; }
  #roomCanvas h3 { text-align: center; margin: 0; }
  #roomCanvas .ui-selecting { background: #ccc }
  #roomCanvas .ui-selected { background: #999 }
  #seatBtn { width: 50px; height: 50px; padding: 0.5em; }
  #doorBtn { width: 50px; height: 50px; padding: 0.5em; }
  #recycleBin { width: 50px; height: 50px; padding: 0.5em; }
  .seat { width: 50px; height: 50px; padding: 0.5em; }
  .door { width: 50px; height: 50px; padding: 0.5em; }
  </style>
  <script>
  $(function() {
  	var seatCount = 0;
  	var selected = null;
  	var startOfs = null;
  	
    $( "#seatBtn" ).draggable({
    	appendTo: "body",
    	helper: "clone",
    	grid: [ 10, 10 ],
    });
    $( "#doorBtn" ).draggable({
    	appendTo: "body",
    	helper: "clone",
    	grid: [ 10, 10 ],
    });
    $( "#recycleBin" ).droppable({
    	accept: ".seat, .door",
    	drop: function( event, ui ) {
    		ui.draggable.remove();
    	}
    });
    
    $( "#roomCanvas" ).resizable();
    $( "#roomCanvas" ).selectable({
    	filter: ".seat, .door",
    	selecting: function( event, ui ) {
    		selected = new Array();
    	},
    	selected: function( event, ui ) {
    		console.log(ui.selected);
    		//selected = ui.selected;
    		//use filter
    		//once per each item......... fuck.....
    		selected.push(ui.selected);
    		//console.log($(ui.selected).is(ui.selected));
    	},
    	unselected: function( event, ui ) {
    		selected = new Array();//... 사실 얘맨 빼야되는데??
    	}
    });
    $( "#roomCanvas" ).droppable({
      accept: ":not(.seat):not(.door)",
      //accept: ":not(.ui-sortable-helper):not(.seat)",
      drop: function( event, ui ) {
      	//console.log(ui.draggable);
      	//console.log($("#doorBtn"));
      	//console.log(this);
      	//console.log(this.offset());
      	var ofs = $( "#roomCanvas" ).offset();
      	if (ui.draggable.is("#doorBtn")) {
      		var door = $( "<div><p>door</p></div>" ).addClass("door").addClass("ui-widget-content");
      		door.draggable({ grid: [ 10, 10 ] });
	      	door.css({
	      		position:"absolute",
	      		top:ui.position.top - ofs.top,
	      		left:ui.position.left - ofs.left,
	      	});
	
	      	door.appendTo(this);
      		return;
      	}
      	
      	var seat = $( "<div><p>seat</p></div>" ).addClass("seat").addClass("ui-widget-content");
      	seat.draggable({
      		grid: [ 10, 10 ],
      		start: function( event, ui ) {
      			console.log("startstart");
      			startOfs = ui.offset;
      		},
      		drag: function( event, ui ) {
      			/*if(selected) {
      				for(var i = 0; i < selected.length; i++) {
      					var selectedObj = $(selected[i]);
      					var selectedObjOfs = selectedObj.offset();
      					console.log(selectedObjOfs);
      					console.log(ui.offset);
      					console.log(startOfs);
      					console.log("selectedObjOfs");
      					if( !selectedObj.is(this) ) {
      						console.log("diff:");
      						console.log(ui.offset.top - startOfs.top);
      						console.log(ui.offset.left - startOfs.left);
      						selectedObj.css({
      							top: (ui.offset.top - startOfs.top),
      							left: (ui.offset.left - startOfs.left)
      						});
      					}
      				}
      				//console.log(ui.offset);
      			}*/
      		}
      	});
      	seat.css({
      		position:"absolute",
      		top:ui.position.top - ofs.top,
      		left:ui.position.left - ofs.left,
      	});

      	seat.appendTo(this);
		seatCount++;
		//console.log(ui.position);
		//console.log(this);
      }
    });
  });
  
  function asubmit() {
  	console.log("eafe");
  	console.log($("#roomCanvas").children());
  	var children = $("#roomCanvas").children();
  	var seatArray = new Array();
  	var postValues = {};
  	
  	for (var i = 0; i < children.length; i++) {
  		//console.log(children[i]);
  	
		if($(children[i]).hasClass("seat")) {
			console.log("seat!!");
			seatArray.push("seat!!");
		}
  	}
  	
  	//$("#seatArray").value = seatArray;
  	postValues['rooms[]'] = seatArray;
  	postValues['roomJson'] = JSON.stringify(seatArray);
  	console.log(postValues['roomJson']);
  	$.post("<?=site_url('/create/room')?>", postValues, function(data) {
  		console.log(data);
  	});
  	//$.post("./create/room", postValues);
  }
  </script>
</head>
<body>

<div id="seatBtn" class="ui-widget-content">
  <p>seat</p>
</div>
<div id="doorBtn" class="ui-widget-content">
  <p>door</p>
</div>
<div id="roomCanvas" class="ui-widget-content">
  <h3 class="ui-widget-header">Room</h3>
  <!--<div class="seat ui-widget-content"><p>seat</p></div>-->
</div>
<div id="recycleBin" class="ui-widget-content">
  <p>delete</p>
</div>

<!-- button test -->
<!--<input type="submit" value="A submit button" />-->
<!--<form action="<?=site_url('/create/room')?>" method="post" onsubmit="asubmit()">-->
<!--<form onsubmit="asubmit()">-->
	<input id="seatArray" name="seats[]" type="hidden" />
	<input name="test" type="hidden" value="1212" />
	<input type="submit" value="create" onclick="asubmit()" />
<!--</form>-->

</body>
</html>

