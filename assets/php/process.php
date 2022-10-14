<?php
	require_once 'session.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/autoload.php';

	$mail = new PHPMailer(true);

	//Handle Add New Note Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'add_note') {
		$title = $cuser->test_input($_POST['title']);
		$note = $cuser->test_input($_POST['note']);

		$cuser->add_new_note($cid, $title, $note);
		$cuser->notification($cid, 'admin', 'Note Added.');
	}



	//Handle Profile Update Ajax Request
	if (isset($_FILES['image'])) {
		$name = $cuser->test_input($_POST['name']);
		$gender = $cuser->test_input($_POST['gender']);
		$dob = $cuser->test_input($_POST['dob']);
		$phone = $cuser->test_input($_POST['phone']);
		$address = $cuser->test_input($_POST['address']);
		$state = $cuser->test_input($_POST['state']);
		$city = $cuser->test_input($_POST['city']);
		$zipcode = $cuser->test_input($_POST['zipcode']);
		$country = $cuser->test_input($_POST['country']);

		$oldImage = $_POST['oldimage'];
		$folder = 'uploads/';

		if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
			$newImage = $folder.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $newImage);
			if ($oldImage != null) {
				unlink($oldImage);
			}
		} else {
			$newImage = $oldImage;
		}

		$cuser->update_profile($name,$gender,$dob,$phone,$newImage,$address,$city,$state,$zipcode,$country,$cid);
		$cuser->notification($cid, 'admin', 'Profile Updated.');
	}

	//Handle change password ajax request
	if(isset($_POST['action']) && $_POST['action'] == 'change_pass'){
        $currentPass = $_POST['curpass'];
        $newPass = $_POST['newpass'];
        $cnewPass = $_POST['cnewpass'];
        $hnewPass = password_hash($newPass, PASSWORD_DEFAULT);

        if($newPass != $cnewPass){
            echo $cuser->showMessage('danger', 'Les Nouveaux mots de passe ne correspondent pas !');
        } else {
            if(password_verify($currentPass, $cpass)){
                $cuser->change_password($hnewPass, $cid);
                $cuser->notification($cid, 'admin', 'Mot de passe Changé');
                echo $cuser->showMessage('success', 'Nouveau mot de passe enregistrer!');
            } else {
                echo $cuser->showMessage('danger', 'Mot de passe Actuel incorrect !');
            }
        }
    }

    //Handle verify email ajax request
    if(isset($_POST['action']) && $_POST['action'] == 'verify_email'){

    	$token = uniqid();
		$token = str_shuffle($token);
		$cuser->forgot_password($token,$cemail);

    	try {
			$mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = Database::USERNAME;
            $mail->Password = Database::PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(Database::USERNAME,'Ventura - User Management');
            $mail->addAddress($cemail);

            $mail->isHTML(true);
            $mail->Subject = 'E-Mail Verification';
            $mail->Body = '<h3>Click the below link to verify your email address.</h3><br><a href="http://localhost/user_management/verify-email.php?email='.$cemail.'&token='.$token.'">http://localhost/user_management/verify-email.php?email='.$cemail.'&token='.$token.'</a><br><br><br>Regards,<br>Ventura - User Management';
            
            $mail->send();
			echo $cuser->showMessage('success', 'We have send you email verification link to your email.');
		} catch(Exception $e) {
			echo $cuser->showMessage('danger', 'Something went wrong. Try again later.');
		}
    }

    //Handle Send Feedback ajax request
    if(isset($_POST['action']) && $_POST['action'] == 'feedback'){
    	$subject = $cuser->test_input($_POST['subject']);
    	$feedback = $cuser->test_input($_POST['feedback']);

    	$cuser->send_feedback($subject, $feedback, $cid);
    	$cuser->notification($cid, 'admin', 'Feedback Written.');
    }

    //Handle fetch notification Ajax Request
    if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
    	$notification = $cuser->fetchNotification($cid);
    	$output = '';
    	if ($notification) {
    		foreach ($notification as $row) {
    			$output .= '<div class="alert alert-danger" role="alert">
								<button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="alert-heading">Nouveau Message !</h4>
								<p class="mb-0 lead">'.$row['message'].'</p>
								<hr class="my-2">
								<p class="mb-0 float-left">Administrateur vous a répondu </p>
								<p class="mb-0 float-right">'.$cuser->timeInAgo($row['created_at']).'</p>
								<div class="clearfix"></div>
							</div>';
    		}
    		echo $output;
    	} else {
    		echo '<h3 class="text-center">Aucun message</h3>';
    	}
    }

    //check notification
    if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
    	if($cuser->fetchNotification($cid)){
    		echo '<span class="badge badge-pill">'.$cuser->countNotification($cid).'</span>';
    	} else {
    		echo '';
    	}
    }

    //remove notification
    if (isset($_POST['notification_id'])) {
    	$id = $_POST['notification_id'];
    	$cuser->removeNotification($id);
    }

?>