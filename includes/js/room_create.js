$(function() {
  	var seatCount = 0;
  	var selected = null;
  	var startOfs = null;
  	
  	$(".seat").draggable({ grid: [ 10, 10 ] });
  	$(".door").draggable({ grid: [ 10, 10 ] });
  	
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
      		var door = $( "<div><span>door</span></div>" ).addClass("door").addClass("ui-widget-content");
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
      	var seat = $( "<div><span>seat</span></div>" ).addClass("seat").addClass("ui-widget-content");
      	seat.draggable({ grid: [ 10, 10 ] });
      	seat.css({
      		position:"absolute",
      		top:ui.position.top - ofs.top,
      		left:ui.position.left - ofs.left,
      	});
      	//$("<div><span>seat</span></div>").addClass("seat-img").appendTo(seat);

      	seat.appendTo(this);
		seatCount++;
		//console.log(ui.position);
		//console.log(this);
      }
    });
  });
  
  function roomSubmit() {
  	console.log("eafe");
  	console.log($("#roomCanvas").children());
  	var children = $("#roomCanvas").children();
  	var seatArray = []; //arr
  	var objArray = [];
  	var postValues = {}; //map
  	var canvasOffset = $("#roomCanvas").offset(); 
  	
  	for (var i = 0; i < children.length; i++) {
  		var child = $(children[i]);
		if(child.hasClass("seat")) {
			var seatInfo = {};
			seatInfo['seat_location_x'] = child.offset().left - canvasOffset.left;
			seatInfo['seat_location_y'] = child.offset().top - canvasOffset.top;
			seatArray.push(seatInfo);
		}
		else if(child.hasClass("door")) {
			var objInfo = {};
			objInfo['object_location_x'] = child.offset().left - canvasOffset.left;
			objInfo['object_location_y'] = child.offset().top - canvasOffset.top;
			objArray.push(objInfo);
		}
  	}
  	
  	postValues['roomJson'] = JSON.stringify(seatArray); //XXX: rename to seat array
  	postValues['roomName'] = $("#room_name").val();
  	postValues['work'] = $("#work").val();
  	postValues['roomWidth'] = $("#roomCanvas").width();
  	postValues['roomHeight'] = $("#roomCanvas").height();
  	postValues['objects'] = JSON.stringify(objArray);
  	
  	console.log(seatArray);
  	console.log(postValues['roomJson']);
  	console.log($("#submitBtn").attr("create_url"));
  	
  	var url;
  	if ($("#work").val() == "modify")
  		url = $("#submitBtn").attr("update_url");
  	else
  		url = $("#submitBtn").attr("create_url");
  	
  	$.post(url, postValues, function(data) {
  		console.log(data);
  		//window.location.replace($("#submitBtn").data("site_url"));
  		//application/make_new/1/1
  		window.location = $("#submitBtn").attr("redirect_url");
  	});
  	//$.post("./create/room", postValues);
  }