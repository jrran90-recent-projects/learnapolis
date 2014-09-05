$(document).ready(function(){

	$("#frmlogin").submit(function(e){
		e.preventDefault();

		var form			= $(this),
			messageHolder	= form.find(".messageHolder"),
			btnProcess		= form.find('button');

		// Default Value
		btnProcess.addClass('disabled').text("Processing...")

		var data = form.serialize();

		// Note: re-do this one
		$.post('auth.php', data)
			.done(function(m){
				if(m.error){
					messageHolder.removeClass("hide alert-success")
								 .addClass("alert-danger")
								 .text(m.message);
					btnProcess.removeClass('disabled').text("Login");
				}
				else
				{
					window.location="dashboard/";
					btnProcess.removeClass('disabled').text("Login");
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				alert("error encountered, please do refresh your page!");
				// console.log(errorThrown);
			})
	})

})