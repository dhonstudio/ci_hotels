	</div>
	<!-- end:fh5co-header -->
	<div class="fh5co-parallax" style="background-image: url(<?= base_url('assets/vendor/luxe/') ?>images/slider1.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
					<div class="fh5co-intro fh5co-table-cell">
						<!-- <h1 class="text-center">Contact Us</h1>
						<p>Made with love by the fine folks at <a href="http://freehtml5.co">FreeHTML5.co</a></p> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-contact-section">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="col-md-12">
					<h3 class="text-center">Kamar Tersedia</h3>
					<p>Detail pemesanan anda:</p>
					<ul class="contact-info">
						<li><i class="ti-home"></i><?= $reservation['room_name']?></li>
						<li><i class="ti-home"></i>Jumlah Kamar: <?= $reservation['total_room']?></li>
						<li><i class="ti-calendar"></i>Check in: <?= indonesian_date(substr_replace(substr_replace($reservation['checkin'], '-', 4, 0), '-', 7, 0))?></li>
						<li><i class="ti-calendar"></i>Check out: <?= indonesian_date(substr_replace(substr_replace($reservation['checkout'], '-', 4, 0), '-', 7, 0))?></li>						
					</ul>
					<p>Silahkan lengkapi data reservasi anda:</p>
					<!-- <p class="text-center"><text id="countdown"></text></p> -->
				</div>
				<div class="col-md-12">
					<div class="row">
						<form method="post" action="<?= base_url('home/check_availability/booking') ?>">
							<input hidden name="id_room" value="<?= $reservation['id_room']?>">
							<input hidden name="start_date" value="<?= $reservation['checkin']?>">
							<input hidden name="end_date" value="<?= $reservation['checkout']?>">
							<input hidden name="total_room" value="<?= $reservation['total_room']?>">
							<input hidden name="reservation_code" value="<?= $reservation['reservation_code']?>">
							<div class="col-md-6">
								<div class="form-group">
									Nama Lengkap
									<input name="guest_name" required type="text" class="form-control" placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									Email
									<input name="guest_email" required type="email" class="form-control" placeholder="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Pesan Sekarang" class="btn btn-primary">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>