<?php 
	session_start();
	if (!isset($_SESSION['username'])) {
		header("Location:index.php");
		exit();
	}

 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

		<?php
			$title = basename($_SERVER['PHP_SELF'], '.php');
			$title = explode('-', $title);
			$title = ucfirst($title[1]);
		?>

        <title>Madness Fitness - <?= $title; ?></title>
		

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">

        <!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="admin-dashboard.php" class="logo">
						<img src="assets/img/logo.png" alt="Logo">
					</a>
					<a href="admin-dashboard.php" class="logo logo-small">
						<img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">
					</a>
                </div>
				<!-- /Logo -->
				
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar.png" width="31" alt="admin"></span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="assets/img/profiles/avatar.png" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6>Bonjour, <?= $_SESSION['username']; ?></h6>
									<p class="text-muted mb-0">Administrateur</p>
								</div>
							</div>
							<a class="dropdown-item" href="assets/php/logout.php">Déconnexion</a>
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php')?"active":""; ?>"> 
								<a href="admin-dashboard.php"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-users.php')?"active":""; ?>"> 
								<a href="admin-users.php"><i class="fe fe-users"></i> <span>Utilisateurs</span></a>
							</li>
							<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-addstructure.php')?"active":""; ?>"> 
								<a href="admin-addstructure.php"><i class="fa fa-building-o"></i></i> <span>Ajout Structure</span></a>
							</li>
							<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-permissions.php')?"active":""; ?>"> 
								<a href="admin-permissions.php"><i class="fa fa-check-circle"></i></i> <span>Permissions</span></a>
							</li>
							<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-feedback.php')?"active":""; ?>"> 
								<a href="admin-feedback.php"><i class="fe fe-comment-o"></i> <span>Message(s)</span></a>
							</li>
							<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-notification.php')?"active":""; ?>"> 
								<a href="admin-notification.php"><i class="fe fe-bell"></i> <span>Notification(s)</span> <span id="checkNotification"></span></a>
							</li>
							<li class="<?= (basename($_SERVER['PHP_SELF']) == 'admin-deleteduser.php')?"active":""; ?>"> 
								<a href="admin-deleteduser.php"><i class="fe fe-user-minus"></i> <span>Corbeille</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->

			