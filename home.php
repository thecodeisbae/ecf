<?php require_once 'assets/php/header.php'; ?>
			
			<!-- Page Wrapper -->
                <div class="content container" style="padding-top: 5em;">

                	<div class="row">
                		<div class="col-lg-12">
                			<?php if($verified == 'Not Verified'): ?>
                			<div class="alert alert-danger text-center m-2 m-0">
                				<strong>Votre e-mail n'est pas vérifié ! Nous vous avons envoyé un lien de vérification sur votre email, cliquer dessus et revenez plus tard !</strong>
                			</div>
                			<?php endif; ?>
                			<h4 class="text-center mt-3">Franchise <?= $cname; ?></h4>
                		</div>
                	</div>
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card mt-2">
								<div class="card-header">
									<h4 class="card-title float-left mt-2">Mes Structures</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive" id="showNote">
										<h4 class="text-center text-lead mt-2">Chargement...</h4>
									</div>
								</div>
							</div>
						</div>			
					</div>


					<div class="row">
						<div class="col-sm-12">
							<div class="card mt-2">
								<div class="card-header">
									<h4 class="card-title float-left mt-2">Mes Droits</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive" id="showDroit">
										<h4 class="text-center text-lead mt-2"></h4>
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

        <!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<script src="assets/php/js/home.js"></script>
		
    </body>

</html>