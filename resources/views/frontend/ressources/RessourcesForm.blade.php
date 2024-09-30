@extends('frontend.layouts.layoutUserWorkspace')
@section('contentlandinpage')

    <!-- Card header -->
    <div class="card-header">
        <h3 class="mb-0">{{ isset($ressource) ? 'Update Ressource' : 'Create Ressource' }}</h3>
       
    </div>

    <!-- Card body -->
    <div class="card-body">
        <form action="{{  isset($ressource) ? route('ressource.update', $ressource->id) : route('frontend.ressources.RessourcesForm') }}" method="POST" class="row gx-3 needs-validation" novalidate>
        @csrf
        @if(isset($ressource))
        @method('PUT')
        @endif
            <!-- Nom -->
            <div class="mb-3 col-12">
                <label class="form-label" for="nom">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom"  value="{{ $ressource->nom ?? '' }}" required />
                <div class="invalid-feedback">Please enter the name of the resource.</div>
            </div>

            <!-- Quantité -->
            <div class="mb-3 col-12 col-md-6">
                <label class="form-label" for="quantite">Quantité</label>
                <input type="number" id="quantite" name="quantite" class="form-control" placeholder="Quantité" value="{{ $ressource->quantite ?? '' }}" required />
                <div class="invalid-feedback">Please enter the quantity.</div>
            </div>

            <!-- Libellé -->
            <div class="mb-3 col-12 col-md-6">
                <label class="form-label" for="libelle">Libellé</label>
                <input type="text" id="libelle" name="libelle" class="form-control" placeholder="Libellé"  value="{{ $ressource->libelle ?? '' }}" required />
                <div class="invalid-feedback">Please enter a label for the resource.</div>
            </div>

            <div class="col-12">
                <!-- Submit Button -->
                <button class="btn btn-primary" type="submit">  {{ isset($ressource) ? 'Update Ressource' : 'Create Ressource' }} </button>
            </div>
        </form>
    </div>

@endsection
