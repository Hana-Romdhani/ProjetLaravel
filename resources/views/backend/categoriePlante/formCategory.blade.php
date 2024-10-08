@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<section class="container-fluid p-4">
    <form action="{{ isset($category) ? route('backend.categoriePlante.update', $category->id) : route('backend.categoriePlante.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($category))
        @method('PUT')
        @endif

        <!-- Category Name -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="nom">Nom de la Catégorie</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ $category->nom ?? old('nom') }}" required />
        </div>

        <!-- Parent Category -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="parent_id">Catégorie Parent</label>
            <select id="parent_id" name="parent_id" class="form-control">
                <option value="">Sélectionnez une catégorie parent (facultatif)</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ isset($category) && $category->parent_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nom }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Description -->
        <div class="mb-3 col-12">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ $category->description ?? old('description') }}</textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-3 col-12">
            <label class="form-label" for="image_url">Image de la Catégorie</label>
            <input type="file" id="image_url" name="image_url" class="form-control" />
            @if(isset($category) && $category->image_url)
            <div class="mt-2">
                <img src="{{ asset('/assets/images/categories/' . $category->image_url) }}" alt="Image de la Catégorie" width="100">
            </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit">{{ isset($category) ? 'Mettre à Jour la Catégorie' : 'Créer une Catégorie' }}</button>
        </div>
    </form>
</section>
@endsection
