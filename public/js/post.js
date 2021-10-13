$(document).ready(function() {
	$('#formpost').validate({
		rules: {
			name: {
				required: true
			},
			description: {
				required: true
			},
			imagefile: {
				extension: 'jpg,jpeg,png'
			}
		},
		messages: {
			name: {
				required: 'Please enter post name.'
			},
			description: {
				required: 'Please enter description.'
			},
			imagefile: {
				extension: 'Please select jpg, jpeg or png file.'
			}
		}
	});

	
});

function formResponse(responseText, statusText) {
    var form = $('#formpost');
    hideLoader();
    enableFormButton(form);
	if(statusText == 'success') {
		if(responseText.type == 'success') {
			showSuccess(responseText.caption, null, function() {
				window.location.href = responseText.redirectUrl;
			});
		}
		else {
			showError(responseText.caption, responseText.errormessage);
			if(responseText.errorfields !== undefined) {
				highlightInvalidFields(form, responseText.errorfields);
			}
		}
	}
    else {
		showError('Unable to communicate with server.');
	}
}

function removePostPic() {
	showModal();
	confirmDialoue("Delete", 'Are you sure to delete image?', function(e){
		if (e) {
			hideModal();
			$('#deleteimage').val(1);
			$('.imagethumb').addClass('deleted').attr('title', 'To be deleted');
		}
		else {
			hideModal();
		}
	});
}