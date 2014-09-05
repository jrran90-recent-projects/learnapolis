$(function () {

	// // put init()
	// load_noti();

	// // Notification
	// $("#head_noti").click( function () {
	// 	var url = 'http://' + window.location.host + '/header/notifications';
	// 	$.get( url, {}, function (m) { $("#head_noti").find(".dropdown-menu").empty().append(m) });
	// 	// $.get('header/notifications/', {}, function (m) { $("#head_noti").find(".dropdown-menu").empty().append(m) });
	// });

	// function load_noti () {
	// 	var url = 'http://' + window.location.host + '/header/count_noti';
	// 	$.get(url, {}, function (m) { $("#head_noti").find("span.badge").text(m) });
	// 	// $.get('header/count_noti/', {}, function (m) { $("#head_noti").find("span.badge").text(m) });
	// };


	$("#head_noti").click(function () {
		var url = 'user/notification';
		// var url = 'http://' + window.location.host + '/user/notification'; // use during production

		$.get(url, function (m) {
			$("#head_noti").find(".dropdown-menu").empty().append(m)
		});
	});

	function load_noti () {
		var url = 'user/count_noti';
		// var url = 'http://' + window.location.host + '/user/count_noti'; // use during production

		$.get(url,function (m) {
			$("#head_noti").find("span.badge").text(m);
			console.log(m)
		});
	}

	load_noti();



});