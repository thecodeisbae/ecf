<?php require_once 'assets/php/admin-header.php'; ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Utilisateurs</li>
								</ul>
							</div>
						</div>
					</div>
					
					<!-- /Page Header -->

					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
								Ajouter un compte
								</button>
						</h6>
					</div>
					
					<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Ajouter un Utilisateur</h5>
						</div>
						<br>
						<form action="#" method="post" id="register-form">
									<div id="regAlert"></div>
									<div class="form-group">
										<input class="form-control" type="text" name="name" id="name" placeholder="Nom " required>
									</div>
									<div class="form-group">
										<input class="form-control" name="email" id="remail" type="email" placeholder="Adresse Email" required>
									</div>
									<div class="form-group">
										<input class="form-control" type="password" name="password" id="rpassword" placeholder="Mot de passe" minlength="6" required>
									</div>
									<div class="form-group">
										<input class="form-control" type="password" name="cpassword" id="cpassword" placeholder="Confimer Mot de passe" minlength="6" required>
									</div>
									<label for="pet-select">Choisir un role:</label>

									<select name="pets" id="pet-select">
										<option value="2">Franchise</option>
										<option value="3">Structure</option>
									</select>
									<div class="form-group">
										<div id="passError" class="text-center text-danger font-weight-bold"></div>
									</div>
									<div class="form-group mb-0">
										<button class="btn btn-primary btn-block" type="submit" id="register-btn">Créer
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="register-spinner"></span></button>
									</div>
							</form>

						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
			
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Utilisateur(s) Actif(s)</h4>
								</div>
								<div class="card-body">

									<div class="table-responsive" id="showAllUsers">
										<h4 class="text-center text-lead mt-2">Une Erreur est survenu...</h4>
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

		<div class="modal fade" id="showUserDetailsModal">
			<div class="modal-dialog modal-dialog-centered mw-100 w-50">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="getName"></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="card-deck">
							<div class="card border-primary">
								<div class="card-body">
								
									<p id="getEmail"></p>						
									<p id="getCreated"></p>
									<p id="getVerified"></p>
									<p id="getRole"></p>
									<p id="getAddress"></p>
									<p id="getCity"></p>
							
								</div>
							</div>
							<div class="card align-self-center" id="getImage"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</div>
		</div>

		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/css/stylebtn.css"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>

		<script  src="assets/php/js/users.js"></script>
		<script src="assets/php/js/index.js"></script>
		
    </body>

</html>
