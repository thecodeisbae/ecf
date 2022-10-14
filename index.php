<?php
	session_start();
	include_once 'assets/php/config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Madness Fitness</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
    </head>
    <body>
	
		<!--Formulaire de Connexion -->
        <div class="main-wrapper login-body" id="login-box">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img class="img-fluid" src="assets/img/logo_Madness.png" width="500" height="600" alt="Logo">
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1 class="mb-4">Connexion</h1>
								
								<!-- Formulaire -->
								<form action="#" method="post" id="login-form">
									<div id="loginAlert"></div>
									<div class="form-group">
										<input class="form-control" type="email" name="email" id="email" placeholder="Email" required value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} ?>">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" name="password" id="password" placeholder="Password" required minlength="6" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>">
									</div>
									<div class="form-group">
										<div class="checkbox float-left">
											<label>
												<input type="checkbox" name="rem"<?php if(isset($_COOKIE['email'])) { ?> checked <?php } ?>> Se souvenir de moi
											</label>
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" type="submit" id="login-btn">Se Connecter
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="login-spinner"></span></button>
									</div>
								</form>
								
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- /Fin de Formulaire -->


		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- Form Validation JS -->
        <script src="assets/js/form-validation.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

		<script src="assets/php/js/index.js"></script>
		
    </body>

</html>