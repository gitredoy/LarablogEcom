<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-6 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Contact Us
                </h4>
                <p class="stext-107 cl7 hov-cl1 trans-04" style="font-size: 15px;">
                    Address: Notun bazar,Gulshan-Dhaka, &nbsp; Cell: 01928511049 , &nbsp; Email: asadullahkpi@gmail.com
                </p>
            </div>

            <div class="col-sm-6 col-lg-6 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Follow Us
                </h4>

                <ul class="social">
                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li class="youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                    <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="p-t-40">
            <p class="stext-107 cl6 txt-center">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                @FF. Designed & Developed By Popularsoft
            </p>
        </div>
    </div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
</div>


<script src="{{asset('public/frontend')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="{{asset('public/frontend')}}/vendor/animsition/js/animsition.min.js"></script>
<script src="{{asset('public/frontend')}}/vendor/bootstrap/js/popper.js"></script>
<script src="{{asset('public/frontend')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('public/frontend')}}/vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function () {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<script src="{{asset('public/frontend')}}/vendor/daterangepicker/moment.min.js"></script>
<script src="{{asset('public/frontend')}}/vendor/daterangepicker/daterangepicker.js"></script>
<script src="{{asset('public/frontend')}}/vendor/slick/slick.min.js"></script>
<script src="{{asset('public/frontend')}}/js/slick-custom.js"></script>
<script src="{{asset('public/frontend')}}/vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<script src="{{asset('public/frontend')}}/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function () { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<script src="{{asset('public/frontend')}}/vendor/isotope/isotope.pkgd.min.js"></script>
<script src="{{asset('public/frontend')}}/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.js-addwish-b2').on('click', function (e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function () {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function () {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function () {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function () {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to cart !", "success");
        });
    });

</script>
<script src="{{asset('public/frontend')}}/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function () {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function () {
            ps.update();
        })
    });
</script>
<script src="{{asset('public/frontend')}}/js/main.js"></script>

</body>
</html>

