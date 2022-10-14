<?php

	class Database {

		const USERNAME = 'madnessfitness33@gmail.com';
		const PASSWORD = 'Azerty71140**';

		private $dsn = "mysql:host=localhost;dbname=user_management";
		private $dbuser = "root";
		private $dbpass = "";

		public $conn;

		public function __construct(){
			try{
				$this->conn = new PDO($this->dsn,$this->dbuser,$this->dbpass);
			} catch (PDOException $e) {
				echo 'Error: '.$e->getMessage();
			}

			return $this->conn;
		}

		//Check Inputs
		public function test_input($data){
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlentities($data);
			return $data;
		}

		//Error Success Messages Alert
		public function showMessage($type, $message){
			return '<div class="alert alert-'.$type.' alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong class="text-center">'.$message.'</strong>
					</div>';
		}

		//Affichage du temps 
		public function timeInAgo($timestamp){
            date_default_timezone_set('Europe/Paris');
            $timestamp = strtotime($timestamp) ? strtotime($timestamp) : strtotime($timestamp);
            $time = time() - $timestamp;
            switch($time){
                //Secondes
                case $time <= 60:
                    return 'Juste à l'+'instant!';
                //Minutes
                case $time >= 60 && $time < 3600:
                    return (round($time/60) == 1) ? 'Il y a 1' : round($time/60).' min(s)';
                //Heures
                case $time >= 3600 && $time < 86400:
                    return (round($time/3600) == 1) ? 'Quelque heure' : round($time/3600).' heure(s)';
                //Jours
                case $time >= 86400 && $time < 604800:
                    return (round($time/86400) == 1) ? 'Plusieurs Jours' : round($time/86400).'Jours';
                //Semaines
                case $time >= 604800 && $time < 2600640:
                    return (round($time/604800) == 1) ? 'Une Semaine' : round($time/604800).'Semaine(s)';
                //Mois
                case $time >= 2600640 && $time < 31207680:
                    return (round($time/2600640) == 1) ? '1 Mois' : round($time/2600640).'Mois';
                //Années
                case $time >= 31207680:
                    return (round($time/31207680) == 1) ? '1 ans' : round($time/31207680).'Année(s)';
            }
        }
	}

?>