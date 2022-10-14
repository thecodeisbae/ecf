<?php 

	require_once 'config.php';

	class Admin extends Database
	{
		//Enregistrer un compte utilisateur
		public function register($name, $email, $password) {
			$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['name'=>$name, 'email'=>$email, 'pass'=>$password]);
			return true;
		}
		
		//Connexion Admin
		public function admin_login($username, $password){
			$sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['username'=>$username, 'password'=>$password]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}

		//count Total No. of Rows
		public function totalCount($tablename){
			$sql = "SELECT * FROM $tablename";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$count = $stmt->rowCount();
			return $count;
		}

		//Status d'un utilisateur
		public function verified_users($status){
			$sql = "SELECT * FROM users WHERE verified = :status";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['status'=>$status]);
			$count = $stmt->rowCount();
			return $count;
		}

		//Compte le nombre de vérification
		public function verifiedPer(){
			$sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}


		//Affiche tous les comptes utilisateur
		public function fetchAllUsers($val){
			$sql = "SELECT * FROM users WHERE deleted != $val";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		//Affiche les utilisateurs
		public function fetchUserDetailsById($id){
			$sql = "SELECT * FROM users WHERE id = :id AND deleted != 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}


		//Affiche les Structures
		public function fetchStructureDetailsById($id){
			$sql = "SELECT * FROM structure WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		//Desactiver un compte
		public function userAction($id, $val){
			$sql = "UPDATE users SET deleted = $val WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
		}

		//Supprimer un compte 
		public function userdelete($id){
			$sql = "DELETE FROM users WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
		}

		//Mettre à jour un profil
		public function update_profile($name,$gender,$dob,$phone,$photo,$address,$city,$state,$zipcode,$country,$id){
			$sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo, address = :address, city = :city, state = :state, zip_code = :zipcode, country = :country WHERE id = :id AND deleted != 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['name'=>$name, 'gender'=>$gender, 'dob'=>$dob, 'phone'=>$phone, 'photo'=>$photo, 'address'=>$address, 'city'=>$city, 'state'=>$state, 'zipcode'=>$zipcode, 'country'=>$country, 'id'=>$id]);
			return true;
		}

		//Affihe tous les les messages 
		public function fetchFeedback(){
			$sql = "SELECT feedback.id, feedback.subject, feedback.feedback, feedback.created_at, feedback.uid, users.name, users.email FROM feedback INNER JOIN users ON feedback.uid = users.id WHERE replied != 1 ORDER BY feedback.id DESC";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		//Réponse message 
		public function replyFeedback($uid, $message){
			$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, 'user', :message)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'message'=>$message]);
			return true;
		}

		//Message répondu 
		public function feedbackReplied($fid){
			$sql = "UPDATE feedback SET replied = 1 WHERE id = :fid";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['fid'=>$fid]);
			return true;
		}

		//Affiche les notifs
		public function fetchNotification(){
			$sql = "SELECT notification.id, notification.message, notification.created_at, users.name, users.email FROM notification INNER JOIN users ON notification.uid = users.id WHERE type = 'admin' ORDER BY notification.id DESC LIMIT 5";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

        //Compte le nombre de notifications
        public function countNotification(){
        	$sql = "SELECT count(*) FROM notification WHERE type = 'admin'";
        	$stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            return $result;
        }

        //Supprime une notification
        public function removeNotification($id){
        	$sql = "DELETE FROM notification WHERE id = :id AND type = 'admin'";
        	$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
        }

	}

 ?>