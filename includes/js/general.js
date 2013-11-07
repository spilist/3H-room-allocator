$(".tooltipped").tooltip();

$(".join-submit").click(function() {
	$.ajax({
		type: "POST",
		data: $("#join-form").serialize(),
		url: "/room_allocator/index.php/group/join_new/"+$("#join-modal-label").attr("mid"),
	});
});
