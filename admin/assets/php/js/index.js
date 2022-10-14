$(document).ready(function(){
	$("#adminLoginBtn").click(function(e){
		if($("#admin-login-form")[0].checkValidity()){
			e.preventDefault();
			$("#admin-login-spinner").show();
			$.ajax({
				url: 'assets/php/admin-action.php',
				method: 'post',
				data: $("#admin-login-form").serialize()+'&action=adminLogin',
				success: function(response){
					if (response === 'admin_login') {
						window.location = 'admin-dashboard.php';
					} else {
						$("#adminLoginAlert").html(response);
						$("#admin-login-spinner").hide();
					}
				}
			});
		}
	});
});


	//Register Ajax Request
	$("#register-btn").click(function(e){
		if($("#register-form")[0].checkValidity()){
			e.preventDefault();
			$("#register-spinner").show();
			if($("#rpassword").val() != $("#cpassword").val()){
				$("#passError").text('Les Nouveaux Mots de passes ne correspondent pas.');
				$("#register-spinner").hide();
			} else {
				$("#passError").text('');
				$.ajax({
					url: 'assets/php/action.php',
					method: 'post',
					data: $("#register-form").serialize()+'&action=register',
					success: function(response){
						$("#register-spinner").hide();
						if (response === 'register') {
							window.location = 'home.php';
						} else {
							$("#regAlert").html(response);
						}
					}
				});
			}
		}
	});