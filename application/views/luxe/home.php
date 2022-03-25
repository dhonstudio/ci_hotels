	
		
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
				<!-- <li style="background-image: url(<?= base_url('assets/vendor/luxe/') ?>images/slider2.jpg);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="col-md-12 col-md-offset-0 text-center slider-text">
							<div class="slider-text-inner js-fullheight">
								<div class="desc">
									<p><span>Deluxe Hotel</span></p>
									<h2>Make Your Vacation Comfortable</h2>
									<p>
										<a href="#availability" class="btn btn-primary btn-lg">Reservasi Sekarang</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li style="background-image: url(<?= base_url('assets/vendor/luxe/') ?>images/slider3.jpg);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="col-md-12 col-md-offset-0 text-center slider-text">
							<div class="slider-text-inner js-fullheight">
								<div class="desc">
									<p><span>Luxe Hotel</span></p>
									<h2>A Best Place To Enjoy Your Life</h2>
									<p>
										<a href="#availability" class="btn btn-primary btn-lg">Reservasi Sekarang</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>		   	 -->
		  	</ul>
	  	</div>
	</aside>
	<div class="wrap">
		<div class="container">
			<div class="row">
				<div id="availability">
					<form action="#">

						<div class="a-col">
							<section>
								<select class="cs-select cs-skin-border" id="room_type">
									<option value="" disabled selected>Pilih Tipe Kamar</option>
									<option value="email">Tipe A</option>
									<option value="twitter">Tipe B</option>
									<option value="linkedin">Tipe C</option>
								</select>
							</section>
						</div>
						<div class="a-col alternate">
							<div class="input-field">
								<label for="date-start">Check In</label>
								<input type="text" class="form-control" id="date-start" />
							</div>
						</div>
						<div class="a-col alternate">
							<div class="input-field">
								<label for="date-end">Check Out</label>
								<input type="text" class="form-control" id="date-end" />
							</div>
						</div>
						<div class="a-col action">
							<a href="#">
								<span>Cek</span>
								Ketersediaan
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- <div id="fh5co-counter-section" class="fh5co-counters">
		<div class="container">
			<div class="row">
				<div class="col-md-3 text-center">
					<span class="fh5co-counter js-counter" data-from="0" data-to="20356" data-speed="5000" data-refresh-interval="50"></span>
					<span class="fh5co-counter-label">User Access</span>
				</div>
				<div class="col-md-3 text-center">
					<span class="fh5co-counter js-counter" data-from="0" data-to="15501" data-speed="5000" data-refresh-interval="50"></span>
					<span class="fh5co-counter-label">Hotels</span>
				</div>
				<div class="col-md-3 text-center">
					<span class="fh5co-counter js-counter" data-from="0" data-to="8200" data-speed="5000" data-refresh-interval="50"></span>
					<span class="fh5co-counter-label">Transactions</span>
				</div>
				<div class="col-md-3 text-center">
					<span class="fh5co-counter js-counter" data-from="0" data-to="8763" data-speed="5000" data-refresh-interval="50"></span>
					<span class="fh5co-counter-label">Rating &amp; Review</span>
				</div>
			</div>
		</div>
	</div> -->

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
					<a href="#" class="active" data-tab="tab1">
						<i class="flaticon-restaurant icon"></i>
						<span>Restoran</span>
					</a>
					<a href="#" data-tab="tab2">
						<i class="flaticon-cup icon"></i>
						<span>Bar</span>
					</a>
					<a href="#" data-tab="tab3">
					
						<i class="flaticon-car icon"></i>
						<span>Pick-up</span>
					</a>
					<a href="#" data-tab="tab4">
						
						<i class="flaticon-swimming icon"></i>
						<span>Swimming Pool</span>
					</a>
					<a href="#" data-tab="tab5">
						
						<i class="flaticon-massage icon"></i>
						<span>Spa</span>
					</a>
					<a href="#" data-tab="tab6">
						
						<i class="flaticon-bicycle icon"></i>
						<span>Gym</span>
					</a>
				</nav>
				<div class="tab-content-container">
					<div class="tab-content active show" data-tab-content="tab1">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<img src="<?= base_url('assets/vendor/luxe/') ?>images/tab_img_1.jpg" class="img-responsive" alt="Image">
								</div>
								<div class="col-md-6">
									<span class="super-heading-sm">Hotel</span>
									<h3 class="heading">Restoran</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias officia perferendis modi impedit, rem quasi veritatis. Consectetur obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia, labore, reprehenderit illum dolorem quae facilis reiciendis quas similique totam sequi ducimus temporibus ex nemo, omnis perferendis earum fugit impedit molestias animi vitae.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam neque blanditiis eveniet nesciunt, beatae similique doloribus, ex impedit rem officiis placeat dignissimos molestias temporibus, in! Minima quod, consequatur neque aliquam.</p>
									<p class="service-hour">
										<span>Service Hours</span>
										<strong>7:30 AM - 8:00 PM</strong>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content" data-tab-content="tab2">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<img src="<?= base_url('assets/vendor/luxe/') ?>images/tab_img_2.jpg" class="img-responsive" alt="Image">
								</div>
								<div class="col-md-6">
									<span class="super-heading-sm">World Class</span>
									<h3 class="heading">Bars</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias officia perferendis modi impedit, rem quasi veritatis. Consectetur obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia, labore, reprehenderit illum dolorem quae facilis reiciendis quas similique totam sequi ducimus temporibus ex nemo, omnis perferendis earum fugit impedit molestias animi vitae.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam neque blanditiis eveniet nesciunt, beatae similique doloribus, ex impedit rem officiis placeat dignissimos molestias temporibus, in! Minima quod, consequatur neque aliquam.</p>
									<p class="service-hour">
										<span>Service Hours</span>
										<strong>7:30 AM - 8:00 PM</strong>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content" data-tab-content="tab3">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<img src="<?= base_url('assets/vendor/luxe/') ?>images/tab_img_3.jpg" class="img-responsive" alt="Image">
								</div>
								<div class="col-md-6">
									<span class="super-heading-sm">World Class</span>
									<h3 class="heading">Pick Up</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias officia perferendis modi impedit, rem quasi veritatis. Consectetur obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia, labore, reprehenderit illum dolorem quae facilis reiciendis quas similique totam sequi ducimus temporibus ex nemo, omnis perferendis earum fugit impedit molestias animi vitae.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam neque blanditiis eveniet nesciunt, beatae similique doloribus, ex impedit rem officiis placeat dignissimos molestias temporibus, in! Minima quod, consequatur neque aliquam.</p>
									<p class="service-hour">
										<span>Service Hours</span>
										<strong>7:30 AM - 8:00 PM</strong>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content" data-tab-content="tab4">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<img src="<?= base_url('assets/vendor/luxe/') ?>images/tab_img_4.jpg" class="img-responsive" alt="Image">
								</div>
								<div class="col-md-6">
									<span class="super-heading-sm">World Class</span>
									<h3 class="heading">Swimming Pool</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias officia perferendis modi impedit, rem quasi veritatis. Consectetur obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia, labore, reprehenderit illum dolorem quae facilis reiciendis quas similique totam sequi ducimus temporibus ex nemo, omnis perferendis earum fugit impedit molestias animi vitae.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam neque blanditiis eveniet nesciunt, beatae similique doloribus, ex impedit rem officiis placeat dignissimos molestias temporibus, in! Minima quod, consequatur neque aliquam.</p>
									<p class="service-hour">
										<span>Service Hours</span>
										<strong>7:30 AM - 8:00 PM</strong>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content" data-tab-content="tab5">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<img src="<?= base_url('assets/vendor/luxe/') ?>images/tab_img_5.jpg" class="img-responsive" alt="Image">
								</div>
								<div class="col-md-6">
									<span class="super-heading-sm">World Class</span>
									<h3 class="heading">Spa</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias officia perferendis modi impedit, rem quasi veritatis. Consectetur obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia, labore, reprehenderit illum dolorem quae facilis reiciendis quas similique totam sequi ducimus temporibus ex nemo, omnis perferendis earum fugit impedit molestias animi vitae.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam neque blanditiis eveniet nesciunt, beatae similique doloribus, ex impedit rem officiis placeat dignissimos molestias temporibus, in! Minima quod, consequatur neque aliquam.</p>
									<p class="service-hour">
										<span>Service Hours</span>
										<strong>7:30 AM - 8:00 PM</strong>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content" data-tab-content="tab6">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<img src="<?= base_url('assets/vendor/luxe/') ?>images/tab_img_6.jpg" class="img-responsive" alt="Image">
								</div>
								<div class="col-md-6">
									<span class="super-heading-sm">World Class</span>
									<h3 class="heading">Gym</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias officia perferendis modi impedit, rem quasi veritatis. Consectetur obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia, labore, reprehenderit illum dolorem quae facilis reiciendis quas similique totam sequi ducimus temporibus ex nemo, omnis perferendis earum fugit impedit molestias animi vitae.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam neque blanditiis eveniet nesciunt, beatae similique doloribus, ex impedit rem officiis placeat dignissimos molestias temporibus, in! Minima quod, consequatur neque aliquam.</p>
									<p class="service-hour">
										<span>Service Hours</span>
										<strong>7:30 AM - 8:00 PM</strong>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div id="testimonial">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<h2>Happy Customer Says...</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="testimony">
						<blockquote>
							&ldquo;If you’re looking for a top quality hotel look no further. We were upgraded free of charge to the Premium Suite, thanks so much&rdquo;
						</blockquote>
						<p class="author"><cite>John Doe</cite></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimony">
						<blockquote>
							&ldquo;Me and my wife had a delightful weekend get away here, the staff were so friendly and attentive. Highly Recommended&rdquo;
						</blockquote>
						<p class="author"><cite>Rob Smith</cite></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimony">
						<blockquote>
							&ldquo;If you’re looking for a top quality hotel look no further. We were upgraded free of charge to the Premium Suite, thanks so much&rdquo;
						</blockquote>
						<p class="author"><cite>Jane Doe</cite></p>
					</div>
				</div>
			</div>
		</div>
	</div> -->


	<!-- <div id="fh5co-blog-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<h2>Our Blog</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="blog-grid" style="background-image: url(<?= base_url('assets/vendor/luxe/') ?>images/image-1.jpg);">
						<div class="date text-center">
							<span>09</span>
							<small>Aug</small>
						</div>
					</div>
					<div class="desc">
						<h3><a href="#">Most Expensive Hotel</a></h3>
					</div>
				</div>
				<div class="col-md-4">
					<div class="blog-grid" style="background-image: url(<?= base_url('assets/vendor/luxe/') ?>images/image-2.jpg);">
						<div class="date text-center">
							<span>09</span>
							<small>Aug</small>
						</div>
					</div>
					<div class="desc">
						<h3><a href="#">1st Anniversary of Luxe Hotel</a></h3>
					</div>
				</div>
				<div class="col-md-4">
					<div class="blog-grid" style="background-image: url(<?= base_url('assets/vendor/luxe/') ?>images/image-3.jpg);">
						<div class="date text-center">
							<span>09</span>
							<small>Aug</small>
						</div>
					</div>
					<div class="desc">
						<h3><a href="#">Discover New Adventure</a></h3>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<footer id="footer" class="fh5co-bg-color">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="copyright">
						<p><small>&copy; 2022 Free HTML5 Template. All Rights Reserved. <br>
						Designed by <a href="http://freehtml5.co" target="_blank">FreeHTML5.co</a></p>
					</div>
				</div>
				<!-- <div class="col-md-6">
					<div class="row">
						<div class="col-md-3">
							<h3>Company</h3>
							<ul class="link">
								<li><a href="#">About Us</a></li>
								<li><a href="#">Hotels</a></li>
								<li><a href="#">Customer Care</a></li>
								<li><a href="#">Contact Us</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<h3>Our Facilities</h3>
							<ul class="link">
								<li><a href="#">Resturant</a></li>
								<li><a href="#">Bars</a></li>
								<li><a href="#">Pick-up</a></li>
								<li><a href="#">Swimming Pool</a></li>
								<li><a href="#">Spa</a></li>
								<li><a href="#">Gym</a></li>
							</ul>
						</div>
						<div class="col-md-6">
							<h3>Subscribe</h3>
							<p> </p>
							<form action="#" id="form-subscribe">
								<div class="form-field">
									<input type="email" placeholder="Email Address" id="email">
									<input type="submit" id="submit" value="Send">
								</div>
							</form>
						</div>
					</div>
				</div> -->
				<div class="col-md-6">
					<ul class="social-icons">
						<li>
							<a href="https://twitter.com/" target="_blank"><i class="icon-twitter-with-circle"></i></a>
							<a href="https://facebook.com/" target="_blank"><i class="icon-facebook-with-circle"></i></a>
							<a href="https://instagram.com/" target="_blank"><i class="icon-instagram-with-circle"></i></a>
							<a href="https://linkedin.com/" target="_blank"><i class="icon-linkedin-with-circle"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->
	
	<!-- Javascripts -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/jquery-2.1.4.min.js"></script>
	<!-- Dropdown Menu -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/hoverIntent.js"></script>
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/superfish.js"></script>
	<!-- Bootstrap -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/jquery.waypoints.min.js"></script>
	<!-- Counters -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/jquery.countTo.js"></script>
	<!-- Stellar Parallax -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/jquery.stellar.min.js"></script>
	<!-- Owl Slider -->
	<!-- // <script src="js/owl.carousel.min.js"></script> -->
	<!-- Date Picker -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/classie.js"></script>
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/selectFx.js"></script>
	<!-- Flexslider -->
	<script src="<?= base_url('assets/vendor/luxe/') ?>js/jquery.flexslider-min.js"></script>

	<script src="<?= base_url('assets/vendor/luxe/') ?>js/custom.js"></script>

</body>
</html>