@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<section class="container-fluid p-4">

    <form action="{{ isset($evenement) ? route('backend.evenement.update', $evenement->id) : route('backend.evenement.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if(isset($evenement))
            @method('PUT')
        @endif

        <!-- Title -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinName">Title</label>
            <input type="text" id="jardinName" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $evenement->title ?? '') }}" required />
            <div class="invalid-feedback">Title is required</div>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Location -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinLocation">Location</label>
            <input type="text" id="jardinLocation" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $evenement->location ?? '') }}" required />
            <div class="invalid-feedback">Location is required</div>
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3 col-12">
            <label class="form-label" for="jardinDescription">Description</label>
            <textarea id="jardinDescription" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $evenement->description ?? '') }}</textarea>
            <div class="invalid-feedback">Description is required</div>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinSize">Date</label>
            <input type="date" id="jardinSize" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $evenement->date ?? '') }}" required />
            <div class="invalid-feedback">Date is required</div>
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Classification -->
        <div class="form-group">
            <label for="classification_id">Classification</label>
            <select class="form-control @error('classification_id') is-invalid @enderror" id="classification_id" name="classification_id" required>
                <option value="">Sélectionnez une classification</option>
                @foreach ($classifications as $classification)
                    <option value="{{ $classification->id }}" {{ (old('classification_id', $evenement->classification_id ?? '') == $classification->id) ? 'selected' : '' }}>{{ $classification->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Classification is required</div>
            @error('classification_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Upload -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Si l'événement a déjà une image, afficher un aperçu -->
        @if(isset($evenement) && $evenement->image)
            <div class="mb-3 col-12">
                <label class="form-label">Actual Image :</label>
                <img src="{{ asset('storage/' . $evenement->image) }}" alt="Image de l'événement" class="img-fluid" width="200">
            </div>
        @endif

        <!-- Submit Button -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit">{{ isset($evenement) ? 'Update Event' : 'Create Event' }}</button>
        </div>
    </form>

</section>
@endsection
