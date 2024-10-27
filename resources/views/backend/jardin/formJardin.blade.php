@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<section class="container-fluid p-4">
    <form action="{{ isset($jardin) ? route('jardin.update', $jardin->id) : route('backend.jardin.formJardin') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if(isset($jardin))
            @method('PUT')
        @endif

        <!-- Jardin Name -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinName">Jardin Name</label>
            <input type="text" id="jardinName" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $jardin->name ?? '') }}" required />
            <div class="invalid-feedback">Please enter the name of the jardin.</div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jardin Location -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinLocation">Location</label>
            <input type="text" id="jardinLocation" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $jardin->location ?? '') }}" required />
            <div class="invalid-feedback">Please enter the location of the jardin.</div>
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jardin Size -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinSize">Size (in sq meters)</label>
            <input type="number" id="jardinSize" name="size" class="form-control @error('size') is-invalid @enderror" value="{{ old('size', $jardin->size ?? '') }}" required />
            <div class="invalid-feedback">Please enter the size of the jardin.</div>
            @error('size')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jardin Description -->
        <div class="mb-3 col-12">
            <label class="form-label" for="jardinDescription">Description</label>
            <textarea id="jardinDescription" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $jardin->description ?? '') }}</textarea>
            <div class="invalid-feedback">Please enter a description for the jardin.</div>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jardin Image -->
        <div class="mb-3 col-12">
            <label class="form-label" for="jardinImage">Image</label>
            <input type="file" id="jardinImage" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" {{ isset($jardin) ? '' : 'required' }} />
            <div class="invalid-feedback">Please upload an image for the jardin.</div>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @if(isset($jardin) && $jardin->image)
                <img src="{{ asset('storage/' . $jardin->image) }}" alt="{{ $jardin->name }}" class="img-thumbnail mt-2" style="max-height: 150px;">
            @endif
        </div>

        <!-- Submit Button -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit">{{ isset($jardin) ? 'Update Jardin' : 'Create Jardin' }}</button>
        </div>
    </form>
</section>

<script>
    // JavaScript to activate Bootstrap validation
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
