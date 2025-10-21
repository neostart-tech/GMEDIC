@extends('client.base', [
	'title' => 'Nous contacter'
])
@section('content')

	@if(session()->has('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Super!</strong> {{ session()->pull('success') }}
		</div>
	@endif

	<section class="contact_section layout_padding-bottom">
		<div class="container">
			<div class="heading_container mt-5">
				<h2>
					Contacter nous
				</h2>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-6">
					<div class="form_container">
						<form action="{{ route('client.contact.store') }}" method="post">
							@csrf
							<div class="form-group">
								<input type="text" class="{{ $errors->has('nom') ? 'border-danger' : '' }}" placeholder="Nom & Prénom"
											 value="{{ old('nom') }}" name="nom"/>
								@if($errors->has('nom'))
									<span class="text-danger">{{ $errors->first('nom') }}</span>
								@endif
							</div>
							<div class="form-group">
								<input type="email" class="{{ $errors->has('email') ? 'border-danger' : '' }}" placeholder="Email"
											 value="{{ old('email') }}" name="email"/>
								@if($errors->has('email'))
									<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>
							<div class="form-group">
								<input type="text" class="{{ $errors->has('telephone') ? 'border-danger' : '' }}"
											 placeholder="Numéro de téléphone" value="{{ old('telephone') }}" name="telephone"/>
								@if($errors->has('telephone'))
									<span class="text-danger">{{ $errors->first('telephone') }}</span>
								@endif
							</div>
							<div class="form-group">
								<textarea name="message" class="form-control custom-textarea {{ $errors->has('message') ? 'border-danger' : '' }}"
													cols="30" rows="10" placeholder="Votre message &hellip;">{{ old('message') }}</textarea>
								{{--								<input type="text" class="message-box {{ $errors->has('message') ? 'border-danger' : '' }}"--}}
								{{--											 placeholder="Message" value="{{ old('message') }}" name="message"/>--}}
								@if($errors->has('message'))
									<span class="text-danger">{{ $errors->first('message') }}</span>
								@endif
							</div>
							<div class="btn_box">
								<button>
									Envoyer
								</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6 col-lg-6">
					<!-- <div class="img-box"> -->
					<iframe class="contact-map"
									src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.153445822425!2d1.202521798337846!3d6.225658912842603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x102159b703e803a9%3A0x506b43843ca69eb5!2zTWFyY2jDqSBkZSBDYWNhdsOpbGk!5e0!3m2!1sfr!2stg!4v1711380294309!5m2!1sfr!2stg"
									width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
									referrerpolicy="no-referrer-when-downgrade"></iframe>
					<!-- <img src="images/contact-img.jpg" alt=""> -->
					<!-- </div> -->
				</div>
			</div>
		</div>
	</section>

@endsection

@section('css')
	.custom-textarea {
	border: 2px solid #00c6a9 !important;
	}

	.custom-textarea::placeholder {
	color: #00c6a9 !important;
	padding-left: 5px !important;
	}

@endsection