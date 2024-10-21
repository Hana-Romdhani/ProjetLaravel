@extends('frontend.layouts.layoutUserWorkspace')
@section('contentlandinpage')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
                <!-- Card header -->
                <div class="card-header p-0">
                    <div>
                        <!-- Nav -->
                        <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="courses-tab" data-bs-toggle="pill" href="#courses" role="tab" aria-controls="courses" aria-selected="true">All</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <!-- Table -->
                    <div class="tab-content" id="tabContent">
                        <!--Tab pane -->
                        <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap table-centered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th> Emprunteur</th>
                                            <th> Ressource</th>
                                            <th>Quantité</th>
                                            <th>Date de Partage</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ressourcesPartage as $ressourcePartage)

                                        <tr>
                                            <!-- Nom Emprunteur -->
                                            <td>
                                                {{ $ressourcePartage->emprunteur->nameUser }}
                                            </td>

                                            <!-- Nom Ressource -->
                                            <td>
                                                <div class="d-flex align-items-center gap-1">
                                                     
                                                <div class="d-flex flex-column gap-1">
                                                        <h4 class="mb-0 text-primary-hover">{{ $ressourcePartage->ressource ->nom }}</h4>
                                                    </div>
                                                    <div>
                                                        <!-- Si vous avez un champ image dans Ressource -->
                                                        @if($ressourcePartage->ressource->image)
                                                        <img src="{{ asset('storage/' . $ressourcePartage->ressource->image) }}" alt="" class="img-4by3-lg rounded" />
                                                        @else
                                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-4by3-lg rounded" />
                                                        @endif
                                                    </div>
                                                   
                                                </div>
                                            </td>                                           

                                            <!-- Quantité -->
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $ressourcePartage->quantite }}</p> <!-- Quantité partagée -->
                                                </div>
                                            </td>
                                             <!-- Date Partage -->
                                             <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $ressourcePartage->date_partage }}</p> <!-- Date Partage -->
                                                </div>
                                            </td>
                                             <!-- Statut -->
                                             <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $ressourcePartage->statut }}</p> <!-- Date Partage -->
                                                </div>
                                            </td>
                                            <td>
                                                <!-- Inline form for Accepter and Refuser buttons -->
                                                <form action="{{ route('frontend.ressources.RessourcesPartage.accepter', $ressourcePartage->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm mx-1">Accepter</button>
                                                </form>

                                                <form action="{{ route('frontend.ressources.RessourcesPartage.refuser', $ressourcePartage->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm mx-1">Refuser</button>
                                                </form>
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
                            <li class="page-item disabled">
                                <a class="page-link mx-1 rounded" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                    </svg>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link mx-1 rounded" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link mx-1 rounded" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link mx-1 rounded" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link mx-1 rounded" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection
