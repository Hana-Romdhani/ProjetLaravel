@extends('frontend.layouts.layoutUserWorkspace')
@section('contentlandinpage')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div>
    <a href="{{ route('frontend.ressources.RessourcesForm.create') }}" class="btn btn-primary">Ajouter Ressource</a>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <!-- Card -->
        <div class="card rounded-3">
            <!-- Card header -->
            <div>
                <!-- Table -->
                <div class="tab-content" id="tabContent">
                    <!-- Tab pane -->
                    <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                        <div class="table-responsive border-0 overflow-y-hidden">
                        <table class="table mb-0 text-nowrap table-centered table-hover">
                            <thead class="table-light text-center"> <!-- Ajout de 'text-center' pour centrer les titres -->
                                <tr>
                                    <th>Ressource</th>
                                    <th>Libelle</th>
                                    <th>Quantite</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center"> <!-- Ajout de 'text-center' pour centrer les données -->
                                @foreach ($ressources as $ressource)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-3"> <!-- Centrer le contenu -->
                                            
                                            <div class="d-flex flex-column gap-1">
                                                <h4 class="mb-0 text-primary-hover">{{ $ressource->nom }}</h4>
                                                <div>
                                                <!-- Affichage de l'image -->
                                                @if($ressource->image)
                                                <img src="{{ asset('storage/' . $ressource->image) }}" alt="" class="img-4by3-lg rounded" />
                                                @else
                                                <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-4by3-lg rounded" />
                                                @endif
                                            </div>
                                                <span>Added on {{ $ressource->created_at->format('d M, Y') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            {!! implode('<br>', array_map('trim', str_split(strip_tags($ressource->libelle), 60))) !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <p>{{ $ressource->quantite }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <!-- Bouton Modifier avec une icône d'édition -->
                                            <a href="{{ route('frontend.ressources.RessourcesForm.edit', $ressource->id) }}" class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-pencil"></i> <!-- Icône d'édition -->
                                            </a>

                                            <!-- Bouton Supprimer avec une icône de suppression -->
                                            <form action="{{ route('Ressources.destroy', $ressource->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Ressource?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-trash"></i> <!-- Icône de corbeille pour la suppression -->
                                                </button>
                                            </form>
                                        </div>
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
                        {{ $ressources->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection
