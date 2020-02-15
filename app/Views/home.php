<!-- Home -->

<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?=$base_url?>/app/assets/images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Shop Home</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
							<?php foreach ($categories as $cat): ?>
								<li><label class="custom-control custom-checkbox">
								<input type="checkbox" name="chb_categories" class="custom-control-input filters" value="<?=$cat->id?>">
								<span class="custom-control-indicator"></span>
								<span class="custom-control-description" style="padding-top:3px;color:rgba(0,0,0,0.5);"><?=$cat->name?></span>
								</label>
								</li>
                            <?php endforeach ?>
							</ul>
						</div>
						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="container">
								<div class="row">
									<div class="col-sm" style="padding-left:0px;">
										<input type="number" min="0" id="p_from" class="form-control cena" placeholder="From..">
									</div>
									<div class="col-sm">
										<input type="number" min="0" id="p_to" class="form-control cena" placeholder="To..">
									</div>
								</div>
							</div>
							<!-- <div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div> -->
						</div>
						<div class="sidebar_section">
							
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Brands</div>
							<ul class="brands_list">
								<?php foreach ($brands as $brand): ?>
									<li><label class="custom-control custom-checkbox">
								<input type="checkbox" name="chb_brands" class="custom-control-input filters" value="<?=$brand->id?>">
								<span class="custom-control-indicator"></span>
								<span class="custom-control-description" style="padding-top:3px;color:rgba(0,0,0,0.5);"><?=$brand->name?></span>
								</label>
								</li>
                                <?php endforeach ?>
							</ul>
						</div>
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span><?=count($products)?></span> products found</div>
							<div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">Latest<i class="fas fa-chevron-down"></i></span>
										<ul>
											<li class="shop_sorting_button sortby">Latest</li>
											<li class="shop_sorting_button sortby">Highest Price</li>
											<li class="shop_sorting_button sortby">Lowest Price</li>
											<li class="shop_sorting_button sortby">Name</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>

						<div class="container">
							<div class="row" id="products">
							
							<?php foreach ($products as $product):?>
								<div class="product_item">
									<div class="product_border"></div>
									<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="<?=$base_url?>/app/assets/images/<?=$product->path_small?>" alt="<?=$product->alt?>"></div>
									<div class="product_content">
										<div class="product_price">$<?=$product->price?></div>
										<div class="product_name"><div><a href="<?=$base_url?>/product/<?=$product->id?>" tabindex="0"><?=$product->brand_name." ".$product->name?></a></div></div>
									</div>
									<div class="product_fav"><i class="fas fa-heart"></i></div>
									<ul class="product_marks">
										<li class="product_mark product_discount">-25%</li>
										<li class="product_mark product_new">new</li>
									</ul>
								</div>
							<?php endforeach?>
							
							<!-- Product Item -->
							
							</div>
						</div>

						<!-- Shop Page Navigation -->

						<!-- <div class="shop_page_nav d-flex flex-row">
							<div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
							<ul class="page_nav d-flex flex-row">
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">...</a></li>
								<li><a href="#">21</a></li>
							</ul>
							<div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
						</div> -->

					</div>

				</div>
			</div>
		</div>
	</div>

    <!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">
						
						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">
							
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?=$base_url?>/app/assets/images/brands_1.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?=$base_url?>/app/assets/images/brands_2.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?=$base_url?>/app/assets/images/brands_3.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?=$base_url?>/app/assets/images/brands_4.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?=$base_url?>/app/assets/images/brands_5.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?=$base_url?>/app/assets/images/brands_6.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?=$base_url?>/app/assets/images/brands_7.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?=$base_url?>/app/assets/images/brands_8.jpg" alt=""></div></div>

						</div>
						
						<!-- Brands Slider Navigation -->
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

					</div>
				</div>
			</div>
		</div>
	</div>