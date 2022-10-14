<?php require_once 'assets/php/header.php'; ?>


	<div class="content container" style="padding-top: 5em;">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
			
				<div class="card mt-2">
					<div class="card-header">
						<h4 class="card-title float-left mt-2">Ecrire à l'administrateur ....</h4>
					</div>
					<form action="#" method="post" id="feedback-form">
						<div class="card-body">
							<div class="form-group">
								<input type="text" name="subject" class="form-control" placeholder="Objet du message" required>
							</div>
							<div class="form-group">
								<textarea name="feedback" class="form-control" placeholder="Votre Message" rows="8" required></textarea>
							</div>
							<div class="form-group">
								<button type="submit" name="feedbackBtn" id="feedbackBtn" class="btn btn-block btn-primary">Envoyer<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="send-feedback-spinner"></span></button>
							</div>
						</div>
					</form>
				</div>				
			</div>		
		</div>
	</div>

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
		<script src="assets/php/js/feedback.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/ventura/blank-page.html by HTTrack Website Copier/3.x [XR&CO'2017], Sat, 18 Apr 2020 05:52:31 GMT -->
</html>