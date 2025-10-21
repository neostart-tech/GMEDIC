@php use App\Models\Message;use Illuminate\Support\Str; @endphp
<header class="pc-header">
	<div class="header-wrapper"> <!-- [Mobile Media Block] start -->
		<div class="me-auto pc-mob-drp">
			<ul class="list-unstyled">
				<!-- ======= Menu collapse Icon ===== -->
				<li class="pc-h-item pc-sidebar-collapse">
					<a href="#" class="pc-head-link ms-0" id="sidebar-hide">
						<i class="ti ti-menu-2"></i>
					</a>
				</li>
				<li class="pc-h-item pc-sidebar-popup">
					<a href="#" class="pc-head-link ms-0" id="mobile-collapse">
						<i class="ti ti-menu-2"></i>
					</a>
				</li>

			</ul>
		</div>
		<!-- [Mobile Media Block end] -->
		<div class="ms-auto">
			<ul class="list-unstyled">
				<li class="dropdown pc-h-item">
					<a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
						 role="button" aria-haspopup="false" aria-expanded="false">
						<svg class="pc-icon">
							<use xlink:href="#custom-notification"></use>
						</svg>
						@php($notifications = Message::query()->where('read', false)->orderByDesc('created_at')->get())
						@if($notifications->isEmpty())
							<span class="badge bg-success pc-h-badge"></span>
						@else
							<span class="badge bg-success pc-h-badge" name="notifications-count">{{ $notifications->count() }}</span>
						@endif
					</a>
					<div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
						<div class="dropdown-header d-flex align-items-center justify-content-between">
							<h5 class="m-0">Notifications</h5>
							{{--							<a href="#!" class="btn btn-link btn-sm">Mark all read</a>--}}
						</div>
						<div class="dropdown-body text-wrap header-notification-scroll position-relative"
								 style="max-height: calc(100vh - 215px)">
							@if($notifications->isEmpty())
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex">
											<div class="flex-grow-1 ms-3">
												Aucun message non lu.
											</div>
										</div>
									</div>
								</div>
							@else
{{--								<p class="text-span">Yesterday</p>--}}
								@foreach($notifications as $notification)
									<div class="card mb-2">
										<div class="card-body">
											<div class="d-flex">
												<div class="flex-shrink-0">
													<svg class="pc-icon text-primary">
														<use xlink:href="#custom-sms"></use>
													</svg>
												</div>
												<div class="flex-grow-1 ms-3">
													<span class="float-end text-sm text-muted">{{ Str::ucfirst($notification->created_at->diffForHumans()) }}</span>
													<h5 class="text-body mb-2">{{ Str::limit($notification->nom, 15)}}</h5>
													<p class="mb-0">{{ Str::limit($notification->message, 72) }}</p>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<div class="text-center py-2">
							<a href="{{ route('admin.messages.index') }}" class="link-danger">Voir plus</a>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</header>
