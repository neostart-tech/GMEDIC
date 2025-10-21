<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
	document.querySelectorAll('[data-trigger]').forEach(element => {
		new Choices(element, {
			placeholderValue: 'This is a placeholder set in the config',
			searchPlaceholderValue: 'Saisissez pour chercher dans la liste',
			itemSelectText: 'Cliquer pour choisir',
			placeHolder: false,
		});
	});
	// Insérer les initiaux de l'utilisateur connecté
	'{{ auth()->user()->name }}'.split(' ').forEach(part => document.getElementById('name-location').innerText += part.charAt(0).toUpperCase())
</script>

@include('layouts._delete-script')

<script>layout_change('light');</script>
<script>layout_theme_contrast_change('true');</script>
<script>change_box_container('false');</script>
<script>layout_caption_change('true');</script>
<script>layout_rtl_change('false');</script>
<script>preset_change("preset-9");</script>

@yield('other-js')
