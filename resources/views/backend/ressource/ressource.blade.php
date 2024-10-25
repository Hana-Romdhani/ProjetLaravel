@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">Ressources</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="admin-dashboard.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Ressources</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
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
                <div class="p-4 row">
                    <!-- Form -->
                    <form class="d-flex align-items-center col-12 col-md-12 col-lg-12">
                        <span class="position-absolute ps-3 search-icon"><i class="fe fe-search"></i></span>
                        <input type="search" class="form-control ps-6" placeholder="Search ressource" />
                    </form>
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
                                            <th class="text-center">Nom Ressource</th> <!-- Aligné au centre -->
                                            <th class="text-center">Libelle</th>       <!-- Aligné au centre -->
                                            <th class="text-center">Quantite</th>      <!-- Aligné au centre -->
                                            <th class="text-center">Propriétaire</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ressources as $ressource)
                                        <tr>
                                            <td class="text-center"> <!-- Aligné au centre -->
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="d-flex flex-column gap-1">
                                                        <h4 class="mb-0 text-primary-hover">{{ $ressource->nom }}</h4>
                                                        <div>
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
                                            <td class="text-center"> <!-- Aligné au centre -->
                                                <div class="d-flex flex-column gap-2">
                                                    {!! implode('<br>', array_map('trim', str_split(strip_tags($ressource->libelle), 90))) !!}
                                                </div>
                                            </td>
                                            <td class="text-center"> <!-- Aligné au centre -->
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $ressource->quantite }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <!-- Afficher le nameUser du propriétaire -->
                                                    <span>{{ $ressource->user ? $ressource->user->nameUser : 'N/A' }}</span>
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
</section>
@endsection
