<?php

    require_once 'assets/php/auth.php';

    $user = new Auth();
    $msg = '';

    if (isset($_GET['email']) && isset($_GET['token'])) {
        $email = $user->test_input($_GET['email']);
        $token = $user->test_input($_GET['token']);

        $auth_user = $user->reset_pass_auth($email, $token);

        if($auth_user != null){
            if (isset($_POST['submit'])) {
                $newpass = $_POST['pass'];
                $cnewpass = $_POST['cpass'];

                $hnewpass = password_hash($newpass, PASSWORD_DEFAULT);

                if ($newpass == $cnewpass) {
                    $user->update_new_pass($hnewpass, $email);
                    $msg = $user->showMessage('success', 'Votre mot de passe à été changé.');
                } else {
                    $msg = $user->showMessage('danger', 'Ancien mot de passe ne correpond pas');
                }
            }
        } else {
            header('location:index.php');
            exit();
        }
    } else {
        header('location:index.php');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Madness Fitness - Modifier Mot de passe</title>
		
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
	
		<!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img class="img-fluid" src="assets/img/logo.png" alt="Logo">
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>Modifier Mot de passe</h1>
								<p class="account-subtitle"></p>
								
								<!-- Form -->
								<form action="#" method="post">
									<div class="text-center"><?php echo $msg; ?></div>
									<div class="form-group">
										<input class="form-control" name="pass" type="password" placeholder="Nouveau Mot de passe" required minlength="6">
									</div>
									<div class="form-group">
										<input class="form-control" name="cpass" type="password" placeholder="Confimer le Nouveau Mot de passe" required minlength="6">
									</div>
									<div class="form-group">
										<input class="btn btn-primary btn-block" type="submit" name="submit" value="Modifier">
									</div>
								</form>
								<!-- /Form -->
								<div class="text-center dont-have">Retourner à la page de connexion <a href="index.php">Connexion</a></div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>