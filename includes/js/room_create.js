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
    /*$( "#roomCanvas" ).selectable({
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
    });*/
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
      	
      	//var seat = $( "<div><span>seat</span></div>" ).addClass("seat").addClass("ui-widget-content");
      	var seat = $( "<div></div>" ).addClass("seat").addClass("ui-widget-content");
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
      	$("<div><span>seat</span></div>").addClass("seat-img").appendTo(seat);

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
  	var seatArray = []; //arr? new Array();
  	var postValues = {}; //map? ... 아 이게 json 이랑 똑같네? ........
  	var canvasOffset = $("#roomCanvas").offset(); 
  	
  	for (var i = 0; i < children.length; i++) {
  		//console.log(children[i]);
  		var child = $(children[i]);
		if(child.hasClass("seat")) {
			var seatInfo = {};
			seatInfo['seat_location_x'] = child.offset().left - canvasOffset.left;
			seatInfo['seat_location_y'] = child.offset().top - canvasOffset.top;
			console.log(seatInfo);
			seatArray.push(seatInfo);
		}
  	}
  	
  	postValues['roomJson'] = JSON.stringify(seatArray);
  	
  	console.log(seatArray);
  	console.log(postValues['roomJson']);
  	console.log($("#submitBtn").attr("site_url"));
  	
  	$.post($("#submitBtn").attr("site_url"), postValues, function(data) {
  		console.log(data);
  		//window.location.replace($("#submitBtn").data("site_url"));
  	});
  	//$.post("./create/room", postValues);
  }