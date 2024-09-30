@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

    <form action="{{ isset($jardin) ? route('jardin.update', $jardin->id) : route('backend.jardin.formJardin') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($jardin))
        @method('PUT')
        @endif

        <!-- Jardin Name -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinName">Jardin Name</label>
            <input type="text" id="jardinName" name="name" class="form-control" value="{{ $jardin->name ?? '' }}" required />
            <div class="invalid-feedback">Please enter the name of the jardin.</div>
        </div>

        <!-- Jardin Location -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinLocation">Location</label>
            <input type="text" id="jardinLocation" name="location" class="form-control" value="{{ $jardin->location ?? '' }}" required />
            <div class="invalid-feedback">Please enter the location of the jardin.</div>
        </div>

        <!-- Jardin Size -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinSize">Size (in sq meters)</label>
            <input type="number" id="jardinSize" name="size" class="form-control" value="{{ $jardin->size ?? '' }}" required />
            <div class="invalid-feedback">Please enter the size of the jardin.</div>
        </div>

        <!-- Jardin Description -->
        <div class="mb-3 col-12">
            <label class="form-label" for="jardinDescription">Description</label>
            <textarea id="jardinDescription" name="description" class="form-control" rows="4" required>{{ $jardin->description ?? '' }}</textarea>
            <div class="invalid-feedback">Please provide a description of the jardin.</div>
        </div>

        <!-- Jardin Image -->
        <div class="mb-3 col-12">
            <label class="form-label" for="jardinImage">Image</label>
            <input type="file" id="jardinImage" name="image" class="form-control" accept="image/*" {{ isset($jardin) ? '' : 'required' }} />
            <div class="invalid-feedback">Please upload an image for the jardin.</div>
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
@endsection
