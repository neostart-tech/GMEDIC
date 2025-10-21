<script>
	const notification = new Notyf({
		position: {
			x: 'right',
			y: 'top'
		}
	});

	function published(table, slug) {
		$.post("{{ route('admin.toggle-visibility') }}", {
			table: table,
			slug: slug,
			_method: 'PATCH',
			_token: document.getElementsByName('_token')[0].value
		}).then(response => {
			notification.success('Visibilité mise à jour avec succès');
			document.getElementById(`show-${slug}`).setAttribute('class', response.new_class);
		}).catch(() => notification.error('Désolé, une erreur est survenue lors du traitement'));
	}
</script>