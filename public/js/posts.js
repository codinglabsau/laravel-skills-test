var searchVal = '';
var page = 1;

$(document).ready(function() {
	loadData(page, searchVal);
	$('#searchform').validate();
});

function submitHandler(form) {
	disableFormButton(form);
	showLoader();
	searchVal = $('#searchtextbox').val();
	loadData(page, searchVal);
}

function loadData(page, search) {
    showLoader();
    ajaxFetch(baseurl() + '/posts/load', { page: page, search: search }, formResponse);
}

function formResponse(responseText, statusText) {
	var form = $('#searchform');
	enableFormButton(form);

	hideLoader();
	$('#searchtextbox').val(searchVal);

	if(statusText == 'success') {
		$('#tabledata').html(responseText);
		if($('#ajaxpagingdata').length > 0 && $.trim($('#ajaxpagingdata').html()) != '') {

			$('#pagingdata').html($('#ajaxpagingdata').html()).show();
			$('#ajaxpagingdata').remove();

			$('#pagingdata a[href]').click(function(event) {
				event.preventDefault();
				var arr = $(this).attr('href').split('page=');
				page = parseInt(arr[arr.length-1]);
				if(isNaN(page)) { page = 1; }
				loadData(page, searchVal);
			});
		}
		else {
			$('#ajaxpagingdata').remove();
			$('#pagingdata').html('').hide();
		}
	}
	else {
		showError('Unable to communicate with server.');
	}
}

function deleteEntity(post_id) {
	showModal();
	confirmDialoue("Delete", 'Are you sure you want to delete this post?', function(e){
		if (e) {
			ajaxUpdate(baseurl() + '/posts/destroy', { post_id: post_id }, function(responseText, statusText) {
				hideLoader();
				if(statusText == 'success') {
					if(responseText.type == 'success') {
						showSuccess(responseText.caption, '', function(){
							loadData(1, searchVal);
				        });
				    }
				    else {
				        showError(responseText.caption);
				    }
				}
				else {
					showError('Unable to communicate with server.');
				}
			});
		}
		else {
			hideModal();
		}
	});
}