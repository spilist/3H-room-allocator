var selected = new Array();

$(function() {
	
	var selectMax = 5;
	
	function has(seat) {
		for (var i = 0; i < selected.length; i++)
			if (selected[i] == seat)
				return true;
		return false;
	}
	
	// If no seat selected, you cannot apply
	
	function add(seat) {
		//if (selected.length == selectMax)
		//	return alert('Max seat');
		selected[selected.length] = seat;
		$(seat).addClass("seat-selected");
		seat.innerHTML = selected.length; //XXX: hack!
		console.log($(seat));
		
		$("#applyBtn").prop("disabled", false);
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
		
		if (selected.length == 0) $("#applyBtn").prop("disabled", true);
		
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
	var seatArray = [];
	var postValues = {};
	
	for (var i = 0; i < selected.length; i++) {
		var seat = $(selected[i]);
		seatArray.push(seat.attr("sid"));
	}
	
	postValues['seats'] = JSON.stringify(seatArray);
	console.log(postValues['seats']);
	
	$.post($("#applyBtn").attr("action_url"), postValues, function(data) {
  		console.log(data);
  		window.location = $("#applyBtn").attr("redirect_url");
  	});
}

