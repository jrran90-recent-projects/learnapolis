$(function () {

	dsp_post();

	$("#frmUpdateStatus").submit(function (e) {
		e.preventDefault();

		var form = $(this),
			txt  = form.find('textarea[name=txt]').val();

		var prog = $("#progress");

		form.ajaxSubmit({
			beforeSend: function () {
				prog.removeClass("hide"); prog.find(".progress-bar").css("width","0");
				form.find("input[type=submit]").prop("disabled", true);
			},
			uploadProgress: function (event, position, total, percentComplete) {
				var prcnt = percentComplete + "%";				
				prog.find(".progress-bar").css("width",prcnt);
			},
			success: function (m) {
				dsp_post();
				form.find("input[type=submit]").prop("disabled", false);
				form.find("textarea[name=txt]").val("");
				prog.addClass("hide");
			}
		});
	});


	function dsp_post() {		
		$.get('post-get',{}, function (m) {
			$("#tab_opt1").html(m);
		});
	}


	// Comment
	$("#tab_opt1").on("click","a.linkComment", function (e) {
		e.preventDefault();

		var post_comment = $(this).parents(".post-option").siblings(".post-comment");

		post_comment.removeClass("hide");
		post_comment.find("input[name=txtcmt]").focus();

		var pid = $(this).parents(".post").attr("id").split("-")[1];

		getComment(pid);

	});
	$("#tab_opt1").on("submit",".frm_cmt", function (e) {
		e.preventDefault();

		var cmnt = $(this).find("input[name=txtcmt]").val(),
			pid  = $(this).parents(".post").attr("id").split("-")[1];

		$.post('comment-post',{ cmnt:cmnt,pid:pid }, function (m) { getComment(pid) });
	});

	function getComment(pid) {
		$.get('comment-get',{pid:pid}, function (m) {
			$("#post-"+pid).find(".lst_cmt").html(m);
			$("#post-"+pid).find("input[name=txtcmt]").val("").focus();
		});
	}


	// Donwload Attached File
	$("#tab_opt1").on("click",".downloadFile", function() {

	// 	var url = 'http://' + window.location.pathname + '/download/' + this.id;

	// 	console.log(url)

	// 	// $.get(url, {}, function(m) {
	// 	// 	console.log(m)
	// 	// });

	});

});