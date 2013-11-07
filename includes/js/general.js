$(".tooltipped").tooltip();

$(".join-btn").click(function() {
	$(".flash-messages").addClass("hidden");
});

$(".join-submit").click(function() {
	var posting = $.ajax({
		type: "POST",
		data: $("#join-form").serialize(),
		url: $("#join-form").attr("action"),
		dataType: 'json',
	}); 
	
	posting.done(function(ret) {
		if (ret['error'] == true) {
			$(".flash-messages").removeClass("hidden");
			$(".join-msg").html(ret['msg']);
		}
		else {
			location.reload();
		}
	});		
});
