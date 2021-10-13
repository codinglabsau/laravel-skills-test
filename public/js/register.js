$(document).ready(function() {
	$('#formregister').validate({
		rules: {
			firstname: {
				required: true
			},
			lastname: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			phoneno: {
				required: true,
				number: true
			},
			password: {
				required: true
			},
			password_confirmation: {
				required: true,
				equalTo : "#password"
			},
		},
		messages: {
			firstname: {
				required: 'Please enter first name.'
			},
			lastname: {
				required: 'Please enter last name.'
			},
			email: {
				required: 'Please enter email address.',
				email: 'Please enter a valid email address.'
			},
			phoneno: {
				required: 'Please enter phone no.',
				number: 'Please enter valid mobile no.'
			},
			password: {
				required: 'Please enter password.'
			},
			password_confirmation: {
				required: 'Please enter confirm password.',
				equalTo: 'Password mismatch.'
			},
		}
	});
});

function formResponse(responseText, statusText){
	var form = $('#formregister');

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
