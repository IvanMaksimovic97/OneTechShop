<!-- Single Product -->
<?php if(is_object($proizvod)):?>
<div class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
						<!-- <li data-image="app/assets/images/single_4.jpg"><img src="app/assets/images/single_4.jpg" alt=""></li>
						<li data-image="app/assets/images/single_2.jpg"><img src="app/assets/images/single_2.jpg" alt=""></li>
						<li data-image="app/assets/images/single_3.jpg"><img src="app/assets/images/single_3.jpg" alt=""></li>
						<li data-image="app/assets/images/single_4.jpg"><img src="app/assets/images/single_4.jpg" alt=""></li>
						<li data-image="app/assets/images/single_2.jpg"><img src="app/assets/images/single_2.jpg" alt=""></li>
						<li data-image="app/assets/images/single_3.jpg"><img src="app/assets/images/single_3.jpg" alt=""></li>
						<li data-image="app/assets/images/single_4.jpg"><img src="app/assets/images/single_4.jpg" alt=""></li>
						<li data-image="app/assets/images/single_2.jpg"><img src="app/assets/images/single_2.jpg" alt=""></li>
						<li data-image="app/assets/images/single_3.jpg"><img src="app/assets/images/single_3.jpg" alt=""></li> -->
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="<?=$base_url?>/app/assets/images/<?=$proizvod->path_big?>" alt="<?=$proizvod->alt?>"></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category"><?=$proizvod->cat_name?></div>
						<div class="product_name"><?=$proizvod->brand_name." ".$proizvod->name?></div>
						<div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
						<div class="product_text"><p><?=$proizvod->description?></p></div>
						<div class="product_price">In stock: <?=$proizvod->in_stock?></div>
						<div class="order_info d-flex flex-row">
							<form action="#">
								<div class="clearfix" style="z-index: 1000;">

									<!-- Product Quantity -->
									<div class="product_quantity clearfix">
										<span>Quantity: </span>
										<input id="quantity_input" type="text" pattern="[0-9]*" value="1">
										<div class="quantity_buttons">
											<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>

									<!-- Product Color -->
									<ul class="product_color">
										<li>
											<span>Color: </span>
											<div class="color_mark_container"><div id="selected_color" data-id="" class="color_mark"></div></div>
											<div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

											<ul class="color_list">
												<?php foreach ($proizvod->colors as $color):?>
													<li><div class="color_mark" data-id="<?=$color->id?>" style="background: <?=$color->code?>;"></div></li>
												<?php endforeach?>
											</ul>
										</li>
									</ul>

								</div>

								<div class="product_price">$<?=$proizvod->price?></div>
								<div class="button_container">
									<input type="hidden" id="p_id" value="<?=$proizvod->id?>">
									<button type="button" class="button cart_button" id="sendToCart">Add to Cart</button>
									<div class="product_fav"><i class="fas fa-heart"></i></div>
								</div>
								
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<?php else:?>
	<h2 style="margin: 50px auto;">Product not found</h2>
	<?php endif?>