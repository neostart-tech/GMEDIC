@extends('client.base', [
'title' => 'Nos catégories d\'articles - ' . env('APP_NAME')
])
@section('content')

<style>
	:root {
		--primary: #009D92;
		--primary-dark: #007a70;
		--primary-light: #00b8ab;
		--primary-soft: #b3e8e4;
		--secondary: #1A3A66;
		--secondary-dark: #13294b;
		--secondary-light: #214a8c;
		--accent: #00C6A9;
		--dark: #1e293b;
		--darker: #0f172a;
		--light: #f8fafc;
		--lighter: #ffffff;
		--text: #334155;
		--text-light: #64748b;
		--border: #e2e8f0;
		--gradient: linear-gradient(135deg, #009D92 0%, #1A3A66 100%);
		--gradient-reverse: linear-gradient(135deg, #1A3A66 0%, #009D92 100%);
		--gradient-soft: linear-gradient(135deg, #f0f9f8 0%, #f5f7fa 100%);
		--gradient-light: linear-gradient(135deg, #ffffff 0%, #f0f9f8 100%);
		--shadow: 0 10px 25px -5px rgba(0, 157, 146, 0.15);
		--shadow-lg: 0 20px 40px -10px rgba(0, 157, 146, 0.2);
		--shadow-xl: 0 30px 60px -15px rgba(0, 157, 146, 0.25);
		--transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
		--border-radius: 16px;
		--border-radius-lg: 24px;
	}

	/* Hero Section Catégories */
	.categories-hero {
		background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%);
		padding: 120px 0 80px;
		position: relative;
		overflow: hidden;
		color: white;
	}

	.categories-hero::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background:
			radial-gradient(circle at 20% 80%, rgba(0, 198, 169, 0.1) 0%, transparent 50%),
			radial-gradient(circle at 80% 20%, rgba(26, 58, 102, 0.1) 0%, transparent 50%),
			url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
	}

	.categories-hero-content {
		max-width: 1200px;
		margin: 0 auto;
		padding: 0 20px;
		position: relative;
		z-index: 2;
		text-align: center;
	}

	.categories-hero-badge {
		display: inline-flex;
		align-items: center;
		gap: 12px;
		background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
		backdrop-filter: blur(20px);
		padding: 14px 28px;
		border-radius: 50px;
		font-size: 0.95rem;
		font-weight: 600;
		margin-bottom: 25px;
		border: 1px solid rgba(255, 255, 255, 0.15);
		font-family: 'Poppins', sans-serif;
	}

	.categories-hero-title {
		font-size: 3.5rem;
		font-weight: 800;
		line-height: 1.1;
		margin-bottom: 20px;
		font-family: 'Poppins', sans-serif;
	}

	.categories-hero-title span {
		background: linear-gradient(135deg, var(--accent) 0%, var(--primary-light) 100%);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
	}

	.categories-hero-description {
		font-size: 1.25rem;
		line-height: 1.7;
		opacity: 0.9;
		max-width: 600px;
		margin: 0 auto;
	}

	/* Section Catégories */
	.categories-section {
		padding: 100px 0;
		background: var(--light);
	}

	.section-header {
		text-align: center;
		max-width: 800px;
		margin: 0 auto 60px;
	}

	.section-subtitle {
		color: var(--primary);
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 2px;
		margin-bottom: 15px;
		font-family: 'Poppins', sans-serif;
		position: relative;
		display: inline-block;
	}

	.section-subtitle::after {
		content: '';
		position: absolute;
		bottom: -6px;
		left: 50%;
		transform: translateX(-50%);
		width: 35px;
		height: 2px;
		background: var(--primary);
		border-radius: 2px;
	}

	.section-title {
		font-size: 2.8rem;
		font-weight: 700;
		color: var(--secondary);
		margin-bottom: 20px;
		font-family: 'Poppins', sans-serif;
		line-height: 1.2;
	}

	/* Stats des Catégories */
	.categories-stats {
		display: flex;
		justify-content: center;
		gap: 40px;
		margin-bottom: 40px;
		flex-wrap: wrap;
	}

	.stat-item {
		text-align: center;
		padding: 20px;
	}

	.stat-number {
		font-size: 2.5rem;
		font-weight: 700;
		color: var(--primary);
		display: block;
		line-height: 1;
	}

	.stat-label {
		font-size: 0.9rem;
		color: var(--text-light);
		margin-top: 8px;
	}

	/* Grid des Catégories */
	.categories-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
		gap: 30px;
		max-width: 1200px;
		margin: 0 auto 60px;
		padding: 0 20px;
	}

	.category-card {
		background: white;
		border-radius: var(--border-radius-lg);
		overflow: hidden;
		box-shadow: var(--shadow);
		transition: var(--transition);
		position: relative;
	}

	.category-card:hover {
		transform: translateY(-10px);
		box-shadow: var(--shadow-xl);
	}

	.category-image-container {
		position: relative;
		overflow: hidden;
		height: 250px;
	}

	.category-image {
		width: 100%;
		height: 100%;
		object-fit: cover;
		transition: var(--transition);
	}

	.category-card:hover .category-image {
		transform: scale(1.05);
	}

	.category-overlay {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: linear-gradient(135deg, rgba(0, 157, 146, 0.8) 0%, rgba(26, 58, 102, 0.8) 100%);
		opacity: 0;
		transition: var(--transition);
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.category-card:hover .category-overlay {
		opacity: 1;
	}

	.category-icon {
		width: 60px;
		height: 60px;
		background: white;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		color: var(--primary);
		font-size: 1.5rem;
		transform: translateY(20px);
		transition: var(--transition);
	}

	.category-card:hover .category-icon {
		transform: translateY(0);
	}

	.category-content {
		padding: 25px;
	}

	.category-title {
		font-size: 1.4rem;
		font-weight: 700;
		color: var(--secondary);
		margin-bottom: 15px;
		font-family: 'Poppins', sans-serif;
		line-height: 1.3;
	}

	.category-description {
		color: var(--text-light);
		line-height: 1.6;
		margin-bottom: 20px;
		font-size: 0.95rem;
	}

	.category-actions {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.category-btn {
		background: var(--gradient);
		color: white;
		padding: 12px 24px;
		border-radius: 8px;
		text-decoration: none;
		font-weight: 600;
		font-family: 'Poppins', sans-serif;
		transition: var(--transition);
		display: inline-flex;
		align-items: center;
		gap: 8px;
	}

	.category-btn:hover {
		transform: translateY(-2px);
		box-shadow: var(--shadow-lg);
		color: white;
	}

	.category-articles-count {
		background: var(--primary-soft);
		color: var(--primary-dark);
		padding: 6px 12px;
		border-radius: 20px;
		font-size: 0.85rem;
		font-weight: 600;
	}

	/* Pagination */
	.pagination-container {
		display: flex;
		justify-content: center;
		align-items: center;
		margin-top: 60px;
		padding: 0 20px;
	}

	.pagination {
		display: flex;
		align-items: center;
		gap: 10px;
		flex-wrap: wrap;
		justify-content: center;
	}

	.page-item {
		list-style: none;
	}

	.page-link {
		display: flex;
		align-items: center;
		justify-content: center;
		width: 45px;
		height: 45px;
		border: 2px solid var(--border);
		border-radius: 10px;
		color: var(--text);
		text-decoration: none;
		font-weight: 600;
		transition: var(--transition);
		font-family: 'Poppins', sans-serif;
	}

	.page-link:hover {
		border-color: var(--primary);
		color: var(--primary);
		transform: translateY(-2px);
	}

	.page-item.active .page-link {
		background: var(--gradient);
		color: white;
		border-color: var(--primary);
		transform: translateY(-2px);
		box-shadow: var(--shadow);
	}

	.page-item.disabled .page-link {
		opacity: 0.5;
		cursor: not-allowed;
		transform: none;
	}

	.page-item.disabled .page-link:hover {
		border-color: var(--border);
		color: var(--text);
		transform: none;
	}

	.pagination-info {
		text-align: center;
		color: var(--text-light);
		font-size: 0.9rem;
		margin-top: 20px;
	}

	/* État vide */
	.empty-state {
		text-align: center;
		padding: 80px 20px;
		max-width: 600px;
		margin: 0 auto;
	}

	.empty-icon {
		width: 100px;
		height: 100px;
		background: var(--primary-soft);
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 30px;
		color: var(--primary);
		font-size: 2.5rem;
	}

	.empty-title {
		font-size: 2rem;
		font-weight: 700;
		color: var(--secondary);
		margin-bottom: 20px;
		font-family: 'Poppins', sans-serif;
	}

	.empty-description {
		font-size: 1.1rem;
		color: var(--text-light);
		line-height: 1.6;
		margin-bottom: 30px;
	}

	.empty-cta {
		background: var(--gradient);
		color: white;
		padding: 15px 30px;
		border-radius: 8px;
		text-decoration: none;
		font-weight: 600;
		font-family: 'Poppins', sans-serif;
		transition: var(--transition);
		display: inline-flex;
		align-items: center;
		gap: 10px;
	}

	.empty-cta:hover {
		transform: translateY(-2px);
		box-shadow: var(--shadow-lg);
		color: white;
	}

	/* Animations */
	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(30px);
		}

		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* Responsive Design */
	@media (max-width: 1024px) {
		.categories-grid {
			grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
			gap: 25px;
		}

		.categories-hero-title {
			font-size: 3rem;
		}
	}

	@media (max-width: 768px) {
		.categories-hero {
			padding: 100px 0 60px;
		}

		.categories-hero-title {
			font-size: 2.5rem;
		}

		.categories-hero-description {
			font-size: 1.1rem;
		}

		.categories-grid {
			grid-template-columns: 1fr;
			gap: 20px;
		}

		.section-title {
			font-size: 2.2rem;
		}

		.category-image-container {
			height: 220px;
		}

		.categories-stats {
			gap: 20px;
		}

		.stat-item {
			padding: 15px;
		}

		.stat-number {
			font-size: 2rem;
		}
	}

	@media (max-width: 480px) {
		.categories-hero-title {
			font-size: 2.2rem;
		}

		.section-title {
			font-size: 2rem;
		}

		.categories-grid {
			padding: 0 15px;
		}

		.category-content {
			padding: 20px;
		}

		.category-title {
			font-size: 1.3rem;
		}

		.empty-title {
			font-size: 1.8rem;
		}

		.empty-description {
			font-size: 1rem;
		}

		.page-link {
			width: 40px;
			height: 40px;
			font-size: 0.9rem;
		}

		.pagination {
			gap: 8px;
		}
	}

	@media (max-width: 380px) {
		.categories-grid {
			grid-template-columns: 1fr;
		}

		.category-actions {
			flex-direction: column;
			gap: 15px;
			align-items: flex-start;
		}

		.category-btn {
			width: 100%;
			justify-content: center;
		}

		.categories-stats {
			flex-direction: column;
			gap: 15px;
		}
	}
</style>

<!-- Hero Section Catégories -->
<section class="categories-hero">
	<div class="categories-hero-content">
		<div class="categories-hero-badge">
			<i class="fas fa-folder-open"></i>
			Ressources Médicales
		</div>
		<h1 class="categories-hero-title">
			Nos Catégories<span> d'Articles</span>
		</h1>
		<p class="categories-hero-description">
			Découvrez notre collection d'articles spécialisés sur la santé respiratoire,
			les traitements innovants et les conseils d'experts.
		</p>
	</div>
</section>

<!-- Section Catégories -->
<section class="categories-section">
	<div class="section-header">
		<div class="section-subtitle">Connaissances Expertes</div>
		<h2 class="section-title">Explorez nos Thématiques</h2>
		<p class="section-description">
			Des contenus riches et variés pour mieux comprendre et gérer votre santé respiratoire
		</p>
	</div>

	@if($categories->isNotEmpty())
	<!-- Statistiques -->
	{{-- <div class="categories-stats">
		<div class="stat-item">
			<span class="stat-number">{{ $categories->total() }}</span>
			<div class="stat-label">Catégories</div>
		</div>
		<div class="stat-item">
			<span class="stat-number">{{ $totalArticles ?? '0' }}</span>
			<div class="stat-label">Articles au total</div>
		</div>
		<div class="stat-item">
			<span class="stat-number">{{ $categories->perPage() }}</span>
			<div class="stat-label">Par page</div>
		</div>
	</div> --}}

	<!-- Grid des Catégories -->
	<div class="categories-grid">
		@foreach ($categories as $categorie)
		<div class="category-card">
			<div class="category-image-container">
				<img src="{{ asset('assets/images/categories/default.jpg') }}" alt="{{ $categorie->category_name }}"
					class="category-image">
				<div class="category-overlay">
					<div class="category-icon">
						<i class="fas fa-book-open"></i>
					</div>
				</div>
			</div>
			<div class="category-content">
				<h3 class="category-title">{{ $categorie->category_name }}</h3>
				<p class="category-description">
					Explorez nos articles spécialisés sur cette thématique médicale importante.
					Des contenus rédigés par des experts pour vous accompagner.
				</p>
				<div class="category-actions">
					<a href="{{ route('client.categories.get-articles', $categorie) }}" class="category-btn">
						<i class="fas fa-eye"></i>
						Voir les Articles
					</a>
					<span class="category-articles-count">
						<i class="fas fa-file-alt"></i>
						{{ $categorie->articles_count ?? '0' }} articles
					</span>
				</div>
			</div>
		</div>
		@endforeach
	</div>

	<!-- Pagination -->
	@if($categories->hasPages())
	<div class="pagination-container">
		<div>
			<ul class="pagination">
				{{-- Previous Page Link --}}
				@if ($categories->onFirstPage())
				<li class="page-item disabled">
					<span class="page-link">
						<i class="fas fa-chevron-left"></i>
					</span>
				</li>
				@else
				<li class="page-item">
					<a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">
						<i class="fas fa-chevron-left"></i>
					</a>
				</li>
				@endif

				{{-- Pagination Elements --}}
				@foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
				@if ($page == $categories->currentPage())
				<li class="page-item active">
					<span class="page-link">{{ $page }}</span>
				</li>
				@else
				<li class="page-item">
					<a class="page-link" href="{{ $url }}">{{ $page }}</a>
				</li>
				@endif
				@endforeach

				{{-- Next Page Link --}}
				@if ($categories->hasMorePages())
				<li class="page-item">
					<a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">
						<i class="fas fa-chevron-right"></i>
					</a>
				</li>
				@else
				<li class="page-item disabled">
					<span class="page-link">
						<i class="fas fa-chevron-right"></i>
					</span>
				</li>
				@endif
			</ul>

			{{-- Informations de pagination --}}
			<div class="pagination-info">
				Affichage de <strong>{{ $categories->firstItem() }}</strong> à <strong>{{ $categories->lastItem()
					}}</strong>
				sur <strong>{{ $categories->total() }}</strong> catégories
			</div>
		</div>
	</div>
	@endif

	@else
	<!-- État vide -->
	<div class="empty-state">
		<div class="empty-icon">
			<i class="fas fa-inbox"></i>
		</div>
		<h2 class="empty-title">Catalogue en Construction</h2>
		<p class="empty-description">
			Il semble que notre catalogue soit encore en construction. Notre équipe travaille
			activement à préparer des articles passionnants et informatifs pour vous.
		</p>
		<a href="{{ route('client.accueil') }}" class="empty-cta">
			<i class="fas fa-home"></i>
			Retour à l'accueil
		</a>
	</div>
	@endif
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
        // Animation au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observer les cartes de catégories
        const categoryCards = document.querySelectorAll('.category-card');
        categoryCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            card.style.transitionDelay = (index * 0.1) + 's';
            observer.observe(card);
        });
        
        // Animation pour l'état vide
        const emptyState = document.querySelector('.empty-state');
        if (emptyState) {
            emptyState.style.opacity = '0';
            emptyState.style.transform = 'translateY(30px)';
            emptyState.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(emptyState);
        }

        // Animation pour les statistiques
        const statItems = document.querySelectorAll('.stat-item');
        statItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            item.style.transitionDelay = (index * 0.2) + 's';
            observer.observe(item);
        });
    });
</script>

@endsection