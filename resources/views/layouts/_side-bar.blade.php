@php use App\Models\Message; @endphp
<nav class="pc-sidebar">
	<div class="navbar-wrapper">
		<div class="m-header">
			<a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
				<img src="{{ asset('assets/images/logos/gmedic_logo.png') }}" class="img-fluid mt-1" alt="logo"
				>
			</a>
		</div>
		<div class="navbar-content">
			<div class="card pc-user-card">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="flex-shrink-0">
							<span class="avtar bg-success text-white" id="name-location">
							</span>
						</div>
						<div class="flex-grow-1 ms-3 me-2">
							<h6 class="mb-0">{{ Auth::user()->name }}</h6>
						</div>
						<a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
							 href="#pc_sidebar_userlink">
							<svg class="pc-icon">
								<use xlink:href="#custom-sort-outline"></use>
							</svg>
						</a>
					</div>
					<div class="collapse pc-user-links" id="pc_sidebar_userlink">
						<div class="pt-3">
							<a href="#" onclick="document.getElementById('logout-form').submit()">
								<i class="ti ti-power"></i>
								<span>Déconnexion</span>
								<form id="logout-form" method="POST" action="{{ route('logout') }}" hidden>
									@csrf
								</form>
							</a>
						</div>
					</div>
				</div>
			</div>

			<ul class="pc-navbar">

				{{--Dashboard --}}
				<li class="pc-item">
					<a href="{{ route('admin.dashboard') }}" class="pc-link">
						<span class="pc-micon">
								<svg class="pc-icon">
									<use xlink:href="#custom-status-up"></use>
								</svg>
						</span>
						<span class="pc-mtext">Dashboard</span>
					</a>
				</li>

				{{--Catégories d'articles --}}
				<li class="pc-item">
					<a href="{{ route('admin.categories.index') }}" class="pc-link">
						<span class="pc-micon">
								<i class="ph-duotone ph-stack"></i>
						</span>
						<span class="pc-mtext">Catégories d'articles</span>
					</a>
				</li>

				{{-- Articles --}}
				<li class="pc-item pc-hasmenu">
					<a href="#" class="pc-link">
						<span class="pc-micon">
								<svg class="pc-icon">
										<use xlink:href="#custom-shopping-bag"></use>
								</svg>
						</span>
						<span class="pc-mtext">Articles</span>
						<span class="pc-arrow"><i data-feather="chevron-right"></i></span>
					</a>
					<ul class="pc-submenu">
						<li class="pc-item"><a class="pc-link" href="{{ route('admin.articles.index') }}">Liste des articles</a>
						</li>
						<li class="pc-item"><a class="pc-link" href="{{ route('admin.articles.create') }}">Nouvel article</a></li>
					</ul>
				</li>

				{{-- Blogs	--}}
				<li class="pc-item pc-hasmenu">
					<a href="#" class="pc-link">
						<span class="pc-micon">
							<i class="ti ti-blockquote "></i>
						</span>
						<span class="pc-mtext">Blogs</span>
						<span class="pc-arrow"><i data-feather="chevron-right"></i></span>
					</a>
					<ul class="pc-submenu">
						<li class="pc-item"><a class="pc-link" href="{{ route('admin.blogs.index') }}">Liste des blogs</a></li>
						<li class="pc-item"><a class="pc-link" href="{{ route('admin.blogs.create') }}">Créer un blog</a></li>
					</ul>
				</li>

				{{-- Sliders	--}}
				<li class="pc-item">
					<a href="{{ route('admin.sliders.index') }}" class="pc-link">
						<span class="pc-micon">
							<i class="ti ti-slideshow"></i>
						</span>
						<span class="pc-mtext">Sliders</span>
					</a>
				</li>

				{{-- Messages	--}}
				<li class="pc-item">
					<a href="{{ route('admin.messages.index') }}" class="pc-link">
						<span class="pc-micon">
							<i class="fab fa-rocketchat"></i>
						</span>
						<span class="pc-mtext">Messages</span>
						<span class="pc-badge" name="notifications-count">{{ Message::query()->where('read', false)->count() }}</span>
					</a>
				</li>

				{{-- Utilisateurs --}}
				@if(auth()->user()->role_id === 1)
					<li class="pc-item">
						<a href="{{ route('admin.users.index') }}" class="pc-link">
						<span class="pc-micon">
							<i class="fa fa-user-friends"></i>
						</span>
							<span class="pc-mtext">Utilisateurs</span>
						</a>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>
