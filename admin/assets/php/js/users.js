$(document).ready(function(){
	
	fetchAllUsers();

	//Liste des utilisateurs actifs Structures/Franchises
	function fetchAllUsers(){
		$.ajax({
			url: 'assets/php/admin-action.php',
			method: 'post',
			data: { action: 'fetchAllUsers' },
			success: function(response){
				$("#showAllUsers").html(response);
				if ($('.datatable').length > 0) {
			        $('.datatable').DataTable({
			            "bFilter": true,
			            "order": [[ 0, "desc" ]]
			        });
			    }	
			}
		});
	}

	//Modal des informations des utilisateurs
	$("body").on("click", ".userDetailsIcon", function(e){
		e.preventDefault();
		details_id = $(this).attr('id');
		$.ajax({
			url: 'assets/php/admin-action.php',
			method: 'post',
			data: { details_id: details_id },
			success: function(response){
				data = JSON.parse(response);
				$("#getName").text(data.name);
				$("#getEmail").text('Adresse Mail : '+data.email);
				$("#getCreated").text('Créer le : '+data.created_at);
				//Si utilisateur à vérifier son email 
				if(data.verified==0){
					$("#getVerified").text('Email Vérifié : Non');
				}else{
					$("#getVerified").text('Email Vérifié : Oui');
				}
				//Si utilisateur est une Franchise
				if(data.role==2){
					$("#getRole").text('Role : Franchise');

				//Si utilisateur est une Structure
				}else if(data.role==3){
					$("#getRole").text('Role : Structure');
				}

				if(data.photo != ''){
					$("#getImage").html('<img src="../assets/php/'+data.photo+'" class="img-fluid align-self-center" width="280px">');
				} else {
					$("#getImage").html('<img src="../assets/img/profiles/avatar.png" class="img-fluid align-self-center" width="280px">');
				}
			}
		});
	});


	//Desactiver compte 
	$("body").on("click", ".userDeleteIcon", function(e){
		e.preventDefault();
		delete_id = $(this).attr('id');
		Swal.fire({
		title: 'Désactiver cet utilisateur ?',
		text: "L'utilisateur pourra être réactivé dans la corbeille",
		icon: 'warning',
		showCancelButton: true,
		cancelButtonText: "Annuler",
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Désactiver'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: { delete_id: delete_id },
					success: function(response){
				    	Swal.fire(
				    		'Utilisateur Désactivé !',
				    		'Opération effectué avec succès !',
				    		'success'
				    	)

				    	fetchAllUsers();
					}
				});
			}
		});
	});

	//Vérification des notifications 
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


	//Supprimer compte user Stuctures/Franchises
	$("body").on("click", ".userDesactiveIcon", function(e){
		e.preventDefault();
		deleteu_id = $(this).attr('id');
		Swal.fire({
		title: 'Supprimer cet Utilisateur ?',
		text: "Cette action est irréversible",
		icon: 'error',
		showCancelButton: true,
		cancelButtonText: "Annuler",
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Supprimer'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: { deleteu_id: deleteu_id },
					success: function(response){
				    	Swal.fire(
				    		'Utilisateur Supprimé !',
				    		'Opération effectué avec succès !',
				    		'success'
				    	)

				    	fetchAllUsers();
					}
				});
			}
		});
	});


});