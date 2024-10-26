@extends('frontend.layouts.layoutUserWorkspace')
@section('contentlandinpage')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
                <div>
                    <!-- Table -->
                    <div class="tab-content" id="tabContent">
                        <!--Tab pane -->
                        <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap table-centered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Emprunteur</th>
                                            <th>Ressource</th>
                                            <th>Quantité</th>
                                            <th>Date de Partage</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ressourcesPartage as $ressourcePartage)

                                        <tr>
                                            <!-- Nom Emprunteur -->
                                            <td>
                                                {{ $ressourcePartage->emprunteur->nameUser }}
                                            </td>

                                            <!-- Nom Ressource + Image -->
                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-2">
                                                    <h5 class="mb-1 text-primary">{{ $ressourcePartage->ressource->nom }}</h5>

                                                    <!-- Afficher l'image de la ressource en dessous du nom -->
                                                    @if($ressourcePartage->ressource->image)
                                                        <img src="{{ asset('storage/' . $ressourcePartage->ressource->image) }}" alt="{{ $ressourcePartage->ressource->nom }}" class="img-fluid rounded" style="width: 100px; height: 100px;">
                                                    @else
                                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image" class="img-fluid rounded" style="width: 100px; height: 100px;">
                                                    @endif
                                                </div>
                                            </td>                                           

                                            <!-- Quantité -->
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $ressourcePartage->quantite }}</p>
                                                </div>
                                            </td>

                                            <!-- Date Partage -->
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $ressourcePartage->date_partage }}</p>
                                                </div>
                                            </td>

                                            <!-- Statut -->
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p class="mb-0">
                                                        @if($ressourcePartage->statut == 'accepté')
                                                            <span class="text-success"><i class="fas fa-check-circle"></i> Accepté</span>
                                                        @elseif($ressourcePartage->statut == 'refusé')
                                                            <span class="text-danger"><i class="fas fa-times-circle"></i> Refusé</span>
                                                        @elseif($ressourcePartage->statut == 'en attente')
                                                            <span class="text-warning"><i class="fas fa-hourglass-half"></i> En Attente</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- Actions -->
                                            <td>
                                                @if($ressourcePartage->statut === 'en attente')
                                                    <form action="{{ route('frontend.ressources.RessourcesPartage.accepter', $ressourcePartage->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm mx-1">Accepter</button> <!-- Bouton vert -->
                                                    </form>

                                                    <form action="{{ route('frontend.ressources.RessourcesPartage.refuser', $ressourcePartage->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm mx-1">Refuser</button> <!-- Bouton rouge -->
                                                    </form>
                                                @else
                                                    <button class="btn btn-secondary btn-sm mx-1" disabled>Accepter</button> <!-- Bouton gris désactivé -->
                                                    <button class="btn btn-secondary btn-sm mx-1" disabled>Refuser</button> <!-- Bouton gris désactivé -->
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

               <!-- Card Footer -->
                <div class="card-footer">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            <!-- Générer automatiquement les liens de pagination -->
                            {{ $ressourcesPartage->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>


            </div>
        </div>
    </div>

@endsection
