var selected = new Array();

$(function() {
	
	var selectMax = $(".max-seats").attr("max-seats");	
	
	function has(seat) {
		if ($(seat).attr("prio") > 0) return true;
		else return false;		
	}
	
	// If no seat selected, you cannot apply
	
	function add(seat, isModify) {
		if (selected.length == selectMax)
			return alert('Max seat');
		
		selected[selected.length] = seat;
		$(seat).addClass("seat-selected");
		if (isModify == false) {
			$(seat).attr("prio", selected.length);
		}
		$(seat).html($(seat).attr("prio"));
		//console.log($(seat));				
		
		$("#applyBtn").prop("disabled", false);		
	}
	
	function remove(seat) {
		var target = $(seat).attr("prio");
		$(".seat").each(function() {
			var cur = $(this).attr("prio");
			if (cur > target) {
				cur--;
				$(this).attr("prio", cur);
				$(this).html(cur);					
			}				
		});
		
		selected.length--;		
		$(seat).removeClass("seat-selected");
		$(seat).attr("prio", 0);
		seat.innerHTML = "seat";
		
		if (selected.length == 0) $("#applyBtn").prop("disabled", true);				
	}
	
	$(".room").selectable({
		filter: ".seat",
		selected: function(event, ui) {
			if (has(ui.selected)) {
				remove(ui.selected);
			} else {
				add(ui.selected, false);
			}
		}
	});
	
	$(".seat[prio!=0]").each(function() {
		add($(this), true);
	});
});


function doApply()
{
	console.log(selected);
	
	//XXX: 아... 이게 아니고 seat id 를 가지고 있어야 하고...... 그거에 맞게 apply 가 되어야 할듯 ㅇㅇ
	var seatArray = [];
	var prioArray = [];
	var postValues = {};
	
	$(".seat").each(function() {
		seatArray.push($(this).attr("sid"));
		prioArray.push($(this).attr("prio"));
	});
	
	postValues['seats'] = JSON.stringify(seatArray);
	postValues['prio'] = JSON.stringify(prioArray);
	
	$.post($("#applyBtn").attr("action_url"), postValues, function(data) {
  		console.log(data);
  		window.location = $("#applyBtn").attr("redirect_url");
  	});
}

