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