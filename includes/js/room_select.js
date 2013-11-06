var selected = new Array();

$(function() {
	
	var selectMax = 5;
	
	function has(seat) {
		for (var i = 0; i < selected.length; i++)
			if (selected[i] == seat)
				return true;
		return false;
	}
	
	function add(seat) {
		//if (selected.length == selectMax)
		//	return alert('Max seat');
		selected[selected.length] = seat;
		$(seat).addClass("seat-selected");
		seat.innerHTML = selected.length; //XXX: hack!
		console.log($(seat));
	}
	
	function remove(seat) {
		for (var i = 0; i < selected.length; i++) {
			if (selected[i] == seat) {
				for (var j = i; j < selected.length - 1; j++) {
					selected[j] = selected[j+1];
					selected[j].innerHTML = j+1;
				}
				selected.length--;
				$(seat).removeClass("seat-selected");
				seat.innerHTML = "seat";
				break;
			}
		}
		return i;
	}
	
	$(".room").selectable({
		filter: ".seat",
		selected: function(event, ui) {
			if (has(ui.selected)) {
				remove(ui.selected);
			} else {
				add(ui.selected);	
			}
		}
	});
});

function doApply()
{
	console.log(selected);
	
	//XXX: 아... 이게 아니고 seat id 를 가지고 있어야 하고...... 그거에 맞게 apply 가 되어야 할듯 ㅇㅇ
	var postValues = {};
	postValues['seats'] = JSON.stringify(selected);
	console.log(postValues['seats']);
	
	$.post($("#applyBtn").attr("create_url"), postValues, function(data) {
  		console.log(data);
  		//window.location = $("#submitBtn").attr("redirect_url");
  	});
	
	/*
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
  	console.log($("#submitBtn").attr("create_url"));
  	
  	$.post($("#submitBtn").attr("create_url"), postValues, function(data) {
  		console.log(data);
  		//window.location.replace($("#submitBtn").data("site_url"));
  		//application/make_new/1/1
  		window.location = $("#submitBtn").attr("redirect_url");
  	});*/
}
