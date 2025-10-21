<div class="modal fade" id="form-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="mb-0" id="card-title"></h5>
				<a href="#" class="avtar avtar-s btn-link-danger btn-pc-default" data-bs-dismiss="modal">
					<i class="ti ti-x f-20"></i>
				</a>
			</div>

			<div class="modal-body">
				<form action="{{ route('admin.users.store') }}" method="post" id="form">
					@csrf
					<div class="form-group">
						<label for="name" class="form-label">Nom et prénom <span class="text-danger">*</span> </label>
						<input type="text" name="name" id="name" class="form-control">
					</div>

					<div class="form-group">
						<label for="email" class="form-label">Email <span class="text-danger">*</span> </label>
						<input type="email" id="email" name="email" class="form-control">
					</div>

					<div class="form-group">
						<label for="role_id">Rôle</label>
						<select name="role_id" class="form-select" id="role_id">
							@foreach($roles as $role)
								<option value="{{ $role->id }}" @selected($user->role_id === $role->id)>{{ $role->label }}</option>
							@endforeach
						</select>
					</div>

					<button class="btn btn-primary" type="submit">Valider</button>

				</form>
			</div>
		</div>
	</div>
</div>
</div>
