	
		
	</div>
	<!-- end:fh5co-header -->
	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
				<?php foreach ($rooms as $r) :?>
					<li style="background-image: url(<?= base_url('assets/img/rooms/'.$r['room_photo_sliding']) ?>);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="col-md-12 col-md-offset-0 text-center slider-text">
								<div class="slider-text-inner js-fullheight">
									<div class="desc">
										<p><span><?= $r['room_name'] ?></span></p>
										<h2><?= $r['room_slogan'] ?></h2>
										<p>
											<!-- <a href="#availability" class="btn btn-primary btn-lg">Reservasi Sekarang</a> -->
										</p>
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php endforeach?>
		  	</ul>
	  	</div>
	</aside>
	<div class="wrap">
		<div class="container">
			<div class="row">
				<div id="availability">
					<form method="post" action="<?= base_url('home/check_availability') ?>" id="check_availability">
						<div class="a-col">
							<section>
								<select class="cs-select cs-skin-border" id="id_room" name="id_room">
									<option value="" disabled selected>Tipe Kamar</option>
									<?php foreach ($rooms as $r) :?>
										<option value="<?= $r['id_room']?>"><?= $r['room_name']?></option>
									<?php endforeach?>
								</select>
							</section>
						</div>
						<div class="a-col alternate">
							<div class="input-field">
								<label for="date-start">Check In</label>
								<input type="text" autocomplete="off" class="form-control" id="date-start" name="start_date"/>
							</div>
						</div>
						<div class="a-col alternate">
							<div class="input-field">
								<label for="date-end">Check Out</label>
								<input type="text" autocomplete="off" class="form-control" id="date-end" name="end_date"/>
							</div>
						</div>
						<div class="a-col">
							<div class="input-field">
								<label for="total-rooms">Jumlah</label>
								<input type="text" autocomplete="off" class="form-control" id="total-room" name="total_room"/>
							</div>
						</div>
						<div class="a-col action">
							<a href="#" onclick="check_availability()">
								<span>Cek</span>
								Ketersediaan
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div id="featured-hotel" class="fh5co-bg-color">
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<h2>Tipe Kamar</h2>
					</div>
				</div>
			</div>

			<?php if (count($rooms) > 0):?>
				<div class="row">
					<div class="feature-full-1col">
						<div class="image" style="background-image: url(<?= base_url('assets/img/rooms/'.$rooms[0]['room_photo']) ?>);">
							<div class="descrip text-center">
								<p><small></small><span>Rp <?= number_format($rooms[0]['room_price'], 0, ',', '.') ?>/malam</span></p>
							</div>
						</div>
						<div class="desc">
							<h3><?= $rooms[0]['room_name'] ?></h3>
							<p><?= $rooms[0]['room_description'] ?></p>
							<p>
								<div class="h2">
									<?php if ($rooms[0]['ac'] == 1) :?>
										<i class="fas fa-water mr-3" title="AC"></i>
									<?php endif?>
									<?php if ($rooms[0]['wifi'] == 1) :?>
										<i class="fas fa-wifi" title="Wifi"></i>
									<?php endif?>
									<?php if ($rooms[0]['nosmoking'] == 1) :?>
										<i class="fas fa-smoking-ban" title="Bebas Rokok"></i>
									<?php endif?>
									<?php if ($rooms[0]['breakfast'] == 1) :?>
										<i class="fas fa-utensils" title="Sarapan"></i>
									<?php endif?>
								</div>
							</p>
							<p><a href="#" class="btn btn-primary btn-luxe-primary">Reservasi Sekarang <i class="ti-angle-right"></i></a></p>
						</div>
					</div>

					<?php if (count($rooms) > 1 && count($rooms) < 4):?>
						<?php if (count($rooms) == 3):?>
							<div class="feature-full-2col">
								<div class="f-hotel">
									<div class="image" style="background-image: url(<?= base_url('assets/img/rooms/'.$rooms[1]['room_photo']) ?>);">
										<div class="descrip text-center">
											<p><small></small><span>Rp <?= number_format($rooms[1]['room_price'], 0, ',', '.') ?>/malam</span></p>
										</div>
									</div>
									<div class="desc">
										<h3><?= $rooms[1]['room_name'] ?></h3>
										<p><?= $rooms[1]['room_description'] ?></p>
										<p>
											<div class="h2">
												<?php if ($rooms[1]['ac'] == 1) :?>
													<i class="fas fa-water mr-3" title="AC"></i>
												<?php endif?>
												<?php if ($rooms[1]['wifi'] == 1) :?>
													<i class="fas fa-wifi" title="Wifi"></i>
												<?php endif?>
												<?php if ($rooms[1]['nosmoking'] == 1) :?>
													<i class="fas fa-smoking-ban" title="Bebas Rokok"></i>
												<?php endif?>
												<?php if ($rooms[1]['breakfast'] == 1) :?>
													<i class="fas fa-utensils" title="Sarapan"></i>
												<?php endif?>
											</div>
										</p>
										<p><a href="#" class="btn btn-primary btn-luxe-primary">Reservasi Sekarang <i class="ti-angle-right"></i></a></p>
									</div>
								</div>
								<div class="f-hotel">
									<div class="image" style="background-image: url(<?= base_url('assets/img/rooms/'.$rooms[2]['room_photo']) ?>);">
										<div class="descrip text-center">
											<p><small></small><span>Rp <?= number_format($rooms[2]['room_price'], 0, ',', '.') ?>/malam</span></p>
										</div>
									</div>
									<div class="desc">
										<h3><?= $rooms[2]['room_name'] ?></h3>
										<p><?= $rooms[2]['room_description'] ?></p>
										<p>
											<div class="h2">
												<?php if ($rooms[2]['ac'] == 1) :?>
													<i class="fas fa-water mr-3" title="AC"></i>
												<?php endif?>
												<?php if ($rooms[2]['wifi'] == 1) :?>
													<i class="fas fa-wifi" title="Wifi"></i>
												<?php endif?>
												<?php if ($rooms[2]['nosmoking'] == 1) :?>
													<i class="fas fa-smoking-ban" title="Bebas Rokok"></i>
												<?php endif?>
												<?php if ($rooms[2]['breakfast'] == 1) :?>
													<i class="fas fa-utensils" title="Sarapan"></i>
												<?php endif?>
											</div>
										</p>
										<p><a href="#" class="btn btn-primary btn-luxe-primary">Reservasi Sekarang <i class="ti-angle-right"></i></a></p>
									</div>
								</div>
							</div>
						<?php else:?>
							<div class="feature-full-1col">
								<div class="image" style="background-image: url(<?= base_url('assets/img/rooms/'.$rooms[1]['room_photo']) ?>);">
									<div class="descrip text-center">
										<p><small></small><span>Rp <?= number_format($rooms[1]['room_price'], 0, ',', '.') ?>/malam</span></p>
									</div>
								</div>
								<div class="desc">
									<h3><?= $rooms[1]['room_name'] ?></h3>
									<p><?= $rooms[1]['room_description'] ?></p>
									<p>
										<div class="h2">
											<?php if ($rooms[1]['ac'] == 1) :?>
												<i class="fas fa-water mr-3" title="AC"></i>
											<?php endif?>
											<?php if ($rooms[1]['wifi'] == 1) :?>
												<i class="fas fa-wifi" title="Wifi"></i>
											<?php endif?>
											<?php if ($rooms[1]['nosmoking'] == 1) :?>
												<i class="fas fa-smoking-ban" title="Bebas Rokok"></i>
											<?php endif?>
											<?php if ($rooms[1]['breakfast'] == 1) :?>
												<i class="fas fa-utensils" title="Sarapan"></i>
											<?php endif?>
										</div>
									</p>
									<p><a href="#" class="btn btn-primary btn-luxe-primary">Reservasi Sekarang <i class="ti-angle-right"></i></a></p>
								</div>
							</div>
						<?php endif;?>
					<?php endif;?>

					<?php if (count($rooms) > 3 && count($rooms) < 6):?>
						<?php if (count($rooms) == 5):?>
							<div class="feature-full-2col">
								<div class="f-hotel">
									<div class="image" style="background-image: url(<?= base_url('assets/img/rooms/'.$rooms[3]['room_photo']) ?>);">
										<div class="descrip text-center">
											<p><small></small><span>Rp <?= number_format($rooms[3]['room_price'], 0, ',', '.') ?>/malam</span></p>
										</div>
									</div>
									<div class="desc">
										<h3><?= $rooms[3]['room_name'] ?></h3>
										<p><?= $rooms[3]['room_description'] ?></p>
										<p>
											<div class="h2">
												<?php if ($rooms[3]['ac'] == 1) :?>
													<i class="fas fa-water mr-3" title="AC"></i>
												<?php endif?>
												<?php if ($rooms[3]['wifi'] == 1) :?>
													<i class="fas fa-wifi" title="Wifi"></i>
												<?php endif?>
												<?php if ($rooms[3]['nosmoking'] == 1) :?>
													<i class="fas fa-smoking-ban" title="Bebas Rokok"></i>
												<?php endif?>
												<?php if ($rooms[3]['breakfast'] == 1) :?>
													<i class="fas fa-utensils" title="Sarapan"></i>
												<?php endif?>
											</div>
										</p>
										<p><a href="#" class="btn btn-primary btn-luxe-primary">Reservasi Sekarang <i class="ti-angle-right"></i></a></p>
									</div>
								</div>
								<div class="f-hotel">
									<div class="image" style="background-image: url(<?= base_url('assets/img/rooms/'.$rooms[4]['room_photo']) ?>);">
										<div class="descrip text-center">
											<p><small></small><span>Rp <?= number_format($rooms[4]['room_price'], 0, ',', '.') ?>/malam</span></p>
										</div>
									</div>
									<div class="desc">
										<h3><?= $rooms[4]['room_name'] ?></h3>
										<p><?= $rooms[4]['room_description'] ?></p>
										<p>
											<div class="h2">
												<?php if ($rooms[4]['ac'] == 1) :?>
													<i class="fas fa-water mr-3" title="AC"></i>
												<?php endif?>
												<?php if ($rooms[4]['wifi'] == 1) :?>
													<i class="fas fa-wifi" title="Wifi"></i>
												<?php endif?>
												<?php if ($rooms[4]['nosmoking'] == 1) :?>
													<i class="fas fa-smoking-ban" title="Bebas Rokok"></i>
												<?php endif?>
												<?php if ($rooms[4]['breakfast'] == 1) :?>
													<i class="fas fa-utensils" title="Sarapan"></i>
												<?php endif?>
											</div>
										</p>
										<p><a href="#" class="btn btn-primary btn-luxe-primary">Reservasi Sekarang <i class="ti-angle-right"></i></a></p>
									</div>
								</div>
							</div>
						<?php else:?>
							<div class="feature-full-1col">
								<div class="image" style="background-image: url(<?= base_url('assets/img/rooms/'.$rooms[3]['room_photo']) ?>);">
									<div class="descrip text-center">
										<p><small></small><span>Rp <?= number_format($rooms[3]['room_price'], 0, ',', '.') ?>/malam</span></p>
									</div>
								</div>
								<div class="desc">
									<h3><?= $rooms[3]['room_name'] ?></h3>
									<p><?= $rooms[3]['room_description'] ?></p>
									<p>
										<div class="h2">
											<?php if ($rooms[3]['ac'] == 1) :?>
												<i class="fas fa-water mr-3" title="AC"></i>
											<?php endif?>
											<?php if ($rooms[3]['wifi'] == 1) :?>
												<i class="fas fa-wifi" title="Wifi"></i>
											<?php endif?>
											<?php if ($rooms[3]['nosmoking'] == 1) :?>
												<i class="fas fa-smoking-ban" title="Bebas Rokok"></i>
											<?php endif?>
											<?php if ($rooms[3]['breakfast'] == 1) :?>
												<i class="fas fa-utensils" title="Sarapan"></i>
											<?php endif?>
										</div>
									</p>
									<p><a href="#" class="btn btn-primary btn-luxe-primary">Reservasi Sekarang <i class="ti-angle-right"></i></a></p>
								</div>
							</div>
						<?php endif;?>
					<?php endif;?>
				</div>
			<?php endif;?>

		</div>
	</div>

	<div id="hotel-facilities">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<h2>Fasilitas</h2>
					</div>
				</div>
			</div>

			<div id="tabs">
				<nav class="tabs-nav">
					<?php if (in_array('restoran', array_column($facilitations, 'fas_type'))):?>
						<a href="#" class="<?= array_search('restoran', array_column($facilitations, 'fas_type')) == 0 ? 'active' : '' ?>" data-tab="<?= $facilitations[array_search('restoran', array_column($facilitations, 'fas_type'))]['fas_type'] ?>">
							<i class="flaticon-restaurant icon"></i>
							<span><?= $facilitations[array_search('restoran', array_column($facilitations, 'fas_type'))]['fas_name'] ?></span>
						</a>
					<?php endif?>
					<?php if (in_array('bar', array_column($facilitations, 'fas_type'))):?>
						<a href="#" class="<?= array_search('bar', array_column($facilitations, 'fas_type')) == 0 ? 'active' : '' ?>" data-tab="<?= $facilitations[array_search('bar', array_column($facilitations, 'fas_type'))]['fas_type'] ?>">
							<i class="flaticon-cup icon"></i>
							<span><?= $facilitations[array_search('bar', array_column($facilitations, 'fas_type'))]['fas_name'] ?></span>
						</a>
					<?php endif?>
					<?php if (in_array('pickup', array_column($facilitations, 'fas_type'))):?>
						<a href="#" class="<?= array_search('pickup', array_column($facilitations, 'fas_type')) == 0 ? 'active' : '' ?>" data-tab="<?= $facilitations[array_search('pickup', array_column($facilitations, 'fas_type'))]['fas_type'] ?>">
							<i class="flaticon-car icon"></i>
							<span><?= $facilitations[array_search('pickup', array_column($facilitations, 'fas_type'))]['fas_name'] ?></span>
						</a>
					<?php endif?>
					<?php if (in_array('swimming', array_column($facilitations, 'fas_type'))):?>
						<a href="#" class="<?= array_search('swimming', array_column($facilitations, 'fas_type')) == 0 ? 'active' : '' ?>" data-tab="<?= $facilitations[array_search('swimming', array_column($facilitations, 'fas_type'))]['fas_type'] ?>">
							<i class="flaticon-swimming icon"></i>
							<span><?= $facilitations[array_search('swimming', array_column($facilitations, 'fas_type'))]['fas_name'] ?></span>
						</a>
					<?php endif?>
					<?php if (in_array('spa', array_column($facilitations, 'fas_type'))):?>
						<a href="#" class="<?= array_search('spa', array_column($facilitations, 'fas_type')) == 0 ? 'active' : '' ?>" data-tab="<?= $facilitations[array_search('spa', array_column($facilitations, 'fas_type'))]['fas_type'] ?>">
							<i class="flaticon-massage icon"></i>
							<span><?= $facilitations[array_search('spa', array_column($facilitations, 'fas_type'))]['fas_name'] ?></span>
						</a>
					<?php endif?>
					<?php if (in_array('gym', array_column($facilitations, 'fas_type'))):?>
						<a href="#" class="<?= array_search('gym', array_column($facilitations, 'fas_type')) == 0 ? 'active' : '' ?>" data-tab="<?= $facilitations[array_search('gym', array_column($facilitations, 'fas_type'))]['fas_type'] ?>">
							<i class="flaticon-bicycle icon"></i>
							<span><?= $facilitations[array_search('gym', array_column($facilitations, 'fas_type'))]['fas_name'] ?></span>
						</a>
					<?php endif?>
				</nav>
				<div class="tab-content-container">
					<?php foreach ($facilitations as $f) :?>
						<div class="tab-content<?= array_search($f['fas_type'], array_column($facilitations, 'fas_type')) == 0 ? ' active show' : '' ?>" data-tab-content="<?= $f['fas_type'] ?>">
							<div class="container">
								<div class="row">
									<div class="col-md-6">
										<img src="<?= base_url('assets/img/facilitations/'.$f['fas_photo']) ?>" class="img-responsive" alt="Image">
									</div>
									<div class="col-md-6">
										<span class="super-heading-sm"><?= $f['fas_class'] ?></span>
										<h3 class="heading"><?= $f['fas_name'] ?></h3>
										<p><?= $f['fas_description'] ?></p>
										<p class="service-hour">
											<span>Jam Layanan</span>
											<strong><?= $f['fas_hour'] ?></strong>
										</p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach?>
				</div>
			</div>
		</div>
	</div>