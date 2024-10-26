@extends('frontend.layouts.layoutUserWorkspace')
@section('contentlandinpage')

@if(Auth::check() && Auth::user()->role === 'admin')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Évaluations des Conseils</h4>

          <!-- Boucle sur chaque conseil -->
          @foreach ($conseils as $conseil)
            <div class="mb-4">
              <h5>{{ $conseil->titre }}</h5>

              <!-- Calcul de la moyenne d'évaluation et nombre d'évaluateurs -->
              @php
                  $averageRating = $conseil->rating_count > 0
                      ? number_format($conseil->total_rating / $conseil->rating_count, 2)
                      : 'Pas encore d\'évaluation';
                  $numberOfRaters = $conseil->rated_by_users
                      ? count(json_decode($conseil->rated_by_users, true))
                      : 0;
              @endphp

              <!-- Affichage de la moyenne et du nombre d'évaluateurs -->
              <div class="row mb-2">
               
                <div class="col-md-9">
                  <div class="progress">
                    <div class="progress-bar" role="progressbar"
                         style="width: {{ $averageRating !== 'Pas encore d\'évaluation' ? $averageRating * 20 : 0 }}%"
                         aria-valuenow="{{ $averageRating }}" aria-valuemin="0" aria-valuemax="100">
                      {{ $averageRating }}
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <span class="rating-count">Évaluateurs : {{ $numberOfRaters }}</span>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
@else
  <div class="alert alert-warning" role="alert">
    Vous n'avez pas le profil administrateur.
  </div>
@endif

@endsection
