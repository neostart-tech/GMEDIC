@extends('base', [
	    'breadcrumbs' => [['name' => 'Administration', 'url' => null], ['name' => 'Utilisateurs', 'url' => null], ['name' => 'Liste des utilisateurs', 'url' => null]],
    'head_title' => 'Liste des utilisateurs',
    'page_title' => 'Liste des utilisateurs',
])
@php($text = 'Voulez-vous retirer cet utilisateur')
@section('content')
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header text-end">
				<button class="btn btn-primary"
								data-bs-toggle="modal" data-bs-target="#form-modal"
				>
					<i class="fas fa-plus"></i> Ajouter un utilisateur
				</button>
			</div>
			<div class="card-body">
				<div class="dt-responsive table-responsive">
					<table id="dom-jquery" class="table table-striped table-hover table-bordered">
						<thead>
						<tr>
							<th>#</th>
							<th>Nom & Prénom</th>
							<th>Email</th>
							<th>Rôle</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($users as $key => $user)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $user->name }} </td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->role->label }}</td>
								<td>
									<div class="list-group-item d-flex justify-content-between align-items-center me-3">
										<a href="#"
											 onclick="displayUpdateModal({{ $user->toJson() }}, '{{ route('admin.users.update', $user) }}')"
											 data-bs-toggle="modal" data-bs-target="#form-modal">
											<i class="ti ti-edit f-24"></i>
										</a>
										<a onclick="deleteRessource('{{ route('admin.users.delete', $user) }}', '{{ $text }}')"
											 class="text-danger avtar avtar-xs btn-link-danger btn-pc-default">
											<i class="ti ti-trash f-24"></i>
										</a>
									</div>
								</td>
							</tr>
						@endforeach

						</tbody>
						<tfoot>
						<tr>
							<th>#</th>
							<th>Nom & Prénom</th>
							<th>Email</th>
							<th>Rôle</th>
							<th>Actions</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include('admin.users._form')
@endsection

@section('other-css')
	<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endsection

@section('other-js')
	@include('layouts._dt-scripts')

	<script>
		let form = document.getElementById('form');
		let cardTitle = document.getElementById('card-title');

		function displayUpdateModal(user, url) {
			document.getElementById('name').value = user.name;
			document.getElementById('email').value = user.email;
			document.getElementById('role_id').value = user.role_id;
			form.setAttribute('action', url);
			createMethodField();
		}

		function refreshForm() {
			removeMethodField();
			form.setAttribute('action', '{{ route('admin.users.store') }}');
			cardTitle.innerText = 'Ajouter un utilisateur';
			document.getElementById('name').value = null;
			document.getElementById('email').value = null;
			document.getElementById('role_id').value = 2;
		}

		function removeMethodField() {
			let element = document.getElementsByName('_method')[0];
			element && element.remove();
		}

		$('#form-modal').on('hidden.bs.modal', () => refreshForm());

		function createMethodField() {
			const method = '{{ method_field('PUT') }}';
			form.insertAdjacentHTML('afterbegin', method);
		}
	</script>
@endsection