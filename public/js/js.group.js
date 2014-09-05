// Sidebar

$(function () {


	// create init

	// normalize this one... -_-
	// redundant codes



	$("#frmCreateGroup").submit( function (e) {
		e.preventDefault();

		var data = $(this).serialize();
		$.post('group-post',data, function (m) {
			alert('Group Successfully Created!');
			location.href=m;
			// $("#frmCreateGroup")[0].reset();
			// $("#btnActionGroup").modal("hide");
		});
	});

	// Attempt to join the group
	$("#btnJoinGroup").click( function (e) {
		e.preventDefault();

		var grpURL = window.location.pathname.split("/");

		$.post('../group-join', { g_id: grpURL[grpURL.length-1] }, function (m) {
			$("#btnJoinGroup").text(m.msg).addClass("disabled");
			console.log(m)
		});
	});

	$("#GroupPanel").on("click",".btnAccept", function (e) {
		e.preventDefault();

		var parent = $(this).parents("li");

		var userId = parent.attr("id").split("-")[1],
			grpId  = (window.location.pathname).split("/");

		$.post('../group-request',{userId: userId, grpId: grpId[grpId.length-1]}, function (m) {
			parent.fadeOut("slow", function(){ $(this).remove() });
		});
	})


});