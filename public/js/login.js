$(document).ready(function() {
	$('#formlogin').validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true
			}
		},
		messages: {
			email: {
				required: 'Please enter email address.',
				email: 'Please enter a valid email address.'
			},
			password: {
				required: 'Please enter password.'
			}
		}
	});
});

function formResponse(responseText, statusText){
	var form = $('#formlogin');

	hideLoader();
	enableFormButton(form);

	if(statusText == 'success') {
		if(responseText.type == 'success') {
			window.location.href = responseText.redirectUrl;
		}
		else {
			showError(responseText.caption);
			if(responseText.errorfields !== undefined) {
				highlightInvalidFields(form, responseText.errorfields);
			}
		}
	}
	else {
		showError('Unable to communicate with server.');
	}
}
