<!-- Footer -->

<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">OneTech</a></div>
						</div>
						<div class="footer_title">Got Question? Call Us 24/7</div>
						<div class="footer_phone">+38 068 005 3570</div>
						<div class="footer_contact_text">
							<p>17 Princess Road, London</p>
							<p>Grester London NW18JR, UK</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-youtube"></i></a></li>
								<li><a href="#"><i class="fab fa-google"></i></a></li>
								<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<div class="footer_title">Find it Fast</div>
						<ul class="footer_list">
							<li><a href="#">Computers & Laptops</a></li>
							<li><a href="#">Cameras & Photos</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Smartphones & Tablets</a></li>
							<li><a href="#">TV & Audio</a></li>
						</ul>
						<div class="footer_subtitle">Gadgets</div>
						<ul class="footer_list">
							<li><a href="#">Car Electronics</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<ul class="footer_list footer_list_2">
							<li><a href="#">Video Games & Consoles</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Cameras & Photos</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Computers & Laptops</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Customer Services</a></li>
							<li><a href="#">Returns / Exchange</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Product Support</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="<?=$base_url?>/app/assets/images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="<?=$base_url?>/app/assets/images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="<?=$base_url?>/app/assets/images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="<?=$base_url?>/app/assets/images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?=$base_url?>/app/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=$base_url?>/app/assets/styles/bootstrap4/popper.js"></script>
<script src="<?=$base_url?>/app/assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?=$base_url?>/app/assets/plugins/greensock/TweenMax.min.js"></script>
<script src="<?=$base_url?>/app/assets/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?=$base_url?>/app/assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?=$base_url?>/app/assets/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?=$base_url?>/app/assets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?=$base_url?>/app/assets/plugins/easing/easing.js"></script>


    <script src="<?=$base_url?>/app/assets/js/product_custom.js"></script>

    <script src="<?=$base_url?>/app/assets/js/contact_custom.js"></script>

    <script src="<?=$base_url?>/app/assets/js/cart_custom.js"></script>

    <script src="<?=$base_url?>/app/assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="<?=$base_url?>/app/assets/plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="<?=$base_url?>/app/assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="<?=$base_url?>/app/assets/plugins/parallax-js-master/parallax.min.js"></script>
	<span id="jss"><script src="<?=$base_url?>/app/assets/js/shop_custom.js"></script></span>
	<script src="<?=$base_url?>/app/assets/js/moj_js/shop.js"></script>
	<script src="<?=$base_url?>/app/assets/js/moj_js/register.js"></script>
	<?php if(isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin"):?>
		<script src="<?=$base_url?>/app/assets/js/moj_js/admin.js"></script>
	<?php endif?>
	<?php if(isset($_SESSION['user'])):?>
	<script src="<?=$base_url?>/app/assets/js/moj_js/cart.js"></script>
	<?php else:?>
		<script>
		$('#sendToCart').on('click', function() {alert("You must be logged in");});
		</script>
	<?php endif?>
</body>
</html>