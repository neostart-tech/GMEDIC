@extends('base', [
    'breadcrumbs' => [['name' => 'Administration', 'url' => 'admin.messages.index'], ['name' => 'Message', 'url' => null], ['name' => 'Liste des messages de client', 'url' => null]],
    'head_title' => 'Liste des messages des clients',
    'page_title' => 'Liste des messages des clients',
])
@php($text = 'Voulez-vous supprimer ce message')
@section('content')
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="dt-responsive table-responsive">
					<table id="dom-jquery" class="table table-striped table-hover table-bordered">
						<thead>
						<tr>
							<th>#</th>
							<th>Nom & Prénom</th>
							<th>Téléphone</th>
							<th>Email</th>
							<th>Date de reception</th>
							<th>Lecture</th>
							<th>Message</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($messages as $key => $message)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $message->nom }} </td>
								<td>{{ $message->telephone }} </td>
								<td>{{ $message->email }}</td>
								<td class="text-capitalize">
									{{ $message->created_at->translatedFormat('d F Y - H:i') }}
								</td>
								<td>
									<i id="icon-{{ $message->id }}"
										 class='fas fa-{{ $message->read ? 'check-double text-info' : 'check text-black' }}'></i>
									<span id="element-{{ $message->id }}">{{ $message->read ? ' Lu' : ' Non lu' }}</span>
								</td>

								<td>
									<div class="list-group-item d-flex justify-content-between align-items-center me-3">
										<a href="#"
											 onclick="showMessageDetails({{ $message->toJson() }}, '{{ route('admin.messages.read', $message) }}')"
											 data-bs-toggle="modal" data-bs-target="#show-modal">
											<i class="ti ti-eye f-24"></i>
										</a>
										<a onclick="deleteRessource('{{ route('admin.messages.delete', $message) }}', '{{ $text }}')"
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
							<th>Téléphone</th>
							<th>Email</th>
							<th>Date de reception</th>
							<th>Lecture</th>
							<th>Message</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include('admin.messages._show')
@endsection

@section('other-css')
	<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endsection

@section('other-js')
	@include('layouts._dt-scripts')

	<script>
		function showMessageDetails(message, url) {
			document.getElementById('expe').value = message.nom;
			document.getElementById('tel').value = message.telephone;
			document.getElementById('mail').value = message.email;
			document.getElementById('date').value = message.date;
			document.getElementById('message').innerText = message.message;

			$.get(url).then(() => {
				document.getElementById(`icon-${message.id}`).setAttribute('class', 'fas fa-check-double text-info');
				document.getElementById(`element-${message.id}`).innerText = 'Lu';
				let elementList = document.getElementsByName('notifications-count');
				let notificationCountSpan = elementList[0];
				let count = Number(notificationCountSpan.innerText);

				if (count >= 1) {
					elementList[0].innerText = '0';
					elementList[1].innerText = '';
				}
			});
		}
	</script>
@endsection
