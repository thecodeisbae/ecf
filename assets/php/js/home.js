$(document).ready(function(){

	checkNotification();
				
	function checkNotification() {
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'checkNotification' },
			success: function(response) {
				$("#checkNotification").html(response);
			}
		});
	}


	displayAllNotes();

	function displayAllNotes() {
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'display_notes' },
			success: function(response) {
				$("#showNote").html(response);
				if ($('.datatable').length > 0) {
			        $('.datatable').DataTable({
			            "bFilter": true,
			            "order": [[ 0, "desc" ]]
			        });
			    }
			}
		});
	}

	//Checking user logged in or not
	$.ajax({
		url: 'assets/php/action.php',
		method: 'post',
		data: { action: 'checkUser' },
		success: function(response){
			if (response === 'bye') {
				window.location = 'index.php';
			}
		}
	});
});