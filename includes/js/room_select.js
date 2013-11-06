$(function() {
	var selected = new Array();
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
