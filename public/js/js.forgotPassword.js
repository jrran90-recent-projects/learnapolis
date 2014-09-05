$(function () {

	$("#frm_fp").submit(function (e) {
		e.preventDefault();

		var form  = $(this);
		var email = form.find("input[name=email]").val();

		$.ajax({
			type:"POST",url:"account/forgot-password",data:{email:email},
			beforeSend:function() {
				form.find("button[type=submit]").addClass("disabled").text("Processing your request..")
				form.find("input[name=email]").prop("disabled",true);
			},
			success:function(m) {
				form.find("button[type=submit]").removeClass("disabled").text("Reset Password");
				form.find("input[name=email]").prop("disabled",false).val(""); alert(m);
			}
		});
	});

});