@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">Ressources</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Ressources Partagés</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card rounded-3">
                <div class="p-4 row">
                    <!-- Form for Filtering by Status -->
                    <form action="{{ route('backend.ressource.ressourcesPartage') }}" method="GET" class="d-flex align-items-center col-12 col-md-12 col-lg-12 mb-3">
                        <select name="statut" class="form-select me-2">
                            <option value="">Tous les statuts</option>
                            <option value="en attente">En Attente</option>
                            <option value="accepte">Accepté</option>
                            <option value="refuse">Refusé</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </form>
                </div>
                <div>
                    <div class="tab-content" id="tabContent">
                        <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap table-centered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-start">Ressource</th>
                                            <th class="text-center">Preteur</th>
                                            <th class="text-center">Emprunteur</th>
                                            <th class="text-center">Date de Partage</th>
                                            <th class="text-center">Quantité demandé</th>
                                            <th class="text-center">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ressourcespartages as $ressourcepartage)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="d-flex flex-column gap-1">
                                                        <h4 class="mb-0 text-primary-hover">{{ $ressourcepartage->ressource->nom }}</h4>
                                                        <div>
                                                            @if($ressourcepartage->ressource->image)
                                                            <img src="{{ asset('storage/' . $ressourcepartage->ressource->image) }}" alt="" class="img-4by3-lg rounded" />
                                                            @else
                                                            <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-4by3-lg rounded" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $ressourcepartage->preteur->nameUser }}</td>
                                            <td class="text-center">{{ $ressourcepartage->emprunteur->nameUser }}</td>
                                            <td class="text-center"><p class="mb-0">{{ $ressourcepartage->date_partage }}</p></td>
                                            <td class="text-center"><p class="mb-0">{{ $ressourcepartage->quantite }}</p></td>
                                            <td class="text-center">
                                                <p class="mb-0">
                                                    @if($ressourcepartage->statut == 'accepté')
                                                        <span class="text-success"><i class="fas fa-check-circle"></i> Accepté</span>
                                                    @elseif($ressourcepartage->statut == 'refusé')
                                                        <span class="text-danger"><i class="fas fa-times-circle"></i> Refusé</span>
                                                    @elseif($ressourcepartage->statut == 'en attente')
                                                        <span class="text-warning"><i class="fas fa-hourglass-half"></i> En Attente</span>
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            {{ $ressourcespartages->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
