<?php
	require_once 'assets/php/admin-header.php';
	require_once 'assets/php/admin-db.php';
	$count = new Admin();
?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-xl-3 col-sm-4 col-12">
									<div class="card">
										<div class="card-header lead text-center text-primary">Nombre d'utilisateur</div>
										<div class="card-body">
											<h1 class="display-4 text-center text-primary"><?= $count->totalCount('users'); ?></h1>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-sm-4 col-12">
									<div class="card">
										<div class="card-header lead text-center text-warning">Utilisateurs Vérifiés</div>
										<div class="card-body">
											<h1 class="display-4 text-center text-warning"><?= $count->verified_users(1); ?></h1>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-sm-4 col-12">
									<div class="card">
										<div class="card-header lead text-center text-danger">Utilisateurs non Vérifiés</div>
										<div class="card-body">
											<h1 class="display-4 text-center text-danger"><?= $count->verified_users(0); ?></h1>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-sm-4 col-12">
									<div class="card">
										<div class="card-header lead text-center text-dark">Notification(s)</div>
										<div class="card-body">
											<h1 class="display-4 text-center text-dark"><?= $count->totalCount('notification'); ?></h1>
										</div>
									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		<script type="text/javascript">

			//Affiche les nouvelles notifications
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

				google.charts.load("current", {packages:["corechart"]});
				google.charts.setOnLoadCallback(colChart);
				function colChart() {
					var data = google.visualization.arrayToDataTable([
						['Verified', 'Number'],
						<?php
							$verified = $count->verifiedPer();
							foreach ($verified as $row) {
								if ($row['verified'] == 0) {
									$row['verified'] = "Non Vérifié";
								} else {
									$row['verified'] = "Vérifié";
								}
								echo '["'.$row['verified'].'",'.$row['number'].'],';
							}
						?>
					]);
					var options = {
						pieHole: 0.4,
					};
					var chart = new google.visualization.PieChart(document.getElementById('chartVerified'));
					chart.draw(data, options);
				}
		</script>
		
    </body>
</html>