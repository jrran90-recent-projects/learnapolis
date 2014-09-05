$(function () {

	/*
		Change this
		Redundancy of codes tsk! -_-
	*/

	// Add Connection
	$("#addConnection").click(function(e) {
		e.preventDefault();

		var btn = $(this),
			url = (window.location.pathname).split("/");

		$.post('../user-add',{id:url[url.length-1]},function (m) {
			btn.removeClass("btn-success").addClass("disabled");
			btn.text("Connection Request");
			console.log(m)
		});
	});
	// Remove Connection
	$("#removeConnection").click(function (e) {

		var url = (window.location.pathname).split("/"),
			r 	= confirm("Confirm removal?");

		if ( r ) {
			$.post('../user-remove',{id:url[url.length-1]},function (m) {
				alert("Connection successfully removed!");
				location.reload();
			});
		}
		// alert( (r) ? 'hello':'aw' );
	});

	// ActionButton
	$("#ProfileActionContainer")
		.on("click",".btnAccept", function () {
			var url = (window.location.pathname).split("/");
			$.post("accept-request",{uid:url[url.length-1]},function (m) {
				location.reload();
				console.log(m)
			});
		})
		.on("click",".btnDecline", function () {
			alert("decline");
		});


	// Basic Information
	$("#frmBasicInformation").on("click",".fullNameContainer a", function (e) {
		e.preventDefault();

		var form = $("#frmBasicInformation");
		var firstName = form.find(".firstNameContainer"), // First Name Container
			lastName  = form.find(".lastNameContainer");  // Last Name Container

		firstName.children("label").text("First Name");
		firstName.find("span,a").addClass("hide");
		firstName.find("input").removeClass("hide").focus();

		lastName.removeClass("hide");

		form.find(".fullNameContainer .btnSaveContainer").removeClass("hide");
	})
	// Full Name Cancel
	.on("click",".fullNameContainer button.btnCancel", function (e) {
		e.preventDefault();

		var form = $("#frmBasicInformation");
		var firstName = form.find(".firstNameContainer"), // First Name Container
			lastName  = form.find(".lastNameContainer");  // Last Name Container

		firstName.children("label").text("Full Name");
		firstName.find("span,a").removeClass("hide");
		firstName.find("input").addClass("hide");

		lastName.addClass("hide");

		form.find(".fullNameContainer .btnSaveContainer").addClass("hide");
	})
	// Update Full Name
	.on("click",".fullNameContainer .btnSave", function (e) {
		e.preventDefault();

		var fullNameContainer = $(this).parents(".fullNameContainer");

		var fName = fullNameContainer.find("input[name=txtFirstName]").val(),
			lName = fullNameContainer.find("input[name=txtLastName]").val();

		$.post('basic_info',{fName:fName,lName:lName}, function (m) {
			location.reload(); // for the mean time
		});
	})

	// Email
	.on("click",".emailContainer a", function (e) {
		e.preventDefault();
		var form = $("#frmBasicInformation");
		form.find(".emailContainer .btnSaveContainer,.emailContainer input[name=txtEmail]").removeClass("hide").focus();
		form.find(".emailContainer span, .emailContainer a").addClass("hide");
	})
	.on("click",".emailContainer button.btnCancel", function (e) {
		e.preventDefault();
		var form = $("#frmBasicInformation");
		form.find(".emailContainer .btnSaveContainer,.emailContainer input[name=txtEmail]").addClass("hide");
		form.find(".emailContainer span, .emailContainer a").removeClass("hide");
	})
	.on("click",".emailContainer .btnSave", function (e) {
		e.preventDefault();

		var email = $(this).parents(".emailContainer").find("input[name=txtEmail]").val();

		$.post('email',{email:email}, function (m) {
			location.reload(); // for the mean time
		});
	})

	// Password
	.on("click",".passwordContainer a", function (e) {
		e.preventDefault();

		var form = $("#frmBasicInformation");

		// form.find(".passwordContainer .reTypePasswordContainer,.passwordContainer input[name=txtcurPass]").removeClass('hide');
		form.find(".passwordContainer input[name=txtcurPass]").removeClass('hide');
		form.find(".passwordContainer input[name=txtcurPass]").focus();
		$(this).addClass("hide");
	})
	// verify password
	.on("keypress",".passwordContainer input[name=txtcurPass]", function (event) {
		var form = $("#frmBasicInformation");

		if ( event.keyCode === 13 ) {
			$.post('password',{ p:this.value }, function (m) {
				if (m.st) {
					form.find(".passwordContainer .reTypePasswordContainer").removeClass("hide");
					form.find(".passwordContainer .reTypePasswordContainer input[name=txtnewPass]").focus();
				} else {
					form.find(".passwordContainer .reTypePasswordContainer").addClass("hide");
					alert("Password Incorrect!");
				}
			});
		}
	})
	.on("click",".passwordContainer .btnSave", function (e) {
		e.preventDefault();

		var form = $("#frmBasicInformation");

		var p1 = form.find(".reTypePasswordContainer input[name=txtnewPass]").val(),
			p2 = form.find(".reTypePasswordContainer input[name=txtreTypePass]").val();

		if ( p1 !== p2 ) {
			alert('Password Mismatch!');
		} else {
			$.post('change-password',{p:p1}, function (m) {
				alert("Successfully Changed Password!");
				form.find(".passwordContainer .reTypePasswordContainer,.passwordContainer input[name=txtcurPass]").addClass('hide');
				form.find(".passwordContainer input[type=password]").val("");
				form.find(".passwordContainer a").removeClass("hide");
			});
		}

	})
	.on("click",".passwordContainer button.btnCancel", function (e) {
		e.preventDefault();
		var form = $("#frmBasicInformation");
		form.find(".passwordContainer .reTypePasswordContainer,.passwordContainer input[name=txtcurPass]").addClass('hide');
		form.find(".passwordContainer input[type=password]").val("");
		$(this).parents(".passwordContainer").find("a").removeClass("hide");
	});



	// ---------------
	// Education
	// ------------------------------
	$("#frm_pro_educ").on("change","select[name=cb_degree]", function(e){
		e.preventDefault();

		var form = $("#frm_pro_educ"),
			degr = $(this).val();

		if ( degr == "Other" && degr != "High School" ){
			form.find("input[name=txtothers],input[name=txtc]").parent().parent().removeClass("hide");
			form.find("input[name=txtothers]").focus();
		}
		else if ( degr == "High School" || degr == "" )
		{
			form.find("input[name=txtothers],input[name=txtc]").parent().parent().addClass("hide");
			form.find("input[name=txtothers],input[name=txtc]").val("");
		}
		else
		{
			form.find("input[name=txtc]").parent().parent().removeClass("hide");
			form.find("input[name=txtothers]").parent().parent().addClass("hide");
			form.find("input[name=txtc],input[name=txtothers]").val("");
			form.find("input[name=txtc]").focus();
		}
	})
	// Add Education
	.on("click",".btnSave", function (e){
		e.preventDefault();

		var data = $("#frm_pro_educ").serialize();
		// console.log(data);
		$.post('education',data,function (m) {
			location.reload();
		});
	})

});