<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

	require_once 'admin-db.php';

	$admin = new Admin();
	session_start();

	//Message Login Administrateur 
	if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
		$username = $admin->test_input($_POST['username']);
		$password = $admin->test_input($_POST['password']);
		$hpassword = sha1($password);

		$loggedInAdmin = $admin->admin_login($username, $hpassword);

		if ($loggedInAdmin != null) {
			echo 'admin_login';
			$_SESSION['username'] = $username;
		} else {
			echo $admin->showMessage('danger', 'Email ou Mot de passe incorrect.');
		}
	}

	//Affiche l'ensemble des utilisateurs 
	if (isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers') {
		$output = '';
		$data = $admin->fetchAllUsers(1);
		$path = '../assets/php/';

		if ($data) {
			$output .= '<table class="datatable table table-stripped text-center">
							<thead>
								<tr>

								<th>Logo</th>
								<th>Role</th>
								<th>Nom</th>
								<th>E-Mail</th>
								<th>Email Vérifié</th>
								<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
			foreach ($data as $row) {

				if ($row['photo'] != '') {
					$uphoto = $path.$row['photo'];
				} else {
					$uphoto = '../assets/img/profiles/avatar.png';
				}
				if($row['role'] ==2){
					$row['role']="Franchise";
				}
				else{
					$row['role']="Structure";
				}
				if($row['verified']==0){
					$row['verified']="non";
				}else{
					$row['verified']="oui";
				}
				$output .= '
								<tr>
							
									<td><img class="avatar-img rounded-circle" src="'.$uphoto.'" width="30"></td>
									<td>'.$row['role'].'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['verified'].'</td>
									<td>
										<a href="#" id="'.$row['id'].'" title="Voir" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fa fa-info-circle"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="'.$row['id'].'" title="Modifier" class="text-primary userEditIcon" data-toggle="modal" data-target="#profile-update-form"><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="'.$row['id'].'" title="Désactiver" class="text-danger userDeleteIcon"><i class="fa fa-ban"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="'.$row['id'].'" title="Supprimer" class="text-danger userDesactiveIcon"><i class="fa fa-trash"></i></a>
									</td>
								</tr>';
			}	
			$output .= '
							</tbody>
						</table>';		
			echo $output;			
		} else {
			echo "<h3 class='text-center text-secondary'>Aucun utilisateur trouvé</h3>";
		}
	}

	//Quand Admin Vois un Profil -> Modal Js
	if (isset($_POST['details_id'])) {
		$id = $_POST['details_id'];
		$data = $admin->fetchUserDetailsById($id);
		echo json_encode($data);
	}

	//Quand Admin Vois un Profil -> Modal Js
	if (isset($_POST['update_id'])) {
		$id = $_POST['update_id'];
	}

	//Quand Admin Désactive un Profil -> Modal Js
	if (isset($_POST['delete_id'])) {
		$id = $_POST['delete_id'];
		$admin->userAction($id, 1);
	}

	//Quand Admin Supprime un Profil -> Modal Js
	if (isset($_POST['deleteu_id'])) {
		$id = $_POST['deleteu_id'];
		$admin->userdelete($id);
	}
	

	//Affiche la Cordbeille des Utilisateurs
	if (isset($_POST['action']) && $_POST['action'] == 'fetchAllDeletedUsers') {
		$output = '';
		$data = $admin->fetchAllUsers(0);
		$path = '../assets/php/';

		if ($data) {
			$output .= '<table class="datatable table table-stripped text-center">
							<thead>
								<tr>
									<th>Profil</th>
									<th>Role</th>
									<th>Nom</th>
									<th>E-Mail</th>
									<th>Email Vérifier</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
			foreach ($data as $row) {

				if ($row['photo'] != '') {
					$uphoto = $path.$row['photo'];
				} else {
					$uphoto = '../assets/img/profiles/avatar.png';
				}

				if($row['role'] ==2){
					$row['role']="Franchise";
				}
				else{
					$row['role']="Structure";
				}
				if($row['verified']==0){
					$row['verified']="non";
				}else{
					$row['verified']="oui";
				}

				$output .= '
								<tr>
							
									<td><img class="avatar-img rounded-circle" src="'.$uphoto.'" width="30"></td>
									<td>'.$row['role'].'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['verified'].'</td>
									<td>
										<a href="#" id="'.$row['id'].'" title="Réactiver" class="text-white badge badge-success restoreUserIcon">Réactiver Utilisateur</a>
									</td>
								</tr>';
			}	
			$output .= '
							</tbody>
						</table>';		
			echo $output;			
		} else {
			echo "<h3 class='text-center text-secondary'>Aucun utilisateur Désactivé </h3>";
		}
	}

	//Quand Admin Restaure un Profil -> Modal Js
	if (isset($_POST['restore_id'])) {
		$id = $_POST['restore_id'];
		$admin->userAction($id, 0);
	}


	//Affiche tous les Mesages reçus
	if (isset($_POST['action']) && $_POST['action'] == 'fetchAllFeedback') {
		$output = '';
		$feedback = $admin->fetchFeedback();

		if ($feedback) {
			$output .= '<table class="datatable table table-stripped text-center">
							<thead>
								<tr>
								
									<th>Expéditeur</th>
									<th>adresse mail</th>
									<th>Objet</th>
									<th>Message</th>
									<th>Envoyé le</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
			foreach ($feedback as $row) {

				$output .= '
								<tr>		
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['subject'].'</td>
									<td>'.$row['feedback'].'</td>
									<td>'.$row['created_at'].'</td>
									<td>
										<a href="#" fid="'.$row['id'].'" id="'.$row['uid'].'" title="Répondre" class="text-primary replyFeedbackIcon" data-toggle="modal" data-target="#showReplyModal"><i class="fa fa-reply"></i></a>
									</td>
								</tr>';
			}	
			$output .= '
							</tbody>
						</table>';		
			echo $output;			
		} else {
			echo "<h3 class='text-center text-secondary'>Aucun Message !</h3>";
		}
	}

	//Admin Répond au Message d'un utilisateur
	if (isset($_POST['message'])) {
		$uid = $_POST['uid'];
		$message = $admin->test_input($_POST['message']);
		$fid = $_POST['fid'];

		$admin->replyFeedback($uid, $message);
		$admin->feedbackReplied($fid);
	}

	//Affiche les Notifications que Admin reçois
    if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
    	$notification = $admin->fetchNotification();
    	$output = '';
    	if ($notification) {
    		foreach ($notification as $row) {
    			$output .= '<div class="alert alert-dark" role="alert">
								<button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="alert-heading">Nouvelle Notification:</h4>
								<p class="mb-0 lead"> de '.$row['name'].'</p>
								<hr class="my-2">
								<p class="mb-0 float-left"><b>Adresse Mail: </b>'.$row['email'].'</p>
								<p class="mb-0 float-right">'.$admin->timeInAgo($row['created_at']).'</p>
								<div class="clearfix"></div>
							</div>';
    		}
    		echo $output;
    	} else {
    		echo '<h3 class="text-center">Aucune Notification</h3>';
    	}
    }

    //Vérification des Notif
    if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
    	if($admin->fetchNotification()){
    		echo '<span class="badge badge-danger badge-pill">'.$admin->countNotification().'</span>';
    	} else {
    		echo '';
    	}
    }

    //Supprime les notif Admin
    if(isset($_POST['notification_id'])){
    	$id = $_POST['notification_id'];
    	$admin->removeNotification($id);
    }

	//inscription des Comptes utilisateur par Admin + mail envoie 
	if (isset($_POST['action']) && $_POST['action'] == 'register') {
		$name = $user->test_input($_POST['name']);
		$email = $user->test_input($_POST['email']);
		$pass = $user->test_input($_POST['password']);
		$password = password_hash($pass, PASSWORD_DEFAULT);

		if ($user->user_exist($email)) {
			echo $user->showMessage('warning', 'Cet adresse mail existe déjà !');
		} else {
			if ($user->register($name,$email,$password)) {
				echo 'register';
				$_SESSION['user'] = $email;

				$token = uniqid();
				$token = str_shuffle($token);
				$user->forgot_password($token,$email);

				$mail->isSMTP();
	            $mail->Host = 'smtp.gmail.com';
	            $mail->SMTPAuth = true;
	            $mail->Username = Database::USERNAME;
	            $mail->Password = Database::PASSWORD;
	            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	            $mail->Port = 587;

	            $mail->setFrom(Database::USERNAME,'Madness Fitness - Compte Utilisateur');
	            $mail->addAddress($email);

	            $mail->isHTML(true);
	            $mail->Subject = 'E-Mail Vérification';
	            $mail->Body = '<h3>Click the below link to verify your email address.</h3><br><a href="http://localhost/user_management/verify-email.php?email='.$email.'&token='.$token.'">http://localhost/user_management/verify-email.php?email='.$email.'&token='.$token.'</a><br><br><br>Regards,<br>Ventura - User Management';
	            
	            $mail->send();

			} else {
				echo $user->showMessage('danger', 'Un problème est survenue...Réessayer plus tard.');
			}
		}
	}
 ?>

 