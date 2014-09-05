$(document).ready(function(){

	// Registration
	$("#frmregistration").on('submit', function(e){
		e.preventDefault()

		var formreg			= $(this);
		var messageHolder	= formreg.find('.messageHolder');
		var btnProcess		= formreg.find("button");

		// Default Value
		btnProcess.addClass('disabled').text("Processing...")

		if ( formreg.find('input[name=txtpass]').val() != formreg.find('input[name=txtpass2]').val() )
		{
			messageHolder.removeClass("hide alert-success").addClass("alert-danger").text('Password Mismatch, please try again!')
			btnProcess.removeClass('disabled').text("Register")
			return false;
		}

		var data	= formreg.serialize();

		// as of now let's assume that there's a problem
		// with the backend side

		$.post('auth-reg.php', data)
			.done(function(m){
				if(m.error){
					messageHolder.removeClass("hide alert-success").addClass("alert-danger").text(m.message);
					btnProcess.removeClass('disabled').text("Register");
					formreg.find("input[type=email]").focus();
				}
				else{
					messageHolder.removeClass("hide alert-danger").addClass("alert-success").text(m.message);
					btnProcess.removeClass('disabled').text("Register");
					formreg[0].reset();
				}
			})
			.fail(function(){
				messageHolder.removeClass("hide alert-danger").addClass("alert-success").text("Verification link was sent to your email");
				btnProcess.removeClass('disabled').text("Register");
				formreg[0].reset()
			})

	})

});