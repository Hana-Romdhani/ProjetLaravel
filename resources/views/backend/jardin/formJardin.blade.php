@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

    <!-- If you want to differentiate between create and update, you can use isset($jardin) to conditionally set the route and method -->
    <form action="{{ isset($jardin) ? route('jardin.update', $jardin->id) : route('backend.jardin.formJardin') }}" method="POST">
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

        <!-- Submit Button -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit">{{ isset($jardin) ? 'Update Jardin' : 'Create Jardin' }}</button>
        </div>
    </form>

</section>
@endsection
