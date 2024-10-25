@extends('frontend.layouts.layoutUserWorkspace')
@section('contentlandinpage')

<div class="card-header">
    <h3 class="mb-0">{{ isset($ressource) ? 'Update Ressource' : 'Create Ressource' }}</h3>
</div>

<div class="card-body">
    <form action="{{ isset($ressource) ? route('ressource.update', $ressource->id) : route('frontend.ressources.RessourcesForm') }}" 
          method="POST" 
          class="row gx-3 needs-validation" 
          enctype="multipart/form-data" 
          novalidate> <!-- Désactive la validation HTML pour utiliser Bootstrap -->
        
        @csrf
        @if(isset($ressource))
            @method('PUT')
        @endif

        <!-- Nom -->
        <div class="mb-3 col-12">
            <label class="form-label" for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" value="{{ $ressource->nom ?? '' }}" required />
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
            <input type="text" id="libelle" name="libelle" class="form-control" placeholder="Libellé" value="{{ $ressource->libelle ?? '' }}" required />
            <div class="invalid-feedback">Please enter a label for the resource.</div>
        </div>

        <!-- Image Upload -->
        <div class="mb-3 col-12">
            <label class="form-label" for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control" {{ isset($ressource) ? '' : 'required' }} />
            <div class="invalid-feedback">Please upload an image for the resource.</div>
        </div>

        <div class="col-12">
            <!-- Submit Button -->
            <button class="btn btn-primary" type="submit">{{ isset($ressource) ? 'Update Ressource' : 'Create Ressource' }}</button>
        </div>
    </form>
</div>

<script>
    // JavaScript pour activer les validations Bootstrap
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

@endsection
