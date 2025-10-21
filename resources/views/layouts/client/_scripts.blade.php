<!-- jQery -->
<script src="{{ asset('assets/client/js/jquery-3.4.1.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('assets/client/js/bootstrap.js') }}"></script>
<!-- nice select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
				integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- custom js -->
<script src="{{ asset('assets/client/js/custom.js') }}"></script>
@yield('js')
<script>
	document.querySelectorAll('.nav-link').forEach(link => link.href === document.location.href && link.parentElement.classList.add('active-link'))

	document.querySelectorAll('.contact-link').forEach(link => link.href === document.location.href && link.classList.add('active'))
</script>