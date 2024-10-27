@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<section class="container-fluid p-4">

    <!-- Error Display -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Create or Edit Form -->
    <form action="{{ isset($plante) ? route('backend.plant.update', $plante->id) : route('backend.plant.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($plante))
        @method('PUT')
        @endif

        <!-- Plant Name -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="nom">Nom de la Plante</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ $plante->nom ?? old('nom') }}" />
            @error('nom')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Scientific Name -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="nom_scientifique">Nom Scientifique</label>
            <input type="text" id="nom_scientifique" name="nom_scientifique" class="form-control" value="{{ $plante->nom_scientifique ?? old('nom_scientifique') }}" />
            @error('nom_scientifique')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Category -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="categorie_plante_id">Catégorie de Plante</label>
            <select id="categorie_plante_id" name="categorie_plante_id" class="form-control">
                <option value="">Sélectionnez une catégorie</option>
                @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" {{ isset($plante) && $plante->categorie_plante_id == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
                @endforeach
            </select>
            @error('categorie_plante_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <!-- Description -->
        <div class="mb-3 col-12">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ $plante->description ?? old('description') }}</textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-3 col-12">
            <label class="form-label" for="image_url">Image de la Plante</label>
            <input type="file" id="image_url" name="image_url" class="form-control" />
            @if(isset($plante) && $plante->image_url)
            <div class="mt-2">
                <img src="{{ isset($plante) && $plante->image_url ? asset('/assets/images/course/' . $plante->image_url) : asset('/assets/images/inconnu.png') }}" alt="Image de la Plante" width="100">
            </div>
            @endif
        </div>


        <!-- Accordion for Additional Attributes -->
        <div class="accordion" id="additionalAttributesAccordion">
            <div class="card">
                <div class="card-header" id="headingAttributes">
                    <h4 class="mb-0">
                        <button class="btn btn-link text-decoration-none text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAttributes" aria-expanded="true" aria-controls="collapseAttributes">
                            Attributs supplémentaires
                            <i class="fe fe-chevron-down ms-2"></i>
                        </button>
                    </h4>
                </div>

                <div id="collapseAttributes" class="collapse" aria-labelledby="headingAttributes" data-bs-parent="#additionalAttributesAccordion">
                    <div class="card-body">



                        <!-- Plant Family -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="famille">Famille de la Plante</label>
                            <input type="text" id="famille" name="famille" class="form-control" value="{{ $plante->famille ?? old('famille') }}" />
                        </div>

                        <!-- Plant Origin -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="origine">Origine</label>
                            <input type="text" id="origine" name="origine" class="form-control" value="{{ $plante->origine ?? old('origine') }}" />
                        </div>

                        <!-- Type -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="type">Type (annuel, vivace)</label>
                            <input type="text" id="type" name="type" class="form-control" value="{{ $plante->type ?? old('type') }}" />
                        </div>

                        <!-- Sun Exposure -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="exposition">Exposition au Soleil</label>
                            <input type="text" id="exposition" name="exposition" class="form-control" value="{{ $plante->exposition ?? old('exposition') }}" />
                        </div>

                        <!-- Watering Needs -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="arrosage">Besoins en Eau</label>
                            <input type="text" id="arrosage" name="arrosage" class="form-control" value="{{ $plante->arrosage ?? old('arrosage') }}" />
                        </div>

                        <!-- Soil Type -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="type_sol">Type de Sol</label>
                            <input type="text" id="type_sol" name="type_sol" class="form-control" value="{{ $plante->type_sol ?? old('type_sol') }}" />
                        </div>

                        <!-- Planting Period -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="periode_plantation">Période de Plantation</label>
                            <input type="text" id="periode_plantation" name="periode_plantation" class="form-control" value="{{ $plante->periode_plantation ?? old('periode_plantation') }}" />
                        </div>

                        <!-- Flowering Period -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="periode_floraison">Période de Floraison</label>
                            <input type="text" id="periode_floraison" name="periode_floraison" class="form-control" value="{{ $plante->periode_floraison ?? old('periode_floraison') }}" />
                        </div>

                        <!-- Maximum Height -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="hauteur_max">Hauteur Maximale (en cm)</label>
                            <input type="number" id="hauteur_max" name="hauteur_max" class="form-control" value="{{ $plante->hauteur_max ?? old('hauteur_max') }}" />
                        </div>

                        <!-- Maximum Width -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="largeur_max">Largeur Maximale (en cm)</label>
                            <input type="number" id="largeur_max" name="largeur_max" class="form-control" value="{{ $plante->largeur_max ?? old('largeur_max') }}" />
                        </div>

                        <!-- Growth Rate -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="croissance">Vitesse de Croissance</label>
                            <input type="text" id="croissance" name="croissance" class="form-control" value="{{ $plante->croissance ?? old('croissance') }}" />
                        </div>

                        <!-- Special Needs -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="besoins_speciaux">Besoins Spéciaux</label>
                            <textarea id="besoins_speciaux" name="besoins_speciaux" class="form-control" rows="2">{{ $plante->besoins_speciaux ?? old('besoins_speciaux') }}</textarea>
                        </div>

                        <!-- Uses -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="utilisations">Utilisations (ornemental, comestible, etc.)</label>
                            <textarea id="utilisations" name="utilisations" class="form-control" rows="2">{{ $plante->utilisations ?? old('utilisations') }}</textarea>
                        </div>

                        <!-- Care Tips -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="conseils_entretien">Conseils d'Entretien</label>
                            <textarea id="conseils_entretien" name="conseils_entretien" class="form-control" rows="2">{{ $plante->conseils_entretien ?? old('conseils_entretien') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <!-- Submit Button -->
            <div class="col-12">
                <button class="btn btn-primary" type="submit">{{ isset($plante) ? 'Mettre à Jour la Plante' : 'Créer une Plante' }}</button>
            </div>
    </form>
</section>
@endsection
