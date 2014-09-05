// note
// Registration...
// 1. allowable characters would be ONLY alpha numeric and numbers... others are NOT..

// I think that only login do requires server-side clean up unlike regisration.. besides
// there is what we called email validation

// I think once the user is successfully saved then all the fields should be removed.. then a link directing
// to login should be followed

// separate bookmark nga js

// regarding the post area, only the certain node should be updated not the 
// whole area, hence, change disp_post


// Global variable
var loader = $(".customize_loader");

$(document).ready(function() {

	init();


	function init() {
		dsp_connNotification();
		dsp_count_noti();		
		disp_post();
	}


	// create function init on the bottom
	// $('[data-toggle="popover"]').popover();
	$('[data-toggle="tooltip"]').tooltip();


	


	// ----- Search
	// -----------------------------------------------
	$("#contSearchWrap").on("keyup","input[type=text]", function(e) {
		e.preventDefault();

		var searchString = this.value;

		if ( searchString === '' ) 
		{
			$("ul#searchResult").addClass("hide");
		}
		else
		{
			$("ul#searchResult").removeClass("hide");
			if ( searchString !== '' ) 
			{
				$.ajax({
					type: "POST", url: "../includes/core.inc.php", data: { s: searchString, b: "searchAll" }, cache: false,
					success: function (m) { $("ul#searchResult").html(m) }
				})
			}			
		}
	})

	
	

	// put a timer sort of for the content miniprofile closes automatically
	$(".d_post_dashboard").on("mouseenter",".thread_Name", function(){
		$(this).parent().siblings(".content-miniprofile").removeClass("hide");
		$(this).parent().siblings(".content-miniprofile").find(".body-miniprofile>strong").text( $(this).text() )
	}).on("mouseleave",".content-miniprofile", function(){
		$(this).addClass("hide");
	}).on("mouseenter",".thread_post_each", function(){
		$(this).find(".content-miniprofile").addClass("hide");
	}).on("mouseleave",".thread_post_each", function(){
		$(this).find(".content-miniprofile").addClass("hide");
	})


	// ----- Post
	// -----------------------------------------------	
	$("#frmupdate_status").on("click","textarea", function(){
		$("#frmupdate_status").find(".action").removeClass("hide");
	});

	$("#frmupdate_status").submit(function(e){
		e.preventDefault();

		var form	= $(this),
			txt 	= form.find('textarea[name=txt]').val();

		var f_disp	= $("#filename_homepage"),
			prog 	= $("#progress");

		form.ajaxSubmit({
			beforeSend: function(){
				var filename = form.find("input[name=upl_file]").val(),
					arr_fnme = filename.split("\\");

				form.find('span.upl_file').text('Attaching...').addClass('disabled');
				prog.removeClass("hide"); prog.find(".progress-bar").css("width","0");
				f_disp.html( arr_fnme[arr_fnme.length-1] );
				form.find("button[type=submit]").addClass("disabled");
			},
			uploadProgress: function(event,position,total,percentComplete){
				var prcnt = percentComplete+"%";
				prog.find(".progress-bar").css("width",prcnt);
			},
			success: function(m){
				// app_post(); // this function will append only the added post
				disp_post();
				form[0].reset();
				prog.addClass("hide"); f_disp.html('');
				form.find('span.upl_file').text('Attach file').removeClass('disabled');
				form.find("button[type=submit]").removeClass("disabled");
				var obj = $.parseJSON(m); form.find('span.msgbox').text(obj.msg);
				console.log(obj.msg)
			}
		})
	});

	// remove
	$(".d_post_dashboard").on("click",".actionList a", function(){

		var id = $(this).parents(".thread_post_each").attr("id").split("-")[1];

		$.post('../includes/core.inc.php',{ pid: id, b:'rm_post' },
			function() {

			});

	});




	// ----- Comment
	// -----------------------------------------------
	$(".thread_post_container").on('click','.uiLinkComment',function(e){
		e.preventDefault();
		var parent	= $(this).parents(".thread_post_each"),
			id 		= parent.attr("id").split("-")[1];

		parent.find('.container_cmt').removeClass('hide'); disp_comment(id);
		parent.find('input[name=txtcmt]').focus();
		$(this).addClass('hide-cmt');
	})
	$(".thread_post_container").on('click','.hide-cmt', function(e){
		e.preventDefault();
		var cmt 	= $(this),
			parent 	= cmt.parents(".thread_post_each");

		cmt.removeClass("hide-cmt"); parent.find(".container_cmt").addClass("hide");
	})
	$(".thread_post_container").on('submit','.frm_cmt',function(e){
		e.preventDefault();

		var form = $(this);

		var cmt = form.find('input[name=txtcmt]').val(),
			id 	= form.parents(".thread_post_each").attr('id').split('-')[1];

		$.post('../includes/core.inc.php', { b: 'a_cmt', cmt: cmt, id: id },
			function(){ disp_comment(id) })
	})




	// ----- Like
	// -----------------------------------------------
	$(".thread_post_container").on('click','.uiLikelink',function(e){
		e.preventDefault();

		var likeLink = $(this);
		var id = likeLink.parents(".thread_post_each").attr("id").split("-")[1];

		$.post('../includes/core.inc.php', { b: 'u_likes', refid: id },
			function(m){
				var obj = $.parseJSON(m);
				likeLink.text(obj.status);
				disp_post(); disp_post_grp();
				// update only the affected field
				// likeLink.parents(".thread_post_each").
			})
	})


	$(".mainContainer").on('click','a[href=#modal_bookmark]', function(e){
		e.preventDefault();

		var modal = $("#modal_bookmark");

		modal.find('form')[0].reset();
		modal.find('.modal-footer').children('span').text('');
	})




	// ----- Group
	// -----------------------------------------------
	$("#frmgroup").submit(function(e){
		e.preventDefault();

		var form 	= $(this),
			data 	= form.serialize() + '&b=a_grp';

		form.find('button[type=submit]').addClass('disabled').text('Saving...');

		$.post('../includes/core.inc.php', data, function(m){
			if (m.error){
				form.find('button[type=submit]').removeClass('disabled').text('Create');
				form.find('.modal-footer').children('span').text(m.message).css({ color:'#f00' });
				form.find('input[name=txtname]').focus()
			}
			else
			{
				$("#modal_bookmark").modal('hide'); disp_list_group();
				$(".alert_notification").removeClass('hide');
				form.find('button[type=submit]').removeClass('disabled').text('Create');
				location.href = "group.php?g=" + m.url;
			}
		})
	})
	$("#list_groups").on('click','.options', function(e){
		e.preventDefault();

		var opt = $(this).data('opt');

		var	parent	= $(this).parents("li"),
				g 	= $(this).siblings('a').eq(1).text();				

		switch ( opt )
		{
			case 'del-dt':
				var r 	= confirm("Are you sure you want to delete it?");
				if (r)
				{
					$.ajax({
						type: "POST", url: "../includes/core.inc.php", data: { grp: g, b: "rm_grp" },
						success: function(){
							location.reload();
							parent.fadeOut("slow", function(){ $(this).remove() }) }
						})
				}
				break;

			case 'bkmrk':
				$.post('../includes/core.inc.php',{ grp: g, b: "bkmrk" },
					function(){
						// change this to ajax
						location.reload();
					})
				break;

			default: alert('Error');
		}
	});
	$(".mainContainer_grp").on("click",".btnAccept", function(){
		var gid = $(this).parent().attr("id").split("-~")[1];
		$.post('../includes/core.inc.php', { gid:gid, b: "confirm_member" });
		location.reload();		
	}).on("click",".btnCancel", function(){
		var gid = $(this).parent().attr("id").split("-~")[1];
		$.post('../includes/core.inc.php', { gid:gid, b: "cancel_group_invitation" });
		location.href="./";
	});

	// --- Group Post
	$(".cnt_post_grp").on("submit","form", function(e){
		e.preventDefault();

		var form	= $(this),
			parent 	= form.parent(),
			txt 	= form.find('textarea[name=txt]').val(),
			grpid	= parent.attr("id").split("-")[1];

		var f_disp	= parent.find(".filename"),
			prog 	= parent.find(".progress");

		form.ajaxSubmit({
			data: { grpid: grpid },
			beforeSend: function(){
				var filename = form.find("input[name=upl_file]").val(),
					arr_fnme = filename.split("\\");

				form.find('span.upl_file').text('Attaching...').addClass('disabled');
				prog.removeClass("hide"); prog.find(".progress-bar").css("width","0");
				f_disp.html( arr_fnme[arr_fnme.length-1] );
			},
			uploadProgress: function(event,position,total,percentComplete){
				var prcnt = percentComplete+"%";
				prog.find(".progress-bar").css("width",prcnt);
			},
			success: function(m){
				form.find('span.upl_file').text('Attach file').removeClass('disabled');
				prog.addClass("hide"); f_disp.html('');
				disp_post_grp(); form[0].reset();
			}
		});
	});
	// Sidebar [ Group ]
	$("#sb_group").on("keyup",".grp_memberSearch > input[name=s]", function() {
		var res = $(this);

		if ( this.value === '' ) { res.siblings("ul").addClass("hide"); return false; }
		$.post('../includes/core.inc.php',{ s: this.value, b: 's_grp_member' },
			function(m) { res.siblings("ul").removeClass("hide").html(m) });

	}).on("click",".grp_memberSearch a", function() {

		var uid = $(this).parent().data("uid"),
			gid = $("#sb_group").find("input[type=hidden]").val();

		$.post('../includes/core.inc.php', { uid: uid, gid: gid, b: 'a_member' },
			function(m) {
				$("#sb_group").find(".grp_memberSearch ul").addClass('hide');
				$("#sb_group").find(".grp_memberSearch input[name=s]").val('');
				alert(m)
			});

	});

	



	// ----------------- Header
	// ------------------------------------------------------------------------------------
	$("#connectionNotificationResult").click(function(e) {
		e.preventDefault(); e.stopPropagation();
		var a = $(this);
		if ( a.hasClass("bb") ) { a.removeClass("hide") }
	})

	// display notification -- badge
	function dsp_connNotification() {
		$.post('../includes/core.inc.php',{b:'count_conn_request'},function(m) {
			if ( m != 0 ) { $("#noti_connection").find(".badge").text(m) }
		});
	}

	// view notification for connection
	$("#noti_connection").click(function (e) {
		e.preventDefault();

		var bt = $(this),
			nt = $("#connectionNotificationResult");

		if ( bt.hasClass("active") ) {

			bt.removeClass("active"); nt.removeClass("bb");
			nt.addClass("hide");
			bt.find(".badge").removeClass("hide");

		} else {

			bt.addClass("active"); nt.addClass("bb");
			nt.removeClass("hide");
			bt.find(".badge").addClass("hide");
			
			$.ajax({
				type: "POST", url: "../includes/core.inc.php", data: { b: "dsp_conn_request" },
				beforeSend: function() {},
				success: function(m) {
					nt.find("li").html(m);
					dsp_connNotification();
				}
			})

		}

	});


	function dsp_count_noti() {
		$.post("../includes/core.inc.php", {b: "count_noti_update"}, function(m) {
			if ( m!=0 ) { $("#noti_update").find(".badge").text(m) }
		});
	}
	$("#noti_update").click(function() {
		$.post('../includes/core.inc.php', { b: "dsp_noti_update" },
			function(m) { $("#noti_update").find("ul").html(m) });
	});


	// action
	$("#connectionNotificationResult").on("click",".b_respond", function (e) {
		e.preventDefault();

		var btns 	= $(this).parent().find("button"),
			parent 	= $(this).parents("li.clearfix");

		$.ajax({
			type: "POST", url: "../includes/core.inc.php", data:{ uid: $(this).data("user").uid, k: $(this).data("user").k, b:"noti_connect" },
			beforeSend: function() { btns.addClass("disabled") },
			success: function() { parent.fadeOut("slow", function(){ $(this).remove() }) }
		});

	}).on("click",".b_cancel", function (e) {

		var parent 	= $(this).parents("li.clearfix"),
			uid 	= $(this).siblings(".b_respond").data("user").uid;

		if ( confirm("Cancel request?") ) {

			$.ajax({
				type: "POST", url: "../includes/core.inc.php", data:{ uid: uid, b:"n_unC" },
				success: function(m) { parent.fadeOut("slow", function(){ $(this).remove() }) }
			})
			

		}
		
	})













	$("#wrapConnect").on("click",".b_connect", function (e) {
		e.preventDefault();

		var btn = $(this);

		$.ajax({
			type: "POST", url: "../includes/core.inc.php", data: { uid: $(this).data('user').uid, b: "addConnection" },
			beforeSend: function() { btn.text("Connecting..") },
			success: function(m) { btn.addClass("disabled").text(m.msg) }
		})
	}).on("mouseenter",".b_unconnect", function () {
		$(this).text("Unconnect?").removeClass("btn-primary").addClass("btn-danger");
	}).on("mouseleave",".b_unconnect", function () {
		$(this).text("Connected").removeClass("btn-danger").addClass("btn-primary");
	})

	$("#wrapConnect").on("click",".b_unconnect", function (e) {
		e.preventDefault();

		var btn = $(this);

		$.ajax({
			type: "POST", url:"../includes/core.inc.php", data: { uid: $(this).data('user').uid, k: $(this).data('user').k , b: "n_unC" },
			beforeSend: function() { btn.addClass("disabled").text("Processing..") },
			success: function(m) { btn.removeClass("b_unconnect btn-danger disabled").addClass("b_connect btn-primary").text("Connect") }
		})
	})









	$("#frmuploadImg").submit(function(e){
		e.preventDefault();

		var form = $(this);
		
		form.ajaxSubmit({
			// beforeSend: function(){
			// 	var filename = form.find("input[name=upl_file]").val(),
			// 		arr_fnme = filename.split("\\");

			// 	form.find('span.upl_file').text('Attaching...').addClass('disabled');
			// 	prog.removeClass("hide"); prog.find(".progress-bar").css("width","0");
			// 	f_disp.html( arr_fnme[arr_fnme.length-1] );
			// 	form.find("button[type=submit]").addClass("disabled");
			// },
			// uploadProgress: function(event,position,total,percentComplete){
			// 	var prcnt = percentComplete+"%";
			// 	prog.find(".progress-bar").css("width",prcnt);
			// },
			success: function(m){
				var obj = $.parseJSON(m);
				alert(obj.msg);

				// pwede naman guru wala ni... since on the first place pakita naman ang thumbnail.. diba?
				form.find(".fileinput-preview img").attr("src",obj.image)

				// alert(m)
				// disp_post();
				// form[0].reset();
				// prog.addClass("hide"); f_disp.html('');
				// form.find('span.upl_file').text('Attach file').removeClass('disabled');
				// form.find("button[type=submit]").removeClass("disabled");
				// var obj = $.parseJSON(m); form.find('span.msgbox').text(obj.msg);
			}
		})
	})

	$("#frm_pro_fn").submit(function(e){
		e.preventDefault();

		var form 	= $(this),
			data 	= form.serialize() + "&b=upd_prof_name";

		$.ajax({
			type: "POST", url: "../includes/core.inc.php", data: data,
			beforeSend: function(){ form.find('button[type=submit]').addClass('disabled').text('Saving...') },
			success: function(){
				form.find('button[type=submit]').removeClass('disabled').text('Save Changes');
				// $("#modal_prof_fn").modal('hide'); //form[0].reset();
				location.reload();
			}
		})
		.fail(function(){
			alert('error')
		})
	})
	$("#frm_pro_e").submit(function(e){
		e.preventDefault();

		var form 	= $(this);

		form.find('button[type=submit]').addClass('disabled').text('Saving...');
		$.post('../includes/core.inc.php', { b:"upd_prof_email",email:form.find('input[name=txtemail]').val() },
				function(){
					form.find('button[type=submit]').removeClass('disabled').text('Save Changes');
					// $("#modal_prof_e").modal('hide'); //form[0].reset();
					location.reload();
				})
	})
	// $("#frm_pro_pass").submit(function(e){
	// 	e.preventDefault();

	// 	var form  	= $(this);

	// 	var o_p 	= form.find('input[name=txtoldpass]').val(),
	// 		n_p 	= form.find('input[name=txtpass]').val(),
	// 		n_p2 	= form.find('input[name=txtpass2]').val();

	// 	form.find('button[type=submit]').addClass('disabled').text('Saving...');
	// 	$.post('../includes/core.inc.php', { b:"upd_profile_pass", o_p:o_p, n_p:n_p },
	// 			function(m){
	// 				if (m.error)
	// 				{
	// 					form.find('button[type=submit]').removeClass('disabled').text('Save Changes');
	// 					form.find('.modal-footer').children('span').text('Password Error!').css({ color:'#f00' });
	// 					form.find('input[name=txtoldpass]').focus();
	// 				}
	// 				else
	// 				{
	// 					form.find('button[type=submit]').removeClass('disabled').text('Save Changes');

	// 					if ( n_p != n_p2 )
	// 					{
	// 						form.find('.modal-footer').children('span').text('Password mismatch!').css({ color:'#f00' });
	// 					}
	// 					// else
	// 					// {

	// 					form.find('.modal-footer').children('span').text(m.message).css({ color:'#f00' });
	// 					form.find('input[name=txtpass]').focus();
	// 					// }
	// 					// $("#modal_prof_pass").modal('hide');
	// 					// location.reload();
	// 				}
	// 			})	
	// })

	// ----- Education
	// -----------------------------------------------
	$("#frm_pro_educ").on("change","select[name=cb_degree]", function(e){
		e.preventDefault();

		var form = $("#frm_pro_educ"),
			degr = $(this).val();

		if ( degr == "Other" && degr != "High School" ){
			form.find("input[name=txtothers],input[name=txtc]").parent().parent().removeClass("hide");
		}
		else if ( degr == "High School" || degr == "" )
		{
			form.find("input[name=txtothers],input[name=txtc]").parent().parent().addClass("hide");
		}
		else
		{
			form.find("input[name=txtc]").parent().parent().removeClass("hide");
			form.find("input[name=txtothers]").parent().parent().addClass("hide");
		}
	})

	$("#frm_pro_educ").on("click",".btnSubmit", function(e){
		e.preventDefault();

		var form = $("#frm_pro_educ"),
			data = form.serialize()+"&b=prof_educ";

		var btn  = $(this);

		if ( btn.hasClass("btnSave") )
		{
			form.find('button[type=submit]').addClass('disabled').text('Saving...');
			$.post('../includes/core.inc.php', data, function(m){
						form.find('button[type=submit]').removeClass('disabled').text('Save');
						$("#modal_education").modal("hide"); form[0].reset(); disp_prof_ed();
					})
						.fail(function(){
							alert("Page not loaded properly");
							location.reload();
						})
		}
		if ( btn.hasClass("btnSaveAnother") )
		{
			form.find('button[type=submit]').addClass('disabled').text('Saving...');
			$.post('../includes/core.inc.php', data, function(m){
						form.find('button[type=submit]').removeClass('disabled').text('Save');
						form[0].reset(); disp_prof_ed();
					})
		}

	});




	// ----------------- Messages
	// ------------------------------------------------------------------------------------	
	$('.messageScroller').slimscroll({ height: '320px' });	
	$("#contListFriends").on("keyup","input[name=s]", function(e) {
		e.preventDefault();

		var s = this.value;
		var dsp_res = $("#contListFriends").find("ul");

		if ( s === '' ) { /*refresh*/dsp_res.addClass("hide") }
			else {

				dsp_res.removeClass("hide");
				if ( s !== '' ) 
				{
					$.ajax({
						type: "POST", url:"../includes/core.inc.php", data: { s: s, b: "s_conn" },
						success: function(m) { dsp_res.html(m) }
					})				
				}

			}
	}).on("click","li>a", function(m) {
		dsp_msg( $(this).data("msg"), this.text );
		$("#messageBox").find("textarea[name=msg]").focus();
	});


	// Send Msg
	$("#messageBox").on("click",".b_sendMsg", function(e) {
		e.preventDefault();

		var btn = $(this),
			msg = btn.parent().siblings("textarea[name=msg]");

		var t_id = $("#messageBox").find("input[name=msgid]").val(),
			uid  = $("#messageBox").find("input[name=userid]").val();

		$.ajax({
			type: "POST", url: "../includes/core.inc.php", data: { t_id: t_id, uid: uid, msg: msg.val(), b: "a_msg" },
			beforeSend: function() { btn.addClass("disabled").text("Sending..") },
			success: function(m) {

				// only a row should be updated not all -- awts
				// var obj = '{ "t_id" : "'+t_id+'", "uid" : "'+uid+'" }';
				var obj = '{ "t_id" : "'+ m +'", "uid" : "'+uid+'" }';

				var theObject = (typeof obj == "string") ? jQuery.parseJSON(obj) : obj;
				dsp_msg( theObject );

				btn.removeClass("disabled").text("Send");
				msg.val("");

			}
		})

	});


	// $( document ).on( 'click', function ( e ) {
	// 	if ( $( e.target ).closest( elem ).length === 0 ) {
	// 		$( elem ).hide();
	// 	}
	// });

	// $( document ).on( 'keydown', function ( e ) {
	// 	if ( e.keyCode === 27 ) { // ESC
	// 		$( elem ).hide();
	// 	}
	// });


})


disp_post_grp(); // ???? it works here.. find out what causes this

function disp_post()
{
	$.ajax({
		type: 'POST', url: '../includes/core.inc.php', data: { b: 'dsp_post' },
		beforeSend: function(){ loader.removeClass("hide") },
		success: function(data){ loader.addClass("hide"); $(".d_post_dashboard").html(data) }
	})
		// .fail(function(){
		// 	// alert('Page not loaded properly, refresh imminent!');
		// 	alert('Page not loaded properly, please refresh your page!');
		// 	// location.reload();
		// })
}
// function app_post()
// {
// 	$.ajax({
// 		type: "POST", url: "../includes/core.inc.php", data: { b: "app_post" },
// 		beforeSend: function(){ loader.removeClass("hide") },
// 		success: function(m){
// 			loader.addClass("hide");
// 			$(".d_post_dashboard").append(m)
// 		}
// 	})
// }










// ------ Group
function disp_list_group()
{
	$.ajax({
		type: "POST", url: '../includes/core.inc.php', data: { b: 'list_created_group' },
		beforeSend: function(){  },
		success: function(data){ $("#list_groups").html(data) }
	})
}
function disp_post_grp()
{
	var id = $(".cnt_post_grp").attr("id").split("-")[1];

	$.ajax({
		type: "POST", url: "../includes/core.inc.php", data: { b: "dsp_post_grp",grpid:id },
		beforeSend: function(){ loader.removeClass("hide") },
		success: function(data){ loader.addClass("hide"); $(".d_post_group").html(data) }
	})
}


function disp_comment(id)
{
	$.post('../includes/core.inc.php', { b: "l_cmt", id: id },
		function(m){
			var post = $("#post-"+id);
			post.find('.lst_cmt').html(m);
			post.find('input[name=txtcmt]').val('');
		})
}


// ------ Profile
function disp_prof_ed()
{
	$.post("../includes/core.inc.php",{ b: "d_prof_educ" }, function(m){
		$("#cnt_prof_educ").html(m);
	})
}


// ------ Message
function dsp_msg( obj, txt ) {

	$.ajax({
		type: "POST", url: "../includes/core.inc.php", data: { obj: obj, b: "dsp_msg" },
		beforeSend: function() { /*loader here*/ },
		success: function(m) {

			var msgBox = $("#messageBox");

			$("#contWebMessenger").find("._headerLabel strong").text( txt )

			// $("#messageBox").attr("data-msg",'{"uid":"'+ obj.uid +'","t_id":"'+ obj.t_id +'"}')

			msgBox.find("input[name=msgid]").val( obj.t_id );
			msgBox.find("input[name=userid]").val( obj.uid );

			$("#contWebMessenger").find("ul").html(m);

			// setInterval(function(){
			// 	// alert('hello')
			// }, 2000)

			var msgScroll_wrap = $("#contWebMessenger").find(".messageScroller");

			// pick which has the max size
			var scrollHeight = Math.max( msgScroll_wrap.prop('scrollHeight'), msgScroll_wrap.prop('clientHeight') );

			// do the calculations
			msgScroll_wrap.scrollTop( scrollHeight - msgScroll_wrap.prop('clientHeight') );

		}
	})

}