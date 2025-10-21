<script>
	function deleteRessource(url, text) {
		Swal.fire({
			title: text,
			text: "Cette action sera irreversible!",
			icon: 'warning',
			showCancelButton: true,
			cancelButtonColor: '#dc2626',
			cancelButtonText: 'Annuler',
			confirmButtonText: 'Oui, supprimer'
		}).then(result => {
			if (!result.isConfirmed) {
				return;
			}
			let deleteForm = document.getElementById('delete-form');
			deleteForm.setAttribute('action', url);
			deleteForm.submit();
		})
	}
</script>