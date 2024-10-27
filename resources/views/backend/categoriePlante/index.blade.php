@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<section class="container-fluid p-4">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">Catégories</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/admin">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Catégories</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('backend.categoriePlante.create') }}" class="btn btn-primary">Ajouter une nouvelle Catégorie</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="row mb-3">
        <div class="col-lg-6">
            <form action="{{ route('backend.categoriePlante.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Recherche par nom ou description" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Category Table -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card rounded-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom de la Catégorie</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                <tr>
                                    <td>{{ $category->nom }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($category->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('backend.categoriePlante.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary">Modifier</a>
                                        <form action="{{ route('backend.categoriePlante.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Aucune catégorie trouvée</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $categories->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
