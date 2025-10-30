@extends('mails.base.index')

@section('title', 'Nouvelle Commande - ' . $commande->numero_commande)

@section('header-icon', '')
@section('header-title', 'Nouvelle Commande')
@section('header-subtitle', 'Une commande vient d\'être passée sur votre plateforme')

@section('footer-text', 'Cet email a été envoyé automatiquement pour vous informer d\'une nouvelle commande sur votre plateforme.')

@section('contenue')
    <div class="notification-card">
        <div class="notification-icon"></div>
        <h2 class="notification-title">Nouvelle Commande Reçue !</h2>
        <p class="notification-text">
            Une nouvelle commande vient d'être passée par <strong>{{ $commande->user->name }}</strong>.
            Voici les détails de cette commande.
        </p>
    </div>

    <!-- Informations principales -->
    <div class="order-info-grid">
        <div class="info-card">
            <div class="info-label">Numéro de Commande</div>
            <div class="info-value">{{ $commande->numero_commande }}</div>
        </div>

        <div class="info-card">
            <div class="info-label">Date de Commande</div>
            <div class="info-value">{{ $commande->date_commande->format('d/m/Y à H:i') }}</div>
        </div>

        <div class="info-card">
            <div class="info-label">Montant Total</div>
            <div class="info-value">{{ number_format($commande->total, 2, ',', ' ') }} fcfa</div>
        </div>

        <div class="info-card">
            <div class="info-label">Statut</div>
            <div class="info-value" style="color: var(--success);">
                {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
            </div>
        </div>
    </div>

    <!-- Informations client -->
    <div class="customer-section">
        <h3 class="section-title">Informations du Client</h3>
        <div class="customer-details">
            <div class="detail-item">
                <span class="detail-label">Nom</span>
                <span class="detail-value">{{ $commande->user->name }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ $commande->user->email }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Téléphone</span>
                <span class="detail-value">
                    {{ optional($commande->user->adressePrincipale)->telephone ?? 'Non renseigné' }}
                </span>
            </div>
            @if($commande->adresse)
            <div class="detail-item">
                <span class="detail-label">Adresse</span>
                <span class="detail-value">
                    {{ $commande->adresse->adresse }}, {{ $commande->adresse->code_postal }} {{ $commande->adresse->ville }}
                </span>
            </div>
            @endif
        </div>
    </div>

    <!-- Articles commandés -->
    @if($commande->details->count() > 0)
    <div class="order-items">
        <div class="items-header">
            <h3 class="items-title"> Articles Commandés</h3>
        </div>
        <div class="items-list">
            @foreach($commande->details as $detail)
            <div class="order-item">
                <span class="item-name">{{ $detail->article->nom ?? 'Article' }}</span>
                <span class="item-quantity">x{{ $detail->quantite }}</span>
                <span class="item-price">{{ number_format($detail->prix_unitaire * $detail->quantite, 2, ',', ' ') }} fcfa</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Total -->
    <div class="order-total">
        <div class="total-label">Montant Total de la Commande</div>
        <div class="total-amount">{{ number_format($commande->total, 2, ',', ' ') }} fcfa</div>
    </div>

    <!-- Call to Action -->
    <div class="cta-section">
        <a href="" class="btn-primary">
            Voir les Détails de la Commande
        </a>
    </div>
@endsection