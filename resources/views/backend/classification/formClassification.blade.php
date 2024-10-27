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
    <form action="{{ isset($classification) ? route('backend.classification.update', $classification->id) : route('backend.classification.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @if(isset($classification))
        @method('PUT')
    @endif

    <!-- Jardin Name -->
    <div class="mb-3 col-12 col-md-6">
        <label class="form-label" for="jardinName">Name</label>
        <input type="text" id="jardinName" name="name" class="form-control" @error('name') is-invalid @enderror" value="{{ old('name', $classification->name ?? '') }}" required />
        <div class="invalid-feedback">Classification is required</div>
        @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
    </div>

    
    <!-- Submit Button -->
    <div class="col-12">
        <button class="btn btn-primary" type="submit">{{ isset($classification) ? 'Update Classification' : 'Create Classification' }}</button>
    </div>
</form>

</section>
@endsection
