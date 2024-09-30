@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<section class="container-fluid p-4">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">Plantes</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.plant.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Plantes</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('backend.plant.create') }}" class="btn btn-primary">Ajouter une nouvelle Plante</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Plant Table -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom de la Plante</th>
                                    <th>Type</th>
                                    <th>Taille (m²)</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plants as $plant)
                                <tr>
                                    <td>{{ $plant->nom }}</td> <!-- Changed from $plant->name -->
                                    <td>{{ $plant->type }}</td>
                                    <td>{{ $plant->taille }} m²</td> <!-- If you have a taille field, change $plant->size to $plant->taille -->
                                    <td>{{ \Illuminate\Support\Str::limit($plant->description, 50) }}</td>
                                    <td>
                                        <!-- Action buttons: Edit and Delete -->
                                        <a href="{{ route('backend.plant.edit', $plant->id) }}" class="btn btn-sm btn-outline-secondary">Modifier</a>

                                        <form action="{{ route('backend.plant.destroy', $plant->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette plante ?');">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune plante trouvée</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="card-footer">
                    {{ $plants->links() }} <!-- Assuming you're using Laravel's pagination -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
