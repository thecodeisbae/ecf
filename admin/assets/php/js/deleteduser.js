$(document).ready(function(){
	
	fetchAllDeletedUsers();

	//affichage utilisateur desactivé
	function fetchAllDeletedUsers(){
		$.ajax({
			url: 'assets/php/admin-action.php',
			method: 'post',
			data: { action: 'fetchAllDeletedUsers' },
			success: function(response){
				$("#showAllDeletedUsers").html(response);
				if ($('.datatable').length > 0) {
			        $('.datatable').DataTable({
			            "bFilter": true,
			            "order": [[ 0, "desc" ]]
			        });
			    }	
			}
		});
	}

	//réactiver le compte utilsiateur 
	$("body").on("click", ".restoreUserIcon", function(e){
		e.preventDefault();
		restore_id = $(this).attr('id');
		Swal.fire({
		title: 'Réactiver cet utilisateur ?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Annuler',
		confirmButtonText: 'Oui, Réactiver le compte'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: { restore_id: restore_id },
					success: function(response){
				    	Swal.fire(
				    		'Restauré !',
				    		"Le compte de l'utilisateur à été réactivé !",
				    		'success'
				    	)

				    	fetchAllDeletedUsers();
					}
				});
			}
		});
	});

	//	verification message 
	checkNotification();
	function checkNotification() {
		$.ajax({
			url: 'assets/php/admin-action.php',
			method: 'post',
			data: { action: 'checkNotification' },
			success: function(response) {
				$("#checkNotification").html(response);
			}
		});
	}

});	