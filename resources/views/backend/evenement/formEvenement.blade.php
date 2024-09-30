@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

    <!-- Affichage des messages d'erreur -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- If you want to differentiate between create and update, you can use isset($jardin) to conditionally set the route and method -->
    <form action="{{ isset($evenement) ? route('backend.evenement.update', $evenement->id) : route('backend.evenement.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($evenement))
        @method('PUT')
        @endif

        <!-- Jardin Name -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinName">Title</label>
            <input type="text" id="jardinName" name="title" class="form-control" value="{{ $evenement->title ?? '' }}" required />
            <div class="invalid-feedback">Please enter the title of the event.</div>
        </div>

        <!-- Jardin Location -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinLocation">Location</label>
            <input type="text" id="jardinLocation" name="location" class="form-control" value="{{ $evenement->location ?? '' }}" required />
            <div class="invalid-feedback">Please enter the location of the event.</div>
        </div>


        <!-- Jardin Description -->
        <div class="mb-3 col-12">
            <label class="form-label" for="jardinDescription">Description</label>
            <textarea id="jardinDescription" name="description" class="form-control" rows="4" required>{{ $evenement->description ?? '' }}</textarea>
            <div class="invalid-feedback">Please provide a description of the event.</div>
        </div>
        <!-- Jardin Size -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="jardinSize">Date</label>
            <input type="date" id="jardinSize" name="date" class="form-control" value="{{ $evenement->date ?? '' }}" required />
            <div class="invalid-feedback">Please enter the date of the event.</div>
        </div>

        <!-- Téléchargement d'image -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control">
            <div class="invalid-feedback">Please upload an image for the event.</div>
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